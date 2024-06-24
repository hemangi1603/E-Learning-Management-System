<?php
if(!isset($_SESSION)){ 
   session_start(); 
 }
include('../dbConnection.php');

date_default_timezone_set('Asia/Kolkata'); 
if(!isset($_SESSION['is_login'])){
   echo "<script> location.href='../index.php'; </script>";
   exit;
 }
 
 $stuEmail = $_SESSION['stuLogEmail'];
 $course_id = isset($_GET['course_id']) ? $_GET['course_id'] : '';
 
 if ($course_id != '') {
  // Fetch course duration and start time
  $sql = "SELECT c.course_duration, co.start_time FROM course c JOIN courseorder co ON c.course_id = co.course_id WHERE co.course_id = ? AND co.stu_email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("is", $course_id, $stuEmail);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $duration = preg_replace('/(\d+)\s*(\w+)/', '+$1 $2', $row['course_duration']);
      $startTime = new DateTime($row['start_time']);

      $expiryDate = clone $startTime;
      $expiryDate->modify($duration);

      // Debugging output
      echo "Start Time: " . $startTime->format('Y-m-d H:i:s') . "<br>";
      echo "Expiry Date: " . $expiryDate->format('Y-m-d H:i:s') . "<br>";
      echo "Current Time: " . date('Y-m-d H:i:s') . "<br>";

      if (new DateTime() > $expiryDate) {
          echo "<script>alert('Your access to this course has expired. Please purchase again to continue.'); window.location.href='../coursedetails.php?course_id=$course_id';</script>";
          exit;
      }
  } else {
      echo "<script>alert('No course found or access denied.'); window.location.href='courses.php';</script>";
      exit;
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Watch Course</title>
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="../css/bootstrap.min.css">

 <!-- Font Awesome CSS -->
 <link rel="stylesheet" href="../css/all.min.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

 <!-- Custom CSS -->
 <link rel="stylesheet" href="../css/stustyle.css">



</head>
<body>

   <div class="container-fluid bg-success p-2" >
    <h3>Welcome to BYJU'S</h3>
    <a class="btn btn-danger" href="./myCourse.php">My Courses</a>
   </div>
   
   <div class="container-fluid">
    <div class="row">
     <div class="col-sm-3 border-right">
       <h4 class="text-center">Lessons</h4>
       <ul id="playlist" class="nav flex-column">
          <?php
             if(isset($_GET['course_id']))
             {
              $course_id = $_GET['course_id'];
              $sql = "SELECT * FROM lesson WHERE course_id = '$course_id'";
              $result = $conn->query($sql);
              if($result->num_rows > 0)
              {
               while($row = $result->fetch_assoc())
               {
                echo '<li class="nav-item border-bottom py-2" movieurl='.$row['lesson_link'].' style="cursor: pointer;">'. $row['lesson_name'] .'</li>';
               }
              }
              else 
              {
               echo '<li class="nav-item">No lessons available.</li>';
               }
             }
          ?>
       </ul>
     </div>
     <div class="col-sm-8">
        <video id="videoarea" src="" class="mt-5 w-75 ml-2" controls>
        </video>
     </div>
    </div>
   </div>



    <!-- Jquery and Boostrap JavaScript -->
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <!-- Font Awesome JS -->
    <script type="text/javascript" src="../js/all.min.js"></script>

    <!-- Ajax Call JavaScript -->
    <!-- <script type="text/javascript" src="..js/ajaxrequest.js"></script> -->

    <!-- Custom JavaScript -->
    <script type="text/javascript" src="../js/custom.js"></script>
</body>
</html>