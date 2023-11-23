<?php 

    require_once ("../connection/conn.php");

    if (!user_is_logged_in()) {
        redirect(PROOT . 'auth/logout');
    }

    $SQL = "
        SELECT * FROM thylies_scholarship 
        WHERE user_id = ? 
        LIMIT 1
    ";
    $statement = $conn->prepare($SQL);
    $statement->execute([$user_data['user_unique_id']]);
    $apply_row = $statement->fetchAll();
    $count_apply = $statement->rowCount();

    $title = 'Apply Scholarship - ';
    include ("inc/user.header.inc.php");

    //
    $errors = '';
    $hashed = $user_data['user_password'];
    $old_password = ((isset($_POST['old_password'])) ? sanitize($_POST['old_password']) : '');
    $old_password = trim($old_password);
    $password = ((isset($_POST['password'])) ? sanitize($_POST['password']) : '');
    $password = trim($password);
    $confirm = ((isset($_POST['confirm'])) ? sanitize($_POST['confirm']) : '');
    $confirm = trim($confirm);
    $new_hashed = password_hash($password, PASSWORD_BCRYPT);
    $user_id = $user_data['user_id'];
   
    $createdAt = date("Y-m-d H:i:s");

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
                UPDATE thylies_user 
                SET user_password = :user_password 
                WHERE user_id = :user_id
            ';
            $satement = $conn->prepare($query);
            $result = $satement->execute(
                array(
                    ':user_password' => $new_hashed,
                    ':user_id' => $user_id
                )
            );
            if (isset($result)) {
                $_SESSION['flash_success'] = 'Password successfully UPDATED!';
                redirect(PROOT . "user/");

                 $subject = "Password Update.";
                $body = "
                    <h3>
                        {$user_data['user_fullname']},</h3>
                        <p>
                            You just updated your password  
                            <br><h3>{$createdAt}</h3>
                        </p>
                        <br>
                        Best Regards,<br>
                        Thylies Ghana.
                ";

                $mail_result = send_email($user_data['user_fullname'], $user_data['user_email'], $subject, $body);
                if ($mail_result) {
                    $_SESSION['flash_success'] = 'Your password is updated successfully!';
                    redirect(PROOT . 'user/index');
                }
            }
        }
    }

?>

	<div class="pb-12 mt-lg-n18 mt-n10">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-md-8 col-12">
					<div class="card rounded-3 mb-4 ">
						<div class="card-header bg-white p-4">
							<h3 class="mb-0 h4">User Settings</h3>
						</div>
						<div class="card-body p-4">
							<div class="">
                                <?= check_user_verified($user_data['user_verified'], $user_data['user_email']); ?>
                            </div>
							<!-- form -->
							<form class="row" method="POST" id="passwordForm">
                                <code><?= $errors; ?></code>
								<div class="mb-3 col-12 col-md-12">
									<label class="form-label" for="user_fullname">Old password<span class="text-danger">*</span></label>
									<input type="password" name="old_password" value="<?= $old_password; ?>" class="form-control" required>
								</div>
								<div class="mb-3 col-12 col-md-12">
									<label class="form-label" for="user_email">New password<span class="text-danger">*</span></label>
									<input type="password" name="password" value="<?= $password; ?>" class="form-control" required>
								</div>
								<div class="mb-3 col-12 col-md-12">
									<label class="form-label" for="user_phone">Confirm new password<span class="text-danger">*</span></label>
									<input type="password" name="confirm" value="<?= $confirm; ?>" class="form-control" required>
								</div>

                                <div class="col-12">
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#passwordModalCenter">Submit</button>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="passwordModalCenter" tabindex="-1" role="dialog" aria-labelledby="passwordModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                Are you sure you want to update your password?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button class="g-recaptcha btn btn-warning" data-sitekey="<?= RECAPTCHA_SITE_KEY; ?>" data-callback='submit_password_form' data-action='submit' type="submit">Yes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <?php include ('../inc/footer.inc.php'); ?>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function submit_password_form(token) {
            $('#passwordForm').submit();
        }
    </script>