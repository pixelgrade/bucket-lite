<?php

add_action('the_password_form', 'wpgrade_callback_the_password_form');

function wpgrade_callback_the_password_form($form){
	global $post;
	$post = get_post( $post );
	$label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );
	$output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
	<p>' . __("This post is password protected. To view it please enter your password below:") . '</p>
	<p><label for="' . $label . '">' . __("Password:") . ' <input name="post_password" id="' . $label . '" type="password" size="20" /></label> <input type="submit" name="Access" value="' . esc_attr__("Submit") . '" /></p>
</form>
	';

	return $form;
}


/**
 * Password form submit button
 */
//
//add_filter('the_password_form', 'wpgrade_change_password_submit_label');
//
//function wpgrade_change_password_submit_label( $form ){
//	$return = str_replace('value="Submit"', 'value="Access"', $form);
//	return $return;
//}