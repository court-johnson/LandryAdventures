
<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package grishma
 * @since grishma 1.0
 */

get_header(); ?>

		<div id="content-wrap" class="clearfix">
			<!-- excerpt slider -->
			<?php get_template_part( 'template-slider' ); ?>

			<div id="content" class="post-list">
				<!-- post navigation -->
				<?php get_template_part( 'template-title' ); ?>

				<div class="post-wrap" id="babylongrid">
					<!-- load the posts -->
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<div <?php post_class('post'); ?>>
							<div class="box">

								<?php if ( has_post_format( 'gallery' , $post->ID ) ) { ?>
									<?php if ( function_exists( 'array_gallery' ) ) { array_gallery(); } ?>
								<?php } ?>

								<!-- load the video -->
								<?php if ( get_post_meta( $post->ID, 'arrayvideo', true ) ) { ?>
									<div class="arrayvideo">
										<?php echo get_post_meta( $post->ID, 'arrayvideo', true ) ?>
									</div>

								<?php } else { ?>

									<!-- load the featured image -->
									<?php if ( has_post_thumbnail() ) { ?>
										<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'large-image' ); ?></a>
									<?php } ?>

								<?php } ?>

								<div class="frame">
									<div class="title-wrap">
										
					
					

										<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                        <?php if( is_page() ) { } else { ?>
                                        <div class="title-meta">
                                        <?php echo get_avatar("thumbnail"); ?> <?php the_author_posts_link(); ?>
                                        <span class="sep"><?php _e( '|', 'grishma' ); ?></span>
                                        <a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
                                        <span class="sep"><?php _e( '|', 'grishma' ); ?></span>
                                        <?php comments_popup_link( __( '', 'grishma' ), __( '1 Comment', 'grishma' ), __( '% Comments', 'grishma' ) ); ?>
                                    </div>

                                        					<?php } ?>
									</div><!-- title wrap -->

									<div class="post-content">
										<?php if( is_search() || is_archive() || is_home() ) { ?>
											<?php the_excerpt(); ?>
											<p class="align-center"><a href="<?php the_permalink(); ?>" class="readmore"><?php _e( 'Read More', 'grishma' ); ?></a></p>
										<?php } else { ?>
											<?php the_content( __( 'Read More', 'grishma' ) ); ?>

											<?php if( is_single() || is_page() ) { ?>
												<div class="pagelink">
													<?php wp_link_pages(); ?>
												</div>
											<?php } ?>
										<?php } ?>
									</div><!-- post content -->
								</div><!-- frame -->

							</div><!-- box -->
						</div><!-- post-->

					<?php endwhile; ?>
				</div><!-- post wrap -->

				<!-- post navigation -->
				<?php get_template_part( 'template-nav' ); ?>

				<?php else: ?>
			</div><!-- content -->

			<?php endif; ?>
			<!-- end posts -->

			<!-- comments -->
			<?php if( is_single() && comments_open() ) {
				comments_template();
			} ?>
		</div><!--content-->

		<!-- load the sidebar -->
		<?php get_sidebar(); ?>
	</div><!-- content wrap -->

	<!-- load footer -->
	<?php get_footer(); ?>
