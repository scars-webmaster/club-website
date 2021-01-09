<?php

// Template modification Hook
do_action( 'hootubix_template_before_menu', 'secondary');

if ( has_nav_menu( 'hoot-secondary' ) ) : // Check if there's a menu assigned to the 'secondary' location.

	?>
	<div class="screen-reader-text"><?php _e( 'Secondary Navigation Menu', 'hoot-ubix' ); ?></div>
	<nav <?php hybridextend_attr( 'menu', 'secondary' ); ?>>
		<a class="menu-toggle" href="#"><span class="menu-toggle-text"><?php _e( 'Menu', 'hoot-ubix' ); ?></span><i class="fas fa-bars"></i></a>

		<?php
		/* Create Menu Args Array */
		$menu_args = array(
			'theme_location'  => 'hoot-secondary',
			'container'       => false,
			'menu_id'         => 'menu-secondary-items',
			'menu_class'      => 'menu-items sf-menu menu',
			'fallback_cb'     => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			);

		/* Display Main Menu */
		wp_nav_menu( $menu_args ); ?>

	</nav><!-- #menu-secondary -->
	<?php

endif; // End check for menu.

// Template modification Hook
do_action( 'hootubix_template_after_menu', 'secondary');