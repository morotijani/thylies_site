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
                <h2 class="mb-3 display-5 mt-2">Sanitary Products</h2>

                <div class="row">
                    <!-- coach -->
                    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                        <div class="mb-3">
                            <img src="<?= PROOT; ?>assets/media/sanitary-welfare/proper.jpg" alt="coach" class="img-fluid w-100 mb-4 rounded" style="width: 300px; height: 300px; object-fit: cover; object-position: center;">
                            <h4 class="mb-0">Victoria Howard</h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                        <div class="mb-3">
                            <img src="<?= PROOT; ?>assets/media/sanitary-welfare/yazz.jpg" alt="coach" class="img-fluid w-100 mb-4 rounded" style="width: 300px; height: 300px; object-fit: cover; object-position: center;">
                            <h4 class="mb-0">Victoria Howard</h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                        <div class="mb-3">
                            <img src="<?= PROOT; ?>assets/media/sanitary-welfare/always.jpg" alt="coach" class="img-fluid w-100 mb-4 rounded" style="width: 300px; height: 300px; object-fit: cover; object-position: center;">
                            <h4 class="mb-0">Victoria Howard</h4>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 text-center mt-5">
                        <a href="#" class="btn btn-primary">Meet the Coaches</a>
                    </div>
                </div>
            </div>
<?php include ('inc/footer.inc.php'); ?>