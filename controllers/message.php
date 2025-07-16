<?php

require_once "dbconn.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $company = trim($_POST['company']);
    $message = $_POST['message'];


    if (empty($name) || empty($email) || empty($phone) || empty($company) || empty($message)) {
        echo "<p class= 'error_msg'><i class='fa-solid fa-circle-exclamation'></i>All Fields Are Required !</p>";
        exit;
    }


    $query = "INSERT INTO messages values (?,?,?,?,?,?, ?);";
    $stmt = $conn->prepare($query);
    $status = $stmt->execute([null, $name, $phone, $email, $company, $message, null]);

    if ($status) {
        echo "<p class='success_msg'><i class='fa-solid fa-circle-check'></i>Successfully Submitted Your Message</p>";

        exit;
    } else {
        echo "<p class= 'error_msg'><i class='fa-solid fa-circle-exclamation'></i>Error While Sending Message to the Team</p>";
    }
} else {
    header("Location: ../contact.php");
}
