<?php
session_start();
require_once('../controllers/functions.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Reset Password</title>
    <link rel="icon" href="../assets/images/kaivera logo icon.png" type="image/png">

    <link rel="stylesheet" href="../css/admin.css">
    <script src="https://kit.fontawesome.com/69e1242b61.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="notification">
        <?php
        if (isset($_SESSION['success'])) {
            echo "<p class='success_msg'><i class='fa-solid fa-circle-check'></i>{$_SESSION['success']}</p>";
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo "<p class= 'error_msg'><i class='fa-solid fa-circle-exclamation'></i>{$_SESSION['error']}</p>";
            unset($_SESSION['error']);
        }
        ?>
    </div>
    <div class="form_wrapper">
        <div class="heading">
            <h1>Reset Password</h1>
            <p>Let's Find Your Account!</p>

        </div>
        <form method="POST" action="../controllers/reset_password.php">

            <div class="input_field">
                <input type="text" name="user_name" id="name_input" value="" placeholder="Username">
            </div>
            <div class="input_field">
                <input type="email" name="user_email" id="email_input" value="" placeholder="Email">
            </div>
            <div class="input_field">
                <input type="number" name="user_phone" id="phone_input" step="any" value="" placeholder="Phone">
            </div>
            <div class="input_field">
                <input type="password" name="new_password" id="password_input" step="any" value="" placeholder="New Password">
            </div>
            <div class="input_btn">
                <button type="submit" class="green_btn">Reset</button>
                <a href="../signup.php?form=login">Back</a>
            </div>
        </form>
    </div>

</body>

</html>