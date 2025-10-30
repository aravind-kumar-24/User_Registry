<?php
    session_start();

    require_once "../../includes/form_input_handling.php";

    $request_method = $_SERVER['REQUEST_METHOD'];

    if($request_method == 'POST'){

        $email_id = $password = "";

        $email_id_error = $password_error = "";

        $proceed_login = true;

        if(empty($_POST['email_id'])){
            $email_id_error = "Email ID is required.";
            $proceed_login = false;
        }else{
            $email_id = process_input_data($_POST['email_id']);

            if(!filter_var($email_id, FILTER_VALIDATE_EMAIL)){
                $email_id_error = "Invalid Email Format.";
                $proceed_login = false;
            }

        }

        if(empty($_POST['password'])){
            $password_error = "Password is required.";
            $proceed_login = false;
        }else{
            $password = process_input_data($_POST['password']);

            if(!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{5,20}$/", $password)){
                $password_error = "Invalid Password format.";
                $proceed_login = false;
            }

        }

        if($proceed_login){
            
        }

    }
?>