<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php";

    if (!admin_is_logged_in()) {
        admn_login_redirect();
    }

	include ('../includes/header.php');
	include ('../includes/left.side.bar.php');
	include ('../includes/top.nav.bar.php');

    // Delete user
    if (isset($_GET['delete']) && !empty($_GET['delete'])) {
        $id = sanitize($_GET['delete']);

        $update = "
            UPDATE thylies_user 
            SET user_trash = ? 
            WHERE user_unique_id = ?
        ";
        $statement = $conn->prepare($update);
        $result = $statement->execute([1, $id]);
        if ($result) {
            // code...
            $_SESSION['flash_success'] = 'User temporary deleted!';
            redirect(PROOT . 'admin/User/view/' . $id);
        } else {
            $_SESSION['flash_error'] = 'Something went wrong!';
            redirect(PROOT . 'admin/User/view/' . $id);
        }
    }

    // Restore user
    if (isset($_GET['restore']) && !empty($_GET['restore'])) {
        $id = sanitize($_GET['restore']);

        $update = "
            UPDATE thylies_user 
            SET user_trash = ? 
            WHERE user_unique_id = ?
        ";
        $statement = $conn->prepare($update);
        $result = $statement->execute([0, $id]);
        if ($result) {
            // code...
            $_SESSION['flash_success'] = 'User restored!';
            redirect(PROOT . 'admin/User/view/' . $id);
        } else {
            $_SESSION['flash_error'] = 'Something went wrong!';
            redirect(PROOT . 'admin/User/view/' . $id);
        }
    }

    // Permanently delete user
    if (isset($_GET['permanently-delete']) && !empty($_GET['permanently-delete'])) {
        $id = sanitize($_GET['permanently-delete']);

        $deleteQ = "
            DELETE FROM thylies_user 
            WHERE user_trash = ? 
            AND user_unique_id = ?
        ";
        $statement = $conn->prepare($deleteQ);
        $result = $statement->execute([1, $id]);
        if ($result) {

            // find and delete user details on application on scholarship
            $scholarshipSQL = "SELECT * FROM thylies_scholarship WHERE user_id = ?";
            $statement = $conn->prepare($scholarshipSQL);
            $statement->execute([$id]);
            $scholarshipRow = $statement->fetchAll();
            if ($statement->rowCount() > 0) {
                $conn->query("DELETE FROM thylies_scholarship WHERE user_id = '".$id."'")->execute();
                if ($scholarshipRow[0]['student_picture'] != '') {
                    // code...
                    $scholarship_file = BASEURL . 'assets/media/scholarship/' . $scholarshipRow[0]['student_picture'];
                    if (file_exists($scholarship_file)) {
                        unlink($scholarship_file);
                    }
                }
            }

            // find and delete user details on application on student in business
            $student_in_businessSQL = "SELECT * FROM thylies_student_in_business WHERE user_id = ?";
            $statement = $conn->prepare($student_in_businessSQL);
            $statement->execute([$id]);
            $sibRow = $statement->fetchAll();
            if ($statement->rowCount() > 0) {
                $conn->query("DELETE FROM thylies_student_in_business WHERE user_id = '".$id."'")->execute();
                if ($sibRow[0]['student_picture'] != '') {
                    // code...
                    $sib_file = BASEURL . 'assets/media/scholarship/' . $sibRow[0]['student_picture'];
                    if (file_exists($sib_file)) {
                        // code...
                        unlink($sib_file);
                    }
                }
            }

            // find and delete user details on application on sanitary welfare
            $sanitary_welfareSQL = "SELECT * FROM thylies_sanitary_welfare WHERE user_id = ?";
            $statement = $conn->prepare($sanitary_welfareSQL);
            $statement->execute([$id]);
            $swRow = $statement->fetchAll();
            if ($statement->rowCount() > 0) {
                $conn->query("DELETE FROM thylies_sanitary_welfare WHERE user_id = '".$id."'")->execute();
                if ($swRow[0]['student_picture'] != '') {
                    // code...
                    $sw_file = BASEURL . 'assets/media/scholarship/' . $swRow[0]['student_picture'];
                    if (file_exists($sw_file)) {
                        // code...
                        unlink($sw_file);
                    }
                }
            }

            // code...
            $_SESSION['flash_success'] = 'User deleted permanently!';
            redirect(PROOT . 'admin/User/');
        } else {
            $_SESSION['flash_error'] = 'Something went wrong!';
            redirect(PROOT . 'admin/User/');
        }
    }

    // GET USER DETAILS ON VIEW
    if (isset($_GET['uid']) && !empty($_GET['uid'])) {
        $uu_id = sanitize($_GET['uid']);
        
        $sql = "
            SELECT * FROM thylies_user 
            WHERE user_unique_id = ? 
            LIMIT 1
        ";
        $statement = $conn->prepare($sql);
        $statement->execute([$uu_id]);
        $row = $statement->fetchAll();
        $count_row = $statement->rowCount();

        if ($count_row > 0) {
            // code...
            

        } else {
            $_SESSION['flash_error'] = 'Unknown user info provided';
            redirect(PROOT . 'admin/User/index');   
        }
    } else {
        $_SESSION['flash_error'] = 'Unknown user info provided';
        redirect(PROOT . 'admin/User/index');
    }

	
?>

	<!--  -->
	<header>
		<div class="container-fluid">
			<div class="border-bottom pt-6">
				<div class="row align-items-center">
					<div class="col-sm col-12">
						<h1 class="h2 ls-tight">
							<span class="d-inline-block me-3">😎</span>Users details on, <?= ucwords($row[0]['user_fullname']); ?>
						</h1>
					</div>
					<div class="col-sm-auto col-12 mt-4 mt-sm-0">
						<div class="hstack gap-2 justify-content-sm-end">
							<a href="<?= PROOT; ?>admin/User/view/<?= $uu_id; ?>" class="btn btn-sm btn-neutral border-base">
								<span class="pe-2"><i class="bi bi-arrow-clockwise"></i> </span>
								<span>Refresh</span> 
							</a>
							<a href="<?= PROOT; ?>admin/User/" class="btn btn-sm btn-primary">
								<span class="pe-2"><i class="bi bi-arrow-left"></i> </span>
								<span>Go Back</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid max-w-screen-md vstack gap-6">
			<?= $flash; ?>
            <br>
            <div class="card">
                <div class="card-body pb-0">
                    <div class="d-flex align-items-center justify-content-between mb-5">
                        <div class="flex-1">
                            <h6 class="h5 font-semibold mb-1">User details</h6>
                            <p class="text-sm text-muted">View and Manage details of user.</p>
                        </div>

                        <?php if ($row[0]['user_verified'] == 1): ?>
                            <div class="ms-auto">
                                <div class="d-flex align-items-center mt-5 mb-3 lh-none text-heading d-block text-success display-8 ls-tight mb-0">
                                    <span>Verified</span>&nbsp;|&nbsp;
                                </div>
                            </div>
                        <?php else: ?>
                             <div class="ms-auto">
                                <div class="d-flex align-items-center mt-5 mb-3 lh-none text-heading d-block display-8 ls-tight mb-0">
                                    <span class="text-warning">Not verified</span>&nbsp;|&nbsp; 
                                </div>
                            </div>
                        <?php endif ?>
                        <?php if ($row[0]['user_trash'] == 1): ?>
                            <div class="ms-auto">
                                <div class="d-flex align-items-center mt-5 mb-3 lh-none text-heading d-block display-8 ls-tight mb-0">
                                    <span class="text-danger">DELETED</span>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body pb-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">User ID</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['user_unique_id']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Name</a>
                                <span class="d-block text-sm text-muted"><?= ucwords($row[0]['user_fullname']); ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Email</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['user_email']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Phone</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['user_phone']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Index Number</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['user_index_number']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Gender</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['user_gender']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Country</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['user_country']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">State / Region</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['user_state']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">City</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['user_city']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Address</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['user_address']; ?></span>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-fill">
                                <a href="javascript:;" class="d-block h6 font-semibold mb-1">Postal Code</a>
                                <span class="d-block text-sm text-muted"><?= $row[0]['user_postcode']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body pb-0">
                    <div class="mb-4">
                        <h4 class="mb-1">Applications</h4>
                        <p class="text-sm text-muted">User applications information.</p>
                    </div>
                    scholarship . student in business . sanitary welfare
                    <!-- <div class="list-group list-group-flush">
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
                    </div> -->
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <?php if ($row[0]['user_trash'] == 0): ?>
                        <h4 class="text-danger mb-2">Delete details</h4>
                        <p class="text-sm text-muted mb-4">Temporary remove this user details and all of its contents. This action is reversible – please be certain.</p>
                        <a href="javascript:;" class="btn btn-sm btn-danger delete-btn">Delete user</a>
                    <?php elseif ($row[0]['user_trash'] == 1): ?>
                        <h4 class="text-danger mb-2">Restore details</h4>
                        <p class="text-sm text-muted mb-4">Restore this user details and all of its contents – please be certain.</p>
                        <a href="javascript:;" class="btn btn-sm btn-warning restore-btn">Restore user</a>
                        <hr>
                        <h4 class="text-danger mb-2">Permanently delete details</h4>
                        <p class="text-sm text-muted mb-4">Permanently remove this user details and all of its contents. This action is not reversible – please be certain.</p>
                        <a href="javascript:;" class="btn btn-sm btn-danger permanently-delete-btn">Permanently Delete user</a>
                    <?php endif; ?>
                    
                </div>
            </div>

        </div>
    </main>


<?php include ('../includes/footer.php'); ?>

<script>
    $('.delete-btn').on('click', function() {
        if (confirm('By clicking on ok, user will be Deleted!')) {
            window.location = '<?= PROOT; ?>admin/User/view?delete=<?= $uu_id; ?>';
        } else {
            return false;
        }
    })

    $('.restore-btn').on('click', function() {
        if (confirm('By clicking on ok, user will be Restored!')) {
            window.location = '<?= PROOT; ?>admin/User/view?restore=<?= $uu_id; ?>';
        } else {
            return false;
        }
    })

    $('.permanently-delete-btn').on('click', function() {
        if (confirm('By clicking on ok, user will be Permanently Deleted!')) {
            window.location = '<?= PROOT; ?>admin/User/view?permanently-delete=<?= $uu_id; ?>';
        } else {
            return false;
        }
    })
</script>