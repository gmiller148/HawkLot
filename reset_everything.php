<?php include "/header/header-control.php";
include "dbconnect.php";



if(isset($_SESSION['logon'])){
  if($_SESSION['logon']==3){

      $jsonString = file_get_contents('jocklot.json');
      $data = json_decode($jsonString, true);

      for($i=0; $i < count($data['features']); $i++){
       $data['features'][$i]['properties']['occupied'] = true;
       $data['features'][$i]['properties']['renter'] = '-';
       $data['features'][$i]['properties']['owner'] = '-';
      }

      $reset_parking_query = "DELETE FROM `dailyparking`";
      $reset_parking = mysqli_query($conn,$reset_parking_query);

      $reset_owners_query = "DELETE FROM `owners`";
      $reset_owners = mysqli_query($conn,$reset_owners_query);

      $reset_renters_query = "DELETE FROM `renters`";
      $reset_renters = mysqli_query($conn,$reset_renters_query);


      $newJsonString = json_encode($data);
      file_put_contents('jocklot.json', $newJsonString);
  }else{
    echo "GET OUT I SAY";
  }
}

?>
