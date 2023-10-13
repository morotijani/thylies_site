<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content=">Yoga Coach - Bootstrap 5 Personal Website Template">
    <meta name="keywords" content=">Yoga Coach, Personal website template">
    <meta name="author" content="Codescandy">
    <title><?= $title; ?> Thylies</title>
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/plyr.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mansalva&family=Young+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gaegu" />
    <link href="https://fonts.googleapis.com/css2?family=Mansalva&family=Patrick+Hand&family=Young+Serif&display=swap" rel="stylesheet">

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

<body>

	<nav class="navbar navbar-expand-lg navbar-default position-sticky border-3 border-top border-warning bg-dark navbar-dark">
        <div class="container">
            <a class="navbar-brand @@brandLogo" href="<?= PROOT; ?>"><img src="<?= PROOT; ?>assets/media/logo/logo.jpg"
                    alt=""></a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="icon-bar top-bar mt-0"></span>
                <span class="icon-bar middle-bar"></span>
                <span class="icon-bar bottom-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-default">
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-times"></i>
                </button>
                <ul class="navbar-nav ms-auto me-lg-3 ">
                     <li class="nav-item dropdown disabled">
                        <a class="nav-link d-lg-none" href="#">
                            Menu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= PROOT; ?>" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href=" <?= PROOT; ?>scholarships" class="nav-link">Scholarships</a>
                    </li>
                    <li class="nav-item">
                        <a href=" <?= PROOT; ?>sanitary-welfare" class="nav-link">Scholarship List</a>
                    </li>
                    <li class="nav-item">
                        <a href=" <?= PROOT; ?>student-in-business" class="nav-link">Student in Business</a>
                    </li>
                    <li class="nav-item">
                        <a href=" <?= PROOT; ?>countact-us" class="nav-link">Contact</a>
                    </li>
                </ul>
                <div class="header">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menu-3" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                             Welcome <?= $user_data['first']; ?>!
                        </a>
                        <ul class="dropdown-menu dropdown-menu-arrow  dropdown-menu-xl-start " aria-labelledby="menu-3">
                            <li>
                                <a class="dropdown-item" href="<?= PROOT; ?>user/">
                                    My Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= PROOT; ?>user/setting">
                                    Setting
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= PROOT; ?>user/change-password">
                                    Change Password
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= PROOT; ?>auth/logot">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </div>
            </div>

        </div>
    </nav>
	<div class="bg-shape bg-dark">
		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-12">
					<div class="pt-lg-8 pb-lg-12 pt-5 pb-0 mb-16 ">
						<h1 class="h2 text-white mb-0"></h1>
					</div>
				</div>
			</div>
		</div>
	</div>