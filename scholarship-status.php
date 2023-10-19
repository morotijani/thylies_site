<?php 
    require_once ("connection/conn.php");

    $title = 'Scholarhip Status - ';

    if (isset($_GET['scholarship'])) {
        $id = sanitize($_GET['scholarship']);

        // check if id exist in scholarship table
        $sql = "
            SELECT * FROM thylies_scholarship 
            WHERE scholarship_id = ? 
            AND status = ? AND 
            percentage > ? 
            LIMIT 1
        ";
        $statement = $conn->prepare($sql);
        $statement->execute([$id, 1, 0]);
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
                SELECT * FROM thylies_scholarship_transaction 
                WHERE scholarship_id = ? 
                LIMIT 1
            ";
            $statement = $conn->prepare($Query);
            $statement->execute([$id]);
            $sub_row = $statement->fetchAll();
            $sub_count = $statement->rowCount();

            if ($sub_count) {
                // code...
                $picture = 'svg/friendly-ghost.svg';
                if ($row[0]["student_picture"] != '') {
                    $picture = 'scholarship/' . $row[0]["student_picture"];
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

                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="badge bg-<?= $status_class; ?>-soft"><?= $status; ?></div>
                                    </div>
                                    <div>
                                        <a href="#" class="btn-like">
                                        <i class="fe fe-heart"></i>
                                        </a>
                                    </div>
                                </div>
                                <a href="javascript:;" class="mx-auto"><img src="<?= PROOT . 'assets/media/' . $picture; ?>" alt="book" class="mt-3 img-fluid" style="width: 300px !important; height: 300px !important;"></a>
                                <div class="mt-3">
                                    <a href="shop-single.html">
                                        <h4 class="mb-1"><?= ucwords($row[0]['student_name']); ?></h4>
                                    </a>
                                    <p class="font-12 mb-2"><?= $row[0]["index_number"]; ?></p>
                                    <div class="text-dark me-2"><span class="text-muted">Scholarship ID: </span><?= $row[0]["scholarship_id"]; ?></div>
                                    <div class="text-dark me-2"><span class="text-muted">Transaction ID: </span><?= $sub_row[0]["transaction_id"] ?></div>
                                    <div class="text-dark me-2"><span class="text-muted">Date: </span><?= $row[0]["createdAt"] ?></div>
                                    <a href="#" class="btn btn-outline-primary btn-sm mt-3">Download</a>
                                    <br>
                                    <br>
                                    <a href="<?= PROOT; ?>scholarship-list">view all list.</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php
            } else {
                redirect(PROOT . 'auth/pay-scholarship-fee/' . $id);
            }
        } else {
            redirect(PROOT . 'scholarship-list');
        }
                
    }
?>
    <script src="<?= PROOT; ?>assets/js/jquery.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/jquery.slimscroll.min.js"></script>



    <!-- Theme JS -->
    <script src="<?= PROOT; ?>assets/js/theme.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/plyr.min.js"></script>
</body>
</html>