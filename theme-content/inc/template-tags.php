<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package wpGrade
 * @since wpGrade 1.0
 */

if ( ! function_exists( 'wpgrade_content_nav' ) ) :
	/**
	 * Display navigation to next/previous pages when applicable
	 *
	 * @since wpGrade 1.0
	 */
	function wpgrade_content_nav( $nav_id ) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous )
			return;
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$nav_class = ' paging-navigation';
		if ( is_single() ) {
			$nav_class = ' post-navigation';
		} ?>
		<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
			<?php if ( is_single() ) : // navigation links for single posts ?>
				<ul class="direction-nav-container direction-nav-project">
					<?php previous_post_link('<li class="navigation-control-menu-item" id="portfolio-works-next">%link</li>', '<span class="arrow-left"></span>' ); ?>
					<li class="navigation-control-menu-item">
				        <?php //echo '<a class="portfolio-nav-archive" href="'.get_portfolio_page_link().'">All projects</a>' ?>
				        <?php echo '<a class="portfolio-nav-archive" href="'.get_portfolio_page_link().'"><span><i class="icon-th" href="'.get_portfolio_page_link().'"></i></span></a>' ?>
					</li>
					<?php next_post_link('<li class="navigation-control-menu-item" id="portfolio-works-previous" >%link</li>', '<span class="arrow-right"></span>'); ?>
				</ul>
			<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages
				if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> Older posts', wpgrade::textdomain() ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&raquo;</span>', wpgrade::textdomain() ) ); ?></div>
				<?php endif; ?>

			<?php endif; ?>

		</nav><!-- #<?php echo $nav_id; ?> -->
	<?php }
endif; // wpgrade_content_nav

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

if ( ! function_exists( 'wpgrade_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since wpGrade 1.0
 */
function wpgrade_posted_on() {
	printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>', wpgrade::textdomain() ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'F d, Y' ) ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', wpgrade::textdomain() ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;

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