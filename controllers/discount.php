<?php
session_start();
require_once "dbconn.php";
require_once 'functions.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $discount_code = $_POST['discount_code'] ?? '';
    if (empty($discount_code)) {
        echo "<p class='error_msg'><i class='fa-solid fa-circle-exclamation'></i>Invalid Action</p>";
        exit;
    }
    $discount_code = trim($discount_code);


    $discount = getDiscount($discount_code);


    if (isset($discount['discount_percent'])) {
        $_SESSION['discount'] = [
            "discount_id" => $discount['discount_id'],
            "discount_percent" => $discount['discount_percent']
        ];
        echo "<p class='success_msg'><i class='fa-solid fa-circle-check'></i>Discount applied: " . $_SESSION['discount']['discount_percent'] . "% Refresh!</p>";
        exit;
    } else {
        echo "<p class='error_msg'><i class='fa-solid fa-circle-exclamation'></i>Invalid Voucher Code</p>";

        exit;
    }
} else {
    header("Location: ../cart.php");
}
