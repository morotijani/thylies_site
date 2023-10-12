<?php 

// USER SIGNIN

require_once ('../connection/conn.php');

if (user_is_logged_in()) {
    redirect(PROOT . 'auth/index');
}


$errors = '';
$userId = issetElse($_SESSION, 'password_reset_user_id', 0);
$code = issetElse($_SESSION, 'password_reset_code_verified', 0);
if ($userId != 0 && $code != 0) {
    // code...

    $post = [];
    if ($_POST) {
        $post = cleanPost($_POST);
        $password = $post['password'];
        $confirm = $post['confirm'];

        //verification
        $required = ['password' => "Password", 'confirm' => "Confirm Password"];
        foreach ($required as $field => $display) {
            if (empty($post[$field])){
                $errors = '<div class="alert alert-secondary" role="alert">' . $display . ' is required.</div>';
            }
        }

        if ($userId == 0 || $code == 0) {
            $errors = '<div class="alert alert-secondary" role="alert">Something has gone wrong. Please try again.</div>';
        }

        if (strlen($password) < 6) {
            // code...
            $errors = '<div class="alert alert-secondary" role="alert">Password must not be less than 6.</div>';
        }

        if ($password !== $confirm) {
            $errors = '<div class="alert alert-secondary" role="alert">Your passwords do not match.</div>';
        }

        if(empty($errors)) {

            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $sql = "
                UPDATE thylies_user 
                SET user_password = :user_password 
                WHERE user_id = :user_id
            ";
            $statement = $conn->prepare($sql);
            $result = $statement->execute([
                ':user_password' => $hashed,
                ':user_id' => $userId
            ]);

            if ($result) {

                unset($_SESSION['password_reset_user_Id'], $_SESSION['password_reset_code_verified']);
                $expired = date("Y-m-d H:i:s", strtotime("-14 days"));

                $sql = "
                    DELETE FROM thylies_user_password_resets 
                    WHERE password_reset_user_id = :password_reset_user_id 
                    OR password_reset_created_at < :password_reset_created_at
                ";
                $statement = $conn->prepare($sql);
                $statement->execute(
                    array(
                        ':password_reset_user_id'   => $userId,
                        ':password_reset_created_at' => $expired
                    )
                );
                redirect(PROOT . 'auth/login');
            } else {
                $errors = '<div class="alert alert-secondary" role="alert">Something has gone wrong. Please try again.<div>';
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
    <title>Reset Password - Thylies</title>
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
                        <form method="POST" id="resetPasswordForm">
                            <h1 class="mb-1 text-center h3">Thylies</h1>
                            <p class="mb-4 text-center">Reset Password.</p>
                            <?= $errors; ?>
                            <div class="mb-3 mb-4">
                                <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
                            </div>
                            <div class="mb-3 mb-4">
                                <label for="confirm" class="form-label">Confirm Password<span class="text-danger">*</span></label>
                                <input type="password" id="confirm" name="confirm" class="form-control" placeholder="Password" required="">
                            </div>
                            <div class="d-grid">
                                <button class="g-recaptcha btn btn-warning" data-sitekey="<?= RECAPTCHA_SITE_KEY; ?>" data-callback='submit_resetpassword' data-action='submit' type="submit" name="submit_resetpassword" id="submit_resetpassword">Reset Password</button>
                            </div>
                            <div class="d-xxl-flex justify-content-between mt-4 ">
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


<?php 
    } else {
        redirect(PROOT . 'auth/reset-verify');
    }

?>

    <script src="<?= PROOT; ?>assets/js/jquery.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/theme.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <script>
        function submit_resetpassword(token) {
            $('#resetPasswordForm').submit();
        }
    </script>
</body>
</html>