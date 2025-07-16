
<?php
session_start();

require_once "dbconn.php";
require_once "functions.php";
$discounts = getDiscounts();

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $code = $_POST['code'];
    $percent = $_POST['percent'];

    if (empty($percent)) {
        $_SESSION['error'] = "All Fields Are Required";
        header("Location: ../admin/admin.php?to=discounts");
        exit;
    }
    if ($code === "") {
        $code = null;
    }

    foreach ($discounts as $discount) {
        if ($discount['discount_code'] === $code) {
            $_SESSION['error'] = "Discount Code Already Exists";
            header("Location: ../admin/admin.php?to=discounts");
            exit;
        }
    }

    if ($percent >= 100) {
        $_SESSION['error'] = "Discount Cant Be More Than 100%";
        header("Location: ../admin/admin.php?to=discounts");
        exit;
    }

    $sql = "insert into discounts values (?, ?, ?)";
    $stmt =   $conn->prepare($sql);
    $status = $stmt->execute([null, $code, $percent]);


    if ($status) {
        $_SESSION['success'] = "New Discount " . $percent . "% Is Added";
    } else {
        $_SESSION['error'] = "Cant Add New Discount";
    }
    header("Location: ../admin/admin.php?to=discounts");
} else {
    header("Location: ../admin/admin.php?to=discounts");
}
