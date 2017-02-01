<?php
include "header/header-control.php";
include "dbconnect.php";
if(isset($_SESSION['username'])){
  $owner = $_SESSION['username'];
  if(isset($_POST['spot_id'])){
    $spot = $_POST['spot_id'];
    $resp = -15;
    include "check_owner_verified.php";
    echo $resp;
    if($resp == 0){
      $dailyparking_query = "INSERT INTO dailyparking(spot_number, owner) VALUES('$spot', '$owner')";
      $run_dailyparking = mysqli_query($conn, $dailyparking_query);
      $event = "INSERT INTO mastertable(action, user, actiontime, actionrecipient) VALUES('rent_out_spot', '$owner', CURRENT_TIMESTAMP, '$spot')";
      $run_event = mysqli_query($conn, $event);
      $resp = 1;
    }
  }
}
//echo $spot;



?>
