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
							<a href="#modalExport" class="btn btn-sm btn-neutral border-base" data-bs-toggle="modal">
								<span class="pe-2"><i class="bi bi-people-fill"></i> </span>
								<span>Share</span> 
							</a>
							<a href="#offcanvasCreate" class="btn btn-sm btn-primary" data-bs-toggle="offcanvas">
								<span class="pe-2"><i class="bi bi-plus-square-dotted"></i> </span>
								<span>Create</span>
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
		<div class="modal fade" id="modalExport" tabindex="-1" aria-labelledby="modalExport" aria-hidden="true"><div class="modal-dialog modal-dialog-centered"><div class="modal-content shadow-3"><div class="modal-header"><div class="icon icon-shape rounded-3 bg-soft-primary text-primary text-lg me-4"><i class="bi bi-globe"></i></div><div><h5 class="mb-1">Share to web</h5><small class="d-block text-xs text-muted">Publish and share link with anyone</small></div><div class="ms-auto"><div class="form-check form-switch me-n2"><input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="checked"> <label class="form-check-label" for="flexSwitchCheckChecked"></label></div></div></div><div class="modal-body"><div class="d-flex align-items-center mb-5"><div><p class="text-sm">Anyone with this link <span class="font-bold text-heading">can view</span></p></div><div class="ms-auto"><a href="#" class="text-sm font-semibold">Settings</a></div></div><div><div class="input-group input-group-inline"><input type="email" class="form-control" placeholder="username" value="https://webpixels.io/your-amazing-link"> <span class="input-group-text"><i class="bi bi-clipboard"></i></span></div><span class="mt-2 valid-feedback">Looks good!</span></div></div><div class="modal-footer"><div class="me-auto"><a href="#" class="text-sm font-semibold"><i class="bi bi-clipboard me-2"></i>Copy link</a></div><button type="button" class="btn btn-sm btn-neutral" data-bs-dismiss="modal">Close</button> <button type="button" class="btn btn-sm btn-success">Share file</button></div></div></div></div>

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
							<div class="mt-2 mb-0 text-sm">
								<span class="badge badge-pill bg-soft-success text-success me-2">
									<i class="bi bi-arrow-up me-1"></i>30% 
								</span>
								<span class="text-nowrap text-xs text-muted">Since last month</span>
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
									<div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
										<i class="bi bi-credit-card"></i>
									</div>
								</div>
							</div>
							<div class="mt-2 mb-0 text-sm">
								<span class="badge badge-pill bg-soft-success text-success me-2">
									<i class="bi bi-arrow-up me-1"></i>30% 
								</span>
								<span class="text-nowrap text-xs text-muted">Since last month</span>
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
										<i class="bi bi-people"></i>
									</div>
								</div>
							</div>
							<div class="mt-2 mb-0 text-sm">
								<span class="badge badge-pill bg-soft-success text-success me-2">
									<i class="bi bi-arrow-up me-1"></i>23% 
								</span>
								<span class="text-nowrap text-xs text-muted">Since last week</span>
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
										<i class="bi bi-clock-history"></i>
									</div>
								</div>
							</div>
							<div class="mt-2 mb-0 text-sm">
								<span class="badge badge-pill bg-soft-danger text-danger me-2">
									<i class="bi bi-arrow-down me-1"></i>-10% 
								</span>
								<span class="text-nowrap text-xs text-muted">Since last month</span>
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
										<i class="bi bi-minecart-loaded"></i>
									</div>
								</div>
							</div>
							<div class="mt-2 mb-0 text-sm">
								<span class="badge badge-pill bg-soft-success text-success me-2">
									<i class="bi bi-arrow-up me-1"></i>15% 
								</span>
								<span class="text-nowrap text-xs text-muted">Since yestearday</span>
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
									<div class="icon icon-shape bg-warning text-white text-lg rounded-circle">
										<i class="bi bi-minecart-loaded"></i>
									</div>
								</div>
							</div>
							<div class="mt-2 mb-0 text-sm">
								<span class="badge badge-pill bg-soft-success text-success me-2">
									<i class="bi bi-arrow-up me-1"></i>15% 
								</span>
								<span class="text-nowrap text-xs text-muted">Since yestearday</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header border-bottom">
					<h5 class="mb-0">current signups</h5>
				</div>
				<div class="table-responsive">
					<table class="table table-hover table-nowrap">
			            <thead class="table-light">
			                <tr>
			                    <th scope="col"></th>
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