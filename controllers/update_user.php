
<?php
session_start();

require_once "dbconn.php";
require_once "functions.php";
$users = getUsers();


if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $filePath = null;

    if (isset($_POST['existing_image'])) {
        $existing_image = $_POST['existing_image'];
    }


    $user_id = trim($_POST['update_user_id']);
    $user_name = trim($_POST['user_name']);
    $user_email = trim($_POST['user_email']);
    $user_password = $_POST["user_password"] ?? null;
    $user_phone =  trim($_POST['user_phone']);
    $user_type =  trim($_POST['user_type']);



    $fields = [$user_name, $user_email, $user_phone, $user_type];
    foreach ($fields as $field) {
        if (empty($field)) {
            $_SESSION['error'] = 'All inputs are required';
            header('Location: ../admin/admin_update_user.php?id=' . $user_id);
            exit;
        }
    }

    foreach ($users as $user) {
        if (($user['user_name'] == $user_name || $user['user_email'] == $user_email) && $user['user_id'] != $user_id) {
            $_SESSION["error"] = "Username or Email already exists.";
            header('Location: ../admin/admin_update_user.php?id=' . $user_id);
            exit;
        }
    }
    if ($user_password) {
        if (!validatePassword($user_password)) {
            $_SESSION['error'] = 'Invalid Password';
            header('Location: ../admin/admin_update_user.php?id=' . $user_id);
            exit;
        }

        $final_password = password_hash($user_password, PASSWORD_DEFAULT);
    } else {
        $query = "SELECT user_password FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$user_id]);

        $final_password = $stmt->fetchColumn();
    }





    $maxFileSize = 2 * 1024 * 1024;
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    if (isset($_FILES['user_profile_image']) && $_FILES['user_profile_image']['error'] === 0) {

        if ($_FILES['user_profile_image']['size'] > $maxFileSize) {
            $_SESSION['error'] = 'File size must not exceed 2MB!';
            header('Location: ../admin/admin_update_user.php?id=' . $user_id);

            exit;
        }
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $_FILES['user_profile_image']['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedMimeTypes)) {
            $_SESSION['error'] = 'Only image files are allowed!';
            header('Location: ../admin/admin_update_user.php?id=' . $user_id);

            exit;
        }


        $fileTempPath = $_FILES['user_profile_image']['tmp_name'];
        $fileName = basename($_FILES['user_profile_image']['name']);

        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $newFileName = uniqid('user_', true) . '.' . $fileExtension;


        $newDirectory = "../uploads/profile_pictures/";
        $filePath = $newDirectory . $newFileName;

        if (!move_uploaded_file($fileTempPath, $filePath)) {
            $_SESSION['error'] = 'Cant Upload File';
            header('Location: ../admin/admin_update_user.php?id=' . $user_id);
            exit;
        };

        $defaultImagePath = '../uploads/profile_pictures/default_pf.jpg';
        if ($existing_image  && file_exists($existing_image) && $existing_image !== $filePath && $existing_image !== $defaultImagePath) {
            unlink($existing_image);
        }
    } else {
        $filePath = $existing_image;
    }

    $sql = "UPDATE users SET user_name=?,user_email=?,user_password = ?,user_phone=?,user_type=?,user_profile_image=?
     WHERE user_id = ?;";


    $stmt =   $conn->prepare($sql);
    $status = $stmt->execute([$user_name, $user_email, $final_password, $user_phone, $user_type, $filePath, $user_id]);


    if ($status) {
        $_SESSION['success'] = "User " . $user_name . " is updated successfully";
    } else {
        $_SESSION['error'] = "Couldn't Update " . $user_name;
    }

    header("Location: ../admin/admin.php?to=users");
} else {
    header("Location: ../admin/admin.php?to=users");
}
