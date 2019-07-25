<?php

/*
 * Custom Thumbnails
 */

function wpgrade_custom_thumbnails (){
    
    // Add theme support for Featured Images
    add_theme_support( 'post-thumbnails' );
	
	add_image_size('slider-big', 1050, 600, true);

    // Hero Post, Category Slider, Mega Menu Slider 
    add_image_size('post-big', 700, 450, true);

    // Post Cards, Latest Posts Widget, 
    add_image_size('post-medium', 335, 256, true);

    // Hero Posts Small, Mega Menu Posts, Latest Posts Widget 
    add_image_size('post-small', 203, 157, true);
    add_image_size('post-tiny', 72, 54, true);


    // Latest Posts Grid
    add_image_size('blog-medium', 335);

    // Featured Image
    add_image_size('blog-big', 1050);
}

add_action( 'after_setup_theme', 'wpgrade_custom_thumbnails');
