<?php 

	// USER SIGN OUT PAGE

    require_once ("../connection/conn.php");

    unset($_SESSION['THUser']);

	redirect(PROOT . 'auth/login');

