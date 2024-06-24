<?php
  include('./dbConnection.php');
  // Header Include from mainInclude 
  include('./mainInclude/header.php'); 
    
	$ORDER_ID = "";
	
	if (isset($_POST["ORDER_ID"]) && $_POST["ORDER_ID"] != "") {
		$ORDER_ID = $_POST["ORDER_ID"];
	}

?>  
   <div class="container-fluid bg-dark"> <!-- Start Course Page Banner -->
     <div class="row">
       <img src="./image/coursebanner.jpg" alt="courses" style="height:300px; width:100%; object-fit:cover; box-shadow:10px;"/>
     </div> 
   </div> <!-- End Course Page Banner -->
   <div class="container">
     <h2 class="text-center my-4">Payment Status </h2>
     <form method="post" action="">
     <div class="form-group row">
        <label class="offset-sm-3 col-form-label">Order ID: </label>
        <div>
          <input class="form-control mx-3" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo $ORDER_ID ?>">
        </div>
        <div>
          <input class="btn btn-primary mx-4" value="View" type="submit"	onclick="">
        </div>
      </div>
     </form>
    </div>
    <div class="container">
    <?php
      if (isset($_POST['ORDER_ID']))
      { 
        $sql = "SELECT order_id, co_id, stu_email, amount, order_date, status FROM courseorder WHERE order_id = ?";
    
        // Prepare statement to prevent SQL injection
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_POST["ORDER_ID"]);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($row = $result->fetch_assoc()){
          ?>
            <div class="justify-content-center">
              <div class="col-auto">
                <h2 class="text-center">Payment Receipt</h2>
                <table class="table table-bordered">
                  <tbody>
                      <tr>
                        <td><label>Order ID</label></td>
                        <td><?php echo $row["order_id"] ?></td>
                      </tr>
                      <tr>
                        <td><label>Status</label></td>
                        <td><?php echo $row["status"] ?></td>
                      </tr>
                      <!-- Add new rows for the additional information -->
                      <tr>
                        <td><label>CO ID</label></td>
                        <td><?php echo $row["co_id"] ?></td>
                      </tr>
                      <tr>
                        <td><label>Student Email</label></td>
                        <td><?php echo $row["stu_email"] ?></td>
                      </tr>
                      <tr>
                        <td><label>Amount</label></td>
                        <td><?php echo $row["amount"] ?></td>
                      </tr>
                      <tr>
                        <td><label>Order Date</label></td>
                        <td><?php echo $row["order_date"] ?></td>
                      </tr>
                      <tr>
                        <td></td>
                          <td><button class="btn btn-primary" onclick="javascript:window.print();">Print Receipt</button></td>
                      </tr>
                    </tbody>
                  </table>      
                </div>
              </div>
    <?php
        }
      }
    ?>
    </div>  
<div class="mt-5">
<?php 
  // Contact Us
  include('./contact.php'); 
?> 
</div>

<?php 
  // Footer Include from mainInclude 
  include('./mainInclude/footer.php'); 
?>  
