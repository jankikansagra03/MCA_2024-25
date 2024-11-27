<?php
include_once("header.php");

?>

<div class="container center">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-4">
            <h1>Product Gallery</h1>
        </div>
    </div>
    <br>
    <?php
    // Fetch products from the database
    $query = "SELECT * FROM products WHERE status='Active'";
    $result = mysqli_query($con, $query);
    ?>
    <div class="row p-4 gy-4">
        <?php
        // Check if there are products
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 text-center">
                    <div class="card <?php if ($row['quantity'] == 0) echo 'out-of-stock'; ?>" style="width: 18rem; position: relative;height:480px;">
                        <?php if ($row['quantity'] == 0): ?>
                            <div class="out-of-stock-text">Out of Stock</div>
                        <?php endif; ?>
                        <div style="height:300px;">
                            <img src="images/products/<?php echo $row['main_image']; ?>" class="card-img-top img-fluid" alt="<?php echo $row['product_name']; ?>">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                            <?php if ($row['price'] > 0 && $row['discount'] != 0): ?>
                                <?php $discounted_price = $row['price'] - ($row['discount'] * $row['price'] / 100); ?>
                                <span class="card-text" style="text-decoration: line-through;">Price: Rs. <?php echo $row['price']; ?></span><br>
                                <span class="cart-text"><?php echo $row['discount'] . "% Discount"; ?></span><br>
                                <span class="card-text">Price: Rs. <?php echo number_format($discounted_price, 2); ?></span><br>
                            <?php else: ?>
                                <span class="card-text">Price: Rs. <?php echo number_format($row['price'], 2); ?></span><br>
                            <?php endif; ?>
                            <br>
                            <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></a>&nbsp;
                            <a href="view_product.php?id=<?php echo $row['id']; ?>" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>&nbsp;
                            <a href="add_to_wishlist.php?id=<?php echo $row['id']; ?>" class="btn btn-success"><i class="fa-solid fa-heart"></i></a>&nbsp;
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo '<div class="col-12"><p>No products found.</p></div>';
        }
        ?>
    </div>
</div>


<?php
include_once("footer.php");
