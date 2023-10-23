<?php 
	//  
	
	require_once ($_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php");

	$output = '';
	if (isset($_POST['reference'])) {
		$reference = sanitize($_POST['reference']);
		$email = sanitize($_POST['email']);
		$scholarship_id = sanitize($_POST['scholarship_id']);
		$createdAt = date("Y-m-d H:m:s");

		if ($conn->query("SELECT * FROM thylies_scholarship WHERE scholarship_id = '".$scholarship_id."' LIMIT 1")->rowCount() > 0) {
			$sql = "
				INSERT INTO thylies_transactions (transaction_id, from_id, transaction_service, status, createdAt) 
				VALUES (?, ?, ?, ?)
			";
			$statement = $conn->prepare($sql);
			$result = $statement->execute([$reference, $scholarship_id, 'scholarship', 1, $createdAt]);

			if (isset($result)) {
				$_SESSION['pay_id'] = $reference;

				foreach ($conn->query("SELECT * FROM thylies_scholarship WHERE scholarship_id = '".$scholarship_id."' LIMIT 1")->fetchAll() as $key) {
					// code...
					if ($conn->query("SELECT * FROM thylies_user WHERE user_unique_id = '".$key['user_id']."' AND user_email = NULL OR user_email = '' LIMIT 1")->rowCount() > 0) {
						$updateQuery = "
							UPDATE thylies_user 
							SET user_email = ? 
							WHERE user_unique_id = ?
						";
						$statement = $conn->prepare($updateQuery);
						$statement->execute([$email, $key['user_id']]);
					}
				}

				echo '';
			} else {
				echo 'Something went wrong';
			}
		}
	}

