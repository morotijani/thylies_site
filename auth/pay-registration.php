<?php 

// RESET VERIFY EMAIL PAGE

require_once ('../connection/conn.php');

if (user_is_logged_in()) {
    redirect(PROOT . 'user/index');
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
    <title>Sign in - Thylies</title>
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
                        <form method="POST" id="forgotPasswordForm">
                            <h1 class="mb-1 text-center h3">Please Enter Your 6 digit code.</h1>
                            <p class="mb-4 text-center">A 6 digit code has been sent to your email address.</p>
                            <?= $errors; ?>
                            <div class="mb-3">
                                <label for="code" class="form-label">6 Digit Verification Code<span class="text-danger">*</span> </label>
                                <input type="text" id="code" class="form-control" name="code" placeholder="Verify" required="" autocomplete="off">
                            </div>
                            <div class="d-grid">
                                <button class="g-recaptcha btn btn-warning" data-sitekey="<?= RECAPTCHA_SITE_KEY; ?>" data-callback='submit_forgotpassword' data-action='submit' type="submit" name="submit_login" id="submit_login">Verify</button>
                                <a href="<?= PROOT; ?>auth/login" >Cancel</a>
                            </div>
                            <div class="d-xxl-flex justify-content-between mt-4">
                                 <p class="text-muted font-14 mb-0">
                                    Resend Code? <a href="<?= PROOT; ?>auth/forgot-password">Try Again</a>
                                </p>
                                <p class="font-14 mb-0">
                                    <a href="<?= PROOT; ?>auth/login">Login</a>
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

<?php 
	} else {
		redirect(PROOT . 'auth/forgot-password');
	} 
?>


    <script src="<?= PROOT; ?>assets/js/jquery.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/theme.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <script>
        function submit_forgotpassword(token) {
            $('#forgotPasswordForm').submit();
        }
    </script>
</body>
</html>