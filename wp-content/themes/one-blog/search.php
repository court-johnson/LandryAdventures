<?php
get_header();
?>
<div class="content">
	<div class="container">
		<div class="post_content">
			<div class="archive_title">
				<h2><?php echo __('Results: ','one-blog').' '.get_search_query(); ?></h2>
			</div><!--//archive_title-->
			<div class="blog_posts">
				<?php
					if ( have_posts() ) :
						while ( have_posts() ) : the_post();
				?>
					<div <?php post_class(array('blog_post_box')); ?>>
						<article id="post-<?php the_ID(); ?>">
							<div class="blog_box_featured_image">
							<?php
								echo '<a href="'.esc_url( get_permalink() ).'">'.get_the_post_thumbnail(get_the_ID(),'one_blog_image').'</a>';
							?>
							</div>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p class="blog_post_date"><?php the_date( get_option( 'date_format' ) ); ?></p>
							<div class="blog_post_content"><?php the_excerpt(); ?></div>
							<a href="<?php the_permalink(); ?>" class="read-more"><?php echo __('Read More','one-blog'); ?></a>
						</article>
					</div>
							
				<?php
						endwhile; 
				?>
				<div class="blog_posts_nav">
					<div class="prev_posts">
						<?php previous_posts_link( __('&laquo; Newer Posts','one-blog') ); ?>
					</div>
					<div class="next_posts">
						<?php next_posts_link( __('Older Posts &raquo;','one-blog') ); ?>
					</div>
					<div class="clear"></div>
				</div><!--//blog_posts_nav-->
				<?php
					else :
				?>
					<h3><?php echo __('No posts found.','one-blog'); ?></h3>
					<p><?php echo __('Try searching again.','one-blog'); ?></p>
				<?php
					get_search_form();
					endif;
				?>
			</div><!--//blog_posts-->
			
		</div><!--//post_content-->
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div>
</div>
<?php
get_footer();
?>