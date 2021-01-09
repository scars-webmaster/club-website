/* Masonry-settings.js v1.0 */  
var container = document.querySelector('.js-masonry');
var msnry;
// initialize Masonry after all images have loaded
imagesLoaded( container, function() {
  msnry = new Masonry( container, {
  columnWidth: container.querySelector('.grid-entry'),  
  itemSelector: '.grid-entry'
} );
});                   