<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/fontawesome2/css/all.min.css') }}" rel="stylesheet">




    <link href="{{ asset('/css/Control.FullScreen.css') }}" rel="stylesheet">
    <link href=" {{ asset('/leaflet/measure/leaflet_measure.css') }}" rel="stylesheet">




    <!-- Bootstrap CSS -->
    <link href="{{ asset('/bootstrap2/css/bootstrap.min.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css'
        rel='stylesheet' />
    <!-- Marker cluster -->
    <link href="{{ asset('/leaflet/markercluster/MarkerCluster.css') }}" rel="stylesheet">
    <link href="{{ asset('/leaflet/markercluster/MarkerCluster.Default.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/flex.css') }}" rel="stylesheet">




    <title>Geoportail du BURKINA FASO</title>
</head>

<body>

    <div class="navbar-flex phone-active f-jc-sb">
        <a class="logo" href="#">
            <img class="logo-img" src="/images/logo_igb.png" alt="">
            <div class="logo-text">
                <span>Geoportail du</span>
                <span>Burkina Faso</span>
            </div>
        </a>
        <div class="navbarflex-toggler">
            <a class="open-phone-menu">
                <i class="fas fa-bars"></i>
            </a>
        </div>


        <form class="f-search-field w-33 pc-view" action="" method="post">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher ici"
                    aria-label="Text input with dropdown button">
                <div class="input-group-append">
                    <button class="btn btn-success" type="button" id="button-addon2">Rechercher</button>
                </div>
            </div>
        </form>

        <div class="header-useful-link inline-flex pc-view">

            @if (Auth::check())
                <a href="{{ route('clientProfile') }}">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</a>
            @else
                <a href="{{ route('login') }}">connexion</a>
            @endif

            <div class="thematik thematik-bar" id="">
                <i class="fas fa-stream"></i>
            </div>
        </div>
    </div>
    <div class="phone-view collapse-phone-menu inline-flex">
        <div class="inline-flex phone-menu">
            @if (Auth::check())
                <a href="{{ route('clientProfile') }}">
                    <div><i class="far fa-user"></i> {{ Auth::user()->nom }}</div>
                </a>
            @else
                <a href="{{ route('login') }}">
                    <div><i class="far fa-user"></i> Connexion</div>
                </a>
            @endif

            <a class="thematik thematik-bar" href="#">
                <div><i class="fas fa-stream"></i>Thematique</div>
            </a>
        </div>
        <form action="" method="post">
            <input type="text" class="form-control" placeholder="Rechercher ici"
                aria-label="Text input with dropdown button">
            <button class="btn btn-success" type="submit" id="button-addon2">Rechercher</button>
        </form>
    </div>

    <div class="map-container">

        <div id="map">
            <div class="loaders">
                <span></span>
            </div>

            <div class="all-legends">
                <div id="legends">

                </div>
            </div>
        </div>
        <div class="action-btn">
            <button type="button" class="zoom-plus" id="" data-bs-toggle="tooltip" data-bs-placement="right"
                title="Zoom interne"><i class="fas fa-plus"></i></button>
            <button type="button" class="zoom-moins" id="" data-bs-toggle="tooltip" data-bs-placement="right"
                title="Zoom externe"><i class="fas fa-minus"></i></button>
            <button type="button" id="layer-group" data-bs-toggle="tooltip" data-bs-placement="right"
                title="Calques utilises"><i class="fas fa-layer-group"></i><span class="layer-number"></span></button>
            <button type="button" id="legendes" data-bs-toggle="tooltip" data-bs-placement="right" title="Legendes"><i
                    class="fas fa-shapes"></i></button>
            <button type="button" id="myLocation" data-bs-toggle="tooltip" data-bs-placement="right"
                title="Ma position"><i class="fas fa-globe-africa"></i></button>
            <button id="fullscreen-btn" data-bs-toggle="tooltip" data-bs-placement="right" title="Plein ecran"><i
                    class="fas fa-expand"></i></button>
            <button id="fullscreen-btn" onclick="downloadMap('Institut Geographique du Burkina');"
                data-bs-toggle="tooltip" data-bs-placement="right" title="Plein ecran"><i
                    class="fas fa-download"></i></button>
            <button id="fullscreen-btn" onclick="printMap('Institut Geographique du Burkina');" data-bs-toggle="tooltip"
                data-bs-placement="right" title="Plein ecran"><i class="fas fa-download"></i>PDF</button>
        </div>
        <div class="layer-group">
            <h2 class="title-layers">Couches ajoutees</h2>

            <div class="layers" id="layers">
            </div>

        </div>

        <div class="legend-group">
            <h2 class="title-layers">Legendes</h2>

            <div class="bar-legend" id="barLegend">
            </div>

        </div>


        <div class="myLocation" style="display:none;" id="true"></div>
        <div class="navigation-summary desktop-view"></div>

        <div class="fonds-thematiks">
            <div class="fd-close-bar phone-view">
                <i class="fas fa-times thematik-bar close"></i>
            </div>
            <div class="fond-thematik page-1">
                <div class="fondsliste">

                    <a class="accordion-button title" data-bs-toggle="collapse" href="#dataLayer" role="button"
                        aria-expanded="false" aria-controls="dataLayer">
                        Fonds de Carte
                    </a>
                    <div class="elements accordion-collapse collapse show" id="dataLayer">
                        @forelse ($fondListe as $fond)
                            @php
                                $i = 0;
                            @endphp

                            @if ($i == 0)
                                @php
                                    $i++;
                                @endphp
                                <div class="fond-element fd-active" id="fdc-{{ $fond->id }}">
                                    <img src="/images/{{ $fond->image }}" alt="">
                                    <h3>{{ $fond->nom }}</h3>
                                </div>
                            @else
                                <div class="fond-element" id="fdc-{ $fond->id }}">
                                    <img src="/images/{{ $fond->image }}" alt="">
                                    <h3>{{ $fond->nom }}</h3>
                                </div>
                            @endif


                        @empty
                            Vide
                        @endforelse
                        <?php
                        
                        ?>
                    </div>
                </div>
                <div class="thematiqueliste">

                    <a class="accordion-button collapsed title" data-bs-toggle="collapse" href="#dataTheme"
                        role="button" aria-expanded="false" aria-controls="dataTheme">
                        Données thematiques
                    </a>
                    <div class="elements accordion-collapse collapse" id="dataTheme">
                        @forelse ($thematiqueListe as $thematique)
                            <div class="thematik-element" id="th-{{ $thematique->id }}">
                                <img src="/images/{{ $thematique->image }}" alt="">
                                <h3>{{ $thematique->nom }}</h3>
                            </div>
                        @empty
                            Pas de thematique
                        @endforelse
                    </div>
                </div>
            </div>
            <div id="sous-thematik">

                <div class="thematiqueliste">

                    <div class="title">
                        <div class="sth-back"><i class="fas fa-angle-left"></i></div>
                        <div class="title-text">Sous thematiques</div>

                    </div>
                    <div class="elements accordion-collapse collapse" id="dataTheme">
                        @foreach ($sousThemeListe as $sousTheme)
                            <div class="th-{{ $sousTheme->thematique_id }} sous-thematik-element"
                                id="st-{{ $sousTheme->id }}">
                                <img src="/images/{{ $sousTheme->image }}" alt="">
                                <h3 class="">{{ $sousTheme->nom }}</h3>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div id="products">

                <div class="thematiqueliste">

                    <div class="title" href="#dataProduct">
                        <div class="pdt-back"><i class="fas fa-angle-left"></i></div>
                        <div class="title-text">Couches</div>
                    </div>
                    <div class="elements accordion-collapse collapse" id="dataTheme">
                        @foreach ($coucheListe as $couche)
                            <h3 class="st-{{ $couche->sous_thematique_id }} products-element"
                                id="{{ $couche->fichier }}">

                                {{ $couche->nom }}
                            </h3>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/js/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/js/jquery/jquery-ui.js') }}"></script>
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>


    <script src="{{ asset('/leaflet/sld/leaflet.sld.js') }}"></script>
    <script src="{{ asset('/js/initMap.js') }}"></script>
    <script src="{{ asset('/js/data/getData.js') }}"></script>
    <script src="{{ asset('/bootstrap2/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.0.0/dist/leaflet.markercluster.js"></script>
    <script src="{{ asset('/leaflet/html2canvas/html2canvas.js') }}"></script>
    <script src="{{ asset('/leaflet/Export-master/leaflet_export.js') }}"></script>
    <script src="{{ asset('/leaflet/editable/Leaflet.Editable.js') }}"></script>
    <script src="{{ asset('/leaflet/measure/leaflet_measure.js') }}"></script>

    <script src="{{ asset('/js/nav.js') }}"></script>
    <script src="{{ asset('/js/clickEvent.js') }}"></script>

    <script>
        var baseLayers = {
            @foreach ($fondListe as $fond)
                "fdc-{{ $fond->id }}": L.tileLayer("{{ $fond->lien }}", {
                    maxZoom: 18,
                    attribution: "{{ $fond->attribution }}",
                    id: '{{ $fond->attribution }}',
                    tileSize: 512,
                    zoomOffset: -1,
                }),
            @endforeach

        };

        var zoom = 7.3;
        var latit = 0;
        var longit = 0;

        var fitpos = [12.365660, -1.533880];
        var mapLink = "https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}";
        //var mapLink = "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}";
        //var mapLink = "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw";
        var attribution =
            "Map data &copy; <a href='https://www.openstreetmap.org/copyright'>OpenStreetMap</a> contributors, Imagery © <a href='https://www.mapbox.com/''>Mapbox</a>";


        var firstLayerId = $(".fondsliste .fond-element.fd-active").attr("id");
        window.onload = function() {
            if (window.innerWidth < 572) {
                var zoom = 5.7;
            } else {
                var zoom = 7.3;
            }
            layerAdded.set(firstLayerId, baseLayers[firstLayerId]);
            console.log(firstLayerId);
            console.log(baseLayers[firstLayerId]);
            baseLayers[firstLayerId] =
                "https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}";
            //initMap(fitpos, zoom, baseLayers[firstLayerId], attribution);

            var form = L.tileLayer(mapLink, {
                maxZoom: 18,
                attribution: "kndfkjbj",
                id: 'knfjknjbvg',
                tileSize: 512,
                zoomOffset: -1,

            });
            initMap(fitpos, zoom, form, attribution);


            var scale = L.control.scale().addTo(map);
            document.getElementById("layers").innerHTML = "";
            layerAdded.forEach(createLayerAddedMenu);
            $(".layer-number").text(layerAdded.size);
            $(".layer-number").text(layerAdded.size);
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    latit = position.coords.latitude;
                    longit = position.coords.longitude;
                    // this is just a marker placed in that position
                    myLocatFinal = L.marker([position.coords.latitude, position.coords.longitude]);
                })
            }

            map.on('enterFullscreen', function() {
                if (window.console) window.console.log('enterFullscreen');
            });
            map.on('exitFullscreen', function() {
                if (window.console) window.console.log('exitFullscreen');
            });


        }
        window.onresize = function() {

            if (window.innerWidth < 572) {
                map.setZoom(5.7);
            } else {
                map.setZoom(7.3);
            }
        }

        function createMar() {
            var measure = L.measureBase(map, {});
            measure.markerBaseTool.startMeasure({
                title: 'Marker'
            });
        }

        // add a scale at at your map.
    </script>

    <script>
        function exportMap() {
            var exportOptions = {
                container: map._container,
                caption: {
                    text: 'Exporting',
                    font: '30px Arial',
                    fillStyle: 'black',
                    position: [100, 200]
                },
                exclude: ['.leaflet-control-zoom', '.leaflet-control-attribution'],
                format: 'image/jpg'
            };
            var exportedlement = map.export(exportOptions).then(
                result = function(value) {
                    var i = 1;
                }
            );
        }

        function afterRender(result) {
            return result;
        }

        function afterExport(result) {
            return result;
        }

        function downloadMap(caption) {
            console.log("downloading...");
            const millis = Date.now();
            var downloadOptions = {
                container: map._container,
                caption: {
                    text: caption,
                    font: '30px Arial',
                    fillStyle: 'black',
                    position: [100, 200]
                },
                exclude: ['.leaflet-control-zoom', '.leaflet-control-attribution'],
                format: 'image/png',
                fileName: 'IGB-Map-' + millis + '.png',
                afterRender: afterRender,
                afterExport: afterExport
            };
            var promise = map.downloadExport(downloadOptions);
            var data = promise.then(function(result) {
                return result;
            });
        }

        function printMap(caption) {
            var printOptions = {
                container: map._container,
                exclude: ['.leaflet-control-zoom'],
                format: 'image/png',
                afterRender: afterRender,
                afterExport: afterExport
            };
            printOptions.caption = {
                text: caption,
                font: '30px Arial',
                fillStyle: 'black',
                position: [50, 50]
            };
            var promise = map.printExport(printOptions);
            var data = promise.then(function(result) {
                return result;
            });
        }
    </script>

</body>

</html>
