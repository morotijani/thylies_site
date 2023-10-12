<?php
    require_once ('../connection/conn.php');

    if (user_is_logged_in()) {
        redirec(PROOT . 'user/index');
    }

?>

    <section class="py-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 px-0">
                    <div class="sticky-top vh-lg-100 py-9">
                        <div class="bg-holder" style="background-image:url(../assets/media/bg-3.jpg);" data-zanim-trigger="scroll" data-zanim-lg='{"animation":"zoom-out-slide-right","delay":0.4}'></div>
                    </div>
                </div>
                <div class="col-lg-6 py-6">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-sm-8 col-md-6 col-lg-10 col-xl-8" data-zanim-xs='{"delay":0.5,"animation":"slide-right"}' data-zanim-trigger="scroll">
                            <h3 class="display-4 fs-2"><span class="fs-4">MIFO</span>. <br>Creat an account</h3>
                            <h6 class="text-secondary mt-3">A Brand That Is Here To Take You Through A Journey Of Historic Culture And Unique Way Of Life.</h6>
                            <form class="mt-5" method="POST" id="signupForm">
                                <span id="signup_errors"></span>
                                <div class="mb-3">
                                    <input class="form-control bg-light" type="text" id="user_fullname" name="user_fullname" placeholder="Full name" />
                                </div>
                                <div class="mb-3">
                                    <input class="form-control bg-light" type="email" id="user_email" name="user_email" placeholder="Email" />
                                </div>
                                <div class="mb-3">
                                    <input class="form-control bg-light" type="password" id="user_password" name="user_password" placeholder="Password" />
                                </div>
                                <div class="mb-0">
                                    <input class="form-control bg-light" type="password" id="repeat_password" name="repeat_password" placeholder="Repeat password" />
                                </div>
                                <div class="mb-3 d-grid">
                                    <button class="g-recaptcha btn btn-dark mt-3" data-sitekey="<?= RECAPTCHA_SITE_KEY; ?>" data-callback='submit_signup' data-action='submit' type="submit" name="submit_login" id="submit_login">sign up</button>
                                </div>
                                <br><br>
                                <a href="<?= PROOT; ?>shop/login" class="text-dark text-decoration-underline">Already have an account.</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://www.google.com/recaptcha/api.js"></script>