<?php
// Start Generation Here
include_once("header.php");

?>
<script>
    $(document).ready(function() {
        $("#form1").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 8
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                password: {
                    required: "Please enter a password",
                    minlength: "Password must be at least 8 characters long"
                },
                confirm_password: {
                    required: "Please confirm your password",
                    equalTo: "Passwords do not match"
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

<div class="conatiner">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-4 align-center">
            <h1>Reset Password</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-2"></div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-xs-12 col-sm-12">
            <br>
            <form action="new_password_form.php" method="post" id="form1">
                <div class="form-group">
                    <label for="password"><b>Password:</b></label>
                    <input type="password" class="form-control" id="password" placeholder="Enter new password" name="password" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="confirm_password"><b>Confirm Password:</b></label>
                    <input type="password" class="form-control" id="confirm_password" placeholder="Confirm new password" name="confirm_password" required>
                </div>
                <br>

                <input type="submit" class="btn btn-success " value="Submit" name="reset_pwd_btn" />


            </form>
        </div>
    </div>
    <br>

</div>

<?php
if (isset($_POST['reset_pwd_btn'])) {
    if (isset($_SESSION['forgot_email'])) {
        $email = $_SESSION['forgot_email'];
        $password = $_POST['password'];


        // Update the user's password in the users table (assuming the table is named 'users')
        $update_query = "UPDATE registration SET password = '$password' WHERE email = '$email'";
        if (mysqli_query($con, $update_query)) {
            // Delete the token from the password_token table
            $delete_query = "DELETE FROM password_token WHERE email = '$email'";
            mysqli_query($con, $delete_query);
            unset($_SESSION['forgot_email']);

            setcookie('success', 'Password has been reset successfully.', time() + 5, '/');
?>

            <script>
                window.location.href = 'login.php';
            </script>
        <?php

        } else {
            setcookie('error', 'Error in resetting Password.', time() + 5, '/');
        ?>

            <script>
                window.location.href = 'Forgot_password.php';
            </script>
<?php


        }
    }
}
include_once("footer.php");
