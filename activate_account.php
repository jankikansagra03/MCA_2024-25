<?php
include_once 'header.php';

if (isset($_GET['token']) && isset($_GET['email'])) {
    $token = $_GET['token'];
    $email = $_GET['email'];
    // Check if the account is already activated
    $check_query = "SELECT status FROM registration WHERE email = '$email'";
    $check_result = mysqli_query($con, $check_query);

    if ($check_result && mysqli_num_rows($check_result) > 0) {
        $row = mysqli_fetch_assoc($check_result);
        if ($row['status'] == 'Active') {
            // Account is already activated
            setcookie('success', "Your account is already activated. You can login now.", time() + 60, '/');
            echo "<script>window.location.href = 'login.php';</script>";
        } else {
            // Token and email combination is valid, activate the account
            $update_query = "UPDATE registration SET status = 'Active' WHERE token = '$token' AND email = '$email'";

            if (mysqli_query($con, $update_query)) {
                // Start the session if not already started

                // Set the success message in the session
                setcookie('success', "Your account has been successfully activated. You can now login.", time() + 60, '/');

                // Redirect to a page where the message will be displayed (e.g., login page)
                echo "<script>window.location.href = 'login.php';</script>";
            } else {

                // Set an error message in the session
                setcookie('error', "An error occurred while activating your account. Please try again later.", time() + 60, '/');

                // Redirect to the login page
                echo "<script>window.location.href = 'login.php';</script>";
            }
        }
    } else {
        // Set an error message in the session
        setcookie('error', "Invalid activation token or email. Please check your activation link or contact support.", time() + 60, '/');

        // Redirect to the login page
        echo "<script>window.location.href = 'login.php';</script>";
    }
} else {

    // Set an error message in the session
    setcookie('error', "Invalid activation request. Please use the link provided in your activation email.", time() + 60, '/');

    // Redirect to the login page
    echo "<script>window.location.href = 'login.php';</script>";
}

mysqli_close($con);
?>
