<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package smallblog
 */
?>

<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php get_template_part( 'template-parts/content', 'heading' ); ?>
    <?php get_template_part( 'template-parts/content', 'thumbnail' ); ?>

    <div class="the-content">
        <?php the_content(); ?>
    </div>

    <hr class="separator"/>
</article>
