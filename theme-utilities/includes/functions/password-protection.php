<?php

function wpgrade_callback_the_password_form( $form ){

	global $post;

	$post = get_post( $post );
	$postID = wpgrade::lang_post_id($post->ID);
	$label = 'pwbox-' . ( empty($postID) ? rand() : $postID );
	$form = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
		<p>' . esc_html__("This post is password protected. To view it please enter your password below:", 'bucket-lite') . '</p>
		<div class="row">
			<div class="span-12  hand-span-10">
				<input name="post_password" id="' . esc_attr( $label ) . '" type="password" size="20" placeholder="'. esc_attr__('Password', 'bucket-lite') . '"/>
			</div>
			<div class="span-12  hand-span-2">
				<input type="submit" name="Access" value="' . esc_attr__('Access', 'bucket-lite') . '" class="btn post-password-submit"/>
			</div>
		</div>
	</form>';

	// on form submit put a wrong password msg.
	if ( get_permalink() != wp_get_referer() ) {
		return $form;
	}

	// No cookie, the user has not sent anything until now.
	if ( ! isset ( $_COOKIE[ 'wp-postpass_' . COOKIEHASH ] ) ){
		return $form;
	}

	require_once ABSPATH . 'wp-includes/class-phpass.php';
	$hasher = new PasswordHash( 8, true ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

	$hash = wp_unslash( $_COOKIE[ 'wp-postpass_' . COOKIEHASH ] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	if ( 0 !== strpos( $hash, '$P$B' ) )
		return $form;

	if ( !$hasher->CheckPassword( $post->post_password, $hash ) ){

		// We have a cookie, but it doesn’t match the password.
		$msg = '<span class="wrong-password-message">'. esc_html__( 'Sorry, your password didn’t match', 'bucket-lite' ).'</span>';
		$form = $msg . $form;
	}

	return $form;

}
add_action('the_password_form', 'wpgrade_callback_the_password_form');
