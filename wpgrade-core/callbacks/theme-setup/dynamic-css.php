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
				include wpgrade::themefilepath('wpgrade-core/resources/views/google-fonts-script'.EXT);
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

		if ( wpgrade::option('inject_custom_css') == 'file' ){
            wp_enqueue_style('wpgrade-custom-style', get_template_directory_uri() . '/theme-content/css/custom.css' );
        }
	}
