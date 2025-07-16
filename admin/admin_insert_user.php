<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Add New User</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="https://kit.fontawesome.com/69e1242b61.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="form_wrapper">
        <div class="heading">
            <h1>Add New User</h1>
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
        <form method="POST" action="../controllers/insert_user.php" enctype="multipart/form-data">
            <div class="input_field">
                <label for="name_input">UserName</label>
                <input type="text" name="user_name" id="name_input">
            </div>
            <div class="input_field">
                <label for="email_input">Email</label>
                <input type="email" name="user_email" id="email_input">
            </div>
            <div class="input_field">
                <label for="password_input">Password</label>
                <input type="password" name="user_password" id="password_input" step="any">
            </div>
            <div class="input_field">
                <label for="phone_input">Phone</label>
                <input type="number" name="user_phone" id="phone_input" step="any">
            </div>
            <div class="input_field">
                <label for="type_input">User Type</label>
                <select name="user_type" id="type_input">
                    <option value="user" selected>User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="input_field">
                <label for="image_input" class="file_label">Profile Image</label>
                <input type="file" name="user_profile_image" id="image_input">
            </div>

            <div class="input_btn">
                <button type="submit" class="green_btn">Insert</button>
                <button type="reset" class="red_btn">Reset</button>
                <a href="admin.php?to=users">Back</a>
            </div>
        </form>
    </div>

</body>

</html>