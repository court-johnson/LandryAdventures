<?php
/**
 * @package smallblog
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'is_minimize' ); ?>>
    <?php
    get_template_part( 'template-parts/content', 'heading' );
    get_template_part( 'template-parts/content', 'infobar' );
    ?>
</article>
