<?php

/**
 * Note: next_text and prev_text are already flipped as per sorted_paging
 * in the configuration passed to this function.
 *
 * The formatter is designed to generate the following structure:
 *
 *	<div class="wpgrade_pagination">
 *		<a class="prev disabled page-numbers">Previous Page</a>
 *		<div class="pages">
 *			<span class="page">Page</span>
 *			<span class="page-numbers current">1</span>
 *			<span class="dots-of">of</span>
 *			<a class="page-numbers" href="/page/8/">8</a>
 *		</div>
 *		<a class="next page-numbers" href="/page/2/">Newer posts</a>
 *	</div>
 *
 * @param array pagination links
 * @param array pagination configuration
 * @return string
 */
function wpgrade_callback_pagination_formatter($links, $conf) {
	$linkcount = count($links);

	//don't show anything when no pagination is needed
	if ($linkcount == 0) {
		return '';
	}
	$prefix = '';
	$suffix = '<!--';

	$current = (get_query_var('paged')) ? get_query_var('paged') : '';
	if( empty($current)){
		$current = (get_query_var('page')) ? get_query_var('page') : '';
	}

	foreach ( $links as $key => &$link ) {

		if ( $key == $linkcount - 1 ) {
			$suffix = '';
		}
		$class = '';
		switch ( $key ) {
			case $current:
				$class .= 'class="pagination-item pagination-item--current"';
				break;
			case 0:
				$class .= 'class="pagination-item pagination-item--prev"';
				break;
			case $linkcount - 1:
				$class .= 'class="pagination-item pagination-item--next"';
				break;
			case 1:
				if ( is_front_page() && $current != '') {
					$link = "<a class='page-numbers' href='" . home_url() ."'>1</a>";
				}
				break;
			default:
				break;
		}


		$link = $prefix .'<li '.$class.'>' . $link . '</li>' . $suffix;
		$prefix = "\n-->";
	}

	return
		'<ol class="nav pagination">'.implode('', $links).'</ol>';
}


/** Do the same thing on single post pagination */

function wpgrade_pagination_custom_markup($link, $key) {
	global $wp_query;
	$current = (get_query_var('page')) ? get_query_var('page') : '1';
	$class = '';
	$prefix = '-->';
	$suffix = '<!--';
	switch ( $key ) {
		case $current:
				$class .= 'class="pagination-item pagination-item--current"';
				$link = '<span>' . $link . '</span>';
			break;
		case 'prev':
				$class .= 'class="pagination-item pagination-item--prev"';
			break;
		case 'next':
				$class .= 'class="pagination-item pagination-item--next"';
			break;
		default:
			break;
	}

	$link = $prefix .'<li '.$class.'>' . $link . '</li>' . $suffix;
	return $link;

}
add_filter('wp_link_pages_link', 'wpgrade_pagination_custom_markup', 10, 2);