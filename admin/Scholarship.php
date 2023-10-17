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
							<span class="d-inline-block me-3">😎</span>Scholarhip, List view
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
					<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship-import" class="nav-link">Import Data</a></li>
					<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship" class="nav-link active">View all</a></li>
					<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship/rejected" class="nav-link">Rejected</a></li>
					<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship/accepted" class="nav-link">Accpted</a></li>
				</ul>
			</div>
		</div>
	</header>

	<main class="py-6 bg-surface-secondary">
		<div class="container-fluid">
			<?= $flash; ?>
			<div>
				
			</div>
		</div>
	</main>

    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <div class="vstack gap-4">
                <div class="d-flex flex-column flex-md-row gap-3 justify-content-between">
                    <div class="d-flex gap-3">
                        <div class="input-group input-group-sm input-group-inline">
                            <span class="input-group-text pe-2"><i class="bi bi-search"></i> </span>
                            <input type="text" class="form-control" placeholder="Search" aria-label="Search"></div>
                            <div>
                                <button type="button" class="btn btn-sm px-3 btn-neutral d-flex align-items-center">
                                    <i class="bi bi-funnel me-2"></i> 
                                    <span>Filters</span> 
                                    <span class="vr opacity-20 mx-3"></span> 
                                    <span class="text-xs text-primary">2</span>
                                </button>
                            </div>
                        </div>
                        <div class="btn-group">
                            <a href="#" class="btn btn-sm btn-neutral text-primary" aria-current="page">View all</a> 
                            <a href="#" class="btn btn-sm btn-neutral">Private</a> 
                            <a href="#" class="btn btn-sm btn-neutral">Shared files</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header border-bottom d-flex align-items-center">
                            <h5 class="me-auto">All projects</h5>
                            <div class="dropdown">
                                <a class="text-muted" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <a href="#!" class="dropdown-item">Action </a>
                                    <a href="#!" class="dropdown-item">Another action </a>
                                    <a href="#!" class="dropdown-item">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap"><thead class="table-light"><tr><th scope="col">Name</th><th scope="col">Due Date</th><th scope="col">Status</th><th scope="col">Team</th><th scope="col">Completion</th><th></th></tr></thead><tbody><tr><td><img alt="..." src="/img/social/airbnb.svg" class="avatar avatar-sm rounded-circle me-2"> <a class="text-heading font-semibold" href="#">Website Redesign</a></td><td>23-01-2022</td><td><span class="badge badge-lg badge-dot"><i class="bg-warning"></i>In progress</span></td><td><div class="avatar-group"><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-1.jpg"> </a><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-3.jpg"> </a><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-4.jpg"></a></div></td><td><div class="d-flex align-items-center"><span class="me-2">38%</span><div><div class="progress" style="width:100px"><div class="progress-bar bg-warning" role="progressbar" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100" style="width:38%"></div></div></div></div></td><td class="text-end"><a href="#" class="btn btn-sm btn-neutral">View</a> <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button></td></tr><tr><td><img alt="..." src="/img/social/amazon.svg" class="avatar avatar-sm rounded-circle me-2"> <a class="text-heading font-semibold" href="#">E-commerce App</a></td><td>23-01-2022</td><td><span class="badge badge-lg badge-dot"><i class="bg-success"></i>Done</span></td><td><div class="avatar-group"><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-1.jpg"> </a><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-3.jpg"> </a><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-4.jpg"></a></div></td><td><div class="d-flex align-items-center"><span class="me-2">83%</span><div><div class="progress" style="width:100px"><div class="progress-bar bg-success" role="progressbar" aria-valuenow="83" aria-valuemin="0" aria-valuemax="100" style="width:83%"></div></div></div></div></td><td class="text-end"><a href="#" class="btn btn-sm btn-neutral">View</a> <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button></td></tr><tr><td><img alt="..." src="/img/social/bootstrap.svg" class="avatar avatar-sm rounded-circle me-2"> <a class="text-heading font-semibold" href="#">Learning Platform</a></td><td>23-01-2022</td><td><span class="badge badge-lg badge-dot"><i class="bg-danger"></i>Project at risk</span></td><td><div class="avatar-group"><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-1.jpg"> </a><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-3.jpg"> </a><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-4.jpg"></a></div></td><td><div class="d-flex align-items-center"><span class="me-2">4%</span><div><div class="progress" style="width:100px"><div class="progress-bar bg-danger" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="100" style="width:4%"></div></div></div></div></td><td class="text-end"><a href="#" class="btn btn-sm btn-neutral">View</a> <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button></td></tr><tr><td><img alt="..." src="/img/social/dribbble.svg" class="avatar avatar-sm rounded-circle me-2"> <a class="text-heading font-semibold" href="#">Design Portfolio</a></td><td>23-01-2022</td><td><span class="badge badge-lg badge-dot"><i class="bg-warning"></i>In progress</span></td><td><div class="avatar-group"><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-1.jpg"> </a><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-3.jpg"> </a><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-4.jpg"></a></div></td><td><div class="d-flex align-items-center"><span class="me-2">10%</span><div><div class="progress" style="width:100px"><div class="progress-bar bg-primary" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:10%"></div></div></div></div></td><td class="text-end"><a href="#" class="btn btn-sm btn-neutral">View</a> <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button></td></tr><tr><td><img alt="..." src="/img/social/spotify.svg" class="avatar avatar-sm rounded-circle me-2"> <a class="text-heading font-semibold" href="#">Our team's playlist</a></td><td>23-01-2022</td><td><span class="badge badge-lg badge-dot"><i class="bg-warning"></i>In progress</span></td><td><div class="avatar-group"><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-1.jpg"> </a><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-3.jpg"> </a><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-4.jpg"></a></div></td><td><div class="d-flex align-items-center"><span class="me-2">83%</span><div><div class="progress" style="width:100px"><div class="progress-bar bg-success" role="progressbar" aria-valuenow="83" aria-valuemin="0" aria-valuemax="100" style="width:83%"></div></div></div></div></td><td class="text-end"><a href="#" class="btn btn-sm btn-neutral">View</a> <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button></td></tr><tr><td><img alt="..." src="/img/social/uber.svg" class="avatar avatar-sm rounded-circle me-2"> <a class="text-heading font-semibold" href="#">Uber native app</a></td><td>23-01-2022</td><td><span class="badge badge-lg badge-dot"><i class="bg-secondary"></i>Not started</span></td><td><div class="avatar-group"><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-1.jpg"> </a><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-3.jpg"> </a><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-4.jpg"></a></div></td><td><div class="d-flex align-items-center"><span class="me-2">4%</span><div><div class="progress" style="width:100px"><div class="progress-bar bg-danger" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="100" style="width:4%"></div></div></div></div></td><td class="text-end"><a href="#" class="btn btn-sm btn-neutral">View</a> <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button></td></tr><tr><td><img alt="..." src="/img/social/codepen.svg" class="avatar avatar-sm rounded-circle me-2"> <a class="text-heading font-semibold" href="#">Code Examples for Devs</a></td><td>23-01-2022</td><td><span class="badge badge-lg badge-dot"><i class="bg-danger"></i>Project at risk</span></td><td><div class="avatar-group"><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-1.jpg"> </a><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-3.jpg"> </a><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-4.jpg"></a></div></td><td><div class="d-flex align-items-center"><span class="me-2">38%</span><div><div class="progress" style="width:100px"><div class="progress-bar bg-warning" role="progressbar" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100" style="width:38%"></div></div></div></div></td><td class="text-end"><a href="#" class="btn btn-sm btn-neutral">View</a> <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button></td></tr><tr><td><img alt="..." src="/img/social/slack.svg" class="avatar avatar-sm rounded-circle me-2"> <a class="text-heading font-semibold" href="#">Community Channel</a></td><td>23-01-2022</td><td><span class="badge badge-lg badge-dot"><i class="bg-danger"></i>Project at risk</span></td><td><div class="avatar-group"><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-1.jpg"> </a><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-3.jpg"> </a><a href="#" class="avatar avatar-xs rounded-circle text-white border border-1 border-solid border-card"><img alt="..." src="/img/people/img-4.jpg"></a></div></td><td><div class="d-flex align-items-center"><span class="me-2">74%</span><div><div class="progress" style="width:100px"><div class="progress-bar bg-success" role="progressbar" aria-valuenow="74" aria-valuemin="0" aria-valuemax="100" style="width:74%"></div></div></div></div></td><td class="text-end"><a href="#" class="btn btn-sm btn-neutral">View</a> <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button></td></tr></tbody></table></div><div class="card-footer border-0 py-5"><span class="text-muted text-sm">Showing 10 items out of 250 results found</span></div></div></div></div></main>
	
<?php include ('includes/footer.php'); ?>