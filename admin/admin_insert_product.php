<?php
session_start();

require_once("../controllers/functions.php");
require_once("../includes/current_user_data.php");

$categories = getCategories();
$products = getProducts();


if (!isset($user_type) || $user_type !== 'admin') {
    header("Location: ../home.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Insert New Product</title>
    <link rel="icon" href="../assets/images/kaivera logo icon.png" type="image/png">

    <link rel="stylesheet" href="../css/admin.css">
    <script src="https://kit.fontawesome.com/69e1242b61.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="form_wrapper">
        <div class="heading">
            <h1>Insert Product Data</h1>
            <?php
            if (isset($_SESSION['success'])) {
                echo "<p style='color: #9fc9b7;'>{$_SESSION['success']}</p>";
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['error'])) {
                echo "<p style='color: rgb(214, 102, 102);'>{$_SESSION['error']}</p>";
                unset($_SESSION['error']);
            }

            ?>
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