<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php";

    if (!admin_is_logged_in()) {
        admn_login_redirect();
    }

	include ('../includes/header.php');
	include ('../includes/left.side.bar.php');
	include ('../includes/top.nav.bar.php');

    // Reject Applicant
    if (isset($_GET['reject']) && !empty($_GET['reject'])) {
        $id = sanitize($_GET['reject']);

        $update = "
            UPDATE thylies_sanitary_welfare 
            SET status = ? 
            WHERE sw_id = ?
        ";
        $statement = $conn->prepare($update);
        $result = $statement->execute([2, $id]);
        if ($result) {
            // code...
            $_SESSION['flash_success'] = 'Applicant rejected!';
            redirect(PROOT . 'admin/SW/view/' . $id);
        } else {
            $_SESSION['flash_error'] = 'Something went wrong!';
            redirect(PROOT . 'admin/SW/view/' . $id);
        }
    }

    if (isset($_GET['swid']) && !empty($_GET['swid'])) {
        $sw_id = sanitize($_GET['swid']);
        
        $sql = "
            SELECT * FROM thylies_sanitary_welfare 
            WHERE sw_id = ? 
            LIMIT 1
        ";
        $statement = $conn->prepare($sql);
        $statement->execute([$sw_id]);
        $row = $statement->fetchAll();
        $count_row = $statement->rowCount();

        if ($count_row > 0) {
            // code...
            // retrieve user image
            $profile = 'svg/friendly-ghost.svg';
            if ($row[0]["student_picture"] != '') {
                $profile = 'sanitary-welfare/' . $row[0]["student_picture"];
            }

            // Grant
            if (isset($_POST['grantSW'])) {

                $grantQuery = "
                    UPDATE thylies_sanitary_welfare 
                    SET status = ? 
                    WHERE sw_id = ?
                ";
                $statement = $conn->prepare($grantQuery);
                $result = $statement->execute([1, $sw_id]);
                if (isset($result)) {
                    // code...
                    $_SESSION['flash_success'] = "Sanitary welfare has been granted to " . $row[0]['name_of_student'];
                    redirect(PROOT . 'admin/SW/view/' . $sw_id);
                } else {
                    $_SESSION['flash_error'] = 'Something went wrong.';
                    redirect(PROOT . 'admin/SW/view/' . $sw_id);
                }
            }
        } else {
            $_SESSION['flash_error'] = 'Unknown Sanitary welfare info provided';
            redirect(PROOT . 'admin/SW/index');   
        }
    } else {
        $_SESSION['flash_error'] = 'Unknown Sanitary welfare info provided';
        redirect(PROOT . 'admin/SW/index');
    }

	
?>

	<!--  -->
	<header>
		<div class="container-fluid">
			<div class="border-bottom pt-6">
				<div class="row align-items-center">
					<div class="col-sm col-12">
						<h1 class="h2 ls-tight">
							<span class="d-inline-block me-3">😎</span>Sanitary Welfare details on, <?= ucwords($row[0]['name_of_student']); ?>
						</h1>
					</div>
					<div class="col-sm-auto col-12 mt-4 mt-sm-0">
						<div class="hstack gap-2 justify-content-sm-end">
							<a href="<?= PROOT; ?>admin/SW/view/<?= $sw_id; ?>" class="btn btn-sm btn-neutral border-base">
								<span class="pe-2"><i class="bi bi-arrow-clockwise"></i> </span>
								<span>Refresh</span> 
							</a>
							<a href="<?= PROOT; ?>adminSW/" class="btn btn-sm btn-primary">
								<span class="pe-2"><i class="bi bi-arrow-left"></i> </span>
								<span>Go Back</span>
							</a>
						</div>
					</div>
				</div>
				<ul class="nav nav-tabs overflow-x border-0">
					<li class="nav-item"><a href="<?= PROOT; ?>admin/SW" class="nav-link">View all</a></li>
					<li class="nav-item"><a href="<?= PROOT; ?>admin/SW/rejected" class="nav-link">Rejected</a></li>
					<li class="nav-item"><a href="<?= PROOT; ?>admin/SW/gained" class="nav-link">Gained</a></li>
				</ul>
			</div>
		</div>
	</header>

    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid max-w-screen-md vstack gap-6">
			<?= $flash; ?>

            <div class="card">
                <div class="card-body pb-0">
                    <div class="d-flex align-items-center justify-content-between mb-5">
                        <div class="flex-1">
                            <h6 class="h5 font-semibold mb-1">Scholarship details</h6>
                            <p class="text-sm text-muted">View and Manage details of student who applied for Sanitary Welfare.</p>
                        </div>
                    </div>

                    <?php if ($row[0]['status'] == 2): ?>
                    <div class="alert alert-danger mb-4" role="alert">
                        Applicant denied scholarship!
                    </div>
                    <?php elseif ($row[0]['status'] == 1): ?>
                    <div class="alert alert-success mb-4" role="alert">
                        Applicant garanted student welfare!
                    </div>
                    <?php else: ?>
                    <div class="alert alert-primary mb-4" role="alert">
                        Applicant student welfare pending!
                    </div>
                    <?php endif ?>


                    <div class="d-flex align-items-center mb-4">
                        <a href="<?= PROOT . 'assets/media/' . $profile; ?>" target="_blank" class="avatar avatar-lg bg-warning rounded-circle text-white">
                            <img alt="..." src="<?= PROOT . 'assets/media/' . $profile; ?>">
                        </a>
                        <div class="ms-5">
                            <button for="file-upload" class="btn btn-sm btn-neutral" data-bs-toggle="modal" data-bs-target="#grantModal"><span>Grant</span></button>
                            <a href="javascript:;" class="btn d-inline-flex btn-sm btn-neutral ms-2 text-danger reject-btn">
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
                        <h4 class="mb-1">BIO Data</h4>
                        <p class="text-sm text-muted">Details on student.</p>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Name of Student</a>
                                <span class="d-block text-sm text-muted"><?= ucwords($row[0]['name_of_student']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Date of Birth</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['dob']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Student index</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['student_index']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">School</a>
                                <span class="d-block text-sm text-muted"><?= ucwords($row[0]['school_name']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Program</a>
                                <span class="d-block text-sm text-muted"><?= ucwords($row[0]['program']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">WhatsApp</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['whatsapp']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Contact</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['contact']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">E-mail</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['email']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body pb-0">
                    <div class="mb-4">
                        <h4 class="mb-1">SANITARY PREFERENCE</h4>
                        <p class="text-sm text-muted">Details on preference.</p>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Number of pads per semester</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['number_of_pads_per_semester']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Brand of Sanitary pad</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['brand_of_sanitary_pad']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Number of pantie liners</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['number_of_pantie_liners']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Brand of Pantie liners</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['brand_of_pantie_liners']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Number of tissue</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['number_of_tissue']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Brand of tissue papers</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['brand_of_tissue_papers']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Type of panties</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['type_of_panties']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Number of panties</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['number_of_panties']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Design of panties</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['design_of_panties']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="text-danger mb-2">Delete details</h4>
                    <p class="text-sm text-muted mb-4">Temporary remove this user scholarship details and all of its contents. This action is reversible – please be certain.</p>
                    <a href="<?= PROOT; ?>admin/SW/delete/<?= $sw_id; ?>" class="btn btn-sm btn-danger">Delete my details</a>
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
                        <small class="d-block text-xs text-muted">Accept and grant <b><?= ucwords($row[0]['name_of_student']); ?></b> sanitary welfare</small>
                    </div>
                    <div class="ms-auto">
                        <div class="me-n2" data-bs-dismiss="modal" style="cursor: pointer;">
                            <i class="bi bi-x-lg me-2"></i>
                        </div>
                    </div>
                </div>
                <form action="" method="POST">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-neutral" data-bs-dismiss="modal">Close</button> 
                        <button type="submit" name="grantSW" class="btn btn-sm btn-success">Grant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include ('../includes/footer.php'); ?>

<script>
    $('.reject-btn').on('click', function() {
        if (confirm('By clicking on ok, applicant will be Rejected!')) {
            window.location = '<?= PROOT; ?>admin/SW/view?reject=<?= $sw_id; ?>';
        } else {
            return false;
        }
    })
</script>