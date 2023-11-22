<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php";

    if (!admin_is_logged_in()) {
        admn_login_redirect();
    }

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Writer\Xls;
    use PhpOffice\PhpSpreadsheet\Writer\Csv;

    if (isset($_GET['data']) && !empty($_GET['type'])) {
        $data = sanitize($_GET['data']);
        $FileExtType = sanitize($_GET['type']);
        $fileName = "Student-in-Business-" . $data . "-sheet";

        if ($data == 'all') {
            $query = "SELECT * FROM thylies_sanitary_welfare WHERE trash = 0";
        } else if ($data == 'gained') {
            $query = "SELECT * FROM thylies_sanitary_welfare WHERE status = 1 AND trash = 0";
        } else if ($data == 'rejected') {
            $query = "SELECT * FROM thylies_sanitary_welfare WHERE status != 0 OR status != 1";
        }  else if ($data == 'trash') {
            $query = "SELECT * FROM thylies_sanitary_welfare WHERE trash = 1";
        }
        $statement = $conn->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $count_row = $statement->fetchAll();

        if ($count_row > 0) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Header
            $sheet->setCellValue('A1', 'NAME OF STUDENT');
            $sheet->setCellValue('B1', 'SCHOOL NAME');
            $sheet->setCellValue('C1', 'PROGRAM OF STUDY');
            $sheet->setCellValue('D1', 'INDEX NUMBER');
            $sheet->setCellValue('E1', 'AGE');
            $sheet->setCellValue('F1', 'REGION OF RESIDENCE');
            $sheet->setCellValue('G1', 'TOWN OF RESIDENCE');
            $sheet->setCellValue('H1', 'RESIDENTIAL ADDRESS');
            $sheet->setCellValue('I1', 'NAME OF BUSINESS');
            $sheet->setCellValue('J1', 'WHAT ARE THE GOALS AND OBJECTIVES OF YOUR BUSINESS');
            $sheet->setCellValue('K1', 'IS YOUR BUSINESS REGISTERED,WHY');
            $sheet->setCellValue('L1', 'HOW WILL YOUR PRODUCTS BE MADE OR HOW WOULD YOUR GOODS AND SERVICES FOR SALE BE
PROCURED');
            $sheet->setCellValue('M1', 'WOULD YOU INTRODUCE NEW GOODS AND SERVICES IN THE FUTURE IN ADDITION TO THE ONES YOU
ARE ALREADY DEALING IN');
            $sheet->setCellValue('N1', 'TARGET POPULACE');
            $sheet->setCellValue('O1', 'TARGETTED NUMBER OF CUSTOMERS PER DAY');
            $sheet->setCellValue('P1', 'TARGETTED CUSTOMERS PER SEMESTER');
            $sheet->setCellValue('Q1', 'CATEGORY OF BUSINESS');

            $rowCount = 2;
            foreach ($rows as $row) {
                $sheet->setCellValue('A' . $rowCount, ucwords($row['student_name']));
                $sheet->setCellValue('B' . $rowCount, $row['school_name']);
                $sheet->setCellValue('C' . $rowCount, ucwords($row['program_of_study']));
                $sheet->setCellValue('D' . $rowCount, $row['index_number']);
                $sheet->setCellValue('E' . $rowCount, ucwords($row['age']));
                $sheet->setCellValue('F' . $rowCount, $row['region_of_residence']);
                $sheet->setCellValue('G' . $rowCount, $row['town_of_residence']);
                $sheet->setCellValue('H' . $rowCount, $row['residence_address']);
                $sheet->setCellValue('I' . $rowCount, $row['name_of_business']);
                $sheet->setCellValue('J' . $rowCount, $row['goals_objectives']);
                $sheet->setCellValue('K' . $rowCount, $row['business_registered_why']);
                $sheet->setCellValue('L' . $rowCount, $row['be_procured']);
                $sheet->setCellValue('M' . $rowCount, $row['introduce_new']);
                $sheet->setCellValue('N' . $rowCount, $row['brand_of_tissue_papers']);
                $sheet->setCellValue('O' . $rowCount, $row['type_of_panties']);
                $sheet->setCellValue('P' . $rowCount, $row['number_of_panties']);
                $sheet->setCellValue('Q' . $rowCount, $row['design_of_panties']);
                $rowCount++;
            }

            if ($FileExtType == 'xlsx') {
                $writer = new Xlsx($spreadsheet);
                $NewFileName = $fileName . '.xlsx';
            } elseif($FileExtType == 'xls') {
                $writer = new Xls($spreadsheet);
                $NewFileName = $fileName . '.xls';
            } elseif($FileExtType == 'csv') {
                $writer = new Csv($spreadsheet);
                $NewFileName = $fileName . '.csv';
            }

            // $writer->save($NewFileName);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attactment; filename="' . urlencode($NewFileName) . '"');
            $writer->save('php://output');
            // redirect(PROOT . 'admin/SIB/index');

        } else {
            $_SESSION['flash_error'] = "No Record Found";
            redirect(PROOT . 'admin/SIB/index');
        }
    }


    
