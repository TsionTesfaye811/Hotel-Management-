<?php
// Compose email message
$subject = "Booking Confirmation";
$message = "Dear Customer," . "\n\n";
$message .= "This email confirms your booking." . "\n\n";
$message .= "Please contact us if you have any questions." . "\n\n";
$message .= "Best regards," . "\n";
$message .= "The Booking Team";

// Send email using PHPMailer library
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "samuelkenaw24@gmail.com"; // Replace with your Gmail username
$mail->Password = "Sam@@2727"; // Replace with your Gmail password
$mail->SMTPSecure = "tls";
$mail->Port = 587;

$mail->setFrom("samuelkenae24@gmail.com", "Booking Team");
$mail->addAddress("kenawsamuel2721@gmail.com", "Customer Name"); // Replace with the recipient's email address and name
$mail->Subject = $subject;
$mail->Body = $message;

if (!$mail->send()) {
    echo "Error sending email: " . $mail->ErrorInfo;
} else {
    echo "Email sent successfully.";
}
?>


































































