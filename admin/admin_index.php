<?php
    session_start();

    if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID']) || !isset($_SESSION['USER_TYPE']) || empty($_SESSION['USER_TYPE']) || $_SESSION['USER_TYPE'] != 1){
        header("Location: ../forms/login/login.php");
        exit();
    }

    require_once "../includes/assets.inc.php";
    require_once "../includes/header.inc.php";
    require_once "../includes/users_list.inc.php";

    $project_root = '/Projects/User_Registry';

    $flash_message = get_flash();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registry</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/user_registry_favicon.png"/>
    <link rel="stylesheet" href="../assets/css/header.css"/>
    <link rel="stylesheet" href="admin_index.css"/>
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
    <div class="users_table">
        <table style="border-radius: 10px; border:2px solid #3295a8;margin:auto">
            <thead style="color:#3295a8">
                <tr style="font-size: 16px;">
                    <th style="padding:20px 10px 10px 20px; text-align:center">S.No</th>
                    <th style="padding:20px 10px 10px 10px; text-align:center">Profile</th>
                    <th style="padding:20px 10px 10px 10px; text-align:center">Name</th>
                    <th style="padding:20px 10px 10px 10px; text-align:center">Email ID</th>
                    <th style="padding:20px 10px 10px 10px; text-align:center">Contact Number</th>
                    <th style="padding:20px 10px 10px 10px; text-align:center">Gender</th>
                    <th style="padding:20px 10px 10px 10px; text-align:center">Date of Birth</th>
                    <th style="padding:20px 10px 10px 10px; text-align:center">Country</th>
                    <th style="padding:20px 10px 10px 10px; text-align:center">State</th>
                    <th style="padding-right:20px;padding:20px 20px 10px 10px; text-align:center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users_list as $key => $user): ?>
                    <?php
                        $hased_user_id = base64_encode($user['user_id']);
                    ?>
                    <tr style="font-size: 14px;font-weight:500">
                        <td style="text-align:center;padding:10px">
                            <?php echo $key + 1; ?>
                        </td>
                        <td style="text-align:center;padding:10px">
                            <img style="width: 50px;height:50px;border-radius:50%" src="<?php 
                                echo (isset($user['profile_image']) && !empty($user['profile_image']))
                                ? ($project_root.'/'.$user['profile_path'].'/'.$user['profile_image']) 
                                : ($project_root.'/assets/images/no_profile_image.png');
                            ?>" alt="Profile Image">
                        </td>
                        <td style="text-align:center;padding:10px">
                            <?php echo htmlspecialchars($user['first_name'] .' '. $user['last_name']); ?>
                        </td>
                        <td style="text-align:center;padding:10px">
                            <?php echo htmlspecialchars($user['email_id']); ?>
                        </td>
                        <td style="text-align:center;padding:10px">
                            <?php echo htmlspecialchars($user['mobile_number']); ?>
                        </td>
                        <td style="text-align:center;padding:10px">
                            <?php echo htmlspecialchars($user['gender']); ?>
                        </td>
                        <td style="text-align:center;padding:10px">
                            <?php echo htmlspecialchars($user['date_of_birth']); ?>
                        </td>
                        <td style="text-align:center;padding:10px">
                            <?php echo htmlspecialchars($user['country_name']); ?>
                        </td>
                        <td style="text-align:center;padding:10px">
                            <?php echo htmlspecialchars($user['state_name']); ?>
                        </td>
                        <td style="text-align:center;padding:10px">
                            <a href="<?php echo $project_root ?>/admin/user_delete_action.php?uid=<?php echo urlencode($hased_user_id) ?>">
                                <img src="../assets/images/user_delete_icon.png" alt="Delete Icon">
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>