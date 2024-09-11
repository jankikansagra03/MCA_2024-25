include_once("footer.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require('PHPMailer\PHPMailer.php');
require('PHPMailer\SMTP.php');
require('PHPMailer\Exception.php');

if (isset($_POST['btn'])) {
    // Form Validation
    $fullname = $_POST['fn'];
    $email = $_POST['email'];
    $password = $_POST['pswd'];
    $address = $_POST['address'];
    $gender = $_POST['gen'];
    $mobile_number = $_POST['mobile'];

    // Handle file upload
    $profile_picture = '';
    if (isset($_FILES['pic'])) {
        if (!is_dir("images/profile_pictures/")) {
            mkdir("images/profile_pictures");
        }
        $upload_dir = 'images/profile_pictures/';
        $tmp_name = $_FILES['pic']['tmp_name'];
        $profile_picture = uniqid() . basename($_FILES['pic']['name']);
        move_uploaded_file($tmp_name, $upload_dir . $profile_picture);
    }
    $token = bin2hex(random_bytes(16));

    // Insert data into the table along with verification token
    $sql = "INSERT INTO registration (fullname, email, password, address, gender, mobile_number, profile_picture,token) 
        VALUES ('$fullname', '$email', '$password', '$address', '$gender', '$mobile_number', '$profile_picture','$token')";

    if (mysqli_query($con, $sql)) {
        // Prepare the verification link
        $verification_link = "http://localhost/MCA_2024-25/verify.php?token=" . $token;
        $mail = new PHPMailer();
        $headers = 'From: MCA Sample Website <jankikansagra12@gmail.com>' . "\r\n";
        $headers .= 'Reply-To: <jankikansagra12@gmail.com>' . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $to = $email;
        $subject = "Account Verification";
        $body = "<html>
    <head>
        <title>Email Verification</title>
    </head>
    <body>
        <p>Dear $fullname,</p>
        <p>Thank you for registering. Please click the link below to verify your email address:</p>
        <p><a href='$verification_link'>Click Here</a></p>
        <p>Thank you!</p>
    </body>
    </html>";

        $mail->IsSMTP(); // telling the class to use SMTP
        // $mail->Mailer = "smtp";
        // $mail->SMTPDebug  = 2;                // enables SMTP debug information (for testing)
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = 'smtp.gmail.com';      // sets GMAIL as the SMTP server
        $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
        $mail->Username   = "jankikansagra12@gmail.com";  // GMAIL username(from)
        $mail->Password   = "ttxa inwx ozfi iszq";            // GMAIL password(from)
        $mail->SetFrom('jankikansagra12@gmail.com', 'MCA Sample Website'); //from
        $mail->AddReplyTo("jankikansagra12@gmail.com", "MCA Sample Website"); //to
        $mail->Subject    = $subject;
        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
        $mail->MsgHTML($body);

        $mail->AddAddress($to, "MCA Sample Website");
        if (!$mail->Send()) {
            setcookie("error", "Error in Sending verification email", time() + 5, "/");
        } else {
            setcookie("success", "Registration Successfull. Activation mail is sent to your registered email account. Kindly activate your account to login.", time() + 5, "/");
        }
        $con->close();
?>
        <script>
            window.location.href = "login.php";
        </script>
<?php
    }
}
?>