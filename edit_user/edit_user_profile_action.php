<?php

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID']) || !isset($_SESSION['USER_TYPE']) || empty($_SESSION['USER_TYPE'])){
        header("Location: ../forms/login/login.php");
        exit();
    }

    require_once "../includes/form_input_handling.php";
    require_once "../config/database_connection.inc.php";
    require_once "../includes/assets.inc.php";

    $request_method = $_SERVER['REQUEST_METHOD'];
    $user_id = $_SESSION['USER_ID'];

    if($request_method == 'POST'){

        $first_name = $last_name = $gender = $date_of_birth = $country = $state = $address = $password = $confirm_password = $profile_image = "";

        $first_name_error = $last_name_error = $gender_error = $date_of_birth_error = $country_error = $state_error = $address_error = $password_error = $confirm_password_error = $profile_image_error = "";

        $proceed_updation = true;

        if(empty($_POST['first_name'])){
            $first_name_error = "First Name is required";
            $proceed_updation = false;
        }else{
            $first_name = process_input_data($_POST['first_name']);
        }

        if(empty($_POST['last_name'])){
            $last_name_error = "Last Name is required";
            $proceed_updation = false;
        }else{
            $last_name = process_input_data($_POST['last_name']);
        }

        if(empty($_POST['gender'])){
            $gender_error = "Gender is required";
            $proceed_updation = false;
        }else{
            $gender = process_input_data($_POST['gender']);
        }

        if(empty($_POST['date_of_birth'])){
            $date_of_birth_error = "Date of Birth is required";
            $proceed_updation = false;
        }else{
            $date_of_birth = process_input_data($_POST['date_of_birth']);
        }

        if(empty($_POST['country'])){
            $country_error = "Country is required";
            $proceed_updation = false;
        }else{
            $country = process_input_data($_POST['country']);
        }

        if(empty($_POST['state'])){
            $state_error = "State is required";
            $proceed_updation = false;
        }else{
            $state = process_input_data($_POST['state']);
        }

        if(empty($_POST['address'])){
            $address_error = "Address is required";
            $proceed_updation = false;
        }else{
            $address = process_input_data($_POST['address']);
        }
        
        if(!empty($_FILES['profile_image']['name'])){
            $profile_image = $_FILES['profile_image']['name'];

            $directory = "uploads/profile_images";

            $directory_structure = "../uploads/profile_images";

            $file_type = strtolower(pathinfo($profile_image, PATHINFO_EXTENSION));

            $file_size = (int) $_FILES['profile_image']['size'];

            $allowed_extensions = ['jpeg', 'jpg', 'png'];

            $file_size_in_mb = $file_size / (1024 * 1024);

            if($file_size_in_mb > 5){
                $profile_image_error = "Maximum File size must be 5 mb.";
                $proceed_updation = false;
            }

            if(!in_array($file_type, $allowed_extensions)){
                $profile_image_error = "Invalid File type.";
                $proceed_updation = false;
            }
        }

        if($proceed_updation){
            try{

                if(!empty($profile_image)){
                    $unique_file_name = $user_id . '_profile.' . time() . '.' . $file_type;
    
                    $file_structure = $directory_structure.'/'.$unique_file_name;
                }

                $data_updation_query = "
                    UPDATE users
                    SET first_name = :first_name, last_name = :last_name, gender = :gender, date_of_birth = :date_of_birth, country_id = :country_id, state_id = :state_id, address = :address
                ";

                if(!empty($profile_image)){
                    $data_updation_query .= ",profile_path = :profile_path, profile_image = :profile_image";
                };

                $data_updation_query .= " WHERE user_id = :user_id;";
    
                $statement = $connection->prepare($data_updation_query);

                $statement->bindParam(":first_name", $first_name);
                $statement->bindParam(":last_name", $last_name);
                $statement->bindParam(":gender", $gender);
                $statement->bindParam(":date_of_birth", $date_of_birth);
                $statement->bindParam(":country_id", $country);
                $statement->bindParam(":state_id", $state);
                $statement->bindParam(":address", $address);
                $statement->bindParam(":user_id", $user_id);

                if(!empty($profile_image)){
                    $statement->bindParam(":profile_path", $directory);
                    $statement->bindParam(":profile_image", $unique_file_name);
                }
    
                $statement->execute();

                if(!empty($profile_image)){
                    move_uploaded_file($_FILES['profile_image']['tmp_name'], $file_structure);
                }
    
                $connection = null;
    
                $statement = null;

                set_flash('success', 'Profile Updated successfully!');
                header("Location: ../users/users_profile.php");
                exit();
            }catch(PDOException $error){
                log_database_error($error);
                set_flash('error', 'Profile Updation failed! Please try again.');
                header("Location: edit_user_profile.php");
                exit();
            }
        }
    }
?>
