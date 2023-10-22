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
        $fileName = "Users-" . $data . "-sheet";

        $query = "SELECT * FROM thylies_user WHERE user_trash = 0";
        if ($data == 'trash') {
            $query = "SELECT * FROM thylies_user WHERE user_trash = 1";
        }
        $statement = $conn->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $count_row = $statement->fetchAll();

        if ($count_row > 0) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Header
            $sheet->setCellValue('A1', 'NAME');
            $sheet->setCellValue('B1', 'EMAIL');
            $sheet->setCellValue('C1', 'PHONE');
            $sheet->setCellValue('D1', 'INDEX NUMBER');
            $sheet->setCellValue('E1', 'GENDER');
            $sheet->setCellValue('F1', 'COUNTRY');
            $sheet->setCellValue('G1', 'STATE/REGION');
            $sheet->setCellValue('H1', 'CITY');
            $sheet->setCellValue('I1', 'ADDRESS');
            $sheet->setCellValue('J1', 'POSTAL CODE');
            $sheet->setCellValue('K1', 'VERIFICATION');
            $sheet->setCellValue('L1', 'JOINED DATE');
            $sheet->setCellValue('M1', 'LAST LOGIN');

            $rowCount = 2;
            foreach ($rows as $row) {
                $verified = 'Not verified';
                if ($row['user_verified'] == 1) {
                    $verified = 'Verified';
                }
                $sheet->setCellValue('A' . $rowCount, $row['user_fullname']);
                $sheet->setCellValue('B' . $rowCount, $row['user_email']);
                $sheet->setCellValue('C' . $rowCount, $row['user_phone']);
                $sheet->setCellValue('D' . $rowCount, $row['user_index_number']);
                $sheet->setCellValue('E' . $rowCount, $row['user_gender']);
                $sheet->setCellValue('F' . $rowCount, $row['user_country']);
                $sheet->setCellValue('G' . $rowCount, $row['user_state']);
                $sheet->setCellValue('H' . $rowCount, $row['user_city']);
                $sheet->setCellValue('I' . $rowCount, $row['user_address']);
                $sheet->setCellValue('J' . $rowCount, $row['user_postcode']);
                $sheet->setCellValue('K' . $rowCount, $verified);
                $sheet->setCellValue('L' . $rowCount, pretty_date($row['user_joined_date']));
                $sheet->setCellValue('M' . $rowCount, pretty_date($row['user_last_login']));
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
            } else {
                $writer = new Csv($spreadsheet);
                $NewFileName = $fileName . '.csv';
            }

            // $writer->save($NewFileName);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attactment; filename="' . urlencode($NewFileName) . '"');
            $writer->save('php://output');
            redirect(PROOT . 'admin/User/index');

        } else {
            $_SESSION['flash_error'] = "No Record Found";
            redirect(PROOT . 'admin/User/index');
        }
    }


    
