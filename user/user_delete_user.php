<?php
session_start();
require_once('../controllers/dbconn.php');

$user_id = $_GET['id'];

if (isset($user_id)) {

    $query = "delete from reviews where user_id = ?;";
    $stmt = $conn->prepare($query);
    $status =  $stmt->execute([$user_id]);

    $query2 = "delete from orders where user_id = ?;";
    $stmt = $conn->prepare($query2);
    $status =  $stmt->execute([$user_id]);

    $query3 = "delete from users where user_id = ?;";
    $stmt = $conn->prepare($query3);
    $status =  $stmt->execute([$user_id]);

    if ($status) {
        $_SESSION['success'] = 'Deleted 1 User Successfully';
        session_unset();
        session_destroy();
        header('Location: ../home.php');
        die();
    } else {
        $_SESSION['error'] = 'Error while deleting user';
        header('Location: ../user/profile.php');
        die();
    }
} else {
    header('Location: ../user/profile.php');
}
