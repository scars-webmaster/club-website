<?php
//

// Post Next/Previous navigation
if( ! function_exists( 'ilovewp_helper_display_post_navigation' ) ) {
	function ilovewp_helper_display_post_navigation($post) {

		if( ! is_object( $post ) ) return;

		if ( get_post_type($post->ID) == 'post' ) { 

			$output = '';
			$output .= '<div class="post-navigation">';
			$output .= '<div class="site-post-nav-item site-post-nav-prev">' . get_previous_post_link( '<span class="post-navigation-label">' . __('Previous Article', 'edupress') . '</span>' . '%link', '%title', true ) . '</div><!-- .site-post-nav-item -->';
			$output .= '<div class="site-post-nav-item site-post-nav-next">' . get_next_post_link( '<span class="post-navigation-label">' . __('Next Article', 'edupress') . '</span>' . '%link', '%title', true ) . '</div><!-- .site-post-nav-item -->';
			$output .= '</div><!-- .post-navigation -->';

			return $output;

		}

	}
}

// Get Header Style
if( ! function_exists( 'ilovewp_helper_get_header_style' ) ) {
	function ilovewp_helper_get_header_style() {

		$themeoptions_header_style = esc_attr(get_theme_mod( 'theme-header-style', 'default' ));

		if ( $themeoptions_header_style == 'default' ) {
			$default_position = 'page-header-default';
		} elseif ( $themeoptions_header_style == 'centered' ) {
			$default_position = 'page-header-centered';
		}

		return $default_position;
	}
}

// Get Sidebar Position for Current Page or Post
if( ! function_exists( 'ilovewp_helper_get_sidebar_position' ) ) {
	function ilovewp_helper_get_sidebar_position() {

		global $post;

		$themeoptions_sidebar_position = esc_attr(get_theme_mod( 'theme-sidebar-position', 'left' ));

		if ( $themeoptions_sidebar_position == 'left' ) {
			$default_position = 'page-sidebar-left';
		} elseif ( $themeoptions_sidebar_position == 'right' ) {
			$default_position = 'page-sidebar-right';
		}

		return $default_position;
	}
}