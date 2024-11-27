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
<?php
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    $query = "SELECT * FROM address WHERE id = $id";
    $result = mysqli_query($con, $query);
    $address_data = mysqli_fetch_assoc($result);

    if ($address_data) {
        $delivery_address = $address_data['delivery_address'];
        $addr = explode("<br>", $delivery_address);

?>
        <div class="container">
            <div class="row text-center">
                <div class="col-12 bg-dark text-white p-2 align-center">
                    <h1>Edit Address</h1>
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
                        <form action="edit_delivery_address.php" method="post" id="addressForm">
                            <div class="row">


                                <input type="text" id="id" name="id" class="form-control" placeholder="Enter person's name" value="<?php echo $address_data['id']; ?>" hidden>

                                <div class="col">
                                    <div class=" form-group">
                                        <label for="person_name"><b>Person Name:</b></label>
                                        <input type="text" id="person_name" name="person_name" class="form-control" placeholder="Enter person's name" value="<?php echo $addr[0]; ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email_address"><b>Email Address:</b></label>
                                        <input type="email" id="email_address" name="email_address" class="form-control" placeholder="Enter email address" value="<?php echo substr($addr[7], 7); ?>">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class=" row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="mobile_number"><b>Mobile Number:</b></label>
                                        <input type="text" id="mobile_number" name="mobile_number" class="form-control" placeholder="Enter mobile number" value="<?php echo substr($addr[6], 8); ?>">
                                    </div>
                                </div>
                                <div class=" col">
                                    <div class="form-group">
                                        <label for="line_1"><b>Address Line 1:</b></label>
                                        <input type="text" id="line_1" name="address_line_1" class="form-control" placeholder="Enter address line 1" value="<?php echo $addr[1]; ?>">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class=" row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="address"><b>Address Line 2:</b></label>
                                        <input type="text" id="address" name="address_line_2" class="form-control" placeholder="Enter your address" value="<?php echo $addr[2]; ?>">
                                    </div>
                                </div>
                                <div class=" col">
                                    <div class="form-group">
                                        <label for="city"><b>City:</b></label>
                                        <input type="text" id="city" name="city" class="form-control" placeholder="Enter your city" value="<?php echo substr($addr[3], 0, -7); ?>">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class=" row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="zip"><b>Zip Code:</b></label>
                                        <input type="text" id="zip" name="zip" class="form-control" placeholder="Enter your zip code" value="<?php echo substr($addr[3], -6); ?>">
                                    </div>
                                </div>
                                <div class=" col">
                                    <div class="form-group">
                                        <label for="state"><b>State:</b></label>
                                        <input type="text" id="state" name="state" class="form-control" placeholder="Enter your state" value="<?php echo $addr[4]; ?>">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class=" row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="country"><b>Country:</b></label>
                                        <input type="text" id="country" name="country" class="form-control" placeholder="Enter your country" value="<?php echo $addr[5]; ?>">
                                    </div>
                                </div>
                                <div class=" col">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group text-center">
                                        <br>
                                        <input type="submit" class="btn btn-dark" value="Edit Address" name="edit_address" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php

    } else {
        echo '<p class="text-danger">Address not found.</p>';
    }
}
?>

<?php
include_once('admin_footer.php');
if (isset($_POST['edit_address'])) {
    $id = $_POST['id'];
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
    $insert = "update `address` set `delivery_address`='$delivery_address' where id=$id";
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
