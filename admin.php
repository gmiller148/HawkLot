<?php
  session_start();
  if($_SESSION['logon']<3) {
    header("refresh:0; url=index.php");
    echo "USER IS NOT LOGGED ON";
    session_destroy();
    exit;
  }
?>
<?php if($_SESSION['logon']==3) {
  include "header.php";
  }
?>
<html>
<head>
  <title>Admin Page</title>
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css" />
   <script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
   <style>
   #mapid {
     width: 100%; height: 100%;
   }
   #bottom_navbar{
     background-color: white;
   }
   body{
    background: none;
    padding-top: 45px;
    padding-right: 0px;
    padding-bottom: 45px;
    padding-left: 0px;
   }
   </style>
</head>
<body>

<?php if($_SESSION['logon']>=3) : ?>
  <ul class="nav nav-tabs navbar-fixed-bottom" id="bottom_navbar">
  <li><a href="">Jock Lot</a></li>
  <li><a href="">A Wing Lot</a></li>
  <li><a href="">PA Wing Lot</a></li>
</ul>
<div id="mapid"></div>
<script>
	var mymap = L.map('mapid').setView([41.9969199, -87.8266514], 15);
	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw', {
		maxZoom: 19,
		attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
			'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="http://mapbox.com">Mapbox</a>',
		id: 'mapbox.streets'
	}).addTo(mymap);
  var marker = L.marker([41.9969199, -87.8266514]).addTo(mymap);
  marker.bindPopup("<b>Hello there!</b><br>This is my house.").openPopup();
</script>


<?php endif; ?>

</body>
</html>
