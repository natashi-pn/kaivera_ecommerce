<?php
session_start();

require_once("includes/current_user_data.php");
$isLoggedIn = isset($_SESSION['user_data']['user_type']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Kaivera Contact</title>
  <link rel="icon" href="assets/images/kaivera logo icon.png" type="image/png">
  <link rel="stylesheet" href="css/style.css" />
  <script src="https://kit.fontawesome.com/69e1242b61.js" crossorigin="anonymous"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="js/script.js" defer></script>
</head>

<body data-page="contact">
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
  <!-- Navigation ends -->

  <!-- Help Bubble -->
  <div class="help-bubble"></div>
  <div class="notification"></div>

  <div class="fade-overlay"></div>

  <main>


    <!-- First Contact Section -->

    <section class="contact-container">
      <div class="left-section">
        <div class="text-container introLineAnimation">
          <h1>Let Your</h1>
          <h1>World</h1>
          <h1>With <i class="fa-solid fa-arrow-up"></i></h1>
          <h1><span>Kaivera</span></h1>
          <h1>Start</h1>
        </div>
      </div>
      <div class="right-section">
        <div class="contact-text help-target" data-help="Our Goal">
          <div class="contact-row">
            <h1>We’re Here for You</h1>
            <p>
              Whether you have a question about our products or want assistance
              with your order, our team is ready to support you.
            </p>
          </div>
          <div class="contact-row">
            <h1>Personalized Support</h1>
            <p>
              Our customer care team is dedicated to providing
              assistance with patience and precision.
            </p>
          </div>
          <div class="contact-row">
            <h1>Connect with Kaivera</h1>
            <p>
              Feel free to reach out through our contact form, email, or social
              platforms.
            </p>
          </div>
        </div>
        <div class="contact-form">
          <?php

          if (isset($_SESSION['success'])) {
            echo "<p style='color:rgb(201, 159, 178); margin : 10px 0'>{$_SESSION['success']}</p>";
            unset($_SESSION['success']);
          }
          if (isset($_SESSION['error'])) {
            echo "<p style='color: rgb(102, 214, 121); margin : 10px 0'>{$_SESSION['error']}</p>";
            unset($_SESSION['error']);
          }

          ?>
          <h1>Rate and Review</h1>
          <p>Give Us A Honest Feedback On Our Performance So Far</p>

          <form method="POST" id="ratingForm">
            <div class="radio-field">
              <input type="radio" name="rating" id="rating1" value="5" />
              <label for="rating1" class="fa-solid fa-star"></label>

              <input type="radio" name="rating" id="rating2" value="4" />
              <label for="rating2" class="fa-solid fa-star"></label>

              <input type="radio" name="rating" id="rating3" value="3" />
              <label for="rating3" class="fa-solid fa-star"></label>

              <input type="radio" name="rating" id="rating4" value="2" />
              <label for="rating4" class="fa-solid fa-star"></label>

              <input type="radio" name="rating" id="rating5" value="1" />
              <label for="rating5" class="fa-solid fa-star"></label>
            </div>
            <div class="input-field text">
              <label for="commentId">Write Comment</label>
              <textarea name="comment" id="commentId"></textarea>
            </div>
            <div class="input-btns">
              <input type="submit" class="btn" value="Submit" <?php if (!$isLoggedIn) echo 'disabled' ?> />
              <input type="reset" class="btn" value="Refresh" <?php if (!$isLoggedIn) echo 'disabled' ?> />
            </div>
          </form>
          <?php if (!$isLoggedIn) { ?>
            <div class="links">
              <p>Doesn't have an account ? <a href="signup.php">Sign Up</a></p>
              <p>Already have an account ? <a href="signup.php?form=login">Login</a></p>
            </div>
          <?php } ?>
        </div>

        <div class="contact-info">
          <div class="contact-info-row">
            <h1 class="linesAnimation">Email</h1>
            <p class="linesAnimation" style="color: #90bbc5">
              support@kaivera. com
            </p>
          </div>
          <div class="contact-info-row">
            <h1 class="linesAnimation">Phone</h1>
            <p class="linesAnimation">+44 20 7946 0123</p>
          </div>
          <div class="contact-info-row">
            <h1 class="linesAnimation">Hours</h1>
            <p class="linesAnimation">
              Monday to Friday, 9:00 AM – 6:00 PM (GMT)
            </p>
          </div>
          <div class="contact-info-row">
            <h1 class="linesAnimation">Kaivera Studio Address</h1>
            <p class="linesAnimation">
              Kaivera Ltd. 12 Belmont Street, London, NW1 8HH, United Kingdom
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="contact_us">
      <div class="contact_us_title">
        <h1>Contact Us Directly!</h1>
        <p>Send Us Your Ideas And Messages To The Kaivera Team Directly Here</p>
      </div>

      <div class="contact_us_form">
        <form method="POST" id="message_form">
          <div class="input_container">
            <div class="left">
              <div class="field">
                <label for="name1">Name</label>
                <input type="text" name="name" id="name1" placeholder="Your Name" />
              </div>
              <div class="field">
                <label for="phone1">Phone</label>
                <input type="number" name="phone" id="phone1" placeholder="Your Phone Number" />
              </div>
            </div>
            <div class="right">
              <div class="field">
                <label for="email1">Email</label>
                <input type="email" name="email" id="email1" placeholder="Your Email Address" />
              </div>
              <div class="field">
                <label for="company1">Org/Company</label>
                <input type="text" name="company" id="company1" placeholder="Organization/Company" />
              </div>
            </div>
          </div>
          <div class="textarea_container">
            <label for="message1">Message</label>
            <textarea name="message" id="message1" placeholder="Message Here"></textarea>
          </div>
          <div class="input_buttons">
            <button type="button" id="message_btn">Submit</button>
            <input type="reset" value="Reset" />
          </div>
        </form>
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