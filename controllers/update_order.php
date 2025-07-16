<?php
session_start();
require_once("dbconn.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $order_id = $_GET['id'];


    $sql = "UPDATE orders SET order_status = 'shipped' WHERE order_id = ? AND order_status = 'pending';";
    $stmt =   $conn->prepare($sql);
    $status = $stmt->execute([$order_id]);


    if ($status) {
        $_SESSION['success'] = "Delivered 1 Order Successfully";
        header("Location: ../admin/admin.php?to=orders");
        exit;
    } else {
        $_SESSION['error'] = "Error while delivering order";
        header("Location: ../admin/admin.php?to=orders");
        exit;
    }
} else {
    header('Location: ../admin/admin.php?to=orders');
}
