<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Change Password');
define('PAGE', 'studentChangePass');
include('./stuInclude/header.php'); 
include_once('../dbConnection.php');

if(!isset($_SESSION['is_login'])){
  echo "<script> location.href='../index.php'; </script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e9ecef;
            background-size: cover;
            background-position: center;
        }
        .byjus-header h1, .card, .form-control, .btn {
            z-index: 1;
        }
        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
        }
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .form-control {
            border-radius: 0.25rem;
            box-shadow: none;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        .form-text.text-muted {
            font-style: italic;
        }
        .byjus-header {
            background-color: #591591;
            color: white;
            padding: 20px 0;
            margin-bottom: 20px;
        }
        .byjus-header h1 {
            font-size: 2.5rem;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>
    

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">Change Password</div>
                    <div class="card-body">
                        <form action="../forgotPasswordHandler.php" method="POST">
                            <input type="hidden" name="userType" value="student">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                                <small class="form-text text-muted">We'll send a password reset link to your email.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and your existing JavaScript links -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
include('./stuInclude/footer.php'); 
?>
