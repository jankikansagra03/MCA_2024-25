<?php
include_once("header.php");
?>
<script>
    $(document).ready(function() {
        $("#form1").validate({
            rules: {
                otp: {
                    required: true,
                    digits: true,
                    minlength: 6,
                    maxlength: 6
                }
            },
            messages: {
                otp: {
                    required: "Please enter the OTP",
                    digits: "Please enter a valid OTP",
                    minlength: "OTP must be 6 digits",
                    maxlength: "OTP must be 6 digits"
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
            <h1>OTP Verification</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-2"></div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-xs-12 col-sm-12">
            <br>
            <form action="otp_form.php" method="post" id="form1">
                <div class="form-group">
                    <label for="otp"><b>OTP:</b></label>
                    <input type="text" class="form-control" id="otp1" placeholder="Enter OTP" name="otp">
                </div>
                <br>
                <div id="timer" class="text-danger"></div>
                <br>
                <input type="button" id="resend_otp" class="btn btn-warning" style="display:none;" value="Resend OTP">
                <script>
                    let timeLeft = 60; // 1 minute timer
                    const timerDisplay = document.getElementById('timer');
                    const resendButton = document.getElementById('resend_otp');

                    // Function to start the countdown
                    function startCountdown() {
                        const countdown = setInterval(() => {
                            if (timeLeft <= 0) {
                                clearInterval(countdown);
                                timerDisplay.innerHTML = "You can now resend the OTP.";
                                resendButton.style.display = "inline";
                                timeLeft = 60;
                            } else {
                                timerDisplay.innerHTML = `Resend OTP in ${timeLeft} seconds`;
                            }
                            timeLeft -= 1;
                        }, 1000);
                    }

                    // Check if there's a remaining time in sessionStorage
                    if (sessionStorage.getItem('otpTimer')) {
                        timeLeft = parseInt(sessionStorage.getItem('otpTimer'));
                        startCountdown();
                    } else {
                        startCountdown();
                    }

                    // Update sessionStorage every second
                    setInterval(() => {
                        sessionStorage.setItem('otpTimer', timeLeft);
                    }, 1000);

                    resendButton.onclick = function(event) {
                        event.preventDefault(); // Prevent the default form submission
                        window.location.href = 'resend_otp_forgot_password.php';
                    };
                </script>
                <input type="submit" class="btn btn-success " value="Submit" name="otp_btn" />
            </form>
        </div>
    </div>
    <br>

</div>




<?php
include_once("footer.php");
if (isset($_POST['otp_btn'])) {

    if (isset($_SESSION['forgot_email'])) {
        $email = $_SESSION['forgot_email'];
        $otp = $_POST['otp'];

        // Fetch the OTP from the database for the given email
        $query = "SELECT otp FROM password_token WHERE email = '$email' ";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $db_otp = $row['otp'];

            // Compare the OTPs
            if ($otp == $db_otp) {
                // Redirect to new password page
?>
                <script>
                    window.location.href = 'new_password_form.php';
                </script>
            <?php

            } else {
                setcookie('error', 'Incorrect OTP', time() + 5, '/');
            ?>

                <script>
                    window.location.href = 'otp_form.php';
                </script>
            <?php
            }
        } else {
            setcookie('error', 'OTP has expired. Regenerate New OTP', time() + 2, '/');
            ?>
            <script>
                window.location.href = 'Forgot_password.php';
            </script>
<?php
        }
    }
}
?>