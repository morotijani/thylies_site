<?php 	
		require_once ('../connection/conn.php');
		
		if (user_is_logged_in()) {
	        if (!check_payment_of_registration_fee($user_id)) {
	            redirect(PROOT . 'auth/pay-registration');
	        }
	    } else {
	        redirect(PROOT . 'auth/logout');
	    }

?>