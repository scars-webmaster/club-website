<?php
/*
Plugin Name: ICS Calendar
Plugin URI:
Description: Embed a live updating iCal (ICS) feed in any page using a shortcode.
Version: 6.4.0
Author: Room 34 Creative Services, LLC
Author URI: https://room34.com
License: GPL2
Text Domain: r34ics
Domain Path: /i18n/languages/
*/


// Don't load directly
if (!defined('ABSPATH')) { exit; }


// Load required files
require_once(plugin_dir_path(__FILE__) . 'class-r34ics.php');
require_once(plugin_dir_path(__FILE__) . 'functions.php');


// Initialize plugin
add_action('plugins_loaded', function() {
	global $R34ICS;
	$R34ICS = new R34ICS();
});


// Load text domain for translations
add_action('plugins_loaded', function() {
	load_plugin_textdomain('r34ics', false, basename(plugin_dir_path(__FILE__)) . '/i18n/languages/');
});


// Flush rewrite rules when plugin is activated
register_activation_hook(__FILE__, function() { flush_rewrite_rules(); });


// Install/upgrade
register_activation_hook(__FILE__, 'r34ics_install');
add_action('plugins_loaded', function() {
	global $R34ICS;
	if (isset($R34ICS) && get_option('r34ics_version') != @$R34ICS->version) {
		r34ics_install();
	}
}, 11);


// Plugin installation
// See: https://codex.wordpress.org/Creating_Tables_with_Plugins
function r34ics_install() {
	global $R34ICS;
	// Update version
	if (isset($R34ICS)) {
		update_option('r34ics_version', @$R34ICS->version);
		// Version-specific changes
		if (@$R34ICS->version == '5.6.0') {
			update_option('r34ics_transient_expiration', 3600);
		}
	}
}

