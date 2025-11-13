<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  

     <form action="pgm12.php" method="get">
      
       Science Mark: <input type="text" id="a" name="m1" ><br><br>
       Maths Mark: <input type="text" id="b"  name="m2" ><br><br>
      English Mark: <input type="text" id="c" name="m3" ><br><br>
      <input type="button" value="Calculate Total Marks" onclick="fun()">
      <input type="text" id="ab" name="xy"><br><br>
      &nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="Reset" value="Reset">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" name="Submit" value="Submit" >
<script>
  function fun(){
  let x=parseFloat(document.getElementById("a").value);
  let y=parseFloat(document.getElementById("b").value);
  let z=parseFloat(document.getElementById("c").value);
  let t=x+y+z;
  document.getElementById("ab").value=t;
  }
  </script>
</body>
</html>