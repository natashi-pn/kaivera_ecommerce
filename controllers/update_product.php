
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
      $_SESSION['error'] = 'All Fields Are Required';

      header('Location: ../admin/admin_update_product.php?id=' . $update_product_id);

      exit;
    }
  }
  if ($product_price == false) {
    $_SESSION['error'] = 'Invalid Product Price';
    header('Location: ../admin/admin_update_product.php?id=' . $update_product_id);

    exit;
  }


  $maxFileSize = 2 * 1024 * 1024;
  $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

  if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {

    // First check the valid size and type

    if ($_FILES['product_image']['size'] > $maxFileSize) {
      $_SESSION['error'] = 'File size must not exceed 2MB';
      header('Location: ../admin/admin_update_product.php?id=' . $update_product_id);

      exit;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $_FILES['product_image']['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mimeType, $allowedMimeTypes)) {
      $_SESSION['error'] = 'Only image files (JPG, PNG, GIF, WEBP) are allowed';
      header('Location: ../admin/admin_update_product.php?id=' . $update_product_id);

      exit;
    }


    $fileTempPath = $_FILES['product_image']['tmp_name'];
    $fileName = basename($_FILES['product_image']['name']);

    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $newFileName = uniqid('product_', true) . '.' . $fileExtension;


    $newDirectory = "../uploads/product_images/";
    $filePath = $newDirectory . $newFileName;

    if (!move_uploaded_file($fileTempPath, $filePath)) {
      $_SESSION['error'] = 'Cant Upload File';
      header('Location: ../admin/admin_update_product.php?id=' . $update_product_id);

      exit;
    };

    if ($existing_image && file_exists($existing_image) && $existing_image !== $filePath) {
      unlink($existing_image);
    }
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
