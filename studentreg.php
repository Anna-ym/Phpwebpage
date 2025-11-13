<?php
echo "Roll no of the Student: ".$_POST["Roll_no"]."<br><br>";
echo "Name of the Student: ".$_POST["Name"]."<br><br>";
echo "Address of the Student: ".$_POST["Address"]."<br><br>";
echo "Phone Number of the Student: ".$_POST["Phno"]."<br><br>";
echo "Username of the Student: ".$_POST["User"]."<br><br>";
echo "Password of the Student: ".$_POST["Pass"]."<br><br>";
echo "Retpe Password of the Student: ".$_POST["Repass"]."<br><br>";

$con=mysqli_connect('localhost','root','','website');
if($con)
    echo "Success";
else
    echo "Cannot be connected";
$Roll_no=$_POST["Roll_no"];
$Name=$_POST["Name"];
$Address=$_POST["Addresss"];
$Phno=$_POST["Phno"];
$User=$_POST["User"];
$Pass=$_POST["Pass"];
$Repass=$_POST["Repass"];


$sq="insert into stud values($Roll_no,'$Name','$Class','$Marks')";
if(mysqli_query($con,$sq))
    echo "Inserted";
else
    echo "Error";
?>