<?php

// ensure EXT is defined
if ( ! defined('EXT')) {
	define('EXT', '.php');
}

#
# See: wpgrade-config.php -> include-paths for additional theme specific
# function and class includes
#

// Theme specific settings
// -----------------------

// add theme support for post formats
// child themes note: use the after_setup_theme hook with a callback
$formats = array('video', 'audio', 'gallery', 'image', 'link');
add_theme_support('post-formats', $formats);


// Initialize system core
// ----------------------

require_once 'wpgrade-core/bootstrap'.EXT;

#
# Please perform any initialization via options in wpgrade-config and
# calls in wpgrade-core/bootstrap. Required for testing.
#

// ACF Initialisation

if ( wpgrade::option('enable_acf_ui', '0') ) {
	define( 'ACF_LITE', true );
}

if ( in_array( 'advanced-custom-fields/acf.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	add_action('admin_notices', 'wpgrade_warrning_about_acf');
} else {
	include_once('theme-utilities/includes/acf/acf.php');
	include_once('theme-utilities/includes/acf/acf-config.php');
}

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
        }
    /* ?>
    <div class="post-format-icon <?php echo $class_name; ?> post-format-icon__background"></div>
    <div class="post-format-icon <?php echo $class_name; ?> post-format-icon__border"></div><?php */ ?>
    <div class="post-format-icon <?php echo $class_name; ?> post-format-icon__icon">
        <i class="<?php echo $icon_class; ?>"></i>
    </div>
    <?php
    endif;
}
