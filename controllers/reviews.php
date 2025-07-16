<?php

session_start();
require_once("dbconn.php");
require_once("../includes/current_user_data.php");



if (!isset($_SESSION['user_data']['user_type'])) {
    http_response_code(401);
    echo "<p class='error_msg'><i class='fa-solid fa-circle-exclamation'></i>Sign Up First</p>";
    exit();
}
$user_id = $_SESSION['user_data']['user_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $rating = isset($_POST["rating"]) ? $_POST["rating"] : "";
    $comment = $_POST["comment"];

    if (empty($rating) || empty($comment)) {
        echo "<p class='error_msg'><i class='fa-solid fa-circle-exclamation'></i>All Fields Are Required</p>";
        exit();
    }
    $query = "INSERT Into reviews values (?,?,?,?,?);";
    $stmt = $conn->prepare($query);
    $status = $stmt->execute([null, $user_id, $rating, $comment, null]);

    if ($status) {
        echo "<p class='success_msg'><i class='fa-solid fa-circle-check'></i>Successfully Submitted Your Comment :D</p>";
        exit();
    }
} else {
    header("Location: ../contact.php");
    exit();
}

http_response_code(400);
echo "<p class='error_msg'><i class='fa-solid fa-circle-exclamation'></i>Invalid Request</p>";
exit();
