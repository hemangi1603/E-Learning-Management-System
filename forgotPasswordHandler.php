<?php
// Including the database connection and PHPMailer classes
include('./dbConnection.php'); 
require './PHPMailer/Exception.php';
require './PHPMailer/PHPMailer.php';
require './PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }
    $userType = $_POST['userType']; // 'student' or 'admin'
    if ($userType !== 'student' && $userType !== 'admin') {
        echo "Unexpected user type";
        exit;
    }

    // Determine the table based on userType
    $tableName = $userType == 'admin' ? 'admin' : 'student';
    $emailColumn = $userType == 'admin' ? 'admin_email' : 'stu_email';

    // Prepare SQL query
    $stmt = $conn->prepare("SELECT * FROM $tableName WHERE $emailColumn = ?");
    if (!$stmt) {
        echo "Database error";
        exit;
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, generate a token and expiry time
        $token = bin2hex(random_bytes(32));


        date_default_timezone_set('Asia/Kolkata');
         $expiry = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token expires in 1 hour

          // Update the user's record with the reset token and expiry time (ensure you have fields for these)
        $updateStmt = $conn->prepare("UPDATE $tableName SET code = ?, updated_time = ? WHERE $emailColumn = ?");
        if (!$updateStmt) {
            echo "Database error";
            exit;
        }
        $updateStmt->bind_param("sss", $token, $expiry, $email);
        $updateStmt->execute();

        $resetLink = "http://localhost/BYJU%27S/resetPassword.php?token=".urlencode($token)."&userType=".urlencode($userType);
        // Insert the token and expiry into your database for verification later
        // Ensure you have a table and mechanism to store these details and link them to the user

        // Send the password reset email
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'mailtesting161103@gmail.com'; // Replace with your email address
            $mail->Password   = 'wnch nesv aprl sdrj'; // Replace with your email password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = 465;                                    

            //Recipients
            $mail->setFrom('mailtesting161103@gmail.com', 'BYJUS');
            $mail->addAddress($email);     

            //Content
            $mail->isHTML(true);                                  
            $mail->Subject = 'Reset Your Password';
            $mail->Body    = "Please click on the following link to reset your password: <a href='".$resetLink."'>Reset Password</a>.This link will expire in 1 Hour.";

            $mail->send();
            echo 'A password reset link has been sent to your email address.';
        } catch (Exception $e) {
            echo "Error sending email: {$mail->ErrorInfo}";
        }
    } else {
        echo "No account found with that email address.";
    }

    // Close the database connection
    $conn->close();
} else {
    // Not a POST request
    echo "Please submit the form to request a password reset link.";
}
?>