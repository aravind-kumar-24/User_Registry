<?php

    function process_input_data($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);

        return $data;
    }

    function email_id_existing_check($connection, $email_id){
        $email_existing_check_query = "
            SELECT * FROM users
            WHERE email_id = :email_id;
        ";

        $email_existing_check_statement = $connection->prepare($email_existing_check_query);

        $email_existing_check_statement->bindParam(":email_id", $email_id);

        $email_existing_check_statement->execute();

        $results = $email_existing_check_statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    function mobile_existing_check($connection, $contact_number){
        $mobile_existing_check_query = "
            SELECT * FROM users
            WHERE mobile_number = :contact_number;
        ";

        $mobile_existing_check_statement = $connection->prepare($mobile_existing_check_query);

        $mobile_existing_check_statement->bindParam(":contact_number", $contact_number);

        $mobile_existing_check_statement->execute();

        $results = $mobile_existing_check_statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

?>