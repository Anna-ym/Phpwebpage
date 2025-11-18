<?php

$con = mysqli_connect('localhost', 'root', '', 'website');
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}


$m1 = $m2 = $m3 = $total = '';
$selectedRoll = '';


if (isset($_POST['Rollno'])) {
    $selectedRoll = $_POST['Rollno'];
    $res = mysqli_query($con, "SELECT * FROM studmark WHERE Rollno='$selectedRoll'");
    if (mysqli_num_rows($res) > 0) {
        $marks = mysqli_fetch_assoc($res);
        $m1 = $marks['Science'];
        $m2 = $marks['Maths'];
        $m3 = $marks['English'];
        $total = $marks['Total'];
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
        if (mysqli_query($con, $sql)) {
            echo "<h3 style='color:green;'>✔ Marks Inserted Successfully!</h3>";
        } else {
            echo "<h3 style='color:red;'>❌ Error: " . mysqli_error($con) . "</h3>";
        }
    } else {
       
        $sql = "UPDATE studmark SET Science='$m1', Maths='$m2', English='$m3', Total='$total' 
                WHERE Rollno='$roll'";
        if (mysqli_query($con, $sql)) {
            echo "<h3 style='color:green;'>✔ Marks Updated Successfully!</h3>";
        } else {
            echo "<h3 style='color:red;'>❌ Error: " . mysqli_error($con) . "</h3>";
        }
    }
}


$sq = "SELECT Rollno, Name FROM studreg";
$result = mysqli_query($con, $sq);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Marks Update</title>
</head>
<body>

<h2>Enter Marks to Update</h2>

<form method="POST">

    <label>Select Roll No:</label><br>
    <select name="Rollno" onchange="this.form.submit()">
        <option value="">--Select Roll No--</option>
        <?php
        while ($rows = mysqli_fetch_assoc($result)) {
            $sel = ($rows['Rollno'] == $selectedRoll) ? "selected" : "";
            echo "<option value='{$rows['Rollno']}' $sel>{$rows['Rollno']} - {$rows['Name']}</option>";
        }
        ?>
    </select><br><br>

    Science Mark: <input type="text" id="a" name="m1" value="<?php echo htmlspecialchars($m1); ?>"><br><br>
    Maths Mark:   <input type="text" id="b" name="m2" value="<?php echo htmlspecialchars($m2); ?>"><br><br>
    English Mark: <input type="text" id="c" name="m3" value="<?php echo htmlspecialchars($m3); ?>"><br><br>

    <input type="button" value="Calculate Total Marks" onclick="calculateTotal()">
    Total: <input type="text" id="ab" name="total" value="<?php echo htmlspecialchars($total); ?>" readonly><br><br>

    <input type="reset" value="Reset">
    <input type="submit" name="Submit" value="Submit">

</form>

<script>
function calculateTotal() {
    let science = parseFloat(document.getElementById("a").value) || 0;
    let maths = parseFloat(document.getElementById("b").value) || 0;
    let english = parseFloat(document.getElementById("c").value) || 0;

    document.getElementById("ab").value = science + maths + english;
}
</script>

</body>
</html>
