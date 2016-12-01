<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package coral-drive
 */
?>

	</div><!-- #content -->
  </div><!-- #contentwrap -->
  <div id="footerwrap">
	<footer id="colophon" class="site-footer grid-container" role="contentinfo">
		<div class="egrid <?php coral_drive_copyright_class(); ?>" id="footer-widget-copyright">
			<?php if ( is_active_sidebar( 'footer-copyright' ) ) dynamic_sidebar( 'footer-copyright' ); ?>
		</div>
		<div id="social1" class="egrid <?php coral_drive_social_class(); ?>">
			<?php 
				$youtubeurl = get_theme_mod('coral_drive_youtube_url_setting','');
				$feedurl = get_theme_mod('coral_drive_feed_url_setting','');
				$twitterurl = get_theme_mod('coral_drive_twitter_url_setting','');
				$googleurl = get_theme_mod('coral_drive_google_url_setting','');
				$facebookurl = get_theme_mod('coral_drive_facebook_url_setting','');
			?>
			<?php if($youtubeurl) : ?>
				<a target="_blank" class="myyoutube" href="<?php echo esc_url($youtubeurl); ?>" title="Youtube"><i class="fa fa-youtube"></i></a>
			<?php endif; ?>
			<?php if($feedurl) : ?>
				<a target="_blank" class="myfeed" href="<?php echo esc_url($feedurl); ?>" title="Feed"><i class="fa fa-rss"></i></a>
			<?php endif; ?>
			<?php if($twitterurl) : ?>
				<a target="_blank" class="mytwitter" href="<?php echo esc_url($twitterurl); ?>" title="Twitter"><i class="fa fa-twitter"></i></a>
			<?php endif; ?>
			<?php if($googleurl) : ?>
				<a target="_blank" class="mygoogle" href="<?php echo esc_url($googleurl); ?>" title="Google"><i class="fa fa-google-plus"></i></a>
			<?php endif; ?>
			<?php if($facebookurl) : ?>
				<a target="_blank" class="myfacebook" href="<?php echo esc_url($facebookurl); ?>" title="Facebook"><i class="fa fa-facebook"></i></a>
			<?php endif; ?>
			<a id="designer" class="alignright" href="http://www.coralthemes.com/"><?php echo __( 'Coral Themes', 'coral-drive' ); ?></a>
		</div>
	</footer><!-- #colophon -->
  </div><!-- #footerwrap -->	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
