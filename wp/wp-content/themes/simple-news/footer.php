<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SimpleNews
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$simplenews_container = get_theme_mod( 'simplenews_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="pt-3 pb-3 bg-primary" id="wrapper-footer">

	<div class="<?php echo esc_attr( $simplenews_container ); ?>">

		<div class="row">

			<div class="col">

				<footer class="site-footer" id="colophon">

					<div class="site-info text-center small">

						<?php simplenews_site_info(); ?>

					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<button onclick="simplenewsTopFunction()" id="simplenewsTopBtn" title="<?php esc_attr_e( 'Scroll To Top', 'simple-news' )?>" type="button" class="btn btn-primary btn-lg rounded-circle btn-fixed-btm" tabindex="-1">
	<i class="fa fa-arrow-up" aria-hidden="true"></i>
</button>

<?php wp_footer(); ?>

</body>

</html>

