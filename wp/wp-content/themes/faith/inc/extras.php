<?php
/**
 * Adds custom classes to the array of body classes.
 *
 * @since Faith 1.0.8
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */

function faith_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

    if ( is_page() && !comments_open() && '0' == get_comments_number() ) {
		$classes[] = 'comments-closed';
    }

    if ( ilovewp_helper_get_page_layout() != '' ) { $classes[] = ilovewp_helper_get_page_layout(); }
    $classes[] = ilovewp_helper_get_header_style();

	return $classes;
}

add_filter( 'body_class', 'faith_body_classes' );