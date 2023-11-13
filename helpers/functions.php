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
    function check_payment_of_sanitary_welfare_fee($user_id) {
        global $conn;

        $sql = "
            SELECT * FROM thylies_user_registration_transaction
            INNER JOIN thylies_user 
            ON thylies_user.user_id = thylies_user_registration_transaction.user_id 
            WHERE thylies_user.user_id = ? 
            LIMIT 1
        ";
        $statement = $conn->prepare($sql);
        $statement->execute([$user_id]);
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
