<?php
/**
 * The template for displaying all pages
 * 
 * @subpackage gurukul-education
 * @since 1.0
 * @version 1.4
 */

get_header(); ?>

<?php do_action( 'gurukul_education_page_header' ); ?>

<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'page' );

				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main>
	</div>
</div>

<?php do_action( 'gurukul_education_page_footer' ); ?>

<?php get_footer();
