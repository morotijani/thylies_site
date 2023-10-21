<?php 
	require ('./../connection/conn.php');

	 $error = '';

    if ($_POST) {
        if (empty($_POST['admin_email']) || empty($_POST['admin_password'])) {
            $error = 'You must provide email and password.';
        }
        $query = "
            SELECT * FROM thylies_admin 
            WHERE admin_email = :admin_email 
            LIMIT 1
        ";
        $statement = $conn->prepare($query);
        $statement->execute(['admin_email' => $_POST['admin_email']]);
        $count_row = $statement->rowCount();
        $row = $statement->fetchAll();

        if ($count_row < 1) {
            $error = 'Unkown admin.';
        }

        if (!password_verify($_POST['admin_password'], $row[0]['admin_password'])) {
            $error = 'Unkown admin.';
        }

        if (!empty($error)) {
            $error;
        } else {
            $admin_id = $row[0]['admin_id'];
            adminLogin($admin_id);
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
	<meta name="color-scheme" content="dark light">
	<title>Admin Dashboard | Thylies Ghana</title>
	<link rel="stylesheet" type="text/css" href="<?= PROOT; ?>admin/dist/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?= PROOT; ?>admin/dist/css/utilities.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
	<script defer="defer" data-domain="webpixels.works" src="https://plausible.io/js/script.js"></script>
</head>
<body>
	<p><?= $flash; ?></p>
	<div>
		<div class="px-5 py-5 p-lg-0 h-screen bg-surface-secondary d-flex flex-column justify-content-center">
			<div class="d-flex justify-content-center">
				<div class="col-12 col-md-9 col-lg-6 min-h-lg-screen d-flex flex-column justify-content-center py-lg-16 px-lg-20 position-relative">
					<div class="row">
						<div class="col-lg-10 col-md-9 col-xl-7 mx-auto">
							<div class="text-center mb-12">
								<img src="<?= PROOT; ?>assets/media/logo/logo-min.png" class="img-fluid" alt="...">
							</div>
							<form method="POST" id="admin_loginForm">
								 <code class="mb-1"><?= $error; ?></code>
								<div class="mb-5">
									<input type="email" class="form-control" name="admin_email" placeholder="Your email address">
								</div>
								<div class="mb-5">
									<input type="password" class="form-control" name="admin_password" placeholder="Password" autocomplete="current-password">
								</div>
								<div>
									<button class="btn btn-primary w-full">Sign in</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="<?= PROOT; ?>assets/js/jquery.min.js"></script>
	<script src="<?= PROOT; ?>admin/dist/js/main.js"></script>
</body>
</html>