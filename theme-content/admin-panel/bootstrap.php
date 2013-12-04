<?php

	$currentpath = dirname(__FILE__).DIRECTORY_SEPARATOR;

	#
	# All relevant configuration information (args, sections, tabs) have been
	# moved to redux-* files located in the same section as this file.
	#
	# The setup function, ie. setup_framework_options has been renamed to
	# wpgrade_call_redux_options_setup since this is the only place it's used
	# and god knows "framework" is what everyone and their monther calls
	# anything they make these days.
	#
	# The use of the global has been removed in favor of using a proper Options
	# object at the theme level, which accepts more then just redux as a
	# source and may have multiple sources. This is both more flexible
	# and a cleaner implementation.
	#
	# The file has also been purged of code that had no effect, with the
	# exception of configuration file commented out entries, since those are
	# generally helpful.
	#

	wpgrade::require_coremodule('redux3');

//	function wpgrade_callback_redux_options_setup() {
		$currentpath = dirname(__FILE__).DIRECTORY_SEPARATOR;

		$wpgrade_redux_coremodule = 'redux3'; # used inside configuration files
		$args = include $currentpath.'redux-args'.EXT;
		$sections = include $currentpath.'redux-sections'.EXT;
		$tabs = include $currentpath.'redux-tabs'.EXT;

		$redux = new ReduxFramework($sections, $args, $tabs);
		wpgrade::resolve('redux-instance', $redux);
//	}
//	add_action('after_setup_theme', 'wpgrade_callback_redux_options_setup', 1);

	/**
	 * Enquue our custom css on admin panel
	 */
	function wpgrade_add_admin_custom_style() {

		wp_enqueue_style(
			'redux-custom-css',
			wpgrade::resourceuri('css/admin/admin-panel.css'),
			array(), // Be sure to include redux-css so it's appended after the core css is applied
			time(),
			'all'
		);

		wp_enqueue_script(
			'redux-custom-js',
			wpgrade::resourceuri('js/admin/admin-panel.js'),
			array('jquery', 'redux-js','wp-ajax-response' ), // Be sure to include redux-css so it's appended after the core css is applied
			time(),
			true
		);
	}
	// This example assumes your opt_name is set to redux, replace with your opt_name value
	add_action('redux-enqueue-'. wpgrade::shortname() . '_options', 'wpgrade_add_admin_custom_style',0);

	// register callbacks
	require $currentpath.'callbacks'.EXT;

