<?php


 	// Generate UUID VERSION 4
    function guidv4($data = null) {
        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);

        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    // user veirfied
    function check_user_verified($user_verified, $user_email) {
        if ($user_verified != 1) {
            return '
                <div class="alert alert-primary" role="alert">
                   Please make sure you verify your account ' . $user_email . '
                </div>
            ';
        } else {
            return false;
        }
    }

    // 
    function applied_student_in_business($user_id) {
        global $conn;

        $sql = "
            SELECT * FROM thylies_student_in_business 
            WHERE user_id = ? 
            AND submitted = ? 
            LIMIT 1
        ";
        $statement = $conn->prepare($sql);
        $statement->execute([$user_id, 1]);
        $count_row = $statement->rowCount();
        $row = $statement->fetchAll();

        if ($count_row > 0) {
            return $row[0];
        } else {
            return false;
        }
    }

    // 
    function applied_sanitary_welfare($user_id) {
        global $conn;

        $sql = "
            SELECT * FROM thylies_sanitary_welfare 
            WHERE user_id = ? 
            AND submitted = ? 
            LIMIT 1
        ";
        $statement = $conn->prepare($sql);
        $statement->execute([$user_id, 1]);
        $count_row = $statement->rowCount();
        $row = $statement->fetchAll();

        if ($count_row > 0) {
            return $row[0];
        } else {
            return false;
        }
    }

    // check user to see if user is a female
    function check_gender_status($user_unique_id) {
        global $conn;

        $sql = "
            SELECT * FROM thylies_user 
            WHERE user_gender = ? 
            AND user_unique_id = ? 
            LIMIT 1 
        ";
        $statement = $conn->prepare($sql);
        $statement->execute(['Female', $user_unique_id]);
        $result = $statement->rowCount();
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Check if you has paid sanitary welfare fee after granted
    function check_payment_of_sanitary_welfare_fee($sw_id) {
        global $conn;

        $sql = "
            SELECT * FROM thylies_transactions
            INNER JOIN thylies_sanitary_welfare 
            ON thylies_sanitary_welfare.sw_id = thylies_transactions.from_id 
            WHERE thylies_sanitary_welfare.sw_id = ? 
            LIMIT 1
        ";
        $statement = $conn->prepare($sql);
        $statement->execute([$sw_id]);
        $result = $statement->rowCount();
        $row = $statement->fetchAll();

        if ($result > 0) {
            if ($row[0]['status'] = 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Check if you has paid sanitary welfare fee after granted
    function check_payment_of_student_in_business_fee($sib_id) {
        global $conn;

        $sql = "
            SELECT * FROM thylies_transactions
            INNER JOIN thylies_student_in_business 
            ON thylies_student_in_business.sib_id = thylies_transactions.from_id 
            WHERE thylies_student_in_business.sib_id = ? 
            LIMIT 1
        ";
        $statement = $conn->prepare($sql);
        $statement->execute([$sib_id]);
        $result = $statement->rowCount();
        $row = $statement->fetchAll();

        if ($result > 0) {
            if ($row[0]['status'] = 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Total donations
    function total_service_amount() {
        global $conn;

        $sql = "
            SELECT COUNT(transaction_id) AS total 
            FROM thylies_transactions
        ";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $row = $statement->fetchAll();
        $amount = ($row[0]['total'] * 101);
        return money_symbol('₵', $amount);
    }

    // Total donations
    function total_donation_amount() {
        global $conn;

        $sql = "
            SELECT SUM(donate_amount) AS total 
            FROM thylies_donates
        ";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $row = $statement->fetchAll();
        return money_symbol('₵', $row[0]['total']);
    }

    // Currently Paid
    function get_currently_paid() {
        global $conn;
        $output = '';

        $sql = "
            SELECT * FROM thylies_transactions 
            ORDER BY thylies_transactions.createdAt DESC
            LIMIT 3
        ";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $count_row = $statement->rowCount();
        $rows = $statement->fetchAll();

        if ($count_row > 0) {
            foreach ($rows as $row) {
                $output .= '
                    <div class="list-group-item d-flex align-items-center border rounded">
                        <div class="me-4">
                            <div class="avatar rounded-circle"><img alt="..." src="/img/people/img-1.jpg"></div>
                        </div>
                        <div class="flex-fill">
                            <a href="#" class="d-block h6 font-semibold mb-1">' . ucwords($row["transaction_id"]) . '</a>
                            <span class="d-block text-sm text-muted">' . strtoupper($row['transaction_service']) . '</span>
                        </div>
                        <div class="ms-auto text-end">
                            <div class="">
                                <a class="text-muted" href="javascript:;">' . pretty_date_half($row['createdAt']) . '</a>
                            </div>
                        </div>
                    </div>
                ';
            }
        } else {
            $output = '
                <div class="list-group-item d-flex align-items-center border rounded">
                    <div class="me-4">
                        <div class="avatar rounded-circle"><img alt="..." src="/img/people/img-1.jpg"></div>
                    </div>
                    <div class="flex-fill">
                        <a href="#" class="d-block h6 font-semibold mb-1">Paid status</a>
                        <span class="d-block text-sm text-muted">there are currently no paid amount for any of our services</span>
                    </div>
                </div>
            ';
        }

        return $output;

    }

    // Count Scholarships
    function count_scholarship() {
        global $conn;

        $sql = "
            SELECT * FROM thylies_scholarship 
            WHERE trash = ?
        ";
        $statement = $conn->prepare($sql);
        $statement->execute([0]);
        return $statement->rowCount();
    }

    // Count Student in Business
    function count_student_in_business() {
        global $conn;

        $sql = "
            SELECT * FROM thylies_student_in_business 
            WHERE trash = ?
        ";
        $statement = $conn->prepare($sql);
        $statement->execute([0]);
        return $statement->rowCount();
    }

    // Count Sanitary Welfare
    function count_sanitary_welfare() {
        global $conn;

        $sql = "
            SELECT * FROM thylies_sanitary_welfare 
            WHERE trash = ?
        ";
        $statement = $conn->prepare($sql);
        $statement->execute([0]);
        return $statement->rowCount();
    }

    // Count Associates
    
    // Last 5 users
    function last_five_users() {
        global $conn;
        $output = '';

        $sql = '
            SELECT * FROM thylies_user 
            WHERE user_trash = ? 
            ORDER BY user_id DESC 
            LIMIT 5
        ';
        $statement = $conn->prepare($sql);
        $statement->execute([0]);
        $count_row = $statement->rowCount();
        $rows = $statement->fetchAll();

        if ($count_row > 0) {
            // code...
            foreach ($rows as $row) {
                $verified = '';
                if ($row['user_verified'] == 1) {
                    $verified = '
                        <span class="badge badge-lg badge-dot">
                            <i class="bg-success"></i>Verified
                        </span>
                    ';
                } else {
                    $verified = '
                        <span class="badge badge-lg badge-dot">
                            <i class="bg-danger"></i>No verified
                        </span>
                    ';
                }

                $output .= '
                    <tr>
                        <td>' . ucwords($row["user_fullname"]) . '</td>
                        <td>' . $row["user_email"] . '</td>
                        <td>' . $row["user_phone"] . ' </td>
                        <td>' . pretty_date($row["user_joined_date"]) . ' </td>
                        <td>' . $row["user_index_number"] . '</td>
                        <td>' . $row["user_gender"] . '</td>
                        <td>' . $verified . '</td>
                        <td class="text-end">
                            <a href="' . PROOT . 'admin/User/view/' . $row["user_unique_id"] . '" class="btn btn-sm btn-neutral">View</a> 
                            <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                ';
            }
        } else {
            $output = '
                <tr>
                    <td rowspan="8">No data found.</td>
                </tr>
            ';
        }

        return $output;
    }
