<?php
session_start();
require_once("dbconn.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  $product_id = $_GET['id'];

  $stmt = $conn->prepare("SELECT COUNT(*) FROM order_items WHERE product_id = ?");
  $stmt->execute([$product_id]);
  $orderItemCount = $stmt->fetchColumn();


  $stmt = $conn->prepare("SELECT COUNT(*) FROM wishlist WHERE product_id = ?");
  $stmt->execute([$product_id]);
  $wishlistCount = $stmt->fetchColumn();

  if ($orderItemCount > 0) {
    $_SESSION['error'] = "Cannot delete: Product in order !";
    header("Location: ../admin/admin.php?to=products");
    exit();
  }

  if ($wishlistCount > 0) {
    $query = "DELETE FROM wishlist where product_id =?;";
    $stmt = $conn->prepare($query);
    $stmt->execute([$product_id]);
  }

  $sql = "delete from products where product_id = ?;";
  $stmt =   $conn->prepare($sql);
  $status = $stmt->execute([$product_id]);


  if ($status) {
    $_SESSION['success'] = "Deleted 1 Product Successfully";
    header("Location: ../admin/admin.php?to=products");
    die();
  } else {
    $_SESSION['error'] = "Error while deleting product";
    header("Location: ../admin/admin.php?to=products");
    die();
  }
} else {
  header('Location: ../admin/admin.php?to=products');
}
