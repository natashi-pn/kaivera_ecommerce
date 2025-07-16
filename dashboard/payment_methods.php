<?php
require_once("../controllers/dbconn.php");

try {
    $query = "
        SELECT 
            payment_method,
            COUNT(*) AS total_count
        FROM orders
        GROUP BY payment_method
    ";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $labels = [];
    $data = [];

    foreach ($results as $row) {
        $labels[] = ucfirst(trim($row['payment_method']));
        $data[] = (int)$row['total_count'];
    }

    echo json_encode(['labels' => $labels, 'data' => $data]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
