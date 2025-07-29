<?php
session_start();
require_once("../controllers/functions.php");
require_once("../includes/current_user_data.php");


if (!isset($user_type) || $user_type !== 'user') {
    header("Location: ../home.php");
}

$orders = getOrdersByUserId($user_id);
$reviews = getReviewsByUserId($user_id);
$order_items = getOrderItemsByUserId($user_id);
$user = getSearchUser($user_id);
$wishlists = getWishedProduct($user_id);
$go_to = isset($_GET['to']) ? $_GET['to'] : 'orders';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kaivera Profile</title>
    <link rel="icon" href="../assets/images/kaivera logo icon.png" type="image/png">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/user_tables.css">
    <script src="https://kit.fontawesome.com/69e1242b61.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
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
        <a href="../home.php">
            <h1>Exit</h1><i class="fa-solid fa-right-from-bracket"></i>
        </a>
    </nav>

    <div class="main-content">

        <!-- Information Table -->

        <section id="orders" class="active">
            <div class="heading">
                <h1>User Information</h1>
            </div>
            <div class="user_information">
                <div class="profile_image">
                    <img src="<?php echo $user['user_profile_image'] ?>" alt="">
                </div>
                <div class="info">
                    <h1>Username : <?php echo $user['user_name'] ?></h1>
                    <p>Email : <?php echo $user['user_email'] ?></p>
                    <p>User Type : <?php echo $user['user_type'] ?></p>
                </div>
                <div class="action">
                    <a href="user_update_user.php" class="green_btn">Edit Account</a>
                    <a href="user_delete_user.php" class="red_btn"
                        onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">Delete Account</a>
                </div>
            </div>
            <div class="heading">
                <h1>Your Orders</h1>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr class="bg-[#1a1c20] text-center table-header">
                            <th scope="col" class="px-6 py-3">
                                Order ID
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
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($orders)) {
                            foreach ($orders as $order) {
                        ?>
                                <tr class=" bg-[#c3cfe6] text-gray-800 table_row">
                                    <td class="p-2 md:p-4 text-center"> <?php echo $order['order_id'] ?></td>
                                    <td class="p-2 md:p-4 text-center"> <?php echo $order['order_date'] ?></td>
                                    <td class="p-2 md:p-4 text-center"> <?php echo $order['order_status'] ?></td>
                                    <td class="p-2 md:p-4 text-center">$<?php echo $order['total_price'] ?></td>
                                    <td class="p-2 md:p-4 text-center"><?php echo $order['payment_method'] ?></td>
                                    <td class="p-2 md:p-4 text-center"><?php
                                                                        if ($order['discount_percent'] === null) {
                                                                            echo "No Discounts Used";
                                                                        } else {
                                                                            echo  $order['discount_percent'] . "<span>%</span>";
                                                                        }
                                                                        ?></td>
                                    <td class="relative p-2 md:p-4 action">
                                        <?php
                                        if ($order['order_status'] === "shipped") {
                                        ?>
                                            <a class="red_btn">Already Delivered</a>
                                        <?php     } else {
                                        ?>
                                            <a href="../controllers/delete_user_order.php?id=<?php echo $order['order_id'] ?>" class="red_btn"
                                                onclick="return confirm('Are you sure to delete this order?');">Cancel Order</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php }
                        } else {
                            ?>

                            <tr class=" bg-[#c3cfe6] text-gray-800 table_row">
                                <td class="p-2 md:p-4 text-center">-</td>

                                <td class="p-2 md:p-4 text-center">-</td>
                                <td class="p-2 md:p-4 text-center">-</td>
                                <td class="p-2 md:p-4 text-center">You Havn't Made An Order Yet!</td>
                                <td class="p-2 md:p-4 text-center">-</td>
                                <td class="p-2 md:p-4 text-center">-</td>
                                <td class="p-2 md:p-4 text-center">-</td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="heading">
                <h1>Ordered Items</h1>
            </div>
            <div class="table-wrapper">

                <!-- Classes Table -->
                <div class="relative overflow-auto product_table">
                    <div class="overflow-x-auto">
                        <table>
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
                                if (!empty($order_items)) {
                                    foreach ($order_items as $order_item) {
                                ?>
                                        <tr class=" bg-[#c3cfe6] text-gray-800 table_row">
                                            <td class="p-2 md:p-4 text-center"> <?php echo $order_item['order_item_id'] ?></td>
                                            <td class="p-2 md:p-4 text-center"> <?php echo $order_item['order_id'] ?></td>
                                            <td class="p-2 md:p-4 text-center"> <?php echo $order_item['product_id'] ?></td>
                                            <td class="p-2 md:p-4 text-center"> <?php echo $order_item['product_name'] ?></td>
                                            <td class="p-2 md:p-4 text-center"> <?php echo $order_item['quantity'] ?></td>
                                            <td class="p-2 md:p-4 text-center"> $<?php echo $order_item['price'] ?></td>

                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr class=" bg-[#c3cfe6] text-gray-800 table_row">
                                        <td class="p-2 md:p-4 text-center">-</td>
                                        <td class="p-2 md:p-4 text-center">-</td>
                                        <td class="p-2 md:p-4 text-center">-</td>
                                        <td class="p-2 md:p-4 text-center">-</td>
                                        <td class="p-2 md:p-4 text-center">-</td>
                                        <td class="p-2 md:p-4 text-center">-</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Wishlist -->

            <div class="heading">
                <h1>Wishlist</h1>
            </div>
            <div class="table-wrapper">
                <!-- Classes Table -->
                <div class="relative overflow-auto product_table">
                    <div class="overflow-x-auto">
                        <table>
                            <thead>
                                <tr class="bg-[#1a1c20] text-center table-header">
                                    <th scope="col" class="px-6 py-3">
                                        Wishlist ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product Image
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Added At
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($wishlists)) {
                                    foreach ($wishlists as $wishlist) {
                                ?>
                                        <tr class="bg-[#c3cfe6] text-gray-800 table_row">
                                            <td class="p-2 md:p-4 text-center"> <?php echo $wishlist['wishlist_id'] ?></td>

                                            <td class="p-2 md:p-4 text-center"> <?php echo $wishlist['product_name'] ?></td>
                                            <td class="p-2 md:p-4 text-center product_image_container"> <img src="<?php echo htmlspecialchars($wishlist['product_image']) ?>" alt="" class="product_image">
                                            </td>
                                            <td class="p-2 md:p-4 text-center">$<?php echo $wishlist['added_at'] ?></td>
                                            <td class="action">
                                                <a href="../user/delete_user_wishlist.php?id=<?php echo $wishlist['wishlist_id'] ?>" class="red_btn"
                                                    onclick="return confirm('Are you sure to delete this wishlist?');">Remove Wishlist</a>
                                            </td>
                                        </tr>
                                    <?php }
                                } else {
                                    ?>
                                    <tr class=" bg-[#c3cfe6] text-gray-800 table_row">
                                        <td class="p-2 md:p-4 text-center">-</td>
                                        <td class="p-2 md:p-4 text-center">-</td>
                                        <td class="p-2 md:p-4 text-center">You Haven't Wish Anything Yet</td>
                                        <td class="p-2 md:p-4 text-center">-</td>
                                        <td class="p-2 md:p-4 text-center">-</td>

                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="heading">
                <h1>Your Reviews</h1>
            </div>
            <div class="table-wrapper">

                <!-- Classes Table -->
                <div class="relative overflow-auto product_table">
                    <div class="overflow-x-auto">
                        <table>
                            <thead>
                                <tr class="bg-[#1a1c20] text-center table-header">
                                    <th scope="col" class="px-6 py-3">
                                        Review ID
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
                                if (!empty($reviews)) {
                                    foreach ($reviews as $review) {
                                ?>
                                        <tr class=" bg-[#c3cfe6] text-gray-800 table_row">
                                            <td class="p-2 md:p-4 text-center"> <?php echo $review['review_id'] ?></td>
                                            <td class="p-2 md:p-4 text-center"> <?php echo $review['rating'] ?></td>
                                            <td class="p-2 md:p-4 text-center"> <?php echo $review['comment'] ?></td>
                                            <td class="p-2 md:p-4 text-center"> <?php echo $review['review_date'] ?></td>
                                            <td class="relative p-2 md:p-4 action">
                                                <a href="../controllers/delete_user_review.php?id=<?php echo $review['review_id'] ?>" class="red_btn"
                                                    onclick="return confirm('Are you sure to delete this review?');">Delete</a>
                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr class=" bg-[#c3cfe6] text-gray-800 table_row">
                                        <td class="p-2 md:p-4 text-center">-</td>
                                        <td class="p-2 md:p-4 text-center">-</td>
                                        <td class="p-2 md:p-4 text-center">You Havn't Made A Review Yet</td>
                                        <td class="p-2 md:p-4 text-center">-</td>
                                        <td class="p-2 md:p-4 text-center">-</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>





        </section>



</body>

</html>