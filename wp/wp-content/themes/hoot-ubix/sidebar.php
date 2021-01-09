<?php

global $hootubix_theme;

// Dispay Sidebar if not a one-column layout
$sidebar_size = hootubix_main_layout( 'sidebar' );
if ( !empty( $sidebar_size ) ) :
?>

	<aside <?php hybridextend_attr( 'sidebar', 'primary' ); ?>>

		<?php

		// Template modification Hook
		do_action( 'hootubix_template_sidebar_start', 'primary' );

		if ( is_active_sidebar( 'hoot-primary-sidebar' ) ) : // If the sidebar has widgets.

			dynamic_sidebar( 'hoot-primary-sidebar' ); // Displays the primary sidebar.

		elseif ( current_user_can( 'edit_theme_options' ) && hybrid_widget_exists( 'WP_Widget_Text' ) ): // plugins like AMP can replace Text widget in widget factory

			the_widget(
				'WP_Widget_Text',
				array(
					'title'  => __( 'Example Widget', 'hoot-ubix' ),
					/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
					'text'   => sprintf( __( 'This is an example widget to show how the Primary sidebar looks by default. You can add custom widgets from the %1$swidgets screen%2$s in wp-admin.', 'hoot-ubix' ), '<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '">', '</a>' ),
					'filter' => true,
				),
				array(
					'before_widget' => '<section class="widget widget_text">',
					'after_widget'  => '</section>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>'
				)
			);

		endif; // End widgets check.

		// Template modification Hook
		do_action( 'hootubix_template_sidebar_end', 'primary' );

		?>

	</aside><!-- #sidebar-primary -->

	<?php
	// Display second sidebar if its a 2 column layout
	if ( $hootubix_theme->currentlayout['layout'] == 'narrow-left-left' || $hootubix_theme->currentlayout['layout'] == 'narrow-left-right' || $hootubix_theme->currentlayout['layout'] == 'narrow-right-right' ) :
	?>

		<aside <?php hybridextend_attr( 'sidebar', 'secondary' ); ?>>

			<?php

			// Template modification Hook
			do_action( 'hootubix_template_sidebar_start', 'secondary' );

			if ( is_active_sidebar( 'hoot-secondary-sidebar' ) ) : // If the sidebar has widgets.

				dynamic_sidebar( 'hoot-secondary-sidebar' ); // Displays the secondary sidebar.

			elseif ( current_user_can( 'edit_theme_options' ) && hybrid_widget_exists( 'WP_Widget_Text' ) ): // plugins like AMP can replace Text widget in widget factory

				the_widget(
					'WP_Widget_Text',
					array(
						'title'  => __( 'Example Widget', 'hoot-ubix' ),
						/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
						'text'   => sprintf( __( 'This is an example widget to show how the Secondary sidebar looks by default. You can add custom widgets from the %1$swidgets screen%2$s in wp-admin.', 'hoot-ubix' ), '<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '">', '</a>' ),
						'filter' => true,
					),
					array(
						'before_widget' => '<section class="widget widget_text">',
						'after_widget'  => '</section>',
						'before_title'  => '<h3 class="widget-title">',
						'after_title'   => '</h3>'
					)
				);

			endif; // End widgets check.

			// Template modification Hook
			do_action( 'hootubix_template_sidebar_end', 'secondary' );

			?>

		</aside><!-- #sidebar-secondary -->

	<?php
	endif;
	?>

<?php
endif; // End layout check.