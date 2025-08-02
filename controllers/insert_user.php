
<?php
session_start();

require_once "../controllers/dbconn.php";
require_once "functions.php";
$users = getUsers();

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $filePath = null;
    $user_name = trim($_POST['user_name']);
    $user_email = trim($_POST['user_email']);
    $user_password = trim($_POST['user_password']);
    $user_phone =  trim($_POST['user_phone']);
    $user_type =  trim($_POST['user_type']);

    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);


    $fields = [$user_name, $user_email, $user_password, $user_phone, $user_type];
    foreach ($fields as $field) {
        if (empty($field)) {
            $_SESSION['error'] = 'All inputs are required';
            header('Location: ../admin/admin_insert_user.php');
            exit;
        }
    }

    if (!validatePassword($user_password)) {
        $_SESSION["error"] = "Invalid Password";
        header('Location: ../admin/admin_insert_user.php');
        exit;
    }


    $maxFileSize = 2 * 1024 * 1024;
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    if (isset($_FILES['user_profile_image']) && $_FILES['user_profile_image']['error'] === 0) {

        // First check the valid size and type

        if ($_FILES['user_profile_image']['size'] > $maxFileSize) {
            $_SESSION['error'] = 'File size must not exceed 2MB';
            header('Location: ../admin/admin_insert_user.php');
            exit;
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $_FILES['user_profile_image']['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedMimeTypes)) {
            $_SESSION['error'] = 'Only image files (JPG, PNG, GIF, WEBP) are allowed';
            header('Location: ../admin/admin_insert_user.php');
            exit;
        }

        $fileTempPath = $_FILES['user_profile_image']['tmp_name'];
        $fileName = basename($_FILES['user_profile_image']['name']);

        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $newFileName = uniqid('user_', true) . '.' . $fileExtension;


        $newDirectory = "../uploads/profile_pictures/";
        $filePath = $newDirectory . $newFileName;

        if (!move_uploaded_file($fileTempPath, $filePath)) {
            die("Cant Upload File");
        };
    } else {
        $filePath = "../uploads/profile_pictures/default_pf.jpg";
    }

    foreach ($users as $user) {
        if ($user['user_name'] == $user_name || $user['user_email'] == $user_email) {
            $_SESSION['error'] = 'Username/Email Already Exists';
            header('Location: ../admin/admin_insert_user.php');
            exit;
        }
    }


    $sql = "insert into users values (?, ?, ?, ?, ?, ?,?,?)";
    $stmt =   $conn->prepare($sql);
    $status = $stmt->execute([null, $user_name, $user_email, $hashed_password, $user_phone, $user_type, $filePath, null]);


    if ($status) {
        $_SESSION['success'] = "New User Is Added";
    } else {
        $_SESSION['error'] = "Cant Add New User";
    }
    header("Location: ../admin/admin.php?to=users");
} else {
    header("Location: ../admin/admin.php?to=users");
}
