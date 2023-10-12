<?php 

// USER SIGNIN

require_once ('../connection/conn.php');

if (user_is_logged_in()) {
    redirect(PROOT . 'shop/index');
}

$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
$email = trim($email);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$hashed = password_hash($password, PASSWORD_BCRYPT);
$errors = '';

if (isset($_POST['submit_login'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $errors = 'You must provide email and password';
    }

    $query = "
        SELECT * FROM mifo_user 
        WHERE user_email = :user_email 
        LIMIT 1
    ";
    $statement = $conn->prepare($query);
    $statement->execute(
        array(
            ':user_email' => $email
        )
    );
    if ($statement->rowCount() < 1) {
        $errors = 'That email does\'nt exist in our database.';
    } else {
        foreach ($statement->fetchAll() as $row) {
            if ($row['user_trash'] == 0) {
                if ($row['user_verified'] != 1) {
                    redirect(PROOT.'shop/resend-vericode');
                } else {
                    if (!password_verify($password, $row['user_password'])) {
                        $errors = 'User cannot be found.';
                    } else {
                        if (!empty($errors)) {
                            $errors;
                        } else {
                            $user_id = $row['user_id'];
                            userLogin($user_id);
                        }
                    }
                }
            } else {
                $errors = 'User account Terminated.';
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
    <title>Verify Email - Thylies</title>
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="<?= PROOT; ?>assets/media/logo/favicon.ico">

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
                        <h1 class="mb-1 text-center h3">VERIFY YOUR EMAIL.</h1>
                        <p class="mb-4 text-center">A verification link has been sent to your email account. Please check your <b>spam folder</b> if not found in your <b>inbox</b> to verify your Thylies account.</p>
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