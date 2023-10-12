<?php 
	//  
	
	require_once ($_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php");

	$output = '';
	if (isset($_POST['reference'])) {
		$reference = sanitize($_POST['reference']);
		$createdAt = date("Y-m-d H:m:s");

		$sql = "
			INSERT INTO thylies_user_registration_transaction (transaction_id, user_id, status, createdAt) 
			VALUES (?, ?, ?, ?)
		";
		$statement = $conn->prepare($sql);
		$result = $statement->execute([$reference, $user_id, 1, $createdAt]);

		if (isset($result)) {
			$_SESSION['pay_id'] = $conn->lastInsertId();
			echo '';
		}
	}

