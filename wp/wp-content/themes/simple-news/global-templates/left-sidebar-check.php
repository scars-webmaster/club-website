<?php
/**
 * Left sidebar check
 *
 * @package SimpleNews
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$simplenews_sidebar_pos = get_theme_mod( 'simplenews_sidebar_position' );

if ( 'left' === $simplenews_sidebar_pos || 'both' === $simplenews_sidebar_pos ) {
	get_template_part( 'sidebar-templates/sidebar', 'left' );
}
?>

<div class="col col-sm-12 col-md order-1 order-md-2 order-lg-1 content-area" id="primary">
