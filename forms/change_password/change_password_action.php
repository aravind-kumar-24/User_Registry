<?php

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID']) || !isset($_SESSION['USER_TYPE']) || empty($_SESSION['USER_TYPE'])){
        header("Location: ../login/login.php");
        exit();
    }

    $request_method = $_SERVER['REQUEST_METHOD'];

    if($request_method == "POST"){
        
        $old_password = $new_password = $confirm_new_password = "";
        $old_password_error = $new_password_error = $confirm_new_password_error = "";
    }

?>