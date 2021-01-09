<?php
/**
 * Miscellaneous functions
 *
 * @package SimpleNews
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_filter( 'widget_tag_cloud_args', 'simplenews_tag_cloud_font_sizes' );
function simplenews_tag_cloud_font_sizes( array $args ) {
    $args['smallest'] = '.875';
    $args['largest'] = '.875';
    $args['unit'] = 'rem';
    $args['separator'] = '';
    return $args;
}

add_filter( 'wp_generate_tag_cloud', 'simplenews_add_class_tag_cloud', 10, 1 );
function simplenews_add_class_tag_cloud( $string ) {
   return str_replace( 'class="tag-cloud-link', 'class="btn tag-cloud-link mr-1 mb-6px p-1', $string );
}

add_filter( "the_excerpt", "simplenews_add_class_to_excerpt" );
function simplenews_add_class_to_excerpt( $excerpt ) {
    return str_replace( '<p', '<p class="mb-2"', $excerpt );
}

if ( ! function_exists( 'simplenews_edit_link' ) ) :
/**
 * Returns an accessibility-friendly link to edit a post or page or attachment
 */
function simplenews_edit_link() {
	$link = edit_post_link(
		sprintf(
			/* translators: %s: Name of current page */
			__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'simple-news' ),
			get_the_title()
		),
		'<footer class="entry-footer mt-3 pt-12px pb-12px border-top small"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> ',
		'</footer>'
	);
	return $link;
}
endif;
