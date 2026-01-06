$(document).ready(function() {
    var scroll = $(window).scrollTop();
    var tl_1 = new TimelineMax();

    $(document).scroll(function() {
        scroll = $(window).scrollTop();
        
        if (scroll>50) {
            TweenMax.to("#header-link-bg", 0.3, {width:"100%", height:"62px", top:0, right:0, borderRadius:0, position:"fixed", backgroundColor:"#0D2940", boxShadow:"0 5px 10px rgba(0,0,0,0.19), 0 3px 3px rgba(0,0,0,0.23)"});
            TweenMax.to("#logo-container", 0.3, {width:205});
        } else {
            TweenMax.to("#header-link-bg", 0.3, {width:"850px", height:"40px", top:10, right:10, borderRadius:10, position:"absolute", backgroundColor:"#00467F", boxShadow:"0px", ease: Power1.easeInOut});
            TweenMax.to("#logo-container", 0.3, {width:"20%"});
        }
    });
    TweenMax.staggerFrom(".menu-item", 0.3, {opacity:0, marginTop:"-10px"}, -0.1);
    
    $(".expandable-container").hide();
    
    var menu_colapse = 0;
    $("#hamburger").click(function(e) {
        if (menu_colapse==0) {
            TweenMax.to("#mobile-menu-slide", 0.3, {maxHeight:"90vh", ease: Power1.easeInOut});
            TweenMax.staggerFrom(".mob-menu-link", 0.5, {opacity:0, marginTop:"-10px"}, 0.1);

            menu_colapse = 1;
        } else {
            TweenMax.to("#mobile-menu-slide", 0.3, {maxHeight:"0vh", ease: Power1.easeInOut});

            menu_colapse = 0;
        }
    });

    $("#expandable-1").click(function(e) {
        $("#exp-container-1").slideToggle(300);
    });
    $("#expandable-2").click(function(e) {
        $("#exp-container-2").slideToggle(300);
    });
    $("#expandable-3").click(function(e) {
        $("#exp-container-3").slideToggle(300);
    });
    
});