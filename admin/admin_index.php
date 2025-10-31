<?php
    session_start();
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
    </head>
    <body style="background-color: #F0F4F5;">
        <?php 
            require_once "../includes/header.inc.php";
            require_once "../includes/assets.inc.php";

            $project_root = '/Projects/User_Registry';

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
    </body>
    </html>
<?php endif; ?>