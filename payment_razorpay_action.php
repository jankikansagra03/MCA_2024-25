<?php
require 'vendor/autoload.php';

use Razorpay\Api\Api;

// Include any necessary authentication or session management
include_once("header.php");
include_once("user_authentication.php");

// Check if the form was submitted
if (isset($_POST['payment'])) {

    $total = isset($_SESSION['total']) ? $_SESSION['total'] : 0;

    if ($total <= 0) {
        echo "Invalid total price. Please check your cart.";
        exit;
    }

    // Initialize Razorpay API
    $api_key = 'test_key';
    $api_secret = 'secret key';
    $api = new Api($api_key, $api_secret);

    try {
        // Create a Razorpay order
        $order = $api->order->create([
            'receipt' => 'order_rcptid_' . time(),
            'amount' => $total * 100, // Amount in paise
            'currency' => 'INR'
        ]);

        // Get the order ID
        $order_id = $order->id;
        $_SESSION['order_id'] = $order_id;
    } catch (Exception $e) {
        echo "Error creating Razorpay order: " . $e->getMessage();
        exit;
    }
?>
    <div class="container">
        <div class="container">
            <div class="row text-center">
                <div class="col-12 bg-dark text-white p-2 align-center">
                    <h1>Paying to Janki Kansagra</h1>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <form action="payment_razorpay_checkout.php" method="POST">
                        <div class="form-group">
                            <label for="address"><b>Delivery Address</b></label>
                            <textarea class="form-control" id="address" name="address" rows="4" readonly><?php echo htmlspecialchars($delivery_address); ?></textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="total"><b>Net Payable Amount</b></label>
                            <input type="text" class="form-control" value="<?php echo $total; ?>" disabled>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="order_id"><b>Order ID</b></label>
                            <input type="text" class="form-control" value="<?php echo $order_id; ?>" disabled>
                        </div>
                        <br>
                        <button id="rzp-button" class="btn btn-dark">Pay Now</button>
                        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                        <script>
                            var options = {
                                "key": "<?php echo $api_key; ?>", // Enter the API key here
                                "amount": "<?php echo $total * 100; ?>", // Amount in paise
                                "currency": "INR",
                                "name": "Janki Kansagra",
                                "description": "Test Transaction",
                                "image": "https://upload.wikimedia.org/wikipedia/en/5/5b/RK_University_logo.png",
                                "order_id": "<?php echo $order_id; ?>", // Razorpay Order ID
                                "prefill": {
                                    "name": "Janki Kansagra",
                                    "email": "janki.kansagra@rku.ac.in",
                                    "contact": "8155825235"
                                },
                                "theme": {
                                    "color": "#ffffff"
                                },
                                "handler": function(response) {
                                    // Handle payment success
                                    alert("Payment Successful! Payment ID: " + response.razorpay_payment_id);
                                    // Optionally, submit the response to the server for verification
                                }
                            };

                            var rzp = new Razorpay(options);
                            document.getElementById('rzp-button').onclick = function(e) {
                                rzp.open();
                                e.preventDefault();
                            };
                        </script>
                        <input type="hidden" name="hidden">
                    </form>
                </div>
            </div>
        </div>
    <?php
}
include_once("admin_footer.php");
    ?>