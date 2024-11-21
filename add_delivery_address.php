<?php
include_once("header.php");
include_once("user_authentication.php");
$email = $_SESSION['user'];
?>
<script>
    $(document).ready(function() {

        $("#addressForm").validate({
            rules: {
                person_name: {
                    required: true,
                    minlength: 2
                },
                mobile_number: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 15
                },
                address_line_1: {
                    required: true
                },
                city: {
                    required: true
                },
                zip: {
                    required: true,
                    digits: true,
                    minlength: 5,
                    maxlength: 10
                },
                email_address: {
                    required: true,
                    email: true
                },
                address_line_2: {
                    required: true
                },
                state: {
                    required: true
                },
                country: {
                    required: true
                }
            },
            messages: {
                person_name: {
                    required: "Please enter your name",
                    minlength: "Name must be at least 2 characters long"
                },
                mobile_number: {
                    required: "Please enter your mobile number",
                    digits: "Please enter a valid mobile number",
                    minlength: "Mobile number must be at least 10 digits",
                    maxlength: "Mobile number must be at most 15 digits"
                },
                address_line_1: {
                    required: "Please enter your address line 1"
                },
                address_line_2: {
                    required: "Please enter your address line 1"
                },
                city: {
                    required: "Please enter your city"
                },
                zip: {
                    required: "Please enter your zip code",
                    digits: "Please enter a valid zip code",
                    minlength: "Zip code must be at least 5 digits",
                    maxlength: "Zip code must be at most 10 digits"
                },

                email_address: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                state: {
                    required: "Please enter your state"
                },
                country: {
                    required: "Please enter your country"
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
            <h1>Add Delivery Address</h1>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <div class="row">
            <div class="col-12">
                <br>
                <form action="add_delivery_address.php" method="post" id="addressForm">
                    <div class="row">
                        <div class="col">
                            <div class=" form-group">
                                <label for="person_name"><b>Person Name:</b></label>
                                <input type="text" id="person_name" name="person_name" class="form-control" placeholder="Enter person's name">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="email_address"><b>Email Address:</b></label>
                                <input type="email" id="email_address" name="email_address" class="form-control" placeholder="Enter email address">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="mobile_number"><b>Mobile Number:</b></label>
                                <input type="text" id="mobile_number" name="mobile_number" class="form-control" placeholder="Enter mobile number">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="line_1"><b>Address Line 1:</b></label>
                                <input type="text" id="line_1" name="address_line_1" class="form-control" placeholder="Enter address line 1">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="address"><b>Address Line 2:</b></label>
                                <input type="text" id="address" name="address_line_2" class="form-control" placeholder="Enter your address">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="city"><b>City:</b></label>
                                <input type="text" id="city" name="city" class="form-control" placeholder="Enter your city">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="zip"><b>Zip Code:</b></label>
                                <input type="text" id="zip" name="zip" class="form-control" placeholder="Enter your zip code">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="state"><b>State:</b></label>
                                <input type="text" id="state" name="state" class="form-control" placeholder="Enter your state">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="country"><b>Country:</b></label>
                                <input type="text" id="country" name="country" class="form-control" placeholder="Enter your country">
                            </div>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group text-center">
                                <br>
                                <input type="submit" class="btn btn-dark" value="Add Address" name="address" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once('admin_footer.php');
if (isset($_POST['address'])) {
    $person_name = $_POST['person_name'];
    $email_address = $_POST['email_address'];
    $mobile_number = $_POST['mobile_number'];
    $address_line_1 = $_POST['address_line_1'];
    $address_line_2 = $_POST['address_line_2'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $delivery_address = $person_name . "<br>" . $address_line_1 . "<br>" . $address_line_2 . "<br>" . $city . "-" . $zip . "<br>" . $state . "<br>" . $country . "<br>Mobile: " . $mobile_number . "<br>Email::" . $email_address;
    $insert = "INSERT INTO `address`(`email`, `delivery_address`) VALUES ('$email','$delivery_address')";
    if (mysqli_query($con, $insert)) {
        setcookie("success", "Address added successfully", time() + 5, "/");
?>
        <script>
            window.location.href = "view_cart.php";
        </script>
    <?php
    } else {
        setcookie("error", "Error in adding address", time() + 5, "/");
    ?>
        <script>
            window.location.href = "add_delivery_address.php";
        </script>
<?php
    }
}
