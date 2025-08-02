<?php
session_start();
require_once('dbconn.php');


$user_id = $_GET['id'];

if (isset($user_id)) {


    $query = "SELECT order_id FROM orders where user_id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->execute([$user_id]);
    $order_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);

    if (!empty($order_ids)) {
        $placeholders = rtrim(str_repeat('?,', count($order_ids)), ',');
        $query = "DELETE FROM order_items WHERE order_id IN ($placeholders)";
        $stmt = $conn->prepare($query);
        $stmt->execute($order_ids);
    }

    $stmt = $conn->prepare("SELECT user_profile_image FROM users WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $image = $stmt->fetchColumn();

    $defaultImagePath = '../uploads/profile_pictures/default_pf.jpg';
    if ($image !== $defaultImagePath && file_exists($image)) {
        unlink($image);
    }

    $query = "delete from reviews where user_id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->execute([$user_id]);

    $query = "delete from wishlist where user_id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->execute([$user_id]);


    $query = "delete from orders where user_id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->execute([$user_id]);

    $query = "delete from users where user_id = ?;";
    $stmt = $conn->prepare($query);
    $status =  $stmt->execute([$user_id]);


    if ($status) {


        $_SESSION['success'] = 'Deleted 1 User Successfully';
        header('Location: ../admin/admin.php?to=users');
        exit;
    } else {
        $_SESSION['error'] = 'Error while deleting user';
        header('Location: ../admin/admin.php?to=users');

        exit;
    }
} else {
    header('Location: ../admin/admin.php?to=users');
}
