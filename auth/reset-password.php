<?php 

// USER SIGNIN

require_once ('../db_connection/conn.php');
$nav = 0;
include ('inc/header-topnav.inc.php');

if (user_is_logged_in()) {
    redirect(PROOT . 'shop/index');
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

        if ($password !== $confirm) {
            $errors = '<div class="alert alert-secondary" role="alert">Your passwords do not match.</div>';
        }

        if(empty($errors)) {

            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $sql = "
                UPDATE mifo_user 
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
                    DELETE FROM mifo_user_password_resets 
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
                redirect(PROOT . 'shop/login');
            } else {
                $errors = '<div class="alert alert-secondary" role="alert">Something has gone wrong. Please try again.<div>';
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
                            <a class="text-gray-400" href="<?= PROOT; ?>shop/index">Shop</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Reset Password
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
                    <h4 class="mb-4 text-center">Reset Password.</h4>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                   <form method="POST">
                        <?= $errors; ?>
                        <div class="form-group mb-2">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                        </div>

                        <div class="form-group mb-2">
                            <label for="confirm">Confirm Password</label>
                            <input type="password" name="confirm" id="confirm" placeholder="Confirm Password" class="form-control">
                        </div>

                        <div>
                            <a href="<?= PROOT; ?>shop/login" class="btn btn-secondary">Cancel</a>
                            <button class="btn btn-outline-dark" type="submit">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


<?php 
    } else {
        redirect(PROOT . 'shop/reset-verify');
    }

    $follow = 0;
    include ('inc/footer.inc.php'); 
?>