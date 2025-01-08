### Note:
To transfer emails, it is mandatory to use `PHPMailer`. Without it, emails will not be sent successfully.  
Refer to the [PHPMailer Documentation](https://github.com/PHPMailer/PHPMailer) for installation and configuration steps.

### PHPMailer Installation:
1. Install `PHPMailer` using Composer:
   ```bash
   composer require phpmailer/phpmailer
Example code:
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.example.com'; // SMTP server address
    $mail->SMTPAuth   = true;
    $mail->Username   = 'your-email@example.com'; // SMTP username
    $mail->Password   = 'your-password';         // SMTP password
    $mail->SMTPSecure = 'tls';                   // Encryption type
    $mail->Port       = 587;                     // SMTP port

    $mail->setFrom('your-email@example.com', 'Mailer');
    $mail->addAddress('recipient@example.com'); // Add recipient

    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body    = 'This is a test email sent using PHPMailer.';

    $mail->send();
    echo 'Email has been sent successfully!';
} catch (Exception $e) {
    echo "Email could not be sent. PHPMailer Error: {$mail->ErrorInfo}";
}
