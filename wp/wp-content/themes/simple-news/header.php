<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package SimpleNews
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$simplenews_container = get_theme_mod( 'simplenews_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php simplenews_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'simple-news' ); ?></a>

		<nav id="main-nav" class="navbar navbar-expand-xl navbar-dark bg-primary" aria-labelledby="main-nav-label">

		<h2 id="main-nav-label" class="sr-only">
			<?php esc_html_e( 'Main Navigation', 'simple-news' ); ?>
		</h2>

		<div class="<?php echo esc_attr( $simplenews_container ); ?>">

					<!-- Your site title as branding in the menu -->
					<?php if ( ! has_custom_logo() ) { ?>

						<?php if ( is_front_page() && is_home() ) : ?>

							<h1 class="navbar-brand mb-0 mr-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a><span class="site-description"><?php bloginfo( 'description' ); ?></span></h1>

						<?php else : ?>

							<div class="navbar-brand mr-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a><span class="site-description"><?php bloginfo( 'description' ); ?></span></div>

						<?php endif; ?>

					<?php } else {
						the_custom_logo();
					} ?><!-- end custom logo -->

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'simple-news' ); ?>">
					<i class="fa fa-bars" aria-hidden="true"></i>
				</button>

				<!-- The WordPress Menu goes here -->
				<?php wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav ml-auto',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new Simplenews_WP_Bootstrap_Navwalker(),
					)
				); ?>

				<button type="button" id="simplenewsSearchBtn" aria-label="<?php esc_attr_e( 'Open pop up search form', 'simple-news' )?>" class="btn btn-primary btn-lg rounded-circle btn-fixed-btm d-md-none" data-toggle="modal" data-target="#simplenewsSearchModal">
					<i class="fa fa-search" aria-hidden="true"></i>
				</button>
				<!-- Modal -->
				<div class="modal fade" id="simplenewsSearchModal" tabindex="-1" aria-labelledby="simplenewsSearchModal" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered">
				    <div class="modal-content">
				      <div class="modal-body p-2">
				        <?php get_template_part('searchform','modal'); ?>
				      </div>
				    </div>
				  </div>
				</div>

			</div><!-- .container -->

		</nav><!-- .site-navigation -->

	</div><!-- #wrapper-navbar end -->
