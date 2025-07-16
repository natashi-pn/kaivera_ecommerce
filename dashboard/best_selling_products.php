<?php
require_once("../controllers/dbconn.php");

try {
    $query = "SELECT p.product_name, SUM(oi.quantity) AS total_sold
        FROM order_items oi
        JOIN products p ON oi.product_id = p.product_id
        GROUP BY p.product_name
        ORDER BY total_sold DESC
        LIMIT 10
    ";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $labels = [];
    $data = [];

    foreach ($results as $row) {
        $labels[] = $row['product_name'];
        $data[] = (int)$row['total_sold'];
    }

    echo json_encode(['labels' => $labels, 'data' => $data]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
