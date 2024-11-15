<?php
include_once("header.php");
include_once("admin_authentication.php");

?>
<script>
    $(document).ready(function() {
        $("#form1").validate({
            rules: {
                offer_title: {
                    required: true,
                    minlength: 5
                },
                offer_description: {
                    required: true,
                    minlength: 10
                },
                discount_percentage: {
                    required: true,
                    number: true,
                    min: 0,
                    max: 100
                },
                max_discount_amount: {
                    required: true,
                    number: true,
                    min: 0
                },
                order_total: {
                    required: true,
                    number: true,
                    min: 0
                },
                start_date: {
                    required: true,
                    date: true
                },
                end_date: {
                    required: true,
                    date: true
                },
                status: {
                    required: true
                }
            },
            messages: {
                offer_title: {
                    required: "Please enter an offer title",
                    minlength: "Offer title must be at least 5 characters long"
                },
                offer_description: {
                    required: "Please enter an offer description",
                    minlength: "Offer description must be at least 10 characters long"
                },
                discount_percentage: {
                    required: "Please enter a discount percentage",
                    number: "Discount percentage must be a number",
                    min: "Discount percentage must be at least 0",
                    max: "Discount percentage cannot exceed 100"
                },
                max_discount_amount: {
                    required: "Please enter a maximum discount amount",
                    number: "Maximum discount amount must be a number",
                    min: "Maximum discount amount must be at least 0"
                },
                order_total: {
                    required: "Please enter an order total",
                    number: "Order total must be a number",
                    min: "Order total must be at least 0"
                },
                start_date: {
                    required: "Please select a start date",
                    date: "Please enter a valid date"
                },
                end_date: {
                    required: "Please select an end date",
                    date: "Please enter a valid date"
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
<div class="container">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-2 align-center">
            <h1>Add New Offer</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-2"></div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-xs-12 col-sm-12">
            <form action="admin_add_offer.php" method="post" enctype="multipart/form-data" id="form1">
                <div class="form-group">
                    <label for="offerTitle"><b>Offer Title:</b></label>
                    <input type="text" class="form-control" id="offerTitle" placeholder="Enter Offer Title" name="offer_title">
                </div>
                <br>
                <div class="form-group">
                    <label for="offerDescription"><b>Offer Description:</b></label>
                    <textarea class="form-control" id="offerDescription" placeholder="Enter Offer Description" name="offer_description"></textarea>
                </div>
                <br>
                <div class="form-group">
                    <label for="discountPercentage"><b>Discount Percentage:</b></label>
                    <input type="number" class="form-control" id="discountPercentage" placeholder="Enter Discount Percentage" name="discount_percentage" min="0" max="100">
                </div>
                <br>
                <div class="form-group">
                    <label for="maxDiscountAmount"><b>Maximum Discount Amount:</b></label>
                    <input type="number" class="form-control" id="maxDiscountAmount" placeholder="Enter Maximum Discount Amount" name="max_discount_amount" min="0">
                </div>
                <br>
                <div class="form-group">
                    <label for="orderTotal"><b>Order Total:</b></label>
                    <input type="number" class="form-control" id="orderTotal" placeholder="Enter Order Total" name="order_total" min="0">
                </div>
                <br>
                <div class="form-group">
                    <label for="startDate"><b>Start Date:</b></label>
                    <input type="date" class="form-control" id="startDate" name="start_date">
                </div>
                <br>
                <div class="form-group">
                    <label for="endDate"><b>End Date:</b></label>
                    <input type="date" class="form-control" id="endDate" name="end_date">
                </div>
                <br>
                <div class="form-group">
                    <label for="status"><b>Status:</b></label>
                    <select class="form-control" id="status" name="status">
                        <option value="">Select Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-dark" name="offer_btn">Add Offer</button>
            </form>
        </div>
    </div>
</div>
<?php
include_once("admin_footer.php");
if (isset($_POST['offer_btn'])) {
    //     $email = $_SESSION['user']; // Assuming the user is logged in and their email is stored in the session
    $offer_title = $_POST['offer_title'];
    $offer_description = $_POST['offer_description'];
    $discount_percentage = $_POST['discount_percentage'];
    $max_discount_amount = $_POST['max_discount_amount'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = $_POST['status'];
    $order_total = $_POST['order_total'];

    $q = "INSERT INTO offers (offer_name, offer_description, discount_percentage, max_discount, start_date, end_date, status, cart_total) 
      VALUES ('$offer_title', '$offer_description', $discount_percentage, $max_discount_amount, '$start_date', '$end_date', '$status', $order_total)";


    if (mysqli_query($con, $q)) {
        setcookie('success', "Offer added successfully", time() + 5, "/");
        echo "<script>window.location.href = 'manage_offers.php';</script>";
    } else {
        setcookie('error', 'Error in adding offer', time() + 5, "/");
        echo "<script>window.location.href = 'admin_add_offers.php';</script>";
    }
}
