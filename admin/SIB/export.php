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
            $sheet->setCellValue('D1', 'Student index');
            $sheet->setCellValue('E1', 'Program');
            $sheet->setCellValue('F1', 'WhatsApp');
            $sheet->setCellValue('G1', 'Contact');
            $sheet->setCellValue('H1', 'E-mail');
            $sheet->setCellValue('I1', 'Number of pads per semester');
            $sheet->setCellValue('J1', 'Brand of Sanitary pad');
            $sheet->setCellValue('K1', 'Number of pantie liners');
            $sheet->setCellValue('L1', 'Brand of Pantie liners');
            $sheet->setCellValue('M1', 'Number of tissue');
            $sheet->setCellValue('N1', 'Brand of tissue papers');
            $sheet->setCellValue('O1', 'Type of panties');
            $sheet->setCellValue('P1', 'Number of panties');
            $sheet->setCellValue('Q1', 'Design of panties');

            $rowCount = 2;
            foreach ($rows as $row) {
                $sheet->setCellValue('A' . $rowCount, ucwords($row['student_name']));
                $sheet->setCellValue('B' . $rowCount, $row['school_name']);
                $sheet->setCellValue('C' . $rowCount, ucwords($row['school_name']));
                $sheet->setCellValue('D' . $rowCount, $row['student_index']);
                $sheet->setCellValue('E' . $rowCount, ucwords($row['program']));
                $sheet->setCellValue('F' . $rowCount, $row['whatsapp']);
                $sheet->setCellValue('G' . $rowCount, $row['contact']);
                $sheet->setCellValue('H' . $rowCount, $row['email']);
                $sheet->setCellValue('I' . $rowCount, $row['number_of_pads_per_semester']);
                $sheet->setCellValue('J' . $rowCount, $row['brand_of_sanitary_pad']);
                $sheet->setCellValue('K' . $rowCount, $row['number_of_pantie_liners']);
                $sheet->setCellValue('L' . $rowCount, $row['brand_of_pantie_liners']);
                $sheet->setCellValue('M' . $rowCount, $row['number_of_tissue']);
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


    
