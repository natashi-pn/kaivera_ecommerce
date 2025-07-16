<?php
session_start();
require_once('../controllers/dbconn.php');

$wishlist_id = $_GET['id'];

if (isset($wishlist_id)) {

    $query = "delete from wishlist where wishlist_id = ?;";
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
