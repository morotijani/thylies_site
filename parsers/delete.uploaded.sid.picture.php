<?php 

	// DELETE 

	require_once $_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php";

	if (isset($_POST['tempuploded_file_id'])) {

		$tempuploded_img_id_filePath = BASEURL . 'assets/media/student-in-business/' . $_POST['tempuploded_file_id'];

		$unlink = unlink($tempuploded_img_id_filePath);
		if ($unlink) {
			$sql = "
				UPDATE thylies_student_in_business 
				SET student_picture = ? 
				WHERE user_id = ?
			";
			$statement = $conn->prepare($sql);
			$result = $statement->execute(['', $user_id]);
			if (isset($result)) {
				echo '';
			}
		}
	}

