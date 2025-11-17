<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Rollno  = $_POST["Rollno"];
    $Name    = $_POST["Name"];
    $Address = $_POST["Address"];
    $Phno    = $_POST["Phno"];
    $User    = $_POST["User"];
    $Pass    = $_POST["Pass"];
    $Repass  = $_POST["Repass"];

   
    if ($Pass !== $Repass) {
        echo "<h3 style='color:red;'>❌ Passwords do NOT match. Please try again.</h3>";
    } else {

        $con = mysqli_connect('localhost', 'root', '', 'website');

        if (!$con) {
            die("❌ Cannot connect to database");
        }

       
        $sq = "INSERT INTO studreg (Rollno, Name, Address, Phno, Username, Password) 
               VALUES ('$Rollno', '$Name', '$Address', '$Phno', '$User', '$Pass')";

        if (mysqli_query($con, $sq)) {
            echo "<h3 style='color:green;'>✔ Student Registered Successfully!</h3>";
        } else {
            echo "<h3 style='color:red;'>❌ Error inserting record!</h3>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
</head>
<body>

<center><h2>STUDENT REGISTRATION FORM</h2></center>
<br><br>


<form method="POST">

    <center> Roll_no: 
        <input type="text" name="Rollno" required>
    </center><br>

    <center> Name: 
        <input type="text" name="Name" required>
    </center><br>

    <center> Address: 
        <textarea name="Address" required></textarea>
    </center><br>

    <center> Phone Number: 
        <input type="number" name="Phno" required>
    </center><br>

    <center> Username: 
        <input type="text" name="User" required>
    </center><br>

    <center> Password: 
        <input type="password" name="Pass" required>
    </center><br>

    <center> Retype Password: 
        <input type="password" name="Repass" required>
    </center><br>

    <center>
        <input type="reset" value="Reset">&nbsp;&nbsp;
        <input type="submit" value="Submit">
    </center>

</form>


</body>
</html>
