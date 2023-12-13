@extends('layouts.allFrameClient')


@section('headLinks')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/css/contribution.css">
    <link rel="stylesheet" href="/css/contribcouche.css">

    <link rel="stylesheet" href="/css/ionicons.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="{{ asset('contrib/leaflet.css') }} " />
    <link href="{{ asset('contrib/leaflet.fullscreen.css') }} " rel='stylesheet' />

    <style>
        .leaflet-control-zoom-in {
            color: green !important;
        }

        .leaflet-control-zoom-out {
            color: orange !important;
        }

        .leaflet-popup-content-wrapper,
        .leaflet-popup-tip {
            border-radius: 0;
            background: white;
            color: #333;
            box-shadow: 0 3px 14px rgb(0 0 0 / 40%);
            opacity: 0.8;
            padding: 12px
        }

        .leaflet-popup-content {
            margin: 5px;
        }

        .leaflet-popup-tip {
            background: red !important;
        }

        .leaflet-popup-close-button {
            display: nopne;
        }

        .page-content {
            height: 80%;
            width: 100%;
            margin-top: 50px;
            display: flex;
            overflow: hidden;
        }

        #map {
            width: 100%;
            clear: both;
        }

        #delete,
        #export2 {
            position: absolute;
            top: 50px;
            right: 10px;
            z-index: 999;
            background: white;
            color: black;
            padding: 6px;
            border-radius: 4px;
            font-family: 'Helvetica Neue';
            cursor: pointer;
            font-size: 12px;
            text-decoration: none;
        }

        #export2 {
            top: 90px;
        }
    </style>
    <script src="{{ asset('/contrib/leaflet.js') }}"></script>


    <!--Add draw plugin -->
    <link rel='stylesheet' href='/contrib/leaflet.draw.css' />
    <script src='{{ asset('/contrib/leaflet.draw.js') }}'></script>

    <!-- leaflet-ajax -->
    <script src="{{ asset('/contrib/leaflet.ajax.js') }}"></script>
    @livewireStyles
@endsection

@section('contribution')
    class="active"
@endsection
@section('contributionPhone')
    class="active"
@endsection

@section('sectiontitle')
    Indiquez la position
@endsection

@section('content')
    <div id='map'>
        <div id='delete'>Effacer</div>
        <a href='#' id='export2' data-toggle="modal" data-target="#addForm">Enregistrer</a>
    </div>


    <div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="text-center mb-3">Ajout d'une couche</h3>
                    <div class="divide-bar"></div>
                    <form action="#" class="signup-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <input type="hidden" id="coucheId" value="{{ $coucheId }}">
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" id="objet" class="form-control" placeholder="Objet de la contribution">
                        </div>
                        <div class="form-group mb-2">
                            <textarea id="desc" class="form-control" id="" cols="30" rows="5" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group mt-3 mb-2">
                            <button type="submit" id="saveForm"
                                class="form-control submit-btn btn rounded submit px-3">ENVOYER</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="processing" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    ...
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @livewireScripts
    <script src="{{ asset('/js/popper.js') }}"></script>
    <script src="{{ asset('/js/theme.js') }}"></script>
    <script src="{{ asset('/js/alpine.min.js') }}"></script>
    <script src="{{ asset('/leaflet/sld/leaflet.sld.js') }}"></script>
    <script>
        var map;

        if (window.innerWidth < 572) {
            var zoom = 5.7;
        } else {
            var zoom = 7.3;
        }

        var fitpos = [12.365660, -1.533880];
        map = L.map('map').setView(fitpos, zoom);
        var mapLink = "https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}";

        var baseLayer = L.tileLayer(mapLink, {
            maxZoom: 18,
            attribution: "kndfkjbj",
            id: 'knfjknjbvg',
            tileSize: 512,
            zoomOffset: -1,

        });

        baseLayer.addTo(map);

        var featureGroup = L.featureGroup().addTo(map);

        var drawControl = new L.Control.Draw({
            edit: {
                featureGroup: featureGroup
            }
        }).addTo(map);

        map.on('draw:created', function(e) {

            // Each time a feaute is created, it's added to the over arching feature group
            featureGroup.addLayer(e.layer);
        });


        // on click, clear all layers
        document.getElementById('delete').onclick = function(e) {
            featureGroup.clearLayers();
        }


        document.getElementById('saveForm').onclick = function(e) {
            e.preventDefault();
            $('#addForm').modal('hide');
            var loader =
                ' <div class="for-loader"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>';

            var finshBtn =
                '<button type="submit" id="finish" onclick="exitnow()" class="form-control submit-btn btn rounded submit px-3">TERMINER</button>';
            $('#processing .modal-body').html(loader);
            $('#processing').modal('show');
            var formData = new FormData();

            var data = featureGroup.toGeoJSON();
            // Stringify the GeoJson
            var convertedData = JSON.stringify(data);

            var blob = new Blob([convertedData], {
                type: 'text/json;charset=utf-8,'
            });
            let objet = document.getElementById("objet").value;
            let desc = document.getElementById("desc").value;
            let coucheId = document.getElementById("coucheId").value;
            let _token = $('input[name="_token"]').attr('value');
            formData.append('file', blob, 'delimit.geojson');
            formData.append('objet', objet);
            formData.append('desc', desc);
            formData.append('coucheId', coucheId);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            $.ajax({
                url: "{{ route('postDelimit') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data);
                    $('#processing .modal-body').html("<h1>Fichier en ligne</h1><br>" + finshBtn);
                },
                error: function(data) {
                    console.log(data);
                    $('#processing .modal-body').html("<h1>Echec total</h1>");

                },
            });

        }

        function exitnow() {
            console.log('is click');
            window.location.href = "{{ route('contributionClient') }}";
        }
        document.getElementById('export2').onclick = function(e) {
            // Extract GeoJson from featureGroup
            var data = featureGroup.toGeoJSON();

            // Stringify the GeoJson
            var convertedData = 'text/json;charset=utf-8,' + encodeURIComponent(JSON.stringify(data));

            // Create export
            // document.getElementById('export2').setAttribute('href', 'data:' + convertedData);
            // document.getElementById('export2').setAttribute('download', 'data.geojson');
        }

        // Show coordinates
        var div = document.createElement('div');
        div.id = 'coordsDiv';
        div.style.position = 'absolute';
        div.style.bottom = '0';
        div.style.left = '0';
        div.style.zIndex = '999';
        document.getElementById('map').appendChild(div);

        map.on('mousemove', function(e) {

            var lat = e.latlng.lat.toFixed(5);
            var lon = e.latlng.lng.toFixed(5);

            document.getElementById('coordsDiv').innerHTML = lat + ', ' + lon;

        });


        // New layer
        var newPolygons = L.geoJson(null);

        var style = {
            color: '#37bd37',
            fillColor: '#37bd37',
            opacity: 1,
            weight: 1
        }
        var testPolygonGeojson =
            @php
                echo $data;
            @endphp;

        function parseMyString(myString) {
            var arrayFromString = myString.split("");
            var finalString = "";
            const tabNumber = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

            while (tabNumber.includes(arrayFromString[0])) arrayFromString.shift();

            while (arrayFromString.length > 0) finalString += arrayFromString.shift();
            return finalString;
        }
        var myHeaders = new Headers();
        myHeaders.append('Content-Type', 'text/plain; charset=UTF-8');
        var SLDPromise = fetch('/files/shapefiles/{{ $fichier }}/' + parseMyString('{{ $fichier }}') + '.sld ',
            myHeaders);
        var geojsonLayer = new Map();
        Promise.all([SLDPromise]).then(function(results) {
            //console.log(results[0]);
            Promise.all([results[0].text()])
                .then(function(result) {
                    var SLDText = result[0];
                    var SLDStyler = new L.SLDStyler(SLDText);
                    //console.log('********SLD*********');
                    //console.log(SLDText);
                    var geocl = testPolygonGeojson["features"][0]["geometry"]["type"];

                    newPolygons = L.geoJson(testPolygonGeojson, {
                        style: SLDStyler.getStyleFunction(),

                        onEachFeature: function(feature, layer) {

                            var popupContent = "";

                            for (const [key, value] of Object.entries(feature.properties)) {
                                popupContent += key + ": <b>" + value + "</b><br>";
                            }
                            layer.bindPopup(popupContent);

                        },
                    });

                    if (geocl == "Point") {
                        var geoscl = L.markerClusterGroup();
                        geoscl.addLayer(newPolygons);
                        map.addLayer(geoscl);
                    } else {
                        newPolygons.addTo(map);
                    }
                    map.fitBounds(newPolygons.getBounds());
                    //console.log(geojsonLayer);
                    //dfrd.resolve(geojsonLayer);
                }).catch((error) => {
                    console.log('----------ERROR1----------');
                    console.log(error);
                    //dfrd.resolve("notc");
                });
        }).catch((error) => {
            console.log('----------ERROR2----------');
            console.log(error);
            //dfrd.resolve("notc2");
        });


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


        // It dosen't work on copeden!
        //map.fitBounds([[-192,72],[-207, 60]]);
    </script>
@endsection
