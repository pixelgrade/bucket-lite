<?php

	#
	# This file performs initial environment setup.
	#

	// ensure EXT is defined
	if ( ! defined('EXT')) {
		define('EXT', '.php');
	}

	$basepath = dirname(__FILE__).DIRECTORY_SEPARATOR;
	require $basepath.'wpgrade'.EXT;


	// Dynamically load in all classes
	// -------------------------------

	# Loading convention: if it's a PHP file it's loaded, the shorter the path
	# the higher the priority

	$classpath = $basepath.'classes'.DIRECTORY_SEPARATOR;
//	$files = wpgrade::find_files($classpath);
//
//	// ensure base classes are loaded first
//	sort($files, SORT_ASC);
//
//	foreach ($files as $file) {
//		if (strpos($file, EXT) !== false) {
//			require $file;
//		}
//	}

	wpgrade::require_all($classpath);


	// Setup translations
	// ------------------

	load_theme_textdomain
		(
			wpgrade::textdomain(),
			wpgrade::themefilepath
				(
					wpgrade::confoption
						('language-path', 'languages')
				)
		);


	// Setup Option Drivers
	// --------------------

	// the handler is the main object responsible for managing the drivers
	wpgrade::options_handler(new WPGradeOptions());

	# [!!] driver priority works like a LIFO stack, last in = highest priority

	// register basic configuration driver
	$config = wpgrade::config();
	wpgrade::options()->add_optiondriver(new WPGradeOptionDriver_Config($config['theme-options']));

	// we register redux as option driver via a resolver

	function wpgrade_callback_bootstrap_redux_instance($redux) {
		$reduxdriver = new WPGradeOptionDriver_Redux($redux);
		wpgrade::options()->add_optiondriver($reduxdriver);
	}

	wpgrade::register_resolver('redux-instance', 'wpgrade_callback_bootstrap_redux_instance');


	// Plugins & Resolvable Dependencies
	// ---------------------------------

	require wpgrade::themefilepath(wpgrade::confoption('theme-adminpanel-path', 'theme-content/admin-panel').'/bootstrap'.EXT);


	// Hooks
	// -----

	require 'hooks'.EXT;


	// Upgrade Notifier
	// ----------------

	if (is_admin() && basename($_SERVER["PHP_SELF"]) != 'update-core.php') {
	   add_action('admin_enqueue_scripts', 'wpgrade_callback_update_notifier_admin_initialization');
	   add_action('admin_menu', 'wpgrade_callback_update_notifier_menu');
	   add_action('admin_bar_menu', 'wpgrade_callback_update_notifier_bar_menu', 1000);
	   add_action('admin_init', 'wpgrade_callback_update_notifier_handler');
	   add_action('admin_notices', 'wpgrade_callback_update_notifier_update_notice');
	}


	// Media Handlers
	// --------------

	// make sure that WordPress allows the upload of our used mime types
	add_filter('upload_mimes', 'wpgrade_callback_custom_upload_mimes');
	// remove the first gallery shortcode from the content
	add_filter('the_content', 'wpgrade_callback_gallery_slideshow_filter');
