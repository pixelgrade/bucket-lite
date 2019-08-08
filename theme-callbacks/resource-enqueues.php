<?php
/**
 * Resources enqueues.
 *
 * @package Bucket Lite
 * @since Bucket Lite 1.0.0
 */

	/**
	 * Invoked in wpgrade-config.php
	 */
	function wpgrade_callback_thread_comments_scripts() {
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script('comment-reply');
		}
	}
