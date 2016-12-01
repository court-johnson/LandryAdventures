<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Aleksandr
 */

if ( ! function_exists( 'aleksandr_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function aleksandr_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$categories = get_the_category();
	$category = '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . $categories[0]->cat_name . '</a>';

	$author = '';
	if ( get_theme_mod( 'show_author', 'hide' ) == 'show' ) {
		$author = '<span class="meta-divider"> / </span>' . get_the_author() . '</span>';
	}

	$post_time = sprintf( _x( '%s ago', '%s = human-readable time difference', 'aleksandr' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );

	echo '<span class="category">' . $category . '</span><span class="meta-divider"> / </span><span class="post-time"><span class="post-time"> ' . $post_time . '</span>' . $author; // WPCS: XSS OK.

}
endif;


if ( ! function_exists( 'aleksandr_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function aleksandr_entry_footer() {


	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'aleksandr' ), esc_html__( '1 Comment', 'aleksandr' ), esc_html__( '% Comments', 'aleksandr' ) );
		echo '</span>';
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'aleksandr' ) );
		if ( $tags_list ) {
			echo '<br/>';
		}

	}

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		/* translators: used between list items, there is a space after the comma */
		$tags_list = strtolower( get_the_tag_list( '', esc_html__( ', ', 'aleksandr' ) ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tags | %1$s', 'aleksandr' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}



	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'aleksandr' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<br/><span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function aleksandr_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'aleksandr_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'aleksandr_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so aleksandr_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so aleksandr_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in aleksandr_categorized_blog.
 */
function aleksandr_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'aleksandr_categories' );
}
add_action( 'edit_category', 'aleksandr_category_transient_flusher' );
add_action( 'save_post',     'aleksandr_category_transient_flusher' );





if ( ! function_exists( 'aleksandr_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Fourteen 1.0
 *
 * @global WP_Query   $wp_query   WordPress Query object.
 * @global WP_Rewrite $wp_rewrite WordPress Rewrite object.
 */
function aleksandr_paging_nav() {
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Prev', 'aleksandr' ),
		'next_text' => __( 'Next &rarr;', 'aleksandr' ),
		'type'		=> 'list',

	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'aleksandr' ); ?></h1>
			<?php echo $links; ?>
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;
