<?php
	/* @var string $main_color */
	/* @var array  $fonts */
	/* @var string $port_color */
	/* @var string $rgb */


$main_color = wpgrade::option('main_color');
$rgb = implode(',', wpgrade::hex2rgb_array($main_color));
$fonts = array();

if (wpgrade::option('use_google_fonts')) {
	$fonts_array = array
	(
		'google_main_font',
		'google_second_font',
		'google_menu_font',
		'google_body_font'
	);

	foreach ($fonts_array as $font) {
		$clean_font = wpgrade::css_friendly_font($font);
		if ( ! empty($clean_font)) {
			$key = str_replace('google_', '', $font);
			$fonts[$key] = $clean_font;
		}
	}
}

$port_color = '';
if (wpgrade::option('portfolio_text_color')) {
	$port_color = wpgrade::option('portfolio_text_color');
	$port_color = str_replace('#', '', $port_color);
}

function hex2rgb($hex) {
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

if ( !empty($main_color) ){
$rgb = implode(",", hex2rgb($main_color)); ?>

<?php } ?>

<?php if (wpgrade::option('custom_css')):
	echo wpgrade::option('custom_css');
endif; ?>