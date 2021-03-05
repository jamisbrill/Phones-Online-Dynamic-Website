<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<body>
<?php

$hostname = "192.168.1.133";
$username = "Sam"; //user
$password = "password";
$db = "HealthLog"; //db 

$dbconnect=mysqli_connect($hostname,$username,$password,$db);

if ($dbconnect->connect_error) {
  die("Database connection failed: " . $dbconnect->connect_error);
}

?>

<table border="1" align="center">
<tr>
  <td>Reviewer Name</td>
  <td>Stars</td>
  <td>Name</td>
</tr>

<?php

$query = mysqli_query($dbconnect, "SELECT * FROM Log")
   or die (mysqli_error($dbconnect));

while ($row = mysqli_fetch_array($query)) {
  echo
   "<tr>
    <td>{$row['ID']}</td>
    <td>{$row['Pull_Up_Count']}</td>
    <td>{$row['Name']}</td>
   </tr>\n";

}

?>
</table>
</body>
</html>
