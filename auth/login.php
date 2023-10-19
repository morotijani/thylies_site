<?php 

// USER SIGNIN

require_once ('../connection/conn.php');
$nav = 0;

if (user_is_logged_in()) {
    redirect(PROOT . 'user/index');
}

$email = ((isset($_POST['email'])) ? sanitize($_POST['email']):'');
$email = trim($email);
$password = ((isset($_POST['password'])) ? sanitize($_POST['password']):'');
$password = trim($password);
$hashed = password_hash($password, PASSWORD_BCRYPT);
$errors = '';

if ($_POST) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $errors = '<div class="alert alert-secondary" role="alert">You must provide email and password</div>';
    }

    $query = "
        SELECT * FROM thylies_user 
        WHERE user_email = :user_email 
        OR user_index_number = :user_index_number
        LIMIT 1
    ";
    $statement = $conn->prepare($query);
    $statement->execute(
        array(
            ':user_email'       => $email,
            ':user_index_number' => $email
        )
    );
    if ($statement->rowCount() < 1) {
        $errors = '<div class="alert alert-secondary" role="alert">That email or index number does\'nt exist in our database.</div>';
    } else {
        foreach ($statement->fetchAll() as $row) {
            if ($row['user_trash'] == 0) {
                // if ($row['user_verified'] != 1) {
                //     redirect(PROOT.'shop/resend-vericode');
                // } else {
                    if (!password_verify($password, $row['user_password'])) {
                        $errors = '<div class="alert alert-secondary" role="alert">User cannot be found.</div>';
                    } else {
                        if (!empty($errors)) {
                            $errors;
                        } else {
                            $user_id = $row['user_id'];
                            userLogin($user_id);
                        }
                    }
                // }
            } else {
                $errors = '<div class="alert alert-secondary" role="alert">User account Terminated.</div>';
            }
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
                        <form method="POST" id="loginForm">
                            <h1 class="mb-1 text-center h3">Welcome</h1>
                            <p class="mb-4 text-center">Sign in using your thylies credentials.</p>
                            <?= $errors; ?>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email / Index number<span class="text-danger">*</span> </label>
                                <input type="text" id="email" class="form-control" name="email" placeholder="Enter either index number or email address"
                                    required="" autocomplete="off">
                            </div>
                            <div class="mb-3 mb-4">
                                <label for="password" class="form-label">Password<span
                                        class="text-danger">*</span></label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                                    required="">
                            </div>
                            <div class="d-grid">
                                <button class="g-recaptcha btn btn-warning" data-sitekey="<?= RECAPTCHA_SITE_KEY; ?>" data-callback='submit_signup' data-action='submit' type="submit" name="submit_login" id="submit_login">Sign in</button>
                            </div>
                            <div class="d-xxl-flex justify-content-between mt-4 ">
                                <p class="text-muted font-14 mb-0">
                                    Don't have an account yet? <a href="<?= PROOT; ?>auth/join">Sign up</a>
                                </p>
                                <p class="font-14 mb-0">
                                    <a href="<?= PROOT; ?>auth/forgot-password">Forget Password</a>
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

    <script>
        function submit_signup(token) {
            $('#loginForm').submit();
        }
    </script>
</body>
</html>