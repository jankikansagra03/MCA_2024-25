<?php
include_once("header.php");
include_once("admin_authentication.php");

if (isset($_SESSION['admin'])) {
    $email = $_SESSION['admin'];
    $q = "select * from registration where email='$email'";
    $result = mysqli_query($con, $q);
    $row = mysqli_fetch_assoc($result);
}
?>
<div class="container">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-2 align-center">
            <h1>Edit Profile</h1>
        </div>
    </div>
</div>
<br><br>
<script>
    $(document).ready(function() {
        $("#form1").validate({
            rules: {
                fullname: {
                    required: true,
                    minlength: 3,
                    pattern: /^[A-Za-z\s]+$/

                },
                email: {
                    required: true,
                    email: true
                },
                mobile_number: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                address: {
                    required: true,
                    minlength: 5
                },
                gender: {
                    required: true
                },
                profile_picture: {
                    required: false,
                    accept: 'image/*'
                }
            },
            messages: {
                fullname: {
                    required: "Please enter your full name",
                    minlength: "Your full name must be at least 3 characters long",
                    pattern: "Name must contain only letters"
                },
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email"
                },
                mobile_number: {
                    required: "Please enter your mobile number",
                    digits: "Please enter a valid mobile number",
                    minlength: "Mobile number must be 10 digits long",
                    maxlength: "Mobile number must be 10 digits long"
                },
                address: {
                    required: "Please enter your address",
                    minlength: "Your address must be at least 5 characters long"
                },
                gender: {
                    required: "Please select your gender"
                },
                profile_picture: {
                    accept: "Please upload a valid image"
                }
            },
            errorElement: 'div',
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
<div>
    <div class="container">
        <style>
            .form-label {
                font-weight: bold;
            }
        </style>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="admin_edit_profile.php" method="post" enctype="multipart/form-data" id="form1">
                            <div class="form-group">
                                <label for="fullname" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $row['fullname']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="mobile_number" class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="<?php echo $row['mobile_number']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3"><?php echo $row['address']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender">
                                    <option value="Male" <?php if ($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                                    <option value="Female" <?php if ($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                                    <option value="Other" <?php if ($row['gender'] == 'Other') echo 'selected'; ?>>Other</option>
                                </select>
                            </div>
                            <div>
                                <img src="images/profile_pictures/<?php echo $row['profile_picture']; ?>" alt="" width="50%">
                            </div>
                            <div class="mb-3">
                                <label for="profile_picture" class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                            </div>
                            <button type="submit" class="btn btn-dark" name="updt_btn">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include_once('admin_footer.php');
if (isset($_POST['updt_btn'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile_number'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    if ($_FILES['profile_picture']['name'] != "") {
        $profile_picture = $_FILES['profile_picture']['name'];

        $temp = $_FILES['profile_picture']['tmp_name'];
        $profile_picture = uniqid() . $profile_picture;
        move_uploaded_file($temp, "images/profile_pictures/" . $profile_picture);
    } else {
        $profile_picture = $row['profile_picture'];
    }

    $update_query = "UPDATE registration SET fullname='$fullname', mobile_number='$mobile_number', address='$address', gender='$gender', profile_picture='$profile_picture' WHERE email='$email'";
    if (mysqli_query($con, $update_query)) {
        if ($profile_picture != $row['profile_picture']) {
            $old_profile_picture = $row['profile_picture'];
            if (file_exists("images/profile_pictures/" . $old_profile_picture)) {
                unlink("images/profile_pictures/" . $old_profile_picture);
            }
        }
        setcookie("success", "Profile updated successfully", time() + 5, "/");
?>
        <script>
            window.location.href = 'admin_view_profile.php';
        </script>";
    <?php
    } else {
        setcookie("success", "Profile updated successfully", time() + 5, "/");
    ?>
        <script>
            window.location.href = 'admin_edit_profile.php';
        </script>
<?php
    }
}
