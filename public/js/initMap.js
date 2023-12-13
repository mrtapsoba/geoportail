

function initMap(fitbounds, zoom, layerLink) {
    map = L.map('map').setView(fitbounds, zoom);

    //map.addControl(new L.Control.Fullscreen());
    // detect fullscreen toggling
    
    layerLink.addTo(map);

}