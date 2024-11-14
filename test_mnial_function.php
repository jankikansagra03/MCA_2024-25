<?php
// Recipient's email address
$to = "janki.kansagra@rku.ac.in";

// Subject of the email
$subject = "Test Email from PHP";

// Message body
$message = "Hello! This is a test email sent using the PHP mail function.";

// Additional headers (optional)
$headers = "From: kansagrajanki@gmail.com" . "\r\n" .  "Reply-To: kansagrajanki@gmail.com" . "\r\n" . "X-Mailer: PHP/" . phpversion();

// Send the email
if (mail($to, $subject, $message, $headers)) {
    echo "Email successfully sent to $to...";
} else {
    echo "Email sending failed...";
}
