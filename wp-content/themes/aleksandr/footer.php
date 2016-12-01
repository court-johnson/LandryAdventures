<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Aleksandr
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">


			<?php if ( get_theme_mod( 'footer_link_setting' ) ): ?>
				<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'footer_link_setting' ) ); ?>">
					<span class="footer-link">
						<?php echo esc_html( get_theme_mod( 'footer_text_setting', get_bloginfo('name') ) ); ?>
					</span>
				</a>
			<?php else: ?>
				<span class="footer-link">
					<?php echo esc_html( get_theme_mod( 'footer_text_setting', get_bloginfo('name') ) ); ?>
				</span>
			<?php endif; ?>


			<br/>
			<?php printf( esc_html__( 'All rights reserved', 'aleksandr' ) ); ?>
			<br/>
			<span class="copyright"><?php _e( 'Copyright &#169; ', 'aleksandr'); ?><?php echo date('Y'); ?></span>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
