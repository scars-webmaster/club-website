<?php
/**
 * The template for displaying the author pages
 *
 * Learn more: https://codex.wordpress.org/Author_Templates
 *
 * @package SimpleNews
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$simplenews_container = get_theme_mod( 'simplenews_container_type' );

global $wp_query;
$simplenews_multiple_post = ($wp_query->post_count >= 3);
?>

<div class="wrapper" id="author-wrapper">

	<div class="<?php echo esc_attr( $simplenews_container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<header class="page-header author-header">

					<?php
					if ( isset( $_GET['author_name'] ) ) {
						$curauth = get_user_by( 'slug', $author_name );
					} else {
						$curauth = get_userdata( intval( $author ) );
					}
					?>

					<h1 class="border-bottom mb-12px"><?php echo esc_html_e( 'About:', 'simple-news' ), ' ', esc_html( $curauth->display_name ); ?></h1>

					<?php if ( ! empty( $curauth->ID ) ) : ?>
						<?php echo get_avatar( $curauth->ID, '', '', '', $args = array('class' => 'float-right ml-3') ); ?>
					<?php endif; ?>

					<?php if ( ! empty( $curauth->user_url ) || ! empty( $curauth->description ) ) : ?>
						<dl>
							<?php if ( ! empty( $curauth->user_url ) ) : ?>
								<dt><?php esc_html_e( 'Website', 'simple-news' ); ?></dt>
								<dd>
									<a href="<?php echo esc_url( $curauth->user_url ); ?>"><?php echo esc_html( $curauth->user_url ); ?></a>
								</dd>
							<?php endif; ?>

							<?php if ( ! empty( $curauth->description ) ) : ?>
								<dt><?php esc_html_e( 'Profile', 'simple-news' ); ?></dt>
								<dd><?php echo esc_html( $curauth->description ); ?></dd>
							<?php endif; ?>
						</dl>
					<?php endif; ?>

				</header><!-- .page-header -->

				<?php if ( have_posts() ) : ?>

				<h2><?php echo esc_html_e( 'Posts by', 'simple-news' ), ' ', esc_html( $curauth->display_name ); ?>:</h2>

				<div class="clearfix pb-3"></div>

				<?php if ($simplenews_multiple_post): ?>

					<div class="card-columns">

					<?php else: ?>

					<div class="full-width-content">

				<?php endif; ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'loop-templates/content', get_post_format() ); ?>

				<?php endwhile; ?>

				</div>

				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php simplenews_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div> <!-- .row -->

	</div><!-- #content -->

</div><!-- #author-wrapper -->

<?php get_footer();
