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
        echo "<h3 style='color:green; text-align:center;'>✔ Student Marks Entered Successfully!</h3>";
    } else {
        echo "<h3 style='color:red; text-align:center;'>❌ Error: " . mysqli_error($con) . "</h3>";
    }
}

$sq = "SELECT Rollno FROM studreg";
$result = mysqli_query($con, $sq);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Marks Entry</title>
    <link rel="stylesheet" href="markentry.css">
</head>
<body>

<div class="form-container">

<h2>Enter Marks</h2>

<form method="POST">

    <label>Select Roll No</label>
    <select name="Rollno" required>
        <?php while ($rows = mysqli_fetch_assoc($result)) { ?>
            <option value="<?= $rows['Rollno']; ?>"><?= $rows['Rollno']; ?></option>
        <?php } ?>
    </select>

    <label>Science Mark</label>
    <input type="text" id="a" name="m1" required>

    <label>Maths Mark</label>
    <input type="text" id="b" name="m2" required>

    <label>English Mark</label>
    <input type="text" id="c" name="m3" required>

    <div class="calc-box">
        <input type="button" value="Calculate Total" onclick="fun()" class="calc-btn">
        <input type="text" id="ab" name="total" readonly placeholder="Total marks">
    </div>

    <div class="btns">
        <button type="reset" class="reset-btn">Reset</button>
        <button type="submit" name="Submit" class="submit-btn">Submit</button>
    </div>

</form>

</div>

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
