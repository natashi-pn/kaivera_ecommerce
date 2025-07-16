<?php
session_start();
require_once("dbconn.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $order_id = $_GET['id'];


    $sql = "delete from order_items where order_id = ?;";
    $stmt =   $conn->prepare($sql);
    $status = $stmt->execute([$order_id]);

    $query = "delete from orders where order_id = ?;";
    $stmt = $conn->prepare(($query));
    $status = $stmt->execute(([$order_id]));

    if ($status) {
        $_SESSION['success'] = "Removed 1 Order Successfully";
        header("Location: ../user/profile.php?to=orders");
        die();
    } else {
        $_SESSION['error'] = "Error while deleting order";
        header("Location: ../user/profile.php?to=orders");
        die();
    }
} else {
    header('Location: ../user/profile.php?to=orders');
}
