Discount codes to test
                      A8F3K9L2,
                      Z7C2M4B8,
                      X1N8T6Q4,
                      D3H5P7V9,
                      R9E4L6T2,
                      abc


//Features//

User Authentication & Access Control
  •	Role-Based Navigation
      o	Admin: Access to admin-specific navigation and dashboard.
      o	User: Access to user-specific features and profile.
      o	Guest: Limited access with default navigation before login.
      •	Access Restrictions
      o	Guests cannot purchase products, submit reviews, or send feedback until they log in.

-----------------------------------------------------------------------------------------

E-Commerce Core Features
  •	Live Product Search
      o	Real-time product search using AJAX without page reload.
      o	Product navigation bar is disabled during search for a cleaner UI experience.
  •	Add to Cart (AJAX)
      o	Add products to cart without page refresh.
      o	Includes an extra button for quick access to the cart.
  •	Wishlist Functionality (AJAX)
      o	Add/remove products from wish list instantly.
      o	Wishlist appears in a side panel popup for quick access.
  •	Voucher/Discount System
      o	Users can apply discount codes during checkout to receive price reductions.  
  •	Order Receipt System
      o	After a successful payment, users see a popup receipt.
      o	Receipts can be downloaded as PNG images.
      o	Double-clicking the receipt closes the popup.

-----------------------------------------------------------------------------------------

Ratings & Feedback
  •	Submit Feedback Without Refresh
      o	Users can rate and leave comments on the contact page via AJAX.
  •	Dynamic Display of Feedback
      o	Ratings and user feedback are updated live on the Home and About pages without reload.
  •	Review Management
      o	Users can view their submitted reviews from their profile.
      o	Admins can manage and moderate all product reviews from the dashboard.

-----------------------------------------------------------------------------------------

User & Admin Profiles
  •	User Profile
o	View order history with cancellation available for orders not yet shipped.
o	Manage wish list and personal reviews.
o	Edit username and profile picture.
  •	Admin Profile
      o	Access to an admin dashboard.
      o	Manage CRUD operations for:
                                  Orders
                                  Users
                                  Discounts
                                  Products
                                  Reviews
                                  Messages
      o	View top-selling products and overall store analytics.

-----------------------------------------------------------------------------------------
      
Analytics & Highlights
  •	Top 4 Best-Selling Products:
      o	Displayed prominently on the homepage under “Top Essences of Kaivera.”

-----------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------


Development Process Documentation

27/6/2025 (New Icons on Navigation)

- Added new icons and Designed buttons on navigation for both user and admin (profile, cart, wishlist, admin)

-----------------------------------------------------------------------------------------

28/6/2025 (Review and Rating)

- Made a review and rating from users to display on the home page and about page with PHP.

-----------------------------------------------------------------------------------------

29/6/2025 (Product Detail)

- Designed a whole product detail pop up feature with CSS which took a whole day.

-----------------------------------------------------------------------------------------

30/6/2025 (Product Detail AJAX)

- Made a product detail popup section pass the required data with the loop from products database.
- Made buttons to not submit and refresh the page with AJAX.
- Added New button Add + Go to cart to make easier to add the product to cart while going there at the same time.

-----------------------------------------------------------------------------------------

1/7/2025 (Review and Rating AJAX)

- Made a review and rating from users and displaying on website real-time with AJAX which does not require a whole page
refresh (better UX)

-----------------------------------------------------------------------------------------

2/7/2025 (Receipt Card)

- Designed a receipt card using CSS along with PHP to pass the order data from Database.

-----------------------------------------------------------------------------------------

3/7/2025 (Fixed Logical Errors)

- Fixed the problem of the payment method and total_price not being passed to the order.php well.

-----------------------------------------------------------------------------------------

4/7/2025 (New Intro Loader Animation)

- Designed and animated a new loader animation for KAIVERA with GSAP, was hard.

-----------------------------------------------------------------------------------------

5/7/2025 (Wishlist Frontend + Backend)

- Made a wishlist feature for every products such as connecting with database etc.
- Designed a wishlist section with css while adding some animations with GSAP.

-----------------------------------------------------------------------------------------

6/7/2025 (WishList with AJAX)

- Made everything related to WishList feature with AJAX to improve UI UX, it now add and remove to the database 
and the WishList section in real-time.

-----------------------------------------------------------------------------------------

7/7/2025 (Add To Cart Red Dot Notification)

- Made a better UX feature when a user add something to cart, the alert notification (red dot) 
appears on the cart icon which stays across the navigation of pages but only 
when user goes to cart the red dot disappears.

-----------------------------------------------------------------------------------------

8/7/2025 (New Features)

- Admin dashboard is now available with the tables such as Orders, Products, Users, Reviews
- Added new sections to the home page.
- Added hopefully better transition with View Transitions API.

-----------------------------------------------------------------------------------------

9/7/2025 (Alert Notification Design)

- Added a new alert notification instead of the alert box on javascript.
- Made a empty div in the pages with the class name of notification.
- Grabbed that div and used it inside function called showNotification on top of javascipt for reusability.
- showNotification function displays the injected html tags such as p tags, i tags passed from the echo PHP backend.

-----------------------------------------------------------------------------------------

10/7/2025 (Admin Profile)

- Completed everything about admin tables such as discounts, reviews, messages except the admin dashboard.

-----------------------------------------------------------------------------------------

11/7/2025 (User Profile)

- Designed Everything in User profile from scratch and implemented a dynamic tables and order manipulations.
- Searching error is fixed when new html is injected via javascript AJAX.

-----------------------------------------------------------------------------------------

12/7/2025 (Fixed Wishlist, Admin Dashboard Cards)

- Fixed several issues such as removing wishlist is not working on all the pages, it was solved by rebinding all the event listeners in the global script.
- Fixed another issues that the tables from both users and admin profiles aren't responsive like the scroll bars not appearing individually.
- Added 6 cards that show different types of incomes, numbers for the KAIVERA page in the admin dashboard.

-----------------------------------------------------------------------------------------

13/7/2025 (Passoword Validation & JS fixes)

- Added validations for passwords like at least One capital letter, a number and at least 8 characters long (with regex)
- I just realized that the wishlist feature doesn't work after the search products (live html injections), so i had to rebind all the event listeners from
 wishlist ajax to the search ajax.

-----------------------------------------------------------------------------------------

14/7/2025 (Reset Password Feature)

- Added a reset password if the user has forgetten feature and at the same time, deployed it on InfinityFree !
