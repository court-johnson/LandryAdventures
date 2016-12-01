<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Aleksandr
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}


$sidebar_style = '';

if ( get_theme_mod( 'sidebar_title_style' ) ) {
	$sidebar_style = get_theme_mod( 'sidebar_title_style', 'border_bottom' );
}
?>

<aside id="secondary" class="widget-area <?php echo  esc_attr( $sidebar_style ); ?>" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
