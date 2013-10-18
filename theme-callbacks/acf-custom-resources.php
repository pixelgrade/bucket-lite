<?php

add_action( 'acf/input/admin_enqueue_scripts', 'wpgrade_callback_add_acf_custom_resources');

function wpgrade_callback_add_acf_custom_resources (){

	// custom css
	wp_enqueue_style('wpgrade-acf-custom', wpgrade::resourceuri('css/admin/acf-custom-admin.css') );

	// custom js
	wp_enqueue_script('wpgrade-acf-custom-script', wpgrade::resourceuri('js/admin/acf-custom-admin.js'), array( 'jquery' ) );
}