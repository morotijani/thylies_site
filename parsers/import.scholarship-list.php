<?php 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php";

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
                $student_name = $row['0'];
                $student_dob = $row['1'];
                $student_age = $row['2'];
                $student_place_of_birth = $row['3'];
                $student_place_of_residence = $row['4'];
                $student_with_parent = $row['5'];
                $student_family_size = $row['6'];
                $father_name = $row['7'];
                $father_age = $row['8'];
                $father_occupation = $row['9'];
                $mother_name = $row['10'];
                $mother_age = $row['11'];
                $mother_occupation = $row['12'];
                $parent_alive = $row['13'];
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
                $student_picture = $row['28'];
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
                } else {
                    // add to user
                    $userUniqueId = guidv4();
                    $password = password_hash('12345678', PASSWORD_BCRYPT);
                    $addQ = "
                        INSERT INTO thylies_user (user_unique_id, user_fullname, user_index_number, user_password) 
                        VALUES (?, ?, ?, ?)
                    ";
                    $statement = $conn->prepare($addQ);
                    $statement->execute([$student_name, $index_number, $password]);

                    // insert to scholarship table
                    $userID = $conn->lastInsertId();
                    
                }

                INSERT INTO `thylies_scholarship`(`user_id`, `scholarship_id`, `student_name`, `student_dob`, `student_age`, `student_place_of_birth`, `student_place_of_residence`, `student_with_parent`, `student_family_size`, `father_name`, `father_age`, `father_occupation`, `mother_name`, `mother_age`, `mother_occupation`, `parent_alive`, `parent_deceased`, `wpys_fees`, `program_name`, `year_of_study`, `index_number`, `self_description`, `professional_dream`, `limitation`, `referee_name`, `relation_nature`, `referee_occupation`, `referee_contact`, `referee_address`, `referee_email`, `student_picture`, `submitted`, `createdAt`) VALUES ()

                $studentQuery = "INSERT INTO students (fullname,email,phone,course) VALUES ('$fullname','$email','$phone','$course')";
                $result = mysqli_query($con, $studentQuery);
                $msg = true;
            }
            else
            {
                $count = "1";
            }
        }

        if(isset($msg))
        {
            $_SESSION['message'] = "Successfully Imported";
            header('Location: index.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Imported";
            header('Location: index.php');
            exit(0);
        }
    }
    else
    {
        $_SESSION['message'] = "Invalid File";
        header('Location: index.php');
        exit(0);
    }
}