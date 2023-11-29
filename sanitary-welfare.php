<?php 
    require_once ("connection/conn.php");

    $title = 'Sanitary Welfare - ';
    $navbar = 'navbar-light';

    include ('inc/header.inc.php');


?>
     <!-- hero section -->
        <div style="background: url(<?= PROOT; ?>assets/media/sanitary-welfare/bg-1.jpg); background-size: cover; background-repeat: no-repeat; background-position: center;">
            <div class="container">
                <div class="row">
                    <div class="offset-lg-2 col-lg-8 col-md-12 col-12">
                        <div class="pt-17 pb-13 pt-lg-19 pb-lg-19 text-center text-light">
                            <h1 class="display-3 text-light mb-3 lh-1" style="text-shadow: 4px 4px 4px #000;">
                                Sanitary Welfare
                            </h1>
                            <p class="px-xl-18 px-md-10 mb-5 lead" style="color: #333;">
                                Thylies offers you a variety of  choices tailored to meet your preference of Sanitary items
                            </p>
                            <a href="<?= PROOT; ?>user/apply-sanitary-welfare" class="btn btn-warning btn-lg">Application form</a>
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
                                Thylies protects you from excessive taxations that make the prices of your basic sanitary items woefully expensive therefore discouraging you from affording them though they are a necessity
                            </p>
                            <!--button-->
                            <a href="<?= PROOT; ?>user/apply-sanitary-welfare" class="btn btn-secondary btn-lg">Get Started</a>
                        </div>
                    </div>
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
                            <img src="<?= PROOT; ?>assets/media/sanitary-welfare/proper.jpg" alt="coach" class="img-fluid w-100 mb-4 rounded" style="width: 300px; height: 300px; object-fit: cover; object-position: center;">
                            <h4 class="mb-0">Propoer Sanitary Pad</h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                        <div class="mb-3">
                            <img src="<?= PROOT; ?>assets/media/sanitary-welfare/yazz.jpg" alt="coach" class="img-fluid w-100 mb-4 rounded" style="width: 300px; height: 300px; object-fit: cover; object-position: center;">
                            <h4 class="mb-0">Yazz Sanitary Pad</h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                        <div class="mb-3">
                            <img src="<?= PROOT; ?>assets/media/sanitary-welfare/always.jpg" alt="coach" class="img-fluid w-100 mb-4 rounded" style="width: 300px; height: 300px; object-fit: cover; object-position: center;">
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
                            <img src="<?= PROOT; ?>assets/media/sanitary-welfare/softcare-panty-liner.jpg
                            " alt="coach" class="img-fluid w-100 mb-4 rounded" style="width: 300px; height: 300px; object-fit: cover; object-position: center;">
                            <h4 class="mb-0">Softcare Panty Liner</h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                        <div class="mb-3">
                            <img src="<?= PROOT; ?>assets/media/sanitary-welfare/yazz-panty-liner.jpg" alt="coach" class="img-fluid w-100 mb-4 rounded" style="width: 300px; height: 300px; object-fit: cover; object-position: center;">
                            <h4 class="mb-0">Yazz Panty Liner</h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                        <div class="mb-3">
                            <img src="<?= PROOT; ?>assets/media/sanitary-welfare/proper-panty-liner.jpg" alt="coach" class="img-fluid w-100 mb-4 rounded" style="width: 300px; height: 300px; object-fit: cover; object-position: center;">
                            <h4 class="mb-0">Proper Panty Liner</h4>
                        </div>
                    </div>
                    <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-12 text-center mt-5">
                        <a href="#" class="btn btn-primary">Meet the Coaches</a>
                    </div> -->
                </div>
            </div>

            <div class="container">
                <hr>
            </div>

            <!-- prgoram -->
            <div class="py-lg-12 py-8">
                <div class="container">
                    <div class="mb-9">
                        <div class="row align-items-center">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <!--heading-->
                                <h2 class="h1">The 50% Discount Program.</h2>
                            </div>
                            <div class=" col-xl-6 col-lg-6 col-md-6 col-12">
                                <!--para-->
                                <p class="lead">
                                    The 50 percent Discount program seeks to ease the inflationary pressures on sanitary products which makes them very expensive hence discouraging the girl from purchasing enough to comfortably  suit her menstrual needs in order to enhance her self esteem and promote her wellbeing during her menstrual period

                                    <br>
                                    <br>
                                    With the fifty percent program , all member schools would be able to purchase all their basic menstrual welfare items at fifty percent discount all through 2023

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
                        <div class="offset-xl-2 col-xl-5 col-lg-7 col-md-12 col-12">
                            <div class="mb-12">
                                <h2 class="mb-2 display-5">Why Deena Nichols </h2>
                                <p class="lead mb-0">Lorem ipsum.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="card rounded-3 mb-5">
                                <div class="p-5 d-flex justify-content-between
                                    align-items-center">
                                    <div>
                                        <h4 class="mb-1">Certified trainer</h4>
                                        <p class="mb-0">Lorem ip.</p>
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
            </div>
            </div>
<?php include ('inc/footer.inc.php'); ?>