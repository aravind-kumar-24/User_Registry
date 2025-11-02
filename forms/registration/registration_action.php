<?php
    require_once "../../includes/form_input_handling.php";
    require_once "../../config/database_connection.inc.php";
    require_once "../../includes/assets.inc.php";

    $request_method = $_SERVER['REQUEST_METHOD'];

    if($request_method == 'POST'){

        $first_name = $last_name = $gender = $date_of_birth = $email_id = $contact_number = $country = $state = $address = $password = $confirm_password = $profile_image = "";

        $first_name_error = $last_name_error = $gender_error = $date_of_birth_error = $email_id_error = $contact_number_error = $country_error = $state_error = $address_error = $password_error = $confirm_password_error = $profile_image_error = "";

        $proceed_submission = true;

        if(empty($_POST['first_name'])){
            $first_name_error = "First Name is required";
            $proceed_submission = false;
        }else{
            $first_name = process_input_data($_POST['first_name']);
        }

        if(empty($_POST['last_name'])){
            $last_name_error = "Last Name is required";
            $proceed_submission = false;
        }else{
            $last_name = process_input_data($_POST['last_name']);
        }

        if(empty($_POST['gender'])){
            $gender_error = "Gender is required";
            $proceed_submission = false;
        }else{
            $gender = process_input_data($_POST['gender']);
        }

        if(empty($_POST['date_of_birth'])){
            $date_of_birth_error = "Date of Birth is required";
            $proceed_submission = false;
        }else{
            $date_of_birth = process_input_data($_POST['date_of_birth']);
        }

        if(empty($_POST['email_id'])){
            $email_id_error = "Email ID is required";
            $proceed_submission = false;
        }else{
            $email_id = process_input_data($_POST['email_id']);

            if(!filter_var($email_id, FILTER_VALIDATE_EMAIL)){
                $email_id_error = "Invalid Email Format.";
                $proceed_submission = false;
            }

            try{

                $results = email_id_existing_check($connection, $email_id);
                
                if(!empty($results)){
                    $email_id_error = "Email ID already exists";
                    $proceed_submission = false;
                }

            }catch(PDOException $error){
                log_database_error($error);
                $proceed_submission = false;
            }

        }

        if(empty($_POST['contact_number'])){
            $contact_number_error = "Contact Number is required";
            $proceed_submission = false;
        }else{
            $contact_number = process_input_data($_POST['contact_number']);

            if(!preg_match("/^[0-9]{10}$/", $contact_number)){
                $contact_number_error = "Contact number must be 10 digits.";
                $proceed_submission = false;
            }

            try{

                $results = mobile_existing_check($connection, $contact_number);
                
                if(!empty($results)){
                    $contact_number_error = "Mobile Number already exists";
                    $proceed_submission = false;
                }

            }catch(PDOException $error){
                log_database_error($error);
                $proceed_submission = false;
            }
        }

        if(empty($_POST['country'])){
            $country_error = "Country is required";
            $proceed_submission = false;
        }else{
            $country = process_input_data($_POST['country']);
        }

        if(empty($_POST['state'])){
            $state_error = "State is required";
            $proceed_submission = false;
        }else{
            $state = process_input_data($_POST['state']);
        }

        if(empty($_POST['address'])){
            $address_error = "Address is required";
            $proceed_submission = false;
        }else{
            $address = process_input_data($_POST['address']);
        }

        if(empty($_POST['password'])){
            $password_error = "Password is required";
            $proceed_submission = false;
        }else{
            $password = process_input_data($_POST['password']);

            if(!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{5,20}$/", $password)){
                $password_error = "Invalid Password format.";
                $proceed_submission = false;
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        }

        if(empty($_POST['confirm_password'])){
            $confirm_password_error = "Confirm Password is required";
            $proceed_submission = false;
        }else{
            $confirm_password = process_input_data($_POST['confirm_password']);

            if(!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{5,20}$/", $confirm_password)){
                $confirm_password_error = "Invalid Password format.";
                $proceed_submission = false;
            }

            if($password != $confirm_password){
                $confirm_password_error = "Password doesn't match.";
                $proceed_submission = false;
            }
        }

        if(empty($_FILES['profile_image']['name'])){
            $profile_image_error = "Profile Image is required";
            $proceed_submission = false;
        }else{
            $profile_image = $_FILES['profile_image']['name'];

            $directory = "uploads/profile_images";

            $directory_structure = "../../uploads/profile_images";

            $file_type = strtolower(pathinfo($profile_image, PATHINFO_EXTENSION));

            $file_size = (int) $_FILES['profile_image']['size'];

            $allowed_extensions = ['jpeg', 'jpg', 'png'];

            $file_size_in_mb = $file_size / (1024 * 1024);


            if($file_size_in_mb > 5){
                $profile_image_error = "Maximum File size must be 5 mb.";
                $proceed_submission = false;
            }

            if(!in_array($file_type, $allowed_extensions)){
                $profile_image_error = "Invalid File type.";
                $proceed_submission = false;
            }

        }

        if($proceed_submission){
            try{

                $user_id = substr(time() . mt_rand(1000, 9999), 0, 10);

                $user_type = 2;

                $unique_file_name = $user_id . '_profile.' . time() . '.' . $file_type;

                $file_structure = $directory_structure.'/'.$unique_file_name;

                $data_insertion_query = "
                    INSERT INTO users (user_id, first_name, last_name, email_id, mobile_number, password, user_type, gender, date_of_birth, country_id, state_id, address, profile_path, profile_image)
                    VALUES(:user_id, :first_name, :last_name, :email_id, :mobile_number, :password, :user_type, :gender, :date_of_birth, :country_id, :state_id, :address, :profile_path, :profile_image);
                ";
    
                $statement = $connection->prepare($data_insertion_query);

                $statement->bindParam(":user_id", $user_id);
                $statement->bindParam(":first_name", $first_name);
                $statement->bindParam(":last_name", $last_name);
                $statement->bindParam(":email_id", $email_id);
                $statement->bindParam(":mobile_number", $contact_number);
                $statement->bindParam(":password", $hashed_password);
                $statement->bindParam(":user_type", $user_type);
                $statement->bindParam(":gender", $gender);
                $statement->bindParam(":date_of_birth", $date_of_birth);
                $statement->bindParam(":country_id", $country);
                $statement->bindParam(":state_id", $state);
                $statement->bindParam(":address", $address);
                $statement->bindParam(":profile_path", $directory);
                $statement->bindParam(":profile_image", $unique_file_name);
    
                $statement->execute();

                move_uploaded_file($_FILES['profile_image']['tmp_name'], $file_structure);
    
                $connection = null;
    
                $statement = null;

                set_flash('success', 'Registration successful! Please Log in.');
                header("Location: ../login/login.php");
                exit();
            }catch(PDOException $error){
                log_database_error($error);
                set_flash('error', 'Registration failed! Please try again.');
                header("Location: registration.php");
                exit();
            }
        }
    }
?>
