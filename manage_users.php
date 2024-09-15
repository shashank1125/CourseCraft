<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "course_management";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    if(isset($_POST['delete_student_id'])) {
        $studentId = $_POST['delete_student_id'];
        
       
        $ssql = "DELETE FROM student WHERE Student_id = '$studentId'";

        if ($conn->query($ssql) === TRUE) {
            echo "Student record deleted successfully";
        } else {
            echo "Error deleting student record: " . $conn->error;
        }
    }

  
    if(isset($_POST['delete_instructor_id'])) {
        $instructorId = $_POST['delete_instructor_id'];
       
        $sql = "DELETE FROM instructor WHERE Instructor_id = '$instructorId'";

        if ($conn->query($sql) === TRUE) {
            echo "Instructor record deleted successfully";
        } else {
            echo "Error deleting instructor record: " . $conn->error;
        }
    }
}

$ssql = "SELECT * FROM student";
$sresult = $conn->query($ssql);

$sql = "SELECT * FROM instructor";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student and Instructor List</title>
    <style>
           body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            color: #333;
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
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        td button {
            padding: 8px 16px;
            background-color: #f44336;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        td button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>STUDENT LIST</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($sresult->num_rows > 0) {
                        while($row = $sresult->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["Student_id"] . "</td>";
                            echo "<td>" . $row["Student_name"] . "</td>";
                            echo "<td>
                                    <form action='' method='post'> <!-- Removed action attribute to submit to the same page -->
                                        <input type='hidden' name='delete_student_id' value='" . $row["Student_id"] . "'>
                                        <button type='submit'>Delete</button>
                                    </form>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>0 results</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>INSTRUCTOR LIST</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Instructor ID</th>
                        <th>Instructor Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["Instructor_id"] . "</td>";
                            echo "<td>" . $row["Instructor_name"] . "</td>";
                            echo "<td>
                                    <form action='' method='post'> <!-- Removed action attribute to submit to the same page -->
                                        <input type='hidden' name='delete_instructor_id' value='" . $row["Instructor_id"] . "'>
                                        <button type='submit'>Delete</button>
                                    </form>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>0 results</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
