<?php 

    require_once ("../connection/conn.php");

    if (user_is_logged_in()) {
        // if (!check_payment_of_registration_fee($user_id)) {
        //     redirect(PROOT . 'auth/pay-registration');
        // }
    } else {
        redirect(PROOT . 'auth/logout');
    }

    if (is_array(applied_sanitary_welfare($user_data['user_unique_id']))) {
        redirect(PROOT . 'user/sanitary-welfare-status');
    }

    $SQL = "
        SELECT * FROM thylies_student_in_business 
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
    $sib_id = guidv4();
    $student_name = (isset($post['student_name']) && $post['student_name'] != '') ? $post['student_name'] : '';
    $program_of_study = (isset($post['program_of_study']) && $post['program_of_study'] != '') ? $post['program_of_study'] : '';
    $index_number = (isset($post['index_number']) && $post['index_number'] != '') ? $post['index_number'] : '';
    $age = (isset($post['age']) && $post['age'] != '') ? $post['age'] : '';
    $region_of_residence = (isset($post['region_of_residence']) && $post['region_of_residence'] != '') ? $post['region_of_residence'] : '';
    $town_of_residence = (isset($post['town_of_residence']) && $post['town_of_residence'] != '') ? $post['town_of_residence'] : '';
    $residence_address = (isset($post['residence_address']) && $post['residence_address'] != '') ? $post['residence_address'] : '';
    $name_of_business = (isset($post['name_of_business']) && $post['name_of_business'] != '') ? $post['name_of_business'] : '';
    $goals_objectives = (isset($post['goals_objectives']) && $post['goals_objectives'] != '') ? $post['goals_objectives'] : '';
    $business_registered_why = (isset($post['business_registered_why']) && $post['business_registered_why'] != '') ? $post['business_registered_why'] : '';
    $be_procured = (isset($post['be_procured']) && $post['be_procured'] != '') ? $post['be_procured'] : '';
    $introduce_new = (isset($post['introduce_new']) && $post['introduce_new'] != '') ? $post['introduce_new'] : '';
    $target_populace = (isset($post['target_populace']) && $post['target_populace'] != '') ? $post['target_populace'] : '';
    $number_per_day = (isset($post['number_per_day']) && $post['number_per_day'] != '') ? $post['number_per_day'] : '';
    $customers_per_semester = (isset($post['customers_per_semester']) && $post['customers_per_semester'] != '') ? $post['customers_per_semester'] : '';
    $category_of_business = (isset($post['category_of_business']) && $post['category_of_business'] != '') ? $post['category_of_business'] : '';
    $expected_budget = (isset($post['expected_budget']) && $post['expected_budget'] != '') ? $post['expected_budget'] : '';
    $expected_profit_per_day = (isset($post['expected_profit_per_day']) && $post['expected_profit_per_day'] != '') ? $post['expected_profit_per_day'] : '';
    $expected_profit_per_semester = (isset($post['expected_profit_per_semester']) && $post['expected_profit_per_semester'] != '') ? $post['expected_profit_per_semester'] : '';
    $createdAt = date("Y-m-d H:i:s");

    if ($_POST) {
        // code...
        $sql = "
            UPDATE `thylies_student_in_business` 
            SET `sib_id` = ?, `student_name` = ?, `program_of_study` = ?, `index_number` = ?, `age` = ?, `region_of_residence` = ?, `town_of_residence` = ?, `residence_address` = ?, `name_of_business` = ?, `goals_objectives` = ?, `business_registered_why` = ?, `be_procured` = ?, `introduce_new` = ?, `target_populace` = ?, `number_per_day` = ?, `customers_per_semester` = ?, `category_of_business` = ?, `expected_budget` = ?, `expected_profit_per_day` = ?, `expected_profit_per_semester` = ?, `submitted` = ?, `createdAt` = ?
            WHERE user_id = ?
        ";
        $statement = $conn->prepare($sql);
        $result = $statement->execute([$sib_id, $student_name, $program_of_study, $index_number, $age, $region_of_residence, $town_of_residence, $residence_address, $name_of_business, $goals_objectives, $business_registered_why, $be_procured, $introduce_new, $target_populace, $number_per_day, $customers_per_semester, $category_of_business, $expected_budget, $expected_profit_per_day, $expected_profit_per_semester, 1, $createdAt, $user_data['user_unique_id']]);
        if (isset($result)) {
            $subject = "Thylies Student in Business Fund Application.";
            $body = "
                <h3>
                    {$student_name},</h3>
                    <p>
                        Thank you for applying for the Thylies student in business fund application. Please your SiB identity code is:
                        <br><h3>{$sib_id}</h3>
                    </p>
                    We will get in touch with you soon.
                    <br>
                    <br>
                    Best Regards,<br>
                    Thylies Ghana.
            ";

            $mail_result = send_email($student_name, $user_data['user_email'], $subject, $body);
            if ($mail_result) {
                redirect(PROOT . 'user/student-in-business-status');
           } else {
                echo js_alert('Something went wrong, try again.');
                redirect(PROOT . 'user/apply-student-in-business');
           }
        } else {
            echo js_alert('Something went wrong, try again.');
            redirect(PROOT . 'user/apply-student-in-business');
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
								<form class="row" method="POST" id="studentInBusinessForm">
									<div class="col-12 col-md-12">
										<h4 class="mb-3">STUDENT INFORMATION</h4>
									</div>
									<div class="mb-3 col-12 col-md-12">
										<label class="form-label" for="student_name">NAME OF STUDENT<span class="text-danger">*</span></label>
										<input type="text" id="student_name" name="student_name" class="form-control" placeholder="First Name" required <?= $student_name; ?>>
									</div>
									<div class="mb-3 col-12 col-md-12">
										<label class="form-label" for="program_of_study">PROGRAM OF STUDY<span class="text-danger">*</span></label>
										<input type="text" id="program_of_study" name="program_of_study" class="form-control" required <?= $program_of_study; ?>>
									</div>
									<div class="mb-3 col-12 col-md-12">
										<label class="form-label" for="index_number">INDEX NUMBER<span class="text-danger">*</span></label>
										<input type="text" id="index_number" name="index_number" class="form-control" required <?= $index_number; ?>>
									</div>
									<div class="mb-3 col-12 col-md-12">
										<label class="form-label" for="age">AGE<span class="text-danger">*</span></label>
										<input type="number" min="1" id="age" name="age" class="form-control" placeholder="Your place of birth" required <?= $age; ?>>
									</div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="region_of_residence">REGION OF RESIDENCE<span class="text-danger">*</span></label>
                                        <input type="text" id="region_of_residence" name="region_of_residence" class="form-control" placeholder="Your lace of residence" required <?= $region_of_residence; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="town_of_residence">TOWN OF RESIDENCE<span class="text-danger">*</span></label>
                                        <input type="text" id="town_of_residence" name="town_of_residence" class="form-control" placeholder="What is the size of your family?" required <?= $town_of_residence; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="residence_address">RESIDENTIAL ADDRESS<span class="text-danger">*</span></label>
                                        <input type="text" id="residence_address" name="residence_address" class="form-control"  placeholder="Enter your father's full name here" required <?= $residence_address; ?>>
                                    </div>

									<div class="col-12 col-md-12">
										<h4 class="mb-3 mt-3">BUSINESS INFORMATION</h4>
									</div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="name_of_business">NAME OF BUSINESS<span class="text-danger">*</span></label>
                                        <input type="text" id="name_of_business" name="name_of_business" class="form-control" required <?= $name_of_business; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="goals_objectives">WHAT ARE THE GOALS AND OBJECTIVES OF YOUR BUSINESS<span class="text-danger">*</span></label>
                                        <textarea type="text" id="goals_objectives" name="goals_objectives" class="form-control" required><?= $goals_objectives; ?></textarea>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="business_registered_why">IS YOUR BUSINESS REGISTERED, WHY?<span class="text-danger">*</span></label>
                                        <textarea type="text" id="business_registered_why" name="business_registered_why" class="form-control" required><?= $business_registered_why; ?></textarea>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="be_procured">HOW WILL YOUR PRODUCTS BE MADE OR HOW WOULD YOUR GOODS AND SERVICES FOR SALE BE PROCURED<span class="text-danger">*</span></label>
                                        <textarea name="be_procured" id="be_procured" class="form-control" required><?= $be_procured; ?></textarea>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="introduce_new">WOULD YOU INTRODUCE NEW GOODS AND SERVICES IN THE FUTURE IN ADDITION TO THE ONES YOU ARE ALREADY DEALING IN<span class="text-danger">*</span></label>
                                        <textarea type="text" id="introduce_new" name="introduce_new" class="form-control" required><?= $introduce_new; ?></textarea>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="target_populace">TARGET POPULACE<span class="text-danger">*</span></label>
                                        <input type="text" id="target_populace" name="target_populace" class="form-control" required <?= $target_populace; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="number_per_day">TARGETTED NUMBER OF CUSTOMERS PER DAY<span class="text-danger">*</span></label>
                                        <input type="number" min="0" id="number_per_day" name="number_per_day" class="form-control" required <?= $number_per_day; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="customers_per_semester">TARGETTED CUSTOMERS PER SEMESTER<span class="text-danger">*</span></label>
                                        <input type="number" min="0" id="customers_per_semester" name="customers_per_semester" class="form-control" required <?= $customers_per_semester; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="category_of_business">CATEGORY OF BUSINESS<span class="text-danger">*</span></label>
                                        <input type="text" id="category_of_business" name="category_of_business" class="form-control" required <?= $category_of_business; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="expected_budget">EXPECTED BUDGET OF COMMENCEMENT/EXPANSION<span class="text-danger">*</span></label>
                                        <input type="number" min="0" step="0.01" id="expected_budget" name="expected_budget" class="form-control" required <?= $expected_budget; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="expected_profit_per_day">EXPECTED PROFIT PER DAY<span class="text-danger">*</span></label>
                                        <input type="number" min="0" step="0.01" id="expected_profit_per_day" name="expected_profit_per_day" class="form-control" required <?= $expected_profit_per_day; ?>>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="expected_profit_per_semester">EXPECTED PROFIT PER SEMESTER</label>
                                        <input type="number" min="0" step="0.01" id="expected_profit_per_semester" name="expected_profit_per_semester" class="form-control" <?= $expected_profit_per_semester; ?>>
                                    </div>

									<div class="col-12">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#studentInBusinessModalCenter">Submit</button>
									</div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="studentInBusinessModalCenter" tabindex="-1" role="dialog" aria-labelledby="studentInBusinessModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    Make sure your details you are to send is accurate before clicking on the proceed button.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button class="g-recaptcha btn btn-warning" data-sitekey="<?= RECAPTCHA_SITE_KEY; ?>" data-callback='submit_student_in_business_form' data-action='submit' type="submit">Proceed</button>
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

        function submit_student_in_business_form(token) {
            $('#studentInBusinessForm').submit();
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
                        url: "<?= PROOT; ?>parsers/upload.sib.passport.picture.php",
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
                    url: "<?= PROOT; ?>parsers/delete.uploaded.sib.picture.php",
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