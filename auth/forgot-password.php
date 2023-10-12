<?php 

// USER forget password

require_once ('../db_connection/conn.php');
$nav = 0;
include ('inc/header-topnav.inc.php');

if (user_is_logged_in()) {
    redirect(PROOT . 'index');
}

    $errors = '';
    if($_POST) {
        $email = sanitize($_POST['email']);
        //validation
        if(empty($email)) {
            $errors = '<div class="alert alert-secondary" role="alert">Email is required.</div>';
        }

        if(empty($errors)) {
            $sql = "
                SELECT * FROM mifo_user 
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
                        INSERT INTO mifo_user_password_resets (password_reset_created_at, password_reset_user_id, password_reset_verify) 
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
                        redirect(PROOT . 'mifo/reset-verify');
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

    <!-- BREADCRUMB -->
    <nav class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb mb-0 fs-xs text-gray-400">
                        <li class="breadcrumb-item">
                            <a class="text-gray-400" href="<?= PROOT; ?>shop/index">Shop</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Login
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- CONTENT -->
    <section class="pt-7 pb-12">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Heading -->
                    <h3 class="text-center">MIFO.</h3>
                    <h4 class="mb-6 text-center">Reset Your Password.</h4>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <!-- Form -->
                    <form method="POST">
                        <?= $errors; ?>
                        <!-- Email -->
                        <div class="form-group mb-4">
                            <label class="visually-hidden" for="email">
                                Your Email *
                            </label>
                            <input class="form-control" id="email" name="email" type="email" placeholder="Your Email *" required>
                        </div>
                         <a href="<?= PROOT; ?>shop/login" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-outline-dark">Recover Password</button>
                    </form>
                </div>
            </div>
        </div>
    </section>


<?php $follow = 0; include ('inc/footer.inc.php'); ?>