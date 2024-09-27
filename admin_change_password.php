<?php
include_once("header.php");
?>
<script>
    $(document).ready(function() {
        $("#form1").validate({
            rules: {
                old_password: {
                    required: true,
                },
                new_password: {
                    required: true,
                    minlength: 8,
                    pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,25}$/,
                },
                confirm_password: {
                    required: true,
                    equalTo: "#new_password",
                },
            },
            messages: {
                old_password: {
                    required: "Please enter your old password",
                },
                new_password: {
                    required: "Please enter your new password",
                    minlength: "New password must be at least 8 characters long",
                    pattern: "New password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character",
                },
                confirm_password: {
                    required: "Please confirm your new password",
                    equalTo: "New password and Confirm New Password do not match",
                },
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                element.after(error);
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
<br>
<div class="container">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-4 align-center">
            <h1>Change Password</h1>
        </div>
    </div>
</div>
<div>
    <br>
    <div class="row">
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-2"></div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-xs-12 col-sm-12">
            <form action="admin_change_password.php" method="post" id="form1">
                <div class="form-group">
                    <label for="old_password"><b>Old Password:</b></label>
                    <input type="text" class="form-control" id="old_password" placeholder="Enter old password" name="old_password" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="new_password"><b>New Password:</b></label>
                    <input type="text" class="form-control" id="new_password" placeholder="Enter new password" name="new_password" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="confirm_password"><b>Confirm New Password:</b></label>
                    <input type="text" class="form-control" id="confirm_password" placeholder="Confirm new password" name="confirm_password" required>
                </div>
                <br>
                <button type="submit" class="btn btn-dark" name="change_password">Change Password</button>
            </form>
        </div>
    </div>
</div>

<?php

include_once("admin_footer.php");
if (isset($_POST['change_password'])) {
    $old_pwd = $_POST['old_password'];
    $new_pwd = $_POST['new_password'];
    $em = $_SESSION['admin_user'];

    $q = "select * from registration where `email`='$em'";
    $result = mysqli_query($con, $q);
    while ($r = mysqli_fetch_assoc($result)) {
        if ($r['password'] == $old_pwd) {
            $q = "UPDATE registration SET password='$new_pwd' WHERE email='$em'";
            if (mysqli_query($con, $q)) {
                setcookie('success', 'Password changed successfully', time() + 5, "/");
?>
                <script>
                    window.location.href = "admin_dashboard.php";
                </script>
            <?php
            } else {
                setcookie('error', 'Failed to change password', time() + 5, "/");
            ?>
                <script>
                    window.location.href = "admin_change_password.php";
                </script>
            <?php
            }
        } else {
            setcookie('error', 'Incorrect Old Password', time() + 5, "/");
            ?>
            <script>
                window.location.href = "admin_change_password.php";
            </script>
<?php
        }
    }
}

?>