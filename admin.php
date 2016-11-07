<?php
  session_start();
  if($_SESSION['logon']<3) {
    header("refresh:0; url=index.php");
    echo "USER IS NOT LOGGED ON";
    session_destroy();
    exit;
  }
  if($_SESSION['logon']==3) {
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

var map = L.map('mapid', {
minZoom: 1,
maxZoom: 4,
center: [0, 0],
zoom: 0,
crs: L.CRS.Simple
});

var w = 4096,
  h = 3584,
  url = 'Test.png';

var southWest = map.unproject([0, h], map.getMaxZoom());
var northEast = map.unproject([w, 0], map.getMaxZoom());
var bounds = new L.LatLngBounds(southWest, northEast);
map.setMaxBounds(bounds);
L.tileLayer('/Jock_Lot_Map/{z}/{x}/{y}.png').addTo(map);

var square_coords = [ [0,0],
                    [0,0],
                    [0,0],
                    [0,0]
                    ];
var spaces = [];
var index = 1;
var row_change_type = 0; //0 means no change, 1 means skipping a row, 2 means working within a double down_row, 3 within a double up_row
var up_or_down = 1; //1 means you're in a down row, -1 means up row
var alteration = [0, 30, -3, 27.75 ];
var row = 1;
var spot_num = 1;

for(c = 43; row < 6; c=c+33.5)
{
  for(s = -10.25 + up_or_down * alteration[row_change_type]; spot_num < 12; s = s-15.1)
  {
    var spot = {
        "type": "Feature",
        "properties": {
            "occupied": "False",
            "popupContent": "This is a dank spot"
        },
        "geometry": {
            "type": "Polygon",
            "coordinates": [[
                [c, s],
                [c+ 30.5, s + (up_or_down * -16)],
                [c+ 30.5, s + (up_or_down * -27.75)],
                [c, s + (up_or_down * -11.5)],
                [c, s]
            ]]
        },
        "id": index
    };

    spaces.push(spot);

    L.geoJSON(spot, {
        style: function(feature) {
            switch (feature.properties.occupied) {
                case 'True': return {color: "#ff0000"};
                case 'False':   return {color: "#0000ff"};
            }
        }
    }).addTo(map);

    spot_num += 1;
  }
  spot_num = 1;
    switch(row%2){
      case 1:
        switch(up_or_down){
          case 1:
            row_change_type = 2;
            break;
          case -1:
            row_change_type = 3;
          break;
        }
      break;
      case 0:
        row_change_type = 1;
        up_or_down *= -1;
        c+= 20.8;
      break;
    }
    row = row + 1;
}

function onMapClick(e) {
    alert("You clicked the map at " + e.latlng);
}

map.on('click', onMapClick);


</script>
<?php endif; ?>

</body>
</html>
