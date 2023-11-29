<?php 
    require_once ("connection/conn.php");

    $title = 'About us - ';
    $navbar = 'navbar-light';

    include ('inc/header.inc.php');


?>
     <!-- hero section -->
        <div style="background: url(<?= PROOT; ?>assets/media/sanitary-welfare/bg-3.jpg); background-size: cover; background-repeat: no-repeat; background-position: center;">
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
      <div class="row">
        <div class="offset-xl-1 col-xl-10 col-md-12 col-12 mb-lg-18 mb-8">
          <div class="row align-items-center">
            <div class="col-lg-6 col-12 mb-6 mb-lg-0">
              <div class="pe-xl-6 mb-4 mb-md-0">
                <!-- number -->
                <span class="text-uppercase fw-bold"><span class="text-primary">#1</span> Trainer in
                  Country</span>
                <!-- heading -->
                <h2 class="mb-3 display-5
                    mt-2">About Deena Nichols
                </h2>
                <!-- para -->
                <p class="fs-3">Donec sollicitudin augue ipsum, id
                  su
                  sem cursus epurus sapien, consequat at
                  pretium volutunt ultricies tristique.</p>
                <!-- para -->
                <p class="lead mb-4">Donec sollicitudin augue ipsum,
                  id suscipit sem cursus
                  epurus sapien, consequat at pretium volutunt
                  ultricies
                  tristique.</p>
                <!-- button -->
                <a href="#" class="btn btn-primary">Start Free Class</a>
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <!-- row -->
              <div class="row g-3">
                <div class="col-md-6">
                  <!-- img -->
                  <img src="../assets/images/fitness/fitness-img-3.jpg" alt="fitness" class="img-fluid w-100 rounded-3">
                </div>
                <!-- img -->
                <div class="col-md-6">
                  <!-- img -->
                  <img src="../assets/images/fitness/fitness-img-2.jpg" alt="fitness" class="img-fluid mb-3 w-100 rounded-3">
                  <!-- img -->
                  <img src="../assets/images/fitness/fitness-img-1.jpg" alt="fitness" class="img-fluid w-100 rounded-3">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php include ('inc/footer.inc.php'); ?>