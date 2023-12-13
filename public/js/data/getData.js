
console.log("ajaxing");

async function getText(link) {
    $.ajax({
        url: link, // on passe l'id le plus récent au fichier de chargement
        type: "GET",
        success: function (html) {
            console.log("data get -- " + html);
            return html;
        },
        error: function (e) {
            console.error("erreur " + e);
            return null;
        }
    });
}
parseMyString("156161561Bonjour0");
function parseMyString(myString) {
    var arrayFromString = myString.split("");
    var finalString = "";
    const tabNumber = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    while (tabNumber.includes(arrayFromString[0])) arrayFromString.shift();

    while (arrayFromString.length > 0) finalString += arrayFromString.shift();
    return finalString;
}

function addLayerFrom(shapeName, map, L, calqueName) {
    //utilisation de promise: deferred and revolve
    var dfrd = $.Deferred();
    //console.log(shapeName);
    var myHeaders = new Headers();
    myHeaders.append('Content-Type', 'text/plain; charset=UTF-8');
    //console.log('http://localhost/geop/controller/test.php?shapefile=' + shapeName);
    //console.log('http://localhost/geop/controller/test.php?shapefile=' + shapeName);

    const objectToSend = {
        "shapefile": shapeName
    }
    //console.log(JSON.stringify(objectToSend));
    //old link : 'http://localhost/taps/geop/controller/test.php'
    //var dataLink = "http://127.0.0.1/taps/geop/"
    var dataLink = "192.168.43.106:8000/"
    var geoJsonPromise = fetch(
        'geoportail/getData/', {
        method: "POST",
        body: JSON.stringify(
            objectToSend
        ),
        headers: {                              // ***
            "Content-Type": "application/json",    // ***
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    //console.log(geoJsonPromise);
    var SLDPromise = fetch('files/shapefiles/' + shapeName + '/' + parseMyString(shapeName) + '.sld', myHeaders);
    var geojsonLayer = new Map();
    //console.log(geojsonLayer);
    Promise.all([geoJsonPromise, SLDPromise]).then(function (results) {
        //console.log(results[0]);
        Promise.all([results[0].json(), results[1].text()])
            .then(function (result) {
                //console.log(result);
                var geoJson = result[0];
                var SLDText = result[1];
                var SLDStyler = new L.SLDStyler(SLDText);
                //console.log();
                //console.log(SLDStyler);
                //console.log(SLDStyler['featureTypeStyles'][0][0]['symbolizer']);
                //console.log(SLDStyler.getStyleFunction());
                var fA = SLDStyler['featureTypeStyles'];
                var sA;
                var dt;
                var geocl = geoJson["features"][0]["geometry"]["type"];
                console.log(geocl);
                for (var i = 0; i < fA.length; i++) {
                    sA = fA[i];
                    for (var i = 0; i < sA.length; i++) {
                        var dtName = sA[i]['filter']['comparisions'];
                        var dtAllValue = sA[i]['symbolizer'];
                        console.log(sA);
                        if (dtName[0] != undefined) {
                            var layerLoader = "<div class='legend-block " + shapeName + "'>";

                            layerLoader += "<div class='" + geocl + "' style='border: " + dtAllValue['strokeWidth'] + "px " + dtAllValue['strokeDashstyle'] + " " + dtAllValue['color'] + "; background-color:" + dtAllValue['fillColor'] + "'></div><span>" + dtName[0]['literal'] + "</span>";

                            layerLoader += "</div>";
                            //console.log(layerLoader);
                            $("#legends").prepend(layerLoader);
                            $("#barLegend").prepend(layerLoader);

                            console.log(dtName[0]['literal'] + " <==> " + dtAllValue['color']);
                        }
                        else if (i == 0) {
                            var layerLoader = "<div class='legend-block " + shapeName + "'>";

                            layerLoader += "<div class='" + geocl + "' style='border: " + dtAllValue['strokeWidth'] + "px " + dtAllValue['strokeDashstyle'] + " " + dtAllValue['color'] + "; background-color:" + dtAllValue['fillColor'] + "'></div><span>" + calqueName + "</span>";

                            layerLoader += "</div>";
                            //console.log(layerLoader);
                            $("#legends").prepend(layerLoader);
                            $("#barLegend").prepend(layerLoader);

                            console.log("||==> " + dtAllValue['color']);
                        }
                    }
                }
                geojsonLayer = L.geoJson(geoJson, {
                    style: SLDStyler.getStyleFunction(),

                    onEachFeature: function (feature, layer) {

                        var popupContent = "";

                        for (const [key, value] of Object.entries(feature.properties)) {
                            popupContent += key + ": <b>" + value + "</b><br>";
                        }
                        layer.bindPopup(popupContent);

                    },
                });

                if (geocl == "Point") {
                    var geoscl = L.markerClusterGroup();
                    geoscl.addLayer(geojsonLayer);
                    map.addLayer(geoscl);
                } else {
                    geojsonLayer.addTo(map);
                }

                map.fitBounds(geojsonLayer.getBounds());
                //console.log(geojsonLayer);
                dfrd.resolve(geojsonLayer);
            }).catch((error) => {
                console.log(error);
                dfrd.resolve("notc");
            });
    }).catch((error) => {
        console.log(error);
        dfrd.resolve("notc2");
    });
    return $.when(dfrd).done(function () { }).promise();
}
