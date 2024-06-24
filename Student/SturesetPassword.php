<?php
include_once('../dbConnection.php');

// Error message ke liye variable
$error = "";

if(isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    // Verify that the token is valid and not expired
    $sql = "SELECT * FROM password_reset WHERE email='$email' AND token='$token' AND token_expiry > NOW()";
    $result = $conn->query($sql);

    if($result->num_rows == 0) {
        $error = "This link is invalid or expired.";
    }
} else {
    $error = "This link is invalid.";
}

// Handle the form submission
if(isset($_POST['resetPasswordBtn'])) {
    $newPassword = $_POST['newPassword'];
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the user's password
    $updateSql = "UPDATE student SET stu_pass='$hashedPassword' WHERE stu_email='$email'";
    if($conn->query($updateSql)) {
        // Optionally, clear the token from the database
        $conn->query("DELETE FROM password_reset WHERE email='$email'");
        echo "Your password has been updated successfully.";
        // Redirect user to the login page
    } else {
        $error = "Failed to reset your password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Your Password</title>
    
</head>
<body>
    <?php if($error): ?>
        <p><?php echo $error; ?></p>
    <?php else: ?>
        <form action="" method="post">
            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newPassword" required>
            <button type="submit" name="resetPasswordBtn">Reset Password</button>
        </form>
    <?php endif; ?>
</body>
</html>
