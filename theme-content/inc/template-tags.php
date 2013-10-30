<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package wpGrade
 * @since wpGrade 1.0
 */

if ( ! function_exists( 'wpgrade_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since wpGrade 1.0
 */
function wpgrade_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', wpgrade::textdomain() ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', wpgrade::textdomain() ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>">
			<footer>
				<div class="comment-author vcard">
					<?php //echo get_avatar( $comment, 40 ); ?>
					<?php printf( __( '%s', wpgrade::textdomain() ), sprintf( '<span class="fn">%s</span>', get_comment_author_link() ) ); ?>
					<a class="comment-date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>"><?php
						/* translators: 1: date, 2: time */
						the_time('j M y');
					?></time></a>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', wpgrade::textdomain() ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<p class="comment-meta commentmetadata">
				<?php edit_comment_link( __( 'Edit', wpgrade::textdomain() ), ' ' );
				?>
			</p> <!-- .comment-meta .commentmetadata -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for wpgrade_comment()

/**
 * Returns true if a blog has more than 1 category
 *
 * @since wpGrade 1.0
 */
function wpgrade_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so wpgrade_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so wpgrade_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in wpgrade_categorized_blog
 *
 * @since wpGrade 1.0
 */
function wpgrade_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'wpgrade_category_transient_flusher' );
add_action( 'save_post', 'wpgrade_category_transient_flusher' );