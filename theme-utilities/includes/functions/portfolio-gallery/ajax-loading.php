<?php

	/**
	 * Ajax loading of all projects
	 */
	function wpgrade_callback_load_all_portfolio_projects($front_page = false, $featured_first = true) {
		global $post;

		$paged = 1;

		if (get_query_var('paged')) {
			$paged = get_query_var('paged');
		}

		if (get_query_var('page')) {
			$paged = get_query_var('page');
		}

		$query_args = array
			(
				'post_type'      => 'portfolio',
				'posts_per_page' => 999, // unlikely number
				'orderby'        => 'menu_order date',
				'order'          => 'desc',
				'paged'          => $paged
			);

		if (isset( $_POST['offset'])) {
			$query_args['offset'] = (int)$_POST['offset'];
		}

		if ($featured_first) {
			$query_args['meta_key'] = wpgrade::prefix() .'portfolio_featured';
			$query_args['orderby'] = 'meta_value menu_order date';

			add_filter( 'posts_orderby', 'custom_orderby_display_portfolio' );
			$query = new WP_Query( $query_args );
			remove_filter( 'posts_orderby', 'custom_orderby_display_portfolio' );
		}
		else {
			$query = new WP_Query($query_args);
		}

		ob_start();

		if ( ! empty($query)) {
			while ($query->have_posts()) {
				$query->the_post();
				$terms = wp_get_post_terms($post->ID, 'portfolio_cat', array("fields" => "slugs"));

				echo '<div class="portfolio-row row"'. ($terms ? 'data-terms="'. implode(' ', $terms).'"' : '').'>';

				$rows = get_post_meta( $post->ID, wpgrade::prefix() .'portfolio_rows', true);
				$rows = json_decode($rows, true);

				if ( ! empty($rows)) {
					// get only the first row
					wpgrade_get_portfolio_row((array)$rows[0], true);
				}

				echo "</div>";
			}
		}

		wp_reset_postdata();

		echo json_encode(ob_get_clean());
		die;
	}

	add_action('wp_ajax_wpgrade_load_all_portfolio_projects', 'wpgrade_callback_load_all_portfolio_projects');
	add_action('wp_ajax_nopriv_wpgrade_load_all_portfolio_projects', 'wpgrade_callback_load_all_portfolio_projects');

