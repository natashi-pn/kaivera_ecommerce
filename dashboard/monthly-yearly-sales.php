<?php

require_once "../controllers/dbconn.php";


try {
    $monthlyStmt = $conn->prepare("
        SELECT DATE_FORMAT(order_date, '%b') as label, SUM(total_price) as total
        FROM orders
        WHERE YEAR(order_date) = YEAR(CURDATE())
        GROUP BY MONTH(order_date)
        ORDER BY MONTH(order_date)
    ");
    $monthlyStmt->execute();
    $monthlyData = $monthlyStmt->fetchAll(PDO::FETCH_KEY_PAIR);

    $yearlyStmt = $conn->prepare("
        SELECT YEAR(order_date) as label, SUM(total_price) as total
        FROM orders
        GROUP BY YEAR(order_date)
        ORDER BY YEAR(order_date)
        LIMIT 5
    ");
    $yearlyStmt->execute();
    $yearlyData = $yearlyStmt->fetchAll(PDO::FETCH_KEY_PAIR);

    echo json_encode([
        "monthly" => $monthlyData,
        "yearly" => $yearlyData
    ]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
