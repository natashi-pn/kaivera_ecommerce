
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

    $user_phone =  trim($_POST['user_phone']);
    $user_type =  trim($_POST['user_type']);



    $fields = [$user_name, $user_email, $user_phone, $user_type];
    foreach ($fields as $field) {
        if (empty($field)) {
            $_SESSION['error'] = 'All inputs are required';
            header('Location: ../admin/admin_update_user.php');
            exit;
        }
    }

    if (isset($_FILES['user_profile_image']) && $_FILES['user_profile_image']['error'] === 0) {


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
        $filePath = $existing_image;
    }

    $sql = "UPDATE users SET user_name=?,user_email=?,user_phone=?,user_type=?,user_profile_image=?
     WHERE user_id = ?;";


    $stmt =   $conn->prepare($sql);
    $status = $stmt->execute([$user_name, $user_email, $user_phone, $user_type, $filePath, $user_id]);


    if ($status) {
        $_SESSION['success'] = "User " . $user_name . " is updated successfully";
    } else {
        $_SESSION['error'] = "Couldn't Update " . $user_name;
    }

    header("Location: ../admin/admin.php?to=users");
} else {
    header("Location: ../admin/admin.php?to=users");
}
