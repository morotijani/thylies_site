<?php 

// RESET VERIFY EMAIL PAGE

require_once ('../db_connection/conn.php');
$nav = 0;
include ('inc/header-topnav.inc.php');

if (user_is_logged_in()) {
    redirect(PROOT . 'shop/index');
}

$userId = issetElse($_SESSION, 'password_reset_user_id', 0);
if ($userId != 0 && !empty($userId)) {
    	// code...
	$errors = '';
  	if ($_POST) {
    	$code = sanitize($_POST['code']);
    	$now = date("Y-m-d H:i:s");
    	$userId = issetElse($_SESSION, 'password_reset_user_id', 0);
		// validation
		if(empty($code)) {
		  	$errors = '<div class="alert alert-secondary" role="alert">Please enter your 6 digit code.</div>';
		}

	    if(empty($errors)) {
	      	$sql = "
	      		SELECT * FROM mifo_user_password_resets 
	      		WHERE password_reset_verify = :password_reset_verify 
	      		AND password_reset_user_id = :password_reset_user_id 
	      		ORDER BY password_reset_id DESC LIMIT 1
	      	";
	      	$statement = $conn->prepare($sql);
	      	$statement->execute([
	      		':password_reset_verify' => $code,
	      		':password_reset_user_id' => $userId
	      	]);
	      	$result = $statement->fetchAll();
	      	foreach ($result as $reset) {
	      		# code...
	      	}
	      	if (!$result) {
	        	$errors = '<div class="alert alert-secondary" role="alert">The code you entered is incorrect or has expired.</div>';
	      	} else {
	        	$expireTime = date("Y-m-d H:i:s", strtotime($reset['password_reset_created_at'] . " +10 minutes"));
	        	$expired = strtotime($now) > strtotime($expireTime); 
	  
	        	if ($expired) {
	          		$errors = '<div class="alert alert-secondary" role="alert">Your code has expired. Please try again.</div>';
	        	} else {
		          	$_SESSION['password_reset_code_verified'] = $code;
		          	redirect(PROOT . 'shop/reset-password');
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

    <section class="pt-7 pb-12">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Heading -->
                    <h3 class="text-center">MIFO.</h3>
                    <h4 class="mb-4 text-center">Please Enter Your 6 digit code.</h4>
					<p class="text-center">A 6 digit code has been sent to your email address.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">

					<form method="POST">
						<p class="text-danger"><?= $errors; ?></p>
					  	<div class="form-group">
					    	<label for="code">6 Digit Verification Code</label>
					    	<input type="text" name="code" id="code" class="form-control" placeholder="Verify">
					  	</div>

					  	<div class="mt-2">
					    	<a href="<?= PROOT; ?>shop/login" class="btn btn-secondary">Cancel</a>
					    	<button class="btn btn-outline-dark" type="submit">Verify</button>
					  	</div>
					</form>
					<br>
					<p>
						Resend Code? <a href="<?= PROOT; ?>shop/forgot-password">Try Again</a>
						<br>
						<a href="<?= PROOT; ?>shop/login">Log In</a>
					</p>
				</div>
			</div>
		</div>
	</section>
<?php 
	} else {
		redirect(PROOT . 'shop/forgot-password');
	} 

	$follow = 0; include ('inc/footer.inc.php');
?>