$(document).scroll(function() {
    var y = $(this).scrollTop();
    if (y > 400) {
        $("#menu").css("background-color","#1db1c8");
        $("#menu").css("padding","15px");
        $('#menu li a .after').toggleClass('changed');
    } else {
        $("#menu").css("background-color","transparent");
        $("#menu").css("padding","40px");
        $('#menu li a .after').toggleClass('changed');
    }
});