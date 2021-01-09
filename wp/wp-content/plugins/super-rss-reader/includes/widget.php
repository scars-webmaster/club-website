<?php
/**
* Contains the widget admin and its registration
*
*/

if( ! defined( 'ABSPATH' ) ) exit;

class SRR_Widget{
    
    public static function init(){

        add_action( 'widgets_init', array( __CLASS__, 'init_widget' ) );

        add_action( 'wp_enqueue_scripts', array( __CLASS__, 'public_scripts' ) );

        add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_scripts' ) );

        add_filter( 'plugin_action_links_' . SRR_BASE_NAME, array( __CLASS__, 'action_links' ) );

    }

    public static function init_widget(){

        register_widget( 'super_rss_reader_widget' );

    }

    public static function public_scripts(){

        wp_enqueue_script( 'jquery-easy-ticker', SRR_URL . 'public/js/jquery.easy-ticker.min.js', array( 'jquery' ), SRR_VERSION );
        wp_enqueue_script( 'super-rss-reader', SRR_URL . 'public/js/script.min.js', array( 'jquery' ), SRR_VERSION );

        wp_enqueue_style( 'super-rss-reader', SRR_URL . 'public/css/style.min.css', array(), SRR_VERSION );

    }

    public static function admin_scripts( $hook ){

        if( $hook == 'widgets.php' ){
            wp_enqueue_style( 'srr_admin_css', SRR_URL . 'admin/css/style-widget.css', array(), SRR_VERSION );
            wp_enqueue_script( 'srr_admin_js', SRR_URL . 'admin/js/script-widget.js', array( 'jquery' ), SRR_VERSION );
        }

    }

    public static function render_feed( $options ){

        $feed = new SRR_Feed( $options );
        echo $feed->html();

    }

    public static function action_links( $links ){
        array_unshift( $links, '<a href="https://www.aakashweb.com/wordpress-plugins/super-rss-reader-pro/?utm_source=admin&utm_medium=plugin-list&utm_campaign=srr-pro" target="_blank"><b>' . __( 'Upgrade to PRO', 'super-rss-reader' ) . '</b></a>' );
        return $links;
    }

}

SRR_Widget::init();

?>