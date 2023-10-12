<?php 
    require_once ("connection/conn.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content=">Yoga Coach - Bootstrap 5 Personal Website Template">
    <meta name="keywords" content=">Yoga Coach, Personal website template">
    <meta name="author" content="Codescandy">
    <title>Home - Thylies</title>
    <link rel="stylesheet" href="<?= PROOT; ?>assets/css/plyr.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mansalva&family=Young+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gaegu" />
    <link href="https://fonts.googleapis.com/css2?family=Mansalva&family=Patrick+Hand&family=Young+Serif&display=swap" rel="stylesheet">

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
<body>

    <!-- header -->
    <!-- navigation start -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-default fixed-top border-3 border-top border-warning">
        <div class="container">
            <a class="navbar-brand" href="<?= PROOT; ?>"><img src="<?= PROOT; ?>assets/media/coach-yoga.svg"
                 alt=""></a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
             data-bs-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false"
             aria-label="Toggle navigation">
                <span class="icon-bar top-bar mt-0"></span>
                <span class="icon-bar middle-bar"></span>
                <span class="icon-bar bottom-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-default">
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                 data-bs-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false"
                 aria-label="Toggle navigation">
                    <i class="fas fa-times"></i>
                </button>
                <ul class="navbar-nav ms-auto me-lg-3 ">
                    <li class="nav-item dropdown disabled">
                        <a class="nav-link d-lg-none" href="#">
                            Menu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= PROOT; ?>" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href=" <?= PROOT; ?>scholarships" class="nav-link">Scholarships</a>
                    </li>
                    <li class="nav-item">
                        <a href=" <?= PROOT; ?>sanitary-welfare" class="nav-link">Sanitary Welfare</a>
                    </li>
                    <li class="nav-item">
                        <a href=" <?= PROOT; ?>student-in-business" class="nav-link">Student in Business</a>
                    </li>
                    <li class="nav-item">
                        <a href=" <?= PROOT; ?>about-us" class="nav-link">About</a>
                    </li>
                    <li class="nav-item">
                        <a href=" <?= PROOT; ?>countact-us" class="nav-link">Contact</a>
                    </li>
                </ul>
                <div class="ms-auto d-none d-lg-block ">
                    <a href=" <?= PROOT; ?>auth/login" class="btn btn-outline-warning btn-sm ">Login</a>
                    <a href=" <?= PROOT; ?>donate" class="btn btn-secondary btn-sm">Donate</a>
                </div>
            </div>
        </div>
    </nav>
    
    <main>
          <!-- hero section -->
    <div class="py-lg-19 pt-14 pb-10 bg-cover" style="background-image:linear-gradient(180deg, rgba(30, 24, 53, 0.4) 0%, rgba(30, 24, 53, 0.4) 90.16%),
      url(<?= PROOT; ?>assets/media/hero-1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-xxl-5 col-lg-6 col-md-8 col-12">
                    <div class="text-white">
                        <h5 class="text-muted mb-4">NB: make sure your url is: https://thylies.com</h5>
                        <h1 class="text-white mb-3 display-1" style="font-family: Gaegu; letter-spacing: 3px;">
                            Thylies.
                        </h1>
                        <h2 class="mb-3 text-white" style="font-family: Patrick Hand;">
                            Support a cause your care about.
                        </h2>
                        <p class="mb-3 pe-lg-12 pe-0 display-6" style="font-family: Mansalva; letter-spacing: 1px;">
                            Maecenas molestie sagittis tellus et venenatis. In suscipit tortor eget ante semper
                            suscipit. Mauris dictum elementum diam in laoreet.
                        </p>
                        <a href="scholarship" class="btn btn-warning btn-lg">Scholarship</a>
                        <a href="sanitary-welfare" class="btn btn-outline-warning ms-lg-1 mt-2 mt-lg-0">Sanitary Welfare</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--timing-->
    <section class="pt-lg-10 pt-6 position-relative z-1 pb-6 pb-md-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1 col-12">
                    <div class="border py-4 rounded-4 bg-white">
                        <div class="row">
                            <div class="col-xl-4 col-md-4 col-12">
                                <div class="text-center border-md-end mb-4 mb-md-0">
                                    <h5 class="text-muted">01</h5>
                                    <h4 class="fw-bold">Register</h4>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 col-12">
                                <div class="text-center border-md-end mb-4 mb-md-0">
                                    <h5 class="text-muted">02</h5>
                                    <h4 class="fw-bold">Pay entry fees</h4>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 col-12">
                                <div class="text-center">
                                    <h5 class="text-muted">03</h5>
                                    <h4 class="fw-bold">Access platform</h4>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <hr class="mt-n8 mb-10 d-none d-md-block">
    
    <!--private yoga-->
    <section class="py-lg-10 pb-6">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 col-12 col-12">
                    <div class="text-center mb-lg-9 mb-5">
                        <h2 class="fw-bold mb-3">Causes we are <span class="text-bottom-line">serving</span>.</h2>
                        <p class="mb-0">Lorem, ipsum dolor sit amet consectetur, adipisicing elit. Aliquid consectetur facilis magni facere archi.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="text-center p-lg-6 mb-5">
                        <div class="icon icon-shape rounded-circle bg-warning icon-lg bg-opacity-25 mb-5 text-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-display" viewBox="0 0 16 16">
                                <path d="M0 4s0-2 2-2h12s2 0 2 2v6s0 2-2 2h-4c0 .667.083 1.167.25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75c.167-.333.25-.833.25-1.5H2s-2 0-2-2V4zm1.398-.855a.758.758 0 0 0-.254.302A1.46 1.46 0 0 0 1 4.01V10c0 .325.078.502.145.602.07.105.17.188.302.254a1.464 1.464 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.758.758 0 0 0 .254-.302 1.464 1.464 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.757.757 0 0 0-.302-.254A1.46 1.46 0 0 0 13.99 3H2c-.325 0-.502.078-.602.145z" />
                            </svg>
                        </div>
                        <h4>Student Scholarship</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, quibusdam ipsa doloribus error mollitia soluta tempora minima perferendis accusamu.</p>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="text-center p-lg-6 mb-5 mb-md-0">
                        <div class="icon icon-shape rounded-circle bg-warning icon-lg bg-opacity-25 mb-5 text-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                          class="bi bi-calendar2-week" viewBox="0 0 16 16">
                              <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                              <path
                                d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4zM11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                            </svg>
                        </div>
                        <h4>Sanitary Welfare</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing, elit. Repellat numquam cupiditate placeat dig.</p>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="text-center p-lg-6">
                        <div class="icon icon-shape rounded-circle bg-warning icon-lg bg-opacity-25 mb-5 text-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house"
                          viewBox="0 0 16 16">
                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
                            </svg>
                        </div>
                        <h4>Student in Business</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur aspernatur alias dolorum repellendus esse ut pariatu.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--about-->
    <section class="py-lg-10 py-6">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-xl-6 col-md-12 col-lg-6 col-12">
                    <div class="mb-5 mb-xl-0">
                        <img src="<?= PROOT; ?>assets/media/bg-2.jpg" alt="about" class="img-fluid w-100 rounded-3">
                    </div>
                </div>
                <div class="col-xl-5 offset-xl-1 col-md-12 col-lg-6 col-12">
                    <div>
                      <span class="text-secondary text-uppercase fw-bold">Thylies . Associate</span>
                      <h2 class="fw-bold mt-5">I work via a holistic approach with an <span class="text-bottom-line">emphasis
                          on:</span></h2>
                      <p class="mb-5">Do you want to become an associate team member, retailer, salesperson, or executive? Find out how to land an associate position, including the skills you'll need, the education you should pursue, and the ways to advance your career.</p>
                      <ul class="list-unstyled mb-5">
                            <li class="mb-2">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                    </svg>
                                </span>
                                <span class="ms-1">Online YouTube Courses</span>
                            </li>
                            <li class="mb-2">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                    </svg>
                                </span>
                                <span class="ms-1">Private Courses</span>
                            </li>
                            <li class="mb-2">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                      class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                    </svg>
                                </span>
                                <span class="ms-1">Group Courses</span>
                            </li>
                        </ul>
                        <a href="#" class="btn btn-outline-warning">Become an Associate</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="'py-lg-10 pb-6">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-12">
                    <div class="mb-5">
                        <h3 class="fw-bold">Thylies</h3>
                    </div>
                </div>
            </div>
            <div class="table-responsive-xl">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="img-overlay img-zoom mb-4 mb-md-0 border-top border-5
                          border-secondary rounded-3">
                            <a href="#"><img class="img-fluid w-100" src="<?= PROOT; ?>assets/media/flyer-1.jpg" alt="fitness">
                                <div class="position-absolute bottom-0 text-white d-flex
                                  flex-column
                                  justify-content-end p-4">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="img-overlay img-zoom mb-4 mb-md-0 rounded-3
                          border-top border-5 border-warning">
                            <a href="#" class="text-white">
                                <img src="<?= PROOT; ?>assets/media/flyer-2.jpg" alt="fitness" class="img-fluid w-100">
                                <div class="position-absolute bottom-0 text-white d-flex
                                flex-column
                                justify-content-end p-4">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="img-overlay img-zoom mb-4 mb-md-0 rounded-3 border-top
                          border-5 border-success">
                            <a href="#" class="text-white">
                                <img src="<?= PROOT; ?>assets/media/flyer-3.jpg" alt="fitness" class="img-fluid w-100">
                                <div class="position-absolute bottom-0 d-flex flex-column
                                justify-content-end p-4">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12 col-12">
                    <div class="mt-5">
                        <a href="<?= PROOT; ?>gallery" class="btn btn-outline-warning">Explore our gallery</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="pt-18 pb-10 top-shape "
        style="background:linear-gradient(360deg, #FFFFFF 0%, rgba(255, 255, 255, 0) 102.23%), #F8F8F8;">
        <div class="container">
            <div class="row d-lg-flex align-items-center">
                <div class="offset-lg-3 col-lg-6 col-md-12 col-12">
                    <!--content-->
                    <div class="mb-8 text-center">
                        <h2 class="h1">Scholarship list 2023.</h2>
                        <p class="lead">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In urna lectus, mattis n rem ipsum
                            dolor sit amet consectetur.
                        </p>
                    </div>
                </div>
                <!--col-->
                <div class="offset-xl-1 col-xl-4 col-lg-6 col-md-6 col-12">
                    <div class="mb-4 mb-lg-0">
                        <img src="<?= PROOT; ?>assets/media/bg-5.jpg" alt="customer" class="img-fluid rounded">
                    </div>
                </div>
                <!--col-->
                <div class="offset-xl-1 col-xl-5 col-lg-6 col-md-6">
                    <i class="fas fa-quote-left font-28 text-secondary mb-5"></i>
                    <p class="h2 font-dm-serif font-italic font-weight-normal mb-3">
                        Thylies bring to you all the list of student who have gin thier scholarship <br>this year
                    </p>
                    <p class="font-14 mb-5">Thylies, Enterprise</p>
                    <a href="<?= PROOT; ?>scholarship-list" class="btn btn-primary">Check out the list</a>
                </div>
            </div>
        </div>
    </div>

    <!--online course-->
    <section class="bg-warning py-6 py-lg-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1 col-md-12 col-12">
                    <div class="row align-items-center">
                        <div class="col-xl-5 col-md-6 col-12 col-lg-6">
                            <div>
                                <h2 class="fw-bold text-white">Start by registering to get access to the syatem and our service</h2>
                                <p class="mb-5 text-white">Join thylies.com for an in person opportunities for you as a student, space is limited make sure to sign up ahead of time. Reach out with any questions.</p>
                                <a href="<?= PROOT; ?>auth/register" class="btn btn-primary">Register and learn more</a>
                            </div>
                        </div>
                        <div class="col-xl-6 offset-xl-1 col-md-6 col-12 col-lg-6">
                            <div class="text-center d-none d-md-block">
                                <img src="<?= PROOT; ?>assets/media/illustration-2.png" alt="yoga-coach" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  </main>

  <!-- footer -->
<div class="footer pt-11 pb-3 bg-dark text-body">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-4 col-6">
                <div class="mb-4">
                    <h4 class="mb-4 text-white">About</h4>
                    <ul class="list-unstyled list-group">
                        <li class="list-group-item"><a href="#" class="list-group-item-link">Thylies</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link">Scholarship list</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link">Press</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link">Social Feed</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link"> Help</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6">
                <div class="mb-4">
                    <h4 class="mb-4 text-white ">Resources</h4>
                    <ul class="list-unstyled list-group ">
                        <li class="list-group-item"><a href="<?= PROOT; ?>donate" class="list-group-item-link">Donate</a></li>
                        <li class="list-group-item"><a href="<?= PROOT; ?>scholarships" class="list-group-item-link">Scholarship</a></li>
                        <li class="list-group-item"><a href="<?= PROOT; ?>sanitary-welfare" class="list-group-item-link">Sanitary Welfare</a></li>
                        <li class="list-group-item"><a href="<?= PROOT; ?>student-in-business" class="list-group-item-link">Student in Business</a></li>
                        <li class="list-group-item"><a href="<?= PROOT; ?>auth/register" class="list-group-item-link">Join us</a></li>
                        <li class="list-group-item"><a href="<?= PROOT; ?>auth/login" class="list-group-item-link">Login</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6">
                <div class="mb-4">
                    <h4 class="mb-4 text-white ">Follow Me</h4>
                    <ul class="list-unstyled list-group">
                        <li class="list-group-item"><a href="https://" class="list-group-item-link">Instagram</a></li>
                        <li class="list-group-item"><a href="https://" class="list-group-item-link"> Facebook</a></li>
                        <li class="list-group-item"><a href="https://" class="list-group-item-link"> LinkedIn</a></li>
                        <li class="list-group-item"><a href="https://" class="list-group-item-link">YouTube</a></li>
                        <li class="list-group-item"><a href="https://" class="list-group-item-link">Twitter</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-12">
                <div class="mb-4">
                    <h4 class="mb-4 text-white">Subscribe to our newsletter</h4>
                    <div>
                        <p>Subscribe to get notified daily new motivational & inspiration tips.</p>
                        <form>
                            <div class="mb-3">
                                <input type="email" class="form-control border-white" placeholder="Email Address" required>
                            </div>
                            <button type="submit" class="btn btn-warning">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mt-8">
                    <ul class="list-inline">
                        <li class="list-inline-item">Copyright &copy; 2020<span id="copyright"> -
                            <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>
                        </span>, Inc.</li>
                        <li class="list-inline-item"><a href="<?= PROOT; ?>privacy-policy" class="text-reset"> Privacy Policy </a></li>
                        <li class="list-inline-item"><a href="<?= PROOT; ?>terms" class="text-reset"> Terms</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
  <!-- Optional JavaScript -->


  <!-- Libs JS -->
<script src="<?= PROOT; ?>assets/js/jquery.min.js"></script>
<script src="<?= PROOT; ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= PROOT; ?>assets/js/jquery.slimscroll.min.js"></script>



<!-- Theme JS -->
<script src="<?= PROOT; ?>assets/js/theme.min.js"></script>
<script src="<?= PROOT; ?>assets/plyr.min.js"></script>

</body>
</html>