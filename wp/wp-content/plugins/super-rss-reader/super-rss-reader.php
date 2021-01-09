<?php
/*
 * Plugin Name: Super RSS Reader
 * Plugin URI: https://www.aakashweb.com/wordpress-plugins/super-rss-reader/
 * Description: Display any RSS feed(s) in widget with news ticker effect in multiple tabs, thumbnails, customizable color themes and more.
 * Author: Aakash Chakravarthy
 * Author URI: https://www.aakashweb.com/
 * Version: 4.0
 * Text Domain: super-rss-reader
 * Domain Path: /languages
 */

define( 'SRR_VERSION', '4.0' );
define( 'SRR_PATH', plugin_dir_path( __FILE__ ) ); // All have trailing slash
define( 'SRR_URL', plugin_dir_url( __FILE__ ) );
define( 'SRR_BASE_NAME', plugin_basename( __FILE__ ) );

final class Super_RSS_Reader{

    public static function init(){

        self::includes();

        add_action( 'plugins_loaded', array( __CLASS__, 'load_text_domain' ) );

    }

    public static function includes(){

        include_once( SRR_PATH . 'includes/options.php' );
        include_once( SRR_PATH . 'includes/feed.php' );
        include_once( SRR_PATH . 'includes/widget.php' );
        include_once( SRR_PATH . 'includes/widget-admin.php' );

    }

    public static function load_text_domain(){

        load_plugin_textdomain( 'super-rss-reader', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );

    }

}

Super_RSS_Reader::init();

?>