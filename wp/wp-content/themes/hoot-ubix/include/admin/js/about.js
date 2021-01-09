jQuery(document).ready(function($) {
	"use strict";

	$('.hootubix-abouttheme-top').on('click',function(e){
		var $target = $( $(this).attr('href') );
		if ( $target.length ) {
			e.preventDefault();
			var destin = $target.offset().top - 50;
			$("html:not(:animated),body:not(:animated)").animate({ scrollTop: destin}, 500 );
		}
	});

	$('.hootubix-abouttabs .nav-tab, .hootubix-about-sub .linkto-tab, .hootubix-abouttabs .linkto-tab').on('click',function(e){
		e.preventDefault();
		var targetid = $(this).data('tabid'),
			$navtabs = $('.hootubix-abouttabs .nav-tab'),
			$tabs = $('.hootubix-abouttabs .hootubix-tab'),
			$target = $('#hootubix-'+targetid);
		if ( $target.length ) {
			$navtabs.removeClass('nav-tab-active');
			$navtabs.filter('[data-tabid="'+targetid+'"]').addClass('nav-tab-active');
			$tabs.removeClass('hootubix-tab-active');
			$target.addClass('hootubix-tab-active');
			var destin = $target.offset().top - 150;
			$("html:not(:animated),body:not(:animated)").animate({ scrollTop: destin}, 200 );
		}
	});

	$('#hootubix-welcome-msg .notice-dismiss').on('click',function(e){
		if( 'undefined' != typeof hootubix_dismissible_notice && 'undefined' != typeof hootubix_dismissible_notice.nonce && 'undefined' != typeof hootubix_dismissible_notice.ajax_action ) {
			// e.preventDefault();
			jQuery.ajax({
				url : ajaxurl, // hootubix_dismissible_notice.ajax_url
				type : 'post',
				data : {
					'action': hootubix_dismissible_notice.ajax_action,
					'nonce': hootubix_dismissible_notice.nonce
				},
				success : function( response ) {}
			}); //$.post(ajaxurl, data);
		}
	});

});