<?php
$db = 'UserDB';
$conn = mysqli_connect("localhost:3306", "root", "");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
mysqli_select_db($conn, $db);
?>
