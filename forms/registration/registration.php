<?php require_once "registration_action.php" ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Registry</title>
        <link rel="icon" type="image/x-icon" href="../../assets/images/user_registry_favicon.png"/>
        <link rel="stylesheet" href="registration.css"/>
        <link rel="stylesheet" href="../../assets/css/header.css"/>
    </head>
    <body style="background-color: #F0F4F5;">
        <?php 
            require_once "../../includes/header.inc.php"; 
            require_once "../../includes/assets.inc.php";
            require_once "../../config/database_connection.inc.php";

            $project_root = '/Projects/User_Registry';
            
            $countries = fetch_countries($connection);

            $states = fetch_states($connection);

        ?>
        <div class="registration-container">
            <div class="registration-container-left">
                <img height="500px" class="registration_page_image" src="../../assets/images/registration_page_image_01.png"/>
            </div>
            <div class="registration-container-right">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="line_01">
                        <div class="first_name_input">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" value="<?php if(isset($first_name) && !empty($first_name)) echo $first_name ?>"/>
                            <?php if(isset($first_name_error) && !empty($first_name_error)): ?>
                                <span class="error_message">
                                    <?php echo $first_name_error ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="last_name_input">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="<?php if(isset($last_name) && !empty($last_name)) echo $last_name ?>"/>
                            <?php if(isset($last_name_error) && !empty($last_name_error)): ?>
                                <span class="error_message">
                                    <?php echo $last_name_error ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="line_02">
                        <div class="gender_input">
                            <label for="gender">Gender</label>
                            <div class="genders">
                                <div>
                                    <input type="radio" name="gender" value="Male" id="gender_male" <?php if(isset($gender) && !empty($gender) && $gender == "Male") echo "checked" ?>/>
                                    <label for="">Male</label>
                                </div>
                                <div>
                                    <input type="radio" name="gender" value="Female" id="gender_female" <?php if(isset($gender) && !empty($gender) && $gender == "Female") echo "checked" ?>>
                                    <label for="">Female</label>
                                </div>
                                <div>
                                    <input type="radio" name="gender" value="Others" id="gender_others" <?php if(isset($gender) && !empty($gender) && $gender == "Others") echo "checked" ?>>
                                    <label for="">Others</label>
                                </div>
                            </div>
                            <?php if(isset($gender_error) && !empty($gender_error)): ?>
                                <span class="error_message">
                                    <?php echo $gender_error ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="dob_input">
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" value="<?php if(isset($date_of_birth) && !empty($date_of_birth)) echo $date_of_birth; ?>">
                            <?php if(isset($date_of_birth_error) && !empty($date_of_birth_error)): ?>
                                <span class="error_message">
                                    <?php echo $date_of_birth_error ?>
                                </span>
                            <?php endif; ?>
                        </div>

                    </div>
                    <div class="line_03">
                        <div class="email_input">
                            <label for="email_id">Email ID</label>
                            <input type="text" name="email_id" id="email_id" value="<?php if(isset($email_id) && !empty($email_id)) echo $email_id ?>"/>
                            <?php if(isset($email_id_error) && !empty($email_id_error)): ?>
                                <span class="error_message">
                                    <?php echo $email_id_error ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="number_input">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number" value="<?php if(isset($contact_number) && !empty($contact_number)) echo $contact_number ?>"/>
                            <?php if(isset($contact_number_error) && !empty($contact_number_error)): ?>
                                <span class="error_message">
                                    <?php echo $contact_number_error ?>
                                </span>
                            <?php endif; ?>
                        </div>

                    </div>

                    <div class="line_04">
                        <div class="country_input">
                            <label for="country">Country</label>
                            <select name="country" id="country">
                                <option value="" disabled selected> 
                                    Select a Country
                                </option>
                                <?php if(!empty($countries)): ?>
                                    <?php foreach($countries as $individual_country): ?>
                                        <option value="<?php echo htmlspecialchars($individual_country['id']) ?>" <?php if(isset($country) && !empty($country) && $country == $individual_country['id']) echo "selected"; ?>>
                                            <?php echo htmlspecialchars($individual_country['country_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <?php if(isset($country_error) && !empty($country_error)): ?>
                                <span class="error_message">
                                    <?php echo $country_error ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="state_input">
                            <label for="state">State</label>
                            <select name="state" id="state">
                                <option value="" disabled selected>
                                    Select a State
                                </option>
                                <?php if(!empty($states)): ?>
                                    <?php foreach($states as $individual_state): ?>
                                        <option value="<?php echo htmlspecialchars($individual_state['id']); ?>" <?php if(isset($state) && !empty($state) && $state == $individual_state['id']) echo "selected"; ?>>
                                            <?php echo htmlspecialchars($individual_state['state_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <?php if(isset($state_error) && !empty($state_error)): ?>
                                <span class="error_message">
                                    <?php echo $state_error ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="address_input">
                        <label for="address">Address</label>
                        <textarea name="address" id="address">
                            <?php
                                if(isset($address) && !empty($address)){
                                    echo $address;
                                }
                            ?>
                        </textarea>
                        <?php if(isset($address_error) && !empty($address_error)): ?>
                            <span class="error_message">
                                <?php echo $address_error ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="profile_input">
                        <label for="profile_image">Profile Image</label>
                        <input type="file" name="profile_image" id="profile_image"/>
                        <?php if(isset($profile_image_error) && !empty($profile_image_error)): ?>
                            <span class="error_message">
                                <?php echo $profile_image_error ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="line_08">
                        <div class="password_input">
                            <label for="password">Password</label>
                            <div class="password_cum_icon">
                                <input type="password" name="password" id="password" value="<?php if(isset($password) && !empty($password)) echo $password ?>"/>
                                <img id="eye_icon" src="../../assets/images/eye_closed.png" alt="">
                            </div>
                            <?php if(isset($password_error) && !empty($password_error)): ?>
                                <span class="error_message">
                                    <?php echo $password_error ?>
                                </span>
                            <?php endif; ?> 
                        </div>

                        <div class="confirm_password_input">
                            <label for="confirm_password">Confirm Password</label>
                            <div class="password_cum_icon">
                                <input type="password" name="confirm_password" id="confirm_password" value="<?php if(isset($confirm_password) && !empty($confirm_password)) echo $confirm_password ?>"/>
                                <img id="confirm_eye_icon" src="../../assets/images/eye_closed.png" alt="">
                            </div>
                            <?php if(isset($confirm_password_error) && !empty($confirm_password_error)): ?>
                                <span class="error_message">
                                    <?php echo $confirm_password_error ?>
                                </span>
                            <?php endif; ?> 
                        </div>
                    </div>
                    
                    <div class="line_09">
                        <input type="submit" value="Register"/>
                        <div>
                            Already registered? <span><a href="<?php echo $project_root ?>/forms/login/login.php">Login</a></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

<script src="../../assets/js/helpers.js"></script>
<script>
    const firstName = document.getElementById('first_name');
    const lastName = document.getElementById('last_name');
    const emailId = document.getElementById('email_id');
    const mobile = document.getElementById('contact_number');
    const address = document.getElementById('address');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    const eye_icon = document.getElementById('eye_icon');
    const confirm_eye_icon = document.getElementById('confirm_eye_icon');

    sanitizeTextFields(firstName);
    sanitizeTextFields(lastName);
    sanitizeEmailFields(emailId);
    sanitizeNumberFields(mobile);
    sanitizeTextFields(address);
    sanitizePasswordFields(password);
    sanitizePasswordFields(confirmPassword);
    passwordEyeIcon(password, eye_icon);
    passwordEyeIcon(confirmPassword, confirm_eye_icon);
</script>