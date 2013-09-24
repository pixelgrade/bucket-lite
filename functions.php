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
    require_once 'wpgrade-system/bootstrap'.EXT;

    #
    # Please perform any initialization via options in wpgrade-config and
    # calls in wpgrade-system/bootstrap. Required for testing.
    #

    /**
     * PixSlider Shortcode
     * 
     * [pixslider_func description]
     * 
     * [pixslider arrows="true/false" bullets="true/false"]
     * [pixslide]
     * [/pixslider]
     * 
     * @param  [array()] $atts    
     * @param  [string]  $content 
     * @return [string]           
     */
    function pixslider_func( $atts, $content = null ){
        $return_string = '';

        extract( shortcode_atts( array(
            'arrows' => 'false',
            'bullets' => 'true',
            'autoheight' => 'true'
        ), $atts ) );

        $arrows = $atts['arrows'];
        if($arrows == 'true') $arrows = 'data-arrows'; 
        else  $arrows = '';

        $bullets = $atts['bullets'];
        if($bullets == 'true') $bullets = 'data-bullets'; 
        else  $bullets = '';        

        $return_string .= '<div class="pixslider js-pixslider" ' . $arrows . ' ' . $bullets .' data-autoheight>';

        $return_string .= do_shortcode($content);

        $return_string .= '</div>';
        return $return_string;
    }
    add_shortcode( 'pixslider', 'pixslider_func');


    /**
     * PixSlide Shortcode
     * 
     * [pixslide_func description]
     *
     * [pixslide author_name="Author Name" author_title="Author title"]
     * Slide content
     * [/pixslide]
     * 
     * @param  [array()] $atts    
     * @param  [string]  $content 
     * @return [string]          
     */
    function pixslide_func( $atts, $content = null ){
        extract( shortcode_atts( array(
            'author_name' => 'Author Name',
            'author_title' => 'Author title',
        ), $atts ) );

        $author_name = $atts['author_name'];
        $author_title = $atts['author_title'];

        $return_string = '';

        $return_string .= '<blockquote class="pixcode--testimonial">';
        $return_string .= '<p class="quote__content">' . $content . '</p>';
        $return_string .= '<p class="author__name">' . $author_name . '</p>';
        $return_string .= '<p class="author__title">' . $author_title . '</p>';
        $return_string .= '</blockquote>';

        return $return_string;
    }
    add_shortcode( 'pixslide', 'pixslide_func');