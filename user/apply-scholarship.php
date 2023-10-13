<?php 

    require_once ("../connection/conn.php");

    if (user_is_logged_in()) {
        if (!check_payment_of_registration_fee($user_id)) {
            redirect(PROOT . 'auth/pay-registration');
        }
    } else {
        redirect(PROOT . 'auth/logout');
    }

    if (is_array(apllied_scholarship($user_id))) {
        // code...
        redirect(PROOT . 'user/scholarship-status');
    }

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
            INSERT INTO `thylies_scholarship`(`user_id`, `scholarship_id`, `student_name`, `student_dob`, `student_age`, `student_place_of_birth`, `student_place_of_residence`, `student_with_parent`, `student_family_size`, `father_name`, `father_age`, `father_occupation`, `mother_name`, `mother_age`, `mother_occupation`, `parent_alive`, `parent_deceased`, `wpys_fees`, `program_name`, `year_of_study`, `index_number`, `self_description`, `professional_dream`, `limitation`, `referee_name`, `relation_nature`, `referee_occupation`, `referee_contact`, `referee_address`, `referee_email`, `createdAt`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";
        $statement = $conn->prepare($sql);
        $result = $statement->execute([$user_id, $scholarship_id, $student_name, $student_dob, $student_age, $student_place_of_birth, $student_place_of_residence, $student_with_parent, $student_family_size, $father_name, $father_age, $father_occupation, $mother_name, $mother_age, $mother_occupation, $parent_alive, $parent_deceased, $wpys_fees, $program_name, $year_of_study, $index_number, $self_description, $professional_dream, $limitation, $referee_name, $relation_nature, $referee_occupation, $referee_contact, $referee_address, $referee_email, $createdAt]);
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
                echo 'did it';
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
							<h3 class="mb-0 h4">Scholarship Form</h3>
						</div>
						<div class="card-body p-4">
							<div class="d-lg-flex align-items-center justify-content-between">
								<div class="d-flex align-items-center mb-4 mb-lg-0">
									<img src="../assets/images/avatar-1.png" id="img-uploaded"
										class="avatar-xl rounded-circle " alt="">
									<div class="ms-3">
										<h4 class="mb-0">Your passport picture</h4>
										<p class=" mb-0 font-14">
											PNG or JPG no bigger than 800px wide and tall.
										</p>
									</div>
								</div>
								<div>
									<a href="#" class="btn btn-primary btn-sm">Upload Photo</a>

									<a href="#" class="btn btn-light btn-sm ">Delete Photo</a>
								</div>
							</div>
							<hr class="my-5">

							<div>
								<!-- form -->
								<form class="row" method="POST">
									<div class="col-12 col-md-12">
										<h4 class="mb-3">Bio Data</h4>
									</div>
									<div class="mb-3 col-12 col-md-12">
										<label class="form-label" for="student_name">Name of Student<span class="text-danger">*</span></label>
										<input type="text" id="student_name" name="student_name" class="form-control" placeholder="First Name" required <?= $student_name; ?>>
									</div>
									<div class="mb-3 col-12 col-md-6">
										<label class="form-label" for="student_dob">Date of Birth<span class="text-danger">*</span></label>
										<input type="date" id="student_dob" name="student_dob" class="form-control" required <?= $student_dob; ?>>
									</div>
									<div class="mb-3 col-12 col-md-6">
										<label class="form-label" for="student_age">Age of Student<span class="text-danger">*</span></label>
										<input type="number" min="1" id="student_age" class="form-control" required <?= $student_age; ?>>
									</div>
									<div class="mb-3 col-12 col-md-6">
										<label class="form-label" for="student_place_of_birth">Place of Birth</label>
										<input type="text" id="student_place_of_birth" name="student_place_of_birth" class="form-control" placeholder="Your place of birth" required <?= $student_place_of_birth; ?>>
									</div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="student_place_of_residence">Place of Residence</label>
                                        <input type="text" id="student_place_of_residence" name="student_place_of_residence" class="form-control" placeholder="Your lace of residence" required <?= $student_place_of_residence; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="student_with_parent">Do you live with your parents?</label>
                                        <select type="text" id="student_with_parent" name="student_with_parent" class="form-control" required>
                                            <option value=""></option>
                                            <option <?= (isset($_POST['student_with_parent']) && $_POST['student_with_parent'] == 'Yes' ? 'selected' : ''); ?> value="Yes">Yes</option>
                                            <option <?= (isset($_POST['student_with_parent']) && $_POST['student_with_parent'] == 'No' ? 'selected' : ''); ?> value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="student_family_size">Size of Family</label>
                                        <input type="text" id="student_family_size" name="student_family_size" class="form-control" placeholder="What is the size of your family?" required <?= $student_family_size; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="father_name">Father's Name</label>
                                        <input type="text" id="father_name" name="father_name" class="form-control"  placeholder="Enter your father's full name here" required <?= $father_name; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="father_age">Father's Age</label>
                                        <input type="number" min="1" id="father_age" name="father_age" class="form-control" required <?= $father_age; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="father_occupation">Father's Occupation</label>
                                        <input type="text" id="father_occupation" name="father_occupation" class="form-control" placeholder="Enter your father's occupation here" required <?= $father_occupation; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="mother_name">Mother's Name</label>
                                        <input type="text" id="mother_name" name="mother_name" class="form-control" placeholder="Enter your mother's full name here" required <?= $mother_name; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="mother_age">Mother's Age</label>
                                        <input type="number" min="1" id="mother_age" name="mother_age" class="form-control" required <?= $mother_age; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="mother_occupation">Mother's Occupation</label>
                                        <input type="text" id="mother_occupation" name="mother_occupation" class="form-control" placeholder="Enter your mother's occupation here" required <?= $mother_occupation; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="parent_alive">Are both parent alive?</label>
                                        <select type="text" id="parent_alive" name="parent_alive" class="form-control" required>
                                            <option value=""></option>
                                            <option <?= (isset($_POST['parent_alive']) && $_POST['parent_alive'] == 'Yes' ? 'selected' : ''); ?> value="Yes">Yes</option>
                                            <option <?= (isset($_POST['parent_alive']) && $_POST['parent_alive'] == 'Yes' ? 'selected' : ''); ?> value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="parent_deceased">If No, which of your parent is deseased?</label>
                                        <input type="text" id="parent_deceased" name="parent_deceased" class="form-control" required <?= $parent_deceased; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="wpys_fees">Who paid your last school fees?</label>
                                        <input type="text" id="wpys_fees" name="wpys_fees" class="form-control" required <?= $wpys_fees; ?>>
                                    </div>


									<div class="col-12 col-md-12">
										<h4 class="mb-3 mt-3">Academic Information</h4>
									</div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="program_name">Name of Program offered</label>
                                        <input type="text" id="program_name" name="program_name" class="form-control" required <?= $program_name; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-4">
                                        <label class="form-label" for="year_of_study">Year of Studies</label>
                                        <input type="text" id="year_of_study" name="year_of_study" class="form-control" required <?= $year_of_study; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-8">
                                        <label class="form-label" for="index_number">Index Number</label>
                                        <input type="text" id="index_number" name="index_number" class="form-control" required <?= $index_number; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="self_description">How would you describe yourself?</label>
                                        <textarea name="self_description" id="self_description" cols="30" rows="10" class="form-control" required><?= $self_description; ?></textarea>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="professional_dream">What is your professional dream?</label>
                                        <input type="text" id="professional_dream" name="professional_dream" class="form-control" required <?= $professional_dream; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="limitation">What is your limitation in your life as a student?</label>
                                        <input type="text" id="limitation" name="limitation" class="form-control" required <?= $limitation; ?>>
                                    </div>

                                    <div class="col-12 col-md-12">
                                        <h4 class="mb-3 mt-3">Referee Information</h4>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="referee_name">Name of Referee</label>
                                        <input type="text" id="referee_name" name="referee_name" class="form-control" required <?= $referee_name; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="relation_nature">Nature of relation to Applicant</label>
                                        <input type="text" id="relation_nature" name="relation_nature" class="form-control" required <?= $relation_nature; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="referee_occupation">Occupation of Referee</label>
                                        <input type="text" id="referee_occupation" name="referee_occupation" class="form-control" required <?= $referee_occupation; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="referee_contact">Contact of Referee</label>
                                        <input type="text" id="referee_contact" name="referee_contact" class="form-control" required <?= $referee_contact; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="referee_address">Address of Referee</label>
                                        <input type="text" id="referee_address" name="referee_address" class="form-control" required <?= $referee_address; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="referee_email">E-mail of Referee</label>
                                        <input type="email" id="referee_email" name="referee_email" class="form-control" <?= $referee_email; ?>>
                                    </div>

									<div class="col-12">
										<button class="btn btn-warning" type="submit">
											Submit
										</button>
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