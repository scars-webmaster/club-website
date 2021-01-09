/*
 * Super RSS Reader, WordPress plugin
 * Aakash Chakravarthy, www.aakashweb.com
 */

(function($){
$(document).ready(function(){
    
    var widget = $('.srr-main');
    widget.find('.srr-wrap').hide();
    widget.find('.srr-wrap:first').show();
    widget.find('.srr-tab-wrap li:first').addClass('srr-active-tab');

    $('.srr-tab-wrap li').click(function(){
        var id = $(this).attr('data-tab');
        var parent = $(this).parent().parent();
        
        $(this).parent().children('li').removeClass('srr-active-tab');
        $(this).addClass('srr-active-tab');
        
        parent.find('.srr-wrap').hide();

        $srrTicker = parent.find('.srr-wrap[data-id=' + id + ']');
        $srrTicker.show();
        
        if($srrTicker.height() == 0){
            var visibleItems = $srrTicker.data('visible');
            var tempHeight = $srrTicker.find('.srr-item:first-child').outerHeight() * visibleItems;
            $srrTicker.height(tempHeight);
        }

    });

    // Add the ticker to the required elements
    $('.srr-vticker').each(function(){
        var visible = $(this).attr('data-visible');
        var interval = $(this).attr('data-speed');
        var height = (parseInt(visible) <= 20 ? 'auto' : visible );
        var ticker = $(this).easyTicker({
            'visible': visible,
            'height': height,
            'interval': interval
        });
    });
    
});
}(jQuery));