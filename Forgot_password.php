<?php
include_once("header.php");
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
?>
<script>
    $(document).ready(function() {
        $("#form1").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
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
            <h1>Forgot Password</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-2"></div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-xs-12 col-sm-12">
            <br>
            <form action="Forgot_password.php" method="post" id="form1">
                <div class="form-group">
                    <label for="email"><b>Email:</b></label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <br>
                <input type="submit" class="btn btn-success " value="Submit" name="frgt_btn" />
            </form>
        </div>
    </div>
    <br>

</div>

<?php

include_once("footer.php");

if (isset($_POST['frgt_btn'])) {
    $email = $_POST["email"];

    // Check if the email is registered in the registration table
    $check_query = "SELECT * FROM registration WHERE email = '$email'";
    $check_result = mysqli_query($con, $check_query);

    if ($check_result && mysqli_num_rows($check_result) == 0) {
        // Email is not registered, display error message
        setcookie('error', "This email is not registered.", time() + 5, "/");
?>
        <script>
            window.location.href = "Forgot_password.php";
        </script>
    <?php
        exit; // Stop further execution
    }

    // Check if the email already exists in the password_token table
    $query = "SELECT * FROM password_token WHERE email = '$email'";
    $result = mysqli_query($con, $query);


    if ($result && mysqli_num_rows($result) > 0) {
        // Email exists, display error message and redirect to OTP form
        setcookie('error', "An OTP has already been sent to this email. New OTP will be generated once current OTP expires.", time() + 5, "/");
    ?>
        <script>
            window.location.href = "otp_form.php";
        </script>
        <?php
    } else {



        // Generate OTP
        $otp = rand(100000, 999999);

        // Use PHPMailer to send the OTP


        $mail = new PHPMailer();
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true;
            $mail->Username = 'kansagrajanki@gmail.com'; // SMTP username
            $mail->Password = 'Your Password'; // SMTP password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('kansagrajanki@gmail.com', 'Janki Kansagra');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your OTP for Password Reset';
            $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 5px; }
                h1 { color: black; }
                .otp { font-size: 24px; font-weight: bold; color: #007bff; }
                .footer { margin-top: 20px; font-size: 0.8em; color: #777; }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>Forgot Your Password?</h1>
                <p>We received a request to reset your password. Here is your One-Time Password (OTP):</p>
                <p class='otp'>$otp</p>
                <p>Please enter this OTP on the website to proceed with resetting your password.</p>
                <p>If you did not request a password reset, please ignore this email.</p>
                <div class='footer'>
                    <p>This is an automated message, please do not reply to this email.</p>
                </div>
            </div>
        </body>
        </html>
        ";

            $mail->send();

            // Store the email, OTP, and timestamps in the database
            $email_time = date("Y-m-d H:i:s");
            $expiry_time = date("Y-m-d H:i:s", strtotime('+1 minutes')); // OTP valid for 10 minutes
            $query = "INSERT INTO  password_token  (email, otp, created_at, expires_at) VALUES ('$email', '$otp', '$email_time', '$expiry_time')";
            mysqli_query($con, $query);


            $_SESSION['forgot_email'] = $email;
            setcookie('success', "OTP for resetting your password is sent to the registered mail address", time() + 2, "/")
        ?>
            <script>
                window.location.href = "otp_form.php";
            </script>
<?php
            exit;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>