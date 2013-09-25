<?php

    // ensure EXT is defined
    if ( ! defined('EXT')) {
        define('EXT', '.php');
    }

    $ds = DIRECTORY_SEPARATOR;
    $themecallbackpath = dirname(__FILE__).$ds.'theme-callbacks'.$ds;

    // Theme specific script enqueue setup handlers
    // --------------------------------------------

    include $themecallbackpath.'resource-enqueues'.EXT;


    // Theme specific callbacks
    // ------------------------

    include $themecallbackpath.'theme-features'.EXT;


    // Theme content filters
    // ---------------------

    include $themecallbackpath.'content-filters'.EXT;


    // Pagination Formatter
    // --------------------

    include $themecallbackpath.'pagination-formatter'.EXT;


    // Cleanup
    // -------

    // @todo CLEANUP remove unsorted functions

    include $themecallbackpath.'unsorted'.EXT;


    // Theme specific settings
    // -----------------------

    // add theme support for post formats
    // child themes note: use the after_setup_theme hook with a callback
    $formats = array('quote', 'video', 'audio', 'gallery');
    add_theme_support('post-formats', $formats);


    // Initialize system core
    // ----------------------
    require_once 'wpgrade-core/bootstrap'.EXT;

    #
    # Please perform any initialization via options in wpgrade-config and
    # calls in wpgrade-core/bootstrap. Required for testing.
    #
