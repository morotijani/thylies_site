<?php 
	require ('./../connection/conn.php');

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
							<span class="d-inline-block me-3">👋</span>Hi, Tahlia!
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
		<div class="container-fluid">
			<div>
				<form action="code.php" method="POST" enctype="multipart/form-data">
					<div class="d-flex flex-column flex-sm-row justify-content-between gap-3">
						<div class="input-group input-group-lg input-group-inline">
							<span class="input-group-text pe-2"><i class="bi bi-file-text"></i> </span>
							<input type="file" class="form-control form-control-lg" name="import_file">
						</div>
						<buton type="submit" class="btn btn-lg btn-warning text-nowrap">Import</button>
					</div>
				</form>
			</div>
		</div>
	</main>
	
<?php include ('includes/footer.php'); ?>