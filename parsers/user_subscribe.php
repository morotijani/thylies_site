<?php 
	// SUBSCRIBE 
	
	require_once $_SERVER['DOCUMENT_ROOT'] . "/thylies_site/db_connection/conn.php";

	if (isset($_POST['email'])) {
		$email = sanitize($_POST['email']);
		$output = '';

		$select = "
			SELECT * FROM mifo_subscription 
			WHERE subscription_email = :subscription_email 
			LIMIT 1
		";
		$statement = $conn->prepare($select);
		$statement->execute(['subscription_email' => $email]);
		$row_count = $statement->rowCount();

		if ($row_count > 0) {
			$output = 'This email '. $email . ' has already subscribed';
		} else {
			$to = $email;
            $subject = "Products Subscription.";
            $body = "
                <h3>Hello
                    {$to},</h3>
                    <p>
                        Thank you for subscribing to MIFO. You will be recieving notifications on any highly purchased products, featured products, and more.
                    </p>
                    <p>
						Sincerely, <br>
						MIFO.
                    </p>
            ";
			$mail_result = send_email($to, $to, $subject, $body);
			if ($mail_result) {
				$query = "
					INSERT INTO mifo_subscription (subscription_email) 
					VALUES (:subscription_email)
				";
				$statement = $conn->prepare($query);
				$result = $statement->execute([':subscription_email' => $email]);
				if ($result) {
					$output = 'Email subscribed successfully';
				}
				
            } else {
                echo "Message could not be sent.";
            }
			
		}
		echo $output;

	}









?>