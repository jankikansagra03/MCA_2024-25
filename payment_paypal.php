<?php
require __DIR__ . '/vendor/autoload.php'; // Include PayPal SDK

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\RedirectUrls;

$total_price = 10;  // Assuming the total price is stored in session
if ($total_price <= 0) {
    echo "Invalid price.";
    exit;
}

$payer = new Payer();
$payer->setPaymentMethod('paypal');

$clientId = 'Your paypal client id';
$secret = 'Your paypal secret kay';
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential($clientId, $secret)
);

$amount = new Amount();
$amount->setCurrency('USD')  // Ensure INR is set correctly for your account
    ->setTotal($total_price);  // Total amount to charge

$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setDescription('Payment for order');

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl("http://your-site.com/execute.php?success=true")
    ->setCancelUrl("http://your-site.com/execute.php?success=false");

$payment = new Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);

try {
    $payment->create($apiContext);
    $approvalUrl = $payment->getApprovalLink();
    header("Location: $approvalUrl");
    exit;
} catch (PayPal\Exception\PayPalConnectionException $ex) {
    echo "Error: " . $ex->getMessage();
    echo "Error details: " . $ex->getData();  // Log error details
    exit;
}
