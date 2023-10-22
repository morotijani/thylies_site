	<!-- NAVBAR -->
	<div class="flex-lg-1 h-screen overflow-y-lg-auto">
		<header class="position-sticky top-0 overlap-10 bg-surface-primary border-bottom">
			<div class="container-fluid py-4">
				<div class="row align-items-center">
				<div class="col">
					<div class="d-flex align-items-center gap-4">
						<div>
							<button type="button" class="btn-close text-xs" aria-label="Close"></button>
						</div>
						<div class="vr opacity-20 my-1"></div>
						<h1 class="h4 ls-tight">Thylies Dashboard</h1>
					</div>
				</div>
				<div class="col-auto">
					<div class="hstack gap-2 justify-content-end">
						<a href="<?= PROOT; ?>admin/help" class="text-sm text-muted text-primary-hover font-semibold me-2 d-none d-md-block">
							<i class="bi bi-question-circle-fill"></i> 
							<span class="d-none d-sm-inline ms-2">Need help?</span> 
						</a>
						<a href="<?= PROOT; ?>admin" class="btn btn-sm btn-neutral border-base d-none d-md-block">
							<span>Dashboard</span>
						</a> 
						<a href="<?= PROOT; ?>admin/logout" class="btn btn-sm btn-primary">
							<span>Logout</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</header>