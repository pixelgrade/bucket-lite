<?php

	/**
	 * Remove the first gallery shortcode from the content
	 */
	function wpgrade_callback_gallery_slideshow_filter($content) {
		if (get_post_format() == 'gallery') {
			// search for the first gallery shortcode
			$gallery_matches = null;
			preg_match("!\[gallery.+?\]!", $content, $gallery_matches);

			if ( ! empty($gallery_matches)) {
				$content = str_replace($gallery_matches[0], "", $content);
			}
		}

		return $content;
	}
