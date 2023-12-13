// Cache selectors
var lastId,
    calqueId = new Array(),
    layerAdded = new Map(),
    fullScreen = $("#fullscreen-btn"),
    productList = $(".products-element"),
    calqueLoader = $("#calqueLoader"),
    removeLayer = $(".remove-layer"),
    fondElement = $(".fond-element"),
    sthBack = $(".sth-back"),
    pdtBack = $(".pdt-back"),
    thematikElement = $(".thematik-element"),
    sThematikElement = $(".sous-thematik-element"),
    products = $("#products"),
    zoomIn = $(".zoom-plus"),
    zoomOut = $(".zoom-moins"),
    myPosition = $("#myLocation"),
    calqueList = $(".calque-element");


// Bind click handler to menu items
// so we can get a fancy scroll animation
productList.click(async function (e) {
    var id = $(this).attr("id");
    console.log(id);
    if (layerAdded.get(id) == undefined) {
        var layerName = "Erreur";
        if (($("#" + id + ".products-element")).length > 0) {
            layerName = $(this).text();
            console.log(layerName);
        }
        var layerLoader = "<div class='loading' id='ll-" + id + "'>";
        layerLoader += "<span>" + layerName + " en cours de chargement</span>";
        layerLoader += "<div class='loader'></div>";
        layerLoader += "</div>";
        //console.log(layerLoader);
        $(".loaders").prepend(layerLoader);

        calqueId.push(id);
        //console.log("click to add");

        calqueLoader.removeClass("loaded");
        calqueLoader.addClass("loading");
        var geoJsonReturned = new Map();
        //verifier map and L avant lutilisation
        addLayerFrom(id, map, L, layerName).done(function (valGeo) {
            geoJsonReturned = valGeo;
            //console.log(geoJsonReturned);
            calqueLoader.removeClass("loading");
            calqueLoader.addClass("loaded");
            console.log(calqueLoader);

            if (geoJsonReturned.length != 0) {

                if (layerAdded.get(id) == undefined) {
                    $("#" + id).addClass("pd-active");
                    layerAdded.set(id, geoJsonReturned);
                    //console.log("success with added");
                    //console.log("layer change 1");
                    document.getElementById("layers").innerHTML = "";
                    layerAdded.forEach(createLayerAddedMenu);
                    $(".layer-number").text(layerAdded.size);
                }
                else {
                    //console.log(layerAdded.get(id));
                    map.removeLayer(geoJsonReturned);
                    map.removeLayer(layerAdded.get(id));
                    layerAdded.delete(id);

                    //console.log("layer change 2");
                    document.getElementById("layers").innerHTML = "";
                    layerAdded.forEach(createLayerAddedMenu);
                    $(".layer-number").text(layerAdded.size);
                    $("#" + id).removeClass("pd-active");
                    //console.log("success with deteled");
                }
                var rmLoader = document.getElementById("ll-" + id);
                rmLoader.parentNode.removeChild(rmLoader);
            }
        });


    } else {
        //console.log("clicked for remove");
        map.removeLayer(layerAdded.get(id));
        layerAdded.delete(id);
        document.getElementById("layers").innerHTML = "";
        layerAdded.forEach(createLayerAddedMenu);
        $(".layer-number").text(layerAdded.size);
        $("#" + id).removeClass("pd-active");
        //console.log("removed with success");
    }

});

$("#fullscreen-btn").click((e) => {
    map.toggleFullscreen();
    //console.log();
    if (map.isFullscreen() == false) {
        $("#fullscreen .fas").removeClass("fa-expand");
        $("#fullscreen .fas").addClass("fa-compress");
        $(".layer-group").addClass("layer-group-fullScreen");

    } else {
        $("#fullscreen .fas").removeClass("fa-compress");
        $("#fullscreen .fas").addClass("fa-expand");
        $(".layer-group").removeClass("layer-group-fullScreen");
    }
});

sthBack.click((e) => {
    console.log("sous thematique");
    $("#sous-thematik").css("right", "-120%");
    $(".fond-thematik").css("left", "0");
});
pdtBack.click((e) => {
    console.log("produits");
    $("#sous-thematik").css("right", "0");
    $("#products").css("right", "-120%");
});
zoomIn.click((e) => {
    map.setZoom(map.getZoom() + 1);
});

zoomOut.click((e) => {
    map.setZoom(map.getZoom() - 1);
});

myPosition.click(function (e) {
    var id = $(this).attr("id");
    console.log("myLocation");
    console.log(layerAdded);
    var mP = layerAdded.get(id);
    if (mP != undefined) {
        console.log("exist deja");
        $(".layer-number").text(layerAdded.size);
        map.removeLayer(mP);
        layerAdded.delete(id);
        console.log(layerAdded.size);
        console.log(layerAdded);
        document.getElementById("layers").innerHTML = "";
        layerAdded.forEach(createLayerAddedMenu);
        $(".layer-number").text(layerAdded.size);
    }
    else {
        console.log("inexistant");
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                latit = position.coords.latitude;
                longit = position.coords.longitude;
                // this is just a marker placed in that position
                var myLocat = L.marker([position.coords.latitude, position.coords.longitude])
                // move the map to have the location in its center
                //var myLocat = new L.LatLng(latit, longit);
                layerAdded.set("myLocation", myLocat);
                map.addLayer(myLocat);
                document.getElementById("layers").innerHTML = "";
                layerAdded.forEach(createLayerAddedMenu);
                $(".layer-number").text(layerAdded.size);
            })
        }
    }

    //delete All layer from map
    //console.log("layer");
});

console.log("click Event");


/*----------------------change Layer---------------*/


function insertAtIndex(index, key, value, map) {
    const arr = Array.from(map);
    arr.splice(index, 0, [key, value]);
    return new Map(arr);
}

var i = 0;
fondElement.click(function (e) {
    //console.log("fond changer");
    var id = $(this).attr("id");
    //console.log(id);
    var lastActiveId = $(".fd-active").attr("id");
    //baseLayers[id].bringToBack()

    if (lastActiveId != undefined) {
        //console.log(lastActiveId);
        //console.log(layerAdded.get(lastActiveId));
        //console.log("rm info");
        map.removeLayer(layerAdded.get(lastActiveId));

        layerAdded.delete(lastActiveId);

        //delete All layer from map
        //console.log("layer");
        layerAdded.forEach(deleteFromMap);
    }

    //final layer
    //console.log("adddd" + i++);
    layerAdded = insertAtIndex(0, id, baseLayers[id], layerAdded);
    layerAdded.forEach(addToMap);

    //console.log(layerAdded);
    document.getElementById("layers").innerHTML = "";
    layerAdded.forEach(createLayerAddedMenu);
    $(".layer-number").text(layerAdded.size);
    console.log("fond changer");
    console.log(id);
    fondElement.removeClass("fd-active");
    $(".fond-element#" + id).addClass("fd-active");
});

function deleteFromMap(value, key) {
    //console.log(value);
    if (value != undefined) {
        map.removeLayer(value);
    }
}
var i = 0;
function addToMap(value, key) {
    i++;
    //console.log(value);
    if (value != undefined) {
        if (key == "myLocation") {
            map.addLayer(value);
        }
        else value.addTo(map);
    }
}

function deleteLayerAddedMenu(idLayer) {
    var addedLayer = document.getElementById(idLayer);
    addedLayer.parentNode.removeChild(addedLayer);
}

function createLayerAddedMenu(value, key) {
    //console.log("key= " + key + "value = " + value);
    idProduct = key;
    if (($("#" + idProduct + ".products-element")).length > 0) {
        var layerName = $("#" + idProduct).text();
    }
    else if (($("#" + idProduct + ".fond-element")).length > 0) {
        var layerName = $("#" + idProduct).text();
    } else {
        var layerName = "Ma position";
    }

    var newLayer = "<div class='layer-element' id='" + idProduct + "'>";
    newLayer += "<div class='layer-element-details'>";
    newLayer += "<div class='inline-flex f-jc-sb'><span class ='layer-element-name'>" + layerName + "</span><div class='layer-tools'><i class='far far fa-eye view-hide-Layer' viewHideLayer='" + idProduct + "' id='vh-" + idProduct + "'></i><div><i class='fas fa-trash remove-layer' layerforremove='" + idProduct + "'></i></div></div></div><div class='opacity-block'><span>Opacite </span> <input class='opacitySlider' id='sd-" + idProduct + "' layerforopacitychange='" + idProduct + "' type = 'range' min = '0' max = '100' value = '100' /> ";
    newLayer += "</div></div >";
    $("#layers").prepend(newLayer);


}
$(document).on('click', '.remove-layer', function (e) {
    var id = $(this).attr("layerforremove");
    console.log(id + " is click");
    $(".legend-block." + id).remove();
    removeLayerAdded(id);
})
$(document).on('change', '.opacitySlider', function (e) {
    console.log("change");
    var id = $(this).attr("layerforopacitychange");
    //var newVal = $(this).value;
    console.log($("#sd-" + id));
    var x = document.getElementById("sd-" + id);
    var newVal = x.value;

    var myLayer = layerAdded.get(id);
    console.log(myLayer);
    console.log("newVal = " + newVal + " opacity=" + newVal / 100);
    if (myLayer instanceof L.Marker) {
        myLayer.setOpacity(newVal / 100);
    } else if (myLayer instanceof L.GridLayer) {
        myLayer.setOpacity(newVal / 100);
    }
    else {
        myLayer.setStyle({ "opacity": newVal / 100, "fillOpacity": newVal / 100, "transition": "0.5s ease-in-out" });
    }
    layerAdded.set(id, myLayer);
    if (newVal > 0) {
        $("#vh-" + id).removeClass("far fa-eye-slash");
        $("#vh-" + id).addClass("far fa-eye");

    } else {
        $("#vh-" + id).removeClass("far fa-eye");
        $("#vh-" + id).addClass("far fa-eye-slash");

    }
})
$(document).on('click', '.view-hide-Layer', function (e) {
    var id = $(this).attr("viewHideLayer");
    console.log(id);
    if (($("#vh-" + id + ".fa-eye-slash")).length == 0) {
        var myLayer = layerAdded.get(id);
        console.log(myLayer);
        var x = document.getElementById("sd-" + id);
        x.setAttribute('value', 0);
        if (myLayer instanceof L.Marker) {
            myLayer.setOpacity(0);
        } else if (myLayer instanceof L.GridLayer) {
            myLayer.setOpacity(0);
        }
        else myLayer.setStyle({ "opacity": 0, "fillOpacity": 0, "transition": "0.5s ease-in-out" });
        layerAdded.set(id, myLayer);
        $("#vh-" + id).removeClass("far fa-eye");
        $("#vh-" + id).addClass("far fa-eye-slash");
        $("#sd-" + id).attr("value", 0);
    } else {
        var myLayer = layerAdded.get(id);
        var x = document.getElementById("sd-" + id);
        x.setAttribute('value', 100);
        console.log("set to 1");
        if (myLayer instanceof L.Marker) {
            myLayer.setOpacity(1);
        } else if (myLayer instanceof L.GridLayer) {
            myLayer.setOpacity(1);
        }
        else myLayer.setStyle({ "opacity": 1, "fillOpacity": 1, "transition": "0.5s ease-in-out" });
        layerAdded.set(id, myLayer);
        $("#vh-" + id).removeClass("far fa-eye-slash");
        $("#vh-" + id).addClass("far fa-eye");
        $("#sd-" + id).attr("value", 100);
    }

});



/*---------gestion de thematique--------------*/
thematikElement.click(function () {
    var id = $(this).attr("id");
    $(".fond-thematik").css("left", "-120%");
    $("#sous-thematik").css("right", "0px");
    $(".sous-thematik-element").removeClass("view-data");
    $("#sous-thematik ." + id).addClass("view-data");


});
sThematikElement.click(function () {
    var id = $(this).attr("id");
    $("#sous-thematik").css("right", "120%");
    $("#products").css("right", "0px");
    $(".products-element").removeClass("view-data");
    $("#products ." + id).addClass("view-data");
});

function removeLayerAdded(id) {
    //console.log("rm id = " + id);
    //console.log("for remove");
    //console.log("clicked for remove");
    //console.log(map);
    //console.log(layerAdded.get(id));
    console.log(($("#" + id + ".products-element")).length);
    if (($("#" + id + ".products-element")).length > 0) {
        console.log("disabled");
        $("#" + id + ".products-element").removeClass("pd-active");
    }
    map.removeLayer(layerAdded.get(id));
    //console.log(map);
    layerAdded.delete(id);
    document.getElementById("layers").innerHTML = "";
    layerAdded.forEach(createLayerAddedMenu);
    $(".layer-number").text(layerAdded.size);
    $("#" + id).removeClass("fd-active");
    //console.log("removed with success");
}
