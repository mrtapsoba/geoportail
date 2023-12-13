<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.rawgit.com/Leaflet/Leaflet.label/0.8/dist/leaflet.label.css" />
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://rawgit.com/mejackreed/Leaflet-IIIF/master/leaflet-iiif.js"></script>
    <script src="https://cdn.rawgit.com/Leaflet/Leaflet.label/0.8/dist/leaflet.label.js"></script>

    <!--Add draw plugin -->
    <link rel='stylesheet' href='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-draw/v0.2.2/leaflet.draw.css' />
    <script src='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-draw/v0.2.2/leaflet.draw.js'></script>

    <!-- leaflet-ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.1.0/leaflet.ajax.js"></script>

    <!--Loading the new geojson-->
</head>

<body>
    <div id='map'></div>
    <div id='delete'>Delete Features</div>
    <a href='#' id='export'>Export Features</a>

    <script src="testPolygonGeojson.js"></script>

</body>

</html>
