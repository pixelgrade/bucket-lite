<?php

/*
 * Custom Thumbnails
 */

function wpgrade_custom_thumbnails (){
    // Add theme support for Featured Images
    add_theme_support( 'post-thumbnails' );
	
	add_image_size('blog-big', 800);
	add_image_size('blog-medium', 500);
	
    add_image_size('portfolio-big', 800, 440, true);
    add_image_size('portfolio-medium', 600, 330, true);
    add_image_size('portfolio-small', 400, 220, true);
    add_image_size('portfolio-big-v', 440, 800, true);
    add_image_size('portfolio-medium-v', 330, 600, true);
    add_image_size('portfolio-small-v', 220, 400, true);    
}

add_action( 'after_setup_theme', 'wpgrade_custom_thumbnails');

//function wpgrade_filter_image_sizes( $sizes ) {
//    unset( $sizes['thumbnail']);
//    unset( $sizes['medium']);
//    unset( $sizes['large']);
//
//    return $sizes;
//}
//add_filter('intermediate_image_sizes_advanced', 'wpgrade_filter_image_sizes');

/*
 * Get thumbnails
 * @param string $size Optional, default is 'full'.
 * @param string $class Class to put on img. Default is none.
 * @param bool $use_as_background Optional, default is false. Whether use the image as background on a div.
 * @return bool $force Force the function to return an image from theme options or from theme.
 */

function wpgrade_get_thumbnail( $size = 'full', $class = '', $use_as_background = false, $force = false ){

    global $post;
    $post_id = $post->ID;

    $default_img = wpgrade::option("default_thumbnail_".$size);
    $src = '';
    if ( has_post_thumbnail($post_id )) { // take only the featured image src

        $thumbnail_id = get_post_thumbnail_id($post_id);
        $src = wp_get_attachment_image_src($thumbnail_id, $size);
        $src= $src[0];

    } elseif ( get_post_format() == 'image') { // take the first image from the content

        $thumbnail_id = wpgrade_get_attachment_id_from_src(wpgrade_get_post_first_image());
        $src = wp_get_attachment_image_src($thumbnail_id, $size);
        $src= $src[0];

    } elseif( !empty($default_img) && $force == true ) { // take the default image setted in theme options

        $src = $default_img;

    } elseif ($force == true) { // get the default thumbnail

        $src = get_template_directory_uri() .'/library/images/default_thumbnail_'.$size.'.png';

    }
    if ( !empty($src) ) {

        if ( $use_as_background ) {

            $output = '<div class="'.$class.'"  style="background-image: url(\''.$src.'\');" ></div>';

        } else {

            $output = '<img class="'.$class.'" src="'.$src.'" />';
        }

        echo $output;
    } else {
        return '';
    }

}