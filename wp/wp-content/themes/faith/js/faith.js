jQuery(document).ready(function($) { 
    'use strict';

    var $document = $(document);
    var $window = $(window);


/**
* Document ready (jQuery)
*/
$(function () {

/**
* Activate superfish menu.
*/
$('.sf-menu').superfish({
    'speed': 'fast',
    'delay' : 0,
    'animation': {
        'height': 'show'
    }
});

});

/**
* FitVids - Responsive Videos in posts
*/
$(".post-single").fitVids();

/**
* SlickNav
*/

$('#menu-main-slick').slicknav({
    prependTo:'.navbar-header',
    label: faithStrings.slicknav_menu_home,
    allowParentLinks: true
});

jQuery("#ilovewp-hero").flexslider({
    selector: ".ilovewp-slides > .ilovewp-slide",
    animation: "slide",
    animationLoop: true,
    initDelay: 500,
    smoothHeight: false,
    slideshow: true,
    slideshowSpeed: 5000,
    pauseOnAction: true,
    pauseOnHover: false,
    controlNav: false,
    directionNav: true,
    useCSS: true,
    touch: false,
    animationSpeed: 600,
    rtl: false,
    reverse: false
});

function faith_mobileadjust() {

    var windowWidth = $(window).width();

    if( typeof window.orientation === 'undefined' ) {
        $('#menu-main-menu').removeAttr('style');
    }

    if( windowWidth < 769 ) {
        $('#menu-main-menu').addClass('mobile-menu');
    }

}

faith_mobileadjust();

$(window).resize(function() {
    faith_mobileadjust();
});

});