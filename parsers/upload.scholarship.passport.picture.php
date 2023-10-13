<?php 

	// Upload Post Image And Save To Draft 

	require_once $_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php";

	if ($_FILES["passport"]["name"]  != '') {

		$test = explode(".", $_FILES["passport"]["name"]);

		$extention = end($test);

		$name = md5(microtime()) . '.' . $extention;

		$location = BASEURL . 'assets/media/scholarship/' . $name;

		$move = move_uploaded_file($_FILES["passport"]["tmp_name"], $location);
		if ($move) {
			$sql = "
				INSERT INTO thylies_scholarship (user_id, student_picture) 
				VALUES (?, ?)
			";
			$statement = $conn->prepare($sql);
			$result = $statement->execute([$user_id, $name]);

			if (isset($result)) {
				// code...
				echo '
					<img src="' . PROOT . 'assets/media/scholarship/'.$name.'" id="img-uploaded" class="avatar-xl rounded-circle " alt="">
				';
			}
		}
	}

