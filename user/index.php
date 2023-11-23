<?php 

    require_once ("../connection/conn.php");

    if (user_is_logged_in()) {
        // if (!check_payment_of_registration_fee($user_id)) {
        //     redirect(PROOT . 'auth/pay-registration');
        // }
    } else {
        redirect(PROOT . 'auth/logout');
    }

    // if (is_array(apllied_scholarship($user_id))) {
    //     // code...
    //     redirect(PROOT . 'user/scholarship-status');
    // }

    $title = 'Welcome back - ';
    include ("inc/user.header.inc.php");

?>

	<div class="pb-12 mt-lg-n18 mt-n10">
		<div class="container">
			<?= $flash; ?>
			<div class="row justify-content-center">
				<div class="col-lg-9 col-md-8 col-12">
					<div class="card rounded-3 mb-4 ">
						<div class="card-header bg-white p-4">
							<h3 class="mb-0 h4">Welcome back,  <?= $user_data['first']; ?></h3>
						</div>
						<div class="card-body p-4">
							<div class="d-lg-flex align-items-center justify-content-between">
								<div class="d-flex align-items-center mb-4 mb-lg-0">
									<h5>Listinnings</h5>
								</div>
								<div>
									<a href="<?= PROOT; ?>sanitary-welfare-list" class="btn btn-light btn-sm">Sanitary Welfare list</a>
									<a href="<?= PROOT; ?>student-in-business-list" class="btn btn-light btn-sm">Student in Business list</a>
									<a href="<?= PROOT; ?>scholarship-list" class="btn btn-light btn-sm ">Scholarship list</a>
									<a href="<?= PROOT; ?>user/settings" class="btn btn-sm">Settings</a>
								</div>
							</div>
							<hr class="my-5">
							<?= check_user_verified($user_data['user_verified'], $user_data['user_email']); ?>
							<ul class="list-group">
							  	<li class="list-group-item active">Profile</li>
							  	<li class="list-group-item">
							  		<h3>Full name</h3>
							  		<h6><?= ucwords($user_data['user_fullname']); ?></h6>
							  	</li>
							  	<li class="list-group-item">
							  		<h3>Student ID</h3>
							  		<h6><?= $user_data['user_index_number']; ?></h6>
							  	</li>
							  	<li class="list-group-item">
							  		<h3>School</h3>
							  		<h6><?= ucwords($user_data['user_school_name']); ?></h6>
							  	</li>
							  	<li class="list-group-item">
							  		<h3>Email</h3>
							  		<h6><?= $user_data['user_email']; ?></h6>
							  	</li>
							  	<li class="list-group-item">
							  		<h3>Gender</h3>
							  		<h6><?= $user_data['user_gender']; ?></h6>
							  	</li>
							  	<li class="list-group-item">
							  		<h3>Joined Date</h3>
							  		<h6><?= pretty_date_half($user_data['user_joined_date']); ?></h6>
							  	</li>
							  	<hr>
							  	<li class="list-group-item">
							  		<h3>Last Log in</h3>
							  		<h6><?= pretty_date($user_data['user_last_login']); ?></h6>
							  	</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php include ('../inc/footer.inc.php'); ?>