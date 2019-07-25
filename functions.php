<?php

// ensure EXT is defined
if ( ! defined('EXT')) {
	define('EXT', '.php');
}

#
# See: wpgrade-config.php -> include-paths for additional theme specific
# function and class includes
#

// ensure REQUEST_PROTOCOL is defined
if ( ! defined('REQUEST_PROTOCOL')) {
	if (is_ssl()) {
		define( 'REQUEST_PROTOCOL', 'https:' );
	} else {
		define( 'REQUEST_PROTOCOL', 'http:' );
	}
}

// Loads the theme's translated strings
load_theme_textdomain( 'bucket-lite', get_stylesheet_directory() . '/languages' );

// Theme specific settings
// -----------------------

// add theme support for post formats
// child themes note: use the after_setup_theme hook with a callback
$formats = array('video', 'audio', 'gallery', 'image', 'link');
add_theme_support('post-formats', $formats);

add_theme_support( 'title-tag' );

// Initialize system core
// ----------------------
do_action('wpgrade_before_core');

require_once 'wpgrade-core/bootstrap'.EXT;

do_action('wpgrade_after_core');

#
# Please perform any initialization via options in wpgrade-config and
# calls in wpgrade-core/bootstrap. Required for testing.
#

/**
 * http://codex.wordpress.org/Content_Width
 */
if ( ! isset($content_width)) {
	$content_width = 960;
}

function post_format_icon($class_name = '') {
	$post_format = get_post_format();

	if ($post_format):
		$icon_class = "";
		switch ($post_format) {
			case "video":
				$icon_class = "icon-play";
				break;
			case "audio":
				$icon_class = "icon-music";
				break;
			case "image":
			case "gallery":
				$icon_class = "icon-camera";
				break;
			case "quote":
				$icon_class = "icon-quotes";
				break;
			case "link":
				$icon_class = "icon-link";
				break;
			default:
				break;
		} ?>
		<div class="post-format-icon <?php echo $class_name; ?> post-format-icon__icon">
			<i class="<?php echo $icon_class; ?>"></i>
		</div>
	<?php
	endif;
}

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

