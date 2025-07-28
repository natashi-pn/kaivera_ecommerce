<?php


require_once("dbconn.php");

function getCategories()
{
    global $conn;
    $Query = "Select * from categories;";
    $stmt = $conn->prepare($Query);
    $stmt->execute();

    $categories =  $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $categories;
}


function getProducts()
{
    global $conn;
    $Query = "Select * from products;";
    $stmt = $conn->prepare($Query);
    $stmt->execute();

    $products =  $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $products;
}

function getSearchProducts($product_id)
{
    global $conn;
    $Query = "Select * from products where product_id = ?;";
    $stmt = $conn->prepare($Query);
    $stmt->execute([$product_id]);

    $searchProducts =  $stmt->fetch(PDO::FETCH_ASSOC);

    return $searchProducts;
}
function getProductsByCategory($category_id)
{
    global $conn;
    $Query = "Select * from products where category_id = ?;";
    $stmt = $conn->prepare($Query);
    $stmt->execute([$category_id]);

    $productsByCategory =  $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $productsByCategory;
}

function getUsers()
{
    global $conn;
    $Query = "Select * from users;";
    $stmt = $conn->prepare($Query);
    $stmt->execute();

    $users =  $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $users;
}

function getUsersDesc()
{
    global $conn;
    $Query = "Select * from users ORDER BY 
    created_at DESC;";
    $stmt = $conn->prepare($Query);
    $stmt->execute();

    $users =  $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $users;
}

function getSearchUser($user_id)
{
    global $conn;
    $query = "SELECT * FROM users where user_id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->execute([$user_id]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user;
}

function getUserType($user_email)
{
    global $conn;
    $query = "SELECT * from users where user_email = ?;";
    $stmt = $conn->prepare($query);
    $stmt->execute([$user_email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function getReviews()
{
    global $conn;
    $query = "SELECT reviews.review_id,
    reviews.rating,
    reviews.comment,
    reviews.review_date,
    users.user_id,
    users.user_name,
    users.user_email,
    users.user_type,
    users.user_profile_image FROM reviews JOIN users ON reviews.user_id = users.user_id ORDER BY 
    reviews.review_date DESC;";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $reviews;
}


function getDiscount($discount_code)
{
    global $conn;
    $query = "SELECT * FROM discounts where discount_code = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$discount_code]);

    $discount = $stmt->fetch(PDO::FETCH_ASSOC);
    return $discount;
}

function getOrderDetails($order_id)
{
    global $conn;

    $query =  "SELECT 
    o.*, 
    oi.product_id, 
    oi.product_name, 
    oi.quantity, 
    oi.price,
    u.user_name, 
    u.user_email,
    d.discount_code,
    d.discount_percent
FROM orders o
JOIN order_items oi ON o.order_id = oi.order_id
JOIN users u ON o.user_id = u.user_id
LEFT JOIN discounts d ON o.discount_id = d.discount_id
WHERE o.order_id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->execute([$order_id]);

    $order_details = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $order_details;
}


function getWishList($user_id)
{
    global $conn;

    $query = "SELECT product_id from wishlist where user_id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->execute([$user_id]);

    $wishlist = $stmt->fetchAll(PDO::FETCH_COLUMN);

    return $wishlist;
}

function getWishedProduct($user_id)
{
    global $conn;

    $query = "SELECT * FROM wishlist w JOIN products p ON w.product_id = p.product_id WHERE w.user_id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->execute([$user_id]);

    $wishedProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $wishedProducts;
}

function getOrders()
{
    global $conn;

    $query =  "SELECT 
    o.*, 
    u.user_name, 
    d.discount_code,
    d.discount_percent
FROM orders o
JOIN users u ON o.user_id = u.user_id
LEFT JOIN discounts d ON o.discount_id = d.discount_id ORDER BY o.order_date DESC;";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $order = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $order;
}
function getOrderItems()
{
    global $conn;

    $query =  "SELECT * FROM order_items ORDER BY order_id DESC;";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $order_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $order_items;
}



function getDiscounts()
{
    global $conn;

    $query = "SELECT * FROM discounts;";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $discounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $discounts;
}


function getMessages()
{
    global $conn;

    $query = "SELECT * FROM messages;";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $messages;
}

function getOrdersByUserId($user_id)
{
    global $conn;

    $query = "SELECT 
    o.*, 
    u.user_name, 
    d.discount_code,
    d.discount_percent
FROM orders o
JOIN users u ON o.user_id = u.user_id
LEFT JOIN discounts d ON o.discount_id = d.discount_id 
WHERE o.user_id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->execute([$user_id]);

    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $orders;
}

function getReviewsByUserId($user_id)
{
    global $conn;
    $query = "SELECT 
    reviews.review_id,
    reviews.rating,
    reviews.comment,
    reviews.review_date,
    users.user_id,
    users.user_name,
    users.user_email,
    users.user_profile_image
FROM reviews 
JOIN users ON reviews.user_id = users.user_id 
WHERE reviews.user_id = ?
ORDER BY reviews.review_date DESC;
";
    $stmt = $conn->prepare($query);
    $stmt->execute([$user_id]);

    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $reviews;
}

function getOrderItemsByUserId($user_id)
{
    global $conn;

    $query =  "SELECT order_items.*
FROM order_items
JOIN orders ON order_items.order_id = orders.order_id
WHERE orders.user_id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->execute([$user_id]);

    $order_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $order_items;
}

function getTopProducts()
{
    global $conn;
    $query = "SELECT p.*,
        SUM(oi.quantity) AS total_sold
        FROM order_items oi
        JOIN products p ON oi.product_id = p.product_id
        GROUP BY p.product_name
        ORDER BY total_sold DESC
        LIMIT 4;";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $topProducts = $stmt->fetchAll();

    return $topProducts;
}

function validatePassword($password)
{
    return preg_match(
        '/^(?=.*[A-Z])(?=.*\d).{8,}$/',
        $password
    );
}
