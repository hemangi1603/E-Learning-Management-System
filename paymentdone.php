<?php 
include('./dbConnection.php');
require './PHPMailer/Exception.php';
require './PHPMailer/PHPMailer.php';
require './PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$isPaymentSuccessful = false;
session_start();
if(!isset($_SESSION['stuLogEmail'])) {
 echo "<script> location.href='loginorsignup.php'; </script>";
} else { 
 date_default_timezone_set('Asia/Kolkata');
 //$date = date('d-m-y h:i:s');
 $date = date('Y-m-d H:i:s');
 if(isset($_POST['ORDER_ID']) && isset($_POST['TXN_AMOUNT'])){
  $order_id = $_POST['ORDER_ID'];
  $stu_email = $_SESSION['stuLogEmail'];
  $course_id = $_SESSION['course_id'];
  $status = "Success";
  $respmsg = "Done";
  $amount = $_POST['TXN_AMOUNT'];
  $date = $date;
  $sql = "INSERT INTO courseorder(order_id, stu_email, course_id, status, respmsg, amount, order_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
  
  $stmt = $conn->prepare($sql);
  if ($stmt) {
      $stmt->bind_param("sssssss", $order_id, $stu_email, $course_id, $status, $respmsg, $amount, $date);
      if ($stmt->execute()) {
          $isPaymentSuccessful = true;

          // Prepare to send email
          $mail = new PHPMailer(true);
          try {
              //Server settings
              $mail->isSMTP();                                            
              $mail->Host       = 'smtp.gmail.com';                     
              $mail->SMTPAuth   = true;                                   
              $mail->Username   = 'mailtesting161103@gmail.com'; // Update your email
              $mail->Password   = 'wnch nesv aprl sdrj'; // Update your password
              $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
              $mail->Port       = 465;                                    

              //Recipients
              $mail->setFrom('mailtesting161103@gmail.com', 'BYJUS');
              $mail->addAddress($stu_email);     

              //Content
              $mail->isHTML(true);                                  
              $mail->Subject = 'Payment Confirmation';
              $mail->Body    = "Hello,<br><br>Your payment for the course with ID $course_id has been successful.<br>Order ID: $order_id<br>Amount Paid: $amount<br>Date: $date<br><h5>To get your payment receipt, access the payment status from across the website</h5><br>Thank you for choosing us!";

              $mail->send();
              echo '<h3>Payment confirmation has been sent to your email address.</h3><br>';
          } catch (Exception $e) {
              echo "Mailer Error: " . $mail->ErrorInfo;
          }
      }
  } else {
      echo "Error preparing statement: " . $conn->error;
  }
} else {
  echo "<b>Transaction status is failure</b>" . "<br/>";
}
$conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="image/check.png" sizes="5x5">
    <title>Payment Success</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
</head>

<style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    </style>

<body>
    <?php if($isPaymentSuccessful): ?>
      <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        <i class="checkmark">✓</i>
      </div>
        <h1>Success</h1> 
        <p>We received your purchase request;<br/> we'll be in touch shortly!</p>
      </div>

        <!-- Your HTML content for successful payment -->
        <script>
            // JavaScript for redirecting to My Profile after a delay
            setTimeout(() => {
                window.location.href = './Student/myCourse.php';
            }, 5000);
        </script>
    <?php else: ?>
        <!-- Your HTML content for payment failure or initial state -->
    <?php endif; ?>
</body>
</html>