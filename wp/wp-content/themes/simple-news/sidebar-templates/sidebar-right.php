<?php
/**
 * The right sidebar containing the main widget area
 *
 * @package SimpleNews
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'right-sidebar' ) ) {
	return;
}

// when both sidebars turned on reduce col size to 3 from 4.
$simplenews_sidebar_pos = get_theme_mod( 'simplenews_sidebar_position' );
?>

<?php if ( ( is_active_sidebar( 'left-sidebar' ) && 'both' === $simplenews_sidebar_pos ) ) : ?>
<div class="col-sm-6 col-md-4 col-lg-3 col-xxl-2 widget-area order-3" id="right-sidebar" role="complementary">

<?php else : ?>
<div class="col-md-4 col-lg-3 col-xxl-2 widget-area order-3" id="right-sidebar" role="complementary">

<?php endif; ?>

<?php dynamic_sidebar( 'right-sidebar' ); ?>

</div><!-- #right-sidebar -->
