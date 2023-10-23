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
        SELECT * FROM thylies_student_in_business 
        WHERE user_id = ? 
        LIMIT 1
    ";
    $statement = $conn->prepare($SQL);
    $statement->execute([$user_id]);
    $apply_row = $statement->fetchAll();
    $count_apply = $statement->rowCount();

    $title = 'Apply Scholarship - ';
    include ("inc/user.header.inc.php");

    //
    $post = (isset($_POST) ? cleanPost($_POST) : '');
    $scholarship_id = guidv4();
    $student_name = (isset($post['student_name']) && $post['student_name'] != '') ? $post['student_name'] : '';
    $student_dob = (isset($post['student_dob']) && $post['student_dob'] != '') ? $post['student_dob'] : '';
    $student_age = (isset($post['student_age']) && $post['student_age'] != '') ? $post['student_age'] : '';
    $student_place_of_birth = (isset($post['student_place_of_birth']) && $post['student_place_of_birth'] != '') ? $post['student_place_of_birth'] : '';
    $student_place_of_residence = (isset($post['student_place_of_residence']) && $post['student_place_of_residence'] != '') ? $post['student_place_of_residence'] : '';
    $student_with_parent = (isset($post['student_with_parent']) && $post['student_with_parent'] != '') ? $post['student_with_parent'] : '';
    $student_family_size = (isset($post['student_family_size']) && $post['student_family_size'] != '') ? $post['student_family_size'] : '';
    $father_name = (isset($post['father_name']) && $post['father_name'] != '') ? $post['father_name'] : '';
    $father_age = (isset($post['father_age']) && $post['father_age'] != '') ? $post['father_age'] : '';
    $father_occupation = (isset($post['father_occupation']) && $post['father_occupation'] != '') ? $post['father_occupation'] : '';
    $mother_name = (isset($post['mother_name']) && $post['mother_name'] != '') ? $post['mother_name'] : '';
    $mother_age = (isset($post['mother_age']) && $post['mother_age'] != '') ? $post['mother_age'] : '';
    $mother_occupation = (isset($post['mother_occupation']) && $post['mother_occupation'] != '') ? $post['mother_occupation'] : '';
    $parent_alive = (isset($post['parent_alive']) && $post['parent_alive'] != '') ? $post['parent_alive'] : '';
    $parent_deceased = (isset($post['parent_deceased']) && $post['parent_deceased'] != '') ? $post['parent_deceased'] : '';
    $wpys_fees = (isset($post['wpys_fees']) && $post['wpys_fees'] != '') ? $post['wpys_fees'] : '';
    $program_name = (isset($post['program_name']) && $post['program_name'] != '') ? $post['program_name'] : '';
    $year_of_study = (isset($post['year_of_study']) && $post['year_of_study'] != '') ? $post['year_of_study'] : '';
    $index_number = (isset($post['index_number']) && $post['index_number'] != '') ? $post['index_number'] : '';
    $self_description = (isset($post['self_description']) && $post['self_description'] != '') ? $post['self_description'] : '';
    $professional_dream = (isset($post['professional_dream']) && $post['professional_dream'] != '') ? $post['professional_dream'] : '';
    $limitation = (isset($post['limitation']) && $post['limitation'] != '') ? $post['limitation'] : '';
    $referee_name = (isset($post['referee_name']) && $post['referee_name'] != '') ? $post['referee_name'] : '';
    $relation_nature = (isset($post['relation_nature']) && $post['relation_nature'] != '') ? $post['relation_nature'] : '';
    $referee_occupation = (isset($post['referee_occupation']) && $post['referee_occupation'] != '') ? $post['referee_occupation'] : '';
    $referee_contact = (isset($post['referee_contact']) && $post['referee_contact'] != '') ? $post['referee_contact'] : '';
    $referee_address = (isset($post['referee_address']) && $post['referee_address'] != '') ? $post['referee_address'] : '';
    $referee_email = (isset($post['referee_email']) && $post['referee_email'] != '') ? $post['referee_email'] : '';
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
                    Thylies Enterprise.
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
							<h3 class="mb-0 h4">STUDENT BUSINESS FUND APPLICATION</h3>
						</div>
						<div class="card-body p-4">
							<div class="d-lg-flex align-items-center justify-content-between">
								<div class="d-flex align-items-center mb-4 mb-lg-0">
                                    <span id="upload_profile">
									   <img src="<?= PROOT; ?>assets/media/<?= (($count_apply > 0 && $apply_row[0]['student_picture'] != '') ? 'student-in-business/' .$apply_row[0]['student_picture']  : 'svg/friendly-ghost.svg'); ?>" class="avatar-xl rounded-circle " alt="">
                                    </span>
									<div class="ms-3">
										<h4 class="mb-0">Your passport picture</h4>
										<p class=" mb-0 font-14">
											PNG or JPG or JPEG no bigger than 800px wide and tall.
										</p>
									</div>
								</div>
								<div>

									<label for="passport" class="btn btn-primary btn-sm <?= (($count_apply > 0 && $apply_row[0]['student_picture'] != '') ? 'd-none' : 'd-block'); ?>">Upload Photo</label>
                                    <input type="file" name="passport" id="passport" hidden>
									<a href="javascript:;" id="<?= (($count_apply > 0 && $apply_row[0]['student_picture'] != '') ? $apply_row[0]['student_picture'] : ''); ?>" class="change-passport-picture btn btn-light btn-sm <?= (($count_apply > 0 && $apply_row[0]['student_picture'] != '') ? 'd-block' : 'd-none'); ?>">Delete Photo</a>
								</div>
							</div>
							<hr class="my-5">

							<div class="<?= (($count_apply > 0 && $apply_row[0]['student_picture'] != '') ? 'd-block' : 'd-none'); ?>">
								<!-- form -->
								<form class="row" method="POST" id="scholarshipForm">
									<div class="col-12 col-md-12">
										<h4 class="mb-3">STUDENT INFORMATION</h4>
									</div>
									<div class="mb-3 col-12 col-md-12">
										<label class="form-label" for="student_name">NAME OF STUDENTt<span class="text-danger">*</span></label>
										<input type="text" id="student_name" name="student_name" class="form-control" placeholder="First Name" required <?= $student_name; ?>>
									</div>
									<div class="mb-3 col-12 col-md-6">
										<label class="form-label" for="student_dob">PROGRAM OF STUDY<span class="text-danger">*</span></label>
										<input type="date" id="student_dob" name="student_dob" class="form-control" required <?= $student_dob; ?>>
									</div>
									<div class="mb-3 col-12 col-md-6">
										<label class="form-label" for="student_age">INDEX NUMBER<span class="text-danger">*</span></label>
										<input type="number" min="1" id="student_age" class="form-control" required <?= $student_age; ?>>
									</div>
									<div class="mb-3 col-12 col-md-6">
										<label class="form-label" for="student_place_of_birth">AGE<span class="text-danger">*</span></label>
										<input type="text" id="student_place_of_birth" name="student_place_of_birth" class="form-control" placeholder="Your place of birth" required <?= $student_place_of_birth; ?>>
									</div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="student_place_of_residence">REGION OF RESIDENCE<span class="text-danger">*</span></label>
                                        <input type="text" id="student_place_of_residence" name="student_place_of_residence" class="form-control" placeholder="Your lace of residence" required <?= $student_place_of_residence; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="student_family_size">TOWN OF RESIDENCE<span class="text-danger">*</span></label>
                                        <input type="text" id="student_family_size" name="student_family_size" class="form-control" placeholder="What is the size of your family?" required <?= $student_family_size; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="father_name">RESIDENTIAL ADDRESS<span class="text-danger">*</span></label>
                                        <input type="text" id="father_name" name="father_name" class="form-control"  placeholder="Enter your father's full name here" required <?= $father_name; ?>>
                                    </div>

									<div class="col-12 col-md-12">
										<h4 class="mb-3 mt-3">BUSINESS INFORMATION</h4>
									</div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="program_name">NAME OF BUSINESS<span class="text-danger">*</span></label>
                                        <input type="text" id="program_name" name="program_name" class="form-control" required <?= $program_name; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-4">
                                        <label class="form-label" for="year_of_study">WHAT ARE THE GOALS AND OBJECTIVES OF YOUR BUSINESS<span class="text-danger">*</span></label>
                                        <textarea type="text" id="year_of_study" name="year_of_study" class="form-control" required <?= $year_of_study; ?>></textarea>
                                    </div>
                                    <div class="mb-3 col-12 col-md-8">
                                        <label class="form-label" for="index_number">IS YOUR BUSINESS REGISTERED, WHY?<span class="text-danger">*</span></label>
                                        <textarea type="text" id="index_number" name="index_number" class="form-control" required <?= $index_number; ?>></textarea>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="self_description">HOW WILL YOUR PRODUCTS BE MADE OR HOW WOULD YOUR GOODS AND SERVICES FOR SALE BE PROCURED<span class="text-danger">*</span></label>
                                        <textarea name="self_description" id="self_description" cols="30" rows="10" class="form-control" required><?= $self_description; ?></textarea>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="professional_dream">WOULD YOU INTRODUCE NEW GOODS AND SERVICES IN THE FUTURE IN ADDITION TO THE ONES YOU ARE ALREADY DEALING IN<span class="text-danger">*</span></label>
                                        <textarea type="text" id="professional_dream" name="professional_dream" class="form-control" required <?= $professional_dream; ?>></textarea>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="limitation">TARGET POPULACE<span class="text-danger">*</span></label>
                                        <input type="text" id="limitation" name="limitation" class="form-control" required <?= $limitation; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="referee_name">TARGETTED NUMBER OF CUSTOMERS PER DAY<span class="text-danger">*</span></label>
                                        <input type="text" id="referee_name" name="referee_name" class="form-control" required <?= $referee_name; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="relation_nature">TARGETTED CUSTOMERS PER SEMESTER<span class="text-danger">*</span></label>
                                        <input type="text" id="relation_nature" name="relation_nature" class="form-control" required <?= $relation_nature; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="referee_occupation">CATEGORY OF BUSINESS<span class="text-danger">*</span></label>
                                        <input type="text" id="referee_occupation" name="referee_occupation" class="form-control" required <?= $referee_occupation; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="referee_contact">EXPECTED BUDGET OF COMMENCEMENT/EXPANSION<span class="text-danger">*</span></label>
                                        <input type="text" id="referee_contact" name="referee_contact" class="form-control" required <?= $referee_contact; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="referee_address">EXPECTED PROFIT PER DAY<span class="text-danger">*</span></label>
                                        <input type="text" id="referee_address" name="referee_address" class="form-control" required <?= $referee_address; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="referee_email">EXPECTED PROFIT PER SEMESTER</label>
                                        <input type="email" id="referee_email" name="referee_email" class="form-control" <?= $referee_email; ?>>
                                    </div>

									<div class="col-12">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#scholarshipModalCenter">Submit</button>
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
                                                    <button class="g-recaptcha btn btn-warning" data-sitekey="<?= RECAPTCHA_SITE_KEY; ?>" data-callback='submit_schorlarship_form' data-action='submit' type="submit">Proceed</button>
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

        function submit_schorlarship_form(token) {
            $('#scholarshipForm').submit();
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