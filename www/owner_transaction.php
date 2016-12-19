<?php
include "header/header-control.php";

if(isset($_SESSION['username'])){
  $owner = $_SESSION['username'];
  if(isset($_POST['spot_id'])){
    $resp = -15;
    include "check_owner_verified.php";
    if($resp == 0){
      $spot = $_POST['spot_id'];
      $dailyparking_query = "INSERT INTO dailyparking(spot_number, owner) VALUES($spot, '$owner')";
      $run_dailyparking = mysqli_query($conn, $dailyparking_query);
      $event = "INSERT INTO mastertable(action, user, actiontime, actionrecipient) VALUES('rent_out_spot', '$email', CURRENT_TIMESTAMP, '$spot')";
      $run_event = mysqli_query($conn, $event);
      $resp = 1;
    }
  }
}




?>
