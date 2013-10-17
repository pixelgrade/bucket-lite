<?php

add_action( 'acf/input/admin_enqueue_scripts', 'wpgrade_callback_add_acf_custom_css');

function wpgrade_callback_add_acf_custom_css (){

	wp_enqueue_style('wpgrade-acf-custom', wpgrade::resourceuri('css/acf-custom-admin.css') );

}