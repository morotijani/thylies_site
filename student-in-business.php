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
                </div>
                <div class="text-center">
                    <p class="lead mb-0">We've got you covered all semester all year.</p>
                    <br>
                    <a href="<?= PROOT; ?>user/apply-sanitary-welfare" class="btn btn-outline-warning">Apply Now!</a>
                </div>
            </div>
        </div>

        <div class="pt-lg-18 pb-lg-16 py-10">
            <div class="container">
                <span class="text-uppercase fw-bold"><span class="text-primary">#1</span> Sanitary Welfare</span>
                <h2 class="mb-3 display-5 mt-2">Sanitary Pads</h2>

                <div class="row mb-10">
                    <!-- coach -->
                    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                        <div class="mb-3">
                            <img src="<?= PROOT; ?>assets/media/proper.jpg" alt="coach" class="img-fluid w-100 mb-4 rounded" style="width: 300px; height: 300px; object-fit: cover; object-position: center;">
                            <h4 class="mb-0">Propoer Sanitary Pad</h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                        <div class="mb-3">
                            <img src="<?= PROOT; ?>assets/media/yazz.jpg" alt="coach" class="img-fluid w-100 mb-4 rounded" style="width: 300px; height: 300px; object-fit: cover; object-position: center;">
                            <h4 class="mb-0">Yazz Sanitary Pad</h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                        <div class="mb-3">
                            <img src="<?= PROOT; ?>assets/media/always.jpg" alt="coach" class="img-fluid w-100 mb-4 rounded" style="width: 300px; height: 300px; object-fit: cover; object-position: center;">
                            <h4 class="mb-0">Always Ultra Sanitary Pad</h4>
                        </div>
                    </div>
                    <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-12 text-center mt-5">
                        <a href="#" class="btn btn-primary">Meet the Coaches</a>
                    </div> -->
                </div>

                <span class="text-uppercase fw-bold"><span class="text-primary">#2</span> Sanitary Welfare</span>
                <h2 class="mb-3 display-5 mt-2">Brands of Panty Liners</h2>

                <div class="row mb-10">
                    <!-- coach -->
                    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                        <div class="mb-3">
                            <img src="<?= PROOT; ?>assets/media/softcare-panty-liner.jpg
                            " alt="coach" class="img-fluid w-100 mb-4 rounded" style="width: 300px; height: 300px; object-fit: cover; object-position: center;">
                            <h4 class="mb-0">Softcare Panty Liner</h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                        <div class="mb-3">
                            <img src="<?= PROOT; ?>assets/media/yazz-panty-liner.jpg" alt="coach" class="img-fluid w-100 mb-4 rounded" style="width: 300px; height: 300px; object-fit: cover; object-position: center;">
                            <h4 class="mb-0">Yazz Panty Liner</h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                        <div class="mb-3">
                            <img src="<?= PROOT; ?>assets/media/proper-panty-liner.jpg" alt="coach" class="img-fluid w-100 mb-4 rounded" style="width: 300px; height: 300px; object-fit: cover; object-position: center;">
                            <h4 class="mb-0">Proper Panty Liner</h4>
                        </div>
                    </div>
                    <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-12 text-center mt-5">
                        <a href="#" class="btn btn-primary">Meet the Coaches</a>
                    </div> -->
                </div>
            </div>


            
<?php include ('inc/footer.inc.php'); ?>