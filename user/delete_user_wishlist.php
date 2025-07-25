<?php
session_start();
require_once('../controllers/dbconn.php');
require_once('../includes/current_user_data.php');

$wishlist_id = $_GET['id'];

if (isset($wishlist_id)) {


    $stmt = $conn->prepare("SELECT * FROM wishlist WHERE wishlist_id = ? AND user_id = ?");
    $stmt->execute([$wishlist_id, $user_id]);

    if ($stmt->rowCount() === 0) {
        $_SESSION['error'] = 'Unauthorized access';
        header("Location: ../user/profile.php");
        exit;
    }

    $query = "delete from wishlist where wishlist_id = ?";
    $stmt = $conn->prepare($query);
    $status =  $stmt->execute([$wishlist_id]);


    if ($status) {
        $_SESSION['success'] = 'Deleted 1 Wishlist Successfully';
        header('Location: ../user/profile.php');
        die();
    } else {
        $_SESSION['error'] = 'Error while deleting user';
        header('Location: ../user/profile.php');
        die();
    }
} else {
    header('Location: ../user/profile.php');
}
