<?php
  include "header/header-control.php";
  if($_SESSION['logon']<3) {
    header("refresh:0; url=index.php");
    echo "USER IS NOT LOGGED ON";
    session_destroy();
    exit;
  }
?>
<html>
<head>
  <title>Admin Page</title>
  <?php if($_SESSION['logon']>=3) {
    include "/header/header-head.php";
    }
    ?>
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css"></link>
   <script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
   <script src="js/realtime.js"></script>
   <link rel="stylesheet" href="/style/admin.css"></link>
   <style>
   .spotInfo {
     padding: 6px 8px;
     font: 14px/16px Arial, Helvetica, sans-serif;
     background: white; background: rgba(255,255,255,1);
     box-shadow: 0 0 15px rgba(0,0,0,0.2);
     border-radius: 5px;
   }
   .spotInfo h4 {
      margin: 0 0 5px;
      color: #777;
    }
    .spotInfo p {
       margin: 0 0 4px;
     }
   </style>
</head>
<body>
<?php if($_SESSION['logon']>=3) : ?>
  <?php if($_SESSION['logon']>=3) {
    include "/header/header-body.php";
    }
  ?>

<div class="custom-popup" id="map"></div>
<script>
var map = L.map('map', {
  minZoom: 0,
  maxZoom: 4,
  center: [0, 0],
  zoom: 1,
  crs: L.CRS.Simple
});

var w = 4096,
  h = 3584;

var southWest = map.unproject([0, h], map.getMaxZoom());
var northEast = map.unproject([w, 0], map.getMaxZoom());
var bounds = new L.LatLngBounds(southWest, northEast);

map.setMaxBounds(bounds);
L.tileLayer('Jock_Lot/{z}/{x}/{y}.png').addTo(map);

var clickListner = false;
var clickLocation = 000;

/*function addControlPlaceholders(map) {
  var corners = map._controlCorners,
    l = 'leaflet-',
    container = map._controlContainer;

  function createCorner(vSide, hSide) {
    var className = l + vSide + ' ' + l + hSide;
    corners[vSide + hSide] = L.DomUtil.create('div', className, container);
  }
    createCorner('verticalcenter', 'right');
}
addControlPlaceholders(map);
*/

function changeStatus(id,value){
  $.post("reset_parking.php",{spot_num_reset: id});
  alert('completed');
  return false;
}

var divIcon = L.divIcon({
  html: "textToDisplay"
});
L.marker(new L.LatLng(0, 0), {icon: divIcon });

var spotInfo = L.control();

spotInfo.onAdd = function (map) {
	this._div = L.DomUtil.create('div', 'spotInfo');
	this.update();
	return this._div;
};

spotInfo.update = function (properties,addon) {
  if (typeof properties !== 'undefined' && properties !== null && properties!=''){
    switch(properties.occupied){
      case true:
        switch(properties.renter=='-'){
          case true:
            var occupation_status = 'not available';
          break;
          case false:
            var occupation_status = 'rented';
          break;
        }
      break;
      case false:
        var occupation_status = 'available';
      break;
    }
  }
	this._div.innerHTML = (properties ?
		'<h4>This is parking spot number ' + properties.id + '.</h4>' +
    '<p>Current occupation status: <b>' + occupation_status + '</b>.<br>Owner: '+properties.owner+'<br>Renter: '+properties.renter + '</p><div align="center"><button class="btn btn-primary" onclick="changeStatus('+ properties.id + ',' + properties.occupied + ')">Reset this parking space</button></div>'
		: '') + (addon ? addon : '');
};

spotInfo.addTo(map);
//spotInfo.setPosition('verticalcenterright');

/*function lockMap(){
  map.zoomControl.disable();
  map._handlers.forEach(function(handler) {
    handler.disable();
  });
  document.getElementById('map').style.cursor='default';
}
function unlockMap(){
  map.zoomControl.enable();
  map._handlers.forEach(function(handler) {
    handler.enable();
  });
  if (map.tap) map.tap.enable();
  document.getElementById('map').style.cursor='grab';
}*/

function spotselectHandler(e) {
  var layer = e.target;
  clickLocation = layer.feature.properties.id;
  map.fitBounds(e.target.getBounds());
  clickListner = true;
//lockMap();

/*  if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
  	layer.bringToFront();
  }*/
  spotInfo.update(layer.feature.properties);
}

function onEachFeature(feature, layer) {
  layer.on({
    click: spotselectHandler
  });
}

function style(feature) {
  switch (feature.properties.renter == '-') {
    case true:
      switch(feature.properties.occupied){
        case true:
        return {color: "#ff0000", weight: 2};
        case false:
        return {color: "#27e833", weight: 2};
      }
     break;
    case false:
      switch(feature.properties.occupied){
        case true:
        return {color: "#0000ff", weight: 2};
        case false:
        return {color: "#27e833", weight: 2};
      }
    break;
  }
}

var popupContent;
var realtime = L.realtime({
        url: 'jocklot.json',
        crossOrigin: true,
        type: 'json'
    }, {
        interval: 1 * 1000,
        onEachFeature: onEachFeature,
        style: style
    }).addTo(map);

realtime.on('update', function(e) {
  if(clickListner){
    var feature = e.features[clickLocation];
    spotInfo.update(feature.properties);
  }

});

</script>

<?php endif; ?>

</body>
</html>
