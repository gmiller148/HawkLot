<?php include "/header/header-control.php";
include "dbconnect.php";



if(isset($_SESSION['logon'])){
  if($_SESSION['logon']==3){
    if(isset($_POST['spot_num_reset'])){
      $resp = -1;
      $num = $_POST['spot_num_reset'];
      $jsonString = file_get_contents('jocklot.json');
      $data = json_decode($jsonString, true);

      for($i=0; $i < count($data['features']); $i++){
        if($data['features'][$i]['properties']['id']==$num){
          $data['features'][$i]['properties']['occupied'] = true;
          $data['features'][$i]['properties']['renter'] = '-';
          $resp = 1;
        }
      }
      $reset_parking_query = "DELETE FROM dailyparking WHERE spot_number='$num'";
      $reset_parking = mysqli_query($conn,$reset_parking_query);

      $newJsonString = json_encode($data);
      file_put_contents('jocklot.json', $newJsonString);
    }else{
      $jsonString = file_get_contents('jocklot.json');
      $data = json_decode($jsonString, true);

      for($i=0; $i < count($data['features']); $i++){
       $data['features'][$i]['properties']['occupied'] = true;
       $data['features'][$i]['properties']['renter'] = '-';
       //$data['features'][$i]['properties']['owner'] = '-';
      }

      $reset_parking_query = "DELETE FROM `dailyparking`";
      $reset_parking = mysqli_query($conn,$reset_parking_query);

      $newJsonString = json_encode($data);
      file_put_contents('jocklot.json', $newJsonString);
    }
  }else{
    echo "GET OUT I SAY";
  }
}

?>
