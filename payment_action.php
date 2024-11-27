<?php
// require 'vendor/autoload.php';
// Include PayPal SDK
require __DIR__ . '/vendor/autoload.php';

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Details;
use Razorpay\Api\Api;

include_once("header.php");
include_once("user_authentication.php");
if (isset($_POST['payment'])) {

    $person_name = $_POST['person_name'];
    $email_address = $_POST['email_address'];
    $mobile_number = $_POST['mobile_number'];
    $address_line_1 = $_POST['address_line_1'];
    $address_line_2 = $_POST['address_line_2'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $delivery_address = $person_name . "<br>" . $address_line_1 . "<br>" . $address_line_2 . "<br>" . $city . "-" . $zip . "<br>" . $state . "<br>" . $country . "<br>Mobile: " . $mobile_number . "<br>Email::" . $email_address;
    echo $delivery_address;
    $total_price = $_SESSION['total'];
    echo $total_price;

    // Validate the total price before proceeding with payment creation
    if ($total_price <= 0) {
        echo "Invalid total price. Please check your cart.";
        exit;
    }
    $payer = new Payer();
    $payer->setPaymentMethod('paypal');

    $clientId = 'AeImKoFAo8I3noigrDuOI349k86gMJc86FWeoZrqgCVVRfAx6sd-gyHoTlehTFahS66-XmO9n46-AZml';
    $secret = 'Your paypal secret kay';
    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            $clientId,
            $secret
        )
    );
    // Set the PayPal API context with error handling
    try {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $clientId,
                $secret
            )
        );
    } catch (Exception $ex) {
        echo "Error setting up PayPal API context: " . $ex->getMessage();
        exit;
    }

    // Set transaction amount dynamically based on the total price
    $amount = new Amount();
    $amount->setCurrency('INR')
        ->setTotal($total_price); // Use the total price from the session

    // Create transaction
    $transaction = new Transaction();
    $transaction->setAmount($amount)
        ->setDescription('Payment for order by ' . $person_name);

    // Set the redirect URLs after payment
    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl("http://your-site.com/execute.php?success=true")
        ->setCancelUrl("http://your-site.com/execute.php?success=false");

    // Create payment object and set payer, transaction, and redirect URLs
    $payment = new Payment();
    $payment->setIntent('sale')
        ->setPayer($payer)
        ->setTransactions(array($transaction))
        ->setRedirectUrls($redirectUrls);

    // Execute the payment
    try {
        $payment->create($apiContext);
    } catch (Exception $ex) {
        echo "Error creating payment: " . $ex->getMessage();
        exit;
    }

    // Get the approval link
    $approvalUrl = $payment->getApprovalLink();
    header("Location: $approvalUrl");
    exit;
}
include_once("admin_footer.php");
