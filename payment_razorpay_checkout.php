<?php
session_start();
include_once("connection.php");
require 'vendor/autoload.php';

use Razorpay\Api\Api;

// Initialize Razorpay API
$api_key = 'razor_pay_api_key';
$api_secret = 'razor_pay_secret_key';
$api = new Api($api_key, $api_secret);

// Fetch payment details from the client
$razorpay_payment_id = $_POST['razorpay_payment_id'];
$razorpay_order_id = $_POST['razorpay_order_id'];
$razorpay_signature = $_POST['razorpay_signature'];

try {
    // Verify payment signature
    $attributes = [
        'razorpay_order_id' => $razorpay_order_id,
        'razorpay_payment_id' => $razorpay_payment_id,
        'razorpay_signature' => $razorpay_signature
    ];
    $api->utility->verifyPaymentSignature($attributes);

    // Payment is valid, process the order

    $order_id = $_SESSION['order_id'];
    $email = $_SESSION['user'];
    $total = $_SESSION['total'];
    $address = $_SESSION['address'];
    $order_array = $_SESSION['order_array'];

    $q = "SELECT * FROM cart WHERE email = '$email'";
    $cart_result = mysqli_query($con, $q);

    $order_total = $order_array['total'];
    $order_discount = $order_array['discount'];
    $offer_code = $order_array['offer_code'];

    while ($order_result = mysqli_fetch_assoc($cart_result)) {
        $product_id = $order_result['product_id'];
        $p = "SELECT * FROM products WHERE id = $product_id";
        $p_result = mysqli_fetch_assoc(mysqli_query($con, $p));

        if ($p_result['quantity'] > 0) {
            $total_price = $order_result['total_price'];
            $discount_amount = ($total_price / $order_total) * $order_discount;
            $actual_price = $total_price - $discount_amount;
            $quantity = $order_result['quantity'];

            $insert_order = "INSERT INTO `orders`(`order_id`, `sub_order_id`, `product_id`, `quantity`, `email`, `delivery_address`, `total_amount`, `offer_name`, `discount_amount`, `actual_amount`,`payment_status`) 
                             VALUES ('$razorpay_order_id', '$razorpay_order_id-$product_id', $product_id, $quantity, '$email', '$address', $total_price, '$offer_code', $discount_amount, $actual_price,'Completed')";
            mysqli_query($con, $insert_order);

            $remaining_quantity = $p_result['quantity'] - $quantity;
            $update_stock = "UPDATE products SET quantity = $remaining_quantity WHERE id = $product_id";
            mysqli_query($con, $update_stock);

            $del_cart = "DELETE FROM cart WHERE email = '$email' AND product_id = $product_id";
            mysqli_query($con, $del_cart);
        }
    }

    echo "success";
} catch (Exception $e) {
    // Payment verification failed
    echo "error";
}
