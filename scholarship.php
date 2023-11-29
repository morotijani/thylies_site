<?php 
    require_once ("connection/conn.php");

    $title = 'Scholarhip Program - ';
    $navbar = 'navbar-light';

    include ('inc/header.inc.php');


?>
    <!-- hero section -->
    <div class="py-lg-20 pt-14 pb-10 bg-cover" style="background-image: url(<?= PROOT; ?>assets/media/bg-4.jpg);">
        <div class="container">
            <div class="row ">
                <div class="col-xl-6 col-lg-8 col-md-8 col-12">
                    <div class=" ">
                        <h1 class=" text-white mb-3 display-4">
                            THE THYLIES SCHOLARSHIP PROGRAM
                        </h1>
                        <a href="<?= PROOT; ?>user/apply-scholarship" class="btn btn-warning">Application form</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- course -->
    <div class="py-7 pt-lg-16 pb-lg-10">
        <div class="container">
            <div class="row">
                <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-12">
                    <div class="mb-8 text-center">
                        <h2 class="mb-3 h1">
                          Scholarship Program
                        </h2>
                        <p class="px-lg-10 lead">
                            Thylies Ghana recognizes that not all Girls are born with a silver spoon as such , The Scholarship program has been put in place to enable students of member School who demonstrate the need for financial assistance in their academic life to ensure solvency in the pursuit of academic excellence
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
                        <h2 class="mb-2 display-5">Process of Scholarship and bursary application</h2>
                        <p class="lead mb-0">The Thylies Scholarship program is opened to Institutions Thylies is functional in</p>
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
                                <p class="px-lg-7 lead">Candidates should be in actual need of financial assistance</p>
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
                                <p class="px-lg-7 lead">Candidates are to put together  a 500 letter essay(1 page ) introducing themselves and demonstrating the reason for which they should be considered for the Scholarship and bursary offers</p>
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
                                <p class="px-lg-7 lead">Applicants should be registered Member of Thylies</p>
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
                                <p class="px-lg-7 lead">Our goal is not to reward the brightest students but to remove financial barriers from every students in the chase for academic excellence</p>
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
                <p class="lead mb-0">We've got you covered all year.</p>
                <br>
                <a href="<?= PROOT; ?>user/apply-scholarship" class="btn btn-outline-warning">Apply Now!</a>
            </div>
        </div>
    </div>


            
<?php include ('inc/footer.inc.php'); ?>