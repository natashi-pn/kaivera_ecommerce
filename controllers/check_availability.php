<?php
require_once "dbconn.php"; 

if (isset($_POST['type']) && isset($_POST['value'])) {
    $type = $_POST['type']; 
    $value = trim($_POST['value']);

    if ($type === 'username') {
        $query = "SELECT * FROM users WHERE user_name = ?";
    } elseif ($type === 'email') {
        $query = "SELECT * FROM users WHERE user_email = ?";
    } else {
        echo json_encode(['status' => 'error']);
        exit;
    }

    $stmt = $conn->prepare($query);
    $stmt->execute([$value]);
    $result = $stmt->fetch();

    if ($result) {
        echo json_encode(['status' => 'taken']);
    } else {
        echo json_encode(['status' => 'available']);
    }
    exit;
}
