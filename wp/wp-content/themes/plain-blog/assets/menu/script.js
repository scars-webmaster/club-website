( function( $ ) {
    $( document ).ready(function() {
        $('#navigation').prepend('<div id="menu-button">Menu</div>');
        $('#navigation #menu-button').on('click', function(){
            var menu = $(this).next('ul');
            if (menu.hasClass('open')) {
                menu.removeClass('open');
            }
            else {
                menu.addClass('open');
            }
        });
    });
} )( jQuery );