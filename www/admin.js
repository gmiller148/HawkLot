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
    '<p>Current occupation status is ' + properties.occupied + '<br>Owner: <br>Renter:</p><div align="center"><button class="btn btn-primary" onclick="changeStatus('+ properties.id + ',' + properties.occupied + ')">Set me to ' + (!properties.occupied).toString() + '</button></div>'
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
  switch (feature.properties.occupied) {
    case true: return {color: "#ff0000"};
    case false:   return {color: "#0000ff"};
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
