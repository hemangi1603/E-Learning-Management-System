<?php
include('./dbConnection.php');
include('./mainInclude/header.php');
?>
    
    <!DOCTYPE html>
<html>
<head>
    <style>
        @keyframes blink {
            50% {
                opacity: 0;
            }
        }
        .blink {
            animation: blink 2s step-start 0s infinite;
        }
    </style>
</head>
<!--Start Course Page Banner-->
<div class="container-fluid bg-dark">
    <div class="row">
        <img src="./image/coursebanner.jpg" alt="courses" style="height:350px; width:100%; object-fit:cover; box-shadow:10px;">
    </div>
</div>
<!--End Course Page Banner-->


<!--Start Main Contant-->
<div class="container mt-5">
    
    
    <?php
    if(isset($_GET['course_id']))
    {
        $course_id = $_GET['course_id'];
        $_SESSION['course_id'] = $course_id;
        $sql = "SELECT * FROM course WHERE course_id = '$course_id'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc(); 
    ?>
    <div class="row">
        <div class="col-md-4 mb-3">
            <img src="<?php echo str_replace('..','.',$row['course_img'])?>" class="card-img-top" alt="<?php echo $row['course_name']?>"/>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><b>Course Name: </b> <?php echo $row['course_name']?> </h5>
                <p class="card-text"><b>Description: </b><?php echo $row['course_desc'] ?></p>
                <p class="card-text"><b>Duration:</b> <?php echo $row['course_duration'] ?></p>
                <p><b>Important:</b> You must complete this course within <?php echo $row['course_duration']; ?> days of purchase, or you will need to purchase it again.</p>

                
                <form action="checkout.php" method="post">
                    <p class="card-text d-inline"><b>Price:</b> <small><del>&#8377; <?php echo $row['course_original_price'] ?></del></small> <span class="font-weight-bolder">&#8377; <?php echo $row['course_price']; ?></span> </p>
                    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                    <input type="hidden" name="id" value="<?php echo $row['course_price']; ?>">
                    <button type="submit" class="btn btn-primary text-white font-weight-bolder float-right" name="buy">Buy Now</button>
                </form>
            </div>
        
    


    <!-- Video Section Start --> 
                <!-- Display video based on selected course -->
                <?php
                if(!empty($course_id))
                {
                if($course_id == "1") 
                { 
                    $videoSrc ="video/Cplayback.mp4";
                    $videoType = "video/mp4";
                }
                elseif($course_id == "2") 
                { 
                    $videoSrc ="video/C++playback.mp4" ;
                    $videoType = "video/mp4";
                }
                elseif($course_id == "3") 
                { 
                    $videoSrc ="video/Javaplayback.mp4" ;
                    $videoType = "video/mp4";
                }
                elseif($course_id == "4") 
                { 
                    $videoSrc ="video/Pythonplayback.mp4" ;
                    $videoType = "video/mp4";
                }
                elseif($course_id == "5") 
                { 
                    $videoSrc ="video/CCCplayback.mp4" ;
                    $videoType = "video/mp4";
                }
                elseif($course_id == "6") 
                { 
                    $videoSrc ="video/Phpplayback.mp4" ;
                    $videoType = "video/mp4";
                }
                elseif($course_id == "7") 
                { 
                    $videoSrc ="video/HTMLplayback.mp4" ;
                    $videoType = "video/mp4";
                }
                elseif($course_id == "8") 
                { 
                    $videoSrc ="video/NETplayback.mp4" ;
                    $videoType = "video/mp4";
                }
                elseif($course_id == "9") 
                { 
                    $videoSrc ="video/JavaScriptplayback.mp4" ;
                    $videoType = "video/mp4";
                }
                
                
                }
                if(!empty($videoSrc)) {?>
                <div class="mt-4">
                <h4>Course Preview:</h4>
                    <video width="100%" height="auto" controls autoplay>
                    <source src="<?php echo htmlspecialchars($videoSrc); ?>" type="<?php echo htmlspecialchars($videoType); ?>">
                    Your browser does not support the video tag.
                </video>
                </div>
                
               <?php } 
               else {
                    echo '<p>No preview video available for this course.</p>';
                }
           
                ?>
            </div>
        </div>
    
    <!-- Video Section End -->
    <?php
        } else {
            echo '<div class="alert alert-danger" role="alert">
            Course not found.
            </div>';
        }
    }
    ?>
</div>
<!--End Main Contant-->



<!--Start Including Footer-->
<?php
    include('./mainInclude/footer.php');
?>
<!--End Including Footer-->
