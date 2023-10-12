<?php 
	// USER SIGNUP 
	
	require_once ($_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php");

	$output = '';
	if (isset($_POST['user_email'])) {

	

		$fullname = sanitize($_POST['user_fullname']);
		$email = sanitize($_POST['user_email']);
		$password = sanitize($_POST['user_password']);
		$password_hash = password_hash($password, PASSWORD_BCRYPT);
		$gender = sanitize($_POST['user_gender']);

		$sql = "SELECT * FROM thylies_user WHERE user_email = :user_email";
		$statement = $conn->prepare($sql);
		$statement->execute([':user_email' => $email]);

		if ($statement->rowCount() > 0) {
			$output =  '<div class="alert alert-secondary" role="alert">User account already exist.<div>';
		} else {
			$vericode = md5(time());

			$fn = ucwords($fullname);
        	$to = $email;
         	$subject = "Please Verify Your Account.";
			$body = "
				<h3>
					{$fn},</h3>
					<p>
						Thank you for registering. Please verify your account by clicking 
          				<a href=\"https://sites.local/thylies_site/auth/verified/{$vericode}\" target=\"_blank\">here</a>.
        			</p>
        			<br>
        			<br>
        			Thylies Enterprise.
			";

			$mail_result = send_email($fn, $to, $subject, $body);
			if ($mail_result) {

				$data = [
					':user_fullname'		=> $fullname,
					':user_email'			=> $email,
					':user_password'		=> $password_hash,
					':user_gender'		=> $user_gender
				];
				$query = "
					INSERT INTO thylies_user (user_fullname, user_email, user_password, user_gender ) 
					VALUES (:user_fullname, :user_email, :user_password, :user_gender ); 
				";
				$statement = $conn->prepare($query);
				$result = $statement->execute($data);
				$user_id = $conn->lastInsertId();

				if (isset($result)) {
			      	$sql = "
			      		UPDATE thylies_user 
			      		SET user_vericode = :user_vericode 
			      		WHERE user_id = :user_id
			      	";
			      	$statement = $conn->prepare($sql);
			      	$sub_result = $statement->execute([
			      		':user_vericode' => $vericode,
			      		':user_id' => $user_id
			      	]);
			      	if ($sub_result) {
			      		// code...
			      		$output = 'ok';
			      	}
				}
			} else {
			    //$output =  "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			    $output =  '<div class="alert alert-secondary" role="alert">Message could not be sent, please try again</div>';
			}
		}
		echo $output;
	}

?>