<?php
include_once("header.php");
include_once("user_authentication.php");
$email = $_SESSION['user'];
$q = "select * from orders where email='$email'";
$result = mysqli_query($con, $q);

$q1 = "select * from registration where email='$email'";
$result1  = mysqli_fetch_assoc(mysqli_query($con, $q1));


?>
<div class="container">

    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-2 align-center">
            <h1><?php echo $result1['fullname'] . "'s Orders"  ?></h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Sr.NO</th>
                            <th scope="col">Order ID</th>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Order Status</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $pid = $row['product_id'];
                            $p = "select * from products where id=$pid";
                            $p_result = mysqli_fetch_assoc(mysqli_query($con, $p));
                        ?>

                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['order_id']; ?></td>

                                <td><img src="images/products/<?php echo $p_result['main_image']; ?>" height="50px"></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['actual_amount']; ?></td>
                                <td><?php echo $row['delivery_status']; ?></td>
                                <td><?php echo $row['payment_status']; ?></td>
                                <td>
                                    <?php
                                    if ($row['rating'] == NULL and $row['review'] == NULL) {
                                    ?>
                                        <a href="user_review_product.php?id=<?php echo $row['sub_order_id']; ?>" class="btn btn-success">Review</a>
                                    <?php
                                    }
                                    ?>
                                    <a href="user_view_order.php?id=<?php echo $row['sub_order_id']; ?>" class="btn btn-info">View</a>
                                    <a href="user_cancel_order.php?id=<?php echo $row['sub_order_id']; ?>" class="btn btn-danger">Cancel</a>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include_once('admin_footer.php');
