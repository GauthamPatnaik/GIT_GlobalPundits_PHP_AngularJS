$(document).ready(function(e) {
    var width = $(document).width();

    if (width>992) {
        sal({
            once: true,
            rootMargin: "800px 0px"
        });
    } else {
        sal({
            once: true,
            rootMargin: "2000px 0px"
        });
    }
});