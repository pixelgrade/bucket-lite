<?php

add_action( 'acf/input/admin_enqueue_scripts', 'wpgrade_callback_add_acf_custom_resources');

function wpgrade_callback_add_acf_custom_resources (){

	// custom css
	wp_enqueue_style('wpgrade-acf-custom', wpgrade::resourceuri('css/admin/acf-custom-admin.css') );

	// custom js
	wp_enqueue_script('wpgrade-acf-custom-script', wpgrade::resourceuri('js/admin/acf-custom-admin.js'), array( 'jquery' ) );
}

/*
 * A warning message when the user try to activate it's own ACF.
 * We cannot allow that since we need our own plugin version with our add-ons.
 */
function wpgrade_warrning_about_acf(){
	echo '<div id="message" class="error"><p><b>'.
		__("This theme requires it's own version of Advanced Custom Fields.", wpgrade::textdomain() ) .
		'</b></br>' .
		__('Please uninstall the Advanced Custom Fields plugin and enable it from Theme Options -> General -> Enable Advanced Custom Fields Settings.', wpgrade::textdomain() ) .
		'</p></div>';
}