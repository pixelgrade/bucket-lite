<?php
	// "One-Click import for demo data" feature
	// ----------------------------------------

	/**
	 * Imports the demo data from the demo_data.xml file
	 */
	if ( ! function_exists('wpGrade_ajax_import_posts_pages'))
	{
		function wpGrade_ajax_import_posts_pages()
		{
			// initialize the step importing
			$stepNumber = 1;
			$numberOfSteps = 1;

			// get the data sent by the ajax call regarding the current step
			// and total number of steps
			if ( ! empty($_REQUEST['step_number'])) {
				$stepNumber = $_REQUEST['step_number'];
			}

			if ( ! empty($_REQUEST['number_of_steps'])) {
				$numberOfSteps = $_REQUEST['number_of_steps'];
			}

			$response = array
				(
					'what' => 'import_posts_pages',
					'action' => 'import_submit',
					'id' => 'true',
					'supplemental' => array
						(
							'stepNumber' => $stepNumber,
							'numberOfSteps' => $numberOfSteps,
						)
				);

			require_once wpgrade::themefilepath('theme-utilities/includes/import/import-demo-posts-pages'.EXT);

			$response = new WP_Ajax_Response($response);
			$response->send();
		}

		// hook into wordpress admin.php
		add_action('wp_ajax_wpGrade_ajax_import_posts_pages', 'wpGrade_ajax_import_posts_pages');
	}

	/**
	 * Imports the theme options from the demo_data.php file
	 */
	if( ! function_exists('wpGrade_ajax_import_theme_options'))
	{
		function wpGrade_ajax_import_theme_options()
		{
			$response = array
				(
					'what' => 'import_theme_options',
					'action' => 'import_submit',
					'id' => 'true',
				);

			// check if user is allowed to save and if its his intention with
			// a nonce check
			if (function_exists('check_ajax_referer')) {
				check_ajax_referer('wpGrade_nonce_import_demo_theme_options');
			}
			require_once wpgrade::themefilepath('theme-utilities/includes/import/import-demo-theme-options'.EXT);

			$response = new WP_Ajax_Response($response);
			$response->send();
		}

		// hook into wordpress admin.php
		add_action('wp_ajax_wpGrade_ajax_import_theme_options', 'wpGrade_ajax_import_theme_options');
	}

	/**
	 * This function imports the widgets from the demo_data.php file and the menus
	 */
	if( ! function_exists('wpGrade_ajax_import_widgets'))
	{
		function wpGrade_ajax_import_widgets()
		{
			$response = array(
				'what' => 'import_widgets',
				'action' => 'import_submit',
				'id' => 'true',
			);

			// check if user is allowed to save and if its his intention with
			// a nonce check
			if(function_exists('check_ajax_referer')) {
				check_ajax_referer('wpGrade_nonce_import_demo_widgets');
			}

			require_once wpgrade::themefilepath('theme-utilities/includes/import/import-demo-widgets'.EXT);

			$response = new WP_Ajax_Response( $response );
			$response->send();
		}

		//hook into wordpress admin.php
		add_action('wp_ajax_wpGrade_ajax_import_widgets', 'wpGrade_ajax_import_widgets');
	}

	// @todo CLEANUP check if this function is actually used anywhere
	// andrei: is just a freaking test
	function validate_callback_function($field, $value, $existing_value) {
		$error = false;
		$value =  'just testing';

		$return['value'] = $value;

		if($error == true) {
			$return['error'] = $field;
		}
		return $return;
	}