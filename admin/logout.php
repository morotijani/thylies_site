<?php 

    require ('./../connection/conn.php');

    unset($_SESSION['THYAdmin']);

    redirect(PROOT . 'admin/login');
