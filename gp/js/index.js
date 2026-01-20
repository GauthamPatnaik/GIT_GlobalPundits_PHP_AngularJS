$(document).ready(function (e) {

    var scene = document.getElementById('illus-container');
    var parallaxInstance = new Parallax(scene);

    var scene = document.getElementById('pent-scene');
    var parallaxInstance = new Parallax(scene);

    sal({
        once: true
    });

    $('.slider').bxSlider({
        pager: false,
    });


    var lineDrawing = anime({
        targets: ['#svg .layer1 *'],
        strokeDashoffset: [anime.setDashoffset, 0],
        easing: 'easeInOutSine',
        // delay: function(el, i) { return i * 250 },
        duration: 5000,
        direction: 'alternate',
        loop: false
    });

    // var lineDrawing = anime({
    //     targets: '#svg .layer1 path',
    //     strokeDashoffset: [anime.setDashoffset, 0],
    //     easing: 'easeInOutSine',
    //     duration: 2500,
    //     delay: function(el, i) { return i * 250 },
    //     direction: 'alternate',
    //     loop: true
    // });
});

var curr = 0;

function changeService(val) {
    if (curr != val) {
        TweenMax.to(serviceBlocks[curr], 0.5, { marginTop: -200, opacity: 0, ease: Power1.easeInOut });
        TweenMax.to(serviceBlocks[val], 0.5, { marginTop: 40, opacity: 1, ease: Power1.easeInOut });

        $(serviceLinks[curr]).removeClass('selected');
        $(serviceLinks[val]).addClass('selected');

        setTimeout(function () {
            TweenMax.to(serviceBlocks[curr], 0, { marginTop: 300 });

            curr = val;
        }, 500);

    }

}
$(document).ready(function () {

    serviceBlocks = $("#services-display").children("div").toArray();
    serviceLinks = $("#services-selector>ul").children("li").toArray();

    TweenMax.to(serviceBlocks[0], 0.5, { marginTop: 40, opacity: 1 });

    TweenMax.to("#landing-info", 0.5, { marginLeft: 0, opacity: 1, delay: 0.5, ease: Power1.easeInOut });

    $("#servicesScrollBtn").click(function () {
        $('html, body').animate({
            scrollTop: $("#section-3").offset().top
        }, 1000);
    });
});
var rellax = new Rellax('.rellax');