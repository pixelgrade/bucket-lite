<?php

$ds = DIRECTORY_SEPARATOR;

#
# This file assigns environment hooks.
#

// Include all theme specific classes and functions
// ------------------------------------------------------------------------

$themeincludepaths = wpgrade::confoption( 'include-paths', array() );

foreach ( $themeincludepaths as $one_path ) {
	$fullpath = wpgrade::themepath() . $ds . $one_path;
	if ( file_exists( $fullpath ) ) {
		wpgrade::require_all( $fullpath );
	}
}

$themeincludefiles = wpgrade::confoption( 'include-files', array() );
foreach ( $themeincludefiles as $file ) {

	if ( file_exists( wpgrade::childpath() . $file ) ) {
		require wpgrade::childpath() . $file;
	} else {
		require wpgrade::themepath() . $file;
	}
}


// Include core specific callbacks
// ------------------------------------------------------------------------

$callbackspath = dirname( __FILE__ ) . $ds . 'callbacks';
wpgrade::require_all( $callbackspath );


// Theme Setup
// ------------------------------------------------------------------------

/**
 * ...
 */
function wpgrade_callback_themesetup() {

	// General Purpose Resource Handling
	// ---------------------------------

	// register resources
	add_action( 'wp_enqueue_scripts', 'wpgrade_callback_register_theme_resources', 1 );

	// auto-enque based on configuration entries and callbacks
	add_action( 'wp_enqueue_scripts', 'wpgrade_callback_enqueue_theme_resources', 1 );

	$themeconfiguration = wpgrade::config();

	// Specialized Resource Handling
	// -----------------------------

	// extra script equeue handlers
	foreach ( $themeconfiguration['resources']['script-enqueue-handlers'] as $callback ) {
		if ( $callback !== null ) {
			if ( ! is_array( $callback ) ) {
				add_action( 'wp_enqueue_scripts', $callback, 10 );
			} else { // $callback is array
				if ( ! empty( $callback['handler'] ) ) {
					isset( $callback['priority'] ) or $callback['priority'] = 10;
					add_action( 'wp_enqueue_scripts', $callback['handler'], $callback['priority'] );
				}
			}
		}
	}

	// extra style equeue handlers
	foreach ( $themeconfiguration['resources']['style-enqueue-handlers'] as $callback ) {
		if ( $callback !== null ) {
			if ( ! is_array( $callback ) ) {
				add_action( 'wp_enqueue_scripts', $callback, 10 );
			} else { // $callback is array
				if ( ! empty( $callback['handler'] ) ) {
					isset( $callback['priority'] ) or $callback['priority'] = 10;
					add_action( 'wp_enqueue_scripts', $callback['handler'], $callback['priority'] );
				}
			}
		}
	}
}

add_action( 'after_setup_theme', 'wpgrade_callback_themesetup', 16 );

// the callback wpgrade_callback_custom_theme_features should be placed
// in functions.php and contain theme specific settings
if ( function_exists( 'wpgrade_callback_custom_theme_features' ) ) {
	// register theme features
	add_action( 'after_setup_theme', 'wpgrade_callback_custom_theme_features' );
}

/**
 * ...
 */
function wpgrade_callbacks_setup_shortcodes_plugin() {
	$current_options = get_option( 'wpgrade_shortcodes_list' );

	$config     = wpgrade::config();
	$shortcodes = $config['shortcodes'];

	// create an array with shortcodes which are needed by the
	// current theme
	if ( $current_options ) {
		$diff_added   = array_diff( $shortcodes, $current_options );
		$diff_removed = array_diff( $current_options, $shortcodes );
		if ( ( ! empty( $diff_added ) || ! empty( $diff_removed ) ) && is_admin() ) {
			update_option( 'wpgrade_shortcodes_list', $shortcodes );
		}
	} else { // there is no current shortcodes list
		update_option( 'wpgrade_shortcodes_list', $shortcodes );
	}

	// we need to remember the prefix of the metaboxes so it can be used
	// by the shortcodes plugin
	$current_prefix = get_option( 'wpgrade_metaboxes_prefix' );
	if ( empty( $current_prefix ) ) {
		update_option( 'wpgrade_metaboxes_prefix', wpgrade::prefix() );
	}
}
add_action( 'admin_head', 'wpgrade_callbacks_setup_shortcodes_plugin' );
