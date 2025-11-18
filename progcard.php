<?php
$con = mysqli_connect('localhost', 'root', '', 'website');
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

$m1 = $m2 = $m3 = $total = '';
$studentData = [];
$selectedRoll = '';


$topQuery = mysqli_query($con, "
    SELECT studreg.Rollno, studreg.Name, studmark.Total 
    FROM studreg 
    INNER JOIN studmark ON studreg.Rollno = studmark.Rollno
    ORDER BY studmark.Total DESC 
    LIMIT 1
");
$topStudent = mysqli_fetch_assoc($topQuery);


if (isset($_POST['Rollno'])) {
    $selectedRoll = $_POST['Rollno'];

    $res = mysqli_query($con, "
        SELECT studreg.*, studmark.* 
        FROM studreg 
        LEFT JOIN studmark 
        ON studreg.Rollno = studmark.Rollno
        WHERE studreg.Rollno = '$selectedRoll'
    ");

    if ($res && mysqli_num_rows($res) > 0) {
        $studentData = mysqli_fetch_assoc($res);
    }
}


if (isset($_POST['Submit'])) {

    $m1    = $_POST['m1'];
    $m2    = $_POST['m2'];
    $m3    = $_POST['m3'];
    $total = $_POST['total'];
    $roll  = $_POST['Rollno'];

    $check = mysqli_query($con, "SELECT * FROM studmark WHERE Rollno='$roll'");

    if (mysqli_num_rows($check) == 0) {
        $sql = "INSERT INTO studmark (Rollno, Science, Maths, English, Total) 
                VALUES ('$roll', '$m1', '$m2', '$m3', '$total')";
        $msg = mysqli_query($con, $sql)
            ? "<h3 style='color:green;'>✔ Marks Inserted Successfully!</h3>"
            : "<h3 style='color:red;'>❌ Error: " . mysqli_error($con) . "</h3>";
    } else {
        $sql = "UPDATE studmark SET Science='$m1', Maths='$m2', English='$m3', Total='$total' 
                WHERE Rollno='$roll'";
        $msg = mysqli_query($con, $sql)
            ? "<h3 style='color:green;'>✔ Marks Updated Successfully!</h3>"
            : "<h3 style='color:red;'>❌ Error: " . mysqli_error($con) . "</h3>";
    }
}

$sq = "SELECT Rollno, Name FROM studreg";
$result = mysqli_query($con, $sq);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Progress Card</title>
</head>
<body>

<h1>PROGRESS CARD</h1>


<div style="background:#eef; padding:10px; border:1px solid #88f;">
    <a href="#topstudent"><b>🔝 View Top Student</b></a>
    <p>
        <b>Top Student:</b> <?= $topStudent['Name'] ?>  
        (Roll: <?= $topStudent['Rollno'] ?>)  
        <b>Total Marks:</b> <?= $topStudent['Total'] ?>
    </p>
</div>

<br>

<form method="POST">

    <label>Select Roll No:</label><br>
    <select name="Rollno" onchange="this.form.submit()">
        <option value="">--Select Roll No--</option>

        <?php while ($rows = mysqli_fetch_assoc($result)) { ?>
            <option value="<?= $rows['Rollno'] ?>" 
                <?= ($rows['Rollno'] == $selectedRoll) ? "selected" : "" ?>>
                <?= $rows['Rollno'] ?> - <?= $rows['Name'] ?>
            </option>
        <?php } ?>

    </select><br><br>

</form>


<?php if (!empty($studentData)) { ?>

<h2>Student Details</h2>
<table border="1" cellpadding="10">
    <tr><th>Roll No</th><td><?= $studentData['Rollno'] ?></td></tr>
    <tr><th>Name</th><td><?= $studentData['Name'] ?></td></tr>
    <tr><th>Science</th><td><?= $studentData['Science'] ?></td></tr>
    <tr><th>Maths</th><td><?= $studentData['Maths'] ?></td></tr>
    <tr><th>English</th><td><?= $studentData['English'] ?></td></tr>
    <tr><th>Total</th><td><?= $studentData['Total'] ?></td></tr>
</table>

<?php } ?>

<br><br>


<h2 id="topstudent">Top Student</h2>
<table border="1" cellpadding="10">
    <tr><th>Roll No</th><td><?= $topStudent['Rollno'] ?></td></tr>
    <tr><th>Name</th><td><?= $topStudent['Name'] ?></td></tr>
    <tr><th>Total Marks</th><td><?= $topStudent['Total'] ?></td></tr>
</table>

</body>
</html>
