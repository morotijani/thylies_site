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
    $post = (isset($_POST) ? cleanPost($_POST) : '');
    $scholarship_id = guidv4();
    $user_fullname = (isset($post['user_fullname']) && $post['user_fullname'] != '') ? $post['user_fullname'] : $user_data['user_fullname'];
    $user_email = (isset($post['user_email']) && $post['user_email'] != '') ? $post['user_email'] : $user_data['user_email'];
    $user_phone = (isset($post['user_phone']) && $post['user_phone'] != '') ? $post['user_phone'] : $user_data['user_phone'];
    $user_school_name = (isset($post['user_school_name']) && $post['user_school_name'] != '') ? $post['user_school_name'] : $user_data['user_school_name'];
    $user_index_number = (isset($post['user_index_number']) && $post['user_index_number'] != '') ? $post['user_index_number'] : $user_data['user_index_number'];
    $user_gender = (isset($post['user_gender']) && $post['user_gender'] != '') ? $post['user_gender'] : $user_data['user_gender'];
    $user_country = (isset($post['user_country']) && $post['user_country'] != '') ? $post['user_country'] : $user_data['user_country'];
    $user_state = (isset($post['user_state']) && $post['user_state'] != '') ? $post['user_state'] : $user_data['user_state'];
    $user_city = (isset($post['user_city']) && $post['user_city'] != '') ? $post['user_city'] : $user_data['user_city'];
    $user_address = (isset($post['user_address']) && $post['user_address'] != '') ? $post['user_address'] : $user_data['user_address'];
    $user_postcode = (isset($post['user_postcode']) && $post['user_postcode'] != '') ? $post['user_postcode'] : $user_data['user_postcode'];
   
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

    if ($_POST) {
        // code...
        $sql = "
            UPDATE `thylies_user` 
            SET `user_fullname` = ?, `user_email` = ?, `user_phone` = ?, `user_school_name` = ?, `user_index_number` = ?, `user_gender` = ?, `user_country` = ?, `user_state` = ?, `user_city` = ?, `user_address` = ?, `user_postcode` = ? 
            WHERE user_unique_id = ?
        ";
        $statement = $conn->prepare($sql);
        $result = $statement->execute([$user_fullname, $user_email, $user_phone, $user_school_name, $user_index_number, $user_gender, $user_country, $user_state, $user_city, $user_address, $user_postcode, $user_data['user_unique_id']]);
        if (isset($result)) {
            $subject = "Profile Update.";
            $body = "
                <h3>
                    {$user_fullname},</h3>
                    <p>
                        You just updated your user profile at 
                        <br><h3>{$createdAt}</h3>
                    </p>
                    <br>
                    Best Regards,<br>
                    Thylies Ghana.
            ";

            $mail_result = send_email($user_fullname, $user_email, $subject, $body);
            if ($mail_result) {
                $_SESSION['flash_success'] = 'Profile details updated successfully!';
                redirect(PROOT . 'user/index');
            }
        } else {

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
							<form class="row" method="POST" id="settingsForm">
								<div class="mb-3 col-12 col-md-12">
									<label class="form-label" for="user_fullname">Name of Student<span class="text-danger">*</span></label>
									<input type="password" name="old_password" value="<?= $old_password; ?>" class="form-control" required>
								</div>
								<div class="mb-3 col-12 col-md-12">
									<label class="form-label" for="user_email">Email<span class="text-danger">*</span></label>
									<input type="password" name="password" value="<?= $password; ?>" class="form-control" required>
								</div>
								<div class="mb-3 col-12 col-md-12">
									<label class="form-label" for="user_phone">Phone<span class="text-danger">*</span></label>
									<input type="password" name="confirm" value="<?= $confirm; ?>" class="form-control" required>
								</div>

                                <div class="col-12">
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#settingsModalCenter">Submit</button>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="settingsModalCenter" tabindex="-1" role="dialog" aria-labelledby="settingsModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                Are you sure you want to update your password?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button class="g-recaptcha btn btn-warning" data-sitekey="<?= RECAPTCHA_SITE_KEY; ?>" data-callback='submit_settings_form' data-action='submit' type="submit">Yes</button>
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
        // Fade out messages
        $("#temporary").fadeOut(5000);

        function submit_settings_form(token) {
            $('#settingsForm').submit();
        }
    </script>