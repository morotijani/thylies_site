<?php 
	// SUBSCRIBE 
	
    require_once $_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php";

	if (isset($_POST['email'])) {
		$email = sanitize($_POST['email']);
		$subscription_id = guidv4();
		$output = '';

		$select = "
			SELECT * FROM thylies_subscription 
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
            $subject = "Thylies Subscription.";
            $body = "
                <h3>Hello
                    {$to},</h3>
                    <p>
                        Thank you for subscribing to Thylies Ghana. 
                        <br>You will get notified on whats going on and daily new motivational & inspiration tips.
                    </p>
                    <p>
						Sincerely, <br>
						Thylies Ghana.
                    </p>
            ";
			$mail_result = send_email($to, $to, $subject, $body);
			if ($mail_result) {
				$query = "
					INSERT INTO thylies_subscription (subscription_id, subscription_email) 
					VALUES (:subscription_id, :subscription_email)
				";
				$statement = $conn->prepare($query);
				$result = $statement->execute([':subscription_id' => $subscription_id, ':subscription_email' => $email]);
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