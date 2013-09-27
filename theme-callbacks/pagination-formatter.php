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
		// Calculate prev link
		// -------------------

		if ($linkcount == 0 || ! preg_match('/class="prev/', $links[0])) {
			$prev_page = # disabled version
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
			$next_page = # disabled version
				'
					<a class="next disabled page-numbers">
						'.$conf['next_text'].'
					</a>
				';
		}
		else { // we have next link
			$next_page = $links[$linkcount - 1];
		}
		
		return
			'
				<div class="wpgrade_pagination">'.$prev_page.$next_page.'</div>
			';
	}