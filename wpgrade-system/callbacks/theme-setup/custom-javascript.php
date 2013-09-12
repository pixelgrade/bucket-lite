<?php

/**
 * Load custom javascript set by theme options
 *
 * This method is invoked by wpgrade_callback_themesetup
 *
 * The function is executed on wp_enqueue_scripts
 */
function wpgrade_callback_load_custom_js() {
    $custom_js = wpgrade::option('custom_js');
    if ( ! empty($custom_js)) {
		echo '<script type="text/javascript">'.$custom_js.'</script>';
    }
}
