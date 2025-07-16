<?php
session_start();
require_once 'dbconn.php';

$user_id = $_POST['user_id'] ?? null;
$product_id = $_POST['product_id'] ?? null;
$action = $_POST['action'] ?? 'add';

if (!$user_id || !$product_id) {
    http_response_code(400);
    echo "<p class='error_msg'><i class='fa-solid fa-circle-exclamation'></i>Missing Data</p>";

    exit();
}

if ($action === 'add') {
    $stmt = $conn->prepare("INSERT IGNORE INTO wishlist (user_id, product_id) VALUES (?, ?)");
    if ($stmt->execute([$user_id, $product_id])) {
        echo "<p class='success_msg'><i class='fa-solid fa-circle-check'></i>Added To Wishlist !</p>";
    } else {
        echo "<p class='error_msg'><i class='fa-solid fa-circle-exclamation'></i>Error While Adding</p>";
    }
} elseif ($action === 'remove') {
    $stmt = $conn->prepare("DELETE FROM wishlist WHERE user_id = ? AND product_id = ?");
    if ($stmt->execute([$user_id, $product_id])) {
        echo "<p class='success_msg'><i class='fa-solid fa-circle-check'></i>Removed From Wishlist</p>";
    } else {
        echo "<p class='error_msg'><i class='fa-solid fa-circle-exclamation'></i>Error Removing</p>";
    }
} else {
    http_response_code(400);
    echo "<p class='error_msg'><i class='fa-solid fa-circle-exclamation'></i>Invalid Actino</p>";
}
