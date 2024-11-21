<?php
require 'vendor/autoload.php';

use Razorpay\Api\Api;

session_start();

// Initialize Razorpay API
$api_key = 'test_key';
$api_secret = 'secret key';
$api = new Api($api_key, $api_secret);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve Razorpay response
    $payment_id = $_POST['razorpay_payment_id'] ?? null;
    $order_id = $_POST['razorpay_order_id'] ?? null;
    $signature = $_POST['razorpay_signature'] ?? null;

    if (!$payment_id || !$order_id || !$signature) {
        echo "Invalid payment response received.";
        exit;
    }

    // Verify the Razorpay signature
    try {
        $attributes = [
            'razorpay_order_id' => $order_id,
            'razorpay_payment_id' => $payment_id,
            'razorpay_signature' => $signature
        ];

        $api->utility->verifyPaymentSignature($attributes);

        // Payment verified successfully
        echo "Payment successful! Payment ID: " . $payment_id;

        // You can update the order status in your database here

    } catch (Exception $e) {
        echo "Payment verification failed: " . $e->getMessage();
        exit;
    }
} else {
    echo "Invalid request method.";
    exit;
}
