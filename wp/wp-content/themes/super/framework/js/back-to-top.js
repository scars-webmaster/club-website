		jQuery(document).ready(function(jQuery){
			jQuery(window).scroll(function () {
			if ( jQuery(this).scrollTop() > 500 )
			jQuery("#totop").fadeIn();
			else
			jQuery("#totop").fadeOut();
			});

			jQuery("#totop").click(function () {
			jQuery("body,html").animate({ scrollTop: 0 }, 800 );
			return false;
			});
		});
