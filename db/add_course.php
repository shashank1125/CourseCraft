<?php
$servername = "localhost";
$username = "root";
$password = " ";
$dbname = "course_management";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$courseName = $_POST['courseName'];
$courseDescription = $_POST['courseDescription'];


$sql = "INSERT INTO courses (course_name, course_description) VALUES ('$courseName', '$courseDescription')";

if ($conn->query($sql) === TRUE) {
  echo "New course added successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
