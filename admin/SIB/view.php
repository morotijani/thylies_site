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
            UPDATE thylies_student_in_business 
            SET status = ? 
            WHERE sib_id = ?
        ";
        $statement = $conn->prepare($update);
        $result = $statement->execute([2, $id]);
        if ($result) {
            // code...
            $_SESSION['flash_success'] = 'Applicant rejected!';
            redirect(PROOT . 'admin/SIB/view/' . $id);
        } else {
            $_SESSION['flash_error'] = 'Something went wrong!';
            redirect(PROOT . 'admin/SIB/view/' . $id);
        }
    }

    if (isset($_GET['sibid']) && !empty($_GET['sibid'])) {
        $sib_id = sanitize($_GET['sibid']);
        
        $sql = "
            SELECT * FROM thylies_student_in_business 
            WHERE sib_id = ? 
            LIMIT 1
        ";
        $statement = $conn->prepare($sql);
        $statement->execute([$sib_id]);
        $row = $statement->fetchAll();
        $count_row = $statement->rowCount();

        if ($count_row > 0) {
            // code...
            // retrieve user image
            $profile = 'svg/friendly-ghost.svg';
            if ($row[0]["student_picture"] != '') {
                $profile = 'student-in-business/' . $row[0]["student_picture"];
            }

            // Grant
            if (isset($_POST['grantSIB'])) {

                $grantQuery = "
                    UPDATE thylies_student_in_business 
                    SET status = ? 
                    WHERE sib_id = ?
                ";
                $statement = $conn->prepare($grantQuery);
                $result = $statement->execute([1, $sib_id]);
                if (isset($result)) {
                    // code...
                    $_SESSION['flash_success'] = "Sanitary welfare has been granted to " . $row[0]['student_name'];
                    redirect(PROOT . 'admin/SIB/view/' . $sib_id);
                } else {
                    $_SESSION['flash_error'] = 'Something went wrong.';
                    redirect(PROOT . 'admin/SIB/view/' . $sib_id);
                }
            }
        } else {
            $_SESSION['flash_error'] = 'Unknown Sanitary welfare info provided';
            redirect(PROOT . 'admin/SIB/index');   
        }
    } else {
        $_SESSION['flash_error'] = 'Unknown Sanitary welfare info provided';
        redirect(PROOT . 'admin/SIB/index');
    }

	
?>

	<!--  -->
	<header>
		<div class="container-fluid">
			<div class="border-bottom pt-6">
				<div class="row align-items-center">
					<div class="col-sm col-12">
						<h1 class="h2 ls-tight">
							<span class="d-inline-block me-3">😎</span>Student in Business details on, <?= ucwords($row[0]['student_name']); ?>
						</h1>
					</div>
					<div class="col-sm-auto col-12 mt-4 mt-sm-0">
						<div class="hstack gap-2 justify-content-sm-end">
							<a href="<?= PROOT; ?>admin/SIB/view/<?= $sib_id; ?>" class="btn btn-sm btn-neutral border-base">
								<span class="pe-2"><i class="bi bi-arrow-clockwise"></i> </span>
								<span>Refresh</span> 
							</a>
							<a href="<?= PROOT; ?>admin/SIB/" class="btn btn-sm btn-primary">
								<span class="pe-2"><i class="bi bi-arrow-left"></i> </span>
								<span>Go Back</span>
							</a>
						</div>
					</div>
				</div>
				<ul class="nav nav-tabs overflow-x border-0">
					<li class="nav-item"><a href="<?= PROOT; ?>admin/SIB" class="nav-link">View all</a></li>
					<li class="nav-item"><a href="<?= PROOT; ?>admin/SIB/rejected" class="nav-link">Rejected</a></li>
					<li class="nav-item"><a href="<?= PROOT; ?>admin/SIB/gained" class="nav-link">Gained</a></li>
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
                        Applicant garanted student in business!
                    </div>
                    <?php else: ?>
                    <div class="alert alert-primary mb-4" role="alert">
                        Applicant student in business pending!
                    </div>
                    <?php endif ?>


                    <div class="d-flex align-items-center mb-4">
                        <a href="<?= PROOT . 'assets/media/' . $profile; ?>" target="_blank" class="avatar avatar-lg bg-warning rounded-circle text-white">
                            <img alt="..." src="<?= PROOT . 'assets/media/' . $profile; ?>">
                        </a>
                        <div class="ms-5">
                            <button for="file-upload" class="btn btn-sm btn-neutral" data-bs-toggle="modal" data-bs-target="#grantModal"><span>Grant</span></button>
                            <?php 
                                if ($conn->query("SELECT * FROM thylies_transactions WHERE from_id = '".$sib_id."' AND transaction_service = 'studentinbusiness' AND status = 1")->rowCount() > 0) {
                                    echo '
                                        <button class="btn btn-sm btn-success"><span><i class="bi bi-cash"></i> Paid</span></button>
                                    ';
                                } else {
                                    echo '
                                        <a href="javascript:;" class="btn d-inline-flex btn-sm btn-neutral ms-2 text-danger reject-btn">
                                            <span class="pe-2">
                                                <i class="bi bi-person-slash"></i> 
                                            </span>
                                            <span>Deny</span>
                                        </a>
                                    ';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body pb-0">
                     <div class="mb-4">
                        <h4 class="mb-1">STUDENT INFORMATION</h4>
                        <p class="text-sm text-muted">Details on student.</p>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">NAME OF STUDENT</a>
                                <span class="d-block text-sm text-muted"><?= ucwords($row[0]['student_name']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">SCHOOL</a>
                                <span class="d-block text-sm text-muted"><?= ucwords($row[0]['school_name']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">PROGRAM OF STUDY</a>
                                <span class="d-block text-sm text-muted"><?= ucwords($row[0]['program_of_study']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">INDEX NUMBER</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['index_number']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">AGE</a>
                                <span class="d-block text-sm text-muted"><?= ucwords($row[0]['age']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">REGION OF RESIDENCE</a>
                                <span class="d-block text-sm text-muted"><?= ucwords($row[0]['region_of_residence']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">TOWN OF RESIDENCE</a>
                                <span class="d-block text-sm text-muted"><?= ucwords($row[0]['town_of_residence']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">RESIDENTIAL ADDRESS</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['residence_address']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body pb-0">
                    <div class="mb-4">
                        <h4 class="mb-1">BUSINESS INFORMATION</h4>
                        <p class="text-sm text-muted">Details on business.</p>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">NAME OF BUSINESS</a>
                                <span class="d-block text-sm text-muted"><?= ucwords($row[0]['name_of_business']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">WHAT ARE THE GOALS AND OBJECTIVES OF YOUR BUSINESS</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['goals_objectives']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">IS YOUR BUSINESS REGISTERED, WHY?</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['business_registered_why']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">HOW WILL YOUR PRODUCTS BE MADE OR HOW WOULD YOUR GOODS AND SERVICES FOR SALE BE PROCURED</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['be_procured']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">WOULD YOU INTRODUCE NEW GOODS AND SERVICES IN THE FUTURE IN ADDITION TO THE ONES YOU ARE ALREADY DEALING IN</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['introduce_new']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">TARGET POPULACE</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['target_populace']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">TARGETTED NUMBER OF CUSTOMERS PER DAY</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['number_per_day']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">TARGETTED CUSTOMERS PER SEMESTER</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['customers_per_semester']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">CATEGORY OF BUSINESS</a>
                                <span class="d-block text-sm text-muted"><?= ucwords($row[0]['category_of_business']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">EXPECTED BUDGET OF COMMENCEMENT/EXPANSION</a>
                                <span class="d-block text-sm text-muted"><?= money($row[0]['expected_budget']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">EXPECTED PROFIT PER DAY</a>
                                <span class="d-block text-sm text-muted"><?= money($row[0]['expected_profit_per_day']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">EXPECTED PROFIT PER SEMESTER</a>
                                <span class="d-block text-sm text-muted"><?= money($row[0]['expected_profit_per_semester']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="text-danger mb-2">Delete details</h4>
                    <p class="text-sm text-muted mb-4">Temporary remove this user scholarship details and all of its contents. This action is reversible – please be certain.</p>
                    <a href="<?= PROOT; ?>admin/SIB/delete/<?= $sib_id; ?>" class="btn btn-sm btn-danger">Delete my details</a>
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
                        <small class="d-block text-xs text-muted">Accept and grant <b><?= ucwords($row[0]['student_name']); ?></b> sanitary welfare</small>
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
                        <button type="submit" name="grantSIB" class="btn btn-sm btn-success">Grant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include ('../includes/footer.php'); ?>

<script>
    $('.reject-btn').on('click', function() {
        if (confirm('By clicking on ok, applicant will be Rejected!')) {
            window.location = '<?= PROOT; ?>admin/SIB/view?reject=<?= $sib_id; ?>';
        } else {
            return false;
        }
    })
</script>