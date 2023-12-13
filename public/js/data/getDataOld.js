
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

function addLayerFrom(shapeName, map, L, fieldFilter, dataFilter) {
    //utilisation de promise: deferred and revolve
    var dfrd = $.Deferred();

    var myHeaders = new Headers();
    myHeaders.append('Content-Type', 'text/plain; charset=UTF-8');
    //console.log('http://localhost/geop/controller/test.php?shapefile=' + shapeName);
    console.log('http://localhost/geop/controller/test.php?shapefile=' + shapeName + '&fields=[' + fieldFilter + ']&search=[' + dataFilter + ']');

    var fields = fieldFilter != "" ? fieldFilter.split(",") : new Array();
    var data = dataFilter != "" ? dataFilter.split(",") : new Array();
    console.log(fields);
    console.log(data);
    const objectToSend = {
        "shapefile": shapeName,
        "fields": fields,
        "search": data
    }
    console.log(JSON.stringify(
        objectToSend
    ));
    var geoJsonPromise = fetch(
        'http://localhost/geop/controller/test.php', {
        method: "POST",
        body: JSON.stringify(
            objectToSend
        ),
        headers: {                              // ***
            "Content-Type": "application/json"    // ***
        }
    });
    //console.log(geoJsonPromise);
    var SLDPromise = fetch('http://localhost/igbgeo/files/unzip/' + shapeName + '/' + shapeName + '.sld', myHeaders);
    var geojsonLayer = new Map();
    //console.log(geojsonLayer);
    Promise.all([geoJsonPromise, SLDPromise]).then(function (results) {
        console.log(results[0]);
        Promise.all([results[0].json(), results[1].text()])
            .then(function (result) {
                //console.log(result);
                var geoJson = result[0];
                var SLDText = result[1];
                var SLDStyler = new L.SLDStyler(SLDText)
                geojsonLayer = L.geoJson(geoJson, {
                    style: SLDStyler.getStyleFunction()
                }).addTo(map);
                map.fitBounds(geojsonLayer.getBounds());
                //console.log(geojsonLayer);
                dfrd.resolve(geojsonLayer);
            });
    });
    return $.when(dfrd).done(function () { }).promise();
}
