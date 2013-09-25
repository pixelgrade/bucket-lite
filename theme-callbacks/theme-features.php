<?php

	/**
	 * Invoked by wpgrade_callback_themesetup
	 */
	function wpgrade_callback_custom_theme_features() {
		add_theme_support('automatic-feed-links');
		// @todo CLEANUP consider options for spliting editor style out of main style
		add_editor_style(get_template_directory_uri().'/wpgrade-content/css/style.css');
	}

	/**
	 * @see wpgrade-config.php -> body-classes
	 * @return boolean true if page may have the class 'header-transparent'
	 */
	function wpgrade_callback_has_featured_image_class() {
		if (is_singular() && (has_post_thumbnail() || get_post_format() == 'gallery' || get_post_format() == 'image')) {
			return false;
		}
		elseif (is_page() || is_archive() || is_home()) {
			if (is_page_template('template-portfolio.php') && wpgrade::option('portfolio_header_image')) {
				return true;
			}

			if (is_tax('portfolio_cat') && wpgrade::option('portfolio_header_image') ) {
				return true;
			}

			if (is_page_template('template-front-page.php') && wpgrade::option('homepage_use_slider')) {
				return true;
			}

			if ((is_archive() || is_home() || is_page_template( 'template-blog-archive.php' )) && wpgrade::option('blog_header_image')) {
				return true;
			}
		}

		return false;
	}


	/**
	 * let queries be sorted by the "post__in" argument
	 */
	add_action('wp_head', 'wpgrade_callbacks_html5_shim');
	function wpgrade_callback_sort_query_by_post_in( $sortby, $thequery ) {
		if ( !empty($thequery->query['post__in']) && isset($thequery->query['orderby']) && $thequery->query['orderby'] == 'post__in' )
			$sortby = "find_in_set(ID, '" . implode( ',', $thequery->query['post__in'] ) . "')";

		return $sortby;
	}
	add_filter( 'posts_orderby', 'wpgrade_callback_sort_query_by_post_in', 10, 2 );
