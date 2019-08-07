<?php
/**
 * The sidebar template.
 *
 * @package Bucket Lite
 * @since Bucket Lite 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_active_sidebar( 'sidebar' ) ) {
	dynamic_sidebar( 'sidebar' );
}
