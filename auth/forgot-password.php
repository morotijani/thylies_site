<?php 

// USER forget password

require_once ('../connection/conn.php');

    if (user_is_logged_in()) {
        redirect(PROOT . 'user/index');
    }

    $errors = '';
    if($_POST) {
        $email = sanitize($_POST['email']);

        //validation
        if(empty($email)) {
            $errors = '<div class="alert alert-secondary" role="alert">Email is required.</div>';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // code...
            $errors = '<div class="alert alert-secondary" role="alert">Invalid email.</div>';
        }

        if(empty($errors)) {
            $sql = "
                SELECT * FROM thylies_user 
                WHERE user_email = :user_email 
                AND user_verified = :user_verified
                AND user_trash = :user_trash
            ";
            $statement = $conn->prepare($sql);
            $statement->execute([
                ':user_email' => $email, 
                ':user_trash' => 0, 
                ':user_verified' => 1
            ]);
            $user_result = $statement->fetchAll();

            if($statement->rowCount() > 0) {
                $code = rand(100001,999999);
                foreach ($user_result as $user_row) {
                    $email = $user_row['user_email'];
                    $user_id = $user_row['user_id'];
                    $time = date("Y-m-d H:i:s");
                }

                $name = ucwords($user_row["user_fullname"]);
                $to = $email;
                $subject = "Reset Your Password.";
                $body = "
                    <h3>{$name},</h3>
                    <p>Your verification code to reset your password is </p>
                    <p>{$code}</p>
                    <p>This code will expire in 10 minutes.</p>
                ";
                $mail_result = send_email($name, $to, $subject, $body);
                if ($mail_result) {
                    $query = "
                        INSERT INTO thylies_user_password_resets (password_reset_created_at, password_reset_user_id, password_reset_verify) 
                        VALUES (:password_reset_created_at, :password_reset_user_id, :password_reset_verify);
                    ";
                    $statement = $conn->prepare($query);
                    $result = $statement->execute(
                        array(
                            ':password_reset_created_at'    => $time,
                            ':password_reset_user_id'   => $user_id,
                            ':password_reset_verify'    => $code
                        )
                    ); 
                    if (isset($result)) {
                       // code...
                       $_SESSION['password_reset_user_id'] = $user_id;
                        redirect(PROOT . 'auth/reset-verify');
                    }   
                } else {
                    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    $errors = '<div class="alert alert-secondary" role="alert">Something went wrong... try agian.</div>';
                }
            } else {
                $errors = '<div class="alert alert-secondary" role="alert">Can not find user account.</div>';
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
                        <form method="POST" id="forgotPasswordForm">
                            <h1 class="mb-1 text-center h3">Thylies</h1>
                            <p class="mb-4 text-center">Reset Your Password.</p>
                            <?= $errors; ?>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span> </label>
                                <input type="email" id="email" class="form-control" name="email" placeholder="Email address"
                                    required="" autocomplete="off">
                            </div>
                            <div class="d-grid">
                                <button class="g-recaptcha btn btn-warning" data-sitekey="<?= RECAPTCHA_SITE_KEY; ?>" data-callback='submit_forgotpassword' data-action='submit' type="submit" name="submit_login" id="submit_login">Recover Password</button>
                            </div>
                            <div class="d-xxl-flex justify-content-between mt-4">
                                <p class="font-14 mb-0">
                                    <a href="<?= PROOT; ?>">Cancel</a>
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
        function submit_forgotpassword(token) {
            $('#forgotPasswordForm').submit();
        }
    </script>
</body>
</html>
