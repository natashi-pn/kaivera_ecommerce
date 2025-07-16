<?php
session_start();
require_once("dbconn.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $message_id = $_GET['id'];

    $sql = "delete from messages where message_id = ?;";
    $stmt =   $conn->prepare($sql);
    $status = $stmt->execute([$message_id]);


    if ($status) {
        $_SESSION['success'] = "Deleted 1 Message Successfully";
        header("Location: ../admin/admin.php?to=messages");
        die();
    } else {
        $_SESSION['error'] = "Error while deleting message";
        header("Location: ../admin/admin.php?to=messages");
        die();
    }
} else {
    header('Location: ../admin/admin.php?to=messages');
}
