<?php

	// @todo CLEANUP refactor function
	function wpgrade_better_excerpt($text) {
		global $post;

		//if the post has a manual excerpt ignore the content given
		if (function_exists('has_excerpt') && has_excerpt()) {
			$text = get_the_excerpt();
			$raw_excerpt = $text;

			$text = strip_shortcodes( $text );
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]&gt;', $text);

			// Removes any JavaScript in posts (between <script> and </script> tags)
			$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);

			// Enable formatting in excerpts - Add HTML tags that you want to be parsed in excerpts
			$allowed_tags = '<p><a><em><strong><i><br><h1><h2><h3><h4><h5><h6><blockquote><ul><li><ol>';
			$text = strip_tags($text, $allowed_tags);
			$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
			$text .= $excerpt_more;
		}
		else {
			$raw_excerpt = $text;

			$text = strip_shortcodes( $text );
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]&gt;', $text);

			// Removes any JavaScript in posts (between <script> and </script> tags)
			$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);

			// Enable formatting in excerpts - Add HTML tags that you want to be parsed in excerpts
			$allowed_tags = '<p><a><em><strong><i><br><h1><h2><h3><h4><h5><h6><blockquote><ul><li><ol>';
			$text = strip_tags($text, $allowed_tags);

			// Set custom excerpt length - number of words to be shown in excerpts
			if (wpgrade::option('blog_excerpt_length'))
			{
				$excerpt_length = absint(wpgrade::option('blog_excerpt_length'));
			}
			else
			{
				$excerpt_length = 55;
			}

			$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
			$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
			if ( count($words) > $excerpt_length ) {
				array_pop($words);
				$text = implode(' ', $words);
				$text = force_balance_tags( $text );
				$text = $text . $excerpt_more;
			} else {
				$text = implode(' ', $words);
			}
		}

		// IMPORTANT! Prevents tags cutoff by excerpt (i.e. unclosed tags) from breaking formatting
		$text = force_balance_tags( $text );

		return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
	}

	/*
	 * COMMENT LAYOUT
	 */
	function wpgrade_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?>>
			<article id="comment-<?php comment_ID(); ?>" class="comment">
                <header class="comment__meta comment-author vcard">
					<time datetime="<?php comment_time('c'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" class="comment__timestamp"><?php comment_time(__('M j, Y \a\t H:i', wpgrade::textdomain())); ?> </a></time>
					<?php printf(__('<cite class="comment__author-name">%s</cite>', wpgrade::textdomain()), get_comment_author_link()) ?>                    
                </header><!-- .comment-meta -->				
				<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert info">
					<p><?php _e('Your comment is awaiting moderation.', wpgrade::textdomain()) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment__content comment">
				<?php comment_text() ?>
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				<?php edit_comment_link(__('Edit', wpgrade::textdomain()),'  ','') ?>				
			</section>
		</article>
		<!-- </li> is added by WordPress automatically -->
		<?php
	} // don't remove this bracket!