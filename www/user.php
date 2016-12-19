<?php
  include "header/header-control.php";
  if($_SESSION['logon']<1) {
    header("refresh:0; url=index.php");
    echo "USER IS NOT LOGGED ON";
    session_destroy();
    exit;
  }
?>

<html>
<head>
  <?php
  if($_SESSION['logon']==1 || $_SESSION['logon']==3) {
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

    button.close{
        float:right;
        margin-top:-5px;
        margin-right:-5px;
        cursor:pointer;
        color: #605F61;
        padding-left: 7px;
        padding-top: 0px;
        opacity: .4;
    }


  </style>
</head>
<body>
  <?php if($_SESSION['logon']==1 || $_SESSION['logon']==3) : ?>
  <?php if($_SESSION['logon']==1 || $_SESSION['logon']==3) {
      include "/header/header-body.php";
    }
    ?>
    <div id="map"></div>
    <div class="simple_overlay" id="test1" style="display:none;background:white;padding:20px;width:70%">
    <br>
    <form class="form-container">
        <div class="form-title">
             <h2>Exciting, no?</h2>

        </div>
        <div class="form-title">Title</div>
        <input id="title" class="form-field" type="text" name="title" />
        <br />
        <div class="form-title">Latitude</div>
        <input id="latitude" class="form-field" type="text" name="latitude" />
        <br />
        <div class="form-title">Longitude</div>
        <input id="longitude" class="form-field" type="text" name="longitude" />
        <br />
        <div class="submit-container">
            <input class="submit-button" type="submit" value="Submit" />
        </div>
    </form>
  <script>
  var map = L.map('map', {
    minZoom: 0,
    maxZoom: 4,
    center: [0, 0],
    zoom: 1,
    crs: L.CRS.Simple
  });

  var w = 4096,
    h = 4096;

  var southWest = map.unproject([0, h], map.getMaxZoom());
  var northEast = map.unproject([w, 0], map.getMaxZoom());
  var bounds = new L.LatLngBounds(southWest, northEast);

  map.setMaxBounds(bounds);
  L.tileLayer('/Jock_Lot/{z}/{x}/{y}.png').addTo(map);

  var clickListner = false; //true when a spot is selected AND the popup is on its default screen (this value allows/disallows the per-second update of the popup menu)
  var clickLocation = 000; //spot_number selected
  var occupiedAddition = ' ';
  var rentMeButton = '';
  var allow_clicks = true;

  var userReq = new XMLHttpRequest();
  var username_start = "";
  userReq.onload = function() {
    var user_information = this.responseText.split(",");
    username_start = user_information[1];
  }
  userReq.open("get", "get_user_info.php", true);
  userReq.send();
  var spot_rented = false;


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

  function rentSpot(id,value){
    var name = '',
        money = '',
        owner = '',
        response = '',
        spot_info = '';
        username = '';
    /*alert('Spot number ' + id.toString() + ' is now ' + (!value).toString());
    var val = !value; //when changing true->false, val will be false, and will be true when false->true
    $.post("json_edit.php",{id: id, value: val});
      return false;*/
    var userReq = new XMLHttpRequest();
    userReq.onload = function() {
      user_info = this.responseText.split(",");
      name = user_info[0];
      money = user_info[2];
      username = user_info[1];
      var spotReq = new XMLHttpRequest();
      spotReq.onload = function(){
        spot_info = this.responseText.split(",");
        owner = spot_info[0];
        response = '<p>Hello user ' + name + '.</p><p>You have $' + money + '</p><p>This spot is owned by ' + owner;
        response += '<div align="center"><button class="btn btn-primary" onClick="rentConfirm(' + id + ',\'' + username + '\',\'' + money + '\',\'' + owner + '\')">Confirm Rental</button></div></form>';
        response += '<a href="#" id="activator">test</a>';
        spotInfo.update(null,response);
      };
      spotReq.open("get","get_spot_info?id="+id, true);
      spotReq.send();
    };
    userReq.open("get", "get_user_info.php?id="+id, true);
    userReq.send();
    clickListner = false;
//    lockMap();
//    allow_clicks = false;
  }

  function rentConfirm(id, username, money, owner){
    var transReq = new XMLHttpRequest();
    var transData = new FormData();
    transData.append('spot_id', id);
    transData.append('renter', username);
    transData.append('money', money);
    transData.append('owner', owner);
    transReq.onload = function(){
      spotInfo.update(null,'');
      $.post("json_edit.php",{id: id, value: true, renter: username});
      return false;
    };
    transReq.open("post","rental_transaction.php", true);
    transReq.send(transData);
  }

  /*var divIcon = L.divIcon({
    html: "test"
  });
  L.marker(new L.LatLng(0, 0), {icon: divIcon });
  */
  var spotInfo = L.control();


  spotInfo.onAdd = function (map) {
  	this._div = L.DomUtil.create('div', 'spotInfo');
  	this.update();
  	return this._div;
  };

  spotInfo.update = function (properties,addon) {
    occupiedAddition = ' ';
    rentMeButton = '';
    if (typeof properties !== 'undefined' && properties !== null && properties!='' && !properties.occupied) {
      occupiedAddition = 'not ';
      if(!spot_rented){
        rentMeButton = '<div align="center"><button class="btn btn-primary" id="rentMe" onclick="rentSpot('+properties.id+')">Rent Me</button></div>';
      }else{
        rentMeButton = '<div id="disabled_Renting" align="center">You\'ve already rented a spot!</div><div align="center"><button class="btn btn-primary" id="rentMe" onclick="rentSpot('+properties.id+')" disabled>Rent Me</button></div>';
      }
      //  rentMeButton = '<div class="login-fail text-center">You have already rented a spot!</div>'
    }
  	this._div.innerHTML = (properties ?
  		'<h4>This is parking spot number ' + properties.id + '<button class="close" onClick="closePopup()">X</button></h4>' +
      '<p>The spot is ' + occupiedAddition + 'occupied.<br>' + rentMeButton
  		: '') + (addon ? addon : '');
  };

  spotInfo.addTo(map);
  //spotInfo.setPosition('verticalcenterright');

  function closePopup(){
    var blank = '';
    clickListner = false;
    spotInfo.update(blank);
  }

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
    if(allow_clicks){
      var layer = e.target;
      clickLocation = layer.feature.properties.id;
      map.fitBounds(e.target.getBounds());
      clickListner = true;
    }
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
    switch(feature.properties.renter==username_start){
    case false:
      switch (feature.properties.occupied) {
        case true: return {color: "#ff0000", weight: 2};
        case false: return {color: "#27e833", weight: 2};
      }
    break;
    case true:
      spot_rented = true;
      return {color: "#0000ff", weight: 2};
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
