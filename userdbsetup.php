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
$alterTable3 = "ALTER TABLE users ADD COLUMN studentid int(11) NOT NULL";

$run_alterTable0 = mysqli_query($conn, $alterTable0);
$run_alterTable1 = mysqli_query($conn, $alterTable1);
$run_alterTable2 = mysqli_query($conn, $alterTable2);
$run_alterTable3 = mysqli_query($conn, $alterTable3);

$createOwnerTable = "CREATE TABLE IF NOT EXISTS owners(
  id int(11) NOT NULL PRIMARY KEY,
  email text NOT NULL,
  spotnumber int(11) NOT NULL,
  verified boolean NOT NULL,
  licenseplate text NOT NULL
) ENGINE = MYISAM";
$run_createOwnerTable = mysqli_query($conn, $createOwnerTable);
$alterTable4 = "ALTER TABLE owners ADD COLUMN studentid int(11) NOT NULL";
$run_alterTable4 = mysqli_query($conn, $alterTable4);

$createBugTable = "CREATE TABLE IF NOT EXISTS bugs (
  id int(11) NOT NULL PRIMARY KEY,
  issue text NOT NULL,
  currtime TIMESTAMP NOT NULL
) ENGINE = MYISAM";
$run_createBugTable = mysqli_query($conn, $createBugTable);



$createRenterTable = "CREATE TABLE IF NOT EXISTS renters(
  id int(11) NOT NULL PRIMARY KEY,
  email text NOT NULL,
  carmodel text NOT NULL,
  carcolor text NOT NULL,
  licenseplate text NOT NULL
) ENGINE = MYISAM";
$run_createRenterTable = mysqli_query($conn, $createRenterTable);
$alterTable4 = "ALTER TABLE renters ADD COLUMN studentid int(11) NOT NULL";
$run_alterTable4 = mysqli_query($conn, $alterTable4);

$createSpotsTable = "CREATE TABLE IF NOT EXISTS dailyparking(
  id int(11) NOT NULL PRIMARY KEY,
  spotnumber int(11) NOT NULL,
  available tinyint(2) NOT NULL,
  owner text NOT NULL
) ENGINE = MYISAM";
$run_createSpotsTable = mysqli_query($conn, $createSpotsTable);


$createMasterTable = "CREATE TABLE IF NOT EXISTS mastertable(
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  action text NOT NULL,
  user text NOT NULL,
  actiontime TIMESTAMP NOT NULL,
  actionrecipient text
) ENGINE = MYISAM";
$run_createMasterTable = mysqli_query($conn, $createMasterTable);

$createEventScheduler = "
CREATE EVENT IF NOT EXISTS reset_spots
ON SCHEDULE EVERY 1 DAY
  STARTS '2016-12-09 21:25:00'
  ENDS '2038-1-18 00:00:00'
DO DELETE FROM dailyparking;";
$run_eventScheduler = mysqli_query($conn, $createEventScheduler);


//what to do.. what to do..
/*
Fix the mastertable in register-renter and register-spot

*/
?>
