<?php
include("dbconnect.php");
$createTable = "CREATE TABLE IF NOT EXISTS users (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
   username text NOT NULL,
   pass binary(60) NOT NULL,
   privelege tinyint(2) NOT NULL
 ) ENGINE = MYISAM";
$run_createTable = mysqli_query($conn, $createTable);
$alterTable0 = "ALTER TABLE users MODIFY COLUMN id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY";
$alterTable1 = "ALTER TABLE users MODIFY COLUMN username text NOT NULL";
$alterTable2 = "ALTER TABLE users MODIFY COLUMN pass text NOT NULL";
$alterTable3 = "ALTER TABLE users MODIFY COLUMN privelege tinyint(2) NOT NULL";
$run_alterTable0 = mysqli_query($conn, $alterTable0);
$run_alterTable1 = mysqli_query($conn, $alterTable1);
$run_alterTable2 = mysqli_query($conn, $alterTable2);
$run_alterTable3 = mysqli_query($conn, $alterTable3);
?>
