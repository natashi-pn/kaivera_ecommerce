<?php
session_start();
require_once("includes/current_user_data.php");
require_once("controllers/functions.php");

$topProducts = getTopProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Kaivera</title>
  <link rel="icon" href="assets/images/kaivera logo icon.png" type="image/png">
  <link rel="stylesheet" href="css/style.css" />
  <script src="https://kit.fontawesome.com/69e1242b61.js" crossorigin="anonymous"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="js/script.js" defer></script>
</head>

<body data-page="home" class="light">

  <div class="notification"></div>

  <!-- Loader -->
  <section class="loader">
    <div class="text_content">
      <div class="counter">
        <p></p>
      </div>
      <h1>Kaivera</h1>
    </div>
    <div class="loader_bg loader_bg_top"></div>
    <div class="loader_bg loader_bg_bottom"></div>
  </section>


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

  <!-- Home Page Section -->

  <section class="landing-page" id="landing-page">

    <div class="hero-img">
      <img src="assets/images/hero-img5.webp" alt="" data-speed="0.45" class="image-parallax" />
    </div>
    <div class="content">
      <h1>Wildcrafted</h1>
      <p class="heroPara">
        Kaivera is more than a brand, it’s a state of being. From sun-washed
        shores to urban streets, our pieces carry the spirit of nature and the
        polish of design. Meticulously crafted. Undeniably distinct.
      </p>
    </div>
  </section>


  <!-- About us Section -->
  <section class="about-us">
    <div class="container">
      <div class="wrapper">
        <p class="linesAnimation">
          Kaivera blends timeless design with the quiet elegance of nature,
          offering a refined lifestyle rooted in quality and intention. Each
          piece whether worn or carried is a reflection of subtle luxury,
          crafted to elevate the everyday. Inspired by tropical calm and
          minimalist sophistication, Kaivera invites you to step into a world
          where beauty feels effortless and enduring.
        </p>

        <a href="about.php">About Us</a>
      </div>
    </div>

    <div class="content-container" id="content-container">
      <div class="content">
        <div class="content-title">
          <h1 class="charsAnimation">01</h1>
          <h1 class="charsAnimation">ElEGANT</h1>
        </div>
        <div class="content-desc">
          <p class="linesAnimation">
            A refined fusion of minimalist aesthetics and luxurious
            sophistication in every detail.
          </p>
        </div>
      </div>
      <div class="content">
        <div class="content-title">
          <h1 class="charsAnimation">02</h1>
          <h1 class="charsAnimation">TROPICAL</h1>
        </div>
        <div class="content-desc">
          <p class="linesAnimation">
            Infused with the spirit of lush jungles and effortless beauty.
          </p>
        </div>
      </div>
      <div class="content">
        <div class="content-title">
          <h1 class="charsAnimation">03</h1>
          <h1 class="charsAnimation">TIMELESS</h1>
        </div>
        <div class="content-desc">
          <p class="linesAnimation">
            Designed beyond the constraints of trends quality, and quiet
            confidence.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="about-content">

    <div class="about-firstSection">
      <div class="big-text">
        <h1 class="scrollText">GET TO KNOW</h1>
        <h1 class="scrollText">ABOUT KAIVERA</h1>
      </div>
      <div class="paragraph">
        <p class="scrollLine">
          Kaivera is more than just a brand it's a lifestyle inspired by the
          elegance of nature and the spirit of tropical escape.
        </p>
      </div>
    </div>
  </section>


  <!-- Scroll Text Section -->
  <section class="horizontalText">
    <p>
      . Kaivera . New york . London . Bangkok . Tokyo .
    </p>

  </section>

  <!-- Top Essence Products -->
  <section class="top-essence">
    <div class="title">
      <h1 class="charsAnimation">Top Essence of Kaivera</h1>
      <p class="linesAnimation">
        Discover our signature designer sneakers where tropical soul meets
        timeless luxury.
      </p>
    </div>
    <div class="product-container">

      <?php
      if (isset($topProducts)) {
        foreach ($topProducts as $topProduct) {

      ?>
          <div class="product fade-in">
            <div class="product-image">
              <h1>$<?php echo $topProduct['product_price'] ?></h1>
              <img src="<?php echo $topProduct['product_image'] ?>" alt="" />
              <h2>SOLD <?php echo $topProduct['total_sold'] ?>!!</h2>
            </div>
            <div class="product-content">
              <div class="product-desc">
                <h1><?php echo $topProduct['product_name'] ?></h1>
                <h1><?php echo $topProduct['product_description'] ?></h1>
              </div>
              <a href="products.php">Check Out</a>

            </div>
          </div>


      <?php }
      } ?>


    </div>
  </section>

  <!-- TestimonialSection -->
  <a href="contact.php" class="remove_cursor">
    <section class="testimonial help-target" data-help="Contact Us">
      <div class="testimonial-text">
        <h1 class="linesAnimation">We Value Your Voice</h1>
        <p class="linesAnimation">
          Your thoughts help us grow. Whether its a compliment, suggestion, or
          concern in every piece of feedback guides us toward crafting a
          better Kaivera experience
        </p>
      </div>
      <div class="testimonial-image">
        <div class="image background-parallax"></div>
      </div>
    </section>
  </a>

  <section class="flex items-center justify-center testimonial-content">
    <div class="max-w-7xl w-full mx-auto px-4">
      <div class="text-center mb-16">
        <p class="text-light max-w-1xl mx-auto testimonial-title linesAnimation">
          Hear what our customers say about their experience with our products
          and services.
        </p>
      </div>

      <div class="relative">
        <!-- Navigation Arrows -->
        <button id="prev"
          class="nav-button absolute left-0 top-1/2 -translate-y-1/2 -ml-4 md:-ml-8 z-10 w-12 h-12 rounded-full bg-white shadow-md flex items-center justify-center text-gray-700 hover:text-white">
          <i class="fas fa-chevron-left text-xl"></i>
        </button>
        <button id="next"
          class="nav-button absolute right-0 top-1/2 -translate-y-1/2 -mr-4 md:-mr-8 z-10 w-12 h-12 rounded-full bg-white shadow-md flex items-center justify-center text-gray-700 hover:text-white">
          <i class="fas fa-chevron-right text-xl"></i>
        </button>

        <!-- Carousel Container -->
        <div id="carousel" class="overflow-hidden relative">
          <div id="testimonial-track" class="flex transition-transform duration-500 ease-in-out fade-in">

            <!-- Comment Container -->

            <?php

            $reviews = getReviews();
            if (!empty($reviews)) {
              foreach ($reviews as $review) {
            ?>
                <div class="testimonial-card flex-shrink-0 w-full md:w-1/2 lg:w-1/3 px-4 animate-fade">
                  <div class="testimonial_card_indi p-8 rounded-xl shadow-lg h-full">
                    <div class="flex items-center mb-4">
                      <div class="flex space-x-1 testimonial_star">

                        <?php
                        for ($i = 1; $i <= $review['rating']; $i++) {
                          echo "<i class='fas fa-star'></i>";
                        }
                        ?>
                      </div>
                    </div>
                    <p class="testimonial_comment mb-6 text-base">
                      <?php echo $review['comment'] ?>
                    </p>
                    <div class="flex items-center">
                      <img
                        src="<?php echo htmlspecialchars($review['user_profile_image']) ?>" class="w-14 h-14 rounded-full object-cover mr-4 border-2 border-[#9fc9b7]" />
                      <div>
                        <h4 class="testimonial_name text-normal"><?php echo htmlspecialchars($review['user_name']) ?></h4>
                        <h4 class="testimonial_type text-sm"><?php echo $review['user_type'] ?></h4>
                      </div>
                    </div>
                  </div>
                </div>

            <?php }
            } ?>

          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ Section -->

  <div class="w-screen shadow-xl ring-1 ring-gray-900/5 faq-section">
    <div class="mx-auto px-5">
      <div class="flex flex-col items-center">
        <h2 class="mt-5 text-center text-7xl tracking-tight faq-title">
          FAQ
        </h2>
        <p class="mt-3 text-base text-center faq-desc">
          Your Questions Are Answered Here
        </p>
      </div>
      <div class="mx-auto mt-8 grid w-full divide-y divide-neutral-900 questions">
        <div class="py-5">
          <details class="group">
            <summary class="flex cursor-pointer list-none items-center justify-between font-big text-base">
              <span>How can I browse Kaivera products by category?</span>
              <span class="transition group-open:rotate-180">
                <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24">
                  <path d="M6 9l6 6 6-6"></path>
                </svg>
              </span>
            </summary>
            <p class="group-open:animate-fadeIn mt-3 faq-ans text-sm">
              Simply navigate to the Products page from the main menu. You'll
              see clearly labeled categories such as Dresses, Shirts and Shoes. Click on any category to filter and explore
              relevant items.
            </p>
          </details>
        </div>
        <div class="py-5">
          <details class="group">
            <summary class="flex cursor-pointer list-none items-center justify-between font-big text-base">
              <span>How do I add an item to my cart?</span>
              <span class="transition group-open:rotate-180">
                <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24">
                  <path d="M6 9l6 6 6-6"></path>
                </svg>
              </span>
            </summary>
            <p class="group-open:animate-fadeIn mt-3 faq-ans text-sm">
              On any product page, click the “Add to Cart” after product details button
              beneath the item. The cart icon in the navigation bar will be notified and
              updated instantly, allowing you to check and remove your selected
              products anytime.
            </p>
          </details>
        </div>
        <div class="py-5">
          <details class="group">
            <summary class="flex cursor-pointer list-none items-center justify-between font-big text-base">
              <span>How do I view or edit my cart before purchasing?</span>
              <span class="transition group-open:rotate-180">
                <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24">
                  <path d="M6 9l6 6 6-6"></path>
                </svg>
              </span>
            </summary>
            <p class="group-open:animate-fadeIn mt-3 faq-ans text-sm">
              Click the menu icon at the top right of the page to go to Cart
              Page. You’ll see a full summary of your selected items with the option to remove them before checking out.
            </p>
          </details>
        </div>
        <div class="py-5">
          <details class="group">
            <summary class="flex cursor-pointer list-none items-center justify-between font-big text-base">
              <span>Can I see detailed information about each product?</span>
              <span class="transition group-open:rotate-180">
                <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24">
                  <path d="M6 9l6 6 6-6"></path>
                </svg>
              </span>
            </summary>
            <p class="group-open:animate-fadeIn mt-3 faq-ans text-sm">
              Click on any product image or name to open its dedicated product
              page, which displays the full description, high-resolution
              images, available colors, and price in USD.
            </p>
          </details>
        </div>
        <div class="py-5">
          <details class="group">
            <summary class="flex cursor-pointer list-none items-center justify-between font-big text-base">
              <span>Is the website mobile-friendly and fast to load?</span>
              <span class="transition group-open:rotate-180">
                <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24">
                  <path d="M6 9l6 6 6-6"></path>
                </svg>
              </span>
            </summary>
            <p class="group-open:animate-fadeIn mt-3 faq-ans text-sm">
              Definitely! Kaivera website is built with a responsive design,
              ensuring smooth browsing and functionality across all
              devices—from phones to desktops. Transitions and animations are
              optimized for a luxury and seamless experience.
            </p>
          </details>
        </div>
        <div class="py-5">
          <details class="group">
            <summary class="flex cursor-pointer list-none items-center justify-between font-big text-base">
              <span>How do I navigate the Kaivera website?</span>
              <span class="transition group-open:rotate-180">
                <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24">
                  <path d="M6 9l6 6 6-6"></path>
                </svg>
              </span>
            </summary>
            <p class="group-open:animate-fadeIn mt-3 faq-ans text-sm">
              You can easily move between pages using the top navigation bar.
              Click on Home, Products, Cart, or Contact to access the
              respective sections. Smooth transitions ensure a seamless luxury
              browsing experience.
            </p>
          </details>
        </div>
      </div>
    </div>
  </div>

  <!-- Image Slider Section -->

  <section class="image-slider">
    <!-- Video -->
    <div class="image-slider-video">
      <video src="assets/videos/Aboutusgradient.mp4" id="backgroundVideo" autoplay muted loop playsinline></video>
    </div>

    <!-- Text Section -->
    <div class="image-slider-text help-target" data-help="Scroll !">
      <h1 class="title">Recent Work</h1>
      <div class="text1 text-container">
        <h1>Minimal Form Pop-Up</h1>
        <div class="paragraph">
          <p>
            Our first boutique experience, blending soft lighting, textured
            materials, and calming hues to immerse guests in the world of
            Kaivera
          </p>
        </div>
      </div>
      <div class="text2 text-container">
        <h1>Coastal Muse Lookbook</h1>
        <div class="paragraph">
          <p>
            A visual journey through Kaivera’s Summer Collection shot among
            tropical coastlines to highlight the balance between raw nature
          </p>
        </div>
      </div>
      <div class="text3 text-container">
        <h1>Elements Editorial Series</h1>
        <div class="paragraph">
          <p>
            A lifestyle shoot blending movement, fashion, and
            nature showcasing how Kaivera pieces live effortlessly in everyday
            moments
          </p>
        </div>
      </div>
    </div>

    <!-- Image Scrolling -->
    <div class="image-container-wrapper" id="container">
      <div class="image-strip" id="strip">
        <img src="assets/images/recentWork.jpg" alt="" />
        <img src="assets/images/young-model-fashion-shoot.jpg" alt="" />
        <img src="assets/images/mockup2.webp" alt="" />
      </div>
    </div>
  </section>

  <?php
  require_once("includes/footer.php");
  ?>

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