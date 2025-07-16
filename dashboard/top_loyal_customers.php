<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../controllers/dbconn.php");

try {
    $query = "SELECT 
            c.user_name,
            COUNT(o.order_id) AS total_orders
        FROM orders o
        JOIN users c ON o.user_id = c.user_id
        GROUP BY c.user_name
        ORDER BY total_orders DESC
        LIMIT 5";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $labels = [];
    $data = [];

    foreach ($results as $row) {
        $labels[] = $row['user_name'];
        $data[] = (int)$row['total_orders'];
    }

    echo json_encode(['labels' => $labels, 'data' => $data]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
