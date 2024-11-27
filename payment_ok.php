<?php
require 'vendor/autoload.php';

use Razorpay\Api\Api;

// Include any necessary authentication or session management
include_once("header.php");
include_once("user_authentication.php");
$email = $_SESSION['user'];

// Check if the form was submitted
if (isset($_POST['payment'])) {

    $total = isset($_SESSION['total']) ? $_SESSION['total'] : 0;

    if ($total <= 0) {
        echo "Invalid total price. Please check your cart.";
        exit;
    }

    // Initialize Razorpay API
    $api_key = 'razor_pay_api_key';
    $api_secret = 'razor_pay_secret_key';
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

        if (isset($_SESSION['order_array'])) {
            $arr = $_SESSION['order_array'];
            $order_total = $arr['total'];
            $order_discount = $arr['discount'];
            $offer_code = $arr['offer_code'];
        }
        $address = $_SESSION['address'];
        $q = "select * from cart where `email`='$email'";
        $cart_result = mysqli_query($con, $q);
        $i = 1;
        while ($order_result = mysqli_fetch_assoc($cart_result)) {

            $sub_order = $order_id . "a" . $i;
            $product_id = $order_result['product_id'];
            $p = "select * from products where id=$product_id";
            $p_result = mysqli_fetch_assoc(mysqli_query($con, $p));
            if ($p_result['quantity'] > 0) {
                $total_price = $order_result['total_price'];
                $discount_amount = ($total_price / $order_total) * $order_discount;
                $actual_price = $total_price - $discount_amount;
                $quantity = $order_result['quantity'];
                $insert_order = "INSERT INTO `orders`(`order_id`, `sub_order_id`, `product_id`, `quantity`, `email`, `delivery_address`, `total_amount`, `offer_name`, `discount_amount`, `actual_amount`) VALUES ($order_id,'$sub_order',$product_id,$quantity,'$email','$address','$total_price','$offer_code',$discount_amount,$actual_price)";
                // echo $insert_order . "<br>";
                if (mysqli_query($con, $insert_order)) {
                    $remaining_quantity = $p_result['quantity'] - $quantity;
                    $update_stock = "update products set quantity=$remaining quantity where id=$product_id";
                    mysqli_query($con, $update_stock);
                    $del = "delete from cart where email='$email' and product_id=$product_id";
                    mysqli_query($con, $del);
                }
            }
            $i++;
?>
            <!-- <script>
                window.location.href = "user_order.php";
            </script> -->
    <?php
        }
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
                    <form action="payment_razorpay_action.php" method="POST">
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
                                    // alert("Payment Successful! Payment ID: " + response.razorpay_payment_id);
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