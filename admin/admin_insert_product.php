<?php

require_once("../controllers/functions.php");
$categories = getCategories();
$products = getProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Insert New Product</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="https://kit.fontawesome.com/69e1242b61.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="form_wrapper">
        <div class="heading">
            <h1>Insert Product Data</h1>
        </div>
        <form method="POST" action="../controllers/insert_product.php" enctype="multipart/form-data">
            <div class="input_field">
                <label for="name_input">Product Name</label>
                <input type="text" name="product_name" id="name_input">
            </div>
            <div class="input_field">
                <label for="desc_input">Product Description</label>
                <textarea name="product_description" id="desc_input"></textarea>
            </div>
            <div class="input_field">
                <label for="price_input">Product Price</label>
                <input type="number" name="product_price" id="price_input" step="any">
            </div>
            <div class="input_field">
                <label for="category_input">Product Category</label>
                <select name="product_category" id="category_input">
                    <?php
                    foreach ($categories as $category) {
                    ?>
                        <option value="<?php echo $category['category_id'] ?>"> <?php echo $category['category_name'] ?> </option>
                    <?php } ?>
                </select>
            </div>
            <div class="input_field">
                <label for="image_input" class="file_label">Upload Image</label>
                <input type="file" name="product_image" id="image_input">
            </div>

            <div class="input_btn">
                <button type="submit" class="green_btn">Insert</button>
                <button type="reset" class="red_btn">Reset</button>
                <a href="admin.php?to=products">Back</a>
            </div>
        </form>
    </div>

</body>

</html>