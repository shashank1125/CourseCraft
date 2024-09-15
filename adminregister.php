<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "course_management";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $Name = $_POST["Name"];
    $Password = $_POST["Password"];
    $Email = $_POST["Email"];
    $UserId = $_POST["UserId"];



        $sql_register = "INSERT INTO adminregister (Name, Password, Email,UserId) VALUES ('$Name', '$Password', '$Email','$UserId')";

        if (mysqli_query($conn, $sql_register))
         {
                    header("Location: login.html");
                    exit();
                } else {
                    $message = "Error: " . $sql_register . "<br>" . mysqli_error($conn);
                }
            }
    


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <style>
        
            body {
                margin: 0;
                padding: 0;
                font-family: 'Arial', sans-serif;
                background-color: #f4f4f4;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
    
            .registration-container {
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                padding: 30px;
                border-radius: 8px;
                width: 300px;
                text-align: center;
            }
    
            .registration-container h2 {
                color: #333;
            }
    
            .registration-form {
                display: flex;
                flex-direction: column;
                margin-top: 20px;
            }
    
            .registration-form label {
                font-size: 14px;
                color: #666;
                margin-bottom: 5px;
                text-align: left;
            }
    
            .registration-form input,
            .registration-form select {
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 16px;
            }
    
            .registration-form button {
                background-color: #EBD9B4;
                color: black;
                padding: 10px 20px;
                font-size: 1em;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
    
            .registration-form button:hover {
                background-color: #D2B48C;
            }
    
            .unique-id {
                font-size: 18px;
                color: #333;
                margin-top: 20px;
            }
    
            .unique-id-container {
                margin-top: 20px;
                text-align: center;
            }
    
            #unique-id-display {
                font-size: 2em;
                margin: 20px 0;
                padding: 10px;
                background-color: black;
                color: #fff;
                border-radius: 5px;
            }
        
    </style>
    <script>
        // Function to generate a unique ID
        function generateUserId() {
            // Logic to generate a unique ID (you can use any logic you want)
            var generatedId = Math.floor(1000 + Math.random() * 9000);

            // Display the generated ID
            document.getElementById("unique-id-display").innerText = "Your User ID is: " + generatedId;

            // Set the generated ID as the value of the UserId input field
            document.getElementById("UserId").value = generatedId;
        }
    </script>
</head>
<body>

    <div class="registration-container">
        <h2>Registration</h2>
        <form class="registration-form" action="adminregister.php" method="post">

           
            <label for="Name">Name:</label>
            <input type="text" id="Name" name="Name" required>

            <label for="Password">Password:</label>
            <input type="Password" id="Password" name="Password" required>

            <label for="Email">Email:</label>
            <input type="Email" id="Email" name="Email" required>

            <button type="button" onclick="generateUserId()">Generate User ID</button>

            <div class="unique-id-container">
                <div id="unique-id-display">1234</div>
            </div>

            <!-- Input field for UserID -->
            <label for="UserId">User ID:</label>
            <input type="text" id="UserId" name="UserId" required readonly>

            

            <button type="submit">Register</button>
            
        </form>
    </div>

</body>
</html>
