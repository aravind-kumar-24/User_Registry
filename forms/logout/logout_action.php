<?php

    require_once "../../includes/assets.inc.php";

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    
    unset($_SESSION['USER_ID']);

    set_flash('success', 'You have been logged out!');

    header("Location: ../login/login.php");

    exit();

?>