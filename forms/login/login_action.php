<?php
    session_start();

    require_once "../../includes/form_input_handling.php";
    require_once "../../config/database_connection.inc.php";
    require_once "../../includes/assets.inc.php";

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
        }

        if($proceed_login){
            try{
                $get_user_query = "
                    SELECT * FROM users
                    WHERE email_id = :email_id;
                ";
                
                $statement = $connection->prepare($get_user_query);
                
                $statement->bindParam(":email_id", $email_id);
                
                $statement->execute();
                
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);

                
                if(!empty($results)){
                    $user_password = $results[0]['password'];
                    $user_type = $results[0]['user_type'];
                    $user_id = $results[0]['user_id'];

                    $password_check = password_verify($password, $user_password);

                    if(!$password_check){
                        $password_error = "Password doesn't match.";
                    }else{
                        $_SESSION['USER_ID'] = $user_id;
                        $_SESSION['USER_TYPE'] = $user_type;
                        set_flash('success', 'Logged in successfully.');
                        if($user_type == 1){
                            header("Location: ../../admin/admin_index.php");
                        }else{
                            header("Location: ../../users/users_profile.php");
                        }
                        exit();
                    }

                }else{
                    $email_id_error = "User with this Email ID doesn't exist.";
                }


            }catch(PDOException $error){
                log_database_error($error);
                set_flash('error', 'Login failed! Please try again.');
                header("Location: login.php");
                exit();
            }
        }

    }
?>