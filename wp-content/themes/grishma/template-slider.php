    <?php
    /**
     * Template for the post excerpt slider on the homepage.
     *
     * @package grishma
     * @since grishma 1.0
     */
    ?>

    <!-- excerpt scroller -->
    <?php if( is_home() && get_option( 'grishma_customizer_slider_disable' ) == 'enable' ) { ?>

        <div class="scroll">


            <div class="flexslider">
                <ul class="slides">
                    <?php
                        $featured_list_args  = array(
                            'posts_per_page' => 5,
                            'post__in'       => get_option( 'sticky_posts' )
                        );
                        $featured_list_posts = new WP_Query( $featured_list_args );
                    ?>

                    <?php while( $featured_list_posts->have_posts() ) : $featured_list_posts->the_post() ?>
                        <li>

                                    <?php if ( has_post_thumbnail() ) { ?>
                                            <?php the_post_thumbnail( 'large' ); ?>
                                        <?php } ?>


                            <div class="scroll-post-content">
                            <div class="scroll-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </div>
                                <div class="scroll-post">
                                <div class="title-meta">
                                    <?php echo get_avatar("small"); ?> <?php the_author_posts_link(); ?>
                                    <span class="sep"><?php _e( '|', 'grishma' ); ?></span>
                                    <a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
                                    <span class="sep"><?php _e( '|', 'grishma' ); ?></span>
                                    <?php comments_popup_link( __( 'Leave a comment', 'grishma' ), __( '1 Comment', 'grishma' ), __( '% Comments', 'grishma' ) ); ?>
                                </div>
                            </div>

                            <div class="scroll-excerpt">
                                <?php the_excerpt(); ?>
                            </div>

                                </div>
                        </li>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </ul><!-- slides -->
            </div><!-- flexslider -->
        </div><!-- scroll -->
    <?php } ?>