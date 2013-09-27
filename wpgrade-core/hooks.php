<?php

	$ds = DIRECTORY_SEPARATOR;

	#
	# This file assigns environment hooks.
	#

	// Include all theme specific classes and functions
	// ------------------------------------------------------------------------

	$themeincludepaths = wpgrade::confoption('include-paths', array());

	foreach ($themeincludepaths as $path) {
		$fullpath = wpgrade::themepath().$ds.$path;
		if (file_exists($fullpath)) {
			wpgrade::require_all($fullpath);
		}
	}


	// Theme Setup
	// ------------------------------------------------------------------------

	$callbackspath = dirname(__FILE__).$ds.'callbacks'.$ds;
	wpgrade::require_all($callbackspath.'theme-setup');

	/**
	 * ...
	 */
	function wpgrade_callback_themesetup() {
		// register resources
		add_action('wp_enqueue_scripts', 'wpgrade_callback_register_theme_resources', 1);

		// auto-enque based on configuration entries and callbacks
		add_action('wp_enqueue_scripts', 'wpgrade_callback_enqueue_theme_resources', 1);

		// custom javascript handlers
		add_action('wp_enqueue_scripts', 'wpgrade_callback_load_custom_js', 9001);

		if ( wpgrade::option('display_custom_css_inline')) {
			add_action('wp_head', 'wpgrade_callback_inlined_custom_style');
		}

		// the callback wpgrade_callback_custom_theme_features should be placed
		// in functions.php and contain theme specific settings
		if (function_exists('wpgrade_callback_custom_theme_features')) {
			// register theme features
			add_action('after_setup_theme', 'wpgrade_callback_custom_theme_features');
		}

		// cleanup the content (eg. remove <p>s around images)
		add_filter('the_content', 'wpgrade_callback_cleanup_the_content');
		// cleanup excerpt (eg. replace [..] with a Read more link)
//		add_filter('excerpt_more', 'wpgrade_callback_cleanup_excerpt');
//		// cleanup read more tag link
//		add_filter('the_content_more_link', 'wpgrade_callback_cleanup_readmore_content', 10, 2);
	}

	add_action('after_setup_theme', 'wpgrade_callback_themesetup', 16);


	/**
	 * ...
	 */
	function wpgrade_callbacks_setup_shortcodes_plugin() {
		$current_options = get_option('wpgrade_shortcodes_list');

		$config = wpgrade::config();
		$shortcodes = $config['shortcodes'];

		// create an array with shortcodes which are needed by the
		// current theme
		if ($current_options) {
			$diff = array_diff($shortcodes, $current_options);
			if ( ! empty($diff) && is_admin()) {
				update_option('wpgrade_shortcodes_list', $shortcodes);
			}
		}
		else { // there is no current shortcodes list
			update_option('wpgrade_shortcodes_list', $shortcodes);
		}

		// we need to remember the prefix of the metaboxes so it can be used
		// by the shortcodes plugin
		$current_prefix = get_option('wpgrade_metaboxes_prefix');
		if (empty($current_prefix)) {
			update_option('wpgrade_metaboxes_prefix', wpgrade::prefix());
		}
	}

	add_action('admin_head', 'wpgrade_callbacks_setup_shortcodes_plugin');


	/**
	 * ...
	 */
	function wpgrade_callbacks_html5_shim() {
		global $is_IE;
		if ($is_IE) {
			include wpgrade::themefilepath('theme-partials/wpgrade-partials/ie-shim'.EXT);
		}
	}
