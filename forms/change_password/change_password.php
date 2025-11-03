<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID']) || !isset($_SESSION['USER_TYPE']) || empty($_SESSION['USER_TYPE'])){
        header("Location: ../login/login.php");
        exit();
    }
    
    require_once "change_password_action.php";
    require_once "../../includes/header.inc.php";
    require_once __DIR__.'/../../bootstrap.php';
    
    $project_root = $_ENV['PROJECT_DIRECTORY'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Registry</title>
        <link rel="icon" type="image/x-icon" href="<?php $project_root?>/assets/images/user_registry_favicon.png"/>
        <link rel="stylesheet" href="../../assets/css/header.css"/>
        <link rel="stylesheet" href="change_password.css"/>
    </head>
    <body style="background-color: #F0F4F5;">
        <div class="change_password_container">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="line_01">
                    <div class="old_password_input">
                        <label for="old_password">Old Password</label>
                        <div class="password_cum_icon">
                            <input type="password" name="old_password" id="old_password" value="<?php if(isset($old_password) && !empty($old_password)) echo $old_password ?>"/>
                            <img id="old_password_eye_icon" src="../../assets/images/eye_closed.png" alt="">
                        </div>
                        <?php if(isset($old_password_error) && !empty($old_password_error)): ?>
                            <span class="error_message">
                                <?php echo $old_password_error ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="line_02">
                    <div class="new_password_input">
                        <label for="new_password">New Password</label>
                        <div class="password_cum_icon">
                            <input type="password" name="new_password" id="new_password" value="<?php if(isset($new_password) && !empty($new_password)) echo $new_password ?>"/>
                            <img id="new_password_eye_icon" src="../../assets/images/eye_closed.png" alt="">
                        </div>
                        <?php if(isset($new_password_error) && !empty($new_password_error)): ?>
                            <span class="error_message">
                                <?php echo $new_password_error ?>
                            </span>
                        <?php endif; ?> 
                    </div>
                </div>

                <div class="line_03">
                    <div class="confirm_new_password_input">
                        <label for="confirm_new_password">New Password</label>
                        <div class="password_cum_icon">
                            <input type="password" name="confirm_new_password" id="confirm_new_password" value="<?php if(isset($confirm_new_password) && !empty($confirm_new_password)) echo $confirm_new_password ?>"/>
                            <img id="confirm_new_password_eye_icon" src="../../assets/images/eye_closed.png" alt="">
                        </div>
                        <?php if(isset($confirm_new_password_error) && !empty($confirm_new_password_error)): ?>
                            <span class="error_message">
                                <?php echo $confirm_new_password_error ?>
                            </span>
                        <?php endif; ?> 
                    </div>
                </div>

                <div class="line_04">
                    <a href="<?php echo $project_root?>/users/users_profile.php">Cancel</a>
                    <input type="submit" value="Update"/>
                </div>
            </form>
        </div>
    </body>
</html>

<script src="../../assets/js/helpers.js"></script>
<script>
    const old_password = document.getElementById('old_password');
    const new_password = document.getElementById('new_password');
    const confirm_new_password = document.getElementById('confirm_new_password');
    const old_password_eye_icon = document.getElementById('old_password_eye_icon');
    const new_password_eye_icon = document.getElementById('new_password_eye_icon');
    const confirm_new_password_eye_icon = document.getElementById('confirm_new_password_eye_icon');

    sanitizePasswordFields(old_password);
    sanitizePasswordFields(new_password);
    sanitizePasswordFields(confirm_new_password);
    passwordEyeIcon(old_password, old_password_eye_icon);
    passwordEyeIcon(new_password, new_password_eye_icon);
    passwordEyeIcon(confirm_new_password, confirm_new_password_eye_icon);
</script>