<?php
/**
 * Template for the post navigation and archive pagination.
 *
 * @package grishma
 * @since grishma 1.0
 */
?>

<!-- next and previous posts -->
<?php if( is_single() ) { ?>
	<div class="next-prev">
		<?php previous_post_link( '<div class="prev-post"><strong class="next-prev-title">' . __( 'Previous Post', 'grishma' ) . '</strong><span>%link</span></div>' ); ?>
		<?php next_post_link( '<div class="next-post"><strong class="next-prev-title">' . __( 'Next Post', 'grishma' ) . '</strong><span>%link</span></div>' ); ?>
	</div><!-- next prev -->
<?php } ?>

<!-- post navigation -->
<?php if( $wp_query->max_num_pages > 1 ) : ?>
	<div class="post-nav">
		<div class="postnav-left"><?php previous_posts_link( __( 'Newer Posts', 'grishma' ) ) ?></div>
		<div class="postnav-right"><?php next_posts_link( __( 'Older Posts', 'grishma' ) ) ?></div>
	</div><!-- end post navigation -->
<?php endif; ?>
