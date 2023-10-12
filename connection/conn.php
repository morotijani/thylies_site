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

 	// USER LOGIN
 	if (isset($_SESSION['IQuser'])) {
 		$user_id = $_SESSION['IQuser'];
 		$data = array(
 			':user_id' => $user_id,
 			':user_trash' => 0,
 			':user_disable' => 0,
 		);
 		$sql = "
 			SELECT * FROM inqoins_user 
 			INNER JOIN inqoins_user_details 
 			ON inqoins_user_details.user_id = inqoins_user.user_id
 			WHERE inqoins_user.user_id = :user_id 
 			AND inqoins_user.user_trash = :user_trash 
 			AND inqoins_user.user_disable = :user_disable 
 			LIMIT 1
 		";
 		$statement = $conn->prepare($sql);
 		$statement->execute($data);
 		if ($statement->rowCount() > 0) {
	 		foreach ($statement->fetchAll() as $user_data) {
	 			$user_fullname = ucwords($user_data['user_fname'] . ' ' . $user_data['user_lname']);
	 			$user_nickname = ($user_data['user_nname'] != '') ? $user_data['user_nname'] : ucwords($user_data['user_fname']);
	 			$country = $user_data['user_country'];
	 			$email = $user_data['user_email'];
	 			$phone = $user_data['user_phone'];

	 			$accountActivationAlert = '
	 				<div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10">
			            <span class="svg-icon svg-icon-2hx svg-icon-danger me-4 mb-5 mb-sm-0">
			                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
			                    <path opacity="0.3" d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z" fill="black"></path>
			                    <path d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z" fill="black"></path>
			                </svg>
			            </span>
			            <div class="d-flex flex-column pe-0 pe-sm-10">
			                <h4 class="fw-bold">Verification</h4>
	 				';
	 			if ($user_data['user_phone_verified'] == 0 && $user_data['user_email_verified'] == 0) {
	 				$accountActivationAlert .= '
	 					<span>Verify your <b>mobile phone number and email account</b> to have a full Inqoins account. <a href="'.PROOT.'auth/verify-phone">Verify Phone number</a> / <a href="' . PROOT . 'account/settings?emaillink=1">Verify Email</a></span>
	 				';
	 			} elseif ($user_data['user_phone_verified'] == 0 && $user_data['user_email_verified'] == 1) {
	 				$accountActivationAlert .= '
	 					<span>Verify your <b>mobile phone number</b> to have a full Inqoins account. <a href="'.PROOT.'auth/verify-phone">Verify Phone number</a></span>
	 				';
	 			} elseif ($user_data['user_phone_verified'] == 1 && $user_data['user_email_verified'] == 0) {
	 				$accountActivationAlert .= '
	 					<span>Verify your <b>email account</b> to have a full Inqoins account. <a href="' . PROOT . 'account/settings?emaillink=1">Verify Email</a></span>
	 				';
	 			} elseif ($user_data['user_card_type'] == '' || $user_data['user_card_front'] == '' || $user_data['user_card_back'] == '' || $user_data['user_prove'] == '') {
	 				$accountActivationAlert .= '
	 					<span>Complete the KYC section. <a href="' . PROOT . 'account/settings">Complete here.</a></span>
	 				';
	 			} elseif ($user_data['user_verify'] == 0 && $user_data['user_phone_verified'] == 1 && $user_data['user_email_verified'] == 1) {
	 				$accountActivationAlert .= '
	 					<span>Your account will be verified after review.</span>
	 				';
	 			}
	 			$accountActivationAlert .= '
			            </div>
			            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
			                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
			                <span class="svg-icon svg-icon-1 svg-icon-danger">
			                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
			                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
			                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
			                    </svg>
			                </span>
			            </button>
			        </div>
	 			';
	 			if ($user_data['user_phone_verified'] == 1 && $user_data['user_email_verified'] == 1 && $user_data['user_verify'] == 1 && $user_data['user_card_type'] != '' && $user_data['user_card_front'] != '' && $user_data['user_card_back'] != '' && $user_data['user_prove'] != '') {
	 				$accountActivationAlert = '';
	 			}
	 		}

	 		$referral_code = $user_data['user_referralcode'];
	 		$referral_link = "https://sites.local/inqoins_with_bitnob/auth/signup?referral=" . $user_data['user_referralcode'];
	 		$referral_title = '';
	 		$referral_hashtags = urlencode('bitcoin,usdt,usdc,crypto,exchange,buy,sell,receive,send,earn,inqoins,inqoinspay,iqn,africa,ghana');
	 		$referral_text = urlencode("Refer new customers and start earning rewards.");
	 		$referral_qrcode = "https://chart.googleapis.com/chart?chs=400x400&cht=qr&chl=" . $referral_link;

 		} else {
 			unset($_SESSION['IQuser']);
 			echo '<script>window.location = "'.PROOT.'auth/login"</script>';
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
 	// if (isset($_SESSION['flash_success'])) {
 	//  	echo '<div id="temporary"><p class="text-center text-white bg-success">'.$_SESSION['flash_success'].'</p></div>';
 	//  	unset($_SESSION['flash_success']);
 	// }

 	// if (isset($_SESSION['flash_error'])) {
 	//  	echo '<divid="temporary"><p class="text-center bg-danger text-white">'.$_SESSION['flash_error'].'</p></div>';
 	//  	unset($_SESSION['flash_error']);
 	// }

 	$flash = '';
 	if (isset($_SESSION['flash_success'])) {
 	 	$flash = '<div class="bg-success" id="temporary"><p class="text-center text-white">'.$_SESSION['flash_success'].'</p></div>';
 	 	unset($_SESSION['flash_success']);
 	}

 	if (isset($_SESSION['flash_error'])) {
 	 	$flash = '<div class="bg-danger" id="temporary"><p class="text-center text-white">'.$_SESSION['flash_error'].'</p></div>';
 	 	unset($_SESSION['flash_error']);
 	}



?>
