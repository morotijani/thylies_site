<?php 

    require_once ("../connection/conn.php");

    if (user_is_logged_in()) {
        if (!check_payment_of_registration_fee($user_id)) {
            redirect(PROOT . 'auth/pay-registration');
        }
    } else {
        redirect(PROOT . 'auth/logout');
    }

    $title = 'Scholarship Status - ';
    include ("inc/user.header.inc.php");

    if (!is_array(applied_scholarship($user_id))) {
        // code...
        redirect(PROOT . 'user/apply-scholarship');
    } else {
    	$row = applied_scholarship($user_id);

    	$status = '';
    	$status_class = '';
    	if ($row[0]['status'] == 0) {
    		$status = 'Pending';
    		$status_class = 'info';
    	} else if ($row[0]['status'] == 1) {
    		$status = 'Success';
    		$status_class = 'success';
    	} else {
    		$status = 'Rejected';
    		$status_class = 'danger';
    	}
    }

?>

	<div class="pb-12 mt-lg-n18 mt-n10">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-md-8 col-12">
					<div class="card rounded-3 mb-4 ">
						<div class="card-header bg-white p-4">
							<h3 class="mb-0 h4">Scholarship Form</h3>
						</div>
						<div class="card-body p-4">
							<p class="mb-0">
								ID: <h2><?= $row[0]['scholarship_id']; ?></h2>
								Status: <h2 class="text-<?= $status_class; ?>"><?= $status; ?></h2>
								<br><br><a href="<?= PROOT; ?>scholarship-list">view all list.</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

