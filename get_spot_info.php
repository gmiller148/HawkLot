<?php
include "/header/header-control.php";
$jsonString = file_get_contents('jocklot.json');
$json_data = json_decode($jsonString, true);
$id = intval($_GET['id'])-511;
$owner = $json_data['features'][$id]['properties']['owner'];
$renter = $json_data['features'][$id]['properties']['renter'];


$data = $owner.','.$renter;
echo $data;
?>
