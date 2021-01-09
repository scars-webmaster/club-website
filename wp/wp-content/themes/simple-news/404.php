<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package SimpleNews
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$simplenews_container = get_theme_mod( 'simplenews_container_type' );
?>

<div class="wrapper" id="error-404-wrapper">

	<div class="<?php echo esc_attr( $simplenews_container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

				<main class="site-main" id="main">

					<section class="error-404 not-found">

						<header class="page-header">

							<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'simple-news' ); ?></h1>

						</header><!-- .page-header -->

						<div class="page-content">

							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'simple-news' ); ?></p>

							<?php get_template_part('searchform','big'); ?>

						</div><!-- .page-content -->

						<div class="border-bottom my-4 d-md-none"></div>

					</section><!-- .error-404 -->

				</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #error-404-wrapper -->

<?php get_footer();
