/* Caroufredsel-settings.js v1.0 */
jQuery(document).ready(function($) {
//News Teaker
$(function() {
var _scroll = {
  delay: 1000,
  easing: 'linear',
  items: 1,
  duration: 9000,
  timeoutDuration: 0,
  pauseOnHover: 'immediate'
};
$('#ticker').carouFredSel({
  width: 1200,  
  align: false,
  items: {
    width: 'variable',
    height: 30,
    visible: 1
},
  scroll: _scroll
});
$('ticker ul li:last').width(2000);
});
});