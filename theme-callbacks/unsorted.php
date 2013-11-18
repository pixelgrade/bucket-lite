<?php

	//@todo CLEANUP refactor function
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
			if (wpgrade::option('blog_excerpt_length'))	{
				$excerpt_length = absint(wpgrade::option('blog_excerpt_length'));
			} else {
				$excerpt_length = 180;
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
			<article id="comment-<?php comment_ID(); ?>" class="comment-article  media">
                <aside class="comment__avatar  media__img">
                    <!-- custom gravatar call -->
                    <?php $bgauthemail = get_comment_author_email(); ?>
                    <img src="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=60" class="comment__avatar-image" height="60" width="60" style="background-image: <?php echo get_template_directory_uri(). '/library/images/nothing.gif'; ?>; background-size: 100% 100%" />
                </aside>
                <div class="media__body">
                    <header class="comment__meta comment-author">
                        <?php printf('<cite class="comment__author-name">%s</cite>', get_comment_author_link()) ?>
    					          <time class="comment__time" datetime="<?php comment_time('c'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" class="comment__timestamp">on <?php comment_time(__('j F, Y \a\t H:i', wpgrade::textdomain())); ?> </a></time>
                        <div class="comment__links">
                            <?php
                                edit_comment_link(__('Edit', wpgrade::textdomain()),'  ','');
                                comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
                            ?>
                        </div>
                    </header><!-- .comment-meta -->				
    				<?php if ($comment->comment_approved == '0') : ?>
    				<div class="alert info">
    					<p><?php _e('Your comment is awaiting moderation.', wpgrade::textdomain()) ?></p>
    				</div>
    				<?php endif; ?>
    				<section class="comment__content comment">
    					<?php comment_text() ?>
    				</section>
                </div>
			</article>
		<!-- </li> is added by WordPress automatically -->
		<?php
	} // don't remove this bracket!

    /**
     * Cutting the titles and adding '...' after
     * @param  [string] $text       [description]
     * @param  [int] $cut_length [description]
     * @param  [int] $limit      [description]
     * @return [type]             [description]
     */
    function short_text($text, $cut_length, $limit){
        $text = (strlen($text) > $limit) ? substr($text,0,$cut_length).'...' : $text;
        echo $text;
    }
	
	function custom_excerpt_length( $length ) {
		// Set custom excerpt length - number of words to be shown in excerpts
		if (wpgrade::option('blog_excerpt_length'))	{
			return absint(wpgrade::option('blog_excerpt_length'));
		} else {
			return 55;
		}
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
	
	/**
	* Replace the [...] wordpress puts in when using the the_excerpt() method.
	*/
   function new_excerpt_more($excerpt) {
	   return wpgrade::option('blog_excerpt_more_text');
   }
   add_filter('excerpt_more', 'new_excerpt_more');

 	function remove_more_link_scroll( $link ) {
		$link = preg_replace( '|#more-[0-9]+|', '', $link );
		return $link;
	}
	add_filter( 'the_content_more_link', 'remove_more_link_scroll' );