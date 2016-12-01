<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Aleksandr
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site <?php echo esc_attr( get_theme_mod( 'layout_setting', 'sidebar-right' ) ); ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'aleksandr' ); ?></a>

	<div class="nav-top-bar">
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<a id="nav-toggle" aria-controls="primary-menu" aria-expanded="false" href="#"><span></span></a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', ) ); ?>
		</nav><!-- #site-navigation -->

		<!-- Social media icons -->
		<?php
		$social_medias = array
		( 'facebook', 'instagram', 'twitter', 'pinterest', 'youtube', 'vimeo', 'behance', 'google-plus', 'github', 'codepen', 'linkedin', 'flickr', 'tumblr', 'weibo', 'vkontakte', 'soundcloud' );
		?>

		<div class="social-media-menu">
		<?php
			foreach( $social_medias as $media ) {
	
			 	if( get_theme_mod( $media . '-link' ) ) {
			 	?>
					<a target="_blank" href="<?php echo esc_url( get_theme_mod( $media . '-link' ) ); ?>">
						<button class="<?php echo 'aleksandr-' . esc_html( get_theme_mod( 'social-hover', 'fade' ) ); ?> social-media <?php echo $media; ?>"></button>
					</a>

				<?php
				}
			}
		?>
		</div>
	</div>


	<?php if ( get_header_image() ) : ?>		
		<header id="masthead" class="site-header" style="background-image: url(<?php header_image(); ?>)" role="banner">
	<?php else: ?>
		<header id="masthead" class="site-header" role="banner">
	<?php endif; ?>


			<div class="site-branding-container <?php if( get_header_image() ) { echo "header-text-shadow"; } ?>">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

				<?php
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
				endif; ?>
			</div><!-- .site-branding -->
		</header><!-- #masthead -->

	<div id="content" class="site-content">
