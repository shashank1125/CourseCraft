<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "course_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $UserId = $_POST["UserId"];
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];
    $Userrole = $_POST["Userrole"];

    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
    $sql_login = "INSERT INTO login (UserId, Username, Password, Userrole) VALUES ('$UserId', '$Username', '$hashedPassword', '$Userrole')";
    $resultlogin=mysqli_query($conn, $sql_login);
    if(!$resultlogin) 
    {
        $message = "Error: " . $sql_login . "<br>" . mysqli_error($conn);
    }


    if ($Userrole == "Student") 
    {
        $selectSql = "SELECT * FROM studentregister WHERE UserId = '$UserId'";
        $result = mysqli_query($conn, $selectSql);
        $numExistRows = mysqli_num_rows($result);
        if ($numExistRows > 0)
         {
            header("Location: student_dashboard.html");
            exit();
        } 
        else 
        {
            header("Location: register.html");
            exit();
        }
    } 
    elseif ($Userrole == "Instructor")
     {
        $selectinst = "SELECT * FROM instructorregister WHERE UserId = '$UserId'";
        $result = mysqli_query($conn, $selectinst);
        $numExistRows = mysqli_num_rows($result);
        if ($numExistRows > 0) {
            
            header("Location: instructor_dashboard.html");
            exit();
        } else 
        {
            header("Location: register.html");
            exit();
        }

        
    } 
    else
    {
       $selectinst = "SELECT * FROM adminregister WHERE UserId = '$UserId'";
       $result = mysqli_query($conn, $selectinst);
       $numExistRows = mysqli_num_rows($result);
       if ($numExistRows > 0) {
           
           header("Location: admin.html");
           exit();
       } else 
       {
           header("Location: register.html");
           exit();
       }

       
   } 
    
}

$conn->close();
?>
