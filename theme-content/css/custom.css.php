<?php header("Content-type: text/css; charset: UTF-8");

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
	// return implode(",", $rgb); // returns the rgb values separated by commas
	return $rgb; // returns an array with the rgb values
}

if ( isset($_GET["color"]) ){
	$main_color = '#'.$_GET["color"];
	$rgb = implode(",", hex2rgb($main_color)); ?>
<?php
}

if ( isset($_GET["main_font"]) ){
	$main_font = $_GET["main_font"]; ?>
<?php }

if ( isset($_GET["menu_font"]) ){
	$menu_font = $_GET["menu_font"]; ?>
<?php }

if ( isset($_GET["body_font"]) ){
	$body_font = $_GET["body_font"]; ?>
<?php }

if ( isset($_GET["port_color"]) ){
	$port_color = '#'.$_GET["port_color"]; ?>
<?php }

if ( isset($_GET["custom_css"]) ){
	echo $_GET["custom_css"];
}?>