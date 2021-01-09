<?php
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

function edupress_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

    if ( is_page() && !comments_open() && '0' == get_comments_number() ) {
		$classes[] = 'comments-closed';
    }

    $classes[] = ilovewp_helper_get_header_style();
    $classes[] = ilovewp_helper_get_sidebar_position();

	return $classes;
}

add_filter( 'body_class', 'edupress_body_classes' );