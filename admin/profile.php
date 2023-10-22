<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php";

    if (!admin_is_logged_in()) {
        admn_login_redirect();
    }

	include ('includes/header.php');
	include ('includes/left.side.bar.php');
	include ('includes/top.nav.bar.php');
?>


<div class="flex-lg-1 h-screen overflow-y-lg-auto">
	<header class="bg-surface-secondary">
		<div class="bg-cover" style="height:300px;background-image:url(<?= PROOT; ?>assets/media/logo/logo.jpg);background-position:center center"></div>
		<div class="container-fluid max-w-screen-xl">
			<div class="row g-0">
				<div class="col-auto">
					<a href="#" class="avatar w-40 h-40 border border-body border-4 rounded-circle shadow mt-n16">
						<img alt="..." src="<?= PROOT; ?>assets/media/svg/friendly-ghost.svg" class="rounded-circle">
					</a>
				</div>
				<div class="col ps-4 pt-4">
					<h6 class="text-xs text-uppercase text-muted mb-1"><?= $admin_data['admin_permissions']; ?></h6>
					<h1 class="h2"><?= $admin_data["admin_fullname"]; ?></h1>
					<div class="d-flex gap-2 flex-wrap mt-3 d-none d-sm-block">
						<a href="#" class="bg-white bg-opacity-50 bg-opacity-100-hover border rounded px-3 py-1 font-semibold text-heading text-xs">UI/UX</a> 
						<a href="#" class="bg-white bg-opacity-50 bg-opacity-100-hover border rounded px-3 py-1 font-semibold text-heading text-xs">Mobile Apps</a> 
						<a href="#" class="bg-white bg-opacity-50 bg-opacity-100-hover border rounded px-3 py-1 font-semibold text-heading text-xs">UI Research</a>
					</div>
				</div>
			</div>
			<ul class="nav nav-tabs overflow-x ms-1 mt-4">
				<li class="nav-item"><a href="<?= PROOT; ?>admin/profile" class="nav-link active font-bold">My profile</a></li>
				<li class="nav-item"><a href="<?= PROOT; ?>admin/settings" class="nav-link">Settings</a></li>
				<li class="nav-item"><a href="<?= PROOT; ?>admin/change-password" class="nav-link">Change Password</a></li>
			</ul>
		</div>
	</header>
	<main class="py-6 bg-surface-secondary">
		<div class="container-fluid max-w-screen-xl">
			<div class="row g-6">
				<div class="col-xl-8">
					<div class="vstack gap-6">
						<div class="card">
							<div class="card-body">
								<h5 class="mb-3">Details</h5>
								<div class="mb-3">
									<label for="">Full name</label>
									<input type="text" class="form-control" disabled value="<?= $admin_data['admin_fullname']; ?>">
								</div>
								<div class="mb-3">
									<label for="">Email address</label>
									<input type="email" class="form-control" disabled value="<?= $admin_data['admin_email']; ?>">
								</div>
								<div class="mb-3">
									<label for="">Join date</label>
									<input type="email" class="form-control" disabled value="<?= pretty_date($admin_data['admin_joined_date']); ?>">
								</div>
								<div class="mb-3">
									<label for="">Last login</label>
									<input type="email" class="form-control" disabled value="<?= pretty_date($admin_data['admin_last_login']); ?>">
								</div>
								<a href="<?= PROOT; ?>admin/settings" class="link-primary font-semibold text-sm">Update details</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<!--  -->
	<!-- <header>
		<div class="container-fluid">
			<div class="border-bottom pt-6">
				<div class="row align-items-center">
					<div class="col-sm col-12">
						<h1 class="h2 ls-tight">
							<span class="d-inline-block me-3">❤</span>Gained, Scholarship view
						</h1>
					</div>
					<div class="col-sm-auto col-12 mt-4 mt-sm-0">
						<div class="hstack gap-2 justify-content-sm-end">
							<a href="<?= PROOT; ?>admin/Scholarship-import" class="btn btn-sm btn-neutral border-base">
								<span class="pe-2"><i class="bi bi-arrow-clockwise"></i> </span>
								<span>Refresh</span> 
							</a>
							<a href="<?= PROOT; ?>admin/index" class="btn btn-sm btn-primary">
								<span class="pe-2"><i class="bi bi-arrow-left"></i> </span>
								<span>Go Back</span>
							</a>
						</div>
					</div>
				</div>
				<ul class="nav nav-tabs overflow-x border-0">
					<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship/import" class="nav-link">Import Data</a></li>
					<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship" class="nav-link">View all</a></li>
					<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship/rejected" class="nav-link">Rejected</a></li>
					<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship/gained" class="nav-link active">Gained</a></li>
				</ul>
			</div>
		</div>
	</header>

    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
			<?= $flash; ?>
            <div class="vstack gap-4">
                <div class="d-flex flex-column flex-md-row gap-3 justify-content-between">
                    <div class="d-flex gap-3">
                        <div class="input-group input-group-sm input-group-inline">
                            <span class="input-group-text pe-2"><i class="bi bi-search"></i> </span>
                            <input type="text" class="form-control" id="search" placeholder="Search" aria-label="Search">
                        </div>
                        <div class="dropdown">
                            <button type="button" class="btn btn-sm px-3 btn-neutral d-flex align-items-center" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-clipboard-data-fill me-2"></i> 
                                <span>Export</span> 
                                <span class="vr opacity-20 mx-3"></span> 
                                <span class="text-xs text-primary">Data</span>
                            </button>
                            <div class="dropdown-menu">
                                <a href="<?= PROOT; ?>admin/Scholarship/export/all/xlsx" class="dropdown-item">XLSX </a>
                                <a href="<?= PROOT; ?>admin/Scholarship/export/all/xls" class="dropdown-item">XLS </a>
                                <a href="<?= PROOT; ?>admin/Scholarship/export/all/csv" class="dropdown-item">CSV </a>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group">
                        <a href="<?= PROOT; ?>admin/Scholarship" class="btn btn-sm btn-neutral text-primary" aria-current="page">View all</a> 
                        <a href="<?= PROOT; ?>admin/Scholarship/trash" class="btn btn-sm btn-neutral">Trash</a> 
                        <a href="<?= PROOT; ?>admin/Scholarship/rejected" class="btn btn-sm btn-neutral">Rejected</a>
                    </div>
                </div>
                <div class="card">
                    <div id="load-content"></div>
                </div>
            </div>
        </div>
    </main> -->
	
<?php include ('includes/footer.php'); ?>

