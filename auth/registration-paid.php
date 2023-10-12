<?php

require_once ('../connection/conn.php');


$payId = issetElse($_SESSION, 'pay_id', 0);
if ($payId != 0 && !empty($payId)) {
	echo 'through';
}
	
?>