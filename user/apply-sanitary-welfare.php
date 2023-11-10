<?php 

    require_once ("../connection/conn.php");

    if (user_is_logged_in()) {
        // if (!check_payment_of_registration_fee($user_id)) {
        //     redirect(PROOT . 'auth/pay-registration');
        // }
    } else {
        redirect(PROOT . 'auth/logout');
    }

    if (!check_gender_status($user_data['user_unique_id'])) {
        $_SESSION['flash_error'] = 'Only females are allowed for the Sanitary Welfare application. If you ae a female, please update your profile.';
        redirect(PROOT . 'user/index');
    }

    if (is_array(applied_sanitary_welfare($user_data['user_unique_id']))) {
        redirect(PROOT . 'user/sanitary-welfare-status');
    }

    $SQL = "
        SELECT * FROM thylies_sanitary_welfare 
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
    $sw_id = guidv4();
    $student_name = (isset($post['student_name']) && $post['student_name'] != '') ? $post['student_name'] : '';
    $dob = (isset($post['dob']) && $post['dob'] != '') ? $post['dob'] : '';
    $school_name = (isset($post['school_name']) && $post['school_name'] != '') ? $post['school_name'] : '';
    $student_index = (isset($post['student_index']) && $post['student_index'] != '') ? $post['student_index'] : '';
    $program = (isset($post['program']) && $post['program'] != '') ? $post['program'] : '';
    $whatsapp = (isset($post['whatsapp']) && $post['whatsapp'] != '') ? $post['whatsapp'] : '';
    $contact = (isset($post['contact']) && $post['contact'] != '') ? $post['contact'] : '';
    $email = (isset($post['email']) && $post['email'] != '') ? $post['email'] : '';

    $number_of_pads_per_semester = (isset($post['number_of_pads_per_semester']) && $post['number_of_pads_per_semester'] != '') ? $post['number_of_pads_per_semester'] : '';
    $brand_of_sanitary_pad = (isset($post['brand_of_sanitary_pad']) && $post['brand_of_sanitary_pad'] != '') ? $post['brand_of_sanitary_pad'] : '';
    $number_of_pantie_liners = (isset($post['number_of_pantie_liners']) && $post['number_of_pantie_liners'] != '') ? $post['number_of_pantie_liners'] : '';
    $brand_of_pantie_liners = (isset($post['brand_of_pantie_liners']) && $post['brand_of_pantie_liners'] != '') ? $post['brand_of_pantie_liners'] : '';
    $number_of_tissue = (isset($post['number_of_tissue']) && $post['number_of_tissue'] != '') ? $post['number_of_tissue'] : '';
    $brand_of_tissue_papers = (isset($post['brand_of_tissue_papers']) && $post['brand_of_tissue_papers'] != '') ? $post['brand_of_tissue_papers'] : '';
    $type_of_panties = (isset($post['type_of_panties']) && $post['type_of_panties'] != '') ? $post['type_of_panties'] : '';
    $number_of_panties = (isset($post['number_of_panties']) && $post['number_of_panties'] != '') ? $post['number_of_panties'] : '';
    $design_of_panties = (isset($post['design_of_panties']) && $post['design_of_panties'] != '') ? $post['design_of_panties'] : '';

    $createdAt = date("Y-m-d H:i:s");

    if ($_POST) {
        // code...
        $sql = "
            UPDATE `thylies_sanitary_welfare` 
            SET `sw_id` = ?, `name_of_student` = ?, `dob` = ?, `school_name` = ?, `student_index` = ?, `program` = ?, `whatsapp` = ?, `contact` = ?, `email` = ?, `number_of_pads_per_semester` = ?, `brand_of_sanitary_pad` = ?, `number_of_pantie_liners` = ?, `brand_of_pantie_liners` = ?, `number_of_tissue` = ?, `brand_of_tissue_papers` = ?, `type_of_panties` = ?, `number_of_panties` = ?, `design_of_panties` = ?, `submitted` = ?, `createdAt` = ?
            WHERE user_id = ?
        ";
        $statement = $conn->prepare($sql);
        $result = $statement->execute([$sw_id, $student_name, $dob, $school_name, $student_index, $program, $whatsapp, $contact, $email, $number_of_pads_per_semester, $brand_of_sanitary_pad, $number_of_pantie_liners, $brand_of_pantie_liners, $number_of_tissue, $brand_of_tissue_papers, $type_of_panties, $number_of_panties, $design_of_panties, 1, $createdAt, $user_data['user_unique_id']]);
        if (isset($result)) {
            $subject = "Thylies Student in Business Fund Application.";
            $body = "
                <h3>
                    {$student_name},</h3>
                    <p>
                        Thank you for applying for the Thylies sanitary welfare fund application. Please your Sanitary Welfare code is:
                        <br><h3>{$sw_id}</h3>
                    </p>
                    We will get in touch with you soon.
                    <br>
                    <br>
                    Best Regards,<br>
                    Thylies Ghana.
            ";

            $mail_result = send_email($student_name, $user_data['user_email'], $subject, $body);
            if ($mail_result) {
                redirect(PROOT . 'user/sanitary-welfare-status');
           } else {
                echo js_alert('Something went wrong, try again.');
                redirect(PROOT . 'user/apply-sanitary-welfare');
           }
        } else {
            echo js_alert('Something went wrong, try again.');
            redirect(PROOT . 'user/apply-sanitary-welfare');
        }
    }

?>

	<div class="pb-12 mt-lg-n18 mt-n10">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-md-8 col-12">
					<div class="card rounded-3 mb-4 ">
						<div class="card-header bg-white p-4">
							<h3 class="mb-0 h4">SANITARY WELFARE</h3>
						</div>
						<div class="card-body p-4">
							<div class="d-lg-flex align-items-center justify-content-between">
								<div class="d-flex align-items-center mb-4 mb-lg-0">
                                    <span id="upload_profile">
									   <img src="<?= PROOT; ?>assets/media/<?= (($count_apply > 0 && $apply_row[0]['student_picture'] != '') ? 'sanitary-welfare/' .$apply_row[0]['student_picture']  : 'svg/friendly-ghost.svg'); ?>" class="avatar-xl rounded-circle " alt="">
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
								<form class="row" method="POST" id="sanitaryWelfareForm">
									<div class="col-12 col-md-12">
										<h4 class="mb-3">Bio Data</h4>
									</div>
									<div class="mb-3 col-6 col-md-6">
										<label class="form-label" for="student_name">NAME OF STUDENT<span class="text-danger">*</span></label>
										<input type="text" id="student_name" name="student_name" class="form-control" required <?= $student_name; ?>>
									</div>
									<div class="mb-3 col-6 col-md-6">
										<label class="form-label" for="school_name">School Name<span class="text-danger">*</span></label>
										<input type="text" id="school_name" name="school_name" class="form-control" required <?= $school_name; ?>>
									</div>
                                    <div class="mb-3 col-6 col-md-6">
                                        <label class="form-label" for="dob">Date of Birth<span class="text-danger">*</span></label>
                                        <input type="date" id="dob" name="dob" class="form-control" required <?= $dob; ?>>
                                    </div>
									<div class="mb-3 col-6 col-md-6">
										<label class="form-label" for="student_index">Student Index<span class="text-danger">*</span></label>
										<input type="text" id="student_index" name="student_index" class="form-control" required <?= $student_index; ?>>
									</div>
                                    <div class="mb-3 col-6 col-md-6">
                                        <label class="form-label" for="program">Program<span class="text-danger">*</span></label>
                                        <input type="text" id="program" name="program" class="form-control" required <?= $program; ?>>
                                    </div>
                                    <div class="mb-3 col-6 col-md-6">
                                        <label class="form-label" for="whatsapp">WhatsApp<span class="text-danger">*</span></label>
                                        <input type="text" id="whatsapp" name="whatsapp" class="form-control" required <?= $whatsapp; ?>>
                                    </div>
                                    <div class="mb-3 col-6 col-md-6">
                                        <label class="form-label" for="contact">Contact<span class="text-danger">*</span></label>
                                        <input type="text" id="contact" name="contact" class="form-control" required <?= $contact; ?>>
                                    </div>
                                    <div class="mb-3 col-6 col-md-6">
                                        <label class="form-label" for="email">E-mail<span class="text-danger">*</span></label>
                                        <input type="email" id="email" name="email" class="form-control" required <?= $email; ?>>
                                    </div>

									<div class="col-12 col-md-12">
										<h4 class="mb-3 mt-3">SANITARY PREFERENCE</h4>
									</div>
                                    <div class="mb-3 col-6 col-md-6">
                                        <label class="form-label" for="number_of_pads_per_semester">Number of pads per semester<span class="text-danger">*</span></label>
                                        <input type="number" min="1" max="4" id="number_of_pads_per_semester" name="number_of_pads_per_semester" class="form-control" required <?= $number_of_pads_per_semester; ?>>
                                    </div>
                                    <div class="mb-3 col-6 col-md-6">
                                        <label class="form-label" for="brand_of_sanitary_pad">Brand of Sanitary pad<span class="text-danger">*</span></label>
                                        <select type="text" id="brand_of_sanitary_pad" name="brand_of_sanitary_pad" class="form-control" required>
                                            <option value=""></option>
                                            <option value="Yazz">Yazz</option>
                                            <option value="Softcare">Softcare</option>
                                            <option value="Proper">Proper</option>
                                            <option value="Always Ultra">Always Ultra</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-6 col-md-6">
                                        <label class="form-label" for="number_of_pantie_liners">Number of pantie liners<span class="text-danger">*</span></label>
                                        <input type="number" min="1" max="4" id="number_of_pantie_liners" name="number_of_pantie_liners" class="form-control" required <?= $number_of_pantie_liners; ?>>
                                    </div>
                                    <div class="mb-3 col-6 col-md-6">
                                        <label class="form-label" for="brand_of_pantie_liners">Brand of Pantie liners<span class="text-danger">*</span></label>
                                        <select type="text" id="brand_of_pantie_liners" name="brand_of_pantie_liners" class="form-control" required>
                                            <option value=""></option>
                                            <option value="Yazz">Yazz</option>
                                            <option value="Softcare">Softcare</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-6 col-md-6">
                                        <label class="form-label" for="number_of_tissue">Number of tissue<span class="text-danger">*</span></label>
                                        <input type="number" min="1" max="4" id="number_of_tissue" name="number_of_tissue" class="form-control" required <?= $number_of_tissue; ?>>
                                    </div>
                                    <div class="mb-3 col-6 col-md-6">
                                        <label class="form-label" for="brand_of_tissue_papers">Brand of tissue papers<span class="text-danger">*</span></label>
                                        <select type="text" id="brand_of_tissue_papers" name="brand_of_tissue_papers" class="form-control" required>
                                            <option value=""></option>
                                            <option value="Softcare">Softcare</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-4 col-md-4">
                                        <label class="form-label" for="type_of_panties">Type of panties<span class="text-danger">*</span></label>
                                        <select type="text" id="type_of_panties" name="type_of_panties" class="form-control" required>
                                            <option value=""></option>
                                            <option value="Softcare">Softcare</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-4 col-md-4">
                                        <label class="form-label" for="number_of_panties">Number of panties<span class="text-danger">*</span></label>
                                        <select type="text" id="number_of_panties" name="number_of_panties" class="form-control" required>
                                            <option value=""></option>
                                            <option value="3">3</option>
                                            <option value="6">6</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-4 col-md-4">
                                        <label class="form-label" for="design_of_panties">Design of panties<span class="text-danger">*</span></label>
                                        <select type="text" id="design_of_panties" name="design_of_panties" class="form-control" required>
                                            <?= $design_of_panties; ?>
                                            <option value=""></option>
                                            <option value="Plain">Plain</option>
                                            <option value="Decorated">Decorated</option>
                                        </select>
                                    </div>

									<div class="col-12">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#sanitaryWelfareModalCenter">Submit</button>
									</div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="sanitaryWelfareModalCenter" tabindex="-1" role="dialog" aria-labelledby="sanitaryWelfareModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    Make sure your details you are to send is accurate before clicking on the proceed button.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button class="g-recaptcha btn btn-warning" data-sitekey="<?= RECAPTCHA_SITE_KEY; ?>" data-callback='submit_sanitary_welfare_form' data-action='submit' type="button">Proceed</button>
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

        function submit_sanitary_welfare_form(token) {
            $('#sanitaryWelfareForm').submit();
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
                        url: "<?= PROOT; ?>parsers/upload.sw.passport.picture.php",
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
                    url: "<?= PROOT; ?>parsers/delete.uploaded.sw.picture.php",
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