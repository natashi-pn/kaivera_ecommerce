<?php
session_start();
require_once("dbconn.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $review_id = $_GET['id'];


    $sql = "delete from reviews where review_id = ?;";
    $stmt =   $conn->prepare($sql);
    $status = $stmt->execute([$review_id]);

    if ($status) {
        $_SESSION['success'] = "Deleted 1 Review Successfully";
        header("Location: ../user/profile.php?orders");
        die();
    } else {
        $_SESSION['error'] = "Error while deleting review";
        header("Location: ../user/profile.php?orders");
        die();
    }
} else {
    header('Location: ../user/profile.php?orders');
}
