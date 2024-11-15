<?php
include_once("header.php");
include_once("user_authentication.php");
$email = $_SESSION['user'];
$q = "select * from registration where email='$email'";
$result  = mysqli_query($con, $q);
?>
<div class="container">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-2 align-center">

            <h1>
                <?php
                $cart_total = 0;
                while ($r = mysqli_fetch_assoc($result))
                    echo $r['fullname']; ?>'s Shopping Cart</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
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
                            $product_id = $cart_item['product_id']; // Assuming the cart table has a product_id field
                            $product_query = "SELECT * FROM products WHERE id='$product_id'"; // Fetch product name from products table
                            $product_result = mysqli_query($con, $product_query);
                            $product_data = mysqli_fetch_assoc($product_result);
                            $product_name = $product_data['product_name']; // Get the product name
                            $product_image = $product_data['main_image'];
                            // $product_name = $cart_item['product_name'];
                            $quantity = $cart_item['quantity'];
                            $price = $cart_item['total_price'] / $quantity;
                            $total = $quantity * $price;

                    ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $product_name; ?> </td>
                                <td><img src="images/products/<?php echo $product_image; ?>"></td>
                                <td><a href=" decrease_cart.php?id=<?php echo $product_id; ?>"><button class="btn btn-dark"><i class="fa fa-minus"></i></button></a>&nbsp;&nbsp;<?php echo $quantity; ?> &nbsp;&nbsp;<a href="increase_cart.php?id=<?php echo $product_id; ?>"><button class="btn btn-dark"><i class="fa fa-plus"></i></button></a></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $total; ?></td>
                                <td><a href='remove_from_cart.php?id=<?php echo $product_id; ?>' class='btn btn-danger'>Remove</a></td>
                            </tr>
                    <?php
                            $i++;
                            $cart_total = $cart_total + $total;
                        }
                    }
                    // Assuming you have a session variable for the cart

                    else {
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
            <form action="view_cart.php" method="post">
                <div>
                    <label for="offer_code"><b>Offer Code:</b></label>
                    <input type="text" id="offer_code" name="offer_code" class="form-control" placeholder="Enter your offer code">
                    <span class='text-danger' style="display:none"                          >Invalid offer code. Please try again.</span>
                </div>
                <br>
                <button type="submit" name="apply" value="Apply" class="btn btn-dark" name="verify">Apply</button>
            </form>
            <br>
            <a href="checkout.php" class="btn btn-dark">Proceed to Checkout</a>
        </div>
    </div>
</div>
<?php
include_once('admin_footer.php');
if (isset($_POST['verify'])) {
    $offer = strtoupper($_POST['offer_code']);

    // Start Generation Here
    $query = "SELECT * FROM offers WHERE code='$offer'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // Offer code exists
        setcookie('success', 'Offer code applied successfully.', time() + 5, '/');
    } else {

        // Offer code does not exist
        setcookie('error', 'Invalid offer code. Please try again.', time() + 5, '/');
    }
}
