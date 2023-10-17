<?php 
	require ('./../connection/conn.php');

	include ('includes/header.php');
	include ('includes/left.side.bar.php');
	include ('includes/top.nav.bar.php');

	if (isset($_POST['submit_scholarship_import'])) {
		
        $fileName = $_FILES['import_file']['name'];
        $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

        $allowed_ext = ['xls','csv','xlsx'];

        if (in_array($file_ext, $allowed_ext)) {
            $inputFileNamePath = $_FILES['import_file']['tmp_name'];
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();


            $count = "0";
            foreach($data as $row) {
                if ($count > 0) {

                	$pALive = '';
                	if ($row['13'] == 'Y') {
                		$pALive = 'Yes';
                	} else if ($row['13'] == 'N') {
                		$pALive = 'No';
                	}

                	$withParent = '';
                	if ($row['5'] == 'Y') {
                		$withParent = 'Yes';
                	} else if ($row['13'] == 'N') {
                		$withParent = 'No';
                	}

                    $scholarship_id = guidv4();
                    $student_name = $row['0'];
                    $student_dob = $row['1'];
                    $student_age = $row['2'];
                    $student_place_of_birth = $row['3'];
                    $student_place_of_residence = $row['4'];
                    $student_with_parent = $withParent;
                    $student_family_size = $row['6'];
                    $father_name = $row['7'];
                    $father_age = $row['8'];
                    $father_occupation = $row['9'];
                    $mother_name = $row['10'];
                    $mother_age = $row['11'];
                    $mother_occupation = $row['12'];
                    $parent_alive = $pALive;
                    $parent_deceased = $row['14'];
                    $wpys_fees = $row['15'];
                    $program_name = $row['16'];
                    $year_of_study = $row['17'];
                    $index_number = $row['18'];
                    $self_description = $row['19'];
                    $professional_dream = $row['20'];
                    $limitation = $row['21'];
                    $referee_name = $row['22'];
                    $relation_nature = $row['23'];
                    $referee_occupation = $row['24'];
                    $referee_contact = $row['25'];
                    $referee_address = $row['26'];
                    $referee_email = $row['27'];
                    $student_picture = '';
                    $submitted = 1;
                    $createdAt = date("Y-m-d H:m:s");
                    
                    //
                    $sql = "
                        SELECT * FROM thylies_user 
                        WHERE user_index_number = ? 
                        LIMIT 1
                    ";
                    $statement = $conn->prepare($sql);
                    $statement->execute([$index_number]);
                    $count_row = $statement->rowCount();
                    $sub_row = $statement->fetchAll();
                    if ($count_row > 0) {
                        // insert to scholarship table
                        $userUniqueId = $sub_row[0]['user_unique_id'];
                        $query = "
                            INSERT INTO `thylies_scholarship`(`user_id`, `scholarship_id`, `student_name`, `student_dob`, `student_age`, `student_place_of_birth`, `student_place_of_residence`, `student_with_parent`, `student_family_size`, `father_name`, `father_age`, `father_occupation`, `mother_name`, `mother_age`, `mother_occupation`, `parent_alive`, `parent_deceased`, `wpys_fees`, `program_name`, `year_of_study`, `index_number`, `self_description`, `professional_dream`, `limitation`, `referee_name`, `relation_nature`, `referee_occupation`, `referee_contact`, `referee_address`, `referee_email`, `student_picture`, `submitted`, `createdAt`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                        ";
                    } else {
                        // add to user
                        $userUniqueId = guidv4();
                        $password = password_hash('12345678', PASSWORD_BCRYPT);
                        $addQ = "
                            INSERT INTO thylies_user (user_unique_id, user_fullname, user_index_number, user_password) 
                            VALUES (?, ?, ?, ?)
                        ";
                        $statement = $conn->prepare($addQ);
                        $statement->execute([$userUniqueId, $student_name, $index_number, $password]);

                        // insert to scholarship table
                        $userID = $conn->lastInsertId();
                        $query = "
                            INSERT INTO `thylies_scholarship`(`user_id`, `scholarship_id`, `student_name`, `student_dob`, `student_age`, `student_place_of_birth`, `student_place_of_residence`, `student_with_parent`, `student_family_size`, `father_name`, `father_age`, `father_occupation`, `mother_name`, `mother_age`, `mother_occupation`, `parent_alive`, `parent_deceased`, `wpys_fees`, `program_name`, `year_of_study`, `index_number`, `self_description`, `professional_dream`, `limitation`, `referee_name`, `relation_nature`, `referee_occupation`, `referee_contact`, `referee_address`, `referee_email`, `student_picture`, `submitted`, `createdAt`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                        ";
                        
                    }
                    $statement = $conn->prepare($query);
                    $result = $statement->execute([$userUniqueId, $scholarship_id, $student_name, $student_dob, $student_age, $student_place_of_birth, $student_place_of_residence, $student_with_parent, $student_family_size, $father_name, $father_age, $father_occupation, $mother_name, $mother_age, $mother_occupation, $parent_alive, $parent_deceased, $wpys_fees, $program_name, $year_of_study, $index_number, $self_description, $professional_dream, $limitation, $referee_name, $relation_nature, $referee_occupation, $referee_contact, $referee_address, $referee_email, $student_picture, $submitted, $createdAt]);
                } else {
                    $count = "1";
                }
            }

            if (isset($result)) {
                $_SESSION['flash_success'] = "Scholarship list Successfully Imported";
                redirect(PROOT . 'admin/Scholarship-import');
            } else {
                $_SESSION['flash_error'] = "Importation failed";
                redirect(PROOT . 'admin/Scholarship-import');
            }

        } else {
            $_SESSION['flash_error'] = "Invalid File type, ('xls','csv','xlsx') are accepted.";
            redirect(PROOT . 'admin/Scholarship-import');
        }
    }
?>

	<!--  -->
	<header>
		<div class="container-fluid">
			<div class="border-bottom pt-6">
				<div class="row align-items-center">
					<div class="col-sm col-12">
						<h1 class="h2 ls-tight">
							<span class="d-inline-block me-3">👋</span>Import, Scholarhip Data
						</h1>
					</div>
					<div class="col-sm-auto col-12 mt-4 mt-sm-0">
						<div class="hstack gap-2 justify-content-sm-end">
							<a href="<?= PROOT; ?>admin/Scholarship-import" class="btn btn-sm btn-neutral border-base">
								<span class="pe-2"><i class="bi bi-arrow-clockwise"></i> </span>
								<span>Refresh</span> 
							</a>
							<a href="<?= PROOT; ?>admin/index" class="btn btn-sm btn-primary">
								<span class="pe-2"><i class="bi bi-arrow-left"></i> </span>
								<span>Go Back</span>
							</a>
						</div>
					</div>
				</div>
				<ul class="nav nav-tabs overflow-x border-0">
					<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship-import" class="nav-link active">Import Data</a></li>
					<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship" class="nav-link">View all</a></li>
					<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship/rejected" class="nav-link">Rejected</a></li>
					<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship/accepted" class="nav-link">Accpted</a></li>
				</ul>
			</div>
		</div>
	</header>

	<main class="py-6 bg-surface-secondary">
		<div class="container-fluid">
			<?= $flash; ?>
			<div>
				<div class="row justify-content-center mt-10">
					<div class="col-md-6">
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="d-flex flex-column flex-sm-row justify-content-between gap-3">
								<div class="input-group input-group-lg input-group-inline">
									<span class="input-group-text pe-2"><i class="bi bi-file-text"></i> </span>
									<input type="file" class="form-control form-control-lg" name="import_file">
								</div>
								<button type="submit" name="submit_scholarship_import" class="btn btn-lg btn-warning text-nowrap">Import</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
	
<?php include ('includes/footer.php'); ?>