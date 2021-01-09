
	<footer id="colophon" role="contentinfo">
		<div id="site-generator">

			<?php echo __('&copy; ', 'hostmarks') . esc_attr( get_bloginfo( 'name', 'display' ) );  ?>
            <?php if ( (is_front_page() && ! is_paged()) || (is_page_template('alt_blog_template.php') && is_front_page() && ! is_paged()) ) : ?>
            <?php echo __(' - Built with','hostmarks'); ?> <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'hostmarks' ) ); ?>" rel="nofollow" target="_blank"><?php printf( esc_html( '%s', 'hostmarks' ), 'WordPress' ); ?></a><span><?php esc_html_e(' and ','hostmarks'); ?></span><a href="<?php echo esc_url( __( 'https://wpdevshed.com/hostmarks-theme/', 'hostmarks' ) ); ?>" rel="nofollow" target="_blank"><?php printf( esc_html( '%s', 'hostmarks' ), 'Hostmarks' ); ?></a>
            <?php endif; ?>
            
		</div>
	</footer><!-- #colophon -->
</div><!-- #container -->

<?php wp_footer(); ?>


</body>
</html>