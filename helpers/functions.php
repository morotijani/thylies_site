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

    //
    function check_gender_status($user_id) {
        global $conn;
        return false;

        $sql = "
            SELECT * FROM thylies_user 
            WHERE 
            AND user_id = ? 
            LIMIT 1 
        ";
        $statement = $conn->prepare($sql);
        $result = $statement->execute([$user_id]);
        if (isset($result)) {
            return true;
        }
    }