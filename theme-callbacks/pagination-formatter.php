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

		return '[pagination placeholder]';

		// @todo HIGH complete work....

		$pager_links = array();
		$linkcount = count($links);

		// Calculate prev link
		// -------------------

		if ($linkcount == 0 || ! preg_match('/class="prev/', $links[0])) {
			$prev_page =
				'
					<a class="prev disabled page-numbers">
						'.$conf['prev_text'].'
					</a>
				';
		}
		else { // prev page link available
			$prev_page = $links[0];
		}

		// Calculate next link
		// -------------------

		if ($linkcount == 0 || ! preg_match('/class="next/', $links[$linkcount - 1])) {
			$next_link =
				'
					<a class="next disabled page-numbers">
						'.$conf['next_text'].'
					</a>
				';
		}
		else { // we have next link
			$next_link = $links[$linkcount - 1];
		}

		// Format current page
		// -------------------

		if ( ! empty($pager_links)) {
			foreach ($links as $key => $link) {
				if (preg_match('/current/', $link)) {
					$pager_links[1] = '<span class="page">Page</span>';
					$pager_links[2] = $link;
					break;
				}
			}
		}

		if ($last_el > 0) {
			$pager_links[3] = '<span class="dots-of">of</span>';
			$pager_links[4] = $links[$last_el];
		}

		ksort($pager_links);

		$result = '';
		foreach ($pager_links as $key => $link) {
			$result .= $link;
		}

		$result .= '</div>';

		return $result;
	}