<?php

//define( 'ACF_LITE', true );
include_once('theme-content/inc/vendor/acf/acf.php');
include_once('theme-content/inc/vendor/acf/acf-config.php');

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
$formats = array('video', 'audio', 'gallery');
add_theme_support('post-formats', $formats);


// Initialize system core
// ----------------------

require_once 'wpgrade-core/bootstrap'.EXT;

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
            case "gallery":
                $icon_class = "icon-camera";
                break;
            case "quote":
                $icon_class = "icon-quotes";
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

function get_average_score() {

    if (get_field('enable_review_score') && get_field('score_breakdown')):
        $average = 0;
        $scores = 0;
        while (has_sub_fields('score_breakdown')):
            $average = $average + get_sub_field('score');
            $scores++;
        endwhile;
        $average = round($average / $scores, 1);
        return $average; 
    endif;

    return false;
}

// Add "Next page" button to TinyMCE
function add_next_page_button( $mce_buttons ) {
	$pos = array_search( 'wp_more', $mce_buttons, true );
	if ( $pos !== false ) {
		$tmp_buttons = array_slice( $mce_buttons, 0, $pos+1 );
		$tmp_buttons[] = 'wp_page';
		$mce_buttons = array_merge( $tmp_buttons, array_slice( $mce_buttons, $pos+1 ) );
	}
	return $mce_buttons;
}
add_filter( 'mce_buttons', 'add_next_page_button' );

// Customize the "wp_link_pages()" to be able to display both numbers and prev/next links
function add_next_and_number( $args ) {
	if ( $args['next_or_number'] == 'next_and_number' ) {
		global $page, $numpages, $multipage, $more, $pagenow;
		$args['next_or_number'] = 'number';
		$prev = '';
		$next = '';
		if ( $multipage and $more ) {
			$i = $page-1;
			if ( $i and $more ) {
				$prev .= _wp_link_page( $i );
				$prev .= $args['link_before'] . $args['previouspagelink'] . $args['link_after'] . '</a>';
			}
			$i = $page+1;
			if ( $i <= $numpages and $more ) {
				$next .= _wp_link_page( $i );
				$next .= $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>';
			}
		}
		$args['before'] = $args['before'] . $prev;
		$args['after'] = $next . $args['after'];
	}
	return $args;
}
add_filter( 'wp_link_pages_args', 'add_next_and_number' );
