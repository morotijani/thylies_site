<?php 

	// USER SIGNOUT PAGE

    require_once ("../db_connection/conn.php");

    unset($_SESSION['MFUser']);

	redirect(PROOT . 'shop/index');

	
?>