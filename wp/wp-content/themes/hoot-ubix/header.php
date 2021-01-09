<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?> class="no-js">

<head>
<?php
// Fire the wp_head action required for hooking in scripts, styles, and other <head> tags.
wp_head();
?>
</head>

<body <?php hybridextend_attr( 'body' ); ?>>

	<?php wp_body_open(); ?>

	<a href="#main" class="screen-reader-text"><?php _e( 'Skip to content', 'hoot-ubix' ); ?></a>

	<div <?php hybridextend_attr( 'page-wrapper' ); ?>>

		<?php
		// Template modification Hook
		do_action( 'hootubix_template_site_start' );

		// Display Topbar
		get_template_part( 'template-parts/topbar' );
		?>

		<header <?php hybridextend_attr( 'header' ); ?>>

			<?php
			// Display Secondary Menu
			hootubix_secondary_menu( 'top' );
			?>

			<div <?php hybridextend_attr( 'header-part', 'primary' ); ?>>
				<div class="hgrid">
					<div class="table hgrid-span-12">
						<?php
						// Display Branding
						hootubix_header_branding();

						// Display Menu
						hootubix_header_aside();
						?>
					</div>
				</div>
			</div>

			<?php
			// Display Secondary Menu
			hootubix_secondary_menu( 'bottom' );
			?>

		</header><!-- #header -->

		<?php hybridextend_get_sidebar( 'below-header' ); // Loads the template-parts/sidebar-below-header.php template. ?>

		<div <?php hybridextend_attr( 'main' ); ?>>
			<?php
			// Template modification Hook
			do_action( 'hootubix_template_main_wrapper_start' );