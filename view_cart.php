<?php
include_once("header.php");
include_once("user_authentication.php");
$email = $_SESSION['user'];

$q = "select * from registration where email='$email'";
$result  = mysqli_query($con, $q);
?>

<style>
    
</style>
<script>
    $(document).ready(function() {
        $("#offerCodeForm").validate({
            rules: {
                offer_code: {
                    required: true,
                }
            },
            messages: {
                offer_code: {
                    required: "Please enter an offer code",
                }
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                error.insertAfter(element);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass('is-valid').removeClass('is-invalid');
            }

        });
    });
</script>
<script>
    function select_address(id) {
        $.ajax({
            url: 'select_delivery_address.php',
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                // Handle the response from the server
                console.log("Address selected successfully:", response);
                document.getElementById('d_address').innerHTML = response;
                // Optionally, you can redirect or update the UI based on the response
                // window.location.href = "view_cart.php"; // Redirect to view_cart.php after selection
            },
            error: function(xhr, status, error) {
                console.error("Error selecting address:", error);
                alert("An error occurred while selecting the address. Please try again.");
            }
        });
    }
</script>

<div class="container">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-2 align-center">

            <h2>
                <?php
                $cart_total = 0;
                while ($r = mysqli_fetch_assoc($result))
                    echo $r['fullname']; ?>'s Shopping Cart</h2>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped w-100">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cart = "select * from cart where email='$email'";
                        $cart_result = mysqli_query($con, $cart);
                        if (mysqli_num_rows($cart_result) > 0) {
                            $i = 1;
                            while ($cart_item = mysqli_fetch_assoc($cart_result)) {

                                $product_id = $cart_item['product_id'];
                                $product = "select * from products where id=$product_id";
                                $product_result = mysqli_fetch_assoc(mysqli_query($con, $product));
                                $p_quantity = $product_result['quantity']; // Assuming the cart table has a product_id field
                                $product_query = "SELECT * FROM products WHERE id='$product_id'"; // Fetch product name from products table
                                $product_result = mysqli_query($con, $product_query);
                                $product_data = mysqli_fetch_assoc($product_result);
                                $product_name = $product_data['product_name']; // Get the product name
                                $product_image = $product_data['main_image'];
                                // $product_name = $cart_item['product_name'];
                                $quantity = $cart_item['quantity'];
                                $price = $cart_item['total_price'] / $quantity;
                                if ($p_quantity != 0) {
                                    $total = $quantity * $price;
                                } else {
                                    $total = 0;
                                }

                        ?>
                                <tr <?php if ($p_quantity == 0) {
                                        echo 'class="out-of-stock"';
                                    } ?>>

                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $product_name; ?> </td>
                                    <td><img src="images/products/<?php echo $product_image; ?>"></td>
                                    <td><a href=" decrease_cart.php?id=<?php echo $product_id; ?>"><button class="btn btn-dark"><i class="fa fa-minus"></i></button></a>&nbsp;&nbsp;<?php echo $quantity; ?> &nbsp;&nbsp;<a href="increase_cart.php?id=<?php echo $product_id; ?>"><button class="btn btn-dark"><i class="fa fa-plus"></i></button></a></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php if ($p_quantity == 0) { ?>
                                            <input type="button" value="Out of Stock" class="btn btn-secondary">
                                        <?php } else { ?>
                                            <a href='remove_from_cart.php?id=<?php echo $product_id; ?>' class='btn btn-danger'>Remove</a>
                                    </td>
                                <?php } ?>
                                </tr>
                        <?php
                                $i++;
                                $cart_total = $cart_total + $total;
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>Your cart is empty.</td></tr>";
                        }
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>Cart Total</th>
                            <th><?php echo $cart_total; ?> </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row p-4">

                <div class="col-xl-4 col-lg-4 col-md-6 col-xs-12 col-sm-12 card" style="margin-top: 20px; padding: 15px; border: 1px solid black;">
                    <form action="view_cart.php" method="post" id="offerCodeForm">
                        <div>
                            <label for=" offer_code"><b>Offer Code:</b></label>
                            <input type="text" id="offer_code" name="offer_code" class="form-control" placeholder="Enter your offer code">
                            <span id="err"></span>
                        </div>
                        <br>
                        <button type="submit" name="apply" value="Apply" class="btn btn-dark">Apply</button>
                    </form>
                    <br>
                    <div class="card" style="margin-top: 20px; padding: 15px; border: 1px solid black;">
                        <h5 class="card-title"><u>Discount Details</u></h5>
                        <p class="card-text">Offer Code: <strong><span id="offer_name">-</span></strong></p>
                        <p class="card-text">Discount Percentage: <strong><span id="discount_percentage">-</span></strong></p>
                        <p class="card-text">Discount Amount: <strong><span id="discount_amount">-</span></strong></p>
                        <p class="card-text">New Cart Total: <strong><span id="new_cart_total">-</span></strong></p>
                    </div>
                    <br>
                    <div class="card" style="margin-top: 20px; padding: 15px; border: 1px solid black;">
                        <h5><u>Delivery Address</u></h5>
                        <p id="d_address"></p>
                    </div>
                </div>


                <div class="col-xl-8 col-lg-8 col-md-6 col-sm-12 col-xs-12 card" style="margin-top: 20px; padding: 15px; border: 1px solid white;">
                    <div class="row">
                        <h5>Select Shipping Address</h5>
                        <?php
                        $q = "select * from address where email = '$email'";
                        $result_address = mysqli_query($con, $q);
                        $i = 0;
                        while ($r_address = mysqli_fetch_assoc($result_address)) {
                        ?>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-xs-12 col-sm-12 p-3">
                                <div class="card" style="border: 1px solid black;padding-left:10px; ">
                                    <?php echo $r_address['delivery_address']; ?>
                                    <br>
                                </div>
                                <br>
                                <a href="edit_delivery_address.php?id=<?php echo $r_address['id']; ?>"><input type="button" class="btn btn-dark" value="Edit Address"></a>
                                <input type="button" value="Deliver to this Address" onclick="select_address(<?php echo $r_address['id']; ?>)" class="btn btn-dark" >
                                <!-- <a href="select_delivery_address.php?id=<?php echo $r_address['id']; ?>"><input type="button" class="btn btn-dark" value="Deliver to this Address"></a> -->
                                <?php
                                $i++;

                                if ($i % 2 == 0) {

                                    echo "<br>";
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <br>
                    <a href="add_delivery_address.php"><input type="button" class="btn btn-dark" value="Add Address"></a>
                    <br>
                    <br>
                    <form action="payment_razorpay_action.php" method="post">
                        <div class="form-group">
                            <label for="gen1"><b>Select Payment Method</b></label>
                            <br>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" id="genMale" name="payment_mode" value="cod"> Cash on Delivery
                                </label>
                                <br>
                                <label class="radio-label">
                                    <input type="radio" id="genFemale" name="payment_mode" value="pay_online"> Pay Now
                                </label>
                                <span id="gen_err" class="radio-error"></span>
                            </div>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-dark" value="Proceed to Checkout" name="payment">
                    </form>



                </div>
            </div>
        </div>
        <?php

        $_SESSION['total'] = $cart_total;
        $orders_array = [
            'total' => $cart_total,
            'discount' => 0,
        ];
        $_SESSION['order_array'] = $orders_array;
        include_once('admin_footer.php');
        if (isset($_POST['apply'])) {

            $offer = strtoupper($_POST['offer_code']);

            // Start Generation Here
            $query = "SELECT * FROM offers WHERE offer_name='$offer' and status='Active'";

            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
        ?>
                <script>
                    document.getElementById('err').style.color = "green";
                    document.getElementById('err').innerHTML = "Offercode applied successfully";
                </script>

                <?php
                $offer_data = mysqli_fetch_assoc($result);
                $discount_percentage = $offer_data['discount_percentage'];
                $discount_amount = ($cart_total * $discount_percentage) / 100;
                $order_total = $offer_data['cart_total'];
                $max_discount = $offer_data['max_discount'];
                $offer_name = $offer_data['offer_name'];
                //echo $offer_name;
                // $offer = $offer_data['offer_name'];
                if ($cart_total > $order_total) {


                    if ($discount_amount > $max_discount) {
                        $discount_amount = $max_discount;
                    } else {
                        $discount_amount = ($cart_total * $discount_percentage) / 100;
                    }
                    $new_cart_total = $cart_total - $discount_amount;

                ?>
                    <script>
                        document.getElementById('offer_name').innerHTML = '<?php echo $offer_name; ?>';
                        document.getElementById('discount_percentage').innerHTML = '<?php echo $discount_percentage; ?>%';
                        document.getElementById('discount_amount').innerHTML = 'Rs. <?php echo number_format($discount_amount, 2); ?>';
                        document.getElementById('new_cart_total').innerHTML = 'Rs. <?php echo number_format($new_cart_total, 2); ?>';
                    </script>
                <?php
                } else {
                ?>
                    <script>
                        document.getElementById('err').style.color = "red";
                        document.getElementById('err').innerHTML = "To avail this offer cart total must be greater than <?php echo $order_total; ?>.";
                    </script>
                <?php
                }
                $_SESSION['total'] = $new_cart_total;
                $orders_array = [
                    'total' => $cart_total,
                    'discount' => $discount_amount,
                    'offer_code' => $offer_name
                ];
                $_SESSION['order_array'] = $orders_array;
                // Offer code exists
            } else {
                // Offer code does not exist
                ?>
                <script>
                    document.getElementById('err').style.color = "red";
                    document.getElementById('err').innerHTML = "Invalid Code";
                </script>
        <?php
            }
        }
