<?php
include "/header/header-control.php";
include "dbconnect.php";
if(isset($owner) && isset($resp)){
  $owner_exists_query = "SELECT * FROM owners where email='$owner'";
  $run_owner = mysqli_query($conn, $owner_exists_query);
  $check_owner = mysqli_num_rows($run_owner);
  if($check_owner > 0){
    $owner_verified_query = "SELECT verified FROM owners where email='$owner'";
    $run_verified = mysqli_query($conn, $owner_verified_query);
    $row = mysqli_fetch_assoc($run_verified);
    if($row['verified']==1){
      $owner_correct_spot_query = "SELECT spotnumber FROM owners where email='$owner'";
      $run_correct_spot = mysqli_query($conn, $owner_correct_spot_query);
      $num_of_spots_owned = mysqli_num_rows($run_correct_spot);
      $i = 0;
    //  echo $row['spotnumber'];
      $resp = -5;
      for($i=0; $i<$num_of_spots_owned;$i++){
        $row = mysqli_fetch_assoc($run_correct_spot);
        if($row['spotnumber']==$spot){
          $resp = 0;
        }
      }
    }else{
      $resp = -6;
    }
  }else{
    $resp = -7;
  }
}
?>
