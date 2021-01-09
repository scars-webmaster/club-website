<?php
/**
 * The template for displaying the footer
 */

?>

	</div><!-- #content -->
	
		<?php if (esc_attr(get_theme_mod( 'social_media_activate' )) ) { ?>
		<div style="float: none; text-align: center;  display: inline-table;" class="social">
				<div  style="float: none;" class="fa-icons">
					<?php echo super_social_section (); ?>
				</div>
		</div>
		
	<?php } ?>
	
	<footer role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
	
		<div id="colophon"  class="site-info">
		<?php if (esc_textarea(get_theme_mod('super_premium_copyright1'))) : echo esc_textarea(get_theme_mod('super_premium_copyright1')); else : ?>
			<p>
					<?php esc_html_e('All rights reserved', 'super'); ?>  &copy; <?php bloginfo('name'); ?>
								
					<a title="Seos Themes" href="<?php echo esc_url('https://seosthemes.com/', 'super'); ?>" target="_blank"><?php esc_html_e('Theme by Seos Themes', 'super'); ?></a>
			</p>
		<?php endif; ?>		
		</div><!-- .site-info -->
		
	</footer><!-- #colophon -->
	<a id="totop" href="#"><div><?php esc_html_e('To Top', 'super'); ?></div></a>	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
