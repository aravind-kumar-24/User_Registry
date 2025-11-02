
<?php

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    $file_name = $_SERVER['PHP_SELF'];

    $user_id = isset($_SESSION['USER_ID']) ? $_SESSION['USER_ID'] : null;
    $user_type = isset($_SESSION['USER_TYPE']) ? $_SESSION['USER_TYPE'] : null;

    require_once __DIR__.'/../bootstrap.php';

    $project_root = $_ENV['PROJECT_DIRECTORY'];

    $registration_page = false;
    $login_page = false;
    $auth_page = false;

    if(preg_match("/registration.php/i", $file_name)){
        $registration_page = true;
    }else if(preg_match("/login.php/i", $file_name)){
        $login_page = true;
    }else if(!preg_match("/registration.php/i", $file_name) || preg_match("/login.php/i", $file_name)){
        $auth_page = true;
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Registry</title>
        <link rel="icon" type="image/x-icon" href="../assets/images/user_registry_favicon.png"/>
    </head>
    <body>
        <nav class="navbar">
            <div class="app-name">
                User Registry
            </div>
            <div class="navbar-options-01">
                <div>
                    <a href="<?php echo $project_root ?>">Home</a>
                </div>
                <div>
                    <a href="#">About us</a>
                </div>
                <div>
                    <a href="#">Contacts</a>
                </div>
            </div>
            <div class="navbar-options-02">
                <?php if($registration_page): ?>
                    <div class="login_button_registration">
                        <a href="<?php echo $project_root ?>/forms/login/login.php">
                            Login
                        </a>
                    </div>
                <?php endif; ?>

                <?php if(!$registration_page && !$login_page && !isset($user_id)): ?>
                    <div class="login_button">
                        <a href="<?php echo $project_root ?>/forms/login/login.php">
                            Login
                        </a>
                    </div>
                    <div class="signup_button">
                        <a href="<?php echo $project_root ?>/forms/registration/registration.php">
                            Signup
                        </a>
                    </div>
                <?php endif; ?>
                
                <?php if($login_page): ?>
                    <div class="signup_button">
                        <a href="<?php echo $project_root ?>/forms/registration/registration.php">
                            Signup
                        </a>
                    </div>
                <?php endif; ?>

                <?php if(!$registration_page && !$login_page && $user_id): ?>
                    <div class="logout_button">
                        <a href="<?php echo $project_root ?>/forms/logout/logout_action.php">
                            Logout
                        </a>
                    </div>
                    <div class="profile_logo">
                        <a href="<?php echo $project_root?>/users/users_profile.php">
                            <img src="<?php echo $project_root?>/assets/images/profile_logo.png" alt="">
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </nav>
    </body>
</html>

