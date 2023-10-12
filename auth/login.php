<?php 

// USER SIGNIN

require_once ('../db_connection/conn.php');
$nav = 0;
include ('inc/header-topnav.inc.php');

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
        $errors = '<div class="alert alert-secondary" role="alert">You must provide email and password</div>';
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
        $errors = '<div class="alert alert-secondary" role="alert">That email does\'nt exist in our database.</div>';
    } else {
        foreach ($statement->fetchAll() as $row) {
            if ($row['user_trash'] == 0) {
                if ($row['user_verified'] != 1) {
                    redirect(PROOT.'shop/resend-vericode');
                } else {
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
                }
            } else {
                $errors = '<div class="alert alert-secondary" role="alert">User account Terminated.</div>';
            }
        }
    }

}


?>

    <section class="py-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 px-0">
                    <div class="sticky-top vh-lg-100 py-9">
                        <div class="bg-holder" style="background-image:url(../assets/media/bg-2.jpg);" data-zanim-trigger="scroll" data-zanim-lg='{"animation":"zoom-out-slide-right","delay":0.4}'></div>
                    </div>
                </div>
                <div class="col-lg-6 py-6">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-sm-8 col-md-6 col-lg-10 col-xl-8" data-zanim-xs='{"delay":0.5,"animation":"slide-right"}' data-zanim-trigger="scroll">
                            <h3 class="display-4 fs-2"><span class="fs-4">MIFO</span>. <br>LOGIN</h3>
                            <h6 class="text-secondary mt-3">A Brand That Is Here To Take You Through A Journey Of Historic Culture And Unique Way Of Life.</h6>
                            <form class="mt-5" method="POST" action="login.php" id="loginForm">
                                <?= $errors; ?>
                                <div class="mb-3">
                                    <input class="form-control bg-light" type="email" id="email" name="email" placeholder="Email" />
                                </div>
                                <div class="mb-0">
                                    <input class="form-control bg-light" type="password" id="password" name="password" placeholder="Password" />
                                </div>
                                <div class="mb-3 d-grid">
                                    <button class="btn btn-dark mt-3" type="submit" name="submit_login" id="submit_login">sign in</button>
                                </div>
                                <br><br>
                                <a href="<?= PROOT; ?>shop/forgot-password" class="text-dark text-decoration-underline">I have forgotten my password.</a> <br>
                                <a href="<?= PROOT; ?>shop/signup" class="text-dark text-decoration-underline">Creat an account.</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $follow = 0; include ('inc/footer.inc.php'); ?>