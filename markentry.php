<?php
$con = mysqli_connect('localhost', 'root', '', 'website');

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}


if (isset($_POST['Submit'])) {

    $m1    = $_POST['m1'];
    $m2    = $_POST['m2'];
    $m3    = $_POST['m3'];
    $total = $_POST['total'];
    $roll  = $_POST['Rollno']; 

    $sq1 = "INSERT INTO studmark (Rollno, Science, Maths, English, Total)
            VALUES ('$roll', '$m1', '$m2', '$m3', '$total')";

    if (mysqli_query($con, $sq1)) {
        echo "<h3 style='color:green;'>✔ Student Marks Entered Successfully!</h3>";
    } else {
        echo "<h3 style='color:red;'>❌ Error: " . mysqli_error($con) . "</h3>";
    }
}


$sq = "SELECT Rollno FROM studreg";
$result = mysqli_query($con, $sq);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Marks Entry</title>
</head>
<body>

<h2>Enter Marks</h2>

<form method="POST">

    <label>Select Roll No:</label><br>
    <select name="Rollno">
        <?php
        while ($rows = mysqli_fetch_assoc($result)) {
            echo "<option value='{$rows['Rollno']}'>{$rows['Rollno']}</option>";
        }
        ?>
    </select><br><br>

    Science Mark: <input type="text" id="a" name="m1"><br><br>
    Maths Mark:   <input type="text" id="b" name="m2"><br><br>
    English Mark: <input type="text" id="c" name="m3"><br><br>

    <input type="button" value="Calculate Total Marks" onclick="fun()">
    <input type="text" id="ab" name="total" readonly><br><br>

    <input type="reset" value="Reset">
    <input type="submit" name="Submit" value="Submit">

</form>

<script>
function fun() {
    let x = parseFloat(document.getElementById("a").value) || 0;
    let y = parseFloat(document.getElementById("b").value) || 0;
    let z = parseFloat(document.getElementById("c").value) || 0;

    document.getElementById("ab").value = x + y + z;
}
</script>

</body>
</html>
