    <?php
    /**
    * The template for displaying pages.
    *
    * @package grishma
    * @since grishma 1.0
    */

    get_header(); ?>

        <div id="content-wrap" class="clearfix">
            <div id="content">
                <!-- post navigation -->
                <?php get_template_part( 'template-title' ); ?>

                <div class="post-wrap">
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
                                        <a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'grishma-large-image' ); ?></a>
                                    <?php } ?>

                                <?php } ?>

                                <div class="frame">
                                    <div class="title-wrap">
                                        <h2><?php the_title(); ?></h2>
                                    </div><!-- title wrap -->

                                    <div class="post-content">
                                        <?php the_content( __( 'Read More', 'grishma' ) ); ?>

                                        <div class="pagelink">
                                            <?php wp_link_pages(); ?>
                                        </div>
                                    </div><!-- post content -->
                                </div><!-- frame -->
                            </div><!-- box -->
                        </div><!-- post-->

                    <?php endwhile; ?>
                </div><!-- post wrap -->

                <?php else: ?>
            </div><!-- content -->

            <?php endif; ?>
            <!-- end posts -->

            <?php if( comments_open() ) {
                comments_template();
            } ?>
        </div><!--content-->

        <!-- load the sidebar -->
        <?php get_sidebar(); ?>
    </div><!-- content wrap -->

    <!-- load footer -->
    <?php get_footer(); ?>