<?php

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID']) || !isset($_SESSION['USER_TYPE']) || $_SESSION['USER_TYPE'] != 1){
        header("Location: ../forms/login/login.php");
        exit();
    }

    require_once "../config/database_connection.inc.php";
    require_once "../includes/assets.inc.php";

    try{

        $users_list = [];
        $user_type = 2;

        $get_users_list = "
            SELECT * FROM users
            WHERE user_type = :user_type AND deleted_at IS NULL;
        ";

        $statement = $connection->prepare($get_users_list);

        $statement->bindParam(":user_type", $user_type);

        $statement->execute();

        $users_list = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach($users_list as $key => $user){
            $country_details = get_country_name($connection, $user['country_id']);
            $state_details = get_state_name($connection, $user['state_id']);
    
            $users_list[$key]['country_name'] = $country_details;
            $users_list[$key]['state_name'] = $state_details;
        }


    }catch(PDOException $error){
        log_database_error($error);
        exit();
    }

?>