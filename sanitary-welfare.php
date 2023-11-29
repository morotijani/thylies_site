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
                            <h1 class="display-3 text-white mb-3 lh-1">
                                Sanitary Welfare
                            </h1>
                            <p class="px-xl-18 px-md-10 mb-5 lead">
                                Thylies offers you a variety of  choices tailored to meet your preference of Sanitary items
                            </p>
                            <a href="pages/signin.html" class="btn btn-primary btn-lg">Get Ticket</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  <!--hero section-->

<?php include ('inc/footer.inc.php'); ?>