<?php 

    require_once ("../connection/conn.php");

    if (user_is_logged_in()) {
        // if (!check_payment_of_registration_fee($user_id)) {
        //     redirect(PROOT . 'auth/pay-registration');
        // }
    } else {
        redirect(PROOT . 'auth/logout');
    }

    // if (is_array(applied_scholarship($user_id))) {
    //     redirect(PROOT . 'user/scholarship-status');
    // }

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
    $user_fullname = (isset($post['user_fullname']) && $post['user_fullname'] != '') ? $post['user_fullname'] : '';
    $user_email = (isset($post['user_email']) && $post['user_email'] != '') ? $post['user_email'] : '';
   
    $createdAt = date("Y-m-d H:i:s");

    if ($_POST) {
        // code...
        $sql = "
            UPDATE `thylies_scholarship` 
            SET `scholarship_id` = ?, `student_name` = ?, `student_dob` = ?, `student_age` = ?, `student_place_of_birth` = ?, `student_place_of_residence` = ?, `student_with_parent` = ?, `student_family_size` = ?, `father_name` = ?, `father_age` = ?, `father_occupation` = ?, `mother_name` = ?, `mother_age` = ?, `mother_occupation` = ?, `parent_alive` = ?, `parent_deceased` = ?, `wpys_fees` = ?, `program_name` = ?, `year_of_study` = ?, `index_number` = ?, `self_description` = ?, `professional_dream` = ?, `limitation` = ?, `referee_name` = ?, `relation_nature` = ?, `referee_occupation` = ?, `referee_contact` = ?, `referee_address` = ?, `referee_email` = ?, `submitted` = ?, `createdAt` = ?
            WHERE user_id = ?
        ";
        $statement = $conn->prepare($sql);
        $result = $statement->execute([$scholarship_id, $student_name, $student_dob, $student_age, $student_place_of_birth, $student_place_of_residence, $student_with_parent, $student_family_size, $father_name, $father_age, $father_occupation, $mother_name, $mother_age, $mother_occupation, $parent_alive, $parent_deceased, $wpys_fees, $program_name, $year_of_study, $index_number, $self_description, $professional_dream, $limitation, $referee_name, $relation_nature, $referee_occupation, $referee_contact, $referee_address, $referee_email, 1, $createdAt, $user_data['user_unique_id']]);
        if (isset($result)) {
            $subject = "Thylies Scholarhip Application.";
            $body = "
                <h3>
                    {$student_name},</h3>
                    <p>
                        Thank you for applying for the Thylies scholarship program. Please your scholarhip identity code is:
                        <br><h3>{$scholarship_id}</h3>
                    </p>
                    We will get in touch with you soon.
                    <br>
                    <br>
                    Best Regards,<br>
                    Thylies Ghana.
            ";

            $mail_result = send_email($student_name, $user_data['user_email'], $subject, $body);
            if ($mail_result) {
                redirect(PROOT . 'user/scholarship-status');
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
								<!-- form -->
								<form class="row" method="POST" id="settingsForm">
									<div class="mb-3 col-12 col-md-12">
										<label class="form-label" for="user_fullname">Name of Student<span class="text-danger">*</span></label>
										<input type="text" id="user_fullname" name="user_fullname" class="form-control" placeholder="First Name" required <?= $user_data['user_fullname']; ?>>
									</div>
									<div class="mb-3 col-12 col-md-12">
										<label class="form-label" for="user_email">Email<span class="text-danger">*</span></label>
										<input type="email" id="user_email" name="user_email" class="form-control" required <?= $user_data['user_email']; ?>>
									</div>
									<div class="mb-3 col-12 col-md-12">
										<label class="form-label" for="user_phone">Phone<span class="text-danger">*</span></label>
										<input type="number" min="1" id="user_phone" name="user_phone" class="form-control" required <?= $user_data['user_phone']; ?>>
									</div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="user_school_name">School Name<span class="text-danger">*</span></label>
                                        <input type="number" min="1" id="user_school_name" name="user_school_name" class="form-control" required <?= $user_data['user_school_name']; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="user_index_number">Index Number<span class="text-danger">*</span></label>
                                        <input type="number" min="1" id="user_index_number" name="index_number" class="form-control" required <?= $user_data['user_index_number ']; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="user_gender">Gender<span class="text-danger">*</span></label>
                                        <input type="number" min="1" id="user_gender" class="form-control" required <?= $user_data['user_gender']; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="student_age">Index Number<span class="text-danger">*</span></label>
                                        <input type="number" min="1" id="student_age" class="form-control" required <?= $user_data['user_index_number ']; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="student_age">Index Number<span class="text-danger">*</span></label>
                                        <input type="number" min="1" id="student_age" class="form-control" required <?= $user_data['user_index_number ']; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="student_age">Index Number<span class="text-danger">*</span></label>
                                        <input type="number" min="1" id="student_age" class="form-control" required <?= $user_data['user_index_number ']; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="student_age">Index Number<span class="text-danger">*</span></label>
                                        <input type="number" min="1" id="student_age" class="form-control" required <?= $user_data['user_index_number ']; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="student_age">Index Number<span class="text-danger">*</span></label>
                                        <input type="number" min="1" id="student_age" class="form-control" required <?= $user_data['user_index_number ']; ?>>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="scholarshipModalCenter" tabindex="-1" role="dialog" aria-labelledby="scholarshipModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    Make sure your details you are to send is accurate before clicking on the proceed button.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button class="g-recaptcha btn btn-warning" data-sitekey="<?= RECAPTCHA_SITE_KEY; ?>" data-callback='submit_settings_form' data-action='submit' type="submit">Proceed</button>
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
	</div>

    <?php include ('../inc/footer.inc.php'); ?>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>

        function submit_settings_form(token) {
            $('#settingsForm').submit();
        }

        $(document).ready(function() {
            

            // Fade out messages
            $("#temporary").fadeOut(5000);

            // Upload IMAGE Temporary
            $(document).on('change','#passport', function() {

                var property = document.getElementById("passport").files[0];
                var image_name = property.name;

                var image_extension = image_name.split(".").pop().toLowerCase();
                if (jQuery.inArray(image_extension, ['jpeg', 'png', 'jpg']) == -1) {
                    alert("The file extension must be .jpg, .png, .jpeg");
                    $('#passport').val('');
                    return false;
                }

                var image_size = property.size;
                if (image_size > 15000000) {
                    alert('The file size must be under 15MB');
                    return false;
                } else {

                    var form_data = new FormData();
                    form_data.append("passport", property);
                    $.ajax({
                        url: "<?= PROOT; ?>parsers/upload.scholarship.passport.picture.php",
                        method: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $("#upload_profile").html("<div class='text-success font-weight-bolder'>Uploading passport picture ...</div>");
                        },
                        success: function(data) {
                            location.reload();
                        }
                    });
                }
            });

            // DELETE TEMPORARY UPLOADED IMAGE
            $(document).on('click', '.change-passport-picture', function() {
                var tempuploded_file_id = $(this).attr('id');

                $.ajax ({
                    url: "<?= PROOT; ?>parsers/delete.uploaded.picture.php",
                    method: "POST",
                    data:{
                        tempuploded_file_id : tempuploded_file_id
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            });
        });
    </script>