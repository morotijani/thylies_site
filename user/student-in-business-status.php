<?php 

    require_once ("../connection/conn.php");

    if (!user_is_logged_in()) {
        user_login_redirect();
    }

    $title = 'Student in Business Status - ';
    include ("inc/user.header.inc.php");

	if (!is_array(applied_student_in_business($user_data['user_unique_id']))) {
		redirect(PROOT . 'user/apply-student-in-business');
	}

 ?>

 <div class="pb-12 mt-lg-n18 mt-n10">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-md-8 col-12">
					<div class="card rounded-3 mb-4 ">
						<div class="card-header bg-white p-4">
							<h3 class="mb-0 h4">STUDENT BUSINESS FUND STATUS</h3>
						</div>
						<div class="card-body p-4">
							<div class="">
								<div class="alert alert-primary" role="alert">
								  	This is a primary alert—check it out!
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <?php include ('../inc/footer.inc.php'); ?>
    <script src="https://www.google.com/recaptcha/api.js"></script>