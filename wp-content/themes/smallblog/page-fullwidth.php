<?php
/**
 * Template Name: Full Width Page
 *
 * @package smallblog
 */
get_header(); ?>

<div id="section" class="container">
    <main id="page"role="main">
        <?php

        if ( have_posts() ):

            // Start the loop.
            while ( have_posts() ) : the_post();

                // Include the page content template.
                get_template_part( 'template-parts/content', 'page' );

                wp_link_pages();

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }

                // End of the loop.
            endwhile;

        else:
            get_template_part( 'template-parts/content', 'none' );
        endif;

        ?>
    </main>
</div>

<?php get_footer(); ?>





