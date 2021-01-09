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
	* SlickNav
	*/

	$('#menu-main-slick').slicknav({
		prependTo:'.navbar-header',
		label: edupressStrings.slicknav_menu_home,
		allowParentLinks: true
	});

	jQuery("#ilovewp-featured-tabs").flexslider({
		selector: ".ilovewp-tabs > .ilovewp-tab",
		animation: "slide",
		controlNav: false,
		directionNav: false,
		animationLoop: true,
		slideshow: false,
		itemWidth: 195,
		itemMargin: 0,
		minItems: 2,
		maxItems: 4,
		asNavFor: '#ilovewp-featured-content'
	});

	jQuery("#ilovewp-featured-content").flexslider({
		selector: ".ilovewp-slides > .ilovewp-slide",
		animation: "slide",
		animationLoop: true,
		initDelay: 500,
		smoothHeight: false,
		slideshow: true,
		slideshowSpeed: 5000,
		pauseOnAction: false,
		pauseOnHover: false,
		controlNav: false,
		directionNav: false,
		useCSS: true,
		touch: false,
		animationSpeed: 450,
		sync: "#ilovewp-featured-tabs"
	});

	function edupress_mobileadjust() {

		var windowWidth = $(window).width();

		if( typeof window.orientation === 'undefined' ) {
			$('#menu-main-menu').removeAttr('style');
		}

		if( windowWidth < 769 ) {
			$('#menu-main-menu').addClass('mobile-menu');
		}

	}

	edupress_mobileadjust();

	$(window).resize(function() {
		edupress_mobileadjust();
	});

});