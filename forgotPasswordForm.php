<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e9ecef; /* Updated to a softer shade of gray */
            background-size: cover; 
            background-position: center; 

        }
        body::before {
        content: "";
        position: absolute; x
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;

        z-index: -1;
    }

    .byjus-header h1, .card, .form-control, .btn {
        z-index: 1; /* Ensure text and elements are above the overlay */
    }

    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); /* Add some shadow to card */
        transition: 0.3s; /* Add animation */
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2); /* Darker shadow on hover */
    }

    .card-header {
        background-color: #007bff; /* Bootstrap primary color */
        color: white; /* White text color */
    }

    .btn-primary {
        background-color: #007bff; /* Bootstrap primary color */
        border-color: #007bff; /* Bootstrap primary border color */
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Darker shade for hover effect */
        border-color: #0056b3; /* Darker border on hover */
    }

    .form-control {
        border-radius: 0.25rem; /* Slightly round corners for input fields */
        box-shadow: none; /* Remove default box-shadow */
    }

    .form-control:focus {
        border-color: #007bff; /* Highlight with Bootstrap primary color on focus */
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25); /* Bootstrap's focus shadow */
    }

    .form-text.text-muted {
        font-style: italic; /* Italic style for form text */
    }
    .byjus-header {
        background-color: #591591; /* Deep purple background color */
        color: white; /* White text color */
        padding: 20px 0; /* Add some padding to increase the height */
        margin-bottom: 20px; /* Add some space below the header */
    }

    .byjus-header h1 {
        margin: 0; /* Remove default margin from h1 */
        font-size: 2.5rem; /* Increase the font size */
        letter-spacing: 2px; /* Add some spacing between letters */
    }


    </style>
</head>
<body>
    <div class="container-fluid byjus-header">
        <div class="row">
            <div class="col text-left">
                    <h1>BYJU'S</h1>
                </div>
            </div>
        </div>

        <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">Forgot Password</div>
                    <div class="card-body">
                        <form action="forgotPasswordHandler.php" method="POST">
                            <input type="hidden" name="userType" value="student"> <!-- Change this value to "admin" for the admin form -->
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
