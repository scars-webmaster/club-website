<?php

// Get Page Layout
if( ! function_exists( 'ilovewp_helper_get_page_layout' ) ) {
	function ilovewp_helper_get_page_layout() {

		$default_position = '';

		if ( !is_active_sidebar( 'sidebar-main' ) && 1 != get_theme_mod( 'faith_single_dynamic_menu', 1 ) ) {
			$default_position = 'page-no-sidebar';
		}

		if ( !is_page() && !is_active_sidebar( 'sidebar-main' ) ) {
			$default_position = 'page-no-sidebar';
		}

		if ( is_page() ) {
			if ( !is_active_sidebar( 'sidebar-main' ) && 1 == get_theme_mod( 'faith_single_dynamic_menu', 1 ) ) {
				
				global $post;
				wp_reset_postdata();
				$parent_id = $post->post_parent;

				if ($parent_id == 0) {
					$child_of = $post->ID;
				} // if no parent
				else {
					$child_of = $parent_id;
				}

				$children_pages = get_pages( array( 'parent' => absint($child_of), 'child_of' => absint($child_of), 'sort_column' => 'menu_order', 'sort_order' => 'ASC' ) );
				$children_pages_count = count($children_pages);

				if ($children_pages_count <= 1 && $parent_id != 0) {
					unset($children_pages);
					$child_of = wp_get_post_parent_id($parent_id);
					if ($child_of != 0) {
						$children_pages = get_pages( array( 'parent' => absint($child_of), 'child_of' => absint($child_of), 'sort_column' => 'menu_order', 'sort_order' => 'ASC' ) );
						$children_pages_count = count($children_pages);
					}
				} 

				if ( $children_pages_count <= 1 ) {
					$default_position = 'page-no-sidebar';
				}

			}
		}

		return $default_position;
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