<?php
// PHPMAILER CONFIG 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require BASEURL . 'vendor/autoload.php';

// // IP INFO
// use ipinfo\ipinfo\IPinfo;



// // TWILIO
// use Twilio\Rest\Client;
// $sid = TWILIO_ACCOUNT_SID;
// $token = TWILIO_AUTH_TOKEN;
// $twilio = new Client($sid, $token);







function dnd($data) {
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
	die;
}

function cout($data) {
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
}

// Make Date Redable
function pretty_date($date){
	return date("M d, Y h:i A", strtotime($date));
}

// Make Date Redable
function pretty_date_on_time($date){
	return date("h:i", strtotime($date));
}

// Check For Incorrect Input Of Data
function sanitize($dirty) {
    $clean = htmlentities($dirty, ENT_QUOTES, "UTF-8");
    return trim($clean);
}

// Display money in a readable way
function money_symbol($symbol, $number) {
	return $symbol . ' ' . number_format($number, 2);
}
function money($number) {
	return number_format($number, 2);
}

function cleanPost($post) {
    $clean = [];
    foreach ($post as $key => $value) {
      	if (is_array($value)) {
        	$ary = [];
        	foreach($value as $val) {
          		$ary[] = sanitize($val);
        	}
        	$clean[$key] = $ary;
      	} else {
        	$clean[$key] = sanitize($value);
      	}
    }
    return $clean;
}

function js_alert($msg) {
	return '<script>alert("' . $msg . '");</script>';
}


// REDIRECT PAGE
function redirect($url) {
    if(!headers_sent()) {
      	header("Location: {$url}");
    } else {
      	echo '<script>window.location.href="' . $url . '"</script>';
    }
    exit;
}

function issetElse($array, $key, $default = "") {
    if(!isset($array[$key]) || empty($array[$key])) {
      return $default;
    }
    return $array[$key];
}


// function sanitize($input) 
// {
// 	if(is_array($input)):
// 		foreach($input as $key=>$value):
// 			$result[$key] = sanitize($value);
// 		endforeach;
// 	else:
// 		$result = htmlentities($input, ENT_QUOTES, 'UTF-8');
// 	endif;

// 	return $result;
// }

// Email VALIDATION
function isEmail($email) {
	return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
}

// GET USER IP ADDRESS
function getIPAddress() {  
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  
        $ip = $_SERVER['HTTP_CLIENT_IP'];  
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  // whether ip is from the proxy
       $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     } else {  // whether ip is from the remote address 
        $ip = $_SERVER['REMOTE_ADDR'];  
    }  
    return $ip;  
}

// PRINT OUT RANDAM NUMBERS
function digit_random($digits) {
  	return rand(pow(10, $digits - 1) - 1, pow(10, $digits) - 1);
}

// 
function sms_otp($body, $phone) {
	global $twilio;
	$message = $twilio->messages->create(
        $phone, // to
        [
            "body" => $body, 
            "from" => TWILIO_PHONE_NUMBER
        ]
    );

    if ($message->sid)
    	return true;
	else
		return false;
}

//
function send_email($name, $to, $subject, $body) {
	$mail = new PHPMailer(true);
	try {
        $fn = $name;
        $to = $to;
        $from = MAIL_MAIL;
        $from_name = 'Thylies Enterprise.';
        $subject = $subject;
        $body = $body;

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        $mail->IsSMTP();
        $mail->SMTPAuth = true;

        $mail->SMTPSecure = 'ssl'; 
        $mail->Host = 'smtp.vonnagh.com';
        $mail->Port = 465;  
        $mail->Username = $from;
        $mail->Password = MAIL_KEY; 

        $mail->IsHTML(true);
        $mail->WordWrap = 50;
        $mail->From = $from;
        $mail->FromName = $from_name;
        $mail->Sender = $from;
        $mail->AddReplyTo($from, $from_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
        $mail->send();
        return true;
    } catch (Exception $e) {
    	return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    	//return false;
        //$message = "Please check your internet connection well...";
    }
}

// password security
function password_security_checks($password) {
	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);
	$specialChars = preg_match('@[^\w]@', $password);

	$output = '';
	if (strlen($password) >= 8) {
		if (!$uppercase) {
			$output = 'Password must have at least one uppercase English letter.';
		} else if (!$lowercase) {
			$output = 'Password must have at least one lowercase English letter.';
		} else if (!$number) {
			$output = 'Password must have at least one digit.';
		} else if (!$specialChars) {
			$output = 'Password must have at least one special character.';
		} else {
			$output = true;
		}
	} else {
		$output = 'Password must have minimum 8 characters in length.';
	}
	
	return $output;
}






























// Sessions For User login
function userLogin($user_id) {
	$_SESSION['IQuser'] = $user_id;
	$_SESSION['last_login_timestamp'] = time();
	global $conn;
	$data = array(
		':user_last_login' => date("Y-m-d H:i:s"),
		':user_id' => (int)$user_id
	);
	$query = "
		UPDATE inqoins_user 
		SET user_last_login = :user_last_login 
		WHERE user_id = :user_id
	";
	$statement = $conn->prepare($query);
	$result = $statement->execute($data);
	if (isset($result)) {
		$userQ = $conn->query("SELECT * FROM inqoins_user INNER JOIN inqoins_user_details ON inqoins_user.user_id = inqoins_user_details.user_id WHERE inqoins_user.user_id = $user_id LIMIT 1")->fetchAll();
		$name = ucwords($userQ[0]['user_fname'] . ' ' . $userQ[0]['user_lname'] . ' ' . $userQ[0]['user_nname']);
        $subject = 'Login Notification.';

        $access_token = IPINFO_KEY;
		$client = new IPinfo($access_token);
        $ip = $client->getDetails();
        $ip_address = $ip->ip;

        $body = "
            <h3>You signed into your account.</h3>
            <p>Sup {$name}!</p>
            <p>We want to let you know that on " . date("Y-m-d H:i:s A") . ", this ip  " . $ip_address . " accessed your Inqoins account.</p>
            <p>Please change your password if you didn't start it and get in touch with us right away at <a href='mailto:contact@inqoins.io'>contact@inqoins.io</a></p>
            <p><a href='" . PROOT . "auth/recover-password'>Change password</a></p>
            <p><small>Inqoins Inc.</small></p>
        ";
        if ($userQ[0]['user_pin'] != NULL) {
        	$subject = 'An attempt at logging in.';
        	$body = "
        		<h3>There was an attempt to log into your account,</h3>
	            <p>Hi {$name}!</p>
	            <p>There has been an attempt to get into your Inqoins account, and we want to let you know about it.</p>
	            <p>Please change your password if you didn't start it and get in touch with us right away at <a href='mailto:contact@inqoins.io'>contact@inqoins.io</a></p>
	            <p><a href='" . PROOT . "auth/recover-password'>Change password</a></p>
	            <p><small>Inqoins Inc.</small></p>
        	";
        	send_email($name, $userQ[0]['user_email'], $subject, $body);
			redirect(PROOT . 'auth/verify-2fa');
        } else {
        	send_email($name, $userQ[0]['user_email'], $subject, $body);
        	redirect(PROOT . 'app');
        }
        
	}
}

// check if user is loggged in.
function user_is_logged_in() {
	if (isset($_SESSION['IQuser']) && $_SESSION['IQuser'] > 0) {
		return true;
	}
	return false;
}

// check if user has pin
function user_have_set_pin() {
	if (isset($_SESSION['ihp']) && $_SESSION['ihp'] > 0) {
		return true;
	}
	return false;
}

// Redirect admin if !logged in
function user_login_redirect($url = PROOT . 'auth/login') {
	$_SESSION['flash_error'] = '<div class="text-center" id="temporary" style="margin-top: 60px;">You must be logged in to access that page.</div>';
	header('Location: '.$url);
}

// LOG USER OUT AFTER !% MINS OF IDLENESS
function automaticallyLogUserOut() {
	// 900 = 15 * 60 
	// if ((time() - $_SESSION['last_login_timestamp']) > 900) {  
    //     $_SESSION['flash_error'] = 'You have been logout because, you have been idle for sometime.';
    //     redirect(PROOT . 'account/out');
    // } 
    return true;
}





///////////////////////////////////////// ADMIN
// Sessions For login
function adminLogin($admin_id) {
	$_SESSION['IQNadmin'] = $admin_id;
	global $conn;
	$data = array(
		':admin_last_login' => date("Y-m-d H:i:s"),
		':admin_id' => (int)$admin_id
	);
	$query = "
		UPDATE inqoins_admin 
		SET admin_last_login = :admin_last_login 
		WHERE admin_id = :admin_id";
	$statement = $conn->prepare($query);
	$result = $statement->execute($data);
	if (isset($result)) {
		$_SESSION['flash_success'] = '<div class="text-center" id="temporary">You are now logged in!</div>';
		header('Location: index');
	}
}

function admin_is_logged_in() {
	if (isset($_SESSION['IQNadmin']) && $_SESSION['IQNadmin'] > 0) {
		return true;
	}
	return false;
}

// Redirect admin if !logged in
function admn_login_redirect($url = 'login') {
	$_SESSION['flash_error'] = '<div class="text-center" id="temporary" style="margin-top: 60px;">You must be logged in to access that page.</div>';
	header('Location: '.$url);
}

// Redirect admin if do not have permission
function admin_permission_redirect($url = 'login') {
	$_SESSION['flash_error'] = '<div class="text-center" id="temporary" style="margin-top: 60px;">You do not have permission in to access that page.</div>';
	header('Location: '.$url);
}

function admin_has_permission($permission = 'admin') {
	global $admin_data;
	$permissions = explode(',', $admin_data['admin_permissions']);
	if (in_array($permission, $permissions, true)) {
		return true;
	}
	return false;
}


// GET ADMIN PROFILE DETAILS
function get_admin_profile() {
	global $conn;
	global $admin_data;
	$output = '';

	$query = "
		SELECT * FROM inqoins_admin 
		WHERE admin_trash = :admin_trash 
		LIMIT 1
	";
	$statement = $conn->prepare($query);
	$statement->execute([':admin_trash' => 0]);
	$result = $statement->fetchAll();

	foreach ($result as $row) {
		if ($row['admin_id'] == $admin_data['admin_id']) {
			$output = '
				<h3 class="text-muted">Name</h3>
			    <p class="lead">'.ucwords($row["admin_fullname"]).'</p>
			    <br>
			    <h3 class="text-muted">Email</h3>
			    <p class="lead">'.$row["admin_email"].'</p>
			    <br>
			    <h3 class="text-muted">Joined Date</h3>
			    <p class="lead">'.pretty_date($row["admin_joined_date"]).'</p>
			    <br>
			    <h3 class="text-muted">Last Login</h3>
			    <p class="lead">'.pretty_date($row["admin_last_login"]).'</p>
			';
		}
	}
	return $output;
}

// GET ALL ADMINS
function get_all_admins() {
	global $conn;
	global $admin_data;
	$output = '';

	$query = "
		SELECT * FROM inqoins_admin 
		WHERE admin_trash = :admin_trash
	";
	$statement = $conn->prepare($query);
	$statement->execute([':admin_trash' => 0]);
	$result = $statement->fetchAll();

	foreach ($result as $row) {
		$admin_last_login = $row["admin_last_login"];
		if ($admin_last_login == NULL) {
			$admin_last_login = '<span class="text-secondary">Never</span>';
		} else {
			$admin_last_login = pretty_date($admin_last_login);
		}
		$output .= '
			<tr>
				<td>
		';
					
		if ($row['admin_id'] != $admin_data['admin_id']) {
			$output .= '
				<a href="'.PROOT.'pmiqn/ADMINS?delete='.$row["admin_id"].'" class="btn btn-sm btn-light"><i class="flaticon2-trash"></i></a>
			';
		}

		$output .= '
				</td>
				<td>'.ucwords($row["admin_fullname"]).'</td>
				<td>'.$row["admin_email"].'</td>
				<td>'.pretty_date($row["admin_joined_date"]).'</td>
				<td>'.$admin_last_login.'</td>
				<td>'.$row["admin_permissions"].'</td>
			</tr>
		';
	}
	return $output;
}


// GET ALL FIATS IJ OPTION TAG
function getFiats($conn) {
	$query = "
		SELECT * FROM inqoins_fiat 
		ORDER BY fiat ASC
	";
	$statement = $conn->prepare($query);
	$statement->execute();
	$output = '';
	foreach ($statement->fetchAll() as $row) {
		$output .= '
			<option>'.strtoupper($row["fiat"]).'</option>
		';
	}
	return $output;
}

// GET ALL CRYPTOS IJ OPTION TAG
function getCryptos($conn) {
	$query = "
		SELECT * FROM inqoins_crypto 
		ORDER BY crypto ASC
	";
	$statement = $conn->prepare($query);
	$statement->execute();
	$output = '';
	foreach ($statement->fetchAll() as $row) {
		// new changes
		$rate = '';
		if ($row["crypto_rate"] != '') {
			$rate = '(' . $row["crypto_rate"] . '% rate)';
		}
		// $output .= '
		// 	<option value="'.strtoupper($row["crypto"]).'">'.strtoupper($row["crypto"]).', '. $rate . '</option>
		// ';
		$output .= '
			<option>'.strtoupper($row["crypto"]).'</option>
		';
	}
	return $output;
}

// GET ALL NETWORKS IJ OPTION TAG
function getNetworks($conn) {
	$query = "
		SELECT * FROM inqoins_mobile_network 
		ORDER BY mobile_network_name ASC
	";
	$statement = $conn->prepare($query);
	$statement->execute();
	$output = '';
	foreach ($statement->fetchAll() as $row) {
		$output .= '
			<option>'.strtoupper($row["mobile_network_name"]).'</option>
		';
	}
	return $output;
}

// GET TOTAL OF BUY REQUEST IN A DAY
function buy_requests_in_a_day($conn) {
	$today = date('d');
	$sql = "
		SELECT * FROM inqoins_buy_crypto 
		WHERE DAY(inqoins_buy_crypto_datetime) = ? 
		AND inqoins_buy_crypto_trash = ?
	";
	$statement = $conn->prepare($sql);
	$statement->execute([$today, 0]);
	return $statement->rowCount();
}

// GET TOTAL OF BUY REQUEST
function buy_requests($conn) {
	$sql = "
		SELECT * FROM inqoins_buy_crypto 
		WHERE inqoins_buy_crypto_trash = ?
	";
	$statement = $conn->prepare($sql);
	$statement->execute([0]);
	return $statement->rowCount();
}

// GET TOTAL OF UNSEEN BUY REQUEST
function unseen_buy_requests($conn) {
	$sql = "
		SELECT * FROM inqoins_buy_crypto 
		WHERE inqoins_buy_crypto_status = ?
		AND inqoins_buy_crypto_trash = ?
	";
	$statement = $conn->prepare($sql);
	$statement->execute([0, 0]);
	if ($statement->rowCount() > 0) {
		return [
			'<span class="badge badge-danger rounded-circle">'.$statement->rowCount().'</span>',
			$statement->rowCount()
		];
	}
}

// GET TOTAL OF SELL REQUEST IN A DAY
function sell_requests_in_a_day($conn) {
	$today = date('d');
	$sql = "
		SELECT * FROM inqoins_sell_crypto 
		WHERE DAY(inqoins_sell_crypto_datetime) = ? 
		AND inqoins_sell_crypto_trash = ?
	";
	$statement = $conn->prepare($sql);
	$statement->execute([$today, 0]);
	return $statement->rowCount();
}

// GET TOTAL OF SELL REQUEST
function sell_requests($conn) {
	$sql = "
		SELECT * FROM inqoins_sell_crypto 
		WHERE inqoins_sell_crypto_trash = ?
	";
	$statement = $conn->prepare($sql);
	$statement->execute([0]);
	return $statement->rowCount();
}

// GET TOTAL OF UNSEEN SELL REQUEST
function unseen_sell_requests($conn) {
	$sql = "
		SELECT * FROM inqoins_sell_crypto 
		WHERE inqoins_sell_crypto_status = ?
		AND inqoins_sell_crypto_trash = ?
	";
	$statement = $conn->prepare($sql);
	$statement->execute([0, 0]);
	if ($statement->rowCount() > 0) {
		return [
			'<span class="badge badge-danger rounded-circle">'.$statement->rowCount().'</span>',
			$statement->rowCount()
		];
	}
}

//
function total_users_count($conn) {
	$sql = "
		SELECT * FROM inqoins_user
		WHERE user_trash = ? 
		AND user_disable = ? 
	";
	$statement = $conn->prepare($sql);
	$statement->execute([0, 0]);
	return $statement->rowCount();
}

// GET TOTAL OF ACCOUNTS CREATED IN TODAY
function today_total_account_created($conn) {
	$today = date('d');
	$sql = "
		SELECT * FROM inqoins_user 
		WHERE DAY(user_joined_date) = ? 
		AND user_trash = ? 
		AND user_disable = ?
	";
	$statement = $conn->prepare($sql);
	$statement->execute([$today, 0, 0]);
	return $statement->rowCount();
}

// GET WALLET ADDRES
function find_wallet($conn, $wallet) {
	$query = "
		SELECT * FROM inqoins_crypto 
		WHERE crypto = ?
	";
	$statement = $conn->prepare($query);
	$statement->execute([$wallet]);
	if ($statement->rowCount() > 0) {
		foreach ($statement->fetchAll() as $row) {
			return [
				$row['crypto'],
				$row['crypto_wallet'],
				$row['crypto_rate']
			];
		}
	} else {
		return false;
	}
}

// GET NETWORK AND ITS DETAILS
function find_network($conn, $network) {
	$query = "
		SELECT * FROM inqoins_mobile_network 
		WHERE mobile_network_name = ?
	";
	$statement = $conn->prepare($query);
	$statement->execute([$network]);
	if ($statement->rowCount() > 0) {
		foreach ($statement->fetchAll() as $row) {
			return [
				strtoupper($row['mobile_network_name']) . ' Mobile Money', 
				$row['mobile_network_number'], 
				$row['mobile_network_merchant_id']
			];
		}
	} else {
		return false;
	}
}

// SELECTED COUNTRY
function selectedCountry($country, $value) {
	if (isset($_POST['country']) == $country || $country == $value) {
		return 'selected';
	} else {
		return false;
	}
}






















// GET ALL USERS
function get_all_users() {
	global $conn;
	$output = '';

	$userQ = "
		SELECT * FROM users 
		ORDER BY user_id DESC
	";
	$statement = $conn->prepare($userQ);
	$statement->execute();
	$user_result = $statement->fetchAll();
	$user_count = $statement->rowCount();

	if ($user_count > 0) {
		foreach ($user_result as $user_row) {
			$output .= '
				<tr>
					<td>'.ucwords($user_row["full_name"]).'</td>
					<td>'.$user_row["email"].'</td>
					<td>'.pretty_date($user_row["joined_date"]).'</td>
					<td>'.pretty_date($user_row["last_login"]).'</td>
					<td>
						<a class="small" href="admin.users.php?delete='.$user_row["user_id"].'">Delete</a>
					</td>
				</tr>
			';
		}
	} else {
		$output .= '
				<tr>
					<td colspan="4">No data found!</td>
				</tr>
			';
	}
	return $output;
}



// GET ALL COMPLAINS
function get_all_complains() {
	global $conn;
	$output = '';

	$complainQ = "
		SELECT * FROM complains 
		INNER JOIN users 
		ON users.user_id = complains.user_id 
		ORDER BY complain_id DESC
	";
	$statement = $conn->prepare($complainQ);
	$statement->execute();
	$complain_result = $statement->fetchAll();
	$complain_count = $statement->rowCount();

	if ($complain_count > 0) {
		foreach ($complain_result as $complain_row) {
			$output .= '
				<tr>
					<td>'.ucwords($complain_row['full_name']).'</td>
					<td>'.$complain_row['user_msg'].'</td>
					<td>'.$complain_row['admin_response'].'</td>
					<td>'.pretty_date($complain_row['complain_date']).'</td>
			';
			if ($complain_row['admin_response'] == '') {
				$output .= '
					<td>
						<a href="admin.complains.php?reply='.$complain_row['complain_id'].'">reply</a>
					</td>
				';
			} else {
				$output .= '
					<td>
					</td>
				';
			}
			$output .= '</tr>';
		}
	} else {
		$output .= '
				<tr>
					<td colspan="4">No data found!</td>
				</tr>
			';
	}
	return $output;
}




// SCHEDULE
function schedule() {
	global $conn;
	$output = '';

	$complainQ = "
		SELECT * FROM users 
		INNER JOIN schedules 
		ON users.user_id = schedules.user_id 
	";
	$statement = $conn->prepare($complainQ);
	$statement->execute();
	$schedule_result = $statement->fetchAll();
	$schedule_count = $statement->rowCount();

	if ($schedule_count > 0) {
		foreach ($schedule_result as $schedule_row) {
			$output .= '
				<tr>
					<td>'.ucwords($schedule_row['full_name']).'</td>
					<td>'.$schedule_row['todo'].'</td>
					<td>'.$schedule_row['start_time'].'</td>
					<td>'.$schedule_row['end_time'].'</td>
					<td><a href="admin.schedule.php?update='.$schedule_row['id'].'">update</a></td>
				</tr>
			';
		}
	} else {
		$output .= '
				<tr>
					<td colspan="4">No data found!</td>
				</tr>
			';
	}
	return $output;
}











///////////////////////////////////////////////////////////////////////
// fetch customer assets
function customer_assets($user_id) {
	global $conn;
	global $bitnobSdk;

	$query = "
		SELECT * FROM inqoins_wallet_address 
		WHERE wallet_address_userid = ? 
		-- LIMIT 2
	";
	$statement = $conn->prepare($query);
	$statement->execute([$user_id]);
	$addresses = $statement->fetchAll();
	$count_addresses = $statement->rowCount();
	return $addresses;
}


// current bitcoin price
function bitcoin_current_price($bitnobSdk) {
	$current_btc_price = $bitnobSdk->exchangeRates()->rateByCurrency('USD');

	return '
		<li class="nav-item">
            <a class="nav-link btn btn-active-light btn-color-info py-2 px-4 fw-bolder me-2" href="javascript:;">
            	<span class="svg-icon svg-icon-muted ">
            		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect x="8" y="9" width="3" height="10" rx="1.5" fill="black"/>
					<rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black"/>
					<rect x="18" y="11" width="3" height="8" rx="1.5" fill="black"/>
					<rect x="3" y="13" width="3" height="6" rx="1.5" fill="black"/>
					</svg>
				</span>BTC Price: $' . number_format($current_btc_price['data']['rate'], 2) . '
			</a>
        </li>
	';
}



function getAssets($conn, $user_id) {
	$rows = $conn->query("SELECT * FROM inqoins_wallet_address WHERE wallet_address_userid = '$user_id'")->fetchAll();
	$output = '';
	foreach ($rows as $row) {
		$output .= '<option value="'.$row["wallet_address"].'/'.$row["wallet_address_type"].'">' . $row["wallet_address_type"] . (($row["wallet_address_chain"] != '') ? ' - ' . $row["wallet_address_chain"] : '') . '</option>';
	}
	return $output;
}

// count number of referred customers per user
function count_referred($user_id) {
	global $conn;

	$query = "
		SELECT * FROM inqoins_customer_referral 
		WHERE customer_referrer = ?
	";
	$statement = $conn->prepare($query);
	$statement->execute([$user_id]);
	return $statement->rowCount();
}

//
function generate_unique_reference_ids($bytes) {
    $rand = random_bytes($bytes);
    return bin2hex($rand);
}

/*
* Limit customers on their purchase per day if account not verified
*
*
*/
function limit_customer_purchases_on_verification($customer_id, $onDate, $verify) {
	global $conn;
	if($verify == 1) {
	    // create record with the client's ip address and the current date and time
	    // invoke the function you want - This is the code to trigger the function first time for the new IP address
	    return false;
	} else {
		$thisDay = date('d');
		$thisMonth = date('m');
		$thisYear = date('Y');
	    $query = "
	    	SELECT * FROM inqoins_wallet_transaction 
	    	WHERE inqoins_wallet_transaction.transaction_userid = ? 
	    	AND YEAR(`transaction_createdAt`) = ? 
	    	AND MONTH(`transaction_createdAt`) = ? 
	    	AND DAY(`transaction_createdAt`) = ? 
	    	AND (transaction_status = 'send_usdc' OR transaction_status = 'send_usdt' OR transaction_status = 'send_bitcoin') 
	    ";
	    $statement = $conn->prepare($query);
	    $statement->execute([$customer_id, $thisYear, $thisMonth, $thisDay]);
	    $count_transations = $statement->rowCount();

	    if ($count_transations >= 10) {
	    	// code...
	        return true;
	    } else {
	    	return false;
	    }

	}
}


// 
function get_current_wallet_balance($userid, $address_type) {
	global $conn;
	global $bitnobSdk;

	$query = "
		SELECT * FROM inqoins_wallet_address 
		WHERE wallet_address_userid = ? 
		AND wallet_address_type = ? 
		LIMIT 1
	";
	$statement = $conn->prepare($query);
	$statement->execute([$userid, $address_type]);
	$row = $statement->fetchAll();
	// dnd($address_type);
	$count_row = $statement->rowCount();

	$current_btc_price = $bitnobSdk->exchangeRates()->rateByCurrency('USD');
	$current_btc_price = $current_btc_price['data']['rate'];
	$balance = 0;

	if ($address_type == 'BTC') {
		$response = $bitnobSdk->addresses()->getAddressDetails($row[0]['wallet_address']);
		$valid = (isset($response['status']) ? $response['status'] : $response['statusCode']);
		if ($valid == 1) {
			$btc_balance = $response['data']['totalReceived'];
			$balance = $btc_balance * $current_btc_price;
		}
	} else {
		$response = $bitnobSdk->addresses()->getAddressDetails($row[0]['wallet_address']);
		$valid = (isset($response['status']) ? $response['status'] : $response['statusCode']);
		if ($valid == 1) {
			$balance = $response['data']['totalReceived'];
		}
	}

	$balance = number_format($balance, 2);
	return $balance;
}


// get total wallate balance
function get_total_wallet_balance($user_id) {
	global $bitnobSdk;

	$current_btc_price = $bitnobSdk->exchangeRates()->rateByCurrency('USD');
	$current_btc_price = $current_btc_price['data']['rate'];
	$balance = 0;
	$addresses = customer_assets($user_id);
	foreach ($addresses as $address) {
		if ($address['wallet_address_type'] == 'BTC') {
			$response = $bitnobSdk->addresses()->getAddressDetails($address['wallet_address']);
    		$valid = (isset($response['status']) ? $response['status'] : $response['statusCode']);
			if ($valid == 1) {
				$btc_balance = $response['data']['totalReceived'];
				$balance += $btc_balance * $current_btc_price;
			}
		} else {
			$response = $bitnobSdk->addresses()->getAddressDetails($address['wallet_address']);
    		$valid = (isset($response['status']) ? $response['status'] : $response['statusCode']);
			if ($valid == 1) {
				$balance += $response['data']['totalReceived'];
			}
		}
	}
	$balance = '$' . number_format($balance, 2);
	return $balance;
}

// get total btc balance
function get_total_btc_balance($user_id) {
	global $bitnobSdk;
	
	$current_btc_price = $bitnobSdk->exchangeRates()->rateByCurrency('USD');
	$current_btc_price = $current_btc_price['data']['rate'];
	$balance = 0;
	$addresses = customer_assets($user_id);
	foreach ($addresses as $address) {
		if ($address['wallet_address_type'] == 'BTC') {
			$response = $bitnobSdk->addresses()->getAddressDetails($address['wallet_address']);
    		$valid = (isset($response['status']) ? $response['status'] : $response['statusCode']);
			if ($valid == 1) {
				$btc_balance = $response['data']['totalReceived'];
				$balance += $btc_balance * $current_btc_price;
			}
		}
	}
	$balance = '$' . number_format($balance, 2);
	return $balance;
}

// get total usd balance
function get_total_usd_balance($user_id) {
	global $bitnobSdk;

	$current_btc_price = $bitnobSdk->exchangeRates()->rateByCurrency('USD');
	$current_btc_price = $current_btc_price['data']['rate'];
	$balance = 0;
	$addresses = customer_assets($user_id);
	foreach ($addresses as $address) {
		if ($address['wallet_address_type'] == 'BTC') {
			
		} else {
			$response = $bitnobSdk->addresses()->getAddressDetails($address['wallet_address']);
    		$valid = (isset($response['status']) ? $response['status'] : $response['statusCode']);
			if ($valid == 1) {
				$balance += $response['data']['totalReceived'];
			}
		}
	}
	$balance = '$' . number_format($balance, 2);
	return $balance;
}

