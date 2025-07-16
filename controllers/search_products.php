<?php
session_start();
require_once 'dbconn.php';
require_once 'functions.php';
require_once("../includes/current_user_data.php");
$isLoggedIn = isset($_SESSION['user_data']['user_type']);


$searchTerm = $_GET['term'] ?? '';
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 1;

if ($searchTerm === '') {
  $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = ?");
  $stmt->execute([$category_id]);
} else {
  $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = ? AND product_name LIKE ?");
  $stmt->execute([$category_id, "%$searchTerm%"]);
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $product) {
  $imagePath = str_replace('../', '', $product['product_image']);

  $wishlist = isset($user_id) ? getWishList($user_id) : [];

  $isWished = in_array($product["product_id"], $wishlist);
  $wishlistClass = $isWished ? 'added' : '';
?>

  <div class="product">
    <div class="product-image">
      <h1>$ <?php echo $product['product_price'] ?></h1>
      <button id="wishlist_btn" class="wishlist_btn <?php echo $wishlistClass; ?>"

        data-user-id=<?php echo $user_id ?>
        data-product-id=<?php echo $product['product_id'] ?>><i class="fa-solid fa-heart"></i></button>
      <img src="<?php echo $imagePath ?>" alt="" />
    </div>
    <div class="product-content">
      <div class="product-desc">
        <h1><?php echo $product['product_name'] ?></h1>
        <h1>
          <?php echo $product['product_description'] ?>
        </h1>
      </div>
      <button id="view_details" class="view_details"
        data-product-id="<?php echo htmlspecialchars($product['product_id']) ?>"
        data-name="<?php echo htmlspecialchars($product['product_name'], ENT_QUOTES) ?>"
        data-desc="<?php echo htmlspecialchars($product['product_description'], ENT_QUOTES) ?>"
        data-price="<?php echo $product['product_price'] ?>"
        data-img="<?php echo $imagePath ?>">View Detail</button>
    </div>
  </div>
<?php
}
?>