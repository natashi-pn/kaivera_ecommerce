<?php
session_start();
require_once 'dbconn.php';
require_once 'functions.php';
$users = getUsers();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_email = $_POST['email'];
    $user_password = $_POST['password'];
    $found = false;

    foreach ($users as $user) {
        if ($user["user_email"] === $user_email && password_verify($user_password, $user["user_password"])) {
            $found = true;
            break;
        }
    }

    if ($found) {
        $_SESSION['login_success'] = "Login Successful";

        $userData = getUserType($user_email);

        $_SESSION['user_data'] = [
            'user_id' => $userData['user_id'],
            'user_name' => $userData['user_name'],
            'user_email' => $userData['user_email'],
            'user_phone' =>  $userData['user_phone'],
            'user_type' => $userData['user_type'],
            'user_profile_image' => $userData['user_profile_image']
        ];


        header('Location: ../home.php');
        exit;
    } else {
        $_SESSION['login_error'] = "Email/Password is incorrect";
        header('Location: ../signup.php?form=login');
        exit;
    }
} else {
    header('Location: ../signup.php?form=login');


    exit;
}
