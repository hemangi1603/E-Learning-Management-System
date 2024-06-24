<!--Start Including Header-->
<?php
include('./dbConnection.php');
include('./mainInclude/header.php');
?>
<!--End Including Header-->
    <!-- Start video background-->
    <div class="container-fluid remove-vid-marg">
      <div class="vid-parent">
        <video playsinline autoplay muted loop >
          <source src="video/production_id_4495966 (2160p) (online-video-cutter.com).mp4" >
        </video>
        <div class="vid-overlay"></div>
      </div>
    <div class="vid-content">
      <h1 class="my-content">Welcome to BYJU'S</h1>
      <small class="my-content">Learn and Implement</small><br>

      <?php
        if(!isset($_SESSION['is_login']))
        {
          echo '<a href="#" class="btn btn-danger mt-3" data-toggle="modal" data-target="#StuRegModelCenter">Get Started</a> ';
        }
        else {
          echo ' <a href="Student/studentProfile.php" class="btn btn-primary mt-3">My Profile</a>';
        }
      ?>
        </div>
    </div>
    <!--End video background-->

    <!--Start Text Banner-->
    <div class="container-fluid bg-danger txt-banner">
      <div class="row bottom-banner">
        <div class="col-sm">
          <h5><i class="fas fa-book-open mr-3"></i> 100+ Online Courses</h5>
        </div> 
          <div class="col-sm">
            <h5><i class="fas fa-users mr-3"></i> Expert Instructors</h5>
          </div>
          <div class="col-sm">
            <h5><i class="fas fa-keyboard mr-3/"></i>Lifetime Access</h5>
          </div>
          <div class="col-sm">
            <h5><i class="fas fa-rupee-sign mr-3"></i>Money Back Guarantee*</h5>
          </div>
      </div>
    </div>
    <!--End Text Banner-->

    <!-- Start Most Popular Course -->
    <div class="container mt-5">
      <h1 class ="text-center">Popular Course</h1>
      <!-- Start Most Popular Course 1st Card Deck-->
      <div class="card-deck mt-4">
        <?php
          $sql = "SELECT * FROM course LIMIT 3";
          $result = $conn->query($sql);
          if($result->num_rows> 0)
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
 
    </div>
    <!-- End Most Popular Course 1st Card Deck-->
    <!-- Start Most Popular Course 2st Card Deck-->
    <div class="card-deck mt-4">
    <?php
          $sql = "SELECT * FROM course LIMIT 3,3";
          $result = $conn->query($sql);
          if($result->num_rows> 0)
          {
            while($row = $result->fetch_assoc())
            {
              $course_id = $row['course_id'];
              echo '<a href="coursedetails.php?course_id='.$course_id.'" class="btn" style="text-align: left; padding:0px; margin:0px;">
              <div class="card">
                <img src="'. str_replace('..','.',$row['course_img']).'" class="card-img-top" alt="Maths " />
                <div class="card-body">
                  <h5 class="card-title">'.$row['course_name'].'</h5>
                  <p class="card-text">'.$row['course_desc'].'</p>
        
                </div>
                <div class="card-footer">
                <p class="card-text d-inline">Price: <small><del>&#8377 '.$row['course_original_price'].'</del></small> <span class="font-weight-bolder">&#8377 '.$row['course_price'].'</span></p>
                <a class="btn btn-primary text-white font-weight-bolder float-right" href="coursedetails.php?course_id='.$course_id.'">Enroll</a>
              </div>
              </div>
            </a>';
            }
          }

        ?>
    </div>
    <!-- End Most Popular Course 2st Card Deck-->
    <div class="text-center m-2">
      <a class="btn btn-danger btn-sm" href="courses.php">View All Course</a>
    </div>
</div>
    <!-- End Most Popular Course -->


    <!--Start Contact Us -->
    <?php
    include('./contact.php');
    ?>
    <!--End Contact Us -->

    <!--Start Students Testimonial -->
    <div class="container-fluid mt-5" style="background-color:#487289" id="Feedback">
  <h1 class="text-center testyheading p-4"> Student's Feedback</h1>
    <div class="row">
      <div class="col-md-12">
        <div id="testimonial-slider" class="owl-carousel">

          <?php

          $sql = "SELECT s.stu_name,s.stu_occ,s.stu_img,f.f_content FROM student AS s JOIN feedback AS f ON s.stu_id = f.stu_id";
          $result = $conn->query($sql);
          if($result->num_rows > 0)
          {
            while($row = $result->fetch_assoc())
            {
              $s_img = $row['stu_img'];
              $n_img = str_replace('..','.',$s_img);
          
          ?>

          <div class="testimonial">
            <p class="description">
           <?php
           echo $row['f_content']; 
           ?>
            </p>
            <div class="pic">
              <img src="<?php echo $n_img ?>" alt=""/>
            </div>
            <div class="testimonial-prof">
              <h4><?php echo $row['stu_name']?></h4>
              <small><?php echo $row['stu_occ'] ?></small>
            </div>
          </div>
           <?php }
          }?>
        </div>
      </div>
    </div>
  </div>
    <!--End Students Testimonial -->

    <div class="container-fluid bg-danger">
      <!--Start Social Follow-->
      <div class="row text-white text-center p-1">
        <div class="col-sm">
          <a class="text-white social" href="#"><i class="fab fa-facebook-f"></i>Facebook</a>
        </div>
      <div class="col-sm">
        <a class="text-white social" href="#"><i class="fab fa-twitter"></i>Twitter</a>
      </div>
      <div class="col-sm">
        <a class="text-white social" href="#"><i class="fab fa-whatsapp"></i>Whatsapp</a>
      </div>
      <div class="col-sm">
        <a class="text-white social" href="#"><i class="fab fa-instagram"></i>Instagram</a>
      </div>
     </div>
    </div> <!--End Social Follow-->

     <!--Start About Section-->
     <div class="container-fluid p-4" style="background-color:#E9ECEF">
    <div class="container" style="background-color:#E9ECEF">
  <div class="row text-center">
    <div class="col-sm">
      <h5>About Us</h5>
      <p>byjus provides universal access to the world's best education, partnering with top universities and organizations to offer courses online.</p>
    </div>
    <div class="col-sm">
      <h5>Category</h5>
      <a class="text-dark" href="#">Web Development</a><br>
      <a class="text-dark" href="#">Web Designing</a><br>
      <a class="text-dark" href="#">Andorid App Dev</a><br>
      <a class="text-dark" href="#">iOS Development</a><br>
      <a class="text-dark" href="#">Data Analysis</a><br>

    </div>
    <div class="col-sm">
      <h5>Contact Us</h5>
      <p>BYJU'S Pvt Ltd <br> Nigam Nagar<br>Chandkheda,Ahmedabad<br>Ph. 9313054517
      </p>
    </div>
  </div></div></div>
     <!--End About Section-->


     <!--Start Including Footer-->
    <?php
      include('./mainInclude/footer.php');
    ?>
    <!--End Including Footer-->