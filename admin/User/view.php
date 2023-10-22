<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php";

    if (!admin_is_logged_in()) {
        admn_login_redirect();
    }

	include ('../includes/header.php');
	include ('../includes/left.side.bar.php');
	include ('../includes/top.nav.bar.php');

    // Delete Applicant
    if (isset($_GET['delete']) && !empty($_GET['delete'])) {
        $id = sanitize($_GET['delete']);

        $update = "
            UPDATE thylies_user 
            SET status = ? 
            WHERE user_unique_id = ?
        ";
        $statement = $conn->prepare($update);
        $result = $statement->execute([1, $id]);
        if ($result) {
            // code...
            $_SESSION['flash_success'] = 'Applicant rejected!';
            redirect(PROOT . 'admin/User/view/' . $id);
        } else {
            $_SESSION['flash_error'] = 'Something went wrong!';
            redirect(PROOT . 'admin/User/view/' . $id);
        }
    }

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

            <div class="card">
                <div class="card-body pb-0">
                    <div class="d-flex align-items-center justify-content-between mb-5">
                        <div class="flex-1">
                            <h6 class="h5 font-semibold mb-1">User details</h6>
                            <p class="text-sm text-muted">View and Manage details of user.</p>
                        </div>
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
                    <a href="javascript:;" class="btn btn-sm btn-danger delete-btn">Delete user</a>
                </div>
            </div>

        </div>
    </main>


<?php include ('../includes/footer.php'); ?>

<script>
    $('.delete-btn').on('click', function() {
        if (confirm('By clicking on ok, applicant will be Rejected!')) {
            window.location = '<?= PROOT; ?>admin/User/view?delete=<?= $uu_id; ?>';
        } else {
            return false;
        }
    })
</script>