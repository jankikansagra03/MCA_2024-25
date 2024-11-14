<?php
include_once("header.php");
include_once("admin_authentication.php");
?>
<script>
    $(document).ready(function() {
        $('#form1').validate({
            rules: {
                product_name: {
                    required: true,
                    minlength: 3
                },
                main_image: {
                    required: true,
                    extension: "jpg|jpeg|png|gif" // Allow specific image formats
                },
                other_images: {
                    extension: "jpg|jpeg|png|gif" // Allow specific image formats
                },
                category_id: {
                    required: true,
                    digits: true
                },
                price: {
                    required: true,
                    number: true,
                    min: 0
                },
                description: {
                    required: true,
                    minlength: 10
                },
                status: {
                    required: true
                }
            },
            messages: {
                product_name: {
                    required: "Please enter a product name",
                    minlength: "Product name must be at least 3 characters long"
                },
                main_image: {
                    required: "Please upload a main image",
                    extension: "Please upload a valid image file (jpg, jpeg, png, gif)"
                },
                other_images: {
                    extension: "Please upload valid image files (jpg, jpeg, png, gif)"
                },
                category_id: {
                    required: "Please enter a category ID",
                    digits: "Category ID must be a number"
                },
                price: {
                    required: "Please enter a price",
                    number: "Price must be a number",
                    min: "Price must be at least 0"
                },
                description: {
                    required: "Please enter a description",
                    minlength: "Description must be at least 10 characters long"
                },
                status: {
                    required: "Please select a status"
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
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/decoupled-document/ckeditor.js"></script>
<style>
    #editor-content {
        width: 100%;
        height: 200px;
    }
</style>
<div class="container">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-2 align-center">
            <h1>Add New Product</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-2"></div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-xs-12 col-sm-12">
            <form action="admin_add_product.php" method="post" enctype="multipart/form-data" id="form1">
                <div class="form-group">
                    <label for="productName"><b>Product Name:</b></label>
                    <input type="text" class="form-control" id="productName" placeholder="Enter Product Name" name="product_name">
                </div>
                <br>
                <div class="form-group">
                    <label for="mainImage"><b>Main Image:</b></label>
                    <input type="file" class="form-control" id="mainImage" name="mainImage">
                </div>
                <br>
                <div class="form-group">
                    <label for="otherImages"><b>Other Images:</b></label>
                    <input type="file" class="form-control" id="otherImages" name="otherImages[]" multiple>
                </div>
                <br>
                <div class="form-group">
                    <label for="categoryId"><b>Category ID:</b></label>
                    <select name="category_id" id="categoryId" class="form-control">

                        <?php
                        // Fetch categories from the database
                        $query = "SELECT id, category_name FROM category_master WHERE status = 'active'";
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['category_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="price"><b>Price:</b></label>
                    <input type="number" class="form-control" id="price" placeholder="Enter Price" name="price" step="0.01">
                </div>
                <br>

                <div class="form-group">


                    <label for="editor-content"><b>Description:</b></label>
                    <!-- Toolbar container -->
                    <div id="toolbar-container"></div>

                    <!-- Editor container -->
                    <div id="editor">

                    </div>

                    <!-- Hidden textarea to store the HTML content -->
                    <textarea id="editor-content" name="description" style="display:inline"></textarea>
                    <br>

                    <script>
                        DecoupledEditor.create(document.querySelector("#editor"), {
                                toolbar: [
                                    "heading",
                                    "bold",
                                    "italic",
                                    "link",
                                    "bulletedList",
                                    "numberedList",
                                    "blockQuote",
                                    "fontColor",
                                    "fontBackgroundColor",
                                    "undo",
                                    "redo",
                                ],
                                heading: {
                                    options: [{
                                            model: "paragraph",
                                            title: "Paragraph",
                                            class: "ck-heading_paragraph",
                                        },
                                        {
                                            model: "heading1",
                                            view: "h1",
                                            title: "Heading 1",
                                            class: "ck-heading_heading1",
                                        },
                                        {
                                            model: "heading2",
                                            view: "h2",
                                            title: "Heading 2",
                                            class: "ck-heading_heading2",
                                        },
                                        {
                                            model: "heading3",
                                            view: "h3",
                                            title: "Heading 3",
                                            class: "ck-heading_heading3",
                                        },
                                        {
                                            model: "heading4",
                                            view: "h4",
                                            title: "Heading 4",
                                            class: "ck-heading_heading4",
                                        },
                                        {
                                            model: "heading5",
                                            view: "h5",
                                            title: "Heading 5",
                                            class: "ck-heading_heading5",
                                        },
                                        {
                                            model: "heading6",
                                            view: "h6",
                                            title: "Heading 6",
                                            class: "ck-heading_heading6",
                                        },
                                    ],
                                },
                                fontColor: {
                                    colors: [{
                                            color: "hsl(0, 0%, 0%)",
                                            label: "Black",
                                        },
                                        {
                                            color: "hsl(0, 75%, 60%)",
                                            label: "Red",
                                        },
                                        {
                                            color: "hsl(30, 75%, 60%)",
                                            label: "Orange",
                                        },
                                        {
                                            color: "hsl(60, 75%, 60%)",
                                            label: "Yellow",
                                        },
                                        {
                                            color: "hsl(120, 75%, 60%)",
                                            label: "Green",
                                        },
                                        {
                                            color: "hsl(180, 75%, 60%)",
                                            label: "Cyan",
                                        },
                                        {
                                            color: "hsl(240, 75%, 60%)",
                                            label: "Blue",
                                        },
                                        {
                                            color: "hsl(300, 75%, 60%)",
                                            label: "Magenta",
                                        },
                                    ],
                                },
                                fontBackgroundColor: {
                                    colors: [{
                                            color: "hsl(0, 0%, 100%)",
                                            label: "White",
                                        },
                                        {
                                            color: "hsl(0, 75%, 60%)",
                                            label: "Red",
                                        },
                                        {
                                            color: "hsl(30, 75%, 60%)",
                                            label: "Orange",
                                        },
                                        {
                                            color: "hsl(60, 75%, 60%)",
                                            label: "Yellow",
                                        },
                                        {
                                            color: "hsl(120, 75%, 60%)",
                                            label: "Green",
                                        },
                                        {
                                            color: "hsl(180, 75%, 60%)",
                                            label: "Cyan",
                                        },
                                        {
                                            color: "hsl(240, 75%, 60%)",
                                            label: "Blue",
                                        },
                                        {
                                            color: "hsl(300, 75%, 60%)",
                                            label: "Magenta",
                                        },
                                    ],
                                },
                            })
                            .then((editor) => {
                                const toolbarContainer = document.querySelector("#toolbar-container");
                                toolbarContainer.appendChild(editor.ui.view.toolbar.element);

                                // Get the HTML content from the editor and update the textarea
                                document.querySelector("#editor-content").value = editor.getData();

                                editor.model.document.on("change:data", () => {
                                    document.querySelector("#editor-content").value = editor.getData();
                                });
                            })
                            .catch((error) => {
                                console.error(error);
                            });
                    </script>


                </div>
                <br>
                <div class="form-group">
                    <label for="status"><b>Status:</b></label>
                    <select name="status" id="status" class="form-control">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="quantity"><b>Quantity:</b></label>
                    <input type="number" class="form-control" id="quantity" placeholder="Enter Quantity" name="quantity">
                </div>
                <br>
                <div class="form-group">
                    <label for="discount"><b>Discount:</b></label>
                    <input type="number" class="form-control" id="discount" placeholder="Enter Discount" name="discount" min="0" max="100">
                </div>
                <br>
                <input type="submit" class="btn btn-success" value="Add Product" name="btn">
            </form>
        </div>
    </div>
</div>
</div>


<?php
include_once("admin_footer.php");
if (isset($_POST['btn'])) {
    $product_name = $_POST['product_name']; // Assuming you have a field for product name in your form
    $category_id = $_POST['category_id']; // Fetch the category ID from the form
    $price = $_POST['price'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $quantity = $_POST['quantity'];
    $discount = $_POST['discount'];
    $target_dir = "images/products/";
    $main_image = uniqid() . $_FILES['mainImage']['name'];


    // Loop through each file in the $_FILES array
    if (!empty($_FILES['otherImages']['name'][0])) {
        foreach ($_FILES['otherImages']['name'] as $key => $extra_image_name) {
            $extra_image_tmp = $_FILES['otherImages']['tmp_name'][$key];
            $extra_image_unique_name = uniqid() . $extra_image_name;
            $extra_images[] = $extra_image_unique_name;
        }
    }

    // Convert the array of image names to a comma-separated string
    $other_images = implode(",", $extra_images);


    $insert_query = "INSERT INTO products (product_name, main_image, other_images, category_id, price, description, status, quantity, discount)  VALUES ('$product_name', '$main_image', '$other_images', $category_id, $price, '$description', '$status', $quantity, $discount)";

    // Execute the insert query
    if (mysqli_query($con, $insert_query)) {
        if (!is_dir($target_dir)) {
            mkdir($target_dir);
        }
        $main_image_path = $target_dir . $main_image;
        move_uploaded_file($_FILES['mainImage']['tmp_name'], $main_image_path);
        setcookie('success', 'Product added successfully.', time() + 5, '/');
        $i = 0;
        for ($i = 0; $i < count($extra_images); $i++) {
            move_uploaded_file($_FILES['otherImages']['tmp_name'][$i], "images/products/" . $extra_images[$i]);
        }
        echo "<script>window.location.href = 'manage_products.php';</script>";
    } else {
        setcookie('error', 'Error in adding product.', time() + 5, '/');
        echo "<script>window.location.href = 'admin_add_product.php';</script>";
    }
}

?>