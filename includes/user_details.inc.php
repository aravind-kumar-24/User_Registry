<?php

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if(!isset($_SESSION['USER_ID']) && empty($_SESSION['USER_ID'])){
        header("Location: ../forms/login/login.php");
        exit();
    }

    require_once "../config/database_connection.inc.php";
    require_once "../includes/assets.inc.php";

    try{
        $user_id =  $_SESSION['USER_ID'];

        $user_details = [];

        $get_user_details = "
            SELECT * FROM users
            WHERE user_id = :user_id;
        ";

        $statement = $connection->prepare($get_user_details);

        $statement->bindParam(":user_id", $user_id);

        $statement->execute();

        $user_details = $statement->fetch();

        $country_details = get_country_name($connection, $user_details['country_id']);

        $user_details['country_name'] = $country_details;

        $state_details = get_state_name($connection, $user_details['state_id']);

        $user_details['state_name'] = $state_details;

    }catch(PDOException $error){
        log_database_error($error);
        exit();
    }

?>