<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Collect form data safely
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';
    $subject = $_POST['subject'] ?? '';

    // SMTP settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'patel.ragini9315516129@gmail.com'; // Lawyer's Gmail
    $mail->Password = 'hzssteldmxzgmffa'; // Gmail App Password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Sender (always the lawyer’s email)
   $mail->setFrom('patel.ragini9315516129@gmail.com', 'Lawyer Website Contact Form');


    // Add Reply-To only if client email is valid
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mail->addReplyTo($email, $name);
    }

    // Recipient
    $mail->addAddress('patel.ragini9315516129@gmail.com', 'Lawyer');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = "You got a message from <b>{$name}</b> ({$email}):<br><br>" . nl2br($message);

    $mail->send();
    echo "<script>alert('✅ Message has been sent successfully!'); window.location.href='enquiry.html';</script>";

} catch (Exception $e) {
    // Show error alert
    echo "<script>alert('❌ Message could not be sent. Error: {$mail->ErrorInfo}'); window.location.href='enquiry.html';</script>";
}
