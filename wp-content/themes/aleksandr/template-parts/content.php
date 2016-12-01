<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aleksandr
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h2 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php aleksandr_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>

	<?php if ( has_post_thumbnail()): ?>
		<figure class="featured-image">
			<?php the_post_thumbnail(); ?>
		</figure>
	<?php endif; ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php

			 if ( is_home() && get_theme_mod( 'continue_reading_setting' ) === 'continue-reading' || is_search() || is_archive() && get_theme_mod( 'continue_reading_setting' ) === 'continue-reading' )  {
				the_excerpt();
				?>

					<div class="continue-reading-container">
						<a class="continue-reading-button" href="<?php the_permalink(); ?>">
							Continue reading &raquo;
						</a>
					</div>


				<?php
			} else {

			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'aleksandr' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aleksandr' ),
				'after'  => '</div>',
			) );

			}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php aleksandr_entry_footer(); ?>
	</footer><!-- .entry-footer -->

	
</article><!-- #post-## -->
