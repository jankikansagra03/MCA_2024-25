<?php
include_once("header.php");
include_once("user_authentication.php");
$email = $_SESSION['user'];
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $orders = "select * from orders where sub_order_id='$id'";
    $order_result = mysqli_query($con, $orders);
    while ($order_detail = mysqli_fetch_assoc($order_result)) {
?>
        <div class="container">
            <div class="row text-center">
                <div class="col-12 bg-dark text-white p-2 align-center">
                    <h2>

                        <?php echo "Order_ID = " . " " . $order_detail['order_id']; ?></h2>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <?php
                    $product_id = $order_detail['product_id'];
                    $product_query = "SELECT main_image FROM products WHERE id='$product_id'";
                    $product_result = mysqli_fetch_assoc(mysqli_query($con, $product_query));
                    ?>
                    <img src="images/products/<?php echo $product_result['main_image']; ?>" alt="Product Image" class="img-fluid">
                </div>
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="container p-4">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-icon bg-dark text-white">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div class="timeline-content shadow-sm">
                                    <h5 class="text-dark">Product Information</h5>
                                    <p><strong>Product ID:</strong> <?php echo $order_detail['product_id']; ?></p>
                                    <p><strong>Quantity:</strong> <?php echo $order_detail['quantity']; ?></p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-icon bg-dark text-white">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <div class="timeline-content shadow-sm">
                                    <h5 class="text-dark">Payment Details</h5>
                                    <p><strong>Total Amount:</strong> ₹<?php echo $order_detail['total_amount']; ?></p>
                                    <p><strong>Discount:</strong> ₹<?php echo $order_detail['discount_amount']; ?></p>
                                    <p><strong>Final Amount:</strong> ₹<?php echo $order_detail['actual_amount']; ?></p>
                                    <p><strong>Offer Code:</strong> <?php echo $order_detail['offer_name']; ?></p>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-icon bg-dark text-white">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="timeline-content shadow-sm">
                                    <h5 class="text-dark">Order Status</h5>
                                    <p>
                                        <span class="<?php echo $order_detail['delivery_status'] == 'Delivered' ? 'badge bg-dark text-white' : 'badge bg-light text-dark'; ?>">
                                            <?php echo $order_detail['delivery_status']; ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php

                    ?>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="container py-4">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-icon bg-dark text-white">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="timeline-content shadow-sm">
                                    <h5 class="text-dark">Delivery Address</h5>
                                    <p><?php echo $order_detail['delivery_address']; ?></p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-icon bg-dark text-white">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="timeline-content shadow-sm">
                                    <h5 class="text-dark">Order Date</h5>
                                    <p><?php echo date('d M Y, H:i', strtotime($order_detail['created_at'])); ?></p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-icon bg-dark text-white">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <div class="timeline-content shadow-sm">
                                    <h5 class="text-dark">Payment Mode</h5>
                                    <p><?php echo $order_detail['payment_mode']; ?></p>
                                </div>
                            </div>
                            <?php

                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-xl-2 col-lg-2"> </div>
                <div class="col-xl-10 col-lg-10 col-md-12 col-xs-12 col-sm-12">
                    <div class="container py-4">
                        <div class="timeline-item">
                            <div class="timeline-icon bg-dark text-white">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="timeline-content shadow-sm">
                                <h5 class="text-dark">Rating & Review</h5>
                                <?php if ($order_detail['rating'] != NULL && $order_detail['review'] != NULL) { ?>

                                    <p><strong>Rating:</strong> <?php echo $order_detail['rating']; ?> / 5.0</p>
                                    <p><strong>Review:</strong> <?php echo htmlspecialchars($order_detail['review']); ?></p>
                                <?php } else { ?>
                                    <a href="user_review_product.php?id=<?php echo $order_detail['sub_order_id']; ?>" class="btn btn-success">Review Product</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}
?>


<?php
include_once("admin_footer.php");
