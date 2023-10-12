<?php 	
		require_once ('../connection/conn.php');

		if (!check_payment_of_registration_fee($user_id)) {
			// code...
			redirect(PROOT . 'auth/pay-registration');
		}

?>