<?php
if (isset($_GET['token']) && isset($_GET['userType'])) {
    include 'dbConnection.php'; 
    
    $token = $_GET['token'];
    $userType = $_GET['userType'];

    // Determine the table and email column based on userType
    if ($userType === 'admin') {
        $tableName = 'admin';
        $emailColumn = 'admin_email';
        $passwordColumn = 'admin_pass';
    } elseif ($userType === 'student') {
        $tableName = 'student';
        $emailColumn = 'stu_email';
        $passwordColumn = 'stu_pass';
    } else {
        die('Invalid user type.');
    }

    // Validate the token and userType
    $token = filter_var($token, FILTER_SANITIZE_STRING);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change'])) {
        if (isset($_POST['email']) && isset($_POST['new_password'])) {
            $email = $_POST['email'];
            $newPassword = $_POST['new_password'];

        // Update the user's password
        $updateStmt = $conn->prepare("UPDATE $tableName SET $passwordColumn = ?, code = '', updated_time = NULL WHERE $emailColumn = ? AND code = ?");
        
        if (!$updateStmt) {
            die("Error preparing statement: " . $conn->error);
        }

        $updateStmt->bind_param('sss', $newPassword, $email, $token);
        if ($updateStmt->execute()) {
            echo 'Password updated successfully. <a href="index.php">Click here to back to login</a>.';
        } else {
            echo 'Failed to update password.';
        }
    } else {
        // Handle cases where the form isn't submitted or required fields are missing
        echo 'Invalid request.';
    }}
} else {
    // Redirect back to the form or show an error message if token or userType is missing
    echo 'Invalid or missing token/userType.';
}
?>
