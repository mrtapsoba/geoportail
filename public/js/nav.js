// Cache selectors
var lastId = 0,
    layerGroupLast = 0,
    legendGroupLast = 0,
    activePan = 0,
    thematikLast = 0,
    phoneMenu = $(".open-phone-menu"),
    layerGroup = $("#layer-group"),
    legendes = $("#legendes"),
    thematikBtn = $(".thematik-bar"),
    calqueLoader = $("#calqueLoader"),
    calqueList = $(".calque-element");


phoneMenu.click((e) => {
    if (1 != lastId) {
        lastId = 1;
        $(".navbar-flex").addClass("phone-active");
        $(".open-phone-menu .fas").removeClass("fa-bars");
        $(".open-phone-menu .fas").addClass("fa-times");
        $('.collapse-phone-menu').css('top', '80px');

    } else {
        lastId = 0;
        $(".navbar-flex").removeClass("phone-active");
        $(".open-phone-menu .fas").removeClass("fa-times");
        $(".open-phone-menu .fas").addClass("fa-bars");
        $('.collapse-phone-menu').css('top', '-200px');
    }
});
layerGroup.click((e) => {
    //console.log("clickkkk");
    if (1 != layerGroupLast) {
        layerGroupLast = 1;
        activePan = 1;
        //console.log("add");
        $(".layer-group").addClass("active-lg");
        $('.layer-group').css('z-index', '1003');
        $('.fonds-thematiks').css('z-index', '1001');
        if (legendGroupLast == 1) {
            $('.legend-group').css('z-index', '1002');
        } else {
            $(".action-btn").addClass("action-btn-click");
        }

    } else {
        //console.log("remove");
        if (activePan == 2) {
            $('.legend-group').css('z-index', '1002');
            $('.layer-group').css('z-index', '1003');
            activePan = 1;
        } else {
            layerGroupLast = 0;
            activePan = 0;
            $(".layer-group").removeClass("active-lg");
            if (legendGroupLast == 1) {
                $('.legend-group').css('z-index', '1003');
                $('.fonds-thematiks').css('z-index', '1002');
            } else {
                $(".action-btn").removeClass("action-btn-click");

            }
        }
    }
});
legendes.click((e) => {
    //console.log("clickkkk");
    if (1 != legendGroupLast) {
        legendGroupLast = 1;
        activePan = 2;
        console.log("add");
        $(".legend-group").addClass("active-lg");
        $('.legend-group').css('z-index', '1003');
        $('.fonds-thematiks').css('z-index', '1001');
        if (layerGroupLast == 1) {
            $('.layer-group').css('z-index', '1002');
        } else {
            $(".action-btn").addClass("action-btn-click");
        }

    } else {
        //console.log("remove");
        if (activePan == 1) {
            $('.legend-group').css('z-index', '1003');
            $('.layer-group').css('z-index', '1002');
            activePan = 2;
        } else {
            legendGroupLast = 0;
            activePan = 0;
            $(".legend-group").removeClass("active-lg");
            if (layerGroupLast == 1) {
                $('.layer-group').css('z-index', '1003');
                $('.fonds-thematiks').css('z-index', '1002');
            } else {
                $(".action-btn").removeClass("action-btn-click");

            }
        }

    }
});
thematikBtn.click((e) => {
    //console.log("clickkkk");
    if (1 != thematikLast) {
        thematikLast = 1;
        //console.log("add");
        $('.layer-group').css('z-index', '1002');
        $('.fonds-thematiks').css('z-index', '1003');
        $(".fonds-thematiks").addClass("ft-active");
        $(".thematik-bar .fas").removeClass("fa-stream");
        $(".thematik-bar .fas").addClass("fa-times");

    } else {
        //console.log("remove");
        thematikLast = 0;
        $('.layer-group').css('z-index', '1002');
        $('.fonds-thematiks').css('z-index', '1003');
        $(".fonds-thematiks").removeClass("ft-active");
        $(".thematik-bar .fas").removeClass("fa-times");
        $(".thematik-bar .fas").addClass("fa-stream");

        $(".fond-thematik").css("left", "0px");
        $("#sous-thematik").css("right", "-120%");
        $("#products").css("right", "-120%");
    }
});

