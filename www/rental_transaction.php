<?php
include "header/header-control.php";

//note: THIS IS NOT AT ALL COMPLETE; THIS SIMPLY SENDS "MONEY" AROUND AS AN INTEGER--IT DOES NOT ACTUALLY TRANSFER CURRENCY
//$resp is a numerical code for different scenarios... Here is the key
// -15 (default) means something royally screwed up... (didn't even access check_owner_verified.php)
// -7 means that the $owner variable does not own any parking spots (does not exist in owners table)
// -6 means that the designated $owner does exist in the owners table, but has his/her ownership is not verified
// -5 means that the designated $owner owns a spot and that spot is verified, but it is not the spot that $renter is requesting
// -4 occurs when the renter does not have enough balance to rent a spot
// -3 is a failure in executing the SQL Query to deduct $1.50 from the renters account
// -2 is a failure in executing the SQL Query to retreive the owner's balance
// -1 is a failure in executing the SQL Query to add $1.50 to the owners account
// 1 is a success!

if(isset($_POST['renter']) && isset($_POST['spot_id']) && isset($_POST['money']) && isset($_POST['owner'])){
  include "dbconnect.php";
  $owner = $_POST['owner'];
  $resp = -15;
  include "check_owner_verified.php";
  if($resp == 0){
    $new_balance_renter = floatval($_POST['money']) - 1.50;
    if($new_balance_renter<0){
      $resp = -4;
    }else{
      $renter = $_POST['renter'];
      $renter_transaction_query = "UPDATE users SET moneys='$new_balance_renter' WHERE username='$renter'";
      $renter_transaction = mysqli_query($conn, $renter_transaction_query);
      if(!$renter_transaction){
        $resp = -3;
      }else{
        $owner_balance_query = "SELECT moneys FROM users where username='$owner'";
        $owner_balance = mysqli_query($conn, $owner_balance_query);
        if(!$owner_balance){
          $resp = -2;
          $reset_renter_balance = $new_balance_renter + 1.5;
          $renter_transaction_query = "UPDATE users SET moneys='$reset_renter_balance' WHERE username='$renter'";
          $renter_transaction = mysqli_query($conn, $renter_transaction_query);
        }else{
          $row = mysqli_fetch_assoc($owner_balance);
          $new_owner_balance = $row['moneys'] + 1.5;
          $owner_transaction_query = "UPDATE users SET moneys='$new_owner_balance' WHERE username='$owner'";
          $owner_transaction = mysqli_query($conn, $owner_transaction_query);
          if(!$owner_transaction){
            $resp = -1;
          }else{
            $event = "INSERT INTO mastertable(action, user, actiontime, actionrecipient) VALUES('transaction_pay', '$renter', CURRENT_TIMESTAMP, '$owner')";
            $run_event = mysqli_query($conn, $event);
            $spot = $_POST['spot_id'];
            $event = "INSERT INTO mastertable(action, user, actiontime, actionrecipient) VALUES('spot_rental', '$renter', CURRENT_TIMESTAMP, '$spot')";
            $run_event = mysqli_query($conn, $event);
            $resp = 1;
          }
        }
      }
    }
  }
//  echo $resp;
}




?>
