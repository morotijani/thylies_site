<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php";

    if (!admin_is_logged_in()) {
        admn_login_redirect();
    }

	include ('includes/header.php');
	include ('includes/left.side.bar.php');
	include ('includes/top.nav.bar.php');

	$errors = '';
    $hashed = $admin_data['admin_password'];
    $old_password = ((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
    $old_password = trim($old_password);
    $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
    $password = trim($password);
    $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
    $confirm = trim($confirm);
    $new_hashed = password_hash($password, PASSWORD_BCRYPT);
    $admin_id = $admin_data['admin_id'];
    echo $admin_id;

    if ($_POST) {
        if (empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['confirm'])) {
            $errors = 'You must fill out all fields';
        } else {

            if (strlen($password) < 6) {
                $errors = 'Password must be at least 6 characters';
            }

            if ($password != $confirm) {
                $errors = 'The new password and confirm new password does not match.';
            }

            if (!password_verify($old_password, $hashed)) {
                $errors = 'Your old password does not our records.';
            }
        }

        if (!empty($errors)) {
            $errors;
        } else {
            $query = '
                UPDATE thylies_admin 
                SET admin_password = :admin_password 
                WHERE admin_id = :admin_id
            ';
            $satement = $conn->prepare($query);
            $result = $satement->execute(
                array(
                    ':admin_password' => $new_hashed,
                    ':admin_id' => $admin_id
                )
            );
            if (isset($result)) {
                $_SESSION['flash_success'] = 'Password successfully UPDATED';
                redirect(PROOT . "admin/change-password");
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
							<a href="<?= PROOT; ?>admin/settings" class="nav-link">Settings</a>
						</li>
						<li class="nav-item">
							<a href="<?= PROOT; ?>admin/change-password" class="nav-link active">Change Password</a>
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
						<h4>Change Password</h4>
					</div>
					<form method="POST">
                    	<span class="text-danger lead"><?= $errors; ?></span>
						<div class="mb-3">
							<label class="form-label">Old password</label>
							<input type="text" class="form-control" name="old_password" value="<?= $old_password; ?>" required>
						</div>
						<div class="mb-3">
							<label class="form-label">New password</label> 
							<input type="text" class="form-control" name="password" value="<?= $password; ?>" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Confirm new password</label> 
							<input type="text" class="form-control" name="confirm" value="<?= $confirm; ?>" required>
						</div>
			            <button type="submit" class="btn btn-warning" name="submit_settings" id="submit_settings">Change</button>&nbsp;
			            <a href="<?= PROOT; ?>admin/profile" class="btn btn-outline-secondary">Cancel</a>
					</form>
				</div>
			</div>
			<br>
        	<span><?= $flash; ?></span>
		</main>
	</div>
<?php include ('includes/footer.php'); ?>

