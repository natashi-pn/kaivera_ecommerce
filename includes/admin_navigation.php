 <?php

    require_once 'current_user_data.php';
    ?>

 <!-- Navigation -->
 <section class="navigation-btn">
     <div class="nav-logo">
         <img src="assets/images/kaivera logo.png" id="logo" alt="" />
     </div>
     <div class="nav-menu-middle">
         <div class="btn_wrapper hide_nav">
             <a href="products.php">Products</a>
         </div>
         <div class="btn_wrapper hide_nav">
             <a href="about.php">About</a>
         </div>
         <div class="btn_wrapper hide_nav">
             <a href="contact.php">Contact</a>
         </div>

     </div>
     <div class="nav-menu">
         <div class="btn_wrapper help-target-img" data-help-img="<?php echo htmlspecialchars($user_profile_image) ?>">
             <a href="admin/admin.php"><i class="fa-solid fa-screwdriver-wrench"></i></a>
         </div>
         <div class="nav-btn">
         </div>
     </div>
 </section>

 <section class="navigation">
     <div class="navigation_container">
         <div class="left">
             <ul>
                 <li>
                     <div class="invert"></div>
                     <a href="../home.php" class="nav-link navigation_links">HOME</a>
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



 <!-- Navigation ends -->