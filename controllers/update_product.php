
<?php
session_start();
require_once "../controllers/dbconn.php";


if ($_SERVER["REQUEST_METHOD"] == 'POST') {

  $filePath = null;

  $update_product_id = $_POST['update_product_id'];
  $existing_image = $_POST['existing_image'];

  $product_name = trim($_POST['product_name']);
  $product_description = trim($_POST['product_description']);
  $product_price = filter_var($_POST['product_price'], FILTER_VALIDATE_FLOAT);
  $product_category =  trim($_POST['product_category']);

  $fields = [$product_name, $product_description, $product_price, $product_category];
  foreach ($fields as $field) {
    if (empty($field)) {
      die('All Inputs are required !');
    }
  }
  if ($product_price == false) {
    die("Invalid Product Price");
  }

  if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {

    $fileTempPath = $_FILES['product_image']['tmp_name'];
    $fileName = basename($_FILES['product_image']['name']);

    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $newFileName = uniqid('product_', true) . '.' . $fileExtension;


    $newDirectory = "../uploads/product_images/";
    $filePath = $newDirectory . $newFileName;

    if (!move_uploaded_file($fileTempPath, $filePath)) {
      die("Cant Upload File");
    };
  } else {
    $filePath = $existing_image;
  }


  $sql = "update products set product_name = ? , product_description = ? , product_price = ? , product_image = ? , category_id = ? where product_id = ?;";
  $stmt =   $conn->prepare($sql);
  $status = $stmt->execute([$product_name, $product_description, $product_price, $filePath, $product_category, $update_product_id]);


  if ($status) {
    $_SESSION['success'] = 'Product Updated Successfully';
    header("Location: ../admin/admin.php?to=products");
  } else {
    $_SESSION['error'] = 'Error While Updating Product';
  }
} else {
  header("Location: ../admin/admin.php?to=products");
}
