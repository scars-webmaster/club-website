(function($){
$(document).ready(function(){

    $(document).on('click', '.srr_tab_list a', function(e){
        e.preventDefault();
        var $settings = $(this).closest('.srr_settings');
        var id = $(this).data('tab');
        $settings.find('.active').removeClass('active');
        $(this).addClass('active');
        $settings.find('section[data-tab-id="' + id + '"]').addClass('active');
    });

    $(document).on('mouseenter', '.srr_pro_intro', function(){
        if( !$(this).hasClass('srr_pro_expand') ){
            window.srr_pro_expand = window.setTimeout(function($ele) {
                window.srr_pro_expand = null;
                $ele.closest('.srr_pro').find('.srr_pro_details').slideDown();
                $ele.addClass('srr_pro_expand');
           }, 1500, $(this));
        }
    });

    $(document).on('mouseleave', '.srr_pro_intro', function(){
        clearTimeout(window.srr_pro_expand);
    });

    $(document).on('click', '.srr_pro_intro', function() {
        var $details = $(this).closest('.srr_pro').find('.srr_pro_details');
        if( !$(this).hasClass('srr_pro_expand') ){
            $details.slideDown();
            $(this).addClass('srr_pro_expand');
        }else{
            $details.slideUp();
            $(this).removeClass('srr_pro_expand');
        }
    });

});
}(jQuery))