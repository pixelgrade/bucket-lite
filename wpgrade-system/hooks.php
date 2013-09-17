<?php

	$ds = DIRECTORY_SEPARATOR;
	$callbackspath = dirname(__FILE__).$ds.'callbacks'.$ds;

	#
	# This file assigns environment hooks.
	#

	// theme activation
	function wpgrade_callback_geting_active() {

		$types_options = get_option('pixtypes_themes_settings');
		if ( empty($types_options) ) {
			$types_options = array();
		}
		$theme_key = wpgrade::shortname() . '_pixtypes_theme';
		$types_options[$theme_key] = array();
		$types_options[$theme_key]['post_types'] = array(
			'lens_portfolio' => array(
				'labels' => array (
					'name' => 'Project',
					'singular_name' => 'Project',
					'add_new' => 'Add New',
					'add_new_item' => 'Add New Project',
					'edit_item' => 'Edit Project',
					'new_item' => 'New Project',
					'all_items' => 'All Projects',
					'view_item' => 'View Project',
					'search_items' => 'Search Projects',
					'not_found' => 'No Project found',
					'not_found_in_trash' => 'No Project found in Trash',
					'parent_item_colon' => '',
					'menu_name' => 'Projects',
				),
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'query_var' => true,
				'rewrite' => array (
					'slug' => 'lens_portfolio',
					'with_front' => false,
				),
				'capability_type' => 'post',
				'has_archive' => 'portfolio-archive',
				'menu_icon' => 'report.png',
				'menu_position' => NULL,
				'supports' => array ( 'title', 'editor', 'thumbnail', 'page-attributes', 'excerpt'),
				'yarpp_support' => true,
			),
			'lens_gallery' => array(
				'labels' => array (
					'name' => 'Gallery',
					'singular_name' => 'Gallery',
					'add_new' => 'Add New',
					'add_new_item' => 'Add New Gallery',
					'edit_item' => 'Edit Gallery',
					'new_item' => 'New Gallery',
					'all_items' => 'All Galleries',
					'view_item' => 'View Gallery',
					'search_items' => 'Search Galleries',
					'not_found' => 'No Gallery found',
					'not_found_in_trash' => 'No Gallery found in Trash',
					'parent_item_colon' => '',
					'menu_name' => 'Galleries',
				),
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'query_var' => true,
				'rewrite' => array (
					'slug' => 'lens_galleries',
					'with_front' => false,
				),
				'capability_type' => 'post',
				'has_archive' => 'galleries-archive',
				'menu_position' => NULL,
				'supports' => array ( 'title', 'thumbnail', 'page-attributes', 'excerpt'),
				'yarpp_support' => true,
			),
		);
		$types_options[$theme_key]['taxonomies'] = array(
			'lens_portfolio_categories' => array(
				'hierarchical' => true,
				'labels' => array (
					'name' => 'Portfolio Categories',
					'singular_name' => 'Portfolio Category',
					'search_items' => 'Search Portfolio Category',
					'all_items' => 'All Portfolio Categories',
					'parent_item' => 'Parent Portfolio Category',
					'parent_item_colon' => 'Parent Portfolio Category: ',
					'edit_item' => 'Edit Portfolio Category',
					'update_item' => 'Update Portfolio Category',
					'add_new_item' => 'Add New Portfolio Category',
					'new_item_name' => 'New Portfolio Category Name',
					'menu_name' => 'Portfolio Categories',
				),
				'show_ui' => true,
				'show_admin_column' => true,
				'query_var' => true,
				'rewrite' => array ( 'slug' => 'portfolio-category', 'with_front' => false ),
				'post_types' => array('lens_portfolio')
			),
			'lens_gallery_categories' => array(
				'hierarchical' => true,
				'labels' => array (
					'name' => 'Gallery Categories',
					'singular_name' => 'Gallery Category',
					'search_items' => 'Search Gallery Category',
					'all_items' => 'All Gallery Categories',
					'parent_item' => 'Parent Gallery Category',
					'parent_item_colon' => 'Parent Gallery Category: ',
					'edit_item' => 'Edit Gallery Category',
					'update_item' => 'Update Gallery Category',
					'add_new_item' => 'Add New Gallery Category',
					'new_item_name' => 'New Gallery Category Name',
					'menu_name' => 'Gallery Categories',
				),
				'show_ui' => true,
				'show_admin_column' => true,
				'query_var' => true,
				'rewrite' => array ( 'slug' => 'gallery-category', 'with_front' => false ),
				'post_types' => array('lens_gallery')
			),
		);
		$types_options[$theme_key]['metaboxes'] = array(
			'lens_portfolio' => array(
				'id'         => 'portfolio_gallery',
				'title'      => __('Gallery', wpgrade::textdomain()),
				'pages'      => array( 'lens_portfolio' ), // Post type
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
					array(
						'name' => __('Images', wpgrade::textdomain()),
						'id'   => wpgrade::prefix() . 'portfolio_gallery',
						'type' => 'gallery',
					),
					array(
						'name' => __('Template', wpgrade::textdomain()),
						'desc' => __('Select the template you want for this project.', wpgrade::textdomain()),
						'id' => wpgrade::prefix() . 'project_template',
						'type' => 'select',
						'options' => array(
							array(
								'name' => 'Fullwidth',
								'value' => 'fullwidth'
							),
							array(
								'name' => 'Sidebar Right',
								'value' => 'sidebar'
							),
							array(
								'name' => 'Classic',
								'value' => 'classic'
							),
						),
						'std' => 'fullwidth',
					),					
				)
			),
			'lens_gallery' => array(
				'id'         => 'lens_gallery',
				'title'      => 'Gallery',
				'pages'      => array( 'lens_gallery' ), // Post type
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
					array(
						'name' =>  __('Images', wpgrade::textdomain()),
						'id'   =>  wpgrade::prefix() . 'main_gallery',
						'type' => 'gallery',
					),
					array(
						'name' => __('Template', wpgrade::textdomain()),
						'desc' => __('Select the template you want for this gallery.', wpgrade::textdomain()),
						'id' => wpgrade::prefix() . 'gallery_template',
						'type' => 'select',
						'options' => array(
							array(
								'name' => 'Masonry Grid',
								'value' => 'masonry'
							),
							array(
								'name' => 'Full Width',
								'value' => 'fullwidth'
							),
							array(
								'name' => 'Fullscreen',
								'value' => 'fullscreen'
							),
						),
						'std' => 'fullwidth',
					),
				)
			)
		);
		update_option('pixtypes_themes_settings', $types_options);
		// flush permalinks rules on theme activation
		flush_rewrite_rules();
	}

	add_action('after_switch_theme', 'wpgrade_callback_geting_active');


	// Theme Setup
	// ------------------------------------------------------------------------

	wpgrade::require_all($callbackspath.'theme-setup');

	/**
	 * ...
	 */
	function wpgrade_callback_themesetup() {
		// register resources
		add_action('wp_enqueue_scripts', 'wpgrade_callback_register_theme_resources', 1);

		// auto-enque based on configuration entries and callbacks
		add_action('wp_enqueue_scripts', 'wpgrade_callback_enqueue_theme_resources', 1);

		// custom javascript handlers
		add_action('wp_enqueue_scripts', 'wpgrade_callback_load_custom_js', 9001);

		if ( wpgrade::option('display_custom_css_inline')) {
			add_action('wp_head', 'wpgrade_callback_inlined_custom_style');
		}

		// the callback wpgrade_callback_custom_theme_features should be placed
		// in functions.php and contain theme specific settings
		if (function_exists('wpgrade_callback_custom_theme_features')) {
			// register theme features
			add_action('after_setup_theme', 'wpgrade_callback_custom_theme_features');
		}

		// cleanup the content (eg. remove <p>s around images)
		add_filter('the_content', 'wpgrade_callback_cleanup_the_content');
		// cleanup excerpt (eg. replace [..] with a Read more link)
//		add_filter('excerpt_more', 'wpgrade_callback_cleanup_excerpt');
//		// cleanup read more tag link
//		add_filter('the_content_more_link', 'wpgrade_callback_cleanup_readmore_content', 10, 2);
	}

	add_action('after_setup_theme', 'wpgrade_callback_themesetup', 16);


	/**
	 * ...
	 */
	function wpgrade_callbacks_setup_shortcodes_plugin() {
		$current_options = get_option('wpgrade_shortcodes_list');

		$config = wpgrade::config();
		$shortcodes = $config['shortcodes'];

		// create an array with shortcodes which are needed by the
		// current theme
		if ($current_options) {
			$diff = array_diff($shortcodes, $current_options);
			if (empty($diff) && is_admin()) {
				update_option('wpgrade_shortcodes_list', $shortcodes);
			}
		}
		else { // there is no current shortcodes list
			update_option('wpgrade_shortcodes_list', $shortcodes);
		}

		// we need to remember the prefix of the metaboxes so it can be used
		// by the shortcodes plugin
		$current_prefix = get_option('wpgrade_metaboxes_prefix');
		if (empty($current_prefix)) {
			update_option('wpgrade_metaboxes_prefix', wpgrade::prefix());
		}
	}

	add_action('admin_head', 'wpgrade_callbacks_setup_shortcodes_plugin');


	/**
	 * ...
	 */
	function wpgrade_callbacks_html5_shim() {
		global $is_IE;
		if ($is_IE) {
			include wpgrade::themefilepath('wpgrade-partials/ie-shim'.EXT);
		}
	}

	add_action('wp_head', 'wpgrade_callbacks_html5_shim');


	/**
	 * Misc admin panel tweaks.
	 */
	function wpgrade_callbacks_admin_head_tweaks() {
		// @andreilupu shouldn't this be in the plugin itself?
		include wpgrade::themefilepath('wpgrade-partials/admin-head-tweaks'.EXT);
	}

	add_action('admin_head', 'wpgrade_callbacks_admin_head_tweaks');


	function wpgrade_callback_sort_query_by_post_in( $sortby, $thequery ) {
		if ( !empty($thequery->query['post__in']) && isset($thequery->query['orderby']) && $thequery->query['orderby'] == 'post__in' )
			$sortby = "find_in_set(ID, '" . implode( ',', $thequery->query['post__in'] ) . "')";

		return $sortby;
	}
	add_filter( 'posts_orderby', 'wpgrade_callback_sort_query_by_post_in', 10, 2 );

	// replace $query with our own on query object
//	function wpgrade_callbacks_portfolio_pixquery( $query ){
//
//		if ( !empty($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'lens_portfolio' && class_exists('Pix_Query') ) {
//			$query = new Pix_Query( $query->query_args );
//			$query->get_gallery_ids();
//		}
//
//	}
//
//	add_action( 'pre_get_posts', 'wpgrade_callbacks_portfolio_pixquery' );
