<?php
/**
 * Helpers.
 *
 * @package Bucket Lite
 * @since Bucket Lite 1.0.0
 */

function wpgrade_is_all_multibyte( $string ) {

	if ( function_exists('mb_check_encoding' )) {
		// check if the string doesn't contain invalid byte sequence
		if ( mb_check_encoding( $string, 'UTF-8') === false ){
		    return false;
		}

		$length = mb_strlen($string, 'UTF-8');

		for ($i = 0; $i < $length; $i += 1) {
			$char = mb_substr( $string, $i, 1, 'UTF-8');

			// check if the string doesn't contain single character
			if ( mb_check_encoding( $char, 'ASCII') ) {
				return false;
			}
		}

		return true;
	} else {
    	return false;
    }

}

function wpgrade_contains_any_multibyte( $string ) {

	if (function_exists('mb_check_encoding')) {
    	return !mb_check_encoding( $string, 'ASCII' ) && mb_check_encoding( $string, 'UTF-8');
    } else {
    	return false;
    }
}

/**
* Cutting the titles and adding '...' after
* @param  [string] $text       [description]
* @param  [int] $cut_length [description]
* @param  [int] $limit      [description]
* @return [type]             [description]
*/
function short_text($text, $cut_length, $limit, $echo = true){

   $char_count = mb_strlen( $text, 'UTF-8');
   $text = ( $char_count > $limit ) ? mb_substr( $text, 0, $cut_length ). wpgrade::option( 'blog_excerpt_more_text') : $text;
   if ($echo) {
	   echo $text;
   } else {
	   return $text;
   }
}

/*
 * COMMENT LAYOUT
 */
function wpgrade_comments( $comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
	<article id="comment-<?php comment_ID(); ?>" class="comment-article  media">
		<aside class="comment__avatar  media__img">
			<img src="<?php echo util::get_avatar_url( $comment->comment_author_email, '60'); ?>" class="comment__avatar-image" height="60" width="60" style="background-image: <?php echo get_template_directory_uri(). '/library/images/nothing.gif'; ?>; background-size: 100% 100%" />
		</aside>
		<div class="media__body">
			<header class="comment__meta comment-author">
				<?php /* translators: %s: Comment author link */
                printf('<cite class="comment__author-name">%s</cite>', get_comment_author_link() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<time class="comment__time" datetime="<?php comment_time('c'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>" class="comment__timestamp">on <?php comment_time( __('j F, Y \a\t H:i', 'bucket-lite') ); ?> </a></time>
				<div class="comment__links">
					<?php
					edit_comment_link( esc_html__('Edit', 'bucket-lite'),'  ','');
					comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
					?>
				</div>
			</header><!-- .comment-meta -->
			<?php if ($comment->comment_approved == '0') { ?>
				<div class="alert info">
					<p><?php esc_html_e('Your comment is awaiting moderation.', 'bucket-lite'); ?></p>
				</div>
			<?php } ?>
			<section class="comment__content comment">
				<?php comment_text() ?>
			</section>
		</div>
	</article>
	<!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

/** Add New Field To Category **/
function extra_category_fields( $tag ) {
	if (isset($tag->term_id)) {
		$t_id = $tag->term_id;
		$cat_meta = get_option( "category_$t_id" );
	} else {
		$cat_meta = array();
	}
	?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="meta-color"><?php esc_html_e('Category Custom Accent Color', 'bucket-lite'); ?></label></th>
		<td>
			<div id="colorpicker">
				<input type="text" name="cat_meta[cat_custom_accent]" class="colorpicker" size="3" style="width:20%;" value="<?php echo ( isset( $cat_meta['cat_custom_accent'] ) ) ? $cat_meta['cat_custom_accent'] : wpgrade::option('main_color'); ?>" />
			</div>
			<br />
			<span class="description"><?php echo wp_kses_post( __( 'Set here a custom accent color for this category. We will change the main accent color with this one in the category archives and posts in that category. <b>Note:</b> You must apply the custom CSS <b>Inline</b> for this to work (Theme Options > Custom Code).', 'bucket-lite') ); ?></span>
			<br />
		</td>
	</tr>
<?php
}
add_action ( 'category_add_form_fields', 'extra_category_fields' );
add_action( 'category_edit_form_fields', 'extra_category_fields' );

/** Save Category Meta **/
function save_extra_category_fields( $term_id ) {

	if ( isset( $_POST['cat_meta'] ) ) {
		$t_id = $term_id;
		$cat_meta = get_option( "category_$t_id");
		$cat_keys = array_keys($_POST['cat_meta']);
		foreach ( $cat_keys as $key ){
			if ( isset( $_POST['cat_meta'][$key] ) ){
				$cat_meta[$key] = $_POST['cat_meta'][$key];
			}
		}
		//save the option array
		update_option( "category_$t_id", $cat_meta );
	}
}
add_action ( 'edited_category', 'save_extra_category_fields');

function get_category_color( $cat_id ) {
	$cat_data = get_option("category_$cat_id");

	if ( !empty( $cat_data['cat_custom_accent'] ) && ( $cat_data['cat_custom_accent'] != wpgrade::option( 'main_color') ) ) {
		return $cat_data['cat_custom_accent'];
	} else {
		return wpgrade::option('main_color');
	}
}

/**
 * Filter the page title so that plugins can unhook this
 *
 */
function wpgrade_wp_title( $title, $sep ) {

	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
	    /* translators: %s: page number */
		$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'bucket-lite' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'wpgrade_wp_title', 10, 2 );
