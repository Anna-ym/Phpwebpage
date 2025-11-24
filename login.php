<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    
    <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="login-container">

    <h2>ADMIN LOGIN</h2>

    <form action="" method="post">
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="name" required placeholder="Enter username">
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="pass" required placeholder="Enter password">
        </div>

        <button type="submit" name="submit">Login</button>
    </form>

</div>

</body>
</html>

<?php
if(isset($_POST["submit"])){

    $con = mysqli_connect('localhost', 'root', '', 'Website');

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $us = $_POST["name"];
    $ps = $_POST["pass"];

    $sq = "SELECT Username, Password FROM login 
           WHERE Username='$us' AND Password='$ps'";

    $result = mysqli_query($con, $sq);

    if (mysqli_num_rows($result) == 1) {
        echo "<script>alert('Login Successful');window.location.href='link.html';</script>";
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>
