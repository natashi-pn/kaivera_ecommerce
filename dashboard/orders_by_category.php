<?php
require_once("../controllers/dbconn.php");

try {
    $query = "
        SELECT 
            c.category_name,
            COUNT(*) AS total_orders
        FROM order_items oi
        JOIN products p ON oi.product_id = p.product_id
        JOIN categories c ON p.category_id = c.category_id
        GROUP BY c.category_name
    ";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $labels = [];
    $data = [];

    foreach ($results as $row) {
        $labels[] = ucfirst(trim($row['category_name']));
        $data[] = (int)$row['total_orders'];
    }

    echo json_encode(['labels' => $labels, 'data' => $data]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
