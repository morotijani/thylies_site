<?php 

	// RESEND VERIFY EMAIL PAGE

require_once ('../db_connection/conn.php');
$nav = 0;
include ('inc/header-topnav.inc.php');


if (user_is_logged_in()) {
    redirect(PROOT . 'shop/index');
}

	$errors = '';
	if($_POST) {
	    $email = sanitize($_POST['email']);
	    //validation
	    if(empty($email)) {
	      	$errors = '<div class="alert alert-secondary" role="alert">Email is required.</div>';
	    }

	    if(empty($errors)) {
	      	$user = findUserByEmail($email);
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
	      		':user_verified' => 0
	      	]);

	      	if($statement->rowCount() > 0) {
	      		$vericode = md5(time());

	      		foreach ($statement->fetchAll() as $sub_row) {
	      			// code...
	      		}
	      		$name = ucwords($sub_row['user_fullname']);
	      		$to = $sub_row['user_email'];
	         	$subject = "Please Verify Your Account.";
				$body = "
					<h3>
						{$name},</h3>
						<p>
							Thank you for registering. Please verify your account by clicking 
	          				<a href=\"https://sites.local/mifo/shop/verified/{$vericode}\" target=\"_blank\">here</a>.
	        		</p>
				";
				$mail_result = send_email($name, $to, $subject, $body);
				if ($mail_result) {
			      	$sql = "
			      		UPDATE mifo_user 
			      		SET user_vericode = :user_vericode 
			      		WHERE user_email = :user_email
			      	";
			      	$statement = $conn->prepare($sql);
			      	$result = $statement->execute([
			      		':user_vericode' => $vericode,
			      		':user_email' => $email
			      	]);
			      	echo '<script>alert("Check your email for reverification link");</script>';
			      	redirect(PROOT . 'shop/login');
				} else {
				    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				   	$errors = '<div class="alert alert-secondary" role="alert">Message could not be sent... check your internet or try again later.</div>';

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

                    <!-- Breadcrumb -->
                    <ol class="breadcrumb mb-0 fs-xs text-gray-400">
                        <li class="breadcrumb-item">
                            <a class="text-gray-400" href="<?= PROOT; ?>shop/index">Account</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Resend Verification Code
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
					<h3>Resend Verification Email</h3>
					<p>You must verify your account before logging in. Please check your inbox and spam folders. If you did not receive the verification email you may request a new verification email below.</p>
					<form action="resend-vericode" method="POST">
						<p class="text-danger"><?= $errors; ?></p>
						<div class="form-group">
						    <label for="email">Email</label>
						    <input type="email" name="email" id="email" class="form-control" value="" placeholder="Email">
						</div>

						<div class="mt-4">
						    <a href="<?= PROOT; ?>store/login" class="btn btn-secondary">Cancel</a>
						    <button type="submit" class="btn btn-outline-dark">Resend Verification Email</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>



<?php $follow = 0; include ('inc/footer.inc.php'); ?>


