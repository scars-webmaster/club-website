<?php
/**
 * This file handles how Archives will look like.
 */
get_header();
?>
    <!--col-md-9 start-->
    <div class="col-md-9">
     <header class="page-title">
			 <h1 class="page-title">
					<?php
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'plain-blog' ), get_the_date() );

						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'plain-blog' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'plain-blog' ) ) );

						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'plain-blog' ), get_the_date( _x( 'Y', 'yearly archives date format', 'plain-blog' ) ) );

						else :
							_e( 'Archives', 'plain-blog' );

						endif;
					?>
				</h1>
       </header>
                  <?php
        if(have_posts()) {
            while(have_posts()) {
                the_post();
                get_template_part('content');
            }
        }
        ?>

        <!--pagination start-->
        <?php plain_blog_numeric_posts_nav(); ?>
        <!--pagination end-->
    </div> <!--col-md-9 end-->

<?php get_sidebar(); ?>
<?php
get_footer();