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
	$files = wpgrade::find_files($classpath);

	// ensure base classes are loaded first
	sort($files, SORT_ASC);

	foreach ($files as $file) {
		if (strpos($file, EXT) !== false) {
			require $file;
		}
	}


	// Setup translations
	// ------------------

	load_theme_textdomain(wpgrade::textdomain(), wpgrade::themefilepath('theme-content/languages'));


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

	require wpgrade::themefilepath('theme-content/admin-panel/bootstrap'.EXT);

	if (is_admin() && basename($_SERVER["PHP_SELF"]) != 'update-core.php') {
		require wpgrade::themefilepath('theme-content/inc/upgrade-notifier'.EXT);
	}

	// plugins & custom theme support
	require wpgrade::themefilepath('theme-content/inc/required-plugins/required-plugins.php');
	require wpgrade::themefilepath('theme-content/inc/widgets.php');
	require wpgrade::themefilepath('theme-content/inc/custom-admin-login.php');
	require wpgrade::themefilepath('theme-content/inc/menus.php');
	require wpgrade::themefilepath('theme-content/inc/media.php');
	require wpgrade::themefilepath('theme-content/inc/thumbnails.php');
	require wpgrade::themefilepath('theme-content/inc/portfolio-gallery.php');
	require wpgrade::themefilepath('theme-content/inc/template-tags.php');
	require wpgrade::themefilepath('theme-content/inc/theme-defaults.php');
	include wpgrade::themefilepath('theme-content/inc/social.php');
	include wpgrade::themefilepath('theme-content/inc/admin-help-pointers.php');


	// Hooks
	// -----

	require 'hooks.php';
