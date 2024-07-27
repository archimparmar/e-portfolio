<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'email/PHPMailer/src/Exception.php';
require 'email/PHPMailer/src/PHPMailer.php';
require 'email/PHPMailer/src/SMTP.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form input
    $fullname = isset($_POST['fullname']) ? htmlspecialchars(trim($_POST['fullname'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $subject = isset($_POST['subject']) ? htmlspecialchars(trim($_POST['subject'])) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

    if (!empty($fullname) && !empty($email) && !empty($subject) && !empty($message)) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = 0;                                 // Disable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'parmararchi19@gmail.com';        // SMTP username
            $mail->Password = 'gndxnjcfaeonaoka';                 // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            // Recipients
            $mail->setFrom('parmararchi19@gmail.com', 'Archi Parmar');
            $mail->addAddress('parmararchi19@gmail.com', 'Archi Parmar'); // Add a recipient
            $mail->addReplyTo($email, $fullname);

            // Build the email content
            $bodyContent = '<div>Hello, you got a new enquiry</div>
                            <div>Fullname: ' . htmlspecialchars($fullname) . '</div>
                            <div>Email: ' . htmlspecialchars($email) . '</div>
                            <div>Subject: ' . htmlspecialchars($subject) . '</div>
                            <div>Message: ' . htmlspecialchars($message) . '</div>';

            // Set email format to HTML
            $mail->isHTML(true);                                  
            $mail->Subject = 'New Inquiry from Portfolio Page';
            $mail->Body    = $bodyContent;
            $mail->AltBody = strip_tags($bodyContent);

            $mail->send();
            echo '<div class="thank-you-message" style="
            text-align: center;
            margin-top: 50px;
            font-size: 65px;
            color: green;
            animation: fadeIn 1s ease-in-out;">Thank you. Message has been sent</div>';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo 'Please fill in all the required fields.';
    }
} else {
    echo 'Invalid request method.';
}
?>
