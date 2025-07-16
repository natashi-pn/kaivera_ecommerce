<?php
session_start();

require_once("includes/current_user_data.php");
require_once("controllers/functions.php");
$isLoggedIn = isset($_SESSION['user_data']['user_type']);

$cart = $_SESSION['cart'] ?? [];
$order_id =  $_SESSION['order_id'] ?? '';

$order_details = getOrderDetails($order_id);
unset($_SESSION['order_id']);

unset($_SESSION['alert_cart']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Kaivera Cart</title>
  <link rel="icon" href="assets/images/kaivera logo icon.png" type="image/png">
  <link rel="stylesheet" href="css/style.css" />
  <script src="https://kit.fontawesome.com/69e1242b61.js" crossorigin="anonymous"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="js/script.js" defer></script>
</head>

<body style="background: #121212" data-page="cart">



  <!-- Help Bubble -->
  <div class="help-bubble"></div>

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

  <div class="notification"></div>


  <!-- Header Section -->
  <section class="header">
    <div class="background-video">
      <video src="assets/videos/Gradientsection.mp4" autoplay muted loop playsinline></video>
    </div>
    <div class="header-content">
      <div class="header-links">
        <a href="home.php">Home</a>
        <span>.</span>
        <a href="cart.php">Cart</a>
      </div>
      <div class="title">
        <div class="text-wrapper">
          <h1 class="introLineAnimation">Your Cart Elevate Your Elegance</h1>
        </div>
      </div>
      <div class="desc">
        <div class="para-wrapper">
          <p class="introLineAnimation">
            Secure your piece of tropical luxury with a single click. Whether
            it’s our handcrafted sneakers, signature perfumes, or timeless
            bags your curated style journey begins the moment you add it to
            your cart.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Cart Section -->
  <section class="bg-[#1a1c20] py-8 antialiased dark:bg-[#1a1c20] md:py-16 cart-section">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      <a href="products.php" class="transition-link help-target" data-help="Go To Products">
        <h2 class="text-3xl text-gray-900 dark:text-white sm:text-3xl text-center cart-title">
          Shopping Cart
        </h2>
      </a>

      <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8   <?php if (!$isLoggedIn) echo ' ' . 'hiddenDefault' ?>">
        <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
          <div class="space-y-6">



            <?php foreach ($cart as $index => $item) {
              $color = "";

              switch ($item['product_color']) {
                case 'Primary':
                  $color = "filter : hue-rotate(0);";
                  break;
                case 'Veil':
                  $color = "filter : hue-rotate(50deg) saturate(1.1);";
                  break;
                case 'Azure':
                  $color = "filter: hue-rotate(200deg) saturate(1.1) ;";
                  break;
                case 'Emerald':
                  $color = "filter:hue-rotate(100deg) saturate(1.05) ;";
                  break;
                case 'Frost':
                  $color = "filter:grayscale(1) brightness(1.15) ;";
                  break;
              }
            ?>

              <div
                class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-[#1d2025] md:p-6">
                <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                  <a href="products.php" class="shrink-0 md:order-1 transition-link">
                    <img class="h-20 w-20 dark:hidden"
                      src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="imac image" />
                    <img class="hidden h-20 w-20 dark:block" src="<?php echo htmlspecialchars($item['product_image']) ?>" alt="imac image"
                      style="<?php echo $color ?>" />
                  </a>
                  <div class="flex items-center justify-between md:order-3 md:justify-end">
                    <div class="flex items-center">
                      <input type="text" id="counter-input" data-input-counter
                        class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                        placeholder="" value="<?php echo $item['product_quantity'] ?>" required />
                    </div>
                    <div class="text-end md:order-4 md:w-32">
                      <p class="text-base font-bold text-gray-900 dark:text-white">
                        <?php echo "$ " . $item['product_price'] ?>
                      </p>
                    </div>
                  </div>

                  <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                    <a href="products.php" class="transition-link text-base font-medium text-gray-900 hover:underline dark:text-white"><?php echo htmlspecialchars($item['product_name']) . " (" . $item['product_color'] . ")" ?></a>

                    <div class="flex items-center gap-4">

                      <button id="remove-item-btn" data-index="<?php echo $index ?>"
                        class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500 remove-item-btn">
                        <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                          height="24" fill="none" viewBox="0 0 24 24">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                        Remove
                      </button>

                    </div>
                  </div>
                </div>
              </div>

            <?php } ?>

          </div>
        </div>

        <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
          <div
            class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-[#1d2025] sm:p-6">
            <p class="text-xl text-gray-900 dark:text-white">Order summary</p>

            <form method="POST" id="order_form">
              <div class="space-y-4">
                <div class="space-y-2">
                  <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">
                      Original price
                    </dt>
                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                      <?php
                      $original_price = 0;
                      foreach ($cart as $item) {
                        $original_price += $item["product_price"];
                      }
                      echo "$" . $original_price;
                      ?>
                    </dd>
                  </dl>
                  <?php
                  $discount = 0;
                  if (isset($_SESSION['discount']['discount_percent'])) {
                    $discount_percent = $_SESSION['discount']['discount_percent'];
                    $discount = $discount_percent / 100 * $original_price;
                  }

                  ?>
                  <dl class="flex items-center justify-between gap-4 help-target" data-help="Enter Voucher">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">
                      Discount<?php
                              if (isset($discount_percent)) {
                                echo "(" . $discount_percent . "%)";
                              }

                              ?>
                    </dt>
                    <dd class="text-base font-medium text-green-600">
                      <?php
                      if (isset($discount)) {
                        echo "-$" . $discount;
                      }

                      ?>
                    </dd>
                  </dl>


                  <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">
                      Tax (5%)
                    </dt>
                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                      <?php
                      $tax = $original_price * 5 / 100;
                      echo "$" . $tax;
                      ?>
                    </dd>
                  </dl>

                  <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">
                      Payment Method
                    </dt>
                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                      <select name="payment_method" id="payment_method" class="payment_method">
                        <option value="credit-card" selected>Credit Card</option>
                        <option value="pay-pal">Pay Pal</option>
                        <option value="apple-pay">Apple Pay</option>
                        <option value="cash-on-delivery">Cash On Delivery</option>
                      </select>
                    </dd>
                  </dl>
                </div>

                <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                  <dt class="text-base font-bold text-gray-900 dark:text-white">
                    Total
                  </dt>
                  <dd class="text-base font-bold text-gray-900 dark:text-white">
                    <?php
                    $total_price = ($original_price + $tax) - $discount;
                    echo "$" . $total_price;
                    ?>
                    <input type="text" name="total_price" hidden value="<?php echo $total_price ?>">


                    <?php if (isset($_SESSION['discount'])) {
                      $discount_id = $_SESSION['discount']['discount_id'];
                    } else {
                      $discount_id = "";
                    }
                    ?>
                    <input type="text" name="discount" hidden value="<?php echo $discount_id ?>">
                  </dd>
                </dl>
              </div>

              <button type="submit" id="checkout_btn"
                class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-base font-medium text-black hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-white dark:hover:bg-[#e6e6e6] dark:focus:ring-primary-800">Proceed
                to Checkout</button>
            </form>

            <div class="flex items-center justify-center gap-2">
              <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                or
              </span>
              <a href="products.php" title=""
                class="transition-link inline-flex items-center gap-2 text-base font-medium text-[#abbee1] underline hover:no-underline dark:text-[#abbee1]">
                Continue Shopping
                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 12H5m14 0-4 4m4-4-4-4" />
                </svg>
              </a>
            </div>
          </div>

          <div
            class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-[#1d2025] sm:p-6">
            <form class="space-y-4" method="POST" id="discount_form">
              <div>
                <label for="voucher" class="mb-2 block text-base font-medium text-gray-900 dark:text-white">
                  Do you have a voucher or gift card?
                </label>
                <input type="text" id="voucher"
                  class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                  placeholder="" name="discount_code" />
              </div>
              <button type="submit"
                class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-base font-medium text-black hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-white dark:hover:bg-[#e6e6e6] dark:focus:ring-primary-800">
                Apply Code
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Receipt Card -->
  <section class="receipt">
    <div class="receipt_card">

      <div class="header">
        <img src="assets/images/kaivera logo.png" alt="">
        <h1>Receipt</h1>
      </div>
      <?php $first_row = $order_details[0] ?? null;

      if ($first_row) {

      ?>
        <div class="receipt-info">
          <p><?php echo $first_row['user_email'] ?></p>
          <p><?php echo $first_row['order_date'] ?></p>

          <?php
          if (!$first_row["discount_id"]) {
            echo "<p>No Discounts Were Used</p>";
          } else {
          ?>
            <p>Discount Code: <?php echo $first_row['discount_code'] ?>, Discount: <?php echo $first_row['discount_percent'] ?>%</p>

          <?php } ?>

          <p>User ID <?php echo $first_row['user_id'] ?>, Username: <?php echo $first_row['user_name'] ?></p>
        </div>
      <?php } ?>
      <div class="order_info">
        <div class="row">
          <p>Product</p>
          <p>Quantity</p>
          <p>Amount</p>
        </div>

        <?php
        foreach ($order_details as $orders) {
        ?>
          <div class="row order">
            <p><?php echo $orders['product_name'] ?></p>
            <p><?php echo $orders['quantity'] ?></p>
            <p>$<?php echo $orders['price'] ?></p>
          </div>
        <?php }
        ?>

        <div class="row total">
          <p>Total</p>
          <p>$<?php echo $first_row['total_price'] ?></p>

        </div>

        <div class="download-btn">
          <button id="download-image" class="help-target" data-help="Download Receipt"><i class="fa-solid fa-download"></i></button>
        </div>
      </div>
    </div>
    <div class="warning">
      <p>You May Want To Screenshot The Receipt | Double Click to Close</p>

    </div>
  </section>

  <?php
  require_once("includes/footer.php");
  ?>

  <script>
    window.addEventListener("DOMContentLoaded", () => {
      if (sessionStorage.getItem("openReceipt") === "true") {
        document.querySelector(".receipt")?.classList.add("open");
        sessionStorage.removeItem("openReceipt");
      }
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
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