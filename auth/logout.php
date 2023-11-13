<?php 

	// USER SIGN OUT PAGE

    require_once ("../connection/conn.php");

    unset($_SESSION['THUser']);
    unset($_SESSION['auth-scholarship']);
    unset($_SESSION['auth-sanitarywelfare']);

	redirect(PROOT . 'auth/login');

