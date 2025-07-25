<?php
session_start();

require_once("../controllers/functions.php");
require_once("../includes/current_user_data.php");

$categories = getCategories();
$products = getProducts();
$searchProductId = $_GET['id'];

$searchProducts = getSearchProducts($searchProductId);


if (!isset($user_type) || $user_type !== 'admin') {
    header("Location: ../home.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Update Product</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="https://kit.fontawesome.com/69e1242b61.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="form_wrapper">
        <div class="heading">
            <h1>Update Product Data</h1>
        </div>
        <form method="POST" action="../controllers/update_product.php" enctype="multipart/form-data">

            <input type="hidden" name="update_product_id" id="id_input" value="<?php echo $searchProducts['product_id']; ?>">
            <input type="hidden" name="existing_image" id="id_input" value="<?php echo $searchProducts['product_image']; ?>">

            <div class="input_field">

                <input type="text" name="product_name" id="name_input" value="<?php echo $searchProducts['product_name']; ?>" placeholder="Product Name">
            </div>
            <div class="input_field">


                <textarea name="product_description" id="desc_input" placeholder="Description"><?php echo $searchProducts['product_description'] ?></textarea>


            </div>
            <div class="input_field">

                <input type="number" name="product_price" id="price_input" step="any" value="<?php echo $searchProducts['product_price'] ?>" placeholder="Price">
            </div>
            <div class="input_field input_row">

                <select name="product_category" id="category_input">

                    <?php
                    foreach ($categories as $category) {
                        $selected = ($category['category_id'] == $searchProducts['category_id']) ? 'selected' : '';
                    ?>
                        <option value="<?php echo $category['category_id'] ?>" <?php echo $selected ?>> <?php echo $category['category_name'] ?> </option>
                    <?php } ?>
                </select>


                <label for="image_input" class="file_label">Product Image</label>
                <input type="file" name="product_image" id="image_input">

            </div>

            <div class="input_btn">
                <button type="submit" class="green_btn">Update</button>

                <a href="admin.php?to=products">Back</a>
            </div>
        </form>
    </div>





</body>

</html>