<?php
/**
 * Invoked by wpgrade_callback_themesetup
 */
function wpgrade_callback_custom_theme_features() {
	add_theme_support('automatic-feed-links');
	// @todo CLEANUP consider options for spliting editor style out of main style
	add_editor_style(get_template_directory_uri().'/theme-content/css/style.css');
}

function wpgrade_callback_sort_query_by_post_in( $sortby, $thequery ) {
	if ( !empty($thequery->query['post__in']) && isset($thequery->query['orderby']) && $thequery->query['orderby'] == 'post__in' )
		$sortby = "find_in_set(ID, '" . implode( ',', $thequery->query['post__in'] ) . "')";

	return $sortby;
}
add_filter( 'posts_orderby', 'wpgrade_callback_sort_query_by_post_in', 10, 2 );

function wpgrade_add_desktop_icons(){

	if ( wpgrade::option_image_src( 'favicon' ) ) {
		echo "<link rel='icon' href=\"".wpgrade::option_image_src( 'favicon' )."\" >\n";
	}

	if ( wpgrade::option_image_src( 'apple_touch_icon' ) ) {
		echo "<link rel=\"apple-touch-icon\" href=\"".wpgrade::option_image_src( 'apple_touch_icon' )."\" >\n";
	}

	if ( wpgrade::option_image_src( 'metro_icon' ) ) {
		echo "<meta name=\"msapplication-TileColor\" content=\"#f01d4f\">\n";
		echo "<meta name=\"msapplication-TileImage\" content=\"".wpgrade::option_image_src( 'metro_icon' )."\" >\n";
	}

}
add_action('wp_head', 'wpgrade_add_desktop_icons');

function wpgrade_prepare_password_for_custom_post_types(){

	global $wpgrade_private_post;
	$wpgrade_private_post = bucket::is_password_protected();

}

add_action('wp', 'wpgrade_prepare_password_for_custom_post_types');


// Add "Next page" button to TinyMCE
function add_next_page_button( $mce_buttons ) {
	$pos = array_search( 'wp_more', $mce_buttons, true );
	if ( $pos !== false ) {
		$tmp_buttons = array_slice( $mce_buttons, 0, $pos+1 );
		$tmp_buttons[] = 'wp_page';
		$mce_buttons = array_merge( $tmp_buttons, array_slice( $mce_buttons, $pos+1 ) );
	}
	return $mce_buttons;
}
add_filter( 'mce_buttons', 'add_next_page_button' );

// Customize the "wp_link_pages()" to be able to display both numbers and prev/next links
function add_next_and_number( $args ) {
	if ( $args['next_or_number'] == 'next_and_number' ) {
		global $page, $numpages, $multipage, $more, $pagenow;
		$args['next_or_number'] = 'number';
		$prev = '';
		$next = '';
		if ( $multipage and $more ) {
			$i = $page-1;
			if ( $i and $more ) {
				$prev .= _wp_link_page( $i );
				$prev .= $args['link_before'] . $args['previouspagelink'] . $args['link_after'] . '</a>';
			}
			$i = $page+1;
			if ( $i <= $numpages and $more ) {
				$next .= _wp_link_page( $i );
				$next .= $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>';
			}
		}
		$args['before'] = $args['before'] . $prev;
		$args['after'] = $next . $args['after'];
	}
	return $args;
}
add_filter( 'wp_link_pages_args', 'add_next_and_number' );
