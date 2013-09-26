<?php

    // ensure EXT is defined
    if ( ! defined('EXT')) {
        define('EXT', '.php');
    }

    $ds = DIRECTORY_SEPARATOR;
    $themecallbackpath = dirname(__FILE__).$ds.'theme-callbacks'.$ds;
	

    // Theme specific settings
    // -----------------------

    // add theme support for post formats
    // child themes note: use the after_setup_theme hook with a callback
    $formats = array('quote', 'video', 'audio', 'gallery');
    add_theme_support('post-formats', $formats);


    // Initialize system core
    // ----------------------
    require_once 'wpgrade-core/bootstrap'.EXT;

	/**
	 * Require theme-callbacks :
	 * - Activation hooks
	 * - Shortcodes filters and scripts
	 * - Theme specific script enqueue setup handlers
	 * - Theme specific callbacks
	 * - Theme content filters
	 * - Pagination Formatter
	 * - Cleanup @todo CLEANUP remove unsorted functions
	 */
	wpgrade::require_all($themecallbackpath);

    #
    # Please perform any initialization via options in wpgrade-config and
    # calls in wpgrade-core/bootstrap. Required for testing.
    #
