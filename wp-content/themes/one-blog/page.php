<?php
get_header();
?>
<div class="content">
	<div class="container">
		<div class="post_content">
			<?php if(have_posts()): the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('post_box'); ?>>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</article>
			<div class="clear"></div>
			<?php
					wp_link_pages(array(
								'before' => '<div class="post-link-pages-area">'.__('Pages: ', 'one-blog'),
								'after' => '</div>',
								'link_before' => '<span>',
								'link_after' => '</span>'
							));
				?>
			<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
						<div class="home_blog_box">
							<?php comments_template( '', true ); ?>
						</div>
			<?php endif;
			endif;
			?>
		</div>
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div>
</div>
<?php
get_footer();
?>