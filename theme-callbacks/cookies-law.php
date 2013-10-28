<?php

	add_action('wp_enqueue_scripts', 'wpgrade_enqueue_cookies_law_scripts');
			
	function wpgrade_enqueue_cookies_law_scripts(){
		wp_enqueue_script( 'jquery' );

		wp_register_script('jquery_cookie_js', plugins_url('jquery.cookie.js', __FILE__ ));
		wp_enqueue_script('jquery_cookie_js');

		wp_register_script('implied_cookie_consent_js', plugins_url('implied-cookie-consent.js', __FILE__ ));
		wp_enqueue_script('implied_cookie_consent_js');

		wp_register_style('implied_cookie_consent_css', plugins_url('implied-cookie-consent.css', __FILE__ ));
		wp_enqueue_style('implied_cookie_consent_css');
	};

	add_action('wp_footer', function(){
		$options = get_option( 'implied_cookie_consent' );
		$html = '<div id="icc_message" style="background-color: ' . $options['bgcolor'] . ';">' . do_shortcode( $options['message'] ) . '</div>';
		echo apply_filters('icc_message_html', $html);
	});