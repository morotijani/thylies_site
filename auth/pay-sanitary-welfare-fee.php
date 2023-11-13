<?php 

    // PAY FOR REGISTRATION PAGE

    require_once ('../connection/conn.php');

    if (user_is_logged_in()) {
        if (check_payment_of_sanitary_welfare_fee($user_id)) {
            redirect(PROOT . 'user/index');
        }
    } else {
        redirect(PROOT . 'auth/logout');
    }
    
    //  
    $authSW = issetElse($_SESSION, 'auth-scholarship', 0);
    if ($authSW == 0 && empty($authSW)) {
        redirect(PROOT . 'auth/auth-sanitary-welfare-status/' . $id);
    }
    
    if (isset($_GET['scholarship'])) {
        $id = sanitize($_GET['scholarship']);

        // check if id exist in scholarship table
        $sql = "
            SELECT * FROM thylies_sanitary_welfare 
            WHERE sw_id = ? 
            AND status = ? AND 
            percentage > ? 
            LIMIT 1
        ";
        $statement = $conn->prepare($sql);
        $statement->execute([$id, 1, 0]);
        $row = $statement->fetchAll();
        $count_row = $statement->rowCount();
        if ($count_row > 0) {
            if ($conn->query("SELECT * FROM thylies_transactions WHERE from_id = '" . $id . "' AND transaction_service = 'sanitarywelfare' AND status = 1")->rowCount() > 0) {
                redirect(PROOT . 'user/sanitary-welfare-status');
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sign in Page - Coach">
    <meta name="keywords" content="">
    <meta name="author" content="Codescandy">
    <title>Pay Sanitary Welfare Fees - Thylies</title>
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
<body class="bg-light">

    <div class="d-flex align-items-center position-relative vh-100">
        <div class="container">
            <div class="row g-0">
                <div class="col-md-8 col-lg-7 col-xl-6 offset-md-2 offset-lg-2 offset-xl-3 space-top-3 space-lg-0">
                    <a href="<?= PROOT; ?>" class="mb-4 d-flex justify-content-center">
                        <img src="<?= PROOT; ?>assets/media/logo/logo.jpg" alt="logo">
                    </a>

                     <div class="bg-white p-4 p-xl-6 p-xxl-8 p-lg-4 rounded-3 border">
                        <form id="paymentForm">
                            <h1 class="mb-3 text-center h3">Sanitary Welfare status.</h1>
                            <p class="mb-4 text-center">Hello <b><?= ucwords($row[0]["name_of_student"]); ?></b> you have been granted Sanitary Welfare. You are to pay the sum of GHS101.00 to access and download your receipt.</p>
                            
                            <div class="mb-4">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" placeholder="Enter email here.." class="form-control" value="<?= (user_is_logged_in() ? $user_data["user_email"] : '') ?>" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg btn-warning" onclick="payWithPaystack()"> Pay GHS101.00 </button>
                            </div>

                            <div class="d-xxl-flex justify-content-between mt-4">
                                <p class="font-14 mb-0">
                                    <a href="<?= PROOT; ?>scholarship-list">Go back</a>
                                </p>
                            </div>
                        </form>
                    </div>
                    <div class="mt-3 nav-footer-links">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="<?= PROOT; ?>privacy-policy">Privacy Policy </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= PROOT; ?>terms">Terms & Conditions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="<?= PROOT; ?>assets/js/jquery.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/theme.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=<?= RECAPTCHA_SITE_KEY; ?>"></script>

    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        const paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener("submit", payWithPaystack, false);

        function payWithPaystack(e) {
            e.preventDefault();

            let handler = PaystackPop.setup({
                key: '<?= PAYSTACK_TEST_PUBLIC_KEY; ?>',
                email: $('#email').val(),
                amount: 101 * 100,
                currency: 'GHS',
                channels: ['card', 'bank', 'ussd', 'qr', 'mobile_money', 'bank_transfer'],
                ref: 'THY'+Math.floor((Math.random() * 1000000000) + 1),
                // label: "Optional string that replaces customer email",
                metadata: {
                    "sw_id": '<?= $row[0]['sw_id']; ?>',
                    "name_of_student" : '<?= $row[0]['name_of_student']; ?>',
                    "school" : '<?= $row[0]['school_name']; ?>',
                    "index_number" : '<?= $row[0]['index_number']; ?>'
                },
                onClose: function() {
                    alert('Window closed.');
                },
                callback: function(response){
                    let message = 'Payment complete! Reference: ' + response.reference;
                    alert(message);

                    $.ajax ({
                        url: '<?= PROOT; ?>parsers/pay.sanitary-welfare.php',
                        method : 'POST',
                        data: { 
                            reference : response.reference, 
                            email : $('#email').val(), 
                            sw_id : '<?= $id; ?>'
                        },
                        success : function(data) {
                            if (data == '') {
                                window.location = '<?= PROOT; ?>auth/paid-sanitary-welfare-fee';
                            }
                        }
                    });
                }
            });

            if ($('#email').val() == '') {
                $('#email').focus();
                return false;
            } else {
                handler.openIframe();
            }
        }
    </script>
</body>
</html>