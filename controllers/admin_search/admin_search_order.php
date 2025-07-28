<?php
session_start();
require_once '../dbconn.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['search_username'])) {
    $searchUsername = trim($_POST['search_username']);

    if (empty($searchUsername)) {
        $_SESSION['error'] = "Please Enter Username";
        header("Location: ../../admin/admin.php?to=orders");
        exit;
    }
    try {
        $stmt = $conn->prepare("SELECT o.*, u.user_name, d.discount_percent 
            FROM orders o
            JOIN users u ON o.user_id = u.user_id
            LEFT JOIN discounts d ON o.discount_id = d.discount_id
            WHERE u.user_name LIKE :username
        ");

        $stmt->execute([
            ':username' => "%$searchUsername%"
        ]);

        $orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($orderDetails)) {
            $_SESSION['error'] = "Order Not Found";
            header("Location: ../../admin/admin.php?to=orders");
            exit;
        }
        $_SESSION['searched_orders'] = $orderDetails;

        header("Location: ../../admin/admin.php?to=orders");
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header("Location: ../../admin/admin.php?to=orders");
    exit();
}
