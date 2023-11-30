<?php 
    require_once ("connection/conn.php");

    $title = 'Student in Business - ';
    $navbar = 'navbar-light';

    include ('inc/header.inc.php');


?>
     <!-- hero section -->
        <div style="background: url(<?= PROOT; ?>assets/media/student-in-business-cover.jpg); background-size: cover; background-repeat: no-repeat; background-position: center;">
            <div class="container">
                <div class="row">
                    <div class="offset-lg-2 col-lg-8 col-md-12 col-12">
                        <div class="pt-17 pb-13 pt-lg-19 pb-lg-19 text-center text-light">
                            <h1 class="display-3 text-light mb-3 lh-1" style="text-shadow: 2px 2px 2px #000;">
                                The Student business Fund
                            </h1>
                            <p class="px-xl-18 px-md-10 mb-5 lead">
                                What business do you wish to start?
                            </p>
                            <a href="<?= PROOT; ?>user/apply-student-in-business" class="btn btn-warning btn-lg">Application form</a>
                            <a href="<?= PROOT; ?>student-in-business-list.php" class="btn btn-light"><?= date('Y'); ?> approved list</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <!-- course -->
        <div class="pt-lg-13 pb-lg-14 py-8 bg-dark">
            <div class="container">
                <div class="row">
                    <div class="offset-lg-2 col-lg-8 col-md-12 col-12">
                        <div class="text-center mb-12">
                            <!--title-->
                            <h2 class="text-white mb-3 h1">
                                We Care.
                            </h2>
                            <!--para-->
                            <p class="lead mb-5">
                                It is aimed at creating all the needed mentorship, Training and Financial grounding for students from member Schools to start businesses of their own  or expand their already existing businesses to grow and develop.
                            </p>
                            <!--button-->
                            <a href="<?= PROOT; ?>user/apply-student-in-business" class="btn btn-secondary btn-lg">Application form</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- prgoram -->
        <div class="py-lg-12 py-8">
            <div class="container">
                <div class="mb-9">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <!--heading-->
                            <h2 class="h1">How to get Started with the FUND</h2>
                        </div>
                        <div class=" col-xl-6 col-lg-6 col-md-6 col-12">
                            <!--para-->
                            <p class="lead">
                                Outline your business, describe what you do or the sort of business you intend to take on.
                                <br>
                                <br>
                                State your budget for starting your intended business or expanding your already existing business
                                <br>
                                <br>
                                A date would be set for approval and disbursement of funds and assigning resource personnels
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- features -->
        <div class="py-lg-18 py-12 bg-light">
            <div class="container">
                <div class="row">
                    <div class="offset-xl-2 col-xl-8 col-lg-7 col-md-12 col-12">
                        <div class="mb-12">
                            <h2 class="mb-2 display-5">Queries</h2>
                            <p class="lead mb-0">Easy and simple details we will like to know.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="card rounded-3 mb-5">
                            <div class="p-5 d-flex justify-content-between
                                align-items-center">
                                <div>
                                    <h4 class="mb-1">1</h4>
                                    <p class="px-lg-7 lead">What business do you wish to start?</p>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24
                                        24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round" class="feather
                                        feather-award text-primary">
                                      <circle cx="12" cy="8" r="7"></circle>
                                      <polyline points="8.21 13.89 7 23 12 20 17 23
                                          15.79 13.88"></polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card rounded-3 mb-5">
                            <div class="p-5 d-flex justify-content-between
                                align-items-center">
                                <div>
                                    <h4 class="mb-1">2</h4>
                                    <p class="px-lg-7 lead">What business are you into?</p>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24
                                        24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round" class="feather
                                        feather-award text-primary">
                                      <circle cx="12" cy="8" r="7"></circle>
                                      <polyline points="8.21 13.89 7 23 12 20 17 23
                                          15.79 13.88"></polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card rounded-3 mb-5">
                            <div class="p-5 d-flex justify-content-between
                                align-items-center">
                                <div>
                                    <h4 class="mb-1">3</h4>
                                    <p class="px-lg-7 lead">How is it going?</p>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24
                                        24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round" class="feather
                                        feather-award text-primary">
                                      <circle cx="12" cy="8" r="7"></circle>
                                      <polyline points="8.21 13.89 7 23 12 20 17 23
                                          15.79 13.88"></polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card rounded-3 mb-5">
                            <div class="p-5 d-flex justify-content-between
                                align-items-center">
                                <div>
                                    <h4 class="mb-1">4</h4>
                                    <p class="px-lg-7 lead">Do you have the resources you need to grow your business?</p>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24
                                        24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round" class="feather
                                        feather-award text-primary">
                                      <circle cx="12" cy="8" r="7"></circle>
                                      <polyline points="8.21 13.89 7 23 12 20 17 23
                                          15.79 13.88"></polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card rounded-3 mb-5">
                            <div class="p-5 d-flex justify-content-between
                                align-items-center">
                                <div>
                                    <h4 class="mb-1">5</h4>
                                    <p class="px-lg-7 lead">How much capital do you need to grow your business?</p>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24
                                        24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round" class="feather
                                        feather-award text-primary">
                                      <circle cx="12" cy="8" r="7"></circle>
                                      <polyline points="8.21 13.89 7 23 12 20 17 23
                                          15.79 13.88"></polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <p class="lead mb-0">We would make necessary provisions for your startup business to grow and develop.</p>
                    <br>
                    <a href="<?= PROOT; ?>user/apply-student-in-business" class="btn btn-outline-warning">Apply Now!</a>
                </div>
            </div>
        </div>
            
<?php include ('inc/footer.inc.php'); ?>