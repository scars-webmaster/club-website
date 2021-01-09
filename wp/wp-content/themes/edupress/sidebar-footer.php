<?php
if ( is_active_sidebar( 'sidebar-footer-1' ) || is_active_sidebar( 'sidebar-footer-2' ) || is_active_sidebar( 'sidebar-footer-3' ) || is_active_sidebar( 'sidebar-footer-4' ) ) :
?>

<div class="wrapper wrapper-footer">
			
	<div id="site-tertiary" class="pre-footer" role="complementary">
	
		<div class="ilovewp-columns ilovewp-columns-4 clearfix">
		
			<div class="ilovewp-column ilovewp-column-1">
			
				<div class="ilovewp-column-wrapper clearfix">
				
					<?php if ( is_active_sidebar( 'sidebar-footer-1' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
					<?php endif; ?>
				
				</div><!-- .ilovewp-column-wrapper -->
			
			</div><!-- .ilovewp-column .ilovewp-column-1 --><!-- ws fix
			
			--><div class="ilovewp-column ilovewp-column-2">
			
				<div class="ilovewp-column-wrapper clearfix">
				
					<?php if ( is_active_sidebar( 'sidebar-footer-2' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
					<?php endif; ?>
				
				</div><!-- .ilovewp-column-wrapper -->
			
			</div><!-- .ilovewp-column .ilovewp-column-2 --><!-- ws fix
			
			--><div class="ilovewp-column ilovewp-column-3">
			
				<div class="ilovewp-column-wrapper clearfix">
				
					<?php if ( is_active_sidebar( 'sidebar-footer-3' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-footer-3' ); ?>
					<?php endif; ?>
				
				</div><!-- .ilovewp-column-wrapper -->
			
			</div><!-- .ilovewp-column .ilovewp-column-3 --><!-- ws fix
			
			--><div class="ilovewp-column ilovewp-column-4">
			
				<div class="ilovewp-column-wrapper clearfix">
				
					<?php if ( is_active_sidebar( 'sidebar-footer-4' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-footer-4' ); ?>
					<?php endif; ?>
				
				</div><!-- .ilovewp-column-wrapper -->
			
			</div><!-- .ilovewp-column .ilovewp-column-4 -->
		
		</div><!-- .ilovewp-columns .ilovewp-columns-4 -->
	
	</div><!-- #site-tertiary -->

</div><!-- .wrapper .wrapper-footer -->

<?php endif; ?>