<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Marks Bar Graph</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .bar-graph {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .bar {
            width: 20px;
            background-color: #007bff;
            margin-right: 10px;
            transition: height 0.5s ease;
        }

        .bar-text {
            font-size: 14px;
            margin-top: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Marks Bar Graph</h1>
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "course_management";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT Studentname,CourseName,marks  FROM enrollment GROUP BY CourseName";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
               
                $bar_height = ($row["marks"] / 100) * 200; 

                echo "<div class='bar-graph'>";
                
                echo "<div class='bar-text'>".$row["Studentname"]."</div>";
                echo "<div class='bar-text'>".$row["CourseName"]."</div>";
                echo "<div class='bar-text'>".$row["marks"]."</div>";
                echo "<div class='bar' style='height: ".$bar_height."px;'></div>";
                echo "</div>";
            }
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
