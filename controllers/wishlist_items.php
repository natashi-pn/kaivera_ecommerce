<?php
session_start();
require_once("dbconn.php");
require_once("functions.php");

$user_id = $_POST['user_id'] ?? null;

if ($user_id) {
    $wishedProducts = getWishedProduct($user_id);
    if (!empty($wishedProducts)) {
        foreach ($wishedProducts as $product) {
?>
            <div class="product">
                <div class="image">
                    <img src="<?php echo $product['product_image'] ?>" alt="">
                    <button class="remove_wishlist"
                        data-user-id=<?php echo $user_id ?>
                        data-product-id=<?php echo $product['product_id'] ?>>Remove</button>
                </div>
                <div class="product_info">
                    <h1><?php echo $product['product_name'] ?></h1>
                    <p><?php echo $product['product_description'] ?></p>
                    <span>$<?php echo $product['product_price'] ?></span>
                    <a href="../products.php" class="transition-link">Check Out</a>
                </div>
            </div>
<?php
        }
    } else {
        echo '<div class="empty_list"><img src="assets/images/empty_list.webp" alt=""></div>';
    }
}
?>