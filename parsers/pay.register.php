<?php 
	//  
	
	require_once ($_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php");

	$output = '';
	if (isset($_POST['reference'])) {
		$reference = sanitize($_POST['reference']);
		$scholarship_id = sanitize($_POST['scholarship_id']);
		$createdAt = date("Y-m-d H:m:s");

		$sql = "
			INSERT INTO thylies_scholarship_transaction (transaction_id, scholarship_id, status, createdAt) 
			VALUES (?, ?, ?, ?)
		";
		$statement = $conn->prepare($sql);
		$result = $statement->execute([$reference, $scholarship_id, 1, $createdAt]);

		if (isset($result)) {
			$_SESSION['pay_id'] = $reference;
			echo '';
		}
	}

