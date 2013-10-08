<?php

	/**
	 * This callback is invoked by wpgrade_callback_themesetup.
	 *
	 * The function is executed on wp_head
	 */
	function wpgrade_callback_inlined_custom_style() {

		echo '<style  type="text/css">';
		include wpgrade::corepartial('inline-custom-css'.EXT);
		echo '</style>';
	}
