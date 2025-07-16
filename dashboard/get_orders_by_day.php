<?php

require_once "../controllers/dbconn.php";


$query = "SELECT DAYOFWEEK(order_date) AS day_number, COUNT(*) AS total_orders
    FROM orders
    WHERE order_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
    GROUP BY day_number";

$stmt = $conn->prepare($query);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


$ordersByDay = array_fill(0, 7, 0);
foreach ($results as $row) {
    $ordersByDay[$row['day_number'] - 1] = (int)$row['total_orders'];
}

echo json_encode($ordersByDay);
