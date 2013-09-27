<?php

	/**
	 * The notifier page
	 */
	function update_notifier() {
		include wpgrade::corepartial('update-notifier'.EXT);
	}

	/**
	 * The update
	 */
	function wpgrade_callback_update_notifier_handler() {
		if (wpgrade::option('themeforest_upgrade') && isset($_GET['wpgrade_update']) &&  $_GET['wpgrade_update'] == 'true') {
			$theme_data = wp_get_theme();
			$theme_name = $theme_data->Name;
			$allow_cache = true;

			// include the updater library from envato
			include_once wpgrade::corepath().'vendor/envato-wtl/class-envato-wordpress-theme-upgrader'.EXT;

			$marketplace_username = wpgrade::option('marketplace_username');
			$marketplace_api_key = wpgrade::option('marketplace_api_key');

			if ( ! empty($marketplace_username) && ! empty($marketplace_api_key)) {
				if (in_array('curl', get_loaded_extensions())) {
					// cURL is enabled, the Envato Toolkit uses cURL, so the update can be performed
					$upgrader = new Envato_WordPress_Theme_Upgrader( $marketplace_username, $marketplace_api_key );
					$upgrader->check_for_theme_update($theme_name, $allow_cache);
					$res = $upgrader->upgrade_theme($theme_name, $allow_cache);
					$success = $res->success;
					wpgrade::state()->set('theme_updated', $success);

					// make sure the nag notices appear again
					delete_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice' );

					if (isset($res->errors)) {
						wpgrade::state()->set('theme_update_error', $res->errors);
					}
				}
				else { // curl not available
					wpgrade::state()->set('curl_disabled', true);
				}
			}
		}
	}
