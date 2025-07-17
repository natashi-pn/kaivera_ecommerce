  <?php
    require_once 'current_user_data.php';
    require_once 'controllers/functions.php';
    $user = getSearchUser($user_id);

    ?>
  <!-- Navigation -->
  <section class="navigation-btn">
      <div class="nav-logo">
          <img src="assets/images/kaivera logo.png" alt="" />
      </div>
      <div class="nav-menu">
          <div class="btn_wrapper hide_nav">
              <a href="home.php">Home</a>
          </div>
          <div class="btn_wrapper hide_nav">
              <a href="products.php">Products</a>
          </div>
          <div class="btn_wrapper hide_nav">
              <a href="about.php">About</a>
          </div>
          <div class="btn_wrapper hide_nav">
              <a href="contact.php">Contact</a>
          </div>
          <div class="btn_wrapper help-target-img" data-help-img="<?php echo htmlspecialchars($user['user_profile_image']) ?>">
              <a href="user/profile.php"><i class="fa-solid fa-user"></i></a>
          </div>
          <div class="btn_wrapper">
              <a href="" class="wishlist_link"><i class="fa-solid fa-heart"></i></a>
          </div>
          <div class="btn_wrapper">
              <a href="../cart.php" class=" go_to_cart"><i class="fa-solid fa-cart-shopping"></i></a>
              <?php
                if (!empty($_SESSION['alert_cart'])) {
                    $alert_cart = $_SESSION['alert_cart'];
                } ?>
              <div class="alert_cart <?php echo $alert_cart ?? "" ?>"></div>

          </div>

          <div class="nav-btn">
              <i class="fa-solid fa-caret-down"></i>
          </div>
      </div>
  </section>

  <section class="navigation">
      <div class="navigation_container">
          <div class="left">
              <ul>
                  <li>
                      <div class="invert"></div>
                      <a href="home.php" class="nav-link navigation_links">HOME</a>
                  </li>
                  <li>
                      <a href="products.php" class="nav-link  navigation_links">PRODUCTS</a>
                  </li>
                  <li>
                      <a href="cart.php" class="nav-link  navigation_links">CART</a>
                  </li>
                  <li>
                      <a href="contact.php" class="nav-link  navigation_links">CONTACT</a>
                  </li>
                  <li>
                      <a href="about.php" class="nav-link  navigation_links">ABOUT</a>
                  </li>
                  <li>
                      <a href="../controllers/logout.php" class="nav-link  navigation_links">LOGOUT</a>
                  </li>
              </ul>
          </div>
          <div class="right">
              <div class="bot">
                  <h1>01</h1>
              </div>
          </div>
      </div>

      <section class="navigation_bottom">

          <div class="icon help-target" data-help="Our Partner">
              <a href="#"><i class="fa-brands fa-pied-piper"></i></a>
          </div>
          <div class="social_links help-target" data-help="Social Links">
              <a href="#">Instagram<i class="fa-solid fa-arrow-up"></i></a>
              <a href="#">facebook<i class="fa-solid fa-arrow-up"></i></a>
              <a href="#">linkedin<i class="fa-solid fa-arrow-up"></i></a>
              <a href="#">x<i class="fa-solid fa-arrow-up"></i></a>
          </div>
          <div class="profile">
              <button id="light_mode" class="hidden"><i class="fa-solid fa-sun"></i></button>
              <button id="dark_mode"><i class="fa-solid fa-moon"></i></button>
          </div>
      </section>
  </section>


  <!-- Wish List -->

  <section class="wishlist" id="wishlist">
      <div class="heading">
          <h1>YOUR WISHLIST</h1>
          <button id="wishlistclose_btn">x</button>
      </div>
      <div class="product_container" id="wishlistContainer">

          <?php
            if (isset($user_id)) {
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
                              <a href="../products.php">Check Out</a>
                          </div>
                      </div>

                  <?php
                    }
                } else {
                    ?>

                  <div class="empty_list">
                      <img src="assets/images/empty_list.webp" alt="">
                  </div>
          <?php }
            } ?>



      </div>

  </section>




  <!-- Navigation ends -->