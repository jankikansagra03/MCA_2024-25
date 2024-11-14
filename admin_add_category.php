<?php
include_once("header.php");
include_once("admin_authentication.php");
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
            <h1>Add New Category</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-2"></div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-xs-12 col-sm-12">
            <form action="admin_add_category.php" method="post" enctype="multipart/form-data" id="form1">
                <div class="form-group">
                    <label for="fn1"><b>Category:</b></label>
                    <input type="text" class="form-control" id="fn1" placeholder="Enter Name" name="category">
                </div>
                <br>
                <input type="submit" class="btn btn-success" value="Submit" name="btn">
            </form>
        </div>
    </div>
</div>
</div>

<?php
include_once('admin_footer.php');
if (isset($_POST['btn'])) {

    //Form data extraction

    // Start Generation Here
    $category_name = $_POST['category'];

    // Insert the category into the category_master table
    $query = "INSERT INTO category_master (category_name) VALUES ('$category_name')";

    if (mysqli_query($con, $query)) {
        setcookie('success', 'Category added successfully.', time() + 5, '/');
?>
        <script>
            window.location.href = "manage_category.php";
        </script>
    <?php
    } else {
        setcookie('error', 'Error in adding category.', time() + 5, '/');
    ?>
        <script>
            window.location.href = "admin_add_category.php";
        </script>
<?php
    }
}
