jQuery(document).ready(function($) {
	"use strict";

	/*** Init lightslider ***/

	if( 'undefined' == typeof hootubixData || 'undefined' == typeof hootubixData.lightSlider || 'enable' == hootubixData.lightSlider ) {
		if (typeof $.fn.lightSlider != 'undefined') {
			$(".lightSlider").each(function(i){
				var self = $(this),
					settings = {
						item: 1,
						slideMove: 1, // https://github.com/sachinchoolur/lightslider/issues/118
						slideMargin: 0,
						mode: "slide",
						auto: true,
						loop: true,
						slideEndAnimatoin: false,
						slideEndAnimation: false,
						pause: 5000,
						adaptiveHeight: true,
						},
					selfData = self.data(),
					responsiveitem = (parseInt(selfData.responsiveitem)) ? parseInt(selfData.responsiveitem) : 2,
					breakpoint = (parseInt(selfData.breakpoint)) ? parseInt(selfData.breakpoint) : 960,
					customs = {
						item: selfData.item,
						slideMove: selfData.slidemove,
						slideMargin: selfData.slidemargin,
						mode: selfData.mode,
						auto: selfData.auto,
						loop: selfData.loop,
						slideEndAnimatoin: selfData.slideendanimation,
						slideEndAnimation: selfData.slideendanimation,
						pause: selfData.pause,
						adaptiveHeight: selfData.adaptiveheight,
						};
				$.extend(settings,customs);
				if( settings.item >= 2 ) { /* Its a carousel */
					settings.responsive =  [ {	breakpoint: breakpoint,
												settings: {
													item: responsiveitem,
													}
												}, ];
				}
				self.lightSlider(settings);
			});
		}
	}

	/*** Superfish Navigation ***/

	if( 'undefined' == typeof hootubixData || 'undefined' == typeof hootubixData.superfish || 'enable' == hootubixData.superfish ) {
		if (typeof $.fn.superfish != 'undefined') {
			$('.sf-menu').superfish({
				delay: 500,						// delay on mouseout 
				animation: {height: 'show'},	// animation for submenu open. Do not use 'toggle' #bug
				animationOut: {opacity:'hide'},	// animation for submenu hide
				speed: 200,						// faster animation speed 
				speedOut: 'fast',				// faster animation speed
				disableHI: false,				// set to true to disable hoverIntent detection // default = false
			});
		}
	}

	/*** Responsive Navigation ***/

	if( 'undefined' == typeof hootubixData || 'undefined' == typeof hootubixData.menuToggle || 'enable' == hootubixData.menuToggle ) {
		var $html = $('html');
		if ( $('#wpadminbar').length ) $html.addClass('has-adminbar');
		$( '.menu-toggle' ).click( function(event) {
			event.preventDefault();
			var $menuToggle = $(this),
				$navMenu = $menuToggle.parent(),
				$menuItems = $menuToggle.siblings('.menu-items'),
				isFixedMenu = $navMenu.is('.mobilemenu-fixed');
			$menuToggle.toggleClass( 'active' );
			if ( isFixedMenu ) {
				$html.toggleClass( 'fixedmenu-open' );
				$navMenu.toggleClass( 'mobilemenu-open' ); // Redundant as css animation moved to js: used for z-index in themes with dual menus BMUMBDNx
				if( $menuToggle.is('.active') ) {
					$menuItems.show().css( 'left', '-' + $menuItems.outerWidth() + 'px' ).animate( {left:0}, 300 );
					$menuToggle.animate( { left: $menuItems.width() + 'px' }, 300 );
				} else {
					$menuItems.animate( { left: '-' + $menuItems.outerWidth() + 'px' }, 300, function(){ $menuItems.hide(); } );
					$menuToggle.animate( { left: '0' }, 300 );
				}
			} else {
				$menuItems.css( 'left', 'auto' ).slideToggle(); // add left:auto to override inline left from fixed menu in customizer screen: added for brevity only
			}
		});
		$('body').click(function (e) {
			if ( $html.is('.fixedmenu-open') && !$(e.target).is( '.nav-menu *, .nav-menu' ) )
				$( '.menu-toggle.active' ).click();
		});
	}

	/*** Mobile menu - Modal Focus ***/
	// @todo: fix for themes with dual menus BMUMBDNx
	// @todo: bugfix: when $lastItem does not have href, focus shifts from <a> with href to
	//                next element in document i.e. outside menu (doesnt even close it)
	function keepFocusInMenu(){
		var _doc = document,
			$menu = $('.nav-menu'),
			$menuels = $menu.find( 'input, a, button' ),
			$toggle = $menu.children('.menu-toggle'),
			$lastItem = $menu.find('.menu-items > li > a');
		_doc.addEventListener( 'keydown', function( event ) {
			if ( window.matchMedia( '(max-width: 969px)' ).matches ) {
				var activeEl = _doc.activeElement,
					toggle = $toggle[0],
					menuOpen = $toggle.is('.active'),
					lastEl = $menuels[ $menuels.length - 1 ],
					lastItem = $lastItem[0],
					tabKey = event.keyCode === 9,
					shiftKey = event.shiftKey;
				if ( tabKey && !shiftKey && lastEl === activeEl ) {
					event.preventDefault();
					toggle.focus();
				}
				if ( tabKey && shiftKey && toggle === activeEl && menuOpen ) {
					event.preventDefault();
					$lastItem.focus();
				}
			}
		});
	}
	keepFocusInMenu();

	/*** Header Serach ***/
	var $headerSearchContainer = $('.header-aside-search');
	if ($headerSearchContainer.length) {
		$('.header-aside-search i.fa-search').on('click', function(){
			$headerSearchContainer.toggleClass('expand');
		});
		$('.header-aside-search .searchtext').on({
			focus: function() { $headerSearchContainer.addClass('expand'); }
			// , blur: function() { $headerSearchContainer.removeClass('expand'); }
		});
	}

	/*** Responsive Videos : Target your .container, .wrapper, .post, etc. ***/

	if( 'undefined' == typeof hootubixData || 'undefined' == typeof hootubixData.fitVids || 'enable' == hootubixData.fitVids ) {
		if (jQuery.fn.fitVids)
			$("#content").fitVids();
	}

});