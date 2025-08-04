<?php

session_start();
require_once "dbconn.php";
require_once "functions.php";
require_once "../includes/current_user_data.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (!isset($user_id)) {
        echo "<p class='error_msg'><i class='fa-solid fa-circle-exclamation'></i>Sign Up First</p>";
        exit;
    }
    $user_id = $_SESSION['user_data']['user_id'];
    $payment_method = $_POST["payment_method"];
    $total_price = $_POST['total_price'];
    $discount = $_POST['discount'];
    $order_address = $_POST['order_address'];
    $cart = $_SESSION['cart'] ?? [];

    if (empty($discount)) {
        $discount = null;
    }
    if (empty($order_address)) {
        echo "<p class='error_msg'><i class='fa-solid fa-circle-exclamation'></i>Delivery Address Cannot be Empty</p>";
        exit;
    }

    if (empty($user_id) || empty($payment_method) || empty($total_price) || empty($cart)) {
        echo "<p class='error_msg'><i class='fa-solid fa-circle-exclamation'></i>The cart is Empty</p>";
        exit;
    } else {

        $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, order_date, order_status, payment_method, discount_id , order_address) VALUES (?, ?, NOW(), 'Pending', ? , ?, ?)");
        $stmt->execute([$user_id, $total_price, $payment_method, $discount, $order_address]);

        $order_id = $conn->lastInsertId();

        $stmt_item = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, quantity, price) VALUES (?, ?, ?, ?, ?)");


        foreach ($cart as $item) {

            $product_check = $conn->prepare("SELECT COUNT(*) FROM products WHERE product_id = ?");
            $product_check->execute([$item['product_id']]);
            $exists = $product_check->fetchColumn();

            $final_product = $item['product_name'] . ' (' . $item['product_color'] . ')';

            if (!$exists) {
                echo "<p class='error_msg'><i class='fa-solid fa-circle-exclamation'></i>One or more products in your cart are no longer available.</p>";

                exit;
            }

            if ($exists) {
                $status = $stmt_item->execute([
                    $order_id,
                    $item['product_id'],
                    $final_product,
                    $item['product_quantity'],
                    $item['product_price']
                ]);
            }
        }
        if ($status) {
            unset($_SESSION['cart']);
            unset($_SESSION['discount']);
            $_SESSION['order_id'] = $order_id;

            echo "Successfully Made An Order Thank You!";
            exit;
        }
    }
} else {
    header("Location: ../cart.php");
}
