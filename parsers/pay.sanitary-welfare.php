<?php 
	//  
	
	require_once ($_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php");

	$output = '';
	if (isset($_POST['reference'])) {
		$reference = sanitize($_POST['reference']);
		$email = sanitize($_POST['email']);
		$sw_id = sanitize($_POST['sw_id']);
		$createdAt = date("Y-m-d H:m:s");

		if ($conn->query("SELECT * FROM thylies_sanitary_welfare WHERE sw_id = '".$sw_id."' LIMIT 1")->rowCount() > 0) {
			$sql = "
				INSERT INTO thylies_transactions (transaction_id, from_id, transaction_service, status, createdAt) 
				VALUES (?, ?, ?, ?, ?)
			";
			$statement = $conn->prepare($sql);
			$result = $statement->execute([$reference, $sw_id, 'sanitarywelfare', 1, $createdAt]);

			if (isset($result)) {
				$_SESSION['pay_id'] = $reference;

				foreach ($conn->query("SELECT * FROM thylies_sanitary_welfare WHERE sw_id = '".$sw_id."' LIMIT 1")->fetchAll() as $key) {
					// code...
					if ($conn->query("SELECT * FROM thylies_user WHERE user_unique_id = '".$key['user_id']."' LIMIT 1")->rowCount() > 0) {
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

