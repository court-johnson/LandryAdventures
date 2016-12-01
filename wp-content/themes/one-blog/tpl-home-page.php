<?php
/*
Template Name: Homepage
*/
get_header();
?>
	<?php
		if (one_blog('one_blog_slider') == 1) :
			
			$args = array(
				'post_type' => 'post',
				'meta_key' => 'one_blog_show_in_slider',
				'meta_value' => '1',
				'posts_per_page' => -1,
				'ignore_sticky_posts' => true
				);
			$the_query = new WP_Query( $args );
	 		if ( $the_query->have_posts() ) :
	 			echo '<div class="home_slider"><ul class="slides">';
	 			while ( $the_query->have_posts() ) : $the_query->the_post();

		 			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
					echo '<li><a style="background-image: url('.$thumbnail[0].')" class="home_slide_bg" href="'.esc_url( get_permalink() ).'"></a><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
		 					
	 			endwhile;
	 			echo '</ul></div>';
	 			wp_reset_postdata();
	 		endif;
 		endif;
 	?>
<div class="content">
	<div class="container">
		<div class="post_content">
			<div class="blog_posts">
				<?php
					$args2 = array(
					'post_type' => 'post',
					'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
					'meta_query' => array(
									'relation' => 'OR',
									array(
										'key' => 'one_blog_show_in_slider',
										'value' => '1',
										'compare' => '!='
										),
									array(
										'key' => 'one_blog_show_in_slider',
										'compare' => 'NOT EXISTS'
										)
									)
					);
					$query = new WP_Query( $args2 );
					if ( $query->have_posts() ) :
						while ( $query->have_posts() ) : $query->the_post();
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
			</div><!--//blog_posts-->
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
				endif;
			?>
		</div><!--//post_content-->
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div><!--//container-->
</div><!--//content-->
<?php
get_footer();
?>