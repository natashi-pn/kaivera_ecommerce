<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $index = (int)$_POST["index"];

    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
    }
    echo "<p class='success_msg'><i class='fa-solid fa-circle-check'></i>Product Removed From Cart</p>";


    exit();
} else {
    echo "<p class='error_msg'><i class='fa-solid fa-circle-exclamation'></i>Invalid Actino</p>";
}
