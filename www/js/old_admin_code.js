var square_coords = [[0,0],
                     [0,0],
                     [0,0],
                     [0,0]
                    ];
var spaces = [];
var popups = [];
var row_index = 1;
var row_change_type = 0; //0 means no change, 1 means skipping a row, 2 means working within a double down_row, 3 within a double up_row
var up_or_down = 1; //1 means you're in a down row, -1 means up row
var alteration = [0, 30, -2.75, 27.75 ];
var row = 1;
var spot_num = 511;
var spot;


function zoomToFeature(e) {
		map.fitBounds(e.target.getBounds());
}

function zoomOutFeature(e){
  map.fitBounds(bounds);
}

function popupContenttoIndex(content){
  word_list = content.split(" ");
  // indecies 0-10 normal, 11-21 opposite, 22-32 normal, 33-43 opposite, 44-54 normal
  var unaltered_index = parseInt(word_list[word_list.length - 1]) - 511;
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
  var spot_index = popupContenttoIndex(feature.properties.popupContent);
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

for(c = 43; row < 6; c+=33.5,row+=1)
{
  for(s = -10.25 + up_or_down * alteration[row_change_type]; row_index < 12; s -= 15.1,row_index += 1){
    spot = {
        "type": "Feature",
        "properties": {
            "occupied": false,
            "popupContent": "This is spot number " + spot_num.toString()
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
        "id": row_index
    };
    spaces.push(spot);
    parking_spots_layer.addData(spot);
    switch (row%2) {
      case 0:
        spot_num -= 1;
        break;
      case 1:
        spot_num += 1;
        break;
    }
  }
  row_index = 1;
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
      spot_num += 10;
      break;
      case 0:
        row_change_type = 1;
        if(row%4==0){
          row_change_type = 0;
        }
        up_or_down *= -1;
        c+= 20.8;
        spot_num += 12;
        break;
    }
}
