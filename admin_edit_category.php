<?php
include_once("header.php");
include_once('admin_authentication.php');
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $q = "select * from category_master where id=$id";
    $result = mysqli_query($con, $q);
}
?>
<script>
    $(document).ready(function() {
        $('#form1').validate({
            rules: {
                category: {
                    required: true,
                    minlength: 3,
                    pattern: /^[a-zA-Z\s]+$/ // Allows only letters and spaces
                }
            },
            messages: {
                category: {
                    required: "Please enter a category name",
                    minlength: "Category name must be at least 3 characters long",
                    pattern: "Category must contain only letters"
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
<div class="container">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-2 align-center">
            <h1>Edit Category</h1>
        </div>
    </div>
    <br>
    <?php
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <div class="row">
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-2"></div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-xs-12 col-sm-12">
                <form action="admin_edit_category.php" method="post" enctype="multipart/form-data" id="form1">
                    <div class="form-group">
                        <label for="fn1"><b>Category ID:</b></label>
                        <input type="text" class="form-control" id="fn1" placeholder="Enter Name" name="id" value="<?php echo $row['id']; ?>" readonly>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="fn1"><b>Category:</b></label>
                        <input type="text" class="form-control" id="fn1" placeholder="Enter Name" name="category" value="<?php echo $row['category_name']; ?>">
                    </div>
                    <br>
                    <input type="submit" class="btn btn-success" value="Submit" name="btn">
                </form>
            </div>
        </div>
    <?php
    }
    ?>
</div>

</div>

<?php
include_once('admin_footer.php');
if (isset($_POST['btn'])) {
    $category_name = $_POST['category']; // Fetch the category name from the form
    $id = $_POST['id'];
    // Prepare the SQL update statement
    $update_query = "UPDATE category_master SET category_name='$category_name' WHERE id=$id"; // Assuming category_id is available in the $row

    // Execute the update query
    if (mysqli_query($con, $update_query)) {
        setcookie('success', 'Category updated successfully.', time() + 5, '/');
        echo "<script>window.location.href = 'manage_category.php';</script>";
    } else {
        setcookie('error', 'Error in updating category.', time() + 5, '/');
        echo "<script>window.location.href = 'admin_edit_category.php';</script>";
    }
}
