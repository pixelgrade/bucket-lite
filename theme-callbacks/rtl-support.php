<?php
/**
 * Enqueue rtl style, if it's the case.
 *
 * @package Bucket Lite
 * @since Bucket Lite 1.0.0
 */

function wpgrade_callback_enqueue_rtl_support(){

	if ( is_rtl() ) {
		wp_enqueue_style('rtl-support', wpgrade::resourceuri('css/localization/rtl.css') );
	}

}