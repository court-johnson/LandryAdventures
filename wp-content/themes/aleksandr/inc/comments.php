<?php
function aleksandr_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'div';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>


	<div class="comment-wrapper">
	<p class="comment-text"><?php printf( get_comment_text() ); ?></p>

	<p class="comment-info">
	<span class="comment-author"><?php esc_url( printf( get_comment_author_link() ) ); ?></span> | 

	<?php if ( $comment->comment_approved == '0' ) : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'aleksandr' ); ?></em>
		<br />
	<?php endif; ?>

		<span class="comment-date">
		<?php
			/* translators: 1: date, 2: time */
			printf( _x( '%s ago', '%s = human-readable time difference', 'aleksandr' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?><?php edit_comment_link( __( '(Edit)', 'aleksandr' ), '  ', '' );
		?>
		</span>

	<span class="reply-comment"><?php esc_url( comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ); ?></span>

	</p>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	</div>
	<?php endif; ?>


<?php
}
