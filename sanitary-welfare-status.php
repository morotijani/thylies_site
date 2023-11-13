<?php 
    require_once ("connection/conn.php");

    $title = 'Sanitary Welfare Status - ';

    //  
    $authSW = issetElse($_SESSION, 'auth-sanitarywelfare', 0);
    if ($authSW != 0 && !empty($authSW)) {
        $id = sanitize($authSW);

        // check if id exist in scholarship table
        $sql = "
            SELECT * FROM thylies_sanitary_welfare 
            WHERE sw_id = ? 
            AND status = ? 
            LIMIT 1
        ";
        $statement = $conn->prepare($sql);
        $statement->execute([$id, 1]);
        $row = $statement->fetchAll();
        if ($statement->rowCount() > 0) {

            $status = '';
            $status_class = '';
            if ($row[0]['status'] == 0) {
                $status = 'Pending';
                $status_class = 'info';
            } else if ($row[0]['status'] == 1) {
                $status = 'Success';
                $status_class = 'success';
            } else {
                $status = 'Rejected';
                $status_class = 'danger';
            }

            // check if id also exist in transaction
            $Query = "
                SELECT * FROM thylies_transactions 
                WHERE from_id = ? 
                AND transaction_service = ?  
                LIMIT 1
            ";
            $statement = $conn->prepare($Query);
            $statement->execute([$id, 'sanitarywelfare']);
            $sub_row = $statement->fetchAll();
            $sub_count = $statement->rowCount();

            if ($sub_count) {
                // 
                unset($_SESSION['auth-sanitarywelfare']);

                $picture = 'svg/friendly-ghost.svg';
                if ($row[0]["student_picture"] != '') {
                    $picture = 'sanitary-welfare/' . $row[0]["student_picture"];
                }
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content=">Yoga Coach - Bootstrap 5 Personal Website Template">
    <meta name="keywords" content=">Yoga Coach, Personal website template">
    <meta name="author" content="Codescandy">
    <title><?= $title; ?> Thylies</title>
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/plyr.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mansalva&family=Young+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gaegu" />
    <link href="https://fonts.googleapis.com/css2?family=Mansalva&family=Patrick+Hand&family=Young+Serif&display=swap" rel="stylesheet">

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="<?= PROOT; ?>assets/media/logo/logo-min.png">

    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/theme.min.css">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-M8S4MT3EYG');
    </script>
</head>
<body>
    <main>
        <section class="py-lg-13 py-6">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <div class="card mb-4" id="reciept">
                            <div class="card-body text-center">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="badge bg-<?= $status_class; ?>-soft"><?= $status; ?></div>
                                    </div>
                                </div>
                                <a href="javascript:;" class="mx-auto"><img src="<?= PROOT . 'assets/media/' . $picture; ?>" alt="book" class="mt-3 img-fluid" style="width: 300px !important; height: 300px !important;"></a>
                                <div class="mt-3">
                                    <a href="javascript:;">
                                        <h4 class="mb-1"><?= ucwords($row[0]['name_of_student']); ?></h4>
                                    </a>
                                    <p class="font-12 mb-2"><?= $row[0]["student_index"]; ?></p>
                                    <div class="text-dark me-2"><span class="text-muted">Sanitary Welfare ID: </span><?= $row[0]["sw_id"]; ?></div>
                                    <div class="text-dark me-2"><span class="text-muted">Transaction ID: </span><?= $sub_row[0]["transaction_id"] ?></div>
                                    <div class="text-dark me-2"><span class="text-muted">Paid Date: </span><?= $sub_row[0]["createdAt"] ?></div>
                                    <div class="text-dark me-2"><span class="text-muted">Applied Date: </span><?= $row[0]["createdAt"] ?></div>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:;" class="btn btn-outline-primary btn-sm mt-3" id="download">Download</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php
            } else {
                redirect(PROOT . 'auth/auth-sanitary-welfare-status/' . $authSW);
            }
        } else {
            redirect(PROOT . 'sanitary-welfare-list');
        }
                
    } else {
        redirect(PROOT . 'sanitary-welfare-list');
    }
?>
    <script src="<?= PROOT; ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/jquery.slimscroll.min.js"></script>

    <!-- Theme JS -->
    <script src="<?= PROOT; ?>assets/js/theme.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/plyr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

    <script>
        window.onload = function () {
            document.getElementById("download")
                .addEventListener("click", () => {
                    const reciept = this.document.getElementById("reciept");
                    // console.log(reciept);
                    // console.log(window);
                    var opt = {
                        margin: 1,
                        filename: 'sanitary-welfare-<?= $sub_row[0]['transaction_id']; ?>.pdf',
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { scale: 2 },
                        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                    };
                    html2pdf().from(reciept).set(opt).save();
                })
        }
    </script>
</body>
</html>
