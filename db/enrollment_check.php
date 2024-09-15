<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "course_management";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = $_POST['UserId'];
$courseName = $_POST['CourseName'];


$sql = "SELECT * FROM enrollment WHERE Studentid = '$userId' AND Coursename = '$courseName'";
$result = $conn->query($sql);


if ($result->num_rows > 0)
 {
    echo "You have enrolled in this course. Continue learning.')";
   
} else { 
   
    header("Location: twoenroll.html");
}


$conn->close();
?>