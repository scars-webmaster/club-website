<?php

//////////////////////////////////////////////////////////////
//===========================================================
// class.php
//===========================================================
// PAGELAYER
// Inspired by the DESIRE to be the BEST OF ALL
// ----------------------------------------------------------
// Started by: Pulkit Gupta
// Date:       23rd Jan 2017
// Time:       23:00 hrs
// Site:       http://pagelayer.com/wordpress (PAGELAYER)
// ----------------------------------------------------------
// Please Read the Terms of use at http://pagelayer.com/tos
// ----------------------------------------------------------
//===========================================================
// (c)Pagelayer Team
//===========================================================
//////////////////////////////////////////////////////////////

// Are we being accessed directly ?
if(!defined('PAGELAYER_VERSION')) {
	exit('Hacking Attempt !');
}

// PageLayer Class
class PageLayer{

	// All Settings
	var $settings = array();

	// Cache
	var $cache = array();

	// Common Styles Params
	var $styles = array();

	// All Shortcodes
	var $shortcodes = array();

	// All Shortcodes Groups
	var $groups = array();

	// Builder definition
	var $builder = array();

	// The Lang Strings
	var $l = array();
	
	// Runtime fonts
	var $runtime_fonts = array();

	// Array of all the template paths
	var $all_template_paths = array();

	// Tabs visible in the left panel
	var $tabs = ['settings', 'options'];

	// Tabs visible in the left panel
	var $screens = ['desktop' => '', 'tablet' => 'tablet', 'mobile' => 'mobile'];

	// Icons set
	var $icons = ['font-awesome5'];
	
	// For exporting templates
	var $media_to_export = array();
	
	// For global widget
	var $global_widgets = array();
	
	// For global section
	var $global_sections = array();
	
	// For saved sections
	var $saved_sections = array();
	
	var $css = array();
	var $css_settings = array();

	function __construct() {

		// Load the langs
		$this->l = @file_get_contents(PAGELAYER_DIR.'/languages/en.json');
		$this->l = @json_decode($this->l, true);
		
		// Add after plugins_loaded
		add_action('plugins_loaded', [ $this, 'load_extra_languages' ], 11);
		
		// Array of font options
		$this->css_settings = ['body' => ['name' => 'Body', 'key' => 'pagelayer_body_typography'],
			'header' => ['name' => 'Site Header', 'sel' => '> header'],
			'main' => ['name' => 'Site Main', 'sel' => '.site-main'],
			'footer' => ['name' => 'Site Footer', 'sel' => '> footer'],
			'entry-header' => ['name' => 'Content Header', 'sel' => '.entry-header'],
			'entry-content' => ['name' => 'Content', 'sel' => '.entry-content'],
			'entry-footer' => ['name' => 'Content Footer', 'sel' => '.entry-footer'],
			'p' => ['name' => 'Paragraph'],
			'aside' => ['name' => 'Sidebar'],
			'a' => ['name' => 'Link'],
			'a-hover' => ['name' => 'Link Hover', 'sel' => 'a:hover'],
			'h1' => ['name' => 'H1', 'key' => 'pagelayer_h1_typography'],
			'h2' => ['name' => 'H2', 'key' => 'pagelayer_h2_typography'],
			'h3' => ['name' => 'H3', 'key' => 'pagelayer_h3_typography'],
			'h4' => ['name' => 'H4', 'key' => 'pagelayer_h4_typography'],
			'h5' => ['name' => 'H5', 'key' => 'pagelayer_h5_typography'],
			'h6' => ['name' => 'H6', 'key' => 'pagelayer_h6_typography'],
			'b' => ['name' => 'Bold', 'sel' => 'strong, b'],
			'i' => ['name' => 'Italics', 'sel' => 'em, i'],
		];
	}
	
	function load_extra_languages(){
		
		if(defined('SITEPAD')){
			$this->l['email_desc'] = 'To change the email, visit your '.BRAND_SM.' Dashboard -> Settings -> Editor Settings';
			$this->l['CMA_desc'] = 'To change text, visit your '.BRAND_SM.' Dashboard -> Settings -> Editor Settings';
		}
		
	}

}