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
        $query = "SELECT * FROM student WHERE marks != 0 AND Student_id='$Studentid'";
        $queryResult = mysqli_query($conn, $query);
        $numRows = mysqli_num_rows($queryResult);
        
        if ($numRows > 0) 
        {
            $sql = "INSERT INTO enrollment (Studentid,Studentname, Coursename, Startdate, Enddate) VALUES ('$Studentid','$Studentname', '$Coursename', '$Startdate', '$Enddate')";
            $ssql = "UPDATE student SET course_enrolled_in='$Coursename', marks=0 WHERE Student_id = $Studentid";
            
            if ($conn->query($sql) === TRUE && $conn->query($ssql) === TRUE) 
            {
                echo "Enrollment successful!";
                header("Location: aiml1.html");
                
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
         else {
            echo "Kindly complete the ongoing course before enrolling into another course";
        }
        
    }


$conn->close();
?>
