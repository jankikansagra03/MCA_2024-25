<?php
include_once("header.php");
include_once('admin_authentication.php');
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    // Start Generation Here
    $query = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($con, $query);
    $product = mysqli_fetch_assoc($result);

    if ($product) {
?>
        <!-- Start Generation Here -->

        <div class="container">

            <div class="row">
                <div class="col-2"></div>
                <div class="col-md-4">
                    <img src="images/products/<?php echo $product['main_image']; ?>" class="img-fluid rounded-start" alt="<?php echo $product['product_name']; ?>" style="height: 100%; object-fit: cover;">
                </div>

                <div class="col-md-4 d-flex flex-column justify-content-center">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $product['product_name']; ?></h2>
                        <p class="lead">Price: <strong>$<?php echo number_format($product['price'], 2); ?></strong></p>
                        <p><strong>Description:</strong> <?php echo nl2br($product['description']); ?></p>
                        <p><strong>Status:</strong> <span class="badge <?php echo $product['status'] == 'Active' ? 'bg-success' : 'bg-danger'; ?>"><?php echo $product['status']; ?></span></p>
                        <p><strong>Quantity Available:</strong> <?php echo $product['quantity']; ?></p>
                        <p><strong>Discount:</strong> <?php echo $product['discount']; ?>%</p>
                        <p><strong>Category:</strong> <?php
                                                        $category_id = $product['category_id'];
                                                        $category_query = "SELECT category_name FROM category_master WHERE id = $category_id";
                                                        $category_result = mysqli_query($con, $category_query);
                                                        $category_row = mysqli_fetch_assoc($category_result);
                                                        echo $category_row['category_name'];
                                                        ?></p>
                        <div class="d-flex">
                            <div class="btn-group" role="group">
                                <a href='admin_edit_product.php?id=<?php echo $product['id']; ?>' class='btn btn-warning'><i class='fas fa-edit'></i> Edit</a>&nbsp;
                                <a href='admin_delete_product.php?id=<?php echo $product['id']; ?>' class='btn btn-danger'><i class='fas fa-trash'></i> Delete</a>&nbsp;
                                <?php if ($product['status'] == 'Active'): ?>
                                    <a href='admin_toggle_product_status.php?id=<?php echo $product['id']; ?>&status=Inactive' class='btn btn-success'><i class='fas fa-toggle-on'></i> Deactivate</a>&nbsp;
                                <?php elseif ($product['status'] == 'Inactive'): ?>
                                    <a href='admin_toggle_product_status.php?id=<?php echo $product['id']; ?>&status=Active' class='btn btn-dark'><i class='fas fa-toggle-off'></i> Activate</a>
                                    <?php else: ?>&nbsp;
                                    <a class='btn btn-secondary'><i class='fa-solid fa-user-xmark'></i> Deleted</a>
                                    <?php endif; ?>&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h3>Other Images</h3>
            <div class="row">
                <?php
                $other_images = explode(",", $product['other_images']);
                foreach ($other_images as $image) {
                    echo '<div class="col-md-3"><img src="images/products/' . $image . '" class="img-fluid" alt="Additional Image" style="width: 100%; height: 80%; margin: 5px; object-fit: contain;"></div>';
                    // echo '<div class="col-md-3"><img src="images/products/' . $image . '" class="img-thumbnail" alt="Additional Image" style="width: 100%; margin: 5px;"></div>';
                }
                ?>
            </div>
            <!-- End Generation Here -->
        </div>
<?php
    } else {
        echo "<p>Product not found.</p>";
    }
}
