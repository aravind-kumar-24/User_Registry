<?php

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID']) || !isset($_SESSION['USER_TYPE']) || empty($_SESSION['USER_TYPE'])){
        header("Location: ../login/login.php");
        exit();
    }

    require_once "../../includes/form_input_handling.php";
    require_once "../../config/database_connection.inc.php";
    require_once "../../includes/user_details.inc.php";

    $request_method = $_SERVER['REQUEST_METHOD'];
    $user_id = $_SESSION['USER_ID'];
    $saved_password = "";

    if($request_method == "POST"){
        
        $old_password = $new_password = $confirm_new_password = "";
        $old_password_error = $new_password_error = $confirm_new_password_error = "";

        $proceed_password_change = true;

        if(empty($_POST['old_password'])){
            $old_password_error = "Old Password is required.";
            $proceed_password_change = false;
        }else{
            $old_password = process_input_data($_POST['old_password']);

            try{
                $user_details = $user_details;
                $saved_password = $user_details['password'];

                if(!password_verify($old_password, $saved_password)){
                    $old_password_error = "Old Password doesn't match";
                    $proceed_password_change = false;
                };
            }catch(PDOException $error){
                log_database_error($error);
            }
        }

        if(empty($_POST['new_password'])){
            $new_password_error = "New Password is required.";
            $proceed_password_change = false;
        }else{
            $new_password = process_input_data($_POST['new_password']);

            if(!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{5,20}$/", $new_password)){
                $new_password_error = "Invalid Password format.";
                $proceed_password_change = false;
            }

            if(password_verify($new_password, $saved_password)){
                $new_password_error = "New Password cannot be same as old password.";
                $proceed_password_change = false;
            }

        }

        if(empty($_POST['confirm_new_password'])){
            $confirm_new_password_error = "Confirm New Password is required.";
            $proceed_password_change = false;
        }else{
            $confirm_new_password = process_input_data($_POST['confirm_new_password']);

            if(isset($new_password) && !empty($new_password)){
                if($new_password != $confirm_new_password){
                    $confirm_new_password_error = "Password doesn't match.";
                    $proceed_password_change = false;
                }
            }
        }

        if($proceed_password_change){
            try{

                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                $update_password_query = "
                    UPDATE users
                    SET password = :password
                    WHERE user_id = :user_id;
                ";

                $statement = $connection->prepare($update_password_query);
                $statement->bindParam(":password", $hashed_new_password);
                $statement->bindParam(":user_id", $user_id);

                $statement->execute();
                set_flash('success', 'Passwod Updated successfully!');
                header("Location: ../../users/users_profile.php");
                exit();
            }catch(PDOException $error){
                log_database_error($error);
                set_flash('error', 'Password Update failed! Please try again.');
                header("Location: change_password.php");
                exit();
            }
        }
    }

?>