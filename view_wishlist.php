<?php
include_once("header.php");
include_once("user_authentication.php");
$email = $_SESSION['user'];
$q = "select * from registration where email='$email'";
$result = mysqli_query($con, $q);
?>
<div class="container">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-2 align-center">
            <h1>
                <?php
                $wishlist_total = 0;
                $email = $_SESSION['user']; // Assuming user is logged in and email is stored in session
                echo $email . "'s Wishlist";
                ?>
            </h1>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $wishlist_query = "
                        SELECT w.id, p.product_name, p.id AS product_id, 
                               (SELECT main_image FROM products WHERE id = w.product_id) AS main_image 
                        FROM wishlist w 
                        JOIN products p ON w.product_id = p.id 
                        WHERE w.email='$email'
                    ";
                    $wishlist_result = mysqli_query($con, $wishlist_query);
                    if (mysqli_num_rows($wishlist_result) > 0) {
                        $i = 1;
                        while ($wishlist_item = mysqli_fetch_assoc($wishlist_result)) {
                            $product_name = $wishlist_item['product_name'];
                            $product_id = $wishlist_item['product_id'];
                            $main_image = $wishlist_item['main_image'];
                    ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $product_name; ?></td>
                                <td><img src="images/products/<?php echo $main_image; ?>" /></td>
                                <td><a href="add_to_cart.php?id=<?php echo $product_id; ?>"><button class="btn btn-dark">Add to Cart</button></a>&nbsp;&nbsp;<a href='remove_from_wishlist.php?id=<?php echo $product_id; ?>' class='btn btn-danger'>Remove</a></td>
                            </tr>
                    <?php
                            $i++;
                        }
                    } else {
                        echo "<tr><td colspan='3' class='text-center'>Your wishlist is empty.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include_once('admin_footer.php');
