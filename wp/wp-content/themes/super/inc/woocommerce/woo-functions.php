<?php if( ! defined( 'ABSPATH' ) ) exit;

/*************************************
* WooCommerce Customize Restrictions After Version 3.3.0 
**************************************/

function super_woocommerce_support() {
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 150,
		'single_image_width'    => 300,

        'product_grid'          => array(
            'default_rows'    => 4,
            'min_rows'        => 2,
            'max_rows'        => 100,
            'default_columns' => 4,
            'min_columns'     => 1,
            'max_columns'     => 6,
        ),
	) );
}
add_action( 'after_setup_theme', 'super_woocommerce_support' );