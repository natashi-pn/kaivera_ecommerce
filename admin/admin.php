<?php
session_start();
require_once("../controllers/functions.php");
require_once("../includes/current_user_data.php");


if (!isset($user_type) || $user_type !== 'admin') {
    header("Location: ../home.php");
}

$categories = getCategories();
$discounts = getDiscounts();
$messages = getMessages();
$reviews = getReviews();
$go_to = isset($_GET['to']) ? $_GET['to'] : 'admin';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kaivera Dashboard</title>
    <link rel="icon" href="../assets/images/kaivera logo icon.png" type="image/png">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/admin_tables_charts.css">
    <script src="https://kit.fontawesome.com/69e1242b61.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/charts.js" defer></script>

</head>

<body>

    <div class="notification">
        <?php
        if (isset($_SESSION['success'])) {
            echo "<p class='success_msg'><i class='fa-solid fa-circle-check'></i>{$_SESSION['success']}</p>";
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo "<p class= 'error_msg'><i class='fa-solid fa-circle-exclamation'></i>{$_SESSION['error']}</p>";
            unset($_SESSION['error']);
        }
        ?>
    </div>


    <nav class="sidebar">
        <div class="profile">
            <div class="profile_image">
                <img src="<?php echo $user_profile_image ?>" alt="">
            </div>
        </div>
        <a href="#dashboard" class="side_navigation">
            <h1>Dashboard</h1><i class="fa-solid fa-chart-line"></i>
        </a>
        <a href="#orders" class="side_navigation">
            <h1>Orders</h1><i class="fa-solid fa-cart-shopping"></i>
        </a>
        <a href="#order_items" class="side_navigation">
            <h1>Order Items</h1><i class="fa-solid fa-cart-shopping"></i>
        </a>
        <a href="#products" class="side_navigation">
            <h1>Products</h1><i class="fa-solid fa-shirt"></i>
        </a>
        <a href="#users" class="side_navigation">
            <h1>Users</h1><i class="fa-solid fa-user"></i>
        </a>
        <a href="#discounts" class="side_navigation">
            <h1>Discounts</h1><i class="fa-solid fa-percent"></i>
        </a>
        <a href="#reviews" class="side_navigation">
            <h1>Reviews</h1><i class="fa-solid fa-message"></i>
        </a>
        <a href="#messages" class="side_navigation">
            <h1>Messages</h1><i class="fa-solid fa-message"></i>
        </a>
        <a href="../home.php">
            <h1>Exit</h1><i class="fa-solid fa-right-from-bracket"></i>
        </a>
    </nav>

    <div class="main-content">

        <!-- Admin Dashboard -->
        <section id="dashboard" class="<?php echo ($go_to === 'admin') ? 'active' : ''; ?>">
            <div class="heading">
                <h1>Admin Information</h1>
            </div>
            <div class="user_information">
                <div class="profile_image">
                    <img src="<?php echo $user_profile_image ?>" alt="">
                </div>
                <div class="info">
                    <div>
                        <div>
                            <h1><i class="fa-solid fa-user"></i> <?php echo $user_name ?></h1>

                        </div>
                        <div>
                            <p><i class="fa-solid fa-envelope"></i> <?php echo $user_email ?></p>
                        </div>
                        <div>
                            <p><i class="fa-solid fa-phone"></i> <?php echo $user_phone ?></p>
                        </div>
                    </div>
                </div>
                <div class="action">
                    <a href="admin_update_user.php?id=<?php echo $user_id ?>" class="green_btn">Edit Account</a>


                </div>
            </div>
            <div class="heading">
                <h1>Admin Dashboard</h1>

            </div>
            <div class="chart-container">
                <div class="cards">
                    <div class="card">
                        <h1 id="summary-customers"></h1>
                        <p>Number of Customers</p>
                    </div>
                    <div class="card">
                        <h1 id="summary-orders"></h1>
                        <p>Number of Orders</p>
                    </div>
                    <div class="card">
                        <h1 id="summary-reviews"></h1>
                        <p>Number of Reviews</p>
                    </div>
                    <div class="card">
                        <h1 id="summary-products"></h1>
                        <p>Total Products</p>
                    </div>
                    <div class="card">
                        <h1 id="summary-discounts"></h1>
                        <p>Available Discounts</p>
                    </div>
                    <div class="card">
                        <h1 id="summary-sales"></h1>
                        <p>Sales Amount</p>
                    </div>

                </div>
                <div class="charts">
                    <!-- Number of orders per day -->
                    <div class="chart">
                        <h1>Daily Sales (Sun - Sat)</h1>
                        <canvas id="ordersChart"></canvas>
                    </div>

                    <div class="grid-chart">
                        <!-- Number of Orders By Category -->

                        <div class="chart">
                            <h1>Monthly/Yearly Sales</h1>
                            <canvas id="salesChart"></canvas>
                        </div>
                        <div class="chart">
                            <h1>Orders by Category</h1>
                            <canvas id="categoryOrdersChart"></canvas>
                        </div>
                    </div>


                    <div class="grid-chart">

                        <div class="loyal_chart">
                            <!-- Loyal Customers Chart -->
                            <h1>Top 5 Loyal Customers</h1>
                            <div id="loyalCustomersChart"></div>
                        </div>

                        <!-- Payment Methods Usesd By Customers -->
                        <div class="payment_method_chart">
                            <h1>Payment Methods Used</h1>
                            <canvas id="paymentMethodsChart" height="50"></canvas>
                        </div>
                    </div>


                    <div class="chart">
                        <!-- Best Selling Products -->
                        <h1>Top 10 Best Selling Products</h1>
                        <canvas id="bestSellingProductsChart"></canvas>

                    </div>

                </div>

            </div>
        </section>

        <!-- Orders Table -->

        <section id="orders" class="<?php echo ($go_to === 'orders') ? 'active' : ''; ?>">
            <div class="heading">
                <h1>Orders</h1>
                <form action="../controllers/admin_search/admin_search_order.php" method="POST">
                    <input type="text" name="search_username" id="" placeholder="Enter Username">
                    <button type="submit">Search</button>
                </form>
            </div>
            <div class="table">
                <!-- Classes Table -->
                <div class="relative overflow-auto product_table">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr class="bg-[#1a1c20] text-center table-header">
                                    <th scope="col" class="px-6 py-3">
                                        Order ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        User ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Total
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Payment
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Discount
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Address
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                // Conditional Rendering

                                if (!isset($_SESSION['searched_orders'])) {
                                    $orderDetails = getOrders();
                                } else {
                                    $orderDetails = $_SESSION['searched_orders'];
                                    unset($_SESSION['searched_orders']);
                                }

                                foreach ($orderDetails as $order) {
                                ?>
                                    <tr class=" bg-[#dde2ed] text-gray-800 table_row">
                                        <td class="p-2 md:p-4 text-center"> <?php echo $order['order_id'] ?></td>
                                        <td class="p-2 md:p-4 text-center"> <?php echo $order['user_id'] ?></td>
                                        <td class="p-2 md:p-4 "> <?php echo $order['user_name'] ?> </td>
                                        <td class="p-2 md:p-4"> <?php echo $order['order_date'] ?></td>
                                        <td class="p-2 md:p-4"> <?php echo $order['order_status'] ?></td>
                                        <td class="p-2 md:p-4 text-center">$<?php echo $order['total_price'] ?></td>
                                        <td class="p-2 md:p-4 text-center"><?php echo $order['payment_method'] ?></td>
                                        <td class="p-2 md:p-4 text-center"><?php
                                                                            if ($order['discount_percent'] === null) {
                                                                                echo "No Discounts Used";
                                                                            } else {
                                                                                echo  $order['discount_percent'] . "<span>%</span>";
                                                                            }
                                                                            ?></td>
                                        <td class="p-2 md:p-4 text-center"><?php echo $order['order_address'] ?></td>

                                        <td class="relative p-2 md:p-4 action">
                                            <?php if ($order['order_status'] == "shipped") {
                                                echo "<a class='green_btn'><i class='fa-solid fa-circle-check'></i>Delivered!</a>";
                                            } else {
                                            ?>
                                                <a href="../controllers/update_order.php?id=<?php echo $order['order_id'] ?>" class="green_btn"
                                                    onclick="return confirm('Are you sure this order is shipped?');">Set Delivered</a>

                                            <?php } ?>
                                            <a href="../controllers/delete_order.php?id=<?php echo $order['order_id'] ?>" class="red_btn" onclick="return confirm('Are you sure to delete this order ?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <!-- Order Items Section -->

        <section id="order_items" class="<?php echo ($go_to === 'order_items') ? 'active' : ''; ?>">
            <div class="heading">
                <h1>Order Items</h1>
                <form action="../controllers/admin_search/admin_search_order_items.php" method="POST">
                    <input type="text" name="search_username" id="" placeholder="Enter Order ID">
                    <button type="submit">Search</button>
                </form>
            </div>
            <div class="table">

                <!-- Classes Table -->
                <div class="relative overflow-auto product_table">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr class="bg-[#1a1c20] text-center table-header">
                                    <th scope="col" class="px-6 py-3">
                                        Order Item ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Order ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Quantity
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php

                                // Conditional Rendering

                                if (!isset($_SESSION['searched_order_items'])) {
                                    $order_items = getOrderItems();
                                } else {
                                    $order_items = $_SESSION['searched_order_items'];
                                    unset($_SESSION['searched_order_items']);
                                }
                                foreach ($order_items as $order_item) {
                                ?>
                                    <tr class=" bg-[#dde2ed] text-gray-800 table_row">
                                        <td class="p-2 md:p-4 text-center"> <?php echo $order_item['order_item_id'] ?></td>
                                        <td class="p-2 md:p-4 text-center"> <?php echo $order_item['order_id'] ?></td>
                                        <td class="p-2 md:p-4 text-center"> <?php echo $order_item['product_id'] ?></td>
                                        <td class="p-2 md:p-4 text-center"> <?php echo $order_item['product_name'] ?></td>
                                        <td class="p-2 md:p-4 text-center"> <?php echo $order_item['quantity'] ?></td>
                                        <td class="p-2 md:p-4 text-center"> $<?php echo $order_item['price'] ?></td>

                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>


        <!-- Product Section -->
        <?php
        $active = "";
        if (isset($go_to) == 'products') {
            $active = "active";
        }
        ?>
        <section id="products" class="<?php echo ($go_to === 'products') ? 'active' : ''; ?>">
            <div class="heading">
                <h1>Products</h1>
                <form action="../controllers/admin_search/admin_search_product.php" method="POST">
                    <input type="text" name="search" id="" placeholder="Enter Product Name">
                    <button type="submit">Search</button>
                </form>
                <div class="add_btn">
                    <a href="admin_insert_product.php">+ Add New Product</a>
                </div>
            </div>
            <div class="table">

                <!-- Classes Table -->
                <div class="relative overflow-auto product_table">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr class="bg-[#1a1c20] text-center table-header">
                                    <th scope="col" class="px-6 py-3">
                                        Product ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product Description
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product Image
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Created At
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php

                                // Conditional Rendering

                                if (!isset($_SESSION['searched_products'])) {
                                    $products = getProducts();
                                } else {
                                    $products = $_SESSION['searched_products'];
                                    unset($_SESSION['searched_products']);
                                }
                                foreach ($products as $product) {
                                ?>
                                    <tr class=" bg-[#dde2ed] text-gray-800 table_row">
                                        <td class="p-2 md:p-4 text-center"> <?php echo $product['product_id'] ?></td>
                                        <td class="p-2 md:p-4"> <?php echo $product['product_name'] ?></td>
                                        <td class="p-2 md:p-4"> <?php echo $product['product_description'] ?></td>
                                        <td class="p-2 md:p-4 text-center"> $<?php echo $product['product_price'] ?></td>
                                        <td class="p-2 md:p-4 text-center w-[100px]">
                                            <div class="flex justify-center items-center">
                                                <img
                                                    src="<?php echo htmlspecialchars($product['product_image']) ?>"
                                                    alt="Product Image"
                                                    class="max-w-[80px] max-h-[80px] object-contain">
                                            </div>
                                        </td>
                                        <td class="p-2 md:p-4 text-center"> <?php

                                                                            foreach ($categories as $category) {
                                                                                $categoryName = ($category['category_id'] == $product['category_id']) ? $category['category_name'] : '';
                                                                                echo $categoryName;
                                                                            }
                                                                            ?></td>
                                        <td class="p-2 md:p-4 text-center"><?php echo $product['created_at'] ?></td>
                                        <td class="action relative top-[15px]">
                                            <a href="admin_update_product.php?id=<?php echo $product['product_id'] ?>" class="green_btn">Edit</a>
                                            <a href="../controllers/delete_product.php?id=<?php echo $product['product_id'] ?>" class="red_btn" onclick="return confirm('Are you sure to delete this product?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <!-- Users Table -->


        <section id="users" class="<?php echo ($go_to === 'users') ? 'active' : ''; ?>">
            <div class="heading">
                <h1>Users</h1>
                <form action="../controllers/admin_search/admin_search_user.php" method="POST">
                    <input type="text" name="search" id="" placeholder="Enter Username">
                    <button type="submit">Search</button>
                </form>
                <div class="add_btn">
                    <a href="admin_insert_user.php">+ Add New User</a>
                </div>
            </div>
            <div class="table">
                <!-- Classes Table -->
                <div class="relative overflow-auto product_table">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr class="bg-[#1a1c20] text-center table-header">
                                    <th scope="col" class="px-6 py-3">
                                        User ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        User Profile Image
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        User Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        User Email
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        User Phone
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        User Type
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Created At
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                // Conditional Rendering

                                if (!isset($_SESSION['searched_users'])) {
                                    $users = getUsersDesc();
                                } else {
                                    $users = $_SESSION['searched_users'];
                                    unset($_SESSION['searched_users']);
                                }
                                foreach ($users as $user) {
                                ?>
                                    <tr class=" bg-[#dde2ed] text-gray-800 table_row">
                                        <td class="p-2 md:p-4 text-center"> <?php echo $user['user_id'] ?></td>
                                        <td class="text-center profile_image_container relative top-[15px]"> <img src="<?php echo htmlspecialchars($user['user_profile_image']) ?>" alt="" style="width: 40px; height: 40px; object-fit: cover; border-radius : 50%;">
                                        </td>
                                        <td class="p-2 md:p-4 text-center"> <?php echo $user['user_name'] ?></td>
                                        <td class="p-2 md:p-4 text-center"> <?php echo $user['user_email'] ?></td>


                                        <td class="p-2 md:p-4 text-center"><?php echo $user['user_phone'] ?></td>
                                        <td class="p-2 md:p-4 text-center"><?php echo $user['user_type'] ?></td>
                                        <td class="p-2 md:p-4 text-center"><?php echo $user['created_at'] ?></td>



                                        <td class="action relative bottom-[20px]">
                                            <a href="admin_update_user.php?id=<?php echo $user['user_id'] ?>" class="green_btn">Edit</a>
                                            <a href="../controllers/delete_user.php?id=<?php echo $user['user_id'] ?>" class="red_btn" onclick="return confirm('Are you sure to delete this user?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>


        <!-- Reviews Table -->

        <section id="reviews" class="<?php echo ($go_to === 'reviews') ? 'active' : ''; ?>">
            <div class="heading">
                <h1>Reviews</h1>
            </div>
            <div class="table">

                <!-- Classes Table -->
                <div class="relative overflow-auto product_table">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr class="bg-[#1a1c20] text-center table-header">
                                    <th scope="col" class="px-6 py-3">
                                        Review ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        User ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Username
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Rating
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Comment/Feedback
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Reviewed Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php

                                foreach ($reviews as $review) {
                                ?>
                                    <tr class=" bg-[#dde2ed] text-gray-800 table_row">
                                        <td class="p-2 md:p-4 text-center"> <?php echo $review['review_id'] ?></td>
                                        <td class="p-2 md:p-4 text-center"> <?php echo $review['user_id'] ?></td>
                                        <td class="p-2 md:p-4 text-center"> <?php echo $review['user_name'] ?></td>
                                        <td class="p-2 md:p-4 text-center"> <?php echo $review['rating'] ?></td>
                                        <td class="p-2 md:p-4 text-center"> <?php echo $review['comment'] ?></td>
                                        <td class="p-2 md:p-4 text-center"> <?php echo $review['review_date'] ?></td>
                                        <td class="relative p-2 md:p-4 action">
                                            <a href="../controllers/delete_review.php?id=<?php echo $review['review_id'] ?>" class="red_btn" onclick="return confirm('Are you sure to delete this review?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <!-- Discounts Table -->
        <?php
        $active = "";
        if (isset($go_to) == 'discounts') {
            $active = "active";
        }
        ?>
        <section id="discounts" class="<?php echo ($go_to === 'discounts') ? 'active' : ''; ?>">
            <div class="heading">
                <h1>Discount</h1>
                <form action="../controllers/insert_discount.php" method="POST">
                    <input type="text" name="code" id="" placeholder="Enter Disocunt Code">
                    <input type="number" name="percent" id="" placeholder="Enter Percentage">
                    <button type="submit">+ Add</button>
                </form>
            </div>
            <div class="table">
                <!-- Classes Table -->
                <div class="relative overflow-auto product_table">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr class="bg-[#1a1c20] text-center table-header">
                                    <th scope="col" class="px-6 py-3">
                                        Discount ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Discount Code
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Discount Percent
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                foreach ($discounts as $discount) {
                                ?>
                                    <tr class=" bg-[#dde2ed] text-gray-800 table_row">
                                        <td class="p-2 md:p-4 text-center"> <?php echo $discount['discount_id'] ?></td>
                                        <td class="p-2 md:p-4 text-center"><?php echo $discount['discount_code'] ?></td>
                                        <td class="p-2 md:p-4 text-center"><?php echo $discount['discount_percent'] ?></td>
                                        <td class="relative p-2 md:p-4 action ">
                                            <a href="../controllers/delete_discount.php?id=<?php echo $discount['discount_id'] ?>" class="red_btn" onclick="return confirm('Are you sure to delete this discount?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <?php
        $active = "";
        if (isset($go_to) == 'messages') {
            $active = "active";
        }
        ?>
        <!-- Messages Table -->
        <section id="messages" class="<?php echo ($go_to === 'messages') ? 'active' : ''; ?>">
            <div class="heading">
                <h1>Messages from Users</h1>
                <p>This is Messages From Guest/Users Directly to the Company</p>
            </div>
            <div class="table">
                <!-- Classes Table -->
                <div class="relative overflow-auto product_table">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr class="bg-[#1a1c20] text-center table-header">
                                    <th scope="col" class="px-6 py-3">
                                        Message ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Phone
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Company
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Message
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Messaged At
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                foreach ($messages as $message) {
                                ?>
                                    <tr class=" bg-[#dde2ed] text-gray-800 table_row">
                                        <td class="p-2 md:p-4 text-center"> <?php echo $message['message_id'] ?></td>
                                        <td class="p-2 md:p-4 text-center"> <?php echo $message['name'] ?></td>
                                        <td class="p-2 md:p-4 "> <?php echo $message['phone'] ?> </td>
                                        <td class="p-2 md:p-4"> <?php echo $message['email'] ?></td>
                                        <td class="p-2 md:p-4"> <?php echo $message['company'] ?></td>
                                        <td class="p-2 md:p-4 text-center"><?php echo $message['message'] ?></td>
                                        <td class="p-2 md:p-4 text-center"><?php echo $message['messaged_at'] ?></td>

                                        <td class="relative p-2 md:p-4 action">
                                            <a href="../controllers/delete_message.php?id=<?php echo $message['message_id'] ?>" class="red_btn"
                                                onclick="return confirm('Are you sure to delete this message?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</body>

</html>