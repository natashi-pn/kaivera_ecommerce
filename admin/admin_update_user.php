<?php
session_start();

require_once('../controllers/functions.php');
require_once("../includes/current_user_data.php");


$user_id = $_GET['id'];
$user = getSearchUser($user_id);


if (!isset($user_type) || $user_type != 'admin') {
    header("Location: ../home.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Update User</title>
    <link rel="icon" href="../assets/images/kaivera logo icon.png" type="image/png">

    <link rel="stylesheet" href="../css/admin.css">
    <script src="https://kit.fontawesome.com/69e1242b61.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="form_wrapper">
        <div class="heading">
            <h1>Update User</h1>
            <?php
            if (isset($_SESSION['success'])) {
                echo "<p style='color: #9fc9b7;'>{$_SESSION['success']}</p>";
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['error'])) {
                echo "<p style='color: rgb(214, 102, 102);'>{$_SESSION['error']}</p>";
                unset($_SESSION['error']);
            }

            ?>
        </div>
        <form method="POST" action="../controllers/update_user.php" enctype="multipart/form-data">
            <input type="hidden" name="update_user_id" id="id_input" value="<?php echo $user['user_id']; ?>">
            <input type="hidden" name="existing_image" id="id_input" value="<?php echo $user['user_profile_image']; ?>">
            <div class="input_field">

                <input type="text" name="user_name" id="name_input" value="<?php echo $user['user_name'] ?>" placeholder="Username">
            </div>
            <div class="input_field">

                <input type="email" name="user_email" id="email_input" value="<?php echo $user['user_email'] ?>" placeholder="Email">
            </div>
            <div class="input_field">
                <input type="password" name="user_password" id="password_input" placeholder="Password">
            </div>
            <div class="input_field">

                <input type="number" name="user_phone" id="phone_input" step="any" value="<?php echo $user['user_phone'] ?>" placeholder="Phone">
            </div>
            <div class="input_field">

                <select name="user_type" id="type_input">

                    <?php

                    $type_user = '';
                    $type_admin = '';
                    if ($user['user_type'] == 'user') {
                        $type_user = 'selected';
                    }
                    if ($user['user_type'] == 'admin') {
                        $type_admin = 'selected';
                    }

                    ?>

                    <option value="user" <?php echo $type_user ?>>User</option>
                    <option value="admin" <?php echo $type_admin ?>>Admin</option>
                </select>
            </div>
            <div class="input_field">
                <label for="image_input" class="file_label">Profile Image</label>
                <input type="file" name="user_profile_image" id="image_input">
            </div>

            <div class="input_btn">
                <button type="submit" class="green_btn">Update</button>
                <a href="admin.php?to=users">Back</a>
            </div>
        </form>
    </div>

</body>

</html>