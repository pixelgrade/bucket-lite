<?php

	function get_portfolio_page_link() {
		global $wpdb;

		$results = $wpdb->get_results
			(
				"
					SELECT post_id
					  FROM $wpdb->postmeta
					 WHERE meta_key='_wp_page_template'
					   AND meta_value='template-portfolio.php'
				"
			);

		if ( ! empty($results)) {
			$page_id = '';
			foreach ($results as $result) {
				$page_id = $result->post_id;
				$the_template_page = get_post( $page_id );
				if ($the_template_page->post_status == 'publish') {
					break;
				}
				else { // $the_template_page->post_status !== publish
					$page_id = 'doesnt_exists';
				}
			}

			if ($page_id == 'doesnt_exists') {
				return get_post_type_archive_link('portfolio');
			}
			else { // $page_id !== 'doesnt_exist'
				return get_page_link($page_id);
			}
		}
		else { // empty results
			// fallback to the archive slug
			return get_post_type_archive_link('portfolio');
		}
	}

	// return the slug of the page with the portfolio template or false if none
	function get_portfolio_page_slug() {
		global $wpdb;

		$results = $wpdb->get_results
			(
				"
					SELECT post_id
					  FROM $wpdb->postmeta
					 WHERE meta_key='_wp_page_template'
					   AND meta_value='template-portfolio.php'
				"
			);

		if ( ! empty($results)) {
			$page_id = '';

			foreach ($results as $result) {
				$page_id = $result->post_id;
				$the_template_page = get_post( $page_id );
				
				if ($the_template_page->post_status == 'publish') {
					break;
				}
				else { // $the_template_page->post_status != 'publish'
					$page_id = 'doesnt_exists';
				}
			}

			if ($page_id == 'doesnt_exists') {
				return false;
			}
			else { // $page_id !== 'doesnt_exists'
				return $the_template_page->post_name;
			}
		}
		else { // empty results
			return false;
		}
	}