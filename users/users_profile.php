<?php
    session_start();

    if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID']) || !isset($_SESSION['USER_TYPE']) || empty($_SESSION['USER_TYPE'])){
        header("Location: ../forms/login/login.php");
        exit();
    }

    require_once "../includes/header.inc.php";
    require_once "../includes/assets.inc.php";
    require_once "../includes/user_details.inc.php";

    $project_root = '/Projects/User_Registry';

    $user_type = $_SESSION['USER_TYPE'];

    $flash_message = get_flash();
?>

<?php if(isset($_SESSION['USER_ID']) && !empty($_SESSION['USER_ID'])):  ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Registry</title>
        <link rel="icon" type="image/x-icon" href="../assets/images/user_registry_favicon.png"/>
        <link rel="stylesheet" href="../assets/css/header.css"/>
        <link rel="stylesheet" href="../users/user_profile.css"/>
    </head>
    <body style="background-color: #F0F4F5;">
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

        <div class="user_profile_container">
            <div class="user_profile_box">
                <div class="user_profile_container_left">
                    <div class="details">
                        <label>Name</label>
                        <div>
                            <?php echo (isset($user_details['first_name']) && isset($user_details['last_name'])) ? ($user_details['first_name'] . ' ' . $user_details['last_name']) : '-' ?>
                        </div>
                    </div>
                    <div class="details">
                        <label>Email ID</label>
                        <div>
                            <?php echo isset($user_details['email_id']) ? $user_details['email_id'] : '-' ?>
                        </div>
                    </div>
                    <div class="details">
                        <label>Mobile Number</label>
                        <div>
                            <?php echo isset($user_details['mobile_number']) ? $user_details['mobile_number'] : '-' ?>
                        </div>
                    </div>
                    <div class="details">
                        <label>Gender</label>
                        <div>
                            <?php echo isset($user_details['gender']) ? $user_details['gender'] : '-' ?>
                        </div>
                    </div>
                    <div class="details">
                        <label>Date of Birth</label>
                        <div>
                            <?php echo isset($user_details['date_of_birth']) ? $user_details['date_of_birth'] : '-' ?>
                        </div>
                    </div>
                    <div class="details">
                        <label>Country</label>
                        <div>
                            <?php echo isset($user_details['country_name']) ? $user_details['country_name'] : '-'; ?>
                        </div>
                    </div>
                </div>

                <div class="user_profile_container_right">
                    <div class="profile_picture">
                        <img src="<?php echo (isset($user_details['profile_image']) && !empty(isset($user_details['profile_image']))) ? ($project_root . '/' . $user_details['profile_path'] . '/' . $user_details['profile_image']) : ($project_root .'/assets/images/no_profile_image.png') ?>" alt="No Image Found">
                    </div>
                    
                    <div class="details">
                        <label>State</label>
                        <div>
                            <?php echo isset($user_details['state_name']) ? $user_details['state_name'] : '-'; ?>
                        </div>
                    </div>
                    <div class="details">
                        <label>Address</label>
                        <div>
                            <?php echo isset($user_details['address']) ? $user_details['address'] : '-' ?>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="edit_profile">
                <?php if(isset($user_type) && $user_type == 1): ?>
                    <a class="back_to_profile" href="<?php echo $project_root ?>/admin/admin_index.php">
                        Back
                    </a>
                <?php endif; ?>
                <a class="move_to_edit" href="<?php echo $project_root ?>/edit_user/edit_user_profile.php">
                    Edit
                </a>
            </div>
        </div>
    </body>
    </html>
<?php endif; ?>
