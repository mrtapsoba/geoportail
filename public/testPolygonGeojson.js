var map;

map = L.map('map', {
  center: [-200, 118],
  crs: L.CRS.Simple,
  zoom: 8
});
var mapLink = "https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}";

var baseLayer = L.tileLayer(mapLink, {
  maxZoom: 18,
  attribution: "kndfkjbj",
  id: 'knfjknjbvg',
  tileSize: 512,
  zoomOffset: -1,

}).addTo(map);

L.marker([12.365660, -1.533880])
  .bindLabel('Monro&#39;s studio, 1 Henrietta Street, Covent Garden', { noHide: false })
  .addTo(map);

L.marker([12.365660, -1.533880])
  .bindLabel('The Royal Academy', { noHide: false })
  .addTo(map);

L.marker([12.365660, -1.533880])
  .bindLabel('St Martin&#39;s Workhouse', { noHide: false })
  .addTo(map);


L.marker([12.365660, -1.533880])
  .bindLabel('The Monro family home, 8 Adelphi Terrace', { noHide: false })
  .addTo(map);


var featureGroup = L.featureGroup().addTo(map);

var drawControl = new L.Control.Draw({
  edit: {
    featureGroup: featureGroup
  }
}).addTo(map);

map.on('draw:created', function (e) {

  // Each time a feaute is created, it's added to the over arching feature group
  featureGroup.addLayer(e.layer);
});


// on click, clear all layers
document.getElementById('delete').onclick = function (e) {
  featureGroup.clearLayers();
}

document.getElementById('export').onclick = function (e) {
  // Extract GeoJson from featureGroup
  var data = featureGroup.toGeoJSON();

  // Stringify the GeoJson
  var convertedData = 'text/json;charset=utf-8,' + encodeURIComponent(JSON.stringify(data));

  // Create export
  document.getElementById('export').setAttribute('href', 'data:' + convertedData);
  document.getElementById('export').setAttribute('download', 'data.geojson');
}

// Show coordinates
var div = document.createElement('div');
div.id = 'coordsDiv';
div.style.position = 'absolute';
div.style.bottom = '0';
div.style.left = '0';
div.style.zIndex = '999';
document.getElementById('map').appendChild(div);

map.on('mousemove', function (e) {

  var lat = e.latlng.lat.toFixed(5);
  var lon = e.latlng.lng.toFixed(5);

  document.getElementById('coordsDiv').innerHTML = lat + ', ' + lon;

});

// NEW Polygon GeoJSON feature
var testPolygonGeojson = {
  "type": "FeatureCollection",
  "name": "polygonGeojson",
  //"crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
  "features": [
    {
      "type": "Feature", "properties":
        { "info": "20 Adam Street, Dr John Turton (1735-1806), physician with royal patronage; a leading figure in the Royal College of Physicians and physician-in-ordinary to George III and the Prince of Wales from 1797.  With Garrick (at no. 5) he was the first resident of the Terrace." }, "geometry": {
          "type": "MultiPolygon",
          "coordinates": [[[
            [130, -198.45], [131, -197.75], [132.2, -199.3], [131.15, -200]
          ]]]
        }
    },
    {
      "type": "Feature", "properties":
        { "info": "1 Sir John Mitford (1748-1830), of Lincoln&#39;s Inn and Batsford Park, Gloucestershire. Lawyer and politician, Speaker of the House of Commons 1801 and author on legal and political matters." }, "geometry": {
          "type": "MultiPolygon",
          "coordinates": [[[
            [129.2, -199.1], [130, -198.45,], [131.15, -200], [130.3, -200.65]
          ]]]
        }
    },
    {
      "type": "Feature", "properties":
        { "info": "2 Walter Cleland (1775-1807). Scottish merchant, who had made a fortune in Calcutta." }, "geometry": {
          "type": "MultiPolygon",
          "coordinates": [[[
            [128.4, -199.8], [129.2, -199.1], [130.3, -200.65], [129.5, -201.25]
          ]]]
        }
    },
    {
      "type": "Feature", "properties":
        { "info": "3 William Minier and Charles Minier (d. 1809), seedsmen of The Strand. " }, "geometry": {
          "type": "MultiPolygon",
          "coordinates": [[[
            [127.6, -200.4], [128.4, -199.8], [129.5, -201.25], [128.75, -202]
          ]]]
        }
    },
    {
      "type": "Feature", "properties":
        { "info": "4 Sir Brook Watson (1735-1807), former merchant, commissary-general to the forces of Great Britain, (resident 1798-1807). Previously the house (to 1797) of John Henderson (1764-1843), amateur artist patron of Girtin and Turner (resident 1790-1797), and his wife Georgiana Jane Henderson (1770-1850), artist." }, "geometry": {
          "type": "MultiPolygon",
          "coordinates": [[[
            [126.8, -201], [127.6, -200.4], [128.75, -202], [128.05, -202.5]
          ]]]
        }
    },
    {
      "type": "Feature", "properties":
        { "info": "5. Eva Maria Garrick (n&eacute;e Veigel; 1724-1822), former dancer, and widow of the actor David Garrick. The Garricks had been one of the first residents of the Adelphi, taking up this address in 1773." }, "geometry": {
          "type": "MultiPolygon",
          "coordinates": [[[
            [126.2, -201.5], [126.8, -201], [128.05, -202.5], [127.3, -203.1]
          ]]]
        }
    },
    {
      "type": "Feature", "properties":
        { "info": "6. John Thomas Batt (1746-1831), esq. of New Hall, Wiltshire, barrister" }, "geometry": {
          "type": "MultiPolygon",
          "coordinates": [[[
            [125.5, -202.1], [126.2, -201.5], [127.3, -203.1], [126.6, -203.6]
          ]]]
        }
    },
    {
      "type": "Feature", "properties":
        { "info": "7. John Cator, esq (1728-1806) of Bankside, Southwark and Beckenham, Kent, wealthy timber merchant and politician, East India Company stockholder." }, "geometry": {
          "type": "MultiPolygon",
          "coordinates": [[[
            [124.7, -202.7], [125.5, -202.1], [126.6, -203.6], [125.8, -204.2]
          ]]]
        }
    },
    {
      "type": "Feature", "properties":
        { "info": "9. Sir John William Anderson (1736-1813), bart of Mill Hill, Hendon, Middlesex,  politician and owner of slave factory in Africa" }, "geometry": {
          "type": "MultiPolygon",
          "coordinates": [[[
            [123.2, -203.8], [123.9, -203.3], [125.1, -204.7], [124.3, -205.2]
          ]]]
        }
    },
    {
      "type": "Feature", "properties":
        { "info": "10.  Sir Edward Hyde East, bart (1764-1847), MP, judge and writer on law" }, "geometry": {
          "type": "MultiPolygon",
          "coordinates": [[[
            [122.2, -205.2], [123.5, -204.1], [124.3, -205.2], [123.2, -206.3]
          ]]]
        }
    }
  ]
}



// New layer
var newPolygons = L.geoJson(null);

var style = {
  color: '#37bd37',
  fillColor: '#37bd37',
  opacity: 1,
  weight: 1
}


newPolygons = new L.geoJson(testPolygonGeojson, {
  style,

  onEachFeature: function (feature, layer) {
    layer.on({
      // click: zoomToClickedPolygon,
      mouseover: highlightFeatureOnMouseOver,
      mouseout: resetFeatureStyle
    });
    layer.bindPopup(
      feature.properties.info
    );
  }
}).addTo(map);

function highlightFeatureOnMouseOver(e) {
  e.target.setStyle({
    color: '#37bd37',
    fillColor: '#ffffff',
    opacity: 1,
    //fillOpacity: 0,
    weight: 4
  });

  e.target.bringToFront();
  //e.target.openPopup();
}

function resetFeatureStyle(e) {
  //newPolygons.resetStyle(e.target);
  newPolygons.setStyle({
    color: '#37bd37',
    fillColor: '#37bd37',
    opacity: 1,
    weight: 1
  });
}

function zoomToClickedPolygon(e) {
  var bounds = e.target.getBounds();
  map.fitBounds(bounds);
}

// To set the map view according to a bounding box instead of a center point and zoom level, you can use the fitBounds method
map.fitBounds(newPolygons);

// It dosen't work on copeden!
//map.fitBounds([[-192,72],[-207, 60]]);