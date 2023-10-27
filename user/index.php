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
			<div class="row justify-content-center">
				<div class="col-lg-9 col-md-8 col-12">
					<div class="card rounded-3 mb-4 ">
						<div class="card-header bg-white p-4">
							<h3 class="mb-0 h4">Welcome back,  <?= $user_data['first']; ?></h3>
						</div>
						<div class="card-body p-4">
							<div class="d-lg-flex align-items-center justify-content-between">
								<div class="d-flex align-items-center mb-4 mb-lg-0">
									
								</div>
								<div>
									<a href="#" class="btn btn-light btn-sm">Sanitary Welfare list</a>
									<a href="#" class="btn btn-light btn-sm">Student in Business list</a>
									<a href="#" class="btn btn-light btn-sm ">Scholarship list</a>
									<a href="<?= PROOT; ?>index" class="btn btn-light btn-sm">Visit site</a>
								</div>
							</div>
							<hr class="my-5">
							<ul class="list-group">
							  	<li class="list-group-item active">Cras justo odio</li>
							  	<li class="list-group-item">Dapibus ac facilisis in</li>
							  	<li class="list-group-item">Morbi leo risus</li>
							  	<li class="list-group-item">Porta ac consectetur ac</li>
							  	<li class="list-group-item">Vestibulum at eros</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php include ('../inc/footer.inc.php'); ?>