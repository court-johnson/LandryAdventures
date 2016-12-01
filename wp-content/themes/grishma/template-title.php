<?php
/**
 * Template for the post and page titles.
 *
 * @package grishma
 * @since grishma 1.0
 */
?>

<?php if ( is_front_page() || is_single() || is_page() ) {} else { ?>
	<div class="sub-title">
		<h1>
		<?php
			if ( is_category() ) :
				printf( __( 'Category / ', 'grishma' ) ); single_cat_title();

			elseif ( is_tag() ) :
				printf( __( 'Tag / ', 'grishma' ) ); single_tag_title();

			elseif ( is_author() ) :
				printf( __( 'Author / %s', 'grishma' ), '' . get_the_author() . '');

			elseif ( is_day() ) :
				printf( __( 'Day / %s', 'grishma' ), '<span>' . get_the_date() . '</span>' );

			elseif ( is_month() ) :
				printf( __( 'Month / %s', 'grishma' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

			elseif ( is_year() ) :
				printf( __( 'Year / %s', 'grishma' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

			elseif ( is_404() ) :
				_e( '404 / Page Not Found', 'grishma' );

			elseif ( is_search() ) :
				printf( __( 'Search Results for: %s', 'grishma' ), '<span>' . get_search_query() . '</span>' );

			endif;
		?>
		</h1>
	</div>
<?php } ?>