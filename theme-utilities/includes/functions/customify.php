<?php

function bucket_lite_add_customify_options( $config ) {
	$config['sections'] = array();
	$config['panels']   = array();
	return $config;
}
add_filter( 'customify_filter_fields', 'bucket_lite_add_customify_options' );
function bucket_lite_prevent_register_admin_customizer_styles() {
	if ( class_exists( 'PixCustomifyPlugin' ) ) {
		$customify = PixCustomifyPlugin::instance();
		remove_action( 'customize_controls_init', array( $customify, 'register_admin_customizer_styles' ), 10 );
		remove_action( 'customize_controls_init', array( $customify, 'register_admin_customizer_scripts' ), 15 );
	}
}
add_action( 'customize_controls_init', 'bucket_lite_prevent_register_admin_customizer_styles', 1 );
function bucket_lite_prevent_customize_controls_enqueue_scripts() {
	if ( class_exists( 'PixCustomifyPlugin' ) ) {
		$customify = PixCustomifyPlugin::instance();
		remove_action( 'customize_controls_enqueue_scripts', array(
			$customify,
			'enqueue_admin_customizer_styles'
		), 10 );
		remove_action( 'customize_controls_enqueue_scripts', array(
			$customify,
			'enqueue_admin_customizer_scripts'
		), 15 );
	}
}
add_action( 'customize_controls_enqueue_scripts', 'bucket_lite_prevent_customize_controls_enqueue_scripts', 1 );
function bucket_lite_prevent_customize_preview_init_scripts() {
	if ( class_exists( 'PixCustomifyPlugin' ) ) {
		$customify = PixCustomifyPlugin::instance();
		remove_action( 'customize_preview_init', array( $customify, 'customizer_live_preview_register_scripts' ), 10 );
		remove_action( 'customize_preview_init', array(
			$customify,
			'customizer_live_preview_enqueue_scripts'
		), 99999 );
	}
}
add_action( 'customize_preview_init', 'bucket_lite_prevent_customize_preview_init_scripts', 1 );
function bucket_lite_prevent_customize_controls_print_footer_scripts() {
	if ( class_exists( 'PixCustomifyPlugin' ) ) {
		$customify = PixCustomifyPlugin::instance();
		remove_action( 'customize_controls_print_footer_scripts', array(
			$customify,
			'customize_pane_settings_additional_data'
		), 10000 );
	}
}
add_action( 'customize_controls_print_footer_scripts', 'bucket_lite_prevent_customize_controls_print_footer_scripts', 1 );
function bucket_lite_customify_body_classes( $classes ) {
	// Remove the 'customify' class if present
	if ( $key = array_search( 'customify', $classes ) ) {
		unset( $classes[ $key ] );
	}
	return $classes;
}
add_filter( 'body_class', 'bucket_lite_customify_body_classes', 100, 1 );


function bucket_range_negative_value( $value, $selector, $property, $unit ) {

	$output = $selector .'{
		' . $property . ': -' . $value . '' . $unit . ";\n" .
	          "}\n";

	return $output;
}

function bucket_hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
//     return implode(",", $rgb); // returns the rgb values separated by commas
	return $rgb; // returns an array with the rgb values
}

function bucket_category_color_first( $value, $selector, $property, $unit ) {

	global $post;
	global $wp_query;

	if ( is_category() ) {
		$category_id = $wp_query->get_queried_object_id();
		if ( ! empty( $category_id ) && ! is_wp_error($category_id) )  {
			$value = get_category_color( $category_id );
		}

	} elseif( is_single() ) {
		$categories = get_the_category(  $post->ID );
		if ( ! empty( $categories[0] ) ) {
			$category_id = $categories[0]->cat_ID;
			$value = get_category_color( $category_id );
		}
	}

	$output = $selector .'{
		' . $property . ": " . $value . ";\n" .
	          "}\n";

	return $output;
}
