<?php
    require_once ('../connection/conn.php');

    if (user_is_logged_in()) {
        redirec(PROOT . 'user/index');
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
    <title>Sign in - Thylies</title>
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="<?= PROOT; ?>assets/media/logo/favicon.ico">

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
                <div class="col-md-8 col-lg-7 col-xl-6 offset-md-2 offset-lg-2 offset-xl-3 space-top-3 space-lg-0 mb-4">
                    <br><br>
                    <br><br>
                    <a href="<?= PROOT; ?>" class="mb-4 mt-15 d-flex justify-content-center">
                        <img src="<?= PROOT; ?>assets/media/logo/logo.jpg" alt="logo">
                    </a>

                    <div class="bg-white p-4 p-xl-6 p-xxl-8 p-lg-4 rounded-3 border">
                        <form id="signupForm">
                            <h1 class="mb-1 text-center h3">Register an Account</h1>
                            <p class="mb-4 text-center">Sign in using your thylies credentials.</p>
                            <span id="signup_errors"></span>
                            <div class="mb-3">
                                <label for="email" class="form-label">Full name<span class="text-danger">*</span> </label>
                                <input type="text" id="user_fullname" class="form-control" name="user_fullname" placeholder="Full name"
                                    required="" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span> </label>
                                <input type="email" id="user_email" class="form-control" name="user_email" placeholder="Email address"
                                    required="" autocomplete="off">
                            </div>
                            <div class="mb-3 mb-4">
                                <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                                <input type="password" id="user_password" name="user_password" class="form-control" placeholder="Password"
                                    required="">
                            </div>
                            <div class="mb-3 mb-4">
                                <label for="password" class="form-label">Repeat password<span class="text-danger">*</span></label>
                                <input type="password" id="repeat_password" name="repeat_password" class="form-control" placeholder="Password"
                                    required="">
                            </div>
                            <div class="mb-3 mb-4">
                                <label for="password" class="form-label">Gender<span class="text-danger">*</span></label>
                                <select type="text" id="user_gender" name="user_gender" class="form-control" required="">
                                    <option value=""></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="d-grid">
                                <button class="g-recaptcha btn btn-warning" data-sitekey="<?= RECAPTCHA_SITE_KEY; ?>" data-callback='submit_signup' data-action='submit' type="submit" name="submit_signup" id="submit_signup">Register</button>
                            </div>
                            <div class="d-xxl-flex justify-content-between mt-4 ">
                                <p class="text-muted font-14 mb-0">
                                    Already have an account! <a href="<?= PROOT; ?>auth/login">Sign in</a>
                                </p>
                                <p class="font-14 mb-0">
                                    <a href="<?= PROOT; ?>index">Visit site</a>
                                </p>
                            </div>
                        </form>
                    </div>
                    <div class="mt-3 nav-footer-links">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="<?= PROOT; ?>privacy-policy">Privacy Policy</a>
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
        // Fade out messages
        $("#temporary").fadeOut(5000);

        // SUBSCRIBE TO NEW PRODUCTS
        function subscribe_products() {
            var email = $('#subscribe').val();

            if (email == '') {
                alert('Enter email to subscribe');
                return false;
            } else if (!isEmail(email)) {
                alert('Please enter a valid email.');
                return false;
            } else {
                $.ajax({
                    url : '<?= PROOT; ?>parsers/user_subscribe.php',
                    method : 'POST',
                    data : {email : email},
                    success : function(data) {
                        alert(data);
                        location.reload();
                    },
                    error : function() {
                        alert('Something went wrong.');
                    }
                });
            }

        }

        function isEmail(email) { 
            return /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(email);
        }

        // SUBMIT SIGNUP FORM
        function submit_signup(token) {
            $('#signup_errors').html('');

            var data = $('#signupForm').serialize();
            var user_fullname = $('#user_fullname').val();
            var user_email = $('#user_email').val();
            var user_password = $('#user_password').val();
            var repeat_password = $('#repeat_password').val();
            var user_gender = $("#user_gender :selected").text();
            var error = '';

            if (user_fullname == '' || user_email == '' || user_password == '' || repeat_password == '' || user_fullname == '' || user_gender == '') {
                error += '<div class="alert alert-secondary" role="alert">Fill all empty fields</div>';
                $('#signup_errors').html(error);
                return false;
            } else if (user_password.length < 6) {
                error += '<div class="alert alert-secondary" role="alert">The password must be at least 6 characters</div>';
                $('#signup_errors').html(error);
                return false;
            } else if (user_password != repeat_password) {
                error += '<div class="alert alert-secondary" role="alert">New and repeat password do not match</div>';
                $('#signup_errors').html(error);
                return false;
            } else if (!isEmail(user_email)) {
                error += '<div class="alert alert-secondary" role="alert">Please enter a valid email.</div>';
                $('#signup_errors').html(error);
                return false;
            } else {
                $.ajax ({
                    url : "<?= PROOT; ?>parsers/signup_user.php",
                    method : "POST",
                    data : data,
                    success: function(data) {
                        if (data == 'ok') {
                            window.location = '<?= PROOT . 'auth/verify'; ?>'
                        } else {
                            $('#signup_errors').html(data);
                        }
                    },
                    error : function() {
                        alert('Something went wrong, refresh and try again.');
                    }
                });
            }
        }
    </script>

</body>
</html>
