<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <center>ADMIN LOGIN</center>
        <form action="" method="post">
        <center><h4>Username:<h4> <input type="text" value="username" name="name">
          <h4>Password:</h4><input type="password" value="password" name="pass"></center>
           <center> <input type="submit" value="Login" name="submit"></center>
</form>
</body>
</html>
<?php
if(isset($_POST["submit"])){
$con = mysqli_connect('localhost', 'root', '', 'Website');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
$us=$_POST["name"];
$ps=$_POST["pass"];

$sq="select Username,Password from login where Username='$us' AND Password='$ps'";

$result = mysqli_query($con, $sq);

if (mysqli_num_rows($result) == 1) {
    echo "<script>alert('Logged in Successful');window.location.href='adminhome.php';</script>";     
     }
 else{
    echo "<script>alert('Invalid username & password');</script>";
 }
   
}



?>