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
    function total_donation_amount () {
        global $conn;

        $sql = "
            SELECT SUM(donate_amount) AS total 
            FROM thylies_donations
        ";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $row = $statement->fetchAll();
        return money($row[0]['total']);
    }

    // Currently Paid
    function get_currently_paid() {
        
    }
    // Count Scholarships
    // Count Student in Business
    // Count Sanitary Welfare
    // Count Associates
