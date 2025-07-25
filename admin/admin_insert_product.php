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

                <input type="text" name="product_name" id="name_input" placeholder="Product Name">
            </div>
            <div class="input_field">

                <textarea name="product_description" id="desc_input" placeholder="Description"></textarea>
            </div>
            <div class="input_field">

                <input type="number" name="product_price" id="price_input" step="any" placeholder="Price">
            </div>
            <div class="input_field input_row">

                <select name="product_category" id="category_input">
                    <?php
                    foreach ($categories as $category) {
                    ?>
                        <option value="<?php echo $category['category_id'] ?>"> <?php echo $category['category_name'] ?> </option>
                    <?php } ?>
                </select>
                <label for="image_input" class="file_label">Upload Image</label>
                <input type="file" name="product_image" id="image_input">
            </div>


            <div class="input_btn">
                <button type="submit" class="green_btn">Insert</button>
                <a href="admin.php?to=products">Back</a>
            </div>
        </form>
    </div>

</body>

</html>