
<?php
include('./dbConnection.php');
include('./mainInclude/header.php');
?>

    

<!--Start Course Page Banner-->
<div class="container-fluid bg-dark">
    <div class="row">
        <img src="./image/coursebanner.jpg" alt="courses" style="height:500px; width:100%; object-fit:cover; box-shadow:10px;">
    </div>
</div>
<!--End Course Page Banner-->


    <!-- End All  Course -->
  <div class="container mt-5">
    <h1 class="text-center">All Courses</h1>
    <div class="row mt-4 d-flex">
      <?php

      $sql = "SELECT * FROM course";
      $result = $conn->query($sql);
      if($result->num_rows > 0)
      {
        while($row = $result->fetch_assoc())
        {
          $course_id = $row['course_id'];
          echo
          '<div class="col-sm-4 mb-4 d-flex align-items-stretch">
          <a href="coursedetails.php?course_id='.$course_id.'" class="btn text- left; padding:0px;">
          <div class="card  d-flex flex-column h-100">
          <img src="'.str_replace('..','.',$row['course_img']).'" class="card-img-top" style="height:250px; width: 300px; object-fit:contain; box-shadow:10px; display:block; margin:auto;" alt="Maths"/>
          <div class="card-body">
          <h5 class="card-title">'.$row['course_name'].'</h5>
          <p class="card-text">'.$row['course_desc'].'</p>
          </div>
          <div class="card-footer mt-auto"> 
          <p class="card-text d-inline">Price: <small><del>&#8377 '.$row['course_original_price'].'</del></small> <span class="font-weight-bolder">&#8377 '.$row['course_price'].'</span></p>
          <a class="btn btn-primary text-white font-weight-bolder float-right" href="coursedetails.php?course_id='.$course_id.'">Enroll</a></div>
          </div></a>
          </div>' ;
        }
      }
      ?>

    </div><!-- End All Course Row-->
  </div>
  <!-- End All Course-->
     
  <?php 
  // Contact Us
  include('./contact.php'); 
?>
    
<!--Start Including Footer-->
<?php
    include('./mainInclude/footer.php');
?>
<!--End Including Footer-->