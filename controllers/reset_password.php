<?php
session_start();
require_once 'dbconn.php';
require_once 'functions.php';
$users = getUsers();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_phone = $_POST['user_phone'];
    $user_password = $_POST['new_password'];
    $found = false;

    if (empty($user_name) || empty($user_email) || empty($user_phone) || empty($user_password)) {
        $_SESSION['error'] = "All Fields Are Required";
        header('Location: ../user/reset_password.php');
        exit;
    }
    if (!validatePassword($user_password)) {
        $_SESSION["error"] = "At least 8 Characters, A Capital and A Number";
        header('Location: ../user/reset_password.php');
        exit;
    }

    foreach ($users as $user) {
        if ($user["user_email"] === $user_email && $user['user_name'] === $user_name && $user['user_phone'] === $user_phone) {
            $found = true;
            break;
        }
    }

    if ($found) {
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

        $query = "update users set user_password = ? where user_name = ? AND user_email = ?;";
        $stmt = $conn->prepare($query);
        $stmt->execute([$hashed_password, $user_name, $user_email]);

        $_SESSION['login_success'] = "Password has been reset";
        header('Location: ../signup.php?form=login');
        exit;
    } else {
        $_SESSION['error'] = "Something is Incorrect :C";
        header('Location: ../user/reset_password.php');
        exit;
    }
} else {
    header('Location: ../user/reset_password.php');


    exit;
}
