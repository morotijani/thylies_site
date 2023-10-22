<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php";

    if (!admin_is_logged_in()) {
        admn_login_redirect();
    }

	include ('includes/header.php');
	include ('includes/left.side.bar.php');
	include ('includes/top.nav.bar.php');

	$errors = '';
    $admin_fullname = ((isset($_POST['admin_fullname']))?sanitize($_POST['admin_fullname']):$admin_data['admin_fullname']);
    $admin_email = ((isset($_POST['admin_email']))?sanitize($_POST['admin_email']):$admin_data['admin_email']);

    if ($_POST) {
        if (empty($_POST['admin_email']) && empty($_POST['admin_email'])) {
            $errors = 'Fill out all empty fileds';
        }

        if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
            $errors = 'The email you provided is not valid';
        }

        if (!empty($errors)) {
            $errors;
        } else {
            $data = [
                ':admin_fullname' => $admin_fullname,
                ':admin_email' => $admin_email,
                ':admin_id' => $admin_data['admin_id']
            ];
            $query = "
                UPDATE thylies_admin 
                SET admin_fullname = :admin_fullname, admin_email = :admin_email 
                WHERE admin_id = :admin_id
            ";
            $statement = $conn->prepare($query);
            $result = $statement->execute($data);
            if (isset($result)) {
                $_SESSION['flash_success'] = 'Admin has been Updated</div>';
                redirect(PROOT . 'admin/settings');
            }
        }
    }

?>

	<div class="flex-lg-1 h-screen overflow-y-lg-auto">
		<header>
			<div class="container-fluid">
				<div class="border-bottom pt-6">
					<div class="row align-items-center">
						<div class="col-sm-6 col-12">
							<h1 class="h2 ls-tight">Settings</h1>
						</div>
						<div class="col-sm-6 col-12"></div>
					</div>
					<ul class="nav nav-tabs overflow-x border-0">
						<li class="nav-item">
							<a href="<?= PROOT; ?>admin/profile" class="nav-link">Profile</a>
						</li>
						<li class="nav-item">
							<a href="<?= PROOT; ?>admin/settings" class="nav-link active">Settings</a>
						</li>
						<li class="nav-item">
							<a href="<?= PROOT; ?>admin/change-password" class="nav-link">Change Password</a>
						</li>
						<li class="nav-item">
							<a href="<?= PROOT; ?>admin/" class="nav-link">Home</a>
						</li>
					</ul>
				</div>
			</div>
		</header>
		<main class="py-6 bg-surface-secondary">
			<div class="container-fluid max-w-screen-md vstack gap-6">
				<div>
					<div class="mb-5">
						<h4>Profile Information</h4>
					</div>
					<form method="POST">
						<div class="mb-3">
							<label class="form-label">First name</label>
							<input type="text" class="form-control" name="admin_fullname" value="<?= $admin_fullname; ?>" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Email address</label> 
							<input type="email" class="form-control" name="admin_email" value="<?= $admin_email; ?>" required>
						</div>
			            <button type="submit" class="btn btn-warning" name="submit_settings" id="submit_settings">Update</button>&nbsp;
			            <a href="<?= PROOT; ?>admin/profile" class="btn btn-outline-secondary">Cancel</a>
					</form>
				</div>
			</div>
			<br>
        	<span><?= $flash; ?></span>
		</main>
	</div>
<?php include ('includes/footer.php'); ?>

