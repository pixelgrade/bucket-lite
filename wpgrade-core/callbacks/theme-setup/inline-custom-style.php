<?php

	/**
	 * This callback is invoked by wpgrade_callback_themesetup.
	 *
	 * The function is executed on wp_head
	 */
	function wpgrade_callback_inlined_custom_style() {
		$main_color = wpgrade::option('main_color');
		$rgb = implode(',', wpgrade::hex2rgb_array($main_color));
		$fonts = array();

		if (wpgrade::option('use_google_fonts')) {
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
					$key = str_replace('google_', '', $font);
					$fonts[$key] = $clean_font;
				}
			}
		}

		$port_color = '';
		if (wpgrade::option('portfolio_text_color')) {
			$port_color = wpgrade::option('portfolio_text_color');
			$port_color = str_replace('#', '', $port_color);
		}

		// any variables in scope will be available in the partial
		include wpgrade::corepartial('inline-custom-css'.EXT);
	}
