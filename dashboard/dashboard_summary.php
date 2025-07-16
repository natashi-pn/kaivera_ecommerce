<?php
require_once("../controllers/dbconn.php");

header('Content-Type: application/json');

try {
    $stmt = $conn->query("SELECT COUNT(*) FROM users");
    $numCustomers = $stmt->fetchColumn();

    $stmt = $conn->query("SELECT COUNT(*) FROM orders");
    $numOrders = $stmt->fetchColumn();

    $stmt = $conn->query("SELECT COUNT(*) FROM reviews");
    $numReviews = $stmt->fetchColumn();

    $stmt = $conn->query("SELECT COUNT(*) FROM products");
    $numProducts = $stmt->fetchColumn();

    $stmt = $conn->query("SELECT COUNT(*) FROM discounts");
    $numDiscounts = $stmt->fetchColumn();

    $stmt = $conn->query("SELECT SUM(total_price) FROM orders");
    $totalSales = $stmt->fetchColumn();
    $formattedSales = '$' . number_format($totalSales ?: 0, 0, '.', ',');

    echo json_encode([
        'customers' => $numCustomers,
        'orders' => $numOrders,
        'reviews' => $numReviews,
        'products' => $numProducts,
        'discounts' => $numDiscounts,
        'sales' => $formattedSales
    ]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
