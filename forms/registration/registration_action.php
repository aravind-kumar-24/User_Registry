<?php
    require_once "../../includes/form_input_handling.php";

    $request_method = $_SERVER['REQUEST_METHOD'];

    if($request_method == 'POST'){

        # Input Variables
        $first_name = $last_name = $gender = $date_of_birth = $email_id = $contact_number = $country = $state = $address = $password = $confirm_password = $profile_image = "";

        # Error Variables
        $first_name_error = $last_name_error = $gender_error = $date_of_birth_error = $email_id_error = $contact_number_error = $country_error = $state_error = $address_error = $password_error = $confirm_password_error = $profile_image_error = "";

        if(empty($_POST['first_name'])){
            $first_name_error = "First Name is required";
        }else{
            $first_name = process_input_data($_POST['first_name']);
        }

        if(empty($_POST['last_name'])){
            $last_name_error = "Last Name is required";
        }else{
            $last_name = process_input_data($_POST['last_name']);
        }

        if(empty($_POST['gender'])){
            $gender_error = "Gender is required";
        }else{
            $gender = process_input_data($_POST['gender']);
        }

        if(empty($_POST['date_of_birth'])){
            $date_of_birth_error = "Date of Birth is required";
        }else{
            $date_of_birth = process_input_data($_POST['date_of_birth']);
        }

        if(empty($_POST['email_id'])){
            $email_id_error = "Email ID is required";
        }else{
            $email_id = process_input_data($_POST['email_id']);

            if(!filter_var($email_id, FILTER_VALIDATE_EMAIL)){
                $email_id_error = "Invalid Email Format.";
            }
        }

        if(empty($_POST['contact_number'])){
            $contact_number_error = "Contact Number is required";
        }else{
            $contact_number = process_input_data($_POST['contact_number']);
        }

        if(empty($_POST['country'])){
            $country_error = "Country is required";
        }else{
            $country = process_input_data($_POST['country']);
        }

        if(empty($_POST['state'])){
            $state_error = "State is required";
        }else{
            $state = process_input_data($_POST['state']);
        }

        if(empty($_POST['address'])){
            $address_error = "Address is required";
        }else{
            $address = process_input_data($_POST['address']);
        }

        if(empty($_POST['password'])){
            $password_error = "Password is required";
        }else{
            $password = process_input_data($_POST['password']);

            if(!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{5,20}$/", $password)){
                $password_error = "Invalid Password format.";
            }
        }

        if(empty($_POST['confirm_password'])){
            $confirm_password_error = "Confirm Password is required";
        }else{
            $confirm_password = process_input_data($_POST['confirm_password']);

            if(!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{5,20}$/", $confirm_password)){
                $confirm_password_error = "Invalid Password format.";
            }

            if($password != $confirm_password){
                $confirm_password_error = "Password doesn't match.";
            }
        }

        if(empty($_FILES['profile_image']['name'])){
            $profile_image_error = "Profile Image is required";
        }else{
            $profile_image = $_FILES['profile_image']['name'];

            $directory = "uploads/profile_images";

            $file_structure = $directory.'/'.basename($profile_image);

            $file_type = strtolower(pathinfo($profile_image, PATHINFO_EXTENSION));

            $file_size = (int) $_FILES['profile_image']['size'];

            $allowed_extensions = ['jpeg', 'jpg', 'png'];

            $file_size_in_mb = $file_size / (1024 * 1024);


            if($file_size_in_mb > 5){
                $profile_image_error = "Maximum File size must be 5 mb.";
            }

            if(!in_array($file_type, $allowed_extensions)){
                $profile_image_error = "Invalid File type.";
            }
        }

    }
?>
