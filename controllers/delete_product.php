<?php
session_start();
require_once("dbconn.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  $product_id = $_GET['id'];
  echo $product_id;

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
