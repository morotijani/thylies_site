<?php

	require_once ('../connection/conn.php');

	$payId = issetElse($_SESSION, 'pay_id', 0);
	if ($payId != 0 && !empty($payId)) {
		$sql = "
			SELECT * FROM thylies_transactions 
			WHERE transaction_id = ? 
			AND transaction_service = ? 
			LIMIT 1
		";
		$statement = $conn->prepare($sql);
		$statement->execute([$payId, 'sanitarywelfare']);
		$count_result = $statement->rowCount();
		$row = $statement->fetchAll();

		if ($count_result > 0) {
			// code...
			$_SESSION['auth-sanitarywelfare'] = $row[0]['from_id'];
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sign in Page - Coach">
    <meta name="keywords" content="">
    <meta name="author" content="Codescandy">
    <title>Paid Sanitary Welfare - Thylies</title>
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="<?= PROOT; ?>assets/media/logo/logo-min.png">

    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/theme.min.css">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-M8S4MT3EYG');
    </script>
</head>
<body class="bg-light">

    <div class="d-flex align-items-center position-relative vh-100">
        <div class="container">
        	<div class="row justify-content-center">
        		<div class="col-md-5">
					<a href="javascript:;">
		    			<dotlottie-player src="https://lottie.host/bedb2e95-773d-4fa6-9ae6-275178405aa6/yFmN8pcjyo.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>
		    		</a>
					<div class="p-4 bg-white border rounded-bottom">
						<a href="javascript:;">
						  	<h3 class="mb-3 h4">Thylies</h3>
						</a>
						<p>Your account has been successfully been funded.</p>
						<p>Transaction Id: <b><?= $payId; ?></b></p>
						<a href="<?= PROOT; ?>sanitary-welfare-status" class="btn-primary-link">Access and download reciept</a>
					</div>
        		</div>
        	</div>

		</div>
	</div>

<?php
		} else {
			redirect(PROOT . 'sanitary-welfare-list');
		}
	} else {
		redirect(PROOT . 'sanitary-welfare-list');
	}
	
?>

	<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
    <script src="<?= PROOT; ?>assets/js/jquery.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/theme.min.js"></script>

</body>
</html>
