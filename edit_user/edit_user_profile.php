<?php
    session_start();

    if(!isset($_SESSION['USER_ID']) && empty($_SESSION['USER_ID'])){
        header("Location: ../forms/login/login.php");
        exit();
    }
    
    $project_root = '/Projects/User_Registry';

    require_once "../includes/header.inc.php";
    require_once "../includes/user_details.inc.php";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Registry</title>
        <link rel="icon" type="image/x-icon" href="../assets/images/user_registry_favicon.png"/>
        <link rel="stylesheet" href="../assets/css/header.css"/>
    </head>
    <body style="background-color: #F0F4F5;">
    </body>
</html>