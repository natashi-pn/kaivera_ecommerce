<?php
session_start();
require_once '../dbconn.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['search'])) {
    $searchTerm = trim($_POST['search']);

    if (empty($searchTerm)) {
        $_SESSION['error'] = "Please Enter Product Name";
        header("Location: ../../admin/admin.php?to=products");
        exit;
    }
    try {
        $query = "SELECT * FROM products WHERE product_name Like :product_name";
        $stmt = $conn->prepare($query);

        $stmt->execute([
            "product_name" => $searchTerm
        ]);

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($products)) {
            $_SESSION['error'] = "Product Not Found";
            header("Location: ../../admin/admin.php?to=products");
            exit;
        }
        $_SESSION['searched_products'] = $products;
        header("Location: ../../admin/admin.php?to=products");
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header("Location: ../../admin/admin.php?to=products");
    exit();
}
