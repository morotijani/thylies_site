<?php 

    // USER VERIFY

    require_once ('../connection/conn.php');

    if (user_is_logged_in()) {
        redirect(PROOT . 'user/index');
    }

    if (isset($_GET['vericode'])) {

        $vericode = sanitize($_GET['vericode']);
        $success = false;
        $msg = "Something has gone wrong or your account is already verified.";
        if($vericode) {
            $sql = "
                SELECT * FROM thylies_user 
                WHERE user_verified = 0 
                AND user_vericode = :user_vericode
            ";
            $statement = $conn->prepare($sql);
            $statement->execute([':user_vericode' => $vericode]);
            $result = $statement->fetchAll();
            foreach ($result as $user) {
                $sql = "
                    UPDATE thylies_user 
                    SET user_verified = 1 
                    WHERE user_id = :user_id";
                $statement = $conn->prepare($sql);
                $success = $statement->execute([':user_id' => $user["user_id"]]);

                if($success) {
                    $msg = "Your account has been verified! Please log in.";
                }
            }

        }
        
    } else {
        redirect(PROOT.'shop/index');
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
    <title>Email Verification - Thylies</title>
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
                        <h1 class="mb-1 text-center h3">EMAIL VERIFICATION.</h1>
                        <p class="mb-4 text-center"><?= $msg; ?>.</p>
                        <div class="text-center">
                            <a href="<?= PROOT; ?>auth/login" class="btn btn-warning">Log in</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= PROOT; ?>assets/js/jquery.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/theme.min.js"></script>

</body>
</html>
