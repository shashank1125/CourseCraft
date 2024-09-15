<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "course_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$Studentid = $_POST['Studentid'];
$Studentname = $_POST['Studentname'];
$Coursename = $_POST['Coursename'];
$Startdate = $_POST['Startdate'];
$Enddate = $_POST['Enddate'];


$selectSql = "SELECT * FROM enrollment WHERE Studentid = '$Studentid' AND Coursename='$Coursename'";
$selectResult = mysqli_query($conn, $selectSql);
$numExistRows = mysqli_num_rows($selectResult);

if ($numExistRows > 0) {
    echo "Already enrolled in '$Coursename'";
} 
else
 {
        
        $asql = "INSERT INTO enrollment (Studentid, Studentname, Coursename, Startdate, Enddate) VALUES ('$Studentid','$Studentname' ,'$Coursename', '$Startdate', '$Enddate')";
        $bsql = "UPDATE student SET course_enrolled_in='$Coursename' WHERE Student_id = $Studentid";
        
        if ($conn->query($asql) === TRUE && $conn->query($bsql) === TRUE)
        {
            echo "Enrollment successful! Start Learning:))    ";

        } else {
            echo "Error: " . $asql . "<br>" . $conn->error;
        }
    }
    
    


$conn->close();
?>
