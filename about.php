<?php
session_start();

require_once("includes/current_user_data.php");
require_once("controllers/functions.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Kaivera About</title>
  <link rel="icon" href="assets/images/kaivera logo icon.png" type="image/png">
  <link rel="stylesheet" href="css/style.css" />
  <script src="https://kit.fontawesome.com/69e1242b61.js" crossorigin="anonymous"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="js/script.js" defer></script>
</head>

<body data-page="about">

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

  <div class="fade-overlay"></div>

  <main>

    <!-- Help Bubble -->
    <div class="help-bubble"></div>
    <div class="notification"></div>

    <!-- Header Section -->
    <section class="header">
      <div class="background-video">
        <div class="spinner" id="spinner">
          <div class="absolute top-0 right-0 h-screen w-screen z-50 flex justify-center items-center">
            <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2"></div>
          </div>
        </div>
        <video src="assets/videos/Gradientblue.webm" id="header_video" preload="auto" autoplay muted loop playsinline></video>
      </div>
      <div class="header-content">
        <div class="header-links">
          <a href="home.php">Home</a>
          <span>•</span>
          <a href="about.php">About</a>
        </div>
        <div class="title">
          <div class="text-wrapper">
            <h1 class="introLineAnimation">
              Rooted in Nature Refined by Design
            </h1>
          </div>
        </div>
        <div class="desc">
          <div class="para-wrapper">
            <p class="introLineAnimation">
              Kaivera is a reflection of slow, intentional living where every
              piece tells a story of elegance drawn from the earth. With
              inspiration from tropical landscapes and a passion for timeless
              minimalism
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="about-btn">
      <a href="contact.php">Contact Us</a>
      <a href="products.php">Explore Work</a>
    </section>

    <section class="about-content">
      <div class="about-video">

        <video src="assets/videos/Aboutus.mp4" muted loop autoplay playsinline preload="none"></video>
      </div>

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

      <div class="about-secondSection">
        <div class="image">
          <img src="assets/images/dressSketch.webp" class="animateImage1" alt="" />
        </div>
        <div class="content">
          <h1 class="scrollLine">Crafted for the Bold</h1>
          <p class="scrollLine">
            At Kaivera, we blend tropical elegance with modern luxury designing
            statement pieces that turn moments into memories.
          </p>
        </div>
      </div>
      <div class="about-thirdSection">
        <div class="content">
          <h1 class="scrollLine">Luxury in Every Detail</h1>
          <p class="scrollLine">
            Born where deep green forests meet ocean breeze, Kaivera creates
            premium fashion inspired by nature’s serenity and strength.
          </p>
        </div>
        <div class="image">
          <img src="assets/images/mockup2.webp" class="animateImage2" alt="" />
        </div>
      </div>
    </section>

    <!-- About us Section -->
    <section class="about-us">
      <div class="container">
        <div class="wrapper">
          <p class="linesAnimation">
            Kaivera blends timeless design with the quiet elegance of nature
            offering a refined lifestyle rooted in quality. Each
            piece whether worn or carried is a reflection of subtle luxury. We invites you to step into a world
            where beauty feels effortless.
          </p>

          <a href="products.php">Check Out Now</a>
        </div>
      </div>

      <div class="content-container" id="content-container">
        <div class="content">
          <div class="content-title">
            <h1 class="linesAnimation">01</h1>
            <h1 class="linesAnimation">ElEGANT</h1>
          </div>
          <div class="content-desc">
            <p class="linesAnimation">
              A refined fusion of minimalist aesthetics sophistication in every detail.
            </p>
          </div>
        </div>
        <div class="content">
          <div class="content-title">
            <h1 class="linesAnimation">02</h1>
            <h1 class="linesAnimation">TROPICAL</h1>
          </div>
          <div class="content-desc">
            <p class="linesAnimation">
              Infused with the spirit of lush jungles and effortless beauty.
            </p>
          </div>
        </div>
        <div class="content">
          <div class="content-title">
            <h1 class="linesAnimation">03</h1>
            <h1 class="linesAnimation">TIMELESS</h1>
          </div>
          <div class="content-desc">
            <p class="linesAnimation">
              Designed beyond the constraints of trends quality and
              confidence.
            </p>
          </div>
        </div>
      </div>
    </section>


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
          <img src="assets/images/recentWork2.jpg" alt="" />
        </div>
      </div>
    </section>


    <?php
    require_once("includes/footer.php");
    ?>
  </main>



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