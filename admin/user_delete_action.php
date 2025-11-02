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

    if(empty($_GET['uid'])){
        set_flash('error','Invalid request.');
        header("Location: admin_index.php");
        exit();
    }

    $token = $_GET['uid'];
    $user_id = base64_decode($token, true);

    if($user_id === false || empty($user_id)){
        set_flash('error','Invalid user token.');
        header("Location: admin_index.php");
        exit();
    }

    try{
        $user_delete_query = "
            UPDATE users
            SET deleted_at = NOW()
            WHERE user_id = :user_id;
        ";

        $statement = $connection->prepare($user_delete_query);

        $statement->bindParam(":user_id", $user_id);

        $statement->execute();

        set_flash('success','User deleted successfully.');
        header("Location: admin_index.php");
        exit();
    }catch(PDOException $error){
        set_flash('error', 'Delete Failed.');
        header("Location: admin_index.php");
        log_database_error($error);
        exit();
    }
?>