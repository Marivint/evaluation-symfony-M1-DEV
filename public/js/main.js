/***************************/
/*   Jquery constructeur   */ // pour animate.css
/***************************/
// Extend de animateCss
$.fn.extend({
    animateCss: function(animationName, callback) {
        var animationEnd = (function(el) {
            var animations = {
                animation: 'animationend',
                OAnimation: 'oAnimationEnd',
                MozAnimation: 'mozAnimationEnd',
                WebkitAnimation: 'webkitAnimationEnd',
            };

            for (var t in animations) {
                if (el.style[t] !== undefined) {
                    return animations[t];
                }
            }
        })(document.createElement('div'));

        this.addClass('animated ' + animationName).one(animationEnd, function() {
            $(this).removeClass('animated ' + animationName);
            if (typeof callback === 'function') callback();
        });

        return this;
    },
});


/***************************/
/*     Document ready      */
/***************************/
$(document).ready(function(){

    // Loader
    $("#loader-container").animateCss('fadeOut',function(){
        $("#loader-container").hide();
        $( ".intro-animated" ).css("display","inherit");
        $( ".intro-animated" ).animateCss('fadeInUp');
        // $( "#maps" ).animateCss('bounce');
    });

    $( document ).ajaxStart(function() {
        $("#loader-container").animateCss('fadeIn');
    });

    $( document ).ajaxStop(function() {
        $("#loader-container").animateCss('fadeOut',function(){
            $("#loader-container").hide();
        });
    });
    // Fin loader


    // Poubelle

});



/***************************/
/*       Fonctions         */
/***************************/
// $(".btn-retour").on("click",function(){
// 	history.back();
// });
