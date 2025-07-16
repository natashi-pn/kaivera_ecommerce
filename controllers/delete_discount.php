<?php
session_start();
require_once("dbconn.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $discount_id = $_GET['id'];


    $sql = "delete from discounts where discount_id = ?;";
    $stmt =   $conn->prepare($sql);
    $status = $stmt->execute([$discount_id]);


    if ($status) {
        $_SESSION['success'] = "Deleted 1 Discount Successfully";
        header("Location: ../admin/admin.php?to=discounts");
        die();
    } else {
        $_SESSION['error'] = "Error while deleting discount";
        header("Location: ../admin/admin.php?to=discounts");
        die();
    }
} else {
    header('Location: ../admin/admin.php?to=discounts');
}
