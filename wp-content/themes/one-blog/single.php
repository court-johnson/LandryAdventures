<?php
get_header();
?>
<div class="content">
	<div class="container">
		<div class="post_content">
			<?php if(have_posts()): the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('post_box'); ?>>
				<div class="post_nav">
					<span class="prev_post">
						<?php  previous_post_link('%link', '') ?>
					</span>
					<span class="next_post">
						<?php  next_post_link('%link', '') ?>
					</span>
				</div>
				<div class="clear"></div>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<?php the_tags( '<div class="post_tags">'.__('Tags: ','one-blog'), ', ', '</div>' ); ?> 
				<?php
					wp_link_pages(array(
								'before' => '<div class="post-link-pages-area">'.__('Pages: ', 'one-blog'),
								'after' => '</div>',
								'link_before' => '<span>',
								'link_after' => '</span>'
							));
				?>
			</article>
			<div class="clear"></div>
			<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
						<div class="home_blog_box">
							<div class="comments_cont">
							<?php
								// If comments are open or we have at least one comment, load up the comment template
								comments_template( '', true );
							?>
							</div>
						</div>
			<?php endif;
			endif;
			?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_footer();
?>