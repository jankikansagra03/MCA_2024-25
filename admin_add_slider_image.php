<?php
include_once("header.php");
include_once("admin_authentication.php");

?>
<script>
    $(document).ready(function() {
        $("#form1").validate({
            rules: {
                pic: {
                    required: true,
                    accept: "image/*"
                }
            },
            messages: {
                pic: {
                    required: "Please select a profile picture",
                    accept: "Only image files are allowed"
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
        <div class="col-12 bg-dark text-white p-4 align-center">
            <h1>Add new Slider Image</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-2"></div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-xs-12 col-sm-12">
            <form action="admin_add_slider_image.php" method="post" enctype="multipart/form-data" id="form1">

                <div class="form-group">
                    <label for="file1"><b>Select Slider Image</b></label>
                    <input type="file" class="form-control" id="file1" name="pic">
                </div>
                <br>
                <input type="submit" class="btn btn-dark" value="Submit" name="btn">
            </form>
        </div>
    </div>
</div>
</div>
<?php
include_once("admin_footer.php");
if (isset($_POST['btn'])) {
    $pic = uniqid() . $_FILES['pic']['name'];

    $q = "insert into sliders (`img_name`) values('$pic')";
    if (mysqli_query($con, $q)) {
        if (!is_dir('images/slider')) {
            mkdir("images/slider");
        }
        move_uploaded_file($_FILES['pic']['tmp_name'], "images/slider/" . $pic);
        setcookie('success', 'Image saved Sucessfully', time() + 5, "/");
        echo "<script> window.location.href = 'admin_manage_slider.php';</script>";
    }
}
