<?php
include_once("header.php");
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    // Start Generation Here
    $query = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($con, $query);
    $product = mysqli_fetch_assoc($result);

    if ($product) {
?>
        <div class="container">
            <div class="row text-center">
                <div class="col-2"></div>
                <div class="col-8">
                    <h1><u><?php echo htmlspecialchars($product['product_name']); ?></u></h1>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-md-4">
                    <img src="images/products/<?php echo htmlspecialchars($product['main_image']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                </div>
                <div class="col-md-4">
                    <h3>Details</h3>
                    <p><strong>Price:</strong> $<?php echo number_format($product['price'], 2); ?></p>
                    <p><strong>Description:</strong> <?php echo $product['description']; ?></p>
                    <p><strong>Status:</strong> <?php echo $product['status']; ?></p>
                    <p><strong>Quantity Available:</strong> <?php echo $product['quantity']; ?></p>
                    <p><strong>Discount:</strong> <?php echo $product['discount']; ?>%</p>
                    <a href="add_to_cart.php?id=<?php echo $product['id']; ?>"><button class="btn btn-dark">Add to Cart</button></a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <h3>Other Images</h3>
                    <?php
                    $other_images = explode(",", $product['other_images']);
                    foreach ($other_images as $image) {
                        echo '<img src="images/products/' . $image . '" class="img-thumbnail" alt="Additional Image" style="width: 150px; margin: 5px;">';
                    }
                    ?>
                </div>
            </div>
        </div>
<?php
    } else {
        echo "<p>Product not found.</p>";
    }
}
