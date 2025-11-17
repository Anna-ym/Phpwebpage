<?php
$con = mysqli_connect('localhost', 'root', '', 'website');
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}


if (isset($_POST['update'])) {
    $rollno = $_POST['rollno'];
    $newAddress = $_POST['address'];
    $newPhno = $_POST['phno'];

    $updateQuery = "UPDATE studreg SET Address='$newAddress', Phno='$newPhno' WHERE Rollno='$rollno'";
    mysqli_query($con, $updateQuery);
    echo "<script>alert('Record updated successfully');</script>";
}


$sq = "SELECT * FROM studreg";
$result = mysqli_query($con, $sq);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellpadding='10'>
            <tr>
                <th>Roll No</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone No</th>
                <th>Action</th>
            </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>".$row['Rollno']."</td>
                <td>".$row['Name']."</td>
                <td>".$row['Address']."</td>
                <td>".$row['Phno']."</td>
                <td>
                    <button onclick='showUpdateForm(\"".$row['Rollno']."\", \"".$row['Address']."\", \"".$row['Phno']."\")'>Update</button>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No records found.";
}
?>


<div id="updateForm" style="display:none; position:fixed; top:20%; left:40%; background:#f0f0f0; padding:20px; border:1px solid #ccc;">
    <form method="POST">
        <input type="hidden" name="rollno" id="rollno">
        Address: <input type="text" name="address" id="address"><br><br>
        Phone No: <input type="text" name="phno" id="phno"><br><br>
        <input type="submit" name="update" value="Update">
        <button type="button" onclick="hideUpdateForm()">Cancel</button>
    </form>
</div>

<script>
function showUpdateForm(rollno, address, phno) {
    document.getElementById('rollno').value = rollno;
    document.getElementById('address').value = address;
    document.getElementById('phno').value = phno;
    document.getElementById('updateForm').style.display = 'block';
}

function hideUpdateForm() {
    document.getElementById('updateForm').style.display = 'none';
}
</script>
