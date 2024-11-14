<?php
include_once("header.php");

?>

<div class="container">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-4 align-center">
            <h1>Product Gallery</h1>
        </div>
    </div>
    <br>
    <?php
    // Fetch products from the database
    $query = "SELECT * FROM products where status='Active'";
    $result = mysqli_query($con, $query);
    ?>
    <div class="row p-4 gy-4">
        <?php
        // Check if there are products
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 colsm-12 col-xs-12">
                    <div class="card" style="width: 18rem;">
                        <img src="images/products/<?php echo $row['main_image']; ?>" class="card-img-top" alt="<?php echo $row['product_name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                            <?php
                            if ($row['discount'] != 0) {
                                $disounted_price = $row['price'] - ($row['discount'] * $row['price'] / 100);
                            ?>
                                <span class="card-text" style="text-decoration: line-through;">Price: Rs. <?php echo $row['price']; ?></span><br>
                                <span class="cart-text"><?php echo $row['discount'] . "% Discount"; ?> </span><br>
                                <span class="card-text">Price: Rs. <?php echo $disounted_price; ?></sp><br>
                                <?php
                            } else {
                                ?>
                                    <span class="card-text">Price: Rs. <?php echo $row['price']; ?></span><br>
                                <?php
                            }
                                ?>
                                <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></a>&nbsp;
                                <a href="view_product.php?id=<?php echo $row['id']; ?>" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>&nbsp;
                                <a href="add_to_wishlist.php?id=<?php echo $row['id']; ?>" class="btn btn-success"><i class="fa-solid fa-heart"></i></a>&nbsp;
                        </div>
                    </div>
                </div>
        <?php

            }
        } else {
            echo '<div class="col-12">
            <p>No products found.</p>
        </div>';
        }
        ?>


        <!-- <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 colsm-12 col-xs-12">
            <div class="card" style="width: 18rem;">
                <img src="images/download (14).jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Television</h5>
                    <p class="card-text">Price: Rs. 80,000</p>
                    <a href="add_to_cart.php" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></a>
                    <a href="view_product.php" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                    <a href="add_wishlist.php" class="btn btn-success"><i class="fa-solid fa-heart"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 colsm-12 col-xs-12">
            <div class="card" style="width: 18rem;">
                <img src="images/download (14).jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Television</h5>
                    <p class="card-text">Price: Rs. 80,000</p>
                    <a href="add_to_cart.php" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></a>
                    <a href="view_product.php" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                    <a href="add_wishlist.php" class="btn btn-success"><i class="fa-solid fa-heart"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 colsm-12 col-xs-12">
            <div class="card" style="width: 18rem;">
                <img src="images/download (14).jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Television</h5>
                    <p class="card-text">Price: Rs. 80,000</p>
                    <a href="add_to_cart.php" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></a>
                    <a href="view_product.php" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                    <a href="add_wishlist.php" class="btn btn-success"><i class="fa-solid fa-heart"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 colsm-12 col-xs-12">
            <div class="card" style="width: 18rem;">
                <img src="images/download (14).jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Television</h5>
                    <p class="card-text">Price: Rs. 80,000</p>
                    <a href="add_to_cart.php" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></a>
                    <a href="view_product.php" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                    <a href="add_wishlist.php" class="btn btn-success"><i class="fa-solid fa-heart"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 colsm-12 col-xs-12">
            <div class="card" style="width: 18rem;">
                <img src="images/download (14).jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Television</h5>
                    <p class="card-text">Price: Rs. 80,000</p>
                    <a href="add_to_cart.php" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></a>
                    <a href="view_product.php" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                    <a href="add_wishlist.php" class="btn btn-success"><i class="fa-solid fa-heart"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 colsm-12 col-xs-12">
            <div class="card" style="width: 18rem;">
                <img src="images/download (14).jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Television</h5>
                    <p class="card-text">Price: Rs. 80,000</p>
                    <a href="add_to_cart.php" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></a>
                    <a href="view_product.php" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                    <a href="add_wishlist.php" class="btn btn-success"><i class="fa-solid fa-heart"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 colsm-12 col-xs-12">
            <div class="card" style="width: 18rem;">
                <img src="images/download (14).jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Television</h5>
                    <p class="card-text">Price: Rs. 80,000</p>
                    <a href="add_to_cart.php" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></a>
                    <a href="view_product.php" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                    <a href="add_wishlist.php" class="btn btn-success"><i class="fa-solid fa-heart"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 colsm-12 col-xs-12">
            <div class="card" style="width: 18rem;">
                <img src="images/download (14).jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Television</h5>
                    <p class="card-text">Price: Rs. 80,000</p>
                    <a href="add_to_cart.php" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></a>
                    <a href="view_product.php" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                    <a href="add_wishlist.php" class="btn btn-success"><i class="fa-solid fa-heart"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 colsm-12 col-xs-12">
            <div class="card" style="width: 18rem;">
                <img src="images/download (14).jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Television</h5>
                    <p class="card-text">Price: Rs. 80,000</p>
                    <a href="add_to_cart.php" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></a>
                    <a href="view_product.php" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                    <a href="add_wishlist.php" class="btn btn-success"><i class="fa-solid fa-heart"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 colsm-12 col-xs-12">
            <div class="card" style="width: 18rem;">
                <img src="images/download (14).jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Television</h5>
                    <p class="card-text">Price: Rs. 80,000</p>
                    <a href="add_to_cart.php" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></a>
                    <a href="view_product.php" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                    <a href="add_wishlist.php" class="btn btn-success"><i class="fa-solid fa-heart"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 colsm-12 col-xs-12">
            <div class="card" style="width: 18rem;">
                <img src="images/download (14).jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Television</h5>
                    <p class="card-text">Price: Rs. 80,000</p>
                    <a href="add_to_cart.php" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></a>
                    <a href="view_product.php" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                    <a href="add_wishlist.php" class="btn btn-success"><i class="fa-solid fa-heart"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 colsm-12 col-xs-12">
            <div class="card" style="width: 18rem;">
                <img src="images/download (14).jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Television</h5>
                    <p class="card-text">Price: Rs. 80,000</p>
                    <a href="add_to_cart.php" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></a>
                    <a href="view_product.php" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                    <a href="add_wishlist.php" class="btn btn-success"><i class="fa-solid fa-heart"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 colsm-12 col-xs-12">
            <div class="card" style="width: 18rem;">
                <img src="images/download (14).jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Television</h5>
                    <p class="card-text">Price: Rs. 80,000</p>
                    <a href="add_to_cart.php" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></a>
                    <a href="view_product.php" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                    <a href="add_wishlist.php" class="btn btn-success"><i class="fa-solid fa-heart"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 colsm-12 col-xs-12">
            <div class="card" style="width: 18rem;">
                <img src="images/download (14).jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Television</h5>
                    <p class="card-text">Price: Rs. 80,000</p>
                    <a href="add_to_cart.php" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></a>
                    <a href="view_product.php" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                    <a href="add_wishlist.php" class="btn btn-success"><i class="fa-solid fa-heart"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 colsm-12 col-xs-12">
            <div class="card" style="width: 18rem;">
                <img src="images/download (14).jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Television</h5>
                    <p class="card-text">Price: Rs. 80,000</p>
                    <a href="add_to_cart.php" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></a>
                    <a href="view_product.php" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                    <a href="add_wishlist.php" class="btn btn-success"><i class="fa-solid fa-heart"></i></a>
                </div>
            </div>
        </div>
 -->


    </div>
</div>

<?php
include_once("footer.php");
