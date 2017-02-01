<?php
  include "/header/header-control.php";
  if($_SESSION['logon']<2) {
    header("refresh:0; url=index.php");
    echo "USER IS NOT LOGGED ON";
  exit;
}
?>

<html>
<head>
  <?php if($_SESSION['logon']>=2) {
      include "/header/header-head.php";
    }
    ?>
</head>
<body>
  <?php if($_SESSION['logon']>=2) {
      include "/header/header-body.php";
      include "dbconnect.php";
      $email = $_SESSION['username'];
      $sel_owner_query = "SELECT * FROM owners WHERE email='$email'";
      $run_owner = mysqli_query($conn, $sel_owner_query);
      $check_owner = mysqli_num_rows($run_owner);
      $verified = -2;
      if($check_owner > 0) {
        $valid_owner_query = "SELECT verified FROM owners WHERE email='$email'";
        $run_validate = mysqli_query($conn, $sel_owner_query);
        $row = mysqli_fetch_assoc($run_validate);
        if($row['verified']==1){
          $verified = 1;
        }else{
          $verified = 0;
        }
      }else{
        $verified = -1;
      }
    }
  ?>
    <?php if($verified==-2) : ?>
    <div class="container">
      <div class="row main">
        <h1><a href="register-spot.php">AN UNKNOWN ERROR HAS OCCURRED. PLEASE CONTACT HAWKLOT SUPPORT</a></h1>
      </div>
    </div>
    <?php endif; ?>
    <?php if($verified==-1) : ?>
    <div class="container">
      <div class="row main">
        <h1><a href="register-spot.php">Before you can access your account, you must register your parking spot!</a></h1>
      </div>
    </div>
    <?php endif; ?>
    <?php if($verified==0) : ?>
    <div class="container">
      <div class="row main">
        <h1>Please wait for us to verify your ownership of this spot!</h1>
      </div>
    </div>
    <?php endif; ?>
    <?php if($verified==1) : ?>
    <div class="container">
      <div class="row main">
        <div class="panel-heading">
        </div>
        <h1>Profile information:</h1>
        <script>
        function rentOutSpot(id){
          var transReq = new XMLHttpRequest();
          var transData = new FormData();
          transData.append('spot_id', id);
          transReq.onload = function(){
            $.post("json_edit.php",{id: id, value: false});
            location.reload();
            return false;
          };
          transReq.open("post","owner_transaction.php", true);
          transReq.send(transData);

        }
        </script>
    <?php if($verified==1){
      $owner_spots_query = "SELECT spotnumber FROM owners WHERE email='$email'";
      $owner_spots = mysqli_query($conn, $owner_spots_query);
      $i = 0;
      $num_of_spots = mysqli_num_rows($owner_spots);
      for($i=0; $i < $num_of_spots; $i++){
        $row = mysqli_fetch_assoc($owner_spots);
        $num = $row['spotnumber'];
        $disabled = '';
        $been_rented = '';
        $already_rented_query = "SELECT owner FROM dailyparking WHERE spot_number='$num'";
        $already_rented = mysqli_query($conn, $already_rented_query);
        $num_of_already_rented = mysqli_num_rows($already_rented);
        if($num_of_already_rented > 0){
          $disabled = 'disabled';
          $renter_rent_query = "SELECT renter FROM dailyparking WHERE spot_number='$num'";
          $renter_rent = mysqli_query($conn, $renter_rent_query);
          $row = mysqli_fetch_assoc($renter_rent);
          $rentee = $row['renter'];
          if($rentee!=null){
            $been_rented = '<p>Your parking spot, number '.$num.' has been rented out for the day by: <b>'.$rentee.'</b></p>';
          }
        }
        echo '<div id="spot_'.$num.'"><button class="btn btn-primary" onClick="rentOutSpot('.$num.')"'.$disabled.'>Click to rent out spot number '.$num.'</button></div><br>';
        echo $been_rented;
      }
    }
    mysqli_close($conn);
    ?>
      </div>
    </div>
    <?php endif; ?>

</html>
</body>
