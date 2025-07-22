<?php
session_start();

require_once('../controllers/functions.php');
$user_id = $_GET['id'];
$user = getSearchUser($user_id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Update User</title>
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
        <form method="POST" action="update_user.php" enctype="multipart/form-data">
            <input type="hidden" name="update_user_id" id="id_input" value="<?php echo $user['user_id']; ?>">
            <div class="input_field">
                <label for="name_input">UserName</label>
                <input type="text" name="user_name" id="name_input" value="<?php echo $user['user_name'] ?>">
            </div>

            <div class="input_field">
                <label for="phone_input">Phone</label>
                <input type="number" name="user_phone" id="phone_input" step="any" value="<?php echo $user['user_phone'] ?>">
            </div>
            <div class="input_field">
                <label for="image_input" class="file_label">Profile Image</label>
                <input type="file" name="user_profile_image" id="image_input">
            </div>

            <div class="input_btn">
                <button type="submit" class="green_btn">Update</button>
                <a href="profile.php">Back</a>
            </div>
        </form>
    </div>

</body>

</html>