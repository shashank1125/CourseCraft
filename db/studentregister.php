<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "course_management";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];
    $Email = $_POST["Email"];
    $Userrole = $_POST["Userrole"];
    $UserId = $_POST["UserId"];

    $existSql = "SELECT * FROM `studentregister` WHERE username = '$Username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    
    if($numExistRows > 0) {
        
        echo "<script>alert('Email already registered');</script>";
    } else {
        $sql_register = "INSERT INTO studentregister (Username, Password, Email, UserId) VALUES ('$Username', '$Password', '$Email', '$UserId')";

        if (mysqli_query($conn, $sql_register)) {
            if ($Userrole == "student") {
                $sql_student = "INSERT INTO student (Student_id, Student_name) VALUES ('$UserId', '$Username')";
                if (mysqli_query($conn, $sql_student)) {
                    
                    header("Location: success.php");
                    exit();
                } else {
                    $message = "Error: " . $sql_student . "<br>" . mysqli_error($conn);
                }
            }
        } else {
            $message = "Error: " . $sql_register . "<br>" . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
