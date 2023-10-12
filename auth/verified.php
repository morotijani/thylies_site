<?php 

// USER VERIFY

require_once ('../db_connection/conn.php');
$nav = 0;
include ('inc/header-topnav.inc.php');


if (user_is_logged_in()) {
    redirect(PROOT . 'shop/index');
}

    if (isset($_GET['vericode'])) {

        $vericode = sanitize($_GET['vericode']);
        $success = false;
        $msg = "Something has gone wrong or your account is already verified.";
        if($vericode) {
            $sql = "
                SELECT * FROM mifo_user 
                WHERE user_verified = 0 
                AND user_vericode = :user_vericode
            ";
            $statement = $conn->prepare($sql);
            $statement->execute([':user_vericode' => $vericode]);
            $result = $statement->fetchAll();
            foreach ($result as $user) {
                $sql = "
                    UPDATE mifo_user 
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
                            Verified
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
                    <span class="eyebrow decorated mb-1">EMAIL VERIFICATION</span>
                    <h1 class="mb-2"><?= $msg; ?></h1>
                    <a href="<?= PROOT; ?>shop/login">Log in</a>
                </div>
            </div>
        </div>
    </section>


<?php $follow = 0; include ('inc/footer.inc.php'); ?>