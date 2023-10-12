<?php 
	// CHECK ADDRESS ON PAYMENT
	
	require_once ($_SERVER['DOCUMENT_ROOT'] . "/mifo/db_connection/conn.php");

	$full_name = sanitize($_POST['full_name']);
	$email = sanitize($_POST['email']);
	$street = sanitize($_POST['street']);
	$street2 = sanitize($_POST['street2']);
	$company = sanitize($_POST['company']);
	$country = sanitize($_POST['country']);
	$state = sanitize($_POST['state']);
	$city = sanitize($_POST['city']);
	$postcode = sanitize($_POST['postcode']);
	$phone = sanitize($_POST['phone']);

	$error = '';
	$required = array(
		'full_name' => 'Full Name',
		'email' => 'Email',
		'street' => 'Street Address',
		'country' => 'Country',
		'state' => 'State',
		'city' => 'City',
		'postcode' => 'Postcode',
		'phone' => 'Phone',
	);

	// check if all required field are filled out
	foreach ($required as $f => $d) {
		if (empty($_POST[$f]) || $_POST[$f] == '') {
			$error = $d . ' is required';
		}
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error = 'Please enter a valid email.';
	}

	if (!empty($error)) {
		echo $error;
	} else {
		echo 'passed';
	}


?>