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
                    <a href=" <?= PROOT; ?>donate " class="btn btn-secondary btn-sm ">Donate</a>
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

    <!--upcoming course-->
    <section class="py-lg-10 py-6 bg-light">
      <div class="container">
        <!--row-->
        <div class="row">
          <div class="col-xl-8 offset-xl-2 col-md-12  col-12">
            <div class="text-center mb-lg-9 mb-5">
              <!--content-->
              <h2 class="fw-bold mb-3">
                <span class="text-bottom-line">Upcoming Courses</span>
              </h2>
              <p>Sign up for upcoming weekly classes and events orem ipsum dolor sit amet, consectetur adipiscing
                elit.</p>
              <!--content-->
            </div>
          </div>
        </div>
        <div class="table-responsive-xl">
          <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 flex-nowrap pb-4">
            <!--col-->
            <div class="col">
              <!--card-->
              <div class="card border-0 shadow mb-5">
                <!--image-->
                <a href="yoga-courses-single.html">
                  <img src="../assets/images/yoga/yoga-1.jpg" alt="yoga" class="img-fluid w-100 rounded-top">
                </a>
                <!--card body-->
                <div class="card-body p-5">
                  <!--heading-->
                  <h2 class="mb-2 h4">
                    <a href="yoga-courses-single.html" class="text-inherit">Yoga for Wellness</a>
                  </h2>
                  <p class="">Thursday's 7pm EST Via Zoom</p>
                  <div class="">
                    <span class="me-2">
                      <!--icon-->
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="var(--coach-gray-400)"
                        viewBox="0 0 16 16">
                        <path
                          d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                      </svg>
                      <span class="ms-1 fs-6">1 hour 15 minutes </span></span>

                    <span class="">
                      <!--icon-->
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="var(--coach-gray-400)"
                        class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path
                          d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                      </svg>
                      <span class="ms-1 fs-6">20 Students</span></span>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mt-4">

                      <h2 class="mb-0">$25.00</h2>


                      <!--link-->
                      


                      <a href="yoga-courses-single.html" class="icon-link icon-link-hover fw-bold link-secondary">Join Now <svg
                          xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                          class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                          <path fill-rule="evenodd"
                            d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                        </svg></a>

                  </div>
                </div>
              </div>

            </div>
            <div class="col">
              <!--card-->
              <div class="card border-0 shadow mb-5">
                <!--image-->
                <a href="yoga-courses-single.html">
                  <img src="../assets/images/yoga/yoga-2.jpg" alt="yoga" class="img-fluid w-100 rounded-top">
                </a>
                <!--card body-->
                <div class="card-body p-5">
                  <!--heading-->
                  <h2 class="mb-2 h4">
                    <a href="yoga-courses-single.html" class="text-inherit">Yoga for Preventive Health</a>
                  </h2>
                  <p class="">Monday 7am EST Via Zoom</p>
                  <div class="">
                    <span class="me-2">
                      <!--icon-->
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="var(--coach-gray-400)"
                        class="bi bi-clock-fill" viewBox="0 0 16 16">
                        <path
                          d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                      </svg>
                      <span class="ms-1 fs-6">60 minutes </span></span>

                    <span class="">
                      <!--icon-->
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="var(--coach-gray-400)"
                        class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path
                          d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                      </svg>
                      <span class="ms-1 fs-6">26 Students</span></span>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mt-4">

                      <h2 class="mb-0">$55.00</h2>


                      <!--link-->
                      <a href="yoga-courses-single.html" class="icon-link icon-link-hover fw-bold link-secondary">Join Now <svg
                          xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                          class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                          <path fill-rule="evenodd"
                            d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                        </svg></a>

                  </div>
                </div>
              </div>

            </div>
            <div class="col">
              <!--card-->
              <div class="card border-0 shadow mb-5">
                <!--image-->
                <a href="yoga-courses-single.html">
                  <img src="../assets/images/yoga/yoga-3.jpg" alt="yoga" class="img-fluid w-100 rounded-top">
                </a>
                <!--card body-->
                <div class="card-body p-5">
                  <!--heading-->
                  <h2 class="mb-2 h4">
                    <a href="yoga-courses-single.html" class="text-inherit">Therapeutic Yoga</a>
                  </h2>
                  <p class="">In Studio</p>
                  <div class="">
                    <span class="me-2">
                      <!--icon-->
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="var(--coach-gray-400)"
                        class="bi bi-clock-fill" viewBox="0 0 16 16">
                        <path
                          d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                      </svg>
                      <span class="ms-1 fs-6">1 hour 30 minutes</span></span>

                    <span class="">
                      <!--icon-->
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="var(--coach-gray-400)"
                        class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path
                          d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                      </svg>
                      <span class="ms-1 fs-6">32 Students</span></span>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mt-4">

                      <h2 class="mb-0">$75.00</h2>


                      <!--link-->
                      <a href="yoga-courses-single.html" class="icon-link icon-link-hover fw-bold link-secondary">Join Now <svg
                          xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                          class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                          <path fill-rule="evenodd"
                            d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                        </svg></a>

                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="mt-5 d-flex justify-content-center">
              <!--button-->
              <a href="#" class=" btn btn-primary">View All Courses</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--upcoming course-->
    <!--about-->
    <section class="py-lg-10 py-6">
      <div class="container">
        <!--row-->
        <div class="row d-flex align-items-center">
          <div class="col-xl-6 col-md-12 col-lg-6 col-12">
            <!--image-->
            <div class="mb-5 mb-xl-0">
              <img src="<?= PROOT; ?>assets/media/bg-2.jpg" alt="about" class="img-fluid w-100 rounded-3">
            </div>
          </div>
          <div class="col-xl-5 offset-xl-1 col-md-12 col-lg-6 col-12">
            <div>
              <!--content-->
              <span class="text-secondary text-uppercase fw-bold">Thylies . Associate</span>
              <h2 class="fw-bold mt-5">I work via a holistic approach with an <span class="text-bottom-line">emphasis
                  on:</span></h2>
              <p class="mb-5">Do you want to become an associate team member, retailer, salesperson, or executive? Find out how to land an associate position, including the skills you'll need, the education you should pursue, and the ways to advance your career.</p>
              <!--list-->
              <ul class="list-unstyled mb-5">
                <li class="mb-2">
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                      <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                  </span>
                  <span class="ms-1">Online YouTube Courses</span>
                </li>
                <li class="mb-2">
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                      <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                  </span>
                  <span class="ms-1">Private Courses</span>
                </li>
                <li class="mb-2">
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                      <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                  </span>
                  <span class="ms-1">Group Courses</span>
                </li>
              </ul>
              <!--list-->
              <!--button-->
              <a href="#" class="btn btn-outline-secondary">Become an Associate</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--about-->
    <!--video-->
    <section class="'py-lg-10 pb-6">
      <div class="container">
        <!--row-->
        <div class="row">
          <div class="col-xl-12 col-md-12 col-12">
            <div class="mb-5">
              <!--heading-->
              <h3 class="fw-bold">Our Gallery</h3>
            </div>
          </div>
        </div>
        <div class="table-responsive-xl">
          <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 flex-nowrap pb-4">

            <div class="col">
              <div class="position-relative">
                <!--video-->
                <div id="player" data-plyr-provider="youtube" data-plyr-embed-id="bTqVqk7FSmY"
                  data-poster="../assets/images/yoga/video-1.jpg"></div>
                <div class="position-absolute end-0 bottom-0 py-8 px-3">
                  <!--badge-->
                  <span class="badge bg-dark bg-opacity-50">12:30</span>
                </div>
                <!--content-->
                <h5 class="mt-4"> <a href="#" class="text-inherit">Center - Day 29 - Pleasure</a> </h5>
              </div>
            </div>
            <div class="col">
              <div class="position-relative">
                <!--video-->
                <div id="player2" data-plyr-provider="youtube" data-plyr-embed-id="bTqVqk7FSmY"
                  data-poster="../assets/images/yoga/video-2.jpg"></div>
                <div class="position-absolute end-0 bottom-0 py-8 px-3">
                  <!--badge-->
                  <span class="badge bg-dark bg-opacity-50">12:30</span>
                </div>
                <!--content-->
                <h5 class="mt-4"><a href="#" class="text-inherit">Center - Day 29 - Pleasure</a> </h5>
              </div>
            </div>
            <div class="col">
              <div>
                <div class="position-relative">
                  <!--video-->
                  <div id="player3" data-plyr-provider="youtube" data-plyr-embed-id="bTqVqk7FSmY"
                    data-poster="../assets/images/yoga/video-3.jpg"></div>
                  <div class="position-absolute end-0 bottom-0 mb-3 me-3">
                    <!--badge-->
                    <span class="badge bg-dark bg-opacity-50">8:24</span>
                  </div>
                </div>
                <!--content-->
                <h5 class="mt-5"> <a href="#" class="text-inherit">Center - Day 26 - Explore</a> </h5>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-12 col-md-12 col-12">
            <!--button-->
            <div class="mt-5">
              <a href="<?= PROOT; ?>gallery" class="btn btn-outline-secondary">Explore our gallery</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--video-->
    <!--the blog-->
    <section class="py-lg-10 py-6 bg-light">
      <div class="container">
        <!--row-->
        <div class="row">
          <div class="col-xl-12 col-md-12 col-12">
            <div class="mb-5">
              <!--content-->
              <h2 class="fw-bold">Latest on the blog</h2>
              <p>Sign up for upcoming weekly classes and events.</p>
            </div>
          </div>
        </div>
        <div class="table-responsive-xl">
          <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 flex-nowrap pb-4">
            <div class="col">
              <div class="mb-5 mb-xl-0">
                <div class="img-zoom">
                  <!--image-->
                  <a href="#">
                    <img src="../assets/images/yoga/blog-1.jpg" alt="blog" class="img-fluid w-100 rounded-3">
                  </a>
                </div>
                <!--content-->
                <h6 class="text-info mt-4">Business Coaching</h6>
                <h3 class="mb-3">
                  <!--heading-->
                  <a href="#" class="text-inherit">Strategic Thinking to Mindset Everything</a>
                </h3>
                <span>September 13, 2025</span>
              </div>
            </div>
            <div class="col">
              <div class="mb-5 mb-md-0">
                <div class="img-zoom">
                  <!--image-->
                  <a href="#">
                    <img src="../assets/images/yoga/blog-2.jpg" alt="blog" class="img-fluid w-100 rounded-3">
                  </a>
                </div>
                <!--content-->
                <h6 class="text-danger mt-4">Relationship</h6>
                <h3 class="mb-3">
                  <!--heading-->
                  <a href="#" class="text-inherit">Planning and Delivery Skills for Your Better Life</a>
                </h3>
                <span>September 11, 2025</span>
              </div>
            </div>
            <div class="col">
              <div>
                <div class="img-zoom">
                  <!--image-->
                  <a href="#">
                    <img src="../assets/images/yoga/blog-3.jpg" alt="blog" class="img-fluid w-100 rounded-3">
                  </a>
                </div>
                <!--content-->
                <h6 class="text-warning mt-4">Time Management</h6>
                <h3 class="mb-3">
                  <!--heading-->
                  <a href="#" class="text-inherit">Creating a Motivational Environment</a>
                </h3>
                <span>September 10, 2025</span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-12 col-md-12 col-12">
            <!--button-->
            <div class="mt-5">
              <a href="#" class="btn btn-primary">View All</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--the blog-->
    <!--online course-->
    <section class="bg-warning py-6 py-lg-0">
      <div class="container">
        <!--row-->
        <div class="row">
          <div class="col-xl-10 offset-xl-1 col-md-12 col-12">
            <div class="row align-items-center">
              <div class="col-xl-5 col-md-6 col-12 col-lg-6">
                <!--content-->
                <div>
                  <h2 class="fw-bold text-white">Start by registering to get access to the syatem and our service</h2>
                  <p class="mb-5 text-white">Join thylies.com for an in person opportunities for you as a student, space is limited
                    make sure to sign up ahead of time. Reach out with any questions.</p>
                  <!--button-->
                  <a href="<?= PROOT; ?>auth/register" class="btn btn-primary">Register and learn more</a>
                </div>
              </div>
              <div class="col-xl-6 offset-xl-1 col-md-6 col-12 col-lg-6">
                <!--image-->
                <div class="text-center d-none d-md-block">
                  <img src="<?= PROOT; ?>assets/media/illustration-2.png" alt="yoga-coach" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--online course-->
  </main>

  <!-- footer -->
<div class="footer pt-11 pb-3 bg-dark text-body">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-4 col-6">
                <div class="mb-4">
                    <h4 class="mb-4 text-white">About</h4>
                    <ul class="list-unstyled list-group">
                        <li class="list-group-item"><a href="#" class="list-group-item-link">Meet Coach</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link">Press</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link">Social Feed</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link"> Help</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6">
                <div class="mb-4">
                    <h4 class="mb-4 text-white ">Blog</h4>
                    <ul class="list-unstyled list-group ">
                        <li class="list-group-item"><a href="#" class="list-group-item-link">Business Coaching</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link">Relationship</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link">Leadership</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link">Life Coaching</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link">Time Management</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6">
                <div class="mb-4">
                    <h4 class="mb-4 text-white ">Resources</h4>
                    <ul class="list-unstyled list-group ">
                        <li class="list-group-item"><a href="#" class="list-group-item-link">Online Courses</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link"> Books Meditation</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link"> Podcast</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link">Albums</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link">Download App</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6">
                <div class="mb-4">
                    <h4 class="mb-4 text-white ">Follow Me</h4>
                    <ul class="list-unstyled list-group">
                        <li class="list-group-item"><a href="#" class="list-group-item-link">Instagram</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link"> Facebook</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link"> LinkedIn</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link">YouTube</a></li>
                        <li class="list-group-item"><a href="#" class="list-group-item-link">Twitter</a></li>
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
                            <button type="submit" class="btn btn-primary">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mt-8">
                    <ul class="list-inline">
                        <li class="list-inline-item">Copyright © 2020<span id="copyright"> -
                            <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>
                        </span>, Inc.</li>
                        <li class="list-inline-item"><a href="#" class="text-reset"> Privacy Policy </a></li>
                        <li class="list-inline-item"><a href="#" class="text-reset"> Terms</a></li>
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