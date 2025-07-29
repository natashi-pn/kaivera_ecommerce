<?php
session_start();
require_once '../dbconn.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['search_username'])) {
    $searchUsername = trim($_POST['search_username']);

    if (empty($searchUsername)) {
        $_SESSION['error'] = "Please Enter Order ID";
        header("Location: ../../admin/admin.php?to=order_items");
        exit;
    }
    try {
        $query = "SELECT * FROM order_items WHERE order_id = ? ORDER BY order_id DESC";
        $stmt = $conn->prepare($query);

        $stmt->execute([$searchUsername]);

        $order_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($order_items)) {
            $_SESSION['error'] = "Order Items Not Found";
            header("Location: ../../admin/admin.php?to=order_items");
            exit;
        }
        $_SESSION['searched_order_items'] = $order_items;
        header("Location: ../../admin/admin.php?to=order_items");
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header("Location: ../../admin/admin.php?to=order_items");
    exit();
}
