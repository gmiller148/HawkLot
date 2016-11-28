<html>
<head>
  <title>Test Realtime</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css">
  <script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
  <script src="js/realtime.js"></script>
  <style>
  #map {
    width: 100%; height: 100%;
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
L.tileLayer('/Jock_Lot_Map/{z}/{x}/{y}.png').addTo(map);

var spaces = [];
var popups = [];
var row_index = 1;
var row_change_type = 0; //0 means no change, 1 means skipping a row, 2 means working within a double down_row, 3 within a double up_row
var up_or_down = 1; //1 means you're in a down row, -1 means up row
var alteration = [0, 30, -2.75, 27.75 ];
var row = 1;
var spot_num = 511;

function edit_mePOPUP(spot_index){
  occupancy_status = spaces[spot_index].properties.occupied;
  popups[spot_index].setContent('<button class="btn btn-primary" onclick="setOccupancyStatus(' + spot_index + ')">Set me to ' + !occupancy_status + '</button>');
}

function setOccupancyStatus(spot_index){
  spaces[spot_index].properties.occupied = !spaces[spot_index].properties.occupied;
  alert(spaces[spot_index].properties.popupContent + ' and its occupancy status is now ' + spaces[spot_index].properties.occupied);

  //set it in SQL database...
}

function zoomToFeature(e) {
		map.fitBounds(e.target.getBounds());
}

function zoomOutFeature(e){
  map.fitBounds(bounds);
}

function popupContenttoIndex(unaltered_index){
  // indecies 0-10 normal, 11-21 opposite, 22-32 normal, 33-43 opposite, 44-54 normal
  var altered_index = -1;
  var test = [];
  if( (unaltered_index > 10 && unaltered_index < 22) || (unaltered_index > 32 && unaltered_index < 44) ){
    var set = Math.floor(unaltered_index / 11);
    var spots_row = [];
    for(i = 11*set; i< 11*(set+1); i +=1 ){
      spots_row.push(i);
    }
    unaltered_index_Found = spots_row.indexOf(unaltered_index);
    spots_row.reverse();
    altered_index = spots_row[unaltered_index_Found];
  }else{
    altered_index = unaltered_index;
  }
  return altered_index;
}

function onEachFeature(feature, layer) {
  var popupContent = "";
  var occupied_or_not = "";
  var spot_index = popupContenttoIndex(feature.properties.id);
  var edit_me_button = '<p><button class="btn btn-primary" onclick="edit_mePOPUP(' + spot_index + ')">Edit Me</button></p>';
  layer.on({
  			click: zoomToFeature,
  		});
  if(feature.properties.occupied==false){
    occupied_or_not = "not ";
  }
  if (feature.properties && feature.properties.popupContent) {
    popupContent += "<p>" + feature.properties.popupContent + "</p>";
  }
  popupContent += "<p>This parking spot is " + occupied_or_not + "occupied</p>" + edit_me_button;

  var popup = L.popup({
    keepInView: true,
    minWidth: 200
  }).setLatLng([1000,0]).setContent(popupContent);
  popups.push(popup);
  layer.bindPopup(popup);
}

function style(feature) {
  switch (feature.properties.occupied) {
     case true: return {color: "#ff0000"};
     case false:   return {color: "#0000ff"};
   }
}

parking_spots_layer = L.geoJSON(false, {
  style: style,
  onEachFeature: onEachFeature
}).addTo(map);

var spot = {
    "type": "Feature",
    "properties": {
        "occupied": false,
        "popupContent": "This is spot number " + spot_num.toString()
    },
    "geometry": {
        "type": "Polygon",
        "coordinates": [[
            [43, -10.5],
            [30.5, -10.5 + -16],
            [43+ 30.5, -10.5 + -27.75],
            [43, -10.5 + -11.5],
            [43, -10.5]
        ]]
    },
    id: 1
};
realtime = L.realtime({
        url: 'test.json',
        crossOrigin: true,
        type: 'json'
    }, {
        interval: 1 * 1000,
        style: style,
        onEachFeature: onEachFeature
}).addTo(map);

realtime.on('update', function(e) {
  /*var popupContent = "";
  var occupied_or_not = "";
  var spot_index = popupContenttoIndex(feature.properties.id);
  var edit_me_button = '<p><button class="btn btn-primary" onclick="edit_mePOPUP(' + spot_index + ')">Edit Me</button></p>';

  if(feature.properties.occupied==false){
    occupied_or_not = "not ";
  }
  if (feature.properties && feature.properties.popupContent) {
    popupContent += "<p>" + feature.properties.popupContent + "</p>";
  }
  popupContent += "<p>This parking spot is " + occupied_or_not + "occupied</p>" + edit_me_button;

  var popup = L.popup({
    keepInView: true,
    minWidth: 200
  }).setContent(popupContent);
  layer.bindPopup(popup);*/ 
});

</script>


</body>
</html>
