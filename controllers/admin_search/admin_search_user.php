<?php
session_start();
require_once '../dbconn.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['search'])) {
    $searchTerm = trim($_POST['search']);

    if (empty($searchTerm)) {
        $_SESSION['error'] = "Please Enter Product Name";
        header("Location: ../../admin/admin.php?to=users");
        exit;
    }
    try {
        $query = "SELECT * FROM users WHERE user_name Like :user_name";
        $stmt = $conn->prepare($query);

        $stmt->execute([
            "user_name" => $searchTerm
        ]);

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($users)) {
            $_SESSION['error'] = "User not found";
            header("Location: ../../admin/admin.php?to=users");
            exit;
        }
        $_SESSION['searched_users'] = $users;
        header("Location: ../../admin/admin.php?to=users");
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header("Location: ../../admin/admin.php?to=users");
    exit();
}
