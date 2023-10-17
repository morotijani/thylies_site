<?php

	// Connection To Database
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$conn = new PDO("mysql:host=$servername;dbname=thylies_site", $username, $password);


	function getBrowserAndOs() {

	    $user_agent = $_SERVER['HTTP_USER_AGENT'];
	    $browser = "N/A";

	    $browsers = array(
	        '/msie/i' => 'Internet explorer',
	        '/firefox/i' => 'Firefox',
	        '/safari/i' => 'Safari',
	        '/chrome/i' => 'Chrome',
	        '/edge/i' => 'Edge',
	        '/opera/i' => 'Opera',
	        '/mobile/i' => 'Mobile browser'
	    );

	    foreach ($browsers as $regex => $value) {
	        if (preg_match($regex, $user_agent)) { $browser = $value; }
	    }

	    $visitor_agent_division = explode("(", $user_agent)[1];
	    list($os, $division_two) = explode(")", $visitor_agent_division);

	    $refferer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

	    $visitor_broswer_os = array(
	        'browser' => $browser,
	        'operatingSystem' => $os,
	        'refferer' => $refferer
	    );

	    $output = json_encode($visitor_broswer_os);

	    return $output;
	}


	session_start();


	require_once($_SERVER['DOCUMENT_ROOT'].'/thylies_site/config.php');
 	require_once(BASEURL.'helpers/helpers.php');
 	require_once(BASEURL.'helpers/functions.php');


	// USER LOGIN
 	if (isset($_SESSION['THUser'])) {
 		$user_id = $_SESSION['THUser'];
 		$data = array(
 			':user_id' => $user_id,
 			':user_trash' => 0
 		);
 		$sql = "
 			SELECT * FROM thylies_user 
 			WHERE user_id = :user_id 
 			AND user_trash = :user_trash 
 			LIMIT 1
 		";
 		$statement = $conn->prepare($sql);
 		$statement->execute($data);
 		if ($statement->rowCount() > 0) {
	 		foreach ($statement->fetchAll() as $user_data) {
	 			$fn = explode(' ', $user_data['user_fullname']);
	 			$user_data['first'] = ucwords($fn[0]);
	 			$user_data['last'] = '';
	 			if (count($fn) > 1) {
	 				$user_data['last'] = ucwords($fn[1]);
	 			}
	 		}
 		} else {
 			unset($_SESSION['THUser']);
 			redirect(PROOT . 'auth/logout');
 		}

 	}

////////////////////////////////////////////////////////////////////////////////////////////////////////
 	// ADMIN LOGIN
 	if (isset($_SESSION['IQNadmin'])) {
 		$admin_id = $_SESSION['IQNadmin'];
 		$data = array(
 			':admin_id' => $admin_id
 		);
 		$sql = "
 			SELECT * FROM inqoins_admin 
 			WHERE admin_id = :admin_id 
 			LIMIT 1
 		";
 		$statement = $conn->prepare($sql);
 		$statement->execute($data);

 		foreach ($statement->fetchAll() as $admin_data) {
 			$admin_fullname = ucwords($admin_data['admin_fullname']);
 			$fn = explode(' ', $admin_data['admin_fullname']);
 			$admin_data['first'] = ucwords($fn[0]);
 			$admin_data['last'] = '';
 			if (count($fn) > 1) {
 				$admin_data['last'] = ucwords($fn[1]);
 			}
 		}
 	}


 	// Display on Messages on Errors And Success
 	$flash = '';
 	if (isset($_SESSION['flash_success'])) {
 	 	$flash = '
				<div class="alert alert-success my-2" role="alert" id="temporary">
				  	' . $_SESSION['flash_success'] . '
				</div>
 	 		';
 	 	unset($_SESSION['flash_success']);
 	}

 	if (isset($_SESSION['flash_error'])) {
 	 	$flash = '
				<div class="alert alert-danger my-2" role="alert" id="temporary">
				  	' . $_SESSION['flash_error'] . '
				</div>
 	 		';
 	 	unset($_SESSION['flash_error']);
 	}


