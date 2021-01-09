<?php
/**
 * Template Name: Both Sidebars No Title
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

<?php if ( is_front_page() ) : ?>
	<?php get_template_part( 'global-templates/hero' ); ?>
<?php endif; ?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $simplenews_container ); ?>" id="content">

		<div class="row">

			<?php get_template_part( 'sidebar-templates/sidebar', 'left' ); ?>

			<div class="col col-sm-12 col-md order-1 order-md-2 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php
					while ( have_posts() ) {
						the_post();

						get_template_part( 'loop-templates/content', 'notitle' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					}
					?>

				</main><!-- #main -->

			</div><!-- #primary -->

			<?php get_template_part( 'sidebar-templates/sidebar', 'right' ); ?>
			
		</div><!-- .row -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php
get_footer();