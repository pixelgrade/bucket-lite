<?php

add_theme_support( 'post-thumbnails' ); 

// Register Navigation Menus
if ( ! function_exists( 'lens_navigation_menus' ) ) {

    function lens_navigation_menus() {
        $locations = array(
            'menu-header' => __( 'Header Menu', 'lens' ),
        );
        register_nav_menus( $locations );
    }
    // Hook into the 'init' action
    add_action( 'init', 'lens_navigation_menus' );
}

// Register Sidebars
if ( ! function_exists('lens_sidebars') ) {

    function lens_sidebars()  {
        $args = array(
            'id'            => 'sidebar-blog',
            'name'          => __( 'Blog Sidebar', 'lens_txtd' ),
            'description'   => __( 'Blog Sidebar', 'lens_txtd' ),
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
        );
        register_sidebar( $args );

        $args = array(
            'id'            => 'sidebar-header',
            'name'          => __( 'Header Sidebar', 'lens_txtd' ),
            'description'   => __( 'Header Sidebar', 'lens_txtd' ),
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
        );
        register_sidebar( $args );
    }
    // Hook into the 'widgets_init' action
    add_action( 'widgets_init', 'lens_sidebars' );

}

// Register stylesheets
if ( ! function_exists('lens_scripts') ) {
    
    function lens_scripts() {
        wp_register_style( 'main-style', get_template_directory_uri() . '/css/style.css' );
        wp_enqueue_style( 'main-style' );

        wp_register_script( 'main-scripts', get_template_directory_uri() . '/js/main.js', array('jquery') );
        wp_enqueue_script( 'main-scripts' );
    }

    add_action( 'wp_enqueue_scripts', 'lens_scripts' );
}