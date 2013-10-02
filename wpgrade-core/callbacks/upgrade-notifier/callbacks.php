<?php

	/**
	 * Enqueues the JavaScript files needed depending on the current section.
	 */
	function wpgrade_callback_update_notifier_admin_initialization() {
		if (isset($_GET['page']) && ($_GET['page'] == 'theme-update-notifier')) {
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-ui-dialog');
			wp_enqueue_script('wpgrade-update', wpgrade::coreuri().'resources/assets/update-notifier/update-notifier.js');
			wp_enqueue_style('wpgrade-update-style', wpgrade::coreuri().'resources/assets/update-notifier/update-notifier.css');
		}
	}

	/**
	 * Adds an update notification to the WordPress Dashboard menu
	 */
	function wpgrade_callback_update_notifier_menu() {
		if (wpgrade::option('themeforest_upgrade')) {
			// stop if simplexml_load_string funtion isn't available
			if (function_exists('simplexml_load_string')) {
				$newversion = wpgrade_update_notifier_check_if_new_version();
				$count = (isset($_GET['wpgrade_update']) &&  $_GET['wpgrade_update'] == 'true') ? '' : '<span class="update-plugins count-1"><span class="update-count">1</span></span>';

				// compare current theme version with the remote XML version
				if ($newversion) {
					add_dashboard_page
						(
							wpgrade::themename().' Theme Updates',
							wpgrade::themename().' Update '.$count,
							'administrator',
							wpgrade::update_notifier_pagename(),
							'update_notifier'
						);
				}
			}
		}
	}

	/**
	 * Adds an update notification to the Admin Bar
	 */
	function wpgrade_callback_update_notifier_bar_menu() {
		if (wpgrade::option('themeforest_upgrade')) {
			// stop if simplexml_load_string funtion isn't available
			if (function_exists('simplexml_load_string')) {
				global $wp_admin_bar, $wpdb;

				// don't display notification in admin bar if it's disabled or
				// the current user isn't an administrator
				if ( ! is_super_admin() || ! is_admin_bar_showing()) {
					return;
				}

				$newversion = wpgrade_update_notifier_check_if_new_version();

				// compare current theme version with the remote XML version
				if ($newversion) {
					$wp_admin_bar->add_menu
						(
							array
							(
								'id' => 'update_notifier',
								'title' => '<span>'.wpgrade::themename().' <span id="ab-updates">New Updates</span></span>',
								'href' => get_admin_url().'index.php?page=theme-update-notifier'
							)
						);
				}
			}
		}
	}

	/**
	 * Let the user know what is happening and if everything went well
	 */
	function wpgrade_callback_update_notifier_update_notice(){
		if (wpgrade::option('themeforest_upgrade')) {
			$message_type = "updated";
			if (wpgrade::state()->has('theme_updated') && isset($_GET['wpgrade_update']) &&  $_GET['wpgrade_update'] == 'true') {
				if (wpgrade::state()->get('theme_updated')) {
					$message = 'The theme has been updated successfully';
				}
				else { // error while updating theme
					$message = 'An error occurred, the theme has not been updated. Please try again later or install the update manually.';
					$theme_update_error = wpgrade::state()->get('theme_update_error', array());

					if (isset($theme_update_error[1])) {
						$message .= '<br/>(Error message: '.$theme_update_error[1].')';
					}

					$message_type = "error";
				}
			}
			elseif (wpgrade::state()->get('curl_disabled', false)) {
				$message = 'Error: The theme was not updated, because the cURL extension is not enabled on your server. In order to update the theme automatically, the Envato Toolkit Library requires cURL to be enabled on your server. You can contact your hosting provider to enable this extension for you.';
				$message_type = "error";
			}

			if (isset($message)) {
				echo '<div class="'.$message_type.'"><p>'.$message.'</p></div>';
			}
		}
	}
