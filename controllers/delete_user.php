<?php
session_start();
require_once('dbconn.php');

$user_id = $_GET['id'];

if (isset($user_id)) {

    $query = "delete from users where user_id = ?;";
    $stmt = $conn->prepare($query);

    $status =  $stmt->execute([$user_id]);

    if ($status) {
        $_SESSION['success'] = 'Deleted 1 User Successfully';
        header('Location: ../admin/admin.php?to=users');
        die();
    } else {
        $_SESSION['error'] = 'Error while deleting user';
        header('Location: ../admin/admin.php?to=users');
        die();
    }
} else {
    header('Location: ../admin/admin.php?to=users');
}
