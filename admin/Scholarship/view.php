<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php";

	include ('../includes/header.php');
	include ('../includes/left.side.bar.php');
	include ('../includes/top.nav.bar.php');

    if (isset($_GET['sid']) && !empty($_GET['sid'])) {
        $scholarship_id = sanitize($_GET['sid']);
        
        $sql = "
            SELECT * FROM thylies_scholarship 
            WHERE scholarship_id = ? 
            LIMIT 1
        ";
        $statement = $conn->prepare($sql);
        $statement->execute([$scholarship_id]);
        $row = $statement->fetchAll();
        $count_row = $statement->rowCount();

        if ($count_row > 0) {
            // code...
            // retrieve user image
            $profile = 'svg/friendly-ghost.svg';
            if ($row[0]["student_picture"] != '') {
                $profile = 'scholarship/' . $row[0]["student_picture"];
            }
        } else {
            $_SESSION['flash_error'] = 'Unknown scholarship info provided';
            redirect(PROOT . 'admin/Scholarship/index');   
        }
    } else {
        $_SESSION['flash_error'] = 'Unknown scholarship info provided';
        redirect(PROOT . 'admin/Scholarship/index');
    }

	
?>

	<!--  -->
	<header>
		<div class="container-fluid">
			<div class="border-bottom pt-6">
				<div class="row align-items-center">
					<div class="col-sm col-12">
						<h1 class="h2 ls-tight">
							<span class="d-inline-block me-3">😎</span>Scholarship details on, <?= ucwords($row[0]['student_name']); ?>
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
					<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship/gained" class="nav-link">Gained</a></li>
				</ul>
			</div>
		</div>
	</header>

    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid max-w-screen-md vstack gap-6">
			<?= $flash; ?>

            <div class="card bg-secondary">
                <div class="card-body pb-0">
                    <div class="mb-4">
                        <h4 class="mb-1">Scholarship details</h4>
                        <p class="text-sm text-muted">View and Manage details of student who applied for scholarship.</p>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <a href="<?= PROOT . 'assets/media/' . $profile; ?>" target="_blank" class="avatar avatar-lg bg-warning rounded-circle text-white">
                            <img alt="..." src="<?= PROOT . 'assets/media/' . $profile; ?>">
                        </a>
                        <div class="ms-5">
                            <button for="file-upload" class="btn btn-sm btn-neutral" data-bs-toggle="modal" data-bs-target="#grantModal"><span>Grant</span></button>
                            <a href="#" class="btn d-inline-flex btn-sm btn-neutral ms-2 text-danger">
                                <span class="pe-2">
                                    <i class="bi bi-person-slash"></i> 
                                </span>
                                <span>Deny</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body pb-0">
                    <div class="mb-4">
                        <h4 class="mb-1">Student</h4>
                        <p class="text-sm text-muted">Details on student.</p>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Scholarship ID</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['scholarship_id']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Name</a>
                                <span class="d-block text-sm text-muted"><?= ucwords($row[0]['student_name']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Date of Birth</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['student_dob']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Age</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['student_age']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body pb-0">
                    <div class="mb-4">
                        <h4 class="mb-1">Parent</h4>
                        <p class="text-sm text-muted">Details on parents.</p>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Do you live with your parents?</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['student_with_parent']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Size of Family</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['student_family_size']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Father's Name</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['father_name']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Father's Age</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['father_age']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Father's Occupation</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['father_occupation']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Mother's Name</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['mother_name']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Mother's Ag</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['mother_age']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Mother's Occupation</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['mother_occupation']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Are both parent alive?</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['parent_alive']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">If No, which of your parent is deseased?</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['parent_deceased']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body pb-0">
                    <div class="mb-4">
                        <h4 class="mb-1">School</h4>
                        <p class="text-sm text-muted">Academic information.</p>
                    </div>

                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Name of Program offered</a>
                                <span class="d-block text-sm text-muted"><?= ucwords($row[0]['school_name']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Year of Studies</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['parent_deceased']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Index Number</a>
                                <span class="d-block text-sm text-muted"><?= ucwords($row[0]['index_number']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">How would you describe yourself?</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['self_description']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">What is your professional dream?</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['professional_dream']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">What is your limitation in your life as a student?</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['limitation']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body pb-0">
                    <div class="mb-4">
                        <h4 class="mb-1">Referee</h4>
                        <p class="text-sm text-muted">Referee information.</p>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Name of Referee</a>
                                <span class="d-block text-sm text-muted"><?= ucwords($row[0]['referee_name']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Nature of relation</a>
                                <span class="d-block text-sm text-muted"><?= ucwords($row[0]['relation_nature']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Occupation of Referee</a>
                                <span class="d-block text-sm text-muted"><?= ucwords($row[0]['referee_occupation']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Contact of Referee</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['referee_contact']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Address of Referee</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['referee_address']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">E-mail of Referee</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['referee_email']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="text-danger mb-2">Delete details</h4>
                    <p class="text-sm text-muted mb-4">Temporary remove this user scholarship details and all of its contents. This action is reversible – please be certain.</p>
                    <a href="<?= PROOT; ?>admin/Scholarship/delete/<?= $scholarship_id; ?>" class="btn btn-sm btn-danger">Delete my details</a>
                </div>
            </div>

        </div>
    </main>
	

    <!-- Grant Modal -->
    <div class="modal fade" id="grantModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="grantModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon icon-shape rounded-3 bg-soft-primary text-primary text-lg me-4"><i class="bi bi-globe"></i></div>
                    <div>
                        <h5 class="mb-1">Grant</h5>
                        <small class="d-block text-xs text-muted">Accept and grant <b><?= ucwords($row[0]['student_name']); ?></b> the scholarship</small>
                    </div>
                    <div class="ms-auto">
                        <div class="me-n2" data-bs-dismiss="modal" style="cursor: pointer;">
                            <i class="bi bi-x-lg me-2"></i>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center mb-5">
                        <div>
                            <p class="text-sm">Percentage <span class="font-bold text-heading">%</span></p>
                        </div>
                    </div>
                    <div>
                        <div class="input-group input-group-inline">
                            <input type="number" min="20" class="form-control" placeholder="%">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="me-auto">
                        <a href="#" class="text-sm font-semibold"><i class="bi bi-x me-2"></i>Cancel</a>
                    </div>
                    <button type="button" class="btn btn-sm btn-neutral" data-bs-dismiss="modal">Close</button> 
                    <button type="button" class="btn btn-sm btn-success">Grant</button></div>
            </div>
        </div>
    </div>

<?php include ('../includes/footer.php'); ?>