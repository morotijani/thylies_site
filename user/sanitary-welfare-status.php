<?php 

    require_once ("../connection/conn.php");

    if (!user_is_logged_in()) {
        user_login_redirect();
    }

    $title = 'Student in Business Status - ';
    include ("inc/user.header.inc.php");

	if (!is_array(applied_sanitary_welfare($user_data['user_unique_id']))) {
		redirect(PROOT . 'user/apply-student-in-business');
	} else {
		$row = applied_sanitary_welfare($user_data['user_unique_id']);
	}

 ?>

 <div class="pb-12 mt-lg-n18 mt-n10">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-md-8 col-12">
					<div class="card rounded-3 mb-4 ">
						<div class="card-header bg-white p-4">
							<h3 class="mb-0 h4">SANITARY WELFARE STATUS</h3>
						</div>
						<div class="card-body p-4">
							<div class="">
								<div class="alert alert-<?= (($row['status'] == 1) ? 'success' : 'primary'); ?>" role="alert">
								  	<h3>SW Code: <?= $row['sw_id']; ?></h3>
								  	<h3>Submitted: <?= (($row['submitted'] == 1) ? 'Yes' : 'No'); ?></h3>
								  	<h3>Status: <?= (($row['status'] == 1) ? 'Gained' : 'Pending'); ?></h3>
								  	<hr>
								  	<h3>Date: <?= pretty_date($row['createdAt']); ?></h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <?php include ('../inc/footer.inc.php'); ?>
    <script src="https://www.google.com/recaptcha/api.js?render=<?= RECAPTCHA_SITE_KEY; ?>"></script>
