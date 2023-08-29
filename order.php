<?php
ob_start();
// include header.php file
include('header.php');
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

$get_ip_address = getIPAddress();
$total_price = 0;
$total_quantity = 0;
$cart_query_price = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result_cart_price = mysqli_query($conn, $cart_query_price);
$invoice_number = mt_rand();
$status = 'pending';

while ($row_price = mysqli_fetch_array($result_cart_price)) {
    $item_id = $row_price['item_id'];
    $quantity = $row_price['quantity'];

    $select_product = "SELECT * FROM `product` WHERE item_id=$item_id";
    $run_price = mysqli_query($conn, $select_product);

    while ($row_item_price = mysqli_fetch_array($run_price)) {
        $item_price = $row_item_price['item_price'];
        $item_quantity = $quantity;

        $item_value = $item_price * $item_quantity;
        $total_price += $item_value;
        $total_quantity += $item_quantity;
    }
}

$subtotal = $total_price;

$insert_orders = "INSERT INTO `orders` (user_id, amount_due, invoice_number, total_products, order_date, order_status) VALUES ($user_id, $subtotal, $invoice_number, $total_quantity, NOW(), '$status')";
$result_query = mysqli_query($conn, $insert_orders);

if ($result_query) {
    echo "<script> alert ('Orders are submitted successfully')</script>";
    echo "<script> window.open ('profile.php','_self')</script>";
}

$insert_pending_orders = "INSERT INTO `pending` (user_id, invoice_number, item_id, quantity, order_status) VALUES ($user_id, $invoice_number, $item_id, $quantity, '$status')";
$result_pending_orders = mysqli_query($conn, $insert_pending_orders);

$empty_cart = "DELETE FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result_delete = mysqli_query($conn, $empty_cart);
?>

