<?php

	function wpgrade_callback_portfolio_display_custom_orderby($orderby) {
		global $wpdb;
		return "$wpdb->postmeta.meta_value DESC, $wpdb->posts.menu_order DESC, $wpdb->posts.post_date DESC";
	}

	function wpgrade_get_portfolio_row($row, $is_first) {
		$content = '';
		$pattern_type = '';
		$images = array();

		foreach ($row as $k => $field) {
			if (preg_match('/^pattern_type/', $k)) {
				$pattern_type = $field;
				continue;
			}

			// look for editor
			if (preg_match( '/^editor/', $k )) {
				$content = $field;
				continue;
			}

			// get images
			if (preg_match('/^image/', $k)) {
				$images[$k] = $field;
				continue;
			}

			// get videos
			if (preg_match('/^video/', $k)) {
				$video[$k] = $field;
				continue;
			}
		}

		if (empty($pattern_type)) {
			return false;
		}

		// get keys and values for each image
		if (empty($images)) {
			$img_key = array();
			$img_val = array();
		}
		else { // empty images
			$img_key = array_keys($images);
			$img_val = array_values($images);
		}

		$popup = '';
		if (is_single()) {
			$popup = 'popup block-image';
		}
		else { // ! is_single
			$popup = 'block-image';
		}

		include wpgrade::themefilepath('theme-utils/assets/portfolio-gallery/portfolio-row');

		return true;
	}

	function wpgrade_get_portfolio_image_link($val, $size = 'full') {
		$img_link = '';
		if (is_single()) {
			$img1 = json_decode($val,true);
			if ( ! empty($img1)) {
				$link = wp_get_attachment_image_src( $img1['id'], $size );
				$img_link = $link[0];
			}
		}
		else { // ! is_single
			$img_link = get_permalink(get_the_ID());
		}

		return $img_link;
	}

	function wpgrade_get_portfolio_image_src($val, $size = 'full') {
		$img1 = json_decode($val, true);
		$img_link = '';
		if ( ! empty($img1)) {
			$link = wp_get_attachment_image_src((int) $img1['id'], $size);
			$img_link = $link[0];
		}

		return $img_link;
	}

	function wpgrade_get_attachment_image_src( $id, $size = 'full' ) {

		$img_link = '';
		if ( ! empty($id)) {
			$link = wp_get_attachment_image_src($id, $size);
			$img_link = $link[0];
		}

		return $img_link;
	}

	function wpgrade_get_portfolio_image_alt( $val ) {
		$img1 = json_decode($val,true);

		$img_alt = '';
		if ( ! empty($img1)) {
			$img_alt = get_post_meta($img1['id'], '_wp_attachment_image_alt', true);
			if (empty($img_alt)) {
				$attachment = get_post($img1['id']);
				if ( ! empty($attachment)) {
					$img_alt = $attachment->post_excerpt;
				}
			}
		}

		return $img_alt;
	}

	function wpgrade_get_portfolio_video($videos) {
		foreach ($videos as $k => $video) {
			if (preg_match('/embed/', $k) && ! empty($video)) {
				echo '<div class="video-wrap">'.$video.'</div>';
				break;
			}
			elseif (preg_match('/mp4/', $k)) {
				$video_mp4 = $video;
			}
			elseif (preg_match('/webm/', $k)) {
				$video_webm = $video;
			}
			elseif (preg_match('/ogv/', $k)) {
				$video_ogv =  $video;
			}
			elseif (preg_match('/preview/', $k)) {
				$video_poster =  $video;
			}
		}

		if ( ! preg_match('/embed/', $k)) {
			include wpgrade::themefilepath('theme-utils/assets/portfolio-gallery/portfolio-video'.EXT);
		}

		return false;
	}

	function wpgrade_display_portfolio_terms(){
		$terms_list = wp_get_post_terms( get_the_ID(), 'portfolio_cat', array("fields" => "all"));
		if ( ! empty($terms_list)) {
			include wpgrade::themefilepath('theme-utils/assets/portfolio-gallery/portfolio-terms'.EXT);
		}
	}

	function wpgrade_display_blog_terms(){
		$terms_list = wp_get_post_terms( get_the_ID(), 'category', array("fields" => "all"));
		if ( ! empty($terms_list)) {
			include wpgrade::themefilepath('theme-utils/assets/portfolio-gallery/blog-terms'.EXT);
		}
	}
	