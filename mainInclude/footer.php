 <!-- Start Footer -->
 <footer class="container-fluid bg-dark text-center p-2">
 <small class=" text-white">   || Designed By E-learning || <a href="#login" data-toggle="modal" data-target="#adminLoginModelCenter">Admin Login</a> </small>
  
 </footer> <!-- End Footer -->

    <!-- Start Student Registration Modal -->
    <div class="modal fade" id="StuRegModelCenter" tabindex="-1"
    aria-labelledby="StuRegModalCenterLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="StuRegModelCenterLabel">Student Registration</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!--Start Form Registration-->
            <?php include('studentRegistration.php'); ?>
            <!-- End Form Registration -->
          </div>
          <div class="modal-footer">
            <span id="successMsg"></span>
            <button type="button" class="btn btn-primary" id="signup" onclick="addStu()">Sign Up</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div> <!-- End Student Registration Modal -->


    <!-- Start Student Login Modal -->
    <div class="modal fade" id="StuLoginModelCenter" tabindex="-1" aria-labelledby="StuLoginModelCenterLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="StuLoginModelCenterLabel">Student Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="stuLoginForm">
              <div class="form-group">
                <i class="fas fa-envelope"></i><label for="stuLogemail" class="pl-2 font-weight-bold">Email</label><small id="statusLogMsg1"></small><input type="email"
                    class="form-control" placeholder="email" name="stuLogemail" id="stuLogemail">
                </div>
                <div class="form-group">
                  <i class="fas fa-key"></i><label for="stuLogPass" class="pl-2 font-weight-bold">Password</label><input type="password" class="form-control" placeholder="Password" name="stuLogpass" id="stuLogpass">
                  <a href="forgotPasswordForm.php" class="forgot-password-link">Forgot Password?</a>


              </div>
            </form>
      <!--End Student Login Form-->
          </div>
          <div class="modal-footer">
            <small id="statusLogMsg"></small>
            <button type="button" class="btn btn-primary" id="stuLoginBtn" onclick="checkStuLogin()">Login</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div> <!-- End Student Login Modal -->


   <!-- Start Admin Login Model-->
 

<!-- Modal -->
<div class="modal fade" id="adminLoginModelCenter" tabindex="-1" aria-labelledby="adminLoginModelCenterLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="adminLoginModelCenterLabel">Admin Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="clearAdminLoginWithStatus()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--Start Admin Login Form-->
        <form id="adminLoginForm">
          
          <div class="form-group">
            <i class="fas fa-envelope"></i><label for="adminLogemail" class="p1-2 font-weight-bold">Email</label>
            <input type="email" class="form-control" placeholder="Email" name="adminLogemail" id="adminLogemail">
            
          </div>
          <div class="form-group">
            <i class="fas fa-key"></i>
            <label for="adminLogpass" class="p1-2 font-weight-bold">Password</label>
            <input type="password" class="form-control" placeholder="Password" name="adminLogpass" id="adminLogpass">
            <a href="forgotPasswordForm.php" class="forgot-password-link">Forgot Password?</a>
           </div>   
        </form>
        
        <!--End Admin Login Form-->
      </div>
      <div class="modal-footer">
      <small id="statusLogMsg"></small>
        <button type="button" class="btn btn-primary" id="adminLoginBtn" onclick="checkAdminLogin()">Login</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="clearAdminLoginWithStatus()">Cancel</button>
        
      </div>
    </div>
  </div>
</div>
     <!-- End Admin Login Model-->

    <!--Jquery and Bootstrap JavaScript-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/all.min.js"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--Student Testimonial owl slider JS-->
    <script type="text/javascript" src="js/owl.min.js"></script>
    <script type="text/javascript" src="js/testyslider.js"></script>

    <!-- Student Ajax call Javascript-->
    <script type="text/javascript" src="js/ajaxrequest.js"></script>

    <!-- Admin Ajax call Javascript-->
    <script type="text/javascript" src="js/adminajaxrequest.js"></script>

</body>
</html>