<?php 

	// Upload 

	require_once $_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php";

	if ($_FILES["passport"]["name"]  != '') {

		$test = explode(".", $_FILES["passport"]["name"]);

		$extention = end($test);

		$name = md5(microtime()) . '.' . $extention;

		$location = BASEURL . 'assets/media/scholarship/' . $name;

		//check if user dexist
		$move = move_uploaded_file($_FILES["passport"]["tmp_name"], $location);
		if ($move) {
			if ($conn->query("SELECT * FROM thylies_scholarship WHERE user_id = {$user_id} LIMIT 1")->rowCount() > 0) {
				$sql = "
					UPDATE thylies_scholarship 
					SET user_id = ?, student_picture = ? 
				";
			} else {
				$sql = "
					INSERT INTO thylies_scholarship (user_id, student_picture) 
					VALUES (?, ?)
				";
			}
			$statement = $conn->prepare($sql);
			$result = $statement->execute([$user_id, $name]);

			if (isset($result)) {
				echo '';
			}
		}
	}

