<?php 
	require ('./../connection/conn.php');

	if (!admin_is_logged_in()) {
        admn_login_redirect();
    }

	include ('includes/header.php');
	include ('includes/left.side.bar.php');
	include ('includes/top.nav.bar.php');
?>

	<!--  -->
	<header>
		<div class="container-fluid">
			<div class="border-bottom pt-6">
				<div class="row align-items-center">
					<div class="col-sm col-12">
						<h1 class="h2 ls-tight">
							<span class="d-inline-block me-3">👋</span>Hi, <?= $admin_data['first']; ?>!
						</h1>
					</div>
					<div class="col-sm-auto col-12 mt-4 mt-sm-0">
						<div class="hstack gap-2 justify-content-sm-end">
							<a href="<?= PROOT; ?>admin/donations" class="btn btn-sm btn-neutral border-base">
								<span class="pe-2"><i class="bi bi-wallet2"></i> </span>
								<span>Donations</span> 
							</a>
							<a href="<?= PROOT; ?>contacts" class="btn btn-sm btn-primary" data-bs-toggle="offcanvas">
								<span class="pe-2"><i class="bi bi-phone"></i> </span>
								<span>Contacts</span>
							</a>
						</div>
					</div>
				</div>
				<ul class="nav nav-tabs overflow-x border-0">
					<li class="nav-item"><a href="#" class="nav-link active">View all</a></li>
					<li class="nav-item"><a href="#" class="nav-link">Most recent</a></li>
					<li class="nav-item"><a href="#" class="nav-link">Popular</a></li>
				</ul>
			</div>
		</div>
	</header>

	<main class="py-6 bg-surface-secondary">
		<div class="container-fluid">
			<div class="row g-6 mb-6">
				<div class="col-xl-8">
					<div class="card">
						<div class="card-header d-flex align-items-center">
							<h5 class="mb-0">Orders</h5>
							<button class="btn btn-sm btn-neutral ms-auto">Export</button>
						</div>
						<div class="px-4">
							<div id="chart-line" data-height="300"></div>
						</div>
					</div>
				</div>
				<div class="col-xl-4">
					<div class="card h-full">
						<div class="card-body">
							<div class="card-title d-flex align-items-center">
								<h5 class="mb-0">Currently Paid</h5>
								<div class="ms-auto text-end">
									<a href="#" class="text-sm font-semibold">See all</a>
								</div>
							</div>
							<div class="list-group gap-4">
								<?= get_currently_paid(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row g-6 mb-6">
				<div class="col-sm-6 col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<span class="h6 font-semibold text-muted text-sm d-block mb-2">Total Amount</span> 
									<span class="h3 font-bold mb-0"><?= total_service_amount(); ?></span>
								</div>
								<div class="col-auto">
									<div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
										<i class="bi bi-credit-card"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<span class="h6 font-semibold text-muted text-sm d-block mb-2">Donations</span> 
									<span class="h3 font-bold mb-0"><?= total_donation_amount(); ?></span>
								</div>
								<div class="col-auto">
									<div class="icon icon-shape bg-success text-white text-lg rounded-circle">
										<i class="bi bi-wallet2"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<span class="h6 font-semibold text-muted text-sm d-block mb-2">Scholarships</span> 
									<span class="h3 font-bold mb-0"><?= count_scholarship(); ?></span>
								</div>
								<div class="col-auto">
									<div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
										<i class="bi bi-building"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<span class="h6 font-semibold text-muted text-sm d-block mb-2">Sanitary Welfare</span> 
									<span class="h3 font-bold mb-0"><?= count_sanitary_welfare(); ?></span>
								</div>
								<div class="col-auto">
									<div class="icon icon-shape bg-info text-white text-lg rounded-circle">
										<i class="bi bi-gender-female"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<span class="h6 font-semibold text-muted text-sm d-block mb-2">Student in Business</span> 
									<span class="h3 font-bold mb-0"><?= count_student_in_business(); ?></span>
								</div>
								<div class="col-auto">
									<div class="icon icon-shape bg-warning text-white text-lg rounded-circle">
										<i class="bi bi-briefcase"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<span class="h6 font-semibold text-muted text-sm d-block mb-2">Associates</span> 
									<span class="h3 font-bold mb-0">95%</span>
								</div>
								<div class="col-auto">
									<div class="icon icon-shape bg-dark text-white text-lg rounded-circle">
										<i class="bi bi-person-lines-fill"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header border-bottom">
					<h5 class="mb-0">Current signups</h5>
				</div>
				<div class="table-responsive">
					<table class="table table-hover table-nowrap">
			            <thead class="table-light">
			                <tr>
			                    <th scope="col">Name</th>
			                    <th scope="col">Email</th>
			                    <th scope="col">Phone</th>
			                    <th scope="col">Created Date</th>
			                    <th scope="col">Index Number</th>
			                    <th scope="col">Gender</th>
			                    <th scope="col">Status</th>
			                    <th></th>
			                </tr>
			            </thead>
			            <tbody>
			            	<?= last_five_users(); ?>
			            </tbody>
			        </table>
				</div>
			</div>
		</div>

	
<?php include ('includes/footer.php'); ?>