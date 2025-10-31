
<?php
    $file_name = $_SERVER['PHP_SELF'];
    
    $project_root = '/Projects/User_Registry';

    $registration_page = false;
    $login_page = false;
    $index_page = false;

    if(preg_match("/registration.php/i", $file_name)){
        $registration_page = true;
    }else if(preg_match("/login.php/i", $file_name)){
        $login_page = true;
    }else if(preg_match("/users_profile.php/i", $file_name) || preg_match("/admin_index.php/i", $file_name)){
        $index_page = true;
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
                    Home
                </div>
                <div>
                    About us
                </div>
                <div>
                    Contacts
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

                <?php if(!$registration_page && !$login_page && !$index_page): ?>
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

                <?php if($index_page): ?>
                    <div class="logout_button">
                        <a href="#">
                            Logout
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </nav>
    </body>
</html>

