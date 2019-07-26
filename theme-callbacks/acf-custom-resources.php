<?php

/*
 * A warning message when the user try to activate it's own ACF.
 * We cannot allow that since we need our own plugin version with our add-ons.
 */
function wpgrade_warrning_about_acf(){
	echo '<div id="message" class="error"><p><b>'.
		__("This theme requires it's own version of Advanced Custom Fields.", 'bucket-lite' ) .
		'</b></br>' .
		__('Please uninstall the Advanced Custom Fields plugin and enable it from Theme Options -> General -> Enable Advanced Custom Fields Settings.', 'bucket-lite' ) .
		'</p></div>';
}

add_filter( 'acf_the_content', 'wpgrade_remove_spaces_around_shortcodes', 11 );

if (!function_exists('wpgrade_remove_spaces_around_shortcodes')) {

	function wpgrade_remove_spaces_around_shortcodes($content){

		$array = array (
			'<p>[' => '[',
			']</p>' => ']',
			']<br />' => ']'
		);

		$content = strtr($content, $array);
		return $content;
	}
}
