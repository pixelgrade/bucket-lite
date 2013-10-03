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

			// ensure the name of the template. Only the template needs to be updated.
			if (  is_child_theme() ) {
				$template = wp_get_theme( $theme_data->template );
				$theme_name = $template->Name;
			} else {
				$theme_name = $theme_data->Name;
			}

			$allow_cache = true;

			// include the updater library from envato
			include_once wpgrade::corepath().'vendor/envato-wtl/class-envato-wordpress-theme-upgrader'.EXT;

			$marketplace_username = wpgrade::option('marketplace_username');
			$marketplace_api_key = wpgrade::option('marketplace_api_key');

			if ( ! empty($marketplace_username) && ! empty($marketplace_api_key)) {
				
				$upgrader = new Envato_WordPress_Theme_Upgrader( $marketplace_username, $marketplace_api_key );
				
				if ( !wpgrade::option('themeforest_upgrade_backup') || $upgrader->backup_theme( $theme_name ) === true ) {
					$upgrader->check_for_theme_update($theme_name, $allow_cache);
					$res = $upgrader->upgrade_theme($theme_name, $allow_cache);
					$success = $res->success;
					wpgrade::state()->set('theme_updated', $success);

					// make sure the nag notices appear again
					delete_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice' );
					
					if (isset($res->errors)) {
						wpgrade::state()->set('theme_update_error', $res->errors);
					}else {
						if ( wpgrade::option('themeforest_upgrade_backup')) {
							/* Theme Backup URI */
							wpgrade::state()->set('backup_uri', $upgrader->get_theme_backup_uri( $theme_name ) );
						}
					}
				}else {
					wpgrade::state()->set('backup_failed', true);
				}
			}
		}
	}
