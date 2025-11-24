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
        echo "<h3 style='color:red; text-align:center;'>❌ Passwords do NOT match. Please try again.</h3>";
    } else {

        $con = mysqli_connect('localhost', 'root', '', 'website');

        if (!$con) {
            die("❌ Cannot connect to database");
        }

        $sq = "INSERT INTO studreg (Rollno, Name, Address, Phno, Username, Password) 
               VALUES ('$Rollno', '$Name', '$Address', '$Phno', '$User', '$Pass')";

        if (mysqli_query($con, $sq)) {
            echo "<h3 style='color:green; text-align:center;'>✔ Student Registered Successfully!</h3>";
        } else {
            echo "<h3 style='color:red; text-align:center;'>❌ Error inserting record!</h3>";
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

    <!-- Link external CSS -->
    <link rel="stylesheet" href="studentreg.css">
</head>
<body>

<div class="form-container">
    <h2>Student Registration Form</h2>

    <form method="POST">

        <label>Roll Number</label>
        <input type="text" name="Rollno" required>

        <label>Name</label>
        <input type="text" name="Name" required>

        <label>Address</label>
        <textarea name="Address" required></textarea>

        <label>Phone Number</label>
        <input type="number" name="Phno" required>

        <label>Username</label>
        <input type="text" name="User" required>

        <label>Password</label>
        <input type="password" name="Pass" required>

        <label>Retype Password</label>
        <input type="password" name="Repass" required>

        <div class="btns">
            <button type="reset" class="reset-btn">Reset</button>
            <button type="submit" class="submit-btn">Submit</button>
        </div>

    </form>
</div>

</body>
</html>
