<?php
/**
 * Template Name: Right Sidebar Layout
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package SimpleNews
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$simplenews_container = get_theme_mod( 'simplenews_container_type' );
?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $simplenews_container ); ?>" id="content">

		<div class="row">

			<div class="col col-sm-12 col-md order-1 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php
					while ( have_posts() ) {
						the_post();

						get_template_part( 'loop-templates/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					}
					?>

				</main><!-- #main -->

			</div><!-- #primary -->

			<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
				<div class="col-md-5 col-lg-4 col-xl-3 widget-area order-3"><?php dynamic_sidebar( 'right-sidebar' ); ?></div>
			<?php endif ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();