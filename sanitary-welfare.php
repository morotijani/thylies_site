<?php 
    require_once ("connection/conn.php");

    $title = 'About us - ';
    $navbar = 'navbar-light';

    include ('inc/header.inc.php');


?>
     <!-- hero section -->
    <div class="bg-cover" style="background-image:linear-gradient(180deg, rgba(30, 24, 53, 0.4) 0%, rgba(30, 24, 53, 0.4) 90.16%),
            url(<?= PROOT; ?>assets/media/bg-1.jpg);">
        <div class="container">
            <div class="row">
                <div class="offset-lg-2 col-lg-8 col-md-12 col-12">
                    <div class="py-lg-20 py-12 text-white text-center">
                        <a class="popup-youtube icon-shape rounded-circle btn-play icon-xl
                                text-decoration-none mb-3" href="javascript:;"> <!-- https://www.youtube.com/watch?v=JRzWRZahOVU -->
                            <i class="fas fa-play"></i>
                        </a>

                        <!--heading-->
                        <h1 class="text-white mb-2 display-2">
                            Thylies Ghana
                        </h1>
                        <p class="mb-0 lead text-light mb-0">
                            Period with comfort.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-lg-16 py-6">
        <div class="container">
            <div class="row">
                <div class="offset-lg-2 col-lg-8 col-md-12 col-12">
                    <!--heading-->
                    <h2 class="mb-4">About Thylies</h2>
                    <p><?= nl2br($site_row['about_info']); ?></p>
                </div>
            </div>
        </div>
    </div>

<?php include ('inc/footer.inc.php'); ?>