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

    <!-- BREADCRUMB -->
    <nav class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <!-- Breadcrumb -->
                    <ol class="breadcrumb mb-0 fs-xs text-gray-400">
                        <li class="breadcrumb-item">
                            <a class="text-gray-400" href="<?= PROOT; ?>shop/index">Account</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Verify
                        </li>
                    </ol>

                </div>
            </div>
        </div>
    </nav>
    
        <!-- hero -->
    <section class="pt-7 pb-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <h2>MIFO.</h2>
                    <h3>VERIFY YOUR EMAIL.</h3>
                    <h5 class="text-secondary">A verification link has been sent to your email account. Please check your <b>spam folder</b> if not found in your <b>inbox</b> to verify your Gary Pie account.</h5>
                </div>
            </div>
        </div>
    </section>


<?php $follow = 0; include ('inc/footer.inc.php'); ?>