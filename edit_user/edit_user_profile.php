<?php
    session_start();

    if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID']) || !isset($_SESSION['USER_TYPE']) || empty($_SESSION['USER_TYPE'])){
        header("Location: ../forms/login/login.php");
        exit();
    }
    
    $project_root = '/Projects/User_Registry';

    require_once "edit_user_profile_action.php";
    require_once "../includes/header.inc.php";
    require_once "../includes/user_details.inc.php";
    require_once "../config/database_connection.inc.php";
    require_once "../includes/assets.inc.php";

    $user_details_against_user_id = $user_details;

    $first_name = $user_details_against_user_id['first_name'];
    $last_name = $user_details_against_user_id['last_name'];
    $email_id = $user_details_against_user_id['email_id'];
    $contact_number = $user_details_against_user_id['mobile_number'];
    $gender = $user_details_against_user_id['gender'];
    $date_of_birth = $user_details_against_user_id['date_of_birth'];
    $country = $user_details_against_user_id['country_id'];
    $state = $user_details_against_user_id['state_id'];
    $address = $user_details_against_user_id['address'];
    $countries = fetch_countries($connection) ?? [];
    $states = fetch_states($connection) ?? [];
    $profile_image = $user_details_against_user_id['profile_image'];
    $profile_path = $user_details_against_user_id['profile_path'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Registry</title>
        <link rel="icon" type="image/x-icon" href="../assets/images/user_registry_favicon.png"/>
        <link rel="stylesheet" href="../assets/css/header.css"/>
        <link rel="stylesheet" href="edit_user_profile.css"/>
    </head>
    <body style="background-color: #F0F4F5;">
        <div class="edit_profile_container">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="edit_profile_container_left">
                    <div class="first_name_input_edit">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" value="<?php echo isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : htmlspecialchars($first_name); ?>"/>
                        <?php if(isset($first_name_error) && !empty($first_name_error)): ?>
                            <span class="error_message">
                                <?php echo $first_name_error ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="last_name_input_edit">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : htmlspecialchars($last_name); ?>"/>
                        <?php if(isset($last_name_error) && !empty($last_name_error)): ?>
                            <span class="error_message">
                                <?php echo $last_name_error ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="gender_input_edit">
                        <label for="gender">Gender</label>
                        <div class="genders">
                            <div>
                                <input type="radio" name="gender" value="Male" id="gender_male" 
                                    <?php 
                                        if(isset($_POST['gender']) && !empty($_POST['gender']) && $_POST['gender'] == 'Male'){
                                            echo "checked";
                                        }else if(isset($gender) && !empty($gender) && $gender == 'Male'){
                                             echo "checked";
                                        }
                                    ?>
                                />
                                <label for="">Male</label>
                            </div>
                            <div>
                                <input type="radio" name="gender" value="Female" id="gender_female" 
                                    <?php 
                                        if(isset($_POST['gender']) && !empty($_POST['gender']) && $_POST['gender'] == 'Female'){
                                            echo "checked";
                                        }else if(isset($gender) && !empty($gender) && $gender == 'Female'){
                                             echo "checked";
                                        }
                                    ?>
                                />
                                <label for="">Female</label>
                            </div>
                            <div>
                                <input type="radio" name="gender" value="Others" id="gender_others" 
                                    <?php 
                                        if(isset($_POST['gender']) && !empty($_POST['gender']) && $_POST['gender'] == 'Others'){
                                            echo "checked";
                                        }else if(isset($gender) && !empty($gender) && $gender == 'Others'){
                                             echo "checked";
                                        }
                                    ?>
                                />
                                <label for="">Others</label>
                            </div>
                        </div>
                        <?php if(isset($gender_error) && !empty($gender_error)): ?>
                            <span class="error_message">
                                <?php echo $gender_error ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="dob_input_edit">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" 
                        value="<?php echo (isset($_POST['date_of_birth']) && !empty($_POST['date_of_birth'])) ? $_POST['date_of_birth'] : $date_of_birth ?>"
                        />
                        <?php if(isset($date_of_birth_error) && !empty($date_of_birth_error)): ?>
                            <span class="error_message">
                                <?php echo $date_of_birth_error ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="email_input_edit">
                        <label for="email_id">Email ID</label>
                        <input disabled type="text" name="email_id" id="email_id" value="<?php if(isset($email_id) && !empty($email_id)) echo $email_id ?>"/>
                    </div>
                </div>
                
                <div class="edit_profile_container_right">
                    
                    <div class="number_input_edit">
                        <label for="contact_number">Contact Number</label>
                        <input disabled type="text" name="contact_number" id="contact_number" value="<?php if(isset($contact_number) && !empty($contact_number)) echo $contact_number ?>"/>
                    </div>

                    <div class="country_input_edit">
                        <label for="country">Country</label>
                        <select name="country" id="country">
                            <option value="" disabled selected> 
                                Select a Country
                            </option>
                            <?php if(!empty($countries)): ?>
                                <?php foreach($countries as $individual_country): ?>
                                    <option value="<?php echo htmlspecialchars($individual_country['id']) ?>" 
                                    <?php echo (isset($_POST['country']) ? $_POST['country'] : $country) == $individual_country['id'] ? "selected" : ""; ?>>
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

                    <div class="state_input_edit">
                        <label for="state">State</label>
                        <select name="state" id="state">
                            <option value="" disabled selected>
                                Select a State
                            </option>
                            <?php if(!empty($states)): ?>
                                <?php foreach($states as $individual_state): ?>
                                    <option value="<?php echo htmlspecialchars($individual_state['id']); ?>" 
                                    <?php echo (isset($_POST['state']) ? $_POST['state'] : $state) == $individual_state['id'] ? "selected" : ""; ?>>
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

                    <div class="address_input_edit">
                        <label for="address">Address</label>
                        <textarea name="address" id="address">
                            <?php
                                echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : htmlspecialchars($address);
                            ?>
                        </textarea>
                        <?php if(isset($address_error) && !empty($address_error)): ?>
                            <span class="error_message">
                                <?php echo $address_error ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="profile_input_edit">
                        <div class="profile_input_edit_left">
                            <label for="profile_image">Profile Image</label>
                            <input type="file" name="profile_image" id="profile_image"/>
                            <?php if(isset($profile_image_error) && !empty($profile_image_error)): ?>
                                <span class="error_message">
                                    <?php echo $profile_image_error ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="profile_picture">
                            <img src="<?php echo (isset($profile_image) && !empty($profile_image)) ? ($project_root . '/' . $profile_path . '/' . $profile_image) : ($project_root .'/assets/images/no_profile_image.png') ?>" alt="No Image Found">
                        </div>
                    </div>
                    <div class="update_button">
                        <a href="<?php echo $project_root?>/users/users_profile.php">Back</a>
                        <input type="submit" value="Update">
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>

<script src="../assets/js/helpers.js"></script>
<script>
    const firstName = document.getElementById('first_name');
    const lastName = document.getElementById('last_name');
    const emailId = document.getElementById('email_id');
    const mobile = document.getElementById('contact_number');
    const address = document.getElementById('address');

    sanitizeTextFields(firstName);
    sanitizeTextFields(lastName);
    sanitizeEmailFields(emailId);
    sanitizeNumberFields(mobile);
    sanitizeTextFields(address);
    
</script>