<?php
include_once("header.php");
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $q = "select * from registration where id=$id";
    $result = mysqli_query($con, $q);
?>

    <script>
        $(document).ready(function() {
            $.validator.addMethod("emailNotRegistered", function(value, element) {
                var isValid = false;
                $.ajax({
                    url: 'check_email.php',
                    type: 'POST',
                    data: {
                        email: value
                    },
                    async: false,
                    success: function(response) {
                        isValid = (response == 'available');
                    }
                });
                return isValid;
            }, "This email is already registered");
            $("#form1").validate({
                rules: {
                    fn: {
                        required: true,
                        minlength: 3,
                        pattern: /^[A-Za-z\s]+$/
                    },
                    email: {
                        required: true,
                        email: true,
                        emailNotRegistered: true
                    },
                    pswd: {
                        required: true,
                        minlength: 8,
                        maxlength: 25,
                        pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,25}$/
                    },
                    repswd: {
                        required: true,
                        equalTo: "#pwd"
                    },
                    address: {
                        required: true,
                        minlength: 10
                    },
                    gen: {
                        required: true
                    },
                    mobile: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    pic: {
                        accept: "image/*",
                        filesize: ""
                    }
                },
                messages: {
                    fn: {
                        required: "Please enter your full name",
                        minlength: "Full name must be at least 3 characters long",
                        pattern: "Fullname must contain letters and spaces"
                    },
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address",
                        emailNotRegistered: "This email is already registered"
                    },
                    pswd: {
                        required: "Please provide a password",
                        minlength: "Password must be at least 8 characters long",
                        maxlength: "Password must not be greater than 25 characters",
                        pattern: "Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character"
                    },
                    repswd: {
                        required: "Please confirm your password",
                        minlength: "Password must be at least 6 characters long",
                        equalTo: "Password and Confirm Passwords do not match"
                    },
                    address: {
                        required: "Please enter your address",
                        minlength: "Address must be at least 10 characters long"
                    },
                    gen: {
                        required: "Please select your gender"
                    },
                    mobile: {
                        required: "Please enter your mobile number",
                        digits: "Please enter only digits",
                        minlength: "Mobile number must be exactly 10 digits long",
                        maxlength: "Mobile number must be exactly 10 digits long"
                    },
                    pic: {
                        accept: "Only image files are allowed",
                        filesize: "Image size must be less than 2 MB"
                    }
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    if (element.attr("name") === "gen") {
                        error.insertAfter("#gen_err");
                    } else {
                        error.insertAfter(element);
                    }
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
                <h1>Edit User Details</h1>
            </div>
        </div>
        <br>
        <div class="row">
            <?php
            while ($row = mysqli_fetch_array($result)) {
            ?>

                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-2"></div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-xs-12 col-sm-12">
                    <form action="admin_edit_user.php" method="post" enctype="multipart/form-data" id="form1">
                        <div class="form-group">
                            <label for="fn1"><b>Fullname:</b></label>
                            <input type="text" class="form-control" id="fn1" placeholder="Enter Name" name="fn" value="<?php echo $row['fullname']; ?>">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="email1"><b>Email:</b></label>
                            <input type="email" class="form-control" id="email1" placeholder="Enter email" name="email" value="<?php echo $row['email']; ?>" readonly>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="pwd"><b>Password:</b></label>
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" value="<?php echo $row['password']; ?>">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="repwd"><b>Confirm Password: </b></label>
                            <input type="password" class="form-control" id="repwd" placeholder="Enter password" name="repswd" value="<?php echo $row['password']; ?>">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="address1"><b>Enter Address:</b></label>
                            <textarea class="form-control" id="address1" name="address"><?php echo $row['address']; ?></textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="gen1"><b>Select Gender:</b></label>
                            <br>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" id="genMale" name="gen" value="Male" <?php if ($row['gender'] == "Male") {
                                                                                                    echo "checked";
                                                                                                } ?>> Male
                                </label>
                                <label class="radio-label">
                                    <input type="radio" id="genFemale" name="gen" value="Female" <?php if ($row['gender'] == "Female") {
                                                                                                        echo "checked";
                                                                                                    } ?>> Female
                                </label>
                                <span id="gen_err" class="radio-error"></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="mobile1"><b>Mobile Number: </b></label>
                            <input type="number" class="form-control" id="mobile1" placeholder="1234567890" name="mobile" value="<?php echo $row['mobile_number']; ?>">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="file1"><b>Select Profile Picture:</b></label>
                            <input type="file" class="form-control" id="file1" name="pic">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="s1"><b>Select Status</b></label>
                            <select name="status" id="s1" class="form-control">
                                <option value="Active" <?php if ($row['status'] == 'Active') {
                                                            echo "selected";
                                                        }  ?>>Active</option>
                                <option value="Inactive" <?php if ($row['status'] == 'Inactive') {
                                                                echo "selected";
                                                            }  ?>>Inactive</option>
                                <option value="Deleted" <?php if ($row['status'] == 'Deleted') {
                                                            echo "selected";
                                                        }  ?>>Deleted</option>
                            </select>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-success" value="Submit" name="updt_btn">
                    </form>
                </div>
        </div>
    </div>
<?php
            }
        }
?>
</div>

<?php
include_once('admin_footer.php');
if (isset($_POST['updt_btn'])) {
    $name = $_POST['fn']; // Fetch the name from the form
    $password = $_POST['pswd']; // Fetch the password from the form
    $email = $_POST['email'];
    $address = $_POST['address'];
    $gender = $_POST['gen'];
    $mobile = $_POST['mobile'];
    $status = $_POST['status'];
    $pic = $_FILES['pic']['name'];

    // Prepare the SQL update statement
    $update_query = "UPDATE registration SET fullname='$name',address='$address', gender='$gender', mobile_number=$mobile,status='$status'";

    // Check if a new profile picture is uploaded
    if (!empty($pic)) {
        // Move the uploaded file to the desired directory
        $pic_name = uniqid() . $_FILES['pic']['name'];
        move_uploaded_file($_FILES['pic']['tmp_name'], "images/profile_pictures/$pic_name");
        $update_query .= ", profile_picture='$pic_name'"; // Add profile picture to the update query

    }

    // Complete the update query
    $update_query .= " WHERE email='$email'";
    echo $update_query;
    $current_query = "SELECT profile_picture FROM registration WHERE email='$email'";
    $current_result = mysqli_query($con, $current_query);
    $current_row = mysqli_fetch_assoc($current_result);
    $current_pic = $current_row['profile_picture'];
    echo $current_pic;
    // Execute the update query
    if (mysqli_query($con, $update_query)) {
        // Check if a new profile picture is uploaded
        if (!empty($pic)) {
            // Fetch the current profile picture from the database


            // Remove the old profile picture if it exists
            if (!empty($current_pic) && file_exists("images/profile_pictures/$current_pic")) {
                unlink("images/profile_pictures/$current_pic");
            }
        }
        setcookie('success', 'User details updated successfully.', time() + 5, '/');
    } else {
        setcookie('error', 'Error updating user details. Please try again.', time() + 5, '/');
    }

    // Redirect to the manage users page
    echo "<script>window.location.href = 'manage_users.php';</script>";
}
