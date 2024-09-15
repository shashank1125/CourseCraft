<?php

session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "course_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$UserId = $_SESSION['UserId'];
$Studentid = $_POST['Studentid'];
$Coursename = $_POST['Coursename'];
$Feedback = $_POST['Feedback'];

$sql = "INSERT INTO feedback (Studentid, Coursename, Feedback,Instructorid) VALUES ('$Studentid', '$Coursename', '$Feedback','$UserId')";

if ($conn->query($sql) === TRUE) {
    echo "Feedback submitted successfully:)";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
