<?php 

    // PAY FOR REGISTRATION PAGE

    require_once ('../connection/conn.php');

    if (user_is_logged_in()) {
        if (check_payment_of_registration_fee($user_id)) {
            redirect(PROOT . 'user/index');
        }
    } else {
        redirect(PROOT . 'auth/logout');
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
    <title>Pay Registration - Thylies</title>
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
                            <h1 class="mb-1 text-center h3">Payment for registration.</h1>
                            <p class="mb-4 text-center">Any registered student is pay the amount of GHS101.00 access the platform.</p>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg btn-warning" onclick="payWithPaystack()"> Pay GHS101.00 </button>
                            </div>

                            <div class="d-xxl-flex justify-content-between mt-4">
                                <p class="font-14 mb-0">
                                    <a href="<?= PROOT; ?>auth/login">Cancel</a>
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
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        const paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener("submit", payWithPaystack, false);

        function payWithPaystack(e) {
            e.preventDefault();

            let handler = PaystackPop.setup({
                key: '<?= PAYSTACK_TEST_PUBLIC_KEY; ?>',
                email: '<?= $user_data['user_email']; ?>',
                amount: 101 * 100,
                currency: 'GHS',
                channels: ['card', 'bank', 'ussd', 'qr', 'mobile_money', 'bank_transfer'],
                ref: 'THY'+Math.floor((Math.random() * 1000000000) + 1),
                // label: "Optional string that replaces customer email",
                metadata: {
                    "user_id": '<?= $user_data['user_unique_id']; ?>',
                    "user_name" : '<?= $user_data['user_fullname']; ?>',
                    "user_gender" : '<?= $user_data['user_gender']; ?>'
                },
                onClose: function() {
                    alert('Window closed.');
                },
                callback: function(response){
                    let message = 'Payment complete! Reference: ' + response.reference;
                    alert(message);

                    $.ajax ({
                        url: '<?= PROOT; ?>parsers/pay.register.php',
                        method : 'POST',
                        data: { 
                            reference : response.reference
                        },
                        success : function(data) {
                            if (data == '') {
                                window.location = '<?= PROOT; ?>auth/registration-paid';
                            }
                        }
                    });
                }
            });
            handler.openIframe();
        }
    </script>
</body>
</html>