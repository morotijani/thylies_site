<?php 

// USER SIGNIN

require_once ('../connection/conn.php');

// 
$authSW = issetElse($_SESSION, 'auth-studentinbusiness', 0);
if ($authSW != 0 && !empty($authSW)) {
    redirect(PROOT . 'auth/apply-student-in-business-fee/' . $authSW);
}

if (isset($_GET['studentinbusiness'])) {
    $id = sanitize($_GET['studentinbusiness']);

    $index_number = ((isset($_POST['index_number'])) ? sanitize($_POST['index_number']):'');
    $dob = ((isset($_POST['dob'])) ? sanitize($_POST['dob']):'');
    $errors = '';

    if ($_POST) {
        if (empty($_POST['index_number']) || empty($_POST['dob'])) {
            $errors = '<div class="alert alert-secondary" role="alert">All field are required.</div>';
        }

        $query = "
            SELECT * FROM thylies_student_in_business 
            WHERE index_number = ? 
            AND dob = ? 
            AND sib_id = ? 
            LIMIT 1
        ";
        $statement = $conn->prepare($query);
        $statement->execute(array($index_number, $dob, $id));
        if ($statement->rowCount() < 1) {
            $errors = '<div class="alert alert-secondary" role="alert">Unknown student.</div>';
        } else {
            $_SESSION['auth-studentinbusiness'] = $id;
            redirect(PROOT . 'student-in-business');
        }

    }


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
    <title>Auth Sanitary Welfare Status - Thylies</title>
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
            <div class="row g-0">
                <div class="col-md-8 col-lg-7 col-xl-6 offset-md-2 offset-lg-2 offset-xl-3 space-top-3 space-lg-0">
                    <a href="<?= PROOT; ?>" class="mb-4 d-flex justify-content-center">
                        <img src="<?= PROOT; ?>assets/media/logo/logo.jpg" alt="logo">
                    </a>

                    <div class="bg-white p-4 p-xl-6 p-xxl-8 p-lg-4 rounded-3 border">
                        <form method="POST" id="loginForm">
                            <h1 class="mb-1 text-center h3">Authenticate</h1>
                            <p class="mb-4 text-center">Provide the below details to access your student in business status.</p>
                            <?= $errors; ?>
                            <div class="mb-3">
                                <label for="index_number" class="form-label">Index number<span class="text-danger">*</span> </label>
                                <input type="text" id="index_number" class="form-control" name="index_number" placeholder="Enter Index number"
                                    required="" autocomplete="off">
                            </div>
                            <div class="mb-3 mb-4">
                                <label for="dob" class="form-label">Date of Birth<span class="text-danger">*</span></label>
                                <input type="date" id="dob" name="dob" class="form-control" placeholder="Password" required=>
                            </div>
                            <div class="d-grid">
                                <button class="g-recaptcha btn btn-warning" data-sitekey="<?= RECAPTCHA_SITE_KEY; ?>" data-callback='submit_signup' data-action='submit' type="submit" name="submit_login" id="submit_login">Check status</button>
                            </div>
                            <div class="d-xxl-flex justify-content-between mt-4 ">
                                <?php if (!user_is_logged_in()): ?>
                                    <p class="text-muted font-14 mb-0">
                                        Don't have an account yet? <a href="<?= PROOT; ?>auth/join">Sign up</a>
                                    </p>
                                    <p class="font-14 mb-0">
                                        <a href="<?= PROOT; ?>auth/login">Sign in</a>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <p class="font-14 mb-0">
                                <a href="<?= PROOT; ?>sanitary-welfare-list">Cancel</a>
                            </p>
                        </form>
                    </div>
                    <div class="mt-3 nav-footer-links">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="<?= PROOT; ?>privacy-policy">Privacy Policy </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= PROOT; ?>terms">Terms & Conditions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= PROOT; ?>assets/js/jquery.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/theme.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <script>
        function submit_signup(token) {
            $('#loginForm').submit();
        }
    </script>
</body>
</html>

<?php 
    } else {
        redirect(PROOT . 'student-in-business-list');
    } ?>

