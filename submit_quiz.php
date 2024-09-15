<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "course_management";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$UserId = $_POST['UserId'];
$coursename = $_POST['Coursename'];
$marks = $_POST['marks'];


$sql = "UPDATE student SET marks = $marks WHERE Student_id = $UserId ";
$ssql = "UPDATE enrollment SET marks = $marks WHERE Studentid = $UserId AND Coursename='$coursename'";

if ($conn->query($sql) === TRUE && $conn->query($ssql)==TRUE) {
    echo "Quiz results submitted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>
