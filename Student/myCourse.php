<?php
if(!isset($_SESSION))
{ 
  session_start(); 
}
define('TITLE', 'My Course');
define('PAGE', 'mycourse');
include('./stuInclude/header.php'); 
include_once('../dbConnection.php');

if(!isset($_SESSION['is_login']))
{
  echo "<script> location.href='../index.php'; </script>";
  exit;
}

$stuLogEmail = $_SESSION['stuLogEmail'];
?>

<div class="container mt-5 ">
  <div class="row">
    <div class="jumbotron">
      <h4 class="text-center">All Course</h4>
      <?php 
      if(isset($stuLogEmail))
      {
        $sql = "SELECT co.order_id, c.course_id, c.course_name, c.course_duration, c.course_desc, c.course_img, c.course_author, c.course_original_price, c.course_price, co.order_date FROM courseorder AS co JOIN course AS c ON c.course_id = co.course_id WHERE co.stu_email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $stuLogEmail);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) 
        {
          while($row = $result->fetch_assoc())
          {
            $orderDate = new DateTime($row['order_date']);
            $duration = strtolower($row['course_duration']);
            date_default_timezone_set('Asia/Kolkata'); // Ensure the timezone is correctly set

            $expiryDate = clone $orderDate;
            $expiryDate->modify($duration);
            $now = new DateTime();

            //Debugging output
            // echo "<p>Now: " . $now->format('Y-m-d H:i:s') . "</p>";
            // echo "<p>Order Date: " . $orderDate->format('Y-m-d H:i:s') . "</p>";
            // echo "<p>Expiry Date: " . $expiryDate->format('Y-m-d H:i:s') . "</p>";

            if($now > $expiryDate) 
            {
                $expiryNote = '<span style="color: red;">(Access Expired)</span>';
            } else 
            {
                $expiryNote = ''; // Ensure no message is displayed if not expired
            }

            echo "<div class='bg-light mb-3'>";
            //echo "<h5 class='card-header'>" . $row['course_name'] . " " . $expiryNote . "</h5>";
            echo "<h5 class='card-header'>" . $row['course_name'] ."</h5>";
            echo "<div class='row'>";
            echo "<div class='col-sm-3'>";
            echo "<img src='" . $row['course_img'] . "' class='card-img-top mt-4' alt='pic'>";
            echo "</div>";
            echo "<div class='col-sm-6 mb-3'>";
            echo "<div class='card-body'>";
            echo "<p class='card-title'>" . $row['course_desc'] . "</p>";
            echo "<small class='card-text'>Duration: " . $row['course_duration'] . "</small><br />";
            echo "<small class='card-text'>Instructor: " . $row['course_author'] . "</small><br/>";
             echo "<p class='card-text d-inline'>Price: <small><del>&#8377; " . $row['course_original_price'] . "</del></small> <span class='font-weight-bolder'>&#8377; " . $row['course_price'] . "</span></p><br>";
           
            echo "<a href='watchcourse.php?course_id=" . $row['course_id'] . "' class='btn btn-primary mt-5 float-right'>Watch Course</a>";
            echo "</div></div></div></div>";
          }
        } 
        else 
        {
          echo "<p>No courses enrolled or data not found.</p>";
        }
      }
      ?>
      </div>
    </div>
  </div>
</div>

<?php
include('./stuInclude/footer.php'); 
?>
