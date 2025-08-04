<?php
session_start();

require_once("includes/current_user_data.php");
$isLoggedIn = isset($_SESSION['user_data']['user_type']);

require_once("controllers/functions.php");
$categories = getCategories();
$products = getProducts();


unset($_SESSION['order_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Kaivera Product</title>
  <link rel="icon" href="assets/images/kaivera logo icon.png" type="image/png">
  <link rel="stylesheet" href="css/style.css" />
  <script src="https://kit.fontawesome.com/69e1242b61.js" crossorigin="anonymous"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="js/script.js" defer></script>
</head>

<body style="background: #121212" data-page="product">



  <?php

  if (isset($user_type)) {

    if ($user_type == 'admin') {
      require_once("includes/admin_navigation.php");
    }
    if ($user_type == 'user') {
      require_once("includes/user_navigation.php");
    }
  } else {

    require_once("includes/navigation.php");
  }
  ?>
  <!-- Help Bubble -->
  <div class="help-bubble"></div>
  <div class="notification"></div>

  <div class="fade-overlay"></div>

  <main>



    <!-- Header Section -->
    <section class="header">
      <div class="background-video">
        <div class="spinner" id="spinner">
          <div class="absolute top-0 right-0 h-screen w-screen z-50 flex justify-center items-center">
            <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2"></div>
          </div>
        </div>
        <video src="assets/videos/Gradientsection.mp4" id="header_video" autoplay muted loop playsinline></video>
      </div>
      <div class="header-content">
        <div class="header-links">
          <a href="home.php">Home</a>
          <span>•</span>
          <a href="products.php">Products</a>
        </div>
        <div class="title">
          <div class="text-wrapper">
            <h1 class="introLineAnimation">
              Elevated Essentials, Designed to Endure
            </h1>
          </div>
        </div>
        <div class="desc">
          <div class="para-wrapper">
            <p class="introLineAnimation">
              Step into the world of Kaivera where every sneaker, dress and shirt is crafted with intention.Fefined for the
              modern explorer. Discover pieces that speak in silence
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Product Section -->
    <a href="cart.php" class="help-target" data-help="Go To Cart">
      <section class="product-section">
        <div class="product-header">
          <h1 class="introLineAnimation">Essence of Kaivera</h1>
          <p class="linesAnimation">
            Discover our signature designer sneakers where tropical soul meets
            timeless luxury
          </p>
        </div>
    </a>
    <div class="product-nav">
      <button class="category-btn active" data-category-id="1">Dresses</button>
      <button class="category-btn" data-category-id="2">Shirts</button>
      <button class="category-btn" data-category-id="3">Shoes</button>

    </div>
    <div class="search <?php if (!$isLoggedIn) echo ' ' . 'hiddenDefault' ?>">
      <input type="text" name="search_name" id="searchInput" placeholder="Search Product">
      <label for="searchInput"><i class="fa-solid fa-magnifying-glass"></i></label>
    </div>
    <div class="slider" id="slider">


      <!-- Dresses Slide -->
      <section class="slide">
        <div class="product-container" id="product-container-1">

          <?php
          $category_id = 1;
          $getProductsByCategory = getProductsByCategory($category_id);
          foreach ($getProductsByCategory as $product) {
            $imagePath = $product['product_image'];
            $finalImagePath = str_replace('../', '', $imagePath);

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
                <img src="<?php echo $finalImagePath ?>" alt="" />
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
                  data-img="<?php echo $finalImagePath ?>">View Detail</button>
              </div>
            </div>
          <?php } ?>
        </div>
      </section>

      <!-- Shirt Slide -->
      <section class="slide">
        <div class="product-container" id="product-container-2">

          <?php
          $category_id = 2;
          $getProductsByCategory = getProductsByCategory($category_id);
          foreach ($getProductsByCategory as $product) {
            $imagePath = $product['product_image'];
            $finalImagePath = str_replace('../', '', $imagePath);

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
                <img src="<?php echo $finalImagePath ?>" alt="" />
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
                  data-img="<?php echo $finalImagePath ?>">View Detail</button>
              </div>
            </div>
          <?php } ?>
        </div>
      </section>

      <!-- Shoes Slide -->

      <section class="slide">
        <div class="product-container" id="product-container-3">
          <?php
          $category_id = 3;
          $getProductsByCategory = getProductsByCategory($category_id);
          foreach ($getProductsByCategory as $product) {
            $imagePath = $product['product_image'];
            $finalImagePath = str_replace('../', '', $imagePath);

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
                <img src="<?php echo $finalImagePath ?>" alt="" />
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
                  data-img="<?php echo $finalImagePath ?>">View Detail</button>
              </div>
            </div>
          <?php } ?>
        </div>
      </section>
    </div>
    </section>



    <!-- Footer -->

    <?php
    require_once("includes/footer.php");
    ?>

  </main>

  <!-- Product Details -->

  <section class="product_details hidden" id="product-popup">
    <div class="product_details_container popup-content">
      <div class="image help-target" id="product_image" data-help="Double Click to Close">
        <span class="close-btn"><i class="fa-solid fa-arrow-left"></i></span>
        <div class="image_container"><img id="productImage" src="" alt=""></div>

        <a href="cart.php" class="help-target" data-help="Cart"><i class="fa-solid fa-cart-shopping"></i></a>
      </div>
      <div class="content">
        <form action="controllers/add_to_cart.php" method="POST" enctype="multipart/form-data">
          <div class="title">
            <h1 id="popup-name"></h1>
          </div>
          <div class="desc">
            <span>Description</span>
            <p id="popup-desc"></p>
          </div>
          <div class="color">
            <span>Color</span>
            <div class="input-fields ">
              <label for="radioD"><i class="fa-solid fa-circle"></i></label>
              <input type="radio" name="color" id="radioD" value="Primary" checked required>

              <label for="radio1"><i class="fa-solid fa-circle"></i></label>
              <input type="radio" name="color" id="radio1" value="Veil" required>

              <label for="radio2"><i class="fa-solid fa-circle"></i></label>
              <input type="radio" name="color" id="radio2" value="Azure" required>

              <label for="radio3"><i class="fa-solid fa-circle"></i></label>
              <input type="radio" name="color" id="radio3" value="Emerald" required>

              <label for="radio4"><i class="fa-solid fa-circle"></i></label>
              <input type="radio" name="color" id="radio4" value="Frost" required>
            </div>
          </div>

          <div class="quantity">
            <span>Quantity</span>
            <div class="input">
              <button class="decrease" type="button"><i class="fa-solid fa-minus"></i></button>
              <input type="number" class="quantityInput" name="quantity" value="1" min="1">
              <button class="increase" type="button"><i class="fa-solid fa-plus"></i></button>
            </div>

          </div>

          <div class="price">
            <span>Price</span>
            <h1 id="totalPrice"></h1>
          </div>

          <div class="btn">
            <input type="text" name="product_id" id="id_input" value="98" hidden>
            <input type="text" name="product_name" id="name_input" value="" hidden>
            <input type="text" name="product_image" id="image_input" value="" hidden>
            <input type="text" name="product_price" id="price_input" value="" hidden>
            <button type="button" class="submit-btn add-cart-btn" <?php if (!$isLoggedIn) echo 'disabled'; ?>>Add to Cart<i class="fa-solid fa-cart-shopping"></i></button>
            <a href="cart.php">
              <button type="button" class="submit-btn add-cart-btn" <?php if (!$isLoggedIn) echo 'disabled'; ?>>Add & Go Cart <i class="fa-solid fa-arrow-right"></i></button>
            </a>
          </div>
        </form>
      </div>
    </div>
  </section>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/CustomEase.min.js"></script>

  <script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js"
    integrity="sha512-NcZdtrT77bJr4STcmsGAESr06BYGE8woZdSdEgqnpyqac7sugNO+Tr4bGwGF3MsnEkGKhU2KL2xh6Ec+BqsaHA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/SplitText.min.js"
    integrity="sha512-wOeEC+9qERAzhliwBFPDb6t8TiFFxdxG8vhK/Ygs7TuC44bpg8pg/X2/U/u+0X4fK05wb9id1EIipnF02+CFQw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/ScrollTrigger.min.js"
    integrity="sha512-P2IDYZfqSwjcSjX0BKeNhwRUH8zRPGlgcWl5n6gBLzdi4Y5/0O4zaXrtO4K9TZK6Hn1BenYpKowuCavNandERg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>