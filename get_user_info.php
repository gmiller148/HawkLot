<?php
include "/header/header-control.php";
include "dbconnect.php";
if($_SESSION['logon'] >=1){
  $username = $_SESSION['username'];

  $get_id = "SELECT name FROM users WHERE username='$username'";
  $run_id = mysqli_query($conn, $get_id);

  $get_money = "SELECT moneys FROM users WHERE username='$username'";
  $run_money = mysqli_query($conn, $get_money);
  $row = mysqli_fetch_assoc($run_money);
  $_SESSION['money'] = $row['moneys'];

  $name = '';
  if (mysqli_num_rows($run_id) > 0) {
    while($row = mysqli_fetch_assoc($run_id)) {
      $name = $row["name"];
    }
  }

  $data = $name.",".$username.",".number_format($_SESSION['money'],2);
  echo $data;



}
?>
