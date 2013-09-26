<?php
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
				'menu_name' => 'Projects',
			),
			'public' => true,
			'rewrite' => array (
				'slug' => 'lens_portfolio',
				'with_front' => false,
			),
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
				'menu_name' => 'Galleries',
			),
			'public' => true,
			'rewrite' => array (
				'slug' => 'lens_galleries',
				'with_front' => false,
			),
			'has_archive' => 'galleries-archive',
			'menu_icon' => 'slider.png',
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
			'show_admin_column' => true,
			'rewrite' => array ( 'slug' => 'portfolio-category', 'with_front' => false ),
			'sort' => true,
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
			'show_admin_column' => true,
			'rewrite' => array ( 'slug' => 'gallery-category', 'with_front' => false ),
			'sort' => true,
			'post_types' => array('lens_gallery')
		),
	);
	$types_options[$theme_key]['metaboxes'] = array(
		'post_video_format' => array(
			'id' => 'post_format_metabox_video',
			'title' => __('Video Settings', wpgrade::textdomain()),
			'pages'      => array('post'), // Post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => __('Embed Code', wpgrade::textdomain()),
					'desc' => __('Enter here a Youtube, Vimeo (or other online video services) embed code here. The width should be a minimum of 640px. We will use this if filled, not the selfhosted options bellow!', wpgrade::textdomain()),
					'id' => wpgrade::prefix() . 'video_embed',
					'type' => 'textarea_small',
					'std' => '',
				),
			)
		),
		'post_quote_format' => array(
			'id' => 'post_format_metabox_quote',
			'title' =>  __('Quote Settings', wpgrade::textdomain()),
			'pages'      => array( 'post' ), // Post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' =>  __('Quote Content', wpgrade::textdomain()),
					'desc' => __('Please type the text of your quote here.', wpgrade::textdomain()),
					'id' => wpgrade::prefix() . 'quote',
					'type' => 'wysiwyg',
					'std' => '',
					'options' => array (
						'textarea_rows' => 4,
					),
				),
				array(
					'name' => __('Author Name', wpgrade::textdomain()),
					'desc' => '',
					'id' => wpgrade::prefix() . 'quote_author',
					'type' => 'text',
					'std' => '',
				),
				array(
					'name' => __('Author Title', wpgrade::textdomain()),
					'desc' => '',
					'id' => wpgrade::prefix() . 'quote_author_title',
					'type' => 'text',
					'std' => '',
				),
				array(
					'name' => __('Author Link', wpgrade::textdomain()),
					'desc' => __('Insert here an url if you want the author name to be linked to that address.', wpgrade::textdomain()),
					'id' => wpgrade::prefix() . 'quote_author_link',
					'type' => 'text',
					'std' => '',
				),
			)
		),
		'post_audio_format' => array(
			'id' => 'post_format_metabox_audio',
			'title' =>  __('Audio Settings', wpgrade::textdomain()),
			'pages'      => array( 'post'), // Post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => __('Embed Code', wpgrade::textdomain()),
					'desc' => __('Enter here a embed code here. The width should be a minimum of 640px. We will use this if filled, not the selfhosted options bellow!', wpgrade::textdomain()),
					'id' => wpgrade::prefix() . 'audio_embed',
					'type' => 'textarea_small',
					'std' => '',
				),
				array(
					'name' => __('MP3 File URL', wpgrade::textdomain()),
					'desc' => __('Please enter in the URL to the .mp3 file', wpgrade::textdomain()),
					'id' => wpgrade::prefix() . 'audio_mp3',
					'type' => 'file',
					'std' => ''
				),
				array(
					'name' => __('M4A File URL', wpgrade::textdomain()),
					'desc' => __('Please enter in the URL to the .m4a file', wpgrade::textdomain()),
					'id' => wpgrade::prefix() . 'audio_m4a',
					'type' => 'file',
					'std' => ''
				),
				array(
					'name' => __('OGA File URL', wpgrade::textdomain()),
					'desc' => __('Please enter in the URL to the .ogg or .oga file', wpgrade::textdomain()),
					'id' => wpgrade::prefix() . 'audio_ogg',
					'type' => 'file',
					'std' => ''
				),
				array(
					'name' => __('Poster Image', wpgrade::textdomain()),
					'desc' => __('This will be the image displayed above the audio controls. The image should be at least 640px wide. Click the "Upload" button to open the Media Manager, and click "Use as Poster Image" once you have uploaded or chosen an image from the media library.', wpgrade::textdomain()),
					'id' => wpgrade::prefix() . 'audio_poster',
					'type' => 'file',
					'std' => ''
				),
			)
		),
		'lens_portfolio_gallery' => array(
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
			)
		),
		'lens_portfolio_metadata' => array(
			'id'         => 'portfolio_metadata',
			'title'      => __('Details', wpgrade::textdomain()),
			'pages'      => array( 'lens_portfolio' ), // Post type
			'context'    => 'side',
			'priority'   => 'low',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => __('Client Name', wpgrade::textdomain()),
					'id'   => wpgrade::prefix() . 'portfolio_client_name',
					'type' => 'text_medium',
				),
				array(
					'name' => __('Client Link', wpgrade::textdomain()),
					'id'   => wpgrade::prefix() . 'portfolio_client_link',
					'type' => 'text_medium',
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
		),
        'lens_homepage_chooser' => array(
			'id'         => 'lens_homepage_chooser',
			'title'      => 'Choose Your Home Page',
			'pages'      => array( 'page' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
							array(
								'name' => __('Choose:', wpgrade::textdomain()),
								'desc' => __('Select what would you like to be your home page. If you want to have a static page as your homepage simply go the WP classic way and set it up in Settings > Reading (instead of this one).', wpgrade::textdomain()),
								'id' => wpgrade::prefix() . 'custom_homepage',
								'type' => 'radio_inline',
								'options' => array(
									array(
										'name' => 'Portfolio Archive',
										'value' => 'portfolio'
									),
									array(
										'name' => 'Gallery',
										'value' => 'gallery'
									),
								),
								'std' => 'portfolio',
							),
							array(
								'name' => __('Select a gallery', wpgrade::textdomain()),
								'desc' => __('Select a gallery and we will show it on your homepage.', wpgrade::textdomain()),
								'id' => wpgrade::prefix() . 'homepage_gallery',
								'type' => 'select_cpt_post',
								'options' => array(
									'args' => array (
										'post_type' => 'lens_gallery',
									),
									'hidden' => true,
								),
							),
					)
		),
	);

	update_option('pixtypes_themes_settings', $types_options);
	// flush permalinks rules on theme activation
	flush_rewrite_rules();
}

add_action('after_switch_theme', 'wpgrade_callback_geting_active');