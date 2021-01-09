<?php
/**
 * Right sidebar check
 *
 * @package SimpleNews
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

</div><!-- #closing the primary container from /global-templates/left-sidebar-check.php -->

<?php
$simplenews_sidebar_pos = get_theme_mod( 'simplenews_sidebar_position' );

if ( 'right' === $simplenews_sidebar_pos || 'both' === $simplenews_sidebar_pos ) {
	get_template_part( 'sidebar-templates/sidebar', 'right' );
}
