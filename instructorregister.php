<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "course_management";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];
    $Email = $_POST["Email"];
    $Coursetaught = $_POST["Coursetaught"]; 
    $Userrole = $_POST["Userrole"];
    $UserId = $_POST["UserId"];
    
   
    $existSql = "SELECT * FROM `instructorregister` WHERE username = '$Username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    
    if($numExistRows > 0){
        
        echo "<script>alert('Username already exists');</script>";
    } else {
        
        $sql_register = "INSERT INTO instructorregister (Username, Password, Email, UserId) VALUES ('$Username', '$Password', '$Email', '$UserId')";
        
        if(mysqli_query($conn, $sql_register))
        {
            if ($Userrole == "instructor") 
            {
                
                $sql_instructor = "INSERT INTO instructor (Instructor_id, Instructor_name, course_taught) VALUES ('$UserId', '$Username', '$Coursetaught')";
                if (mysqli_query($conn, $sql_instructor)) 
                {
                    
                    $_SESSION["UserId"] = $UserId;
                    $_SESSION["Coursetaught"] = $Coursetaught;
                    $_SESSION["Userrole"] = $Userrole;
                    header("Location: success.php");
                    exit();
                } else {
                    $message = "Error: " . $sql_instructor . "<br>" . mysqli_error($conn);
                }
            }
        } else {
            $message = "Error: " . $sql_register . "<br>" . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
