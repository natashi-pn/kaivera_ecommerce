<?php
session_start();
require_once("dbconn.php");
require_once("../includes/current_user_data.php");
$isLoggedIn = isset($_SESSION['user_data']['user_type']);

if (!$isLoggedIn) {
    http_response_code(401);
    echo "<p class='error_msg'><i class='fa-solid fa-circle-exclamation'></i>Sign Up First</p>";

    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $selectedColor = $_POST['color'];
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['quantity'];
    $product_name = $_POST['product_name'];
    $product_image = $_POST['product_image'];
    $price = $_POST['product_price'];

    $product_price = $price * $product_quantity;

    $selected_product = [
        'product_id' => $product_id,
        'product_name' => $product_name,
        'product_price' => $product_price,
        'product_image' => $product_image,
        'product_quantity' => $product_quantity,
        'product_color' => $selectedColor
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = $selected_product;
    $_SESSION['alert_cart'] = "added";
    echo "<p class='success_msg'><i class='fa-solid fa-circle-check'></i>Product Added To Cart !</p>";
    exit();
}
http_response_code(400);
echo "<p class='error_msg'><i class='fa-solid fa-circle-exclamation'></i>Invalid Actino</p>";

exit();
