<?php

	/**
	 * Load google fonts appropriate script block.
	 *
	 * This callback is invoked by wpgrade_callback_enqueue_dynamic_css
	 */
	function wpgrade_callback_load_google_fonts() {
		if (wpgrade::option('use_google_fonts')) {

			$fonts_array = array
				(
					'google_main_font',
					'google_second_font',
					'google_menu_font',
					'google_body_font'
				);

			$families = array();
			foreach ($fonts_array as $font) {
				$clean_font = wpgrade::css_friendly_font($font);
				if ( ! empty($clean_font)) {
					$families[] = $clean_font;
				}
			}

			if ( ! empty($families)) {
				// any variables in scope will be available in the partial
				include wpgrade::themefilepath('wpgrade-partials/google-fonts-script'.EXT);
			}
		}
	}

	/**
	 * This callback is invoked by wpgrade_callback_themesetup.
	 */
	function wpgrade_callback_enqueue_dynamic_css() {
		$style_query = array();

		if (wpgrade::option('main_color')) {
			$main_color = wpgrade::option('main_color');
			$main_color = str_replace('#', '', $main_color);
			$style_query['color'] = $main_color;
		}

		if (wpgrade::option('use_google_fonts')) {
			add_action('wp_head', 'wpgrade_callback_load_google_fonts');

			$fonts_array = array
				(
					'google_main_font',
					'google_second_font',
					'google_menu_font',
					'google_body_font'
				);

			foreach ($fonts_array as $font) {
				$clean_font = wpgrade::css_friendly_font($font);
				if ( ! empty($clean_font)) {
					$stylename = str_replace('google_', '', $font);
					$style_query[$stylename] = $clean_font;
				}
			}
		}

		if (wpgrade::option('portfolio_text_color')) {
			$port_color = wpgrade::option('portfolio_text_color');
			$port_color = str_replace('#', '', $port_color);
			$style_query['port_color'] = $port_color;
		}

		$custom_css = wpgrade::option('custom_css');

		if ($custom_css) {
			$style_query['custom_css'] = $custom_css;
		}

		// if we didn't include the style inline, pass it to the script
		if ( ! wpgrade::option('display_custom_css_inline')) {
			 wp_enqueue_style('wpgrade-php-style', wpgrade::content_url() . 'css/custom.css.php?'.http_build_query($style_query, '', '&amp;'));
		}
	}
