<?php require_once "login_action.php" ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Registry</title>
        <link rel="icon" type="image/x-icon" href="../../assets/images/user_registry_favicon.png"/>
        <link rel="stylesheet" href="registration.css"/>
        <link rel="stylesheet" href="../../assets/css/header.css"/>
        <link rel="stylesheet" href="login.css"/>
    </head>
    <body style="background-color: #F0F4F5;">
        <?php 
            require_once "../../includes/header.inc.php";
            require_once "../../includes/assets.inc.php";
            require_once __DIR__.'/../../bootstrap.php';

            $project_root = $_ENV['PROJECT_DIRECTORY'];

            $flash_message = get_flash();

        ?>
        <?php if($flash_message): ?>
            <div class="toast_message <?php $flash_message['type'] ?>">
                <?php htmlspecialchars($flash_message['message']) ?>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: '<?= $flash_message['type'] ?>',
                    title: '<?= ucfirst($flash_message['type']) ?>',
                    text: '<?= addslashes($flash_message['message']) ?>',
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
        <?php endif; ?>
        <div class="login-container">
            <div class="login-container-left">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="line_01">
                        <div class="email_input">
                            <label for="email_id">Email ID</label>
                            <input type="text" name="email_id" id="email_id" value="<?php if(isset($email_id) && !empty($email_id)) echo $email_id ?>"/>
                            <?php if(isset($email_id_error) && !empty($email_id_error)): ?>
                                <span class="error_message">
                                    <?php echo $email_id_error ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="line_02">
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
                    </div>
                    
                    <div class="line_03">
                        <input type="submit" value="Login"/>
                        <div>
                            Don't have an account? <span><a href="<?php echo $project_root; ?>/forms/registration/registration.php">Sign up</a></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="login-container-right">
                <img height="500px" class="registration_page_image" src="../../assets/images/registration_page_image_01.png"/>
            </div>
        </div>
    </body>
</html>

<script src="../../assets/js/helpers.js"></script>
<script>
    const email_id = document.getElementById('email_id');
    const password = document.getElementById('password');
    const eye_icon = document.getElementById('eye_icon');

    sanitizeEmailFields(email_id);
    sanitizePasswordFields(password);
    passwordEyeIcon(password, eye_icon);
</script>