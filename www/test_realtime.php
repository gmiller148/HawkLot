<html>
<head>
  <title>Test Realtime</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css">
  <script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
  <script src="js/realtime.js"></script>
  <script src="/jquery/dist/jquery.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <style>
  #map {
    width: 100%; height: 100%;
  }

  .leaflet-verticalcenter {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      padding-top: 10px;
  }

  .leaflet-verticalcenter .leaflet-control {
      margin-bottom: 10px;
  }

  .spotInfo {
    padding: 6px 8px;
    font: 14px/16px Arial, Helvetica, sans-serif;
    background: white; background: rgba(255,255,255,0.8);
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    border-radius: 5px;
  }
  .spotInfo h4 {
     margin: 0 0 5px;
     color: #777;
   }

  </style>
</head>
<body>
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
L.tileLayer('/Jock_Lot_Map/{z}/{x}/{y}.png').addTo(map).bringToBack();

var clickListner = false;
var clickLocation = 000;

function addControlPlaceholders(map) {
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

function changeStatus(id,value){
  alert('Spot number ' + id.toString() + ' is now ' + (!value).toString());
  var val = !value; //when changing true->false, val will be false, and will be true when false->true
  $.post("json_edit.php",{id: id, value: val});
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
	this._div.innerHTML = (properties ?
		'<h4>This is parking spot number ' + properties.id + '.</h4>' +
    'Current occupation status is ' + properties.occupied + '<br><button onclick="changeStatus('+ properties.id + ',' + properties.occupied + ')">Set me to ' + (!properties.occupied).toString() + '</button>'
		: '') + (addon ? addon : '');
};

spotInfo.addTo(map);
//spotInfo.setPosition('verticalcenterright');

function lockMap(){
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
}

function spotselectHandler(e) {
  var layer = e.target;
  clickLocation = layer.feature.properties.id;
  map.fitBounds(e.target.getBounds());
  clickListner = true;
//lockMap();

  if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
  	layer.bringToFront();
  }
  spotInfo.update(layer.feature.properties);
}

function onEachFeature(feature, layer) {
  layer.on({
    click: spotselectHandler
  });
}

function style(feature) {
  switch (feature.properties.occupied) {
    case true: return {color: "#ff0000"};
    case false:   return {color: "#0000ff"};
  }
}

var popupContent;
var realtime = L.realtime({
        url: 'test.json',
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
</body>
</html>
