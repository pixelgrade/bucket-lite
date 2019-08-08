<?php
/**
 * Theme features.
 *
 * @package Bucket Lite
 * @since Bucket Lite 1.0.0
 */

function wpgrade_callback_custom_theme_features() {
	add_theme_support('automatic-feed-links');

	//load editor-style.css if present in parent and/or child theme
	add_editor_style( array( 'theme-content/css/editor-style.css', 'editor-style.css'));
}
add_action('after_setup_theme', 'wpgrade_callback_custom_theme_features');

function wpgrade_prepare_password_for_custom_post_types(){

	global $wpgrade_private_post;
	$wpgrade_private_post = bucket::is_password_protected();
}
add_action('wp', 'wpgrade_prepare_password_for_custom_post_types');

// Customize the 'wp_link_pages()' to be able to display both numbers and prev/next links
function add_next_and_number( $args ) {
	if ( $args['next_or_number'] == 'next_and_number' ) {
		global $page, $numpages, $multipage, $more;
		$args['next_or_number'] = 'number';
		$prev = '';
		$next = '';
		if ( $multipage and $more ) {
			$i = $page - 1;
			if ( $i and $more ) {
				$prev .= _wp_link_page( $i );
				$prev .= $args['link_before'] . $args['previouspagelink'] . $args['link_after'] . '</a>';
				$prev = apply_filters( 'wp_link_pages_link', $prev, 'prev' );
			}
			$i = $page+1;
			if ( $i <= $numpages and $more ) {
				$next .= _wp_link_page( $i );
				$next .= $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>';
				$next = apply_filters( 'wp_link_pages_link', $next, 'next' );
			}
		}
		$args['before'] = $args['before'] . $prev;
		$args['after'] = $next . $args['after'];
	}
	return $args;
}
add_filter( 'wp_link_pages_args', 'add_next_and_number' );


function wpgrade_register_attachments(){

	// add video support for attachments
	if ( !function_exists( 'add_video_url_field_to_attachments' ) ) {
		function add_video_url_field_to_attachments( $form_fields, $post){
			if ( !isset( $form_fields['video_url'] ) ) {
				$form_fields['video_url'] = array(
					'label' => esc_html__('Video URL', 'bucket-lite'),
					'input' => 'text', // this is default if 'input' is omitted
					'value' => esc_url( get_post_meta( $post->ID, '_video_url', true) ),
					'helps' => wp_kses_post( __('<p>Here you can link a video.</p><small>Only YouTube or Vimeo!</small>', 'bucket-lite') ),
				);
			}
			return $form_fields;
		}
		add_filter( 'attachment_fields_to_edit', 'add_video_url_field_to_attachments', 1, 2);
	}

	/**
	 * Save custom media metadata fields
	 *
	 * Be sure to validate your data before saving it
	 * http://codex.wordpress.org/Data_Validation
	 *
	 * @param $post The $post data for the attachment
	 * @param $attachment The $attachment part of the form $_POST ($_POST[attachments][postID])
	 * @return $post
	 */

	if ( !function_exists( 'add_image_attachment_fields_to_save' ) ) {
		add_filter( 'attachment_fields_to_save', 'add_image_attachment_fields_to_save', 9999 , 2);
		function add_image_attachment_fields_to_save( $post, $attachment ) {
			if ( isset( $attachment['video_url'] ) )
				update_post_meta( $post['ID'], '_video_url', esc_url( $attachment['video_url'] ) );

			return $post;
		}
	}
}
add_action('init', 'wpgrade_register_attachments');
