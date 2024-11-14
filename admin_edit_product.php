<?php
include_once("header.php");
include_once("admin_authentication.php");
?>
<?php
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    // Fetch product details
    $query = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($con, $query);
    $product = mysqli_fetch_assoc($result);

    if ($product) {
?>
        <div class="container">
            <div class="row text-center">
                <div class="col-12 bg-dark text-white p-2 align-center">
                    <h1>Edit User Details</h1>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-2"></div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-xs-12 col-sm-12">
                    <form action="admin_update_product.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <?php
                                // Fetch categories for the dropdown
                                $category_query = "SELECT * FROM category_master";
                                $category_result = mysqli_query($con, $category_query);
                                while ($category = mysqli_fetch_assoc($category_result)) {
                                    $selected = ($category['id'] == $product['category_id']) ? 'selected' : '';
                                    echo "<option value='" . $category['id'] . "' $selected>" . htmlspecialchars($category['category_name']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Active" <?php echo ($product['status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                                <option value="Inactive" <?php echo ($product['status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($product['description']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="main_image" class="form-label">Main Image</label>
                            <input type="file" class="form-control" id="main_image" name="main_image">
                            <img src="images/products/<?php echo htmlspecialchars($product['main_image']); ?>" alt="Current Image" width="100" class="mt-2">
                        </div>
                        <div class="mb-3">
                            <label for="other_images" class="form-label">Other Images (comma separated)</label>
                            <input type="text" class="form-control" id="other_images" name="other_images" value="<?php echo htmlspecialchars($product['other_images']); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </form>
                </div>
            </div>
        </div>

<?php
    } else {
        echo "<p>Product not found.</p>";
    }
}
?>

<?php
include_once("admin_footer.php");
