<!-- LEFT SIDE -->
		<nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg scrollbar" id="sidebar">
			<div class="container-fluid">
				<button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button> 
				<a class="navbar-brand d-inline-block py-lg-2 mb-lg-5 px-lg-6 me-0" href="<?= PROOT; ?>admin/">
					<img src="<?= PROOT; ?>assets/media/logo/logo-min.png" alt="..."></a>
					<div class="navbar-user d-lg-none">
						<div class="dropdown">
							<a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<div class="avatar-parent-child">
									<img alt="..." src="<?= PROOT; ?>assets/media/svg/friendly-ghost.svg" class="avatar avatar- rounded-circle"> 
									<span class="avatar-child avatar-badge bg-success"></span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarAvatar">
								<a href="<?= PROOT; ?>admin/profile" class="dropdown-item">Profile</a> 
								<a href="<?= PROOT; ?>admin/settings" class="dropdown-item">Settings</a> 
								<a href="<?= PROOT; ?>admin/change-password" class="dropdown-item">Change Password</a>
								<hr class="dropdown-divider">
								<a href="<?= PROOT; ?>admin/logout" class="dropdown-item">Logout</a>
							</div>
						</div>
					</div>
					<div class="collapse navbar-collapse" id="sidebarCollapse">
						<ul class="navbar-nav">
							<li class="nav-item">
								<a class="nav-link" href="#sidebar-projects" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebar-projects">
									<i class="bi bi-briefcase"></i> Dashboard</a>
									<div class="collapse" id="sidebar-projects">
										<ul class="nav nav-sm flex-column">
											<li class="nav-item"><a href="<?= PROOT; ?>admin/" class="nav-link">Overview</a></li>
											<li class="nav-item"><a href="<?= PROOT; ?>admin/donations" class="nav-link">Donations</a></li>
											<li class="nav-item"><a href="<?= PROOT; ?>admin/donations" class="nav-link">Site</a></li>
											<li class="nav-item"><a href="<?= PROOT; ?>admin/donations" class="nav-link">Contacts</a></li>
											<li class="nav-item"><a href="<?= PROOT; ?>admin/donations" class="nav-link">Subscriptions</a></li>
										</ul>
									</div>
								</li>
								<li class="nav-item"><a class="nav-link" href="#sidebar-scholarship" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebar-scholarship">
									<i class="bi bi-building"></i> Scholarship</a>
									<div class="collapse" id="sidebar-scholarship">
										<ul class="nav nav-sm flex-column">
											<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship/import" class="nav-link">Import data</a></li>
											<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship" class="nav-link">List View</a></li>
											<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship/trash" class="nav-link">Trash</a></li>
										</ul>
									</div>
								</li>
								<li class="nav-item"><a class="nav-link" href="#sidebar-sanitary" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebar-sanitary">
									<i class="bi bi-person-standing-dress"></i> Sanitary Welfare</a>
									<div class="collapse" id="sidebar-sanitary">
										<ul class="nav nav-sm flex-column">
											<li class="nav-item"><a href="<?= PROOT; ?>admin/SW/index" class="nav-link">List View</a></li>
											<li class="nav-item"><a href="<?= PROOT; ?>admin/SW/gained" class="nav-link">Gained</a></li>
											<li class="nav-item"><a href="<?= PROOT; ?>admin/SW/rejected" class="nav-link">Rejected</a></li>
											<li class="nav-item"><a href="<?= PROOT; ?>admin/SW/trash" class="nav-link">Trash</a></li>
										</ul>
									</div>
								</li>
								<li class="nav-item"><a class="nav-link" href="#sidebar-business" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebar-business">
									<i class="bi bi-duffle-fill"></i> Student in Business</a>
									<div class="collapse" id="sidebar-business">
										<ul class="nav nav-sm flex-column">
											<li class="nav-item"><a href="<?= PROOT; ?>admin/SIB/index" class="nav-link">List View</a></li>
											<li class="nav-item"><a href="<?= PROOT; ?>admin/SIB/gained" class="nav-link">Gained</a></li>
											<li class="nav-item"><a href="<?= PROOT; ?>admin/SIB/rejected" class="nav-link">Rejected</a></li>
											<li class="nav-item"><a href="<?= PROOT; ?>admin/SIB/trash" class="nav-link">Trash</a></li>
										</ul>
									</div>
								</li>
								<li class="nav-item"><a class="nav-link" href="#sidebar-associate" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebar-associate">
									<i class="bi bi-person-lines-fill"></i> Associate</a>
									<div class="collapse" id="sidebar-associate">
										<ul class="nav nav-sm flex-column">
											<li class="nav-item"><a href="/pages/tasks/overview.html" class="nav-link">Import data</a></li>
											<li class="nav-item"><a href="/pages/tasks/list-view.html" class="nav-link">List View</a></li>
										</ul>
									</div>
								</li>
								<li class="nav-item"><a class="nav-link" href="#sidebar-users" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebar-users">
									<i class="bi bi-people"></i> Users</a>
									<div class="collapse" id="sidebar-users">
										<ul class="nav nav-sm flex-column">
											<li class="nav-item"><a href="<?= PROOT; ?>admin/User/" class="nav-link">All users</a></li>
											<li class="nav-item"><a href="<?= PROOT; ?>admin/User/trash" class="nav-link">Trash</a></li>
										</ul>
									</div>
								</li>
							</ul>
							<hr class="navbar-divider my-4 opacity-70">
							<ul class="navbar-nav">
								<li><span class="nav-link text-xs font-semibold text-uppercase text-muted ls-wide">Resources</span></li>
								<li class="nav-item"><a class="nav-link py-2 d-flex align-items-center" href="<?= PROOT; ?>admin/admins"><i class="bi bi-person-fill-gear"></i> <span>Admins</span></a></li>
								<li class="nav-item"><a class="nav-link py-2" href="<?= PROOT?>admin/docs"><i class="bi bi-code-square"></i> Documentation</a></li>
							</ul>
							<div class="mt-auto"></div>
							<div class="my-4 px-lg-6 position-relative">
								<div class="dropup w-full">
									<button class="btn-primary d-flex w-full py-3 ps-3 pe-4 align-items-center shadow shadow-3-hover rounded-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
										<span class="me-3"><img alt="..." src="<?= PROOT; ?>assets/media/svg/friendly-ghost.svg" class="avatar avatar-sm rounded-circle"> </span>
										<span class="flex-fill text-start text-sm font-semibold"><?= ucwords($admin_data['admin_fullname']); ?> </span>
										<span><i class="bi bi-chevron-expand text-white text-opacity-70"></i></span>
									</button>
									<div class="dropdown-menu dropdown-menu-end w-full">
										<div class="dropdown-header">
											<span class="d-block text-sm text-muted mb-1">Signed in as</span> 
											<span class="d-block text-heading font-semibold"><?= ucwords($admin_data['admin_fullname']); ?></span>
										</div>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="<?= PROOT; ?>admin/"><i class="bi bi-house me-3"></i>Home </a>
										<a class="dropdown-item" href="<?= PROOT; ?>admin/profile"><i class="bi bi-pencil me-3"></i>Profile </a>
										<a class="dropdown-item" href="<?= PROOT; ?>admin/settings"><i class="bi bi-gear me-3"></i>Settings</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="<?= PROOT; ?>admin/logout"><i class="bi bi-box-arrow-left me-3"></i>Logout</a>
									</div>
								</div>
								<!-- <div class="d-flex gap-3 justify-content-center align-items-center mt-6 d-none">
									<div>
										<i class="bi bi-moon-stars me-2 text-warning me-2"></i> 
										<span class="text-heading text-sm font-bold">Dark mode</span>
									</div>
									<div class="ms-auto"><div class="form-check form-switch me-n2">
										<input class="form-check-input" type="checkbox" id="switch-dark-mode">
									</div>
								</div>
							</div> -->
						</div>
					</div>
				</div>
			</nav>