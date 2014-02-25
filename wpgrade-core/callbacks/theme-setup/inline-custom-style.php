<?php

	/**
	 * This callback is invoked by wpgrade_callback_themesetup.
	 *
	 * The function is executed on wp_head
	 */
	function wpgrade_callback_inlined_custom_style() {

		ob_start();
		include wpgrade::corepartial('inline-custom-css'.EXT);
		$custom_css = ob_get_clean();;
		$style = 'wpgrade-main-style';
//		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
//			$style = 'woocommerce_frontend_styles';
//		}

		wp_add_inline_style( $style, $custom_css );
	}
