<?php
include_once('header.php');
?>
<script>
    $(document).ready(function() {
        $("#form1").validate({
            rules: {
                fn: {
                    required: true,
                    minlength: 3,
                    pattern: /^[A-Za-z\s]+$/
                },
                email: {
                    required: true,
                    email: true
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

                    accept: "image/*"
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
                    email: "Please enter a valid email address"
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

                    accept: "Only image files are allowed"
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
<?php
$id = $_GET['id'];

$q = "Select * from registration where `id`=$id";
$result = mysqli_query($con, $q);

while ($r = mysqli_fetch_array($result)) {
    //     echo $r[0] . "<br/>";
    //     echo $r[1] . "<br/>";
    //     echo $r[2] . "<br/>";
    //     echo $r[3] . "<br/>";
    //     echo $r[4] . "<br/>";
    //     echo $r[5] . "<br/>";
    //     echo $r[6] . "<br/>";
    // 
?>
    <div class="container">
        <div class="row text-center">
            <div class="col-12 bg-dark text-white p-4 align-center">
                <h1>Edit USer</h1>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-2"></div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-xs-12 col-sm-12">
                <form action="edit_user_action.php" method="post" enctype="multipart/form-data" id="form1">
                    <div class="form-group">
                        <label for="fn1"><b>Fullname:</b></label>
                        <input type="text" class="form-control" id="fn1" placeholder="Enter Name" name="fn" value="<?php echo $r[1]; ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email1"><b>Email:</b></label>
                        <input type="email" class="form-control" id="email1" placeholder="Enter email" name="email" value="<?php echo $r[2]; ?>">
                    </div>
                    <br>
                    <div class=" form-group">
                        <label for="pwd"><b>Password:</b></label>
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" value="<?php echo $r[3]; ?>">
                    </div>
                    <br>
                    <div class=" form-group">
                        <label for="repwd"><b>Confirm Password: </b></label>
                        <input type="password" class="form-control" id="repwd" placeholder="Enter password" name="repswd" value="<?php echo $r[3]; ?>">
                    </div>
                    <br>
                    <div class=" form-group">
                        <label for="address1"><b>Enter Address:</b></label>
                        <textarea class="form-control" id="address1" name="address"><?php echo $r[4]; ?></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="gen1"><b>Select Gender:</b></label>
                        <br>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" id="genMale" name="gen" value="Male" <?php if ($r[5] == "Male")
                                                                                                echo "checked" ?>> Male
                            </label>
                            <label class="radio-label">
                                <input type="radio" id="genFemale" name="gen" value="Female" <?php if ($r[5] == "Female")
                                                                                                    echo "checked" ?>> Female
                            </label>
                            <span id="gen_err" class="radio-error"></span>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="mobile1"><b>Mobile Number: </b></label>
                        <input type="number" class="form-control" id="mobile1" placeholder="1234567890" name="mobile" value="<?php echo $r[6]; ?>">
                    </div>
                    <br>
                    <div>
                        <img src="images/profile_pictures/<?php echo $r[7]; ?>" alt="" width="200px" height="120px">
                    </div>
                    <div class=" form-group">
                        <label for="file1"><b>Select Profile Picture:</b></label>
                        <input type="file" class="form-control" id="file1" name="pic">
                    </div>
                    <br>
                    <input type="submit" class="btn btn-success" value="Submit" name="btn">
                </form>
            </div>
        </div>
    </div>
    </div>
    <?php
}

