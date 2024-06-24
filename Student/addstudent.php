<?php
if(!isset($_SESSION))
{
    session_start();
}
include_once('../dbConnection.php');

//Checking email Already registered
if(isset($_POST['checkemail']) && isset($_POST['stuemail']))
{
    $stuemail = $_POST['stuemail'];
    $sql = "SELECT stu_email FROM student WHERE stu_email = '".$stuemail."'";
    $result = $conn->query($sql);
    $row = $result->num_rows;
    echo json_encode($row);

}
// Insert student


//header('Content-Type: application/json');
if(isset($_POST['stusignup']) && isset($_POST['stuname']) && isset($_POST['stuemail']) && isset($_POST['stupass']))
{
    $stuname = $_POST['stuname'];
    $stuemail = $_POST['stuemail'];
    $stupass = $_POST['stupass'];

    $sql = "INSERT INTO student(stu_name,stu_email,stu_pass) VALUES ('$stuname','$stuemail','$stupass')";

    if($conn->query($sql)==TRUE)
    {
        echo json_encode("OK");
    }
    else {
        echo json_encode("Failed");
    }

}
// else {
//     echo json_encode("Invalid Request");
// }
// $conn->close();



//Student Login verification
if(!isset($_SESSION['is_login']))
{
    if(isset($_POST['checkLogemail']) && isset($_POST['stuLogEmail']) && isset($_POST['stuLogPass']))
    {
        $stuLogEmail = $_POST['stuLogEmail'];
        $stuLogpass = $_POST['stuLogPass'];

        $sql = "SELECT stu_email, stu_pass FROM student WHERE stu_email= '".$stuLogEmail."' AND stu_pass='".$stuLogpass."'";
        $result = $conn->query($sql);

        $row = $result->num_rows;

        if($row === 1)
        {
            echo json_encode($row);
            $_SESSION['is_login'] = true;
            $_SESSION['stuLogEmail'] = $stuLogEmail;

        }
        else if ($row === 0) {
            echo json_encode($row);
        }
    }
}
 ?>