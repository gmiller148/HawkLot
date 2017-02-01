<?php
include "header/header-control.php";
if($_SESSION['logon']>=1){
$resp = 0;

$jsonString = file_get_contents('jocklot.json');
$data = json_decode($jsonString, true);

if(isset($_POST['id'])){
  $id = $_POST['id'];
}
if(isset($_POST['value'])){
  $value = $_POST['value'];
  $value = ($value === "true");
}


for($i=0; $i < count($data['features']); $i++){
// $data['features'][$i]['properties']['owner'] = '-'; //if you ever need to reset the entire parking lot to true/false just uncomment this line
  if($data['features'][$i]['properties']['id'] == $id ){
    if(isset($value)){
      $data['features'][$i]['properties']['occupied'] = $value;
    }
    if(isset($_POST['owner'])){
      $data['features'][$i]['properties']['owner'] = $_POST['owner'];
      $resp = 1;
    }
    if(isset($_POST['renter'])){
      $data['features'][$i]['properties']['renter'] = $_POST['renter'];
    }else{
      $data['features'][$i]['properties']['renter'] = "-";
    }
  }
}
    /*if ($feature['id'] == 511) {
        $newJsonString = '{}';*/


$newJsonString = json_encode($data);
file_put_contents('jocklot.json', $newJsonString);

}else{
  echo '<meta http-equiv="refresh" content="0;url=index.php">';
  echo 'Y\'all dern\'t have permission be snoopin\' \'round \'ere. Out with ye!';
}
 ?>
