
<?php
session_start();

require_once "../controllers/dbconn.php";
require_once "../controllers/functions.php";
$users = getUsers();


if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $filePath = null;
    $user_id = trim($_POST['update_user_id']);
    $user_name = trim($_POST['user_name']);
    $user_phone =  trim($_POST['user_phone']);
    $existing_image = $_POST['existing_image'] ?? null;


    $fields = [$user_name, $user_phone];
    foreach ($fields as $field) {
        if (empty($field)) {
            $_SESSION['error'] = 'All inputs are required!';
            header('Location: user_update_user.php');
            exit;
        }
    }

    foreach ($users as $user) {
        if ($user['user_name'] === $user_name && $user['user_id'] != $user_id) {
            $_SESSION['error'] = 'Username Exists';
            header('Location: user_update_user.php');

            exit;
        }
    }

    $newDirectory = "../uploads/profile_pictures/";
    $maxFileSize = 2 * 1024 * 1024;
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];


    if (isset($_FILES['user_profile_image']) && $_FILES['user_profile_image']['error'] === 0) {

        if ($_FILES['user_profile_image']['size'] > $maxFileSize) {
            $_SESSION['error'] = 'File size must not exceed 2MB!';
            header('Location: user_update_user.php');

            exit;
        }
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $_FILES['user_profile_image']['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedMimeTypes)) {
            $_SESSION['error'] = 'Only image files are allowed!';
            header('Location: user_update_user.php');
            exit;
        }


        $fileTempPath = $_FILES['user_profile_image']['tmp_name'];
        $fileName = basename($_FILES['user_profile_image']['name']);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $newFileName = uniqid('user_', true) . '.' . $fileExtension;
        $filePath = $newDirectory . $newFileName;

        if (!move_uploaded_file($fileTempPath, $filePath)) {
            die("Cant Upload File");
        };
    } else {
        $filePath = $existing_image;
    }

    $sql = "UPDATE users SET user_name=?,user_phone=?,user_profile_image=? WHERE user_id = ?;";


    $stmt =   $conn->prepare($sql);
    $status = $stmt->execute([$user_name, $user_phone, $filePath, $user_id]);


    if ($status) {
        $_SESSION['success'] = "User " . $user_name . " is updated successfully";
    } else {
        $_SESSION['error'] = "Couldn't Update " . $user_name;
    }

    header("Location: profile.php");
} else {
    header("Location: profile.php");
}
