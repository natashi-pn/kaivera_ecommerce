<?php
session_start();
require_once "dbconn.php";
require_once "functions.php";
$users = getUsers();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_name = trim($_POST['username']);
    $user_email = trim($_POST['email']);
    $user_phone = trim($_POST['phone']);
    $user_password = trim($_POST['password']);
    $repeat_password = trim($_POST['repeat_password']);



    if (empty($user_name) || empty($user_email) || empty($user_phone) || empty($user_password)) {
        $_SESSION["error"] = "All fields are required";
        header('Location: ../signup.php?form=signup');
        exit;
    }

    if ($user_password !== $repeat_password) {
        $_SESSION["error"] = "Passwords Mismatch.";
        header('Location: ../signup.php?form=signup');
        exit;
    }
    if (!validatePassword($user_password)) {
        $_SESSION["error"] = "Invalid Password";
        header('Location: ../signup.php?form=signup');
        exit;
    }


    foreach ($users as $user) {
        if ($user['user_name'] == $user_name || $user['user_email'] == $user_email) {
            $_SESSION["error"] = "Username or Email already exists.";
            header('Location: ../signup.php?form=signup');

            exit;
        }
    }


    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);



    $query = "Insert into users values (?,?,?,?,?,?,?,?);";
    $stmt = $conn->prepare(query: $query);
    $status =  $stmt->execute([null, $user_name, $user_email, $hashed_password, $user_phone, 'user', '../uploads/profile_pictures/default_pf.jpg', null]);

    if ($status) {
        $_SESSION["login_success"] = "Sign Up Successful! You May Login";
    } else {
        $_SESSION["error"] = "Error while sign up";
    }
    $stmt = null;
    $conn = null;
    header('Location: ../signup.php?form=login');

    exit;
} else {
    $_SESSION["error"] = "Invalid Request Method";
    header('Location: ../signup.php?form=signup');

    exit;
}
