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

	$current = '';
	if ( isset( $_GET['paged'] ) ) {
		$current = $_GET['paged'];
	}

	foreach ( $links as $key => &$link ) {

		if ( $key == $linkcount - 1 ) {
			$suffix = '';
		}

		$class = '';

		switch ( $key ) {
			case 0:
				$class .= 'class="pagination__prev"';
				break;
			case $current:
				$class .= 'class="current"';
				break;
			case $linkcount - 1:
				$class .= 'class="pagination__next"';
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

//function this_function_plm($link, $i) {
////var_dump($i);
//	$link = '<li>'. $link . '</li>';
//	return $link;
//
//}
//add_filter('wp_link_pages_link', 'this_function_pllm', 10, 2);

function this_function_plm($link, $key) {
	$current = '';
	if ( isset( $_GET['paged'] ) ) {
		$current = $_GET['paged'];
	}
	$class = '';
	$prefix = '-->';
	$suffix = '<!--';
	switch ( $key ) {
		case 'prev':
			$class .= 'class="pagination__prev"';
//			$prefix = '';
//			$suffix = '<!--';
			break;
		case $current:
//			if ( $current == '1' ) {
//				$prefix = '';
//			}
			$class .= 'class="current"';
			break;
		case 'next':
			$class .= 'class="pagination__next"';
//			$prefix = '-->';
//			$suffix = '';
			break;
		default:
			break;
	}

	$link = $prefix .'<li '.$class.'>' . $link . '</li>' . $suffix;
	return $link;

}
add_filter('wp_link_pages_link', 'this_function_plm', 10, 2);