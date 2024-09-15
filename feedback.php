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


$UserId = $_POST["UserId"];
$Username = $_POST["Username"];

$query = "SELECT Coursename,Feedback,Instructorid
          FROM feedback
          WHERE Studentid='$UserId'";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <style>
           body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
}

.card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.card-header {
    background-color: #333;
    color: white;
    padding: 15px;
    text-align: center;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.display {
    margin: 0;
    padding: 0;
}

.table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
}

.table th, .table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd; 
}

.first-row {
    background-color: #65CCAA;
    color: white;
}

.card-details {
    padding: 20px;
}


.table tbody tr:hover {
    background-color: #f2f2f2;
}

    </style>
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h2 class="display">List of Feedback from the Instructors</h2>
                    </div>
                    <div class="card-details">
                        <table class="table">
                            <thead>
                                <tr class="first-row">
                                    <th>Course Name</th>
                                    <th>Feedback</th>
                                    <th>Instructor Id</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($row = mysqli_fetch_assoc($result)){
                                ?>
                                <tr>
                                    <td><?php echo $row['Coursename']; ?></td>
                                    <td><?php echo $row['Feedback']; ?></td>
                                    <td><?php echo $row['Instructorid']; ?></td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>                     
                </div>    
            </div>
        </div>
    </div>
</body>
</html>
