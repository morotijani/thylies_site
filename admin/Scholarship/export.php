<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php";

    if (isset($_GET['data']) && !empty($_GET['type'])) {
        $data = sanitize($_GET['data']);
        $FileExtType = sanitize($_GET['type']);
        $fileName = "student-sheet";

        if ($data == 'all') {
            $query = "SELECT * FROM thylies_scholarship WHERE trash = 0";
        } else if ($data == 'gained') {
            $query = "SELECT * FROM thylies_scholarship WHERE percentage > 0 AND trash = 0";
        } else if ($data == 'rejected') {
            $query = "SELECT * FROM thylies_scholarship WHERE status != 0 OR status != 1";
        }  else if ($data == 'trash') {
            $query = "SELECT * FROM thylies_scholarship WHERE trash = 1";
        }
        $statement = $conn->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll()
        $count_row = $statement->fetchAll()

        if ($count_row > 0) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Header
            $sheet->setCellValue('A1', 'NAME');
            $sheet->setCellValue('B1', 'DATE OF BIRTH');
            $sheet->setCellValue('C1', 'AGE');
            $sheet->setCellValue('D1', 'PLACE OF BIRTH');
            $sheet->setCellValue('E1', 'PLACE OF RESIDENCE');
            $sheet->setCellValue('F1', 'LIVING WITH PARENT');
            $sheet->setCellValue('G1', 'FAMILY SIZE');
            $sheet->setCellValue('H1', 'FATHER\'S NAME');
            $sheet->setCellValue('I1', 'FATHER\'S AGE');
            $sheet->setCellValue('J1', 'FATHER\'S OCCUPATION');
            $sheet->setCellValue('K1', 'MOTHER\'S NAME');
            $sheet->setCellValue('L1', 'MOTHER\'S AGE');
            $sheet->setCellValue('L1', 'MOTHER\'S OCCUPATION');

            $rowCount = 2;
            foreach ($rows as $row) {
                $sheet->setCellValue('A'.$rowCount, $row['id']);
                $sheet->setCellValue('B'.$rowCount, $row['fullname']);
                $sheet->setCellValue('C'.$rowCount, $row['email']);
                $sheet->setCellValue('D'.$rowCount, $row['phone']);
                $sheet->setCellValue('E'.$rowCount, $row['course']);
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

        } else {
            $_SESSION['flash_error'] = "No Record Found";
            redirect(PROOT . 'admin/Scholarship/index');
        }
    }


    
