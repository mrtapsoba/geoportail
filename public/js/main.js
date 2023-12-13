$(".option").click(function () {
    $(".option").removeClass("active");
    $(this).addClass("active");

});


let closeBar = $("#close-bar"),
    openBar = $("#open-bar");

openBar.click(function (e) {
    var menuMobile = $(".navigation");
    menuMobile.addClass("nav-active");
});
closeBar.click(function (e) {
    var menuMobile = $(".navigation");
    menuMobile.removeClass("nav-active");
});


let topMenuPhone = $("header"), lastVal
topMenuPhoneHeight = topMenuPhone.outerHeight();
console.log(topMenuPhoneHeight);
// Bind to scroll
$(window).scroll(function () {
    // Get container scroll position
    var fromTopPhone = $(this).scrollTop();

    // Get id of current scroll item
    if ((topMenuPhoneHeight - 80) < fromTopPhone) {
        let val = 1;
        console.log("from top if ")
        console.log(topMenuPhoneHeight);
        console.log("from phone")
        console.log(fromTopPhone);
        if (val != lastVal) {
            lastVal = val;
            $('nav.nav-bar').css('background', '#f2f2f2');
            $('.mobile').css('background', '#f2f2f2');
            $('nav .menu li a').css('color', '#000');
            $('nav .menu li a.active').css('color', '#fff');
            $('#open-bar').css('color', 'black');
        }
    } else {
        let val = 0;
        console.log("from top else ")
        console.log(topMenuPhoneHeight);
        console.log("from phone")
        console.log(fromTopPhone);
        if (val != lastVal) {
            lastVal = val;
            $('.mobile').css('background', 'transparent');
            $('nav.nav-bar').css('background', 'transparent');
            $('nav .menu li a').css('color', '#fff');
            $('#open-bar').css('color', 'white');
        }
    }

});
