<?php
	require_once ("connection/conn.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Error Page - Coach">
    <meta name="keywords" content="">
    <meta name="author" content="Codescandy">
    <title>Error Page - Thylies</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mansalva&family=Young+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gaegu" />
    <link href="https://fonts.googleapis.com/css2?family=Mansalva&family=Patrick+Hand&family=Young+Serif&display=swap" rel="stylesheet">

 	<link rel="shortcut icon" type="image/x-icon" href="<?= PROOT; ?>assets/media/logo/favicon.ico">

    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/theme.min.css">
    <style>
    	* {
    		font-family: Gaegu;
    	}
    </style>

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
	<script>
	  	window.dataLayer = window.dataLayer || [];
	  	function gtag(){dataLayer.push(arguments);}
	  	gtag('js', new Date());

	  	gtag('config', 'G-M8S4MT3EYG');
	</script>
</head>
<body>

    <div class="min-vh-100 d-flex align-items-center ">
        <div class="container">
            <div class="row align-items-center p-lg-12">
                <div class="col-lg-4 col-12">
                    <h1 class="display-3 mb-3">Oops!</h1>
                    <p class="mb-4">
                        Sorry, we couldn’t find the page you were looking for. Go ahead and try the button at the bottom
                        to find your way!
                    </p>
                    <a href="<?= PROOT; ?>" class="btn btn-warning">Back to saftey</a>
                </div>
                <div class="offset-lg-1 col-lg-7 col-12 text-center">
                    <img src="<?= PROOT; ?>assets/media/404.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

	<script src="<?= PROOT; ?>assets/js/jquery.min.js"></script>
	<script src="<?= PROOT; ?>assets/js/bootstrap.bundle.min.js"></script>
	<script src="<?= PROOT; ?>assets/js/jquery.slimscroll.min.js"></script>
	<script src="<?= PROOT; ?>assets/js/theme.min.js"></script>
</body>
</html>
