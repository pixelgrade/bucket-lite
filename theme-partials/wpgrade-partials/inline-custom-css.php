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
		'google_titles_font',
		'google_second_font',
		'google_nav_font',
		'google_body_font'
	);

	foreach ($fonts_array as $font) {
		$the_font = wpgrade::get_the_typo($font);
		if ( isset($the_font['font-family'] ) && ! empty($the_font['font-family'])) {
			$fonts[$font] = $the_font;
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

<?php }

if ( isset($fonts['google_titles_font']) ) {?>
	/* Select classes here */
	.site-home-link, .heading .hN, .article--grid__title .hN, .article--grid__title .article__author-name, .article--grid__title .comment__author-name, .article--grid__title .widget_calendar caption, .widget_calendar .article--grid__title caption, .article--grid__title .score__average-wrapper, .article--grid__title .score__label {
		<?php wpgrade::display_font_params($fonts['google_titles_font']); ?>
	}

<?php }

if ( isset($fonts['google_nav_font']) ) {?>
	/* Select classes here */
	.nav--top>li>a, .nav--main>li>a {
		<?php wpgrade::display_font_params($fonts['google_nav_font']); ?>
	}

<?php }

if ( isset($fonts['google_body_font']) ) {?>
	/* Select classes here */
	.article, .latest-comments__list {
		<?php wpgrade::display_font_params($fonts['google_body_font']); ?>
	}

<?php }

if (wpgrade::option('custom_css')):
	echo "\n" . wpgrade::option('custom_css') . "\n";
endif; ?>