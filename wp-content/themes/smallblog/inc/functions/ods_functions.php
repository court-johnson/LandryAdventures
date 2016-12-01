<?php


/**
 * Add a brand.
 *
 * @param string $ods_img_src
 */
function ods_add_brand( $ods_img_src = 'ods_logo_src' )
{

    $ods_brand = array(
        'img_src'    => esc_url( get_theme_mod( $ods_img_src ) ),
        'link'       => esc_url( home_url( '/' ) ),
        'title'      => esc_attr( get_bloginfo( 'name', 'display' ) ),
        'name'       => get_bloginfo( 'name', 'display' ),
        'class'      => esc_url( get_theme_mod( $ods_img_src ) ) ? 'logo' : 'navbar-brand',
        'tag_before' => is_home() ? '<h1 class="entry-title">' : '<div class="entry-title">',
        'tag_after'  => is_home() ? '</h1>' : '</div>',
        'color'      => '#' . get_header_textcolor()
    );

    $tpl = $ods_brand[ 'tag_before' ];
    $tpl .= '<a class="' . $ods_brand[ 'class' ] . '" href="' . $ods_brand[ 'link' ] . '" title="' . $ods_brand[ 'title' ] . '"  style="color:' . $ods_brand[ 'color' ] . ';" >';

    if ( empty( $ods_brand[ 'img_src' ] ) ):
        $tpl .= $ods_brand[ 'name' ];
    else:
        $tpl .= '<figure style="background-image: url(' . $ods_brand[ 'img_src' ] . ');">';
        $tpl .= '<img class="img-responsive" src="' . $ods_brand[ 'img_src' ] . '" alt="' . $ods_brand[ 'title' ] . '"/></figure>';
        $tpl .= '</figure>';
    endif;

    $tpl .= '</a>';
    $tpl .= $ods_brand[ 'tag_after' ];

    echo $tpl;

}


/**
 * Create the excerpt shortcode
 *
 * @param $ods_shortcode
 */
function ods_shortcode( $ods_shortcode )
{

    if ( shortcode_exists( $ods_shortcode ) ) {
        $pattern = get_shortcode_regex();
        preg_match( '/' . $pattern . '/s', get_the_content(), $matches );

        if ( !empty( $matches ) ) {
            if ( is_array( $matches ) && $matches[ 2 ] == $ods_shortcode ) {
                $shortcode = $matches[ 0 ];
                echo do_shortcode( $shortcode );
            }
        }

    }

}


/**
 * @param null $content
 * @return mixed|null
 */
add_filter( 'the_content', 'ods_remove_first_shortcode' );
function ods_remove_first_shortcode( $content = null )
{
    global $post;

    $terms = array( 'audio', 'gallery', 'video', 'playlist' );

    if ( is_single() && is_main_query() && $post->post_type == 'post' && has_post_format( $terms, $post->ID ) ) {
        $pattern = get_shortcode_regex();
        preg_match( '/' . $pattern . '/s', $content, $matches );
        if ( isset( $matches[ 2 ] ) && is_array( $matches ) && in_array( $matches[ 2 ], $terms ) ) {
            $content = str_replace( $matches[ '0' ], '', $content );
        }
    }
    return $content;

}


/**
 * @param $post_id
 * @return bool
 */
function ods_get_first_embed_media( $post_id )
{
    $post = get_post( $post_id );
    $content = do_shortcode( apply_filters( 'the_content', $post->post_content ) );
    $embeds = get_media_embedded_in_content( $content, array( 'object', 'embed', 'iframe' ) );

    if ( !empty( $embeds ) ) {
        return $embeds[ 0 ];
    } else {
        return false;
    }
}


/**
 * Pagination for archive, taxonomy, category, tag and search results pages
 *
 */
function ods_pagination()
{
    global $wp_query;
    $big = 999999999; // This needs to be an unlikely integer
    $pages = paginate_links( array(
        'base'      => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
        'current'   => max( 1, get_query_var( 'paged' ) ),
        'total'     => $wp_query->max_num_pages,
        'mid_size'  => 5,
        'prev_text' => '<span class="screen-reader-text">' . __( 'Previous', 'smallblog' ) . '</span><span class="icon-arrow-left"></span>',
        'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'smallblog' ) . '</span><span class="icon-arrow-right"></span>',
        'type'      => 'array'
    ) );

    if ( is_array( $pages ) ) {
        $paged = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
        echo '<ul class="pagination">';
        foreach ( $pages as $page ) {
            echo '<li>' . $page . '</li>';
        }
        echo '</ul>';
    }
}


/**
 * Add comment list on the single and page.
 *
 * @param $comment
 * @param $args
 * @param $depth
 */
function ods_comment( $comment, $args, $depth )
{
    global $counter;
    $counter++;
    $GLOBALS[ 'comment' ] = $comment;
    extract( $args, EXTR_SKIP );

    if ( 'div' == $args[ 'style' ] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args[ 'has_children' ] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args[ 'style' ] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
<?php endif; ?>
    <figure class="comment-figure">
        <?php if ( $args[ 'avatar_size' ] != 0 ) echo get_avatar( $comment, 70 ); ?>
        <span class="comment-number"><?php echo $counter; ?></span>
    </figure>
    <div class="comment-info">
        <?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
        <?php printf( __( 'on %1$s', 'smallblog' ), get_comment_date() ); ?>
        <span class="comment-links">
        <?php edit_comment_link( __( '(Edit)', 'smallblog' ), '  ', '' ); ?>
        <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ] ) ) ); ?>
        </span>
    </div>

    <?php if ( $comment->comment_approved == '0' ) : ?>
    <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'smallblog' ); ?></em>
    <br/>
<?php endif; ?>
    <?php comment_text(); ?>
    <?php if ( 'div' != $args[ 'style' ] ) : ?>
    </div>
<?php endif;
}
