<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "course_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "CALL GetStudentEnrollmentDetails()";// Call the stored procedure
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Display.css"/>
    <title>Student Enrollment Details</title>
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
    background-color: BLACK;
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
    background-color: #894456;
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
                        <h2 class="display">STUDENTS ENROLLMENT</h2>
                    </div>
                    <div class="card-details">
                        <table class="table">
                            <thead>
                                <tr class="first-row">
                                    <th>Student ID</th>
                                    <th>Studentname</th>
                                    <th>Course</th>
                                    <th>Enrollment date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($row = mysqli_fetch_assoc($result)){
                                ?>
                                <tr>
                                    <td><?php echo $row['Studentid']; ?></td>
                                    <td><?php echo $row['Studentname']; ?></td>
                                    <td><?php echo $row['Coursename']; ?></td>
                                    <td><?php echo $row['Enrollmentdate']; ?></td>
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
