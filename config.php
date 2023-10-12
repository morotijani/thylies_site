<?php

	define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/thylies_site/');
	
	define('PROOT', '/thylies_site/');


	define('SMS_API_KEY', '03fc14c0b83a26d000193e427cff93');

	define('MAIL_MAIL', 'info@vonnagh.com');

	define('MAIL_KEY', 'Uj131fcfc');

	//
	define('IPINFO_KEY', 'c5c08603163207');
	

	// recaptcha
	define('RECAPTCHA_SITE_KEY', '6LfnThkmAAAAAMOlDVEpEEoqTU_pEh-rIcsIPG5Q');
	define('RECAPTCHA_SECRET_KEY', '6LfnThkmAAAAAAgkrWyPG93I0E94l0GsBOCd2rO_');

	// PAYSTACK
	$payment_status = 'live';
	if ($payment_status == 'test') {
		// code...
		define('PAYSTACK_LIVE_PUBLIC_KEY', 'pk_live_d0c7d1cb52ce953fbcae54dbc1074b59a897febf');
		define('PAYSTACK_LIVE_SECRET_KEY', 'sk_live_377785a295751765404663d44457a573cc537980');
	} else {
		define('PAYSTACK_TEST_PUBLIC_KEY', 'pk_test_e6fa7289a2eb435e2db272ce3ea699344ffb87d1');
		define('PAYSTACK_TEST_SECRET_KEY', 'sk_test_63c751a97adc240bc16d02eb3ea466ed10414107');
	}
