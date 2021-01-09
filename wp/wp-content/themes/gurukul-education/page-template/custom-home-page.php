<?php
/**
 * Template Name: Custom Home
 */

get_header(); ?>

<?php do_action( 'gurukul_education_above_slider' ); ?>
	
<section id="slider" class="white-border1">
  	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
	    <?php $gurukul_education_slider_pages = array();
	      	for ( $count = 1; $count <= 4; $count++ ) {
		        $mod = intval( get_theme_mod( 'gurukul_education_slider' . $count ));
		        if ( 'page-none-selected' != $mod ) {
		          	$gurukul_education_slider_pages[] = $mod;
		        }
	      	}
	      	if( !empty($gurukul_education_slider_pages) ) :
		        $args = array(
		          	'post_type' => 'page',
		          	'post__in' => $gurukul_education_slider_pages,
		          	'orderby' => 'post__in'
		        );
		        $query = new WP_Query( $args );
	        if ( $query->have_posts() ) :
	          $i = 1;
	    ?>     
	    <div class="carousel-inner" role="listbox">
	      	<?php  while ( $query->have_posts() ) : $query->the_post(); ?>
	        <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
	          	<a href="<?php echo esc_url( get_permalink() );?>"><?php the_post_thumbnail(); ?></a>
	          	<div class="carousel-caption">
		            <div class="inner_carousel">
		              	<h1><?php the_title(); ?></h1>
		              	<p><?php $excerpt = get_the_excerpt(); echo esc_html( gurukul_education_string_limit_words( $excerpt,15 ) ); ?></p>	
		              	<div class="read-more">
	                    	<a href="<?php the_permalink(); ?>"><?php esc_html_e('START LEARNING NOW!','gurukul-education'); ?><span class="screen-reader-text"><?php esc_html_e('START LEARNING NOW!','gurukul-education'); ?></span></a>
	                    </div>
		            </div>
	          	</div>
	        </div>
	      	<?php $i++; endwhile; 
	      	wp_reset_postdata();?>
	    </div>
	    <?php else : ?>
	    <div class="no-postfound"></div>
	      <?php endif;
	    endif;?>
	    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	      <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
	      <span class="screen-reader-text"><?php esc_html_e( 'Prev','gurukul-education' );?></span>
	    </a>
	    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	      <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
	      <span class="screen-reader-text"><?php esc_html_e( 'Next','gurukul-education' );?></span>
	    </a>
  	</div>  
  	<div class="clearfix"></div>
</section>

<?php do_action( 'gurukul_education_above_services' ); ?>

<?php /*--OUR SERVICES--*/?>
<section id="our-services">    
    <div class="container">
    	<?php if( get_theme_mod( 'gurukul_education_section_title','' ) != '') { ?>
			<h2><?php echo esc_html( get_theme_mod('gurukul_education_section_title','')); ?></h2>
	        <p><?php echo esc_html( get_theme_mod('gurukul_education_section_subtitle','')); ?></p>
	        <hr>
	    <?php } ?>
    	<div class="row">
	    	<?php $gurukul_education_services_pages = array();
	    	for ( $count = 0; $count <= 2; $count++ ) {
		      	$mod = intval( get_theme_mod( 'gurukul_education_services' . $count ));
		     	if ( 'page-none-selected' != $mod ) {
		        	$gurukul_education_services_pages[] = $mod;
		      	}
	    	}
	    	if( !empty($gurukul_education_services_pages) ) :
	      	$args = array(
	        	'post_type' => 'page',
	        	'post__in' => $gurukul_education_services_pages,
	        	'orderby' => 'post__in'
	      	);
	      	$query = new WP_Query( $args );
	     	if ( $query->have_posts() ) :
		        $count = 0;
		        while ( $query->have_posts() ) : $query->the_post(); ?>        	
		          	<div class="col-lg-4 col-md-6">
			            <div class="service-main-box">
			                <div class="education-image text-center">
			                	<?php the_post_thumbnail(); ?>	
			                </div>
			                <div class="box-content text-center">
			                    <h3><?php the_title(); ?></h3>
			                    <p><?php $excerpt = get_the_excerpt(); echo esc_html( gurukul_education_string_limit_words( $excerpt,20 ) ); ?></p>
			                    <div class="clearfix"></div>
			                    <div class="feature-btn">
			                    	<a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','gurukul-education'); ?><span class="screen-reader-text"><?php esc_html_e( 'Read More','gurukul-education' );?></span></a>
			                    </div>
			                </div>
			            </div>
		          	</div>
		        <?php $count++; endwhile; 
		        wp_reset_postdata();?>
	      	<?php else : ?>
	          	<div class="no-postfound"></div>
	      	<?php endif;
	    	endif;?>
      		<div class="clearfix"></div>
      	</div>
 	</div> 
</section>

<?php do_action( 'gurukul_education_below_service' ); ?>

<div class="container">
  <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
</div>

<?php get_footer(); ?>