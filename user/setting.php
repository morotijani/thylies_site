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
									<input type="text" id="user_fullname" name="user_fullname" class="form-control" required value="<?= $user_fullname; ?>">
								</div>
								<div class="mb-3 col-12 col-md-12">
									<label class="form-label" for="user_email">Email<span class="text-danger">*</span></label>
									<input type="email" id="user_email" name="user_email" class="form-control" required value="<?= $user_email; ?>">
								</div>
								<div class="mb-3 col-12 col-md-12">
									<label class="form-label" for="user_phone">Phone<span class="text-danger">*</span></label>
									<input type="number" min="1" id="user_phone" name="user_phone" class="form-control" required value="<?= $user_phone; ?>">
								</div>
                                <div class="mb-3 col-12 col-md-12">
                                    <label class="form-label" for="user_school_name">School Name<span class="text-danger">*</span></label>
                                    <input type="number" min="1" id="user_school_name" name="user_school_name" class="form-control" required value="<?= $user_school_name; ?>">
                                </div>
                                <div class="mb-3 col-12 col-md-12">
                                    <label class="form-label" for="user_index_number">Index Number<span class="text-danger">*</span></label>
                                    <input type="number" min="1" id="user_index_number" name="index_number" class="form-control" required value="<?= $user_index_number; ?>">
                                </div>
                                <div class="mb-3 col-12 col-md-12">
                                    <label class="form-label" for="user_gender">Gender<span class="text-danger">*</span></label>
                                    <input type="number" min="1" id="user_gender" name="user_gender" class="form-control" required value="<?= $user_gender; ?>">
                                </div>
                                <div class="mb-3 col-12 col-md-12">
                                    <label class="form-label" for="user_country">Country</label>
                                    <input type="number" min="1" id="user_country" name="user_country" class="form-control" value="<?= $user_country; ?>">
                                </div>
                                <div class="mb-3 col-12 col-md-12">
                                    <label class="form-label" for="user_state">State / Region</label>
                                    <input type="number" min="1" id="user_state" name="user_state" class="form-control" value="<?= $user_state; ?>">
                                </div>
                                <div class="mb-3 col-12 col-md-12">
                                    <label class="form-label" for="user_city">City</label>
                                    <input type="number" min="1" id="user_city" name="user_city" class="form-control" value="<?= $user_city; ?>">
                                </div>
                                <div class="mb-3 col-12 col-md-12">
                                    <label class="form-label" for="user_address">Address<span class="text-danger">*</span></label>
                                    <input type="number" min="1" id="user_address" name="user_address" class="form-control" value="<?= $user_address; ?>">
                                </div>
                                <div class="mb-3 col-12 col-md-12">
                                    <label class="form-label" for="user_postcode">Post Code</label>
                                    <input type="number" min="1" id="user_postcode" name="user_postcode" class="form-control" value="<?= $user_postcode; ?>">
                                </div>

                                <div class="col-12">
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#settingsModalCenter">Submit</button>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="settingsModalCenter" tabindex="-1" role="dialog" aria-labelledby="settingsModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                Are you sure you ant to make these changes?
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