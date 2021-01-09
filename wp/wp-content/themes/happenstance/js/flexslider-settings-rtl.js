/* Flexslider-settings-rtl.js v1.0 */
(function($) {
  $(window).load(function(){
  $('.flexslider').flexslider({
    animation: "slide", 
    rtl: true,
    slideshow: false,
    controlNav: false,
    animationLoop: false,   
    itemWidth: 149,   
    prevText: "&lt;",
    nextText: "&gt;",
  start: function(slider){
    $('body').removeClass('loading');
}
});
});
})(jQuery);