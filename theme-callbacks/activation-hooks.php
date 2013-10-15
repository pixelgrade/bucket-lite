<?php
// theme activation
function wpgrade_callback_geting_active() {

	/**
	 * Create custom post types, taxonomies and metaboxes
	 * These will be taken by pixtypes plugin and converted in their own options
	 */
	$types_options = get_option('pixtypes_themes_settings');
	if ( empty($types_options) ) {
		$types_options = array();
	}
	$theme_key = wpgrade::shortname() . '_pixtypes_theme';
	$types_options[$theme_key] = array();
//	$types_options[$theme_key]['post_types'] = array(
//		'lens_portfolio' => array(
//			'labels' => array (
//				'name' => __('Project', wpgrade::textdomain()),
//				'singular_name' => __('Project', wpgrade::textdomain()),
//				'add_new' => __('Add New', wpgrade::textdomain()),
//				'add_new_item' => __('Add New Project', wpgrade::textdomain()),
//				'edit_item' => __('Edit Project', wpgrade::textdomain()),
//				'new_item' => __('New Project', wpgrade::textdomain()),
//				'all_items' => __('All Projects', wpgrade::textdomain()),
//				'view_item' => __('View Project', wpgrade::textdomain()),
//				'search_items' => __('Search Projects', wpgrade::textdomain()),
//				'not_found' => __('No Project found', wpgrade::textdomain()),
//				'not_found_in_trash' => __('No Project found in Trash', wpgrade::textdomain()),
//				'menu_name' => __('Projects', wpgrade::textdomain()),
//			),
//			'public' => true,
//			'rewrite' => array (
//				'slug' => 'lens_portfolio',
//				'with_front' => false,
//			),
//			'has_archive' => 'portfolio-archive',
//			'menu_icon' => 'report.png',
//			'menu_position' => NULL,
//			'supports' => array ( 'title', 'editor', 'thumbnail', 'page-attributes', 'excerpt', 'comments'),
//			'yarpp_support' => true,
//		),
//		'lens_gallery' => array(
//			'labels' => array (
//				'name' => __('Gallery', wpgrade::textdomain()),
//				'singular_name' => __('Gallery', wpgrade::textdomain()),
//				'add_new' => __('Add New', wpgrade::textdomain()),
//				'add_new_item' => __('Add New Gallery', wpgrade::textdomain()),
//				'edit_item' => __('Edit Gallery', wpgrade::textdomain()),
//				'new_item' => __('New Gallery', wpgrade::textdomain()),
//				'all_items' => __('All Galleries', wpgrade::textdomain()),
//				'view_item' => __('View Gallery', wpgrade::textdomain()),
//				'search_items' => __('Search Galleries', wpgrade::textdomain()),
//				'not_found' => __('No Gallery found', wpgrade::textdomain()),
//				'not_found_in_trash' => __('No Gallery found in Trash', wpgrade::textdomain()),
//				'menu_name' => __('Galleries', wpgrade::textdomain()),
//			),
//			'public' => true,
//			'rewrite' => array (
//				'slug' => 'lens_galleries',
//				'with_front' => false,
//			),
//			'has_archive' => 'galleries-archive',
//			'menu_icon' => 'slider.png',
//			'menu_position' => NULL,
//			'supports' => array ( 'title', 'thumbnail', 'page-attributes', 'excerpt'),
//			'yarpp_support' => true,
//		),
//	);
//	$types_options[$theme_key]['taxonomies'] = array(
//		'lens_portfolio_categories' => array(
//			'hierarchical' => true,
//			'labels' => array (
//				'name' => __('Portfolio Categories', wpgrade::textdomain()),
//				'singular_name' => __('Portfolio Category', wpgrade::textdomain()),
//				'search_items' => __('Search Portfolio Category', wpgrade::textdomain()),
//				'all_items' => __('All Portfolio Categories', wpgrade::textdomain()),
//				'parent_item' => __('Parent Portfolio Category', wpgrade::textdomain()),
//				'parent_item_colon' => __('Parent Portfolio Category: ', wpgrade::textdomain()),
//				'edit_item' => __('Edit Portfolio Category', wpgrade::textdomain()),
//				'update_item' => __('Update Portfolio Category', wpgrade::textdomain()),
//				'add_new_item' => __('Add New Portfolio Category', wpgrade::textdomain()),
//				'new_item_name' => __('New Portfolio Category Name', wpgrade::textdomain()),
//				'menu_name' => __('Portfolio Categories', wpgrade::textdomain()),
//			),
//			'show_admin_column' => true,
//			'rewrite' => array ( 'slug' => 'portfolio-category', 'with_front' => false ),
//			'sort' => true,
//			'post_types' => array('lens_portfolio')
//		),
//		'lens_gallery_categories' => array(
//			'hierarchical' => true,
//			'labels' => array (
//				'name' => __('Gallery Categories', wpgrade::textdomain()),
//				'singular_name' => __('Gallery Category', wpgrade::textdomain()),
//				'search_items' => __('Search Gallery Category', wpgrade::textdomain()),
//				'all_items' => __('All Gallery Categories', wpgrade::textdomain()),
//				'parent_item' => __('Parent Gallery Category', wpgrade::textdomain()),
//				'parent_item_colon' => __('Parent Gallery Category: ', wpgrade::textdomain()),
//				'edit_item' => __('Edit Gallery Category', wpgrade::textdomain()),
//				'update_item' => __('Update Gallery Category', wpgrade::textdomain()),
//				'add_new_item' => __('Add New Gallery Category', wpgrade::textdomain()),
//				'new_item_name' => __('New Gallery Category Name', wpgrade::textdomain()),
//				'menu_name' => __('Gallery Categories', wpgrade::textdomain()),
//			),
//			'show_admin_column' => true,
//			'rewrite' => array ( 'slug' => 'gallery-category', 'with_front' => false ),
//			'sort' => true,
//			'post_types' => array('lens_gallery')
//		),
//	);
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
		'post_gallery_format' => array(
			'id'         => 'post_format_metabox_gallery',
			'title'      => __('Gallery Settings', wpgrade::textdomain()),
			'pages'      => array( 'post' ), // Post type
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
					'name' => __('Slider transition', wpgrade::textdomain()),
					'id' => wpgrade::prefix() . 'post_slider_transition',
					'type' => 'select',
					'options' => array(
						array(
							'name' => __('Slide/Move', wpgrade::textdomain()),
							'value' => 'move'
						),
						array(
							'name' => __('Fade', wpgrade::textdomain()),
							'value' => 'fade'
						)
					),
					'std' => 'move'
				)				
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
					'desc' => __('Enter here a embed code here. The width should be a minimum of 640px.', wpgrade::textdomain()),
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
//		'lens_portfolio_gallery' => array(
//			'id'         => 'portfolio_gallery',
//			'title'      => __('Gallery', wpgrade::textdomain()),
//			'pages'      => array( 'lens_portfolio' ), // Post type
//			'context'    => 'normal',
//			'priority'   => 'high',
//			'show_names' => true, // Show field names on the left
//			'fields' => array(
//				array(
//					'name' => __('Images', wpgrade::textdomain()),
//					'id'   => wpgrade::prefix() . 'portfolio_gallery',
//					'type' => 'gallery',
//					'hidden' => true,
//				),
//			)
//		),
//		'lens_portfolio_video' => array(
//			'id' => 'portfolio_video',
//			'title' => __('Video Settings (optional)', wpgrade::textdomain()),
//			'pages'      => array( 'lens_portfolio' ), // Post type
//			'context'    => 'normal',
//			'priority'   => 'high',
//			'show_names' => true, // Show field names on the left
//			'fields' => array(
//				array(
//					'name' => __('Video Image', wpgrade::textdomain()),
//					'desc' => __('Choose an image for your video.', wpgrade::textdomain()),
//					'id' => wpgrade::prefix() . 'portfolio_video_image',
//					'type' => 'attachment',
//					'std' => '',
//				),
//				array(
//					'name' => __('YouTube Embed Code', wpgrade::textdomain()),
//					'desc' => __('Enter here a YouTube embed code. This video will be shown as one of the gallery items (first by default).', wpgrade::textdomain()),
//					'id' => wpgrade::prefix() . 'portfolio_video_youtube',
//					'type' => 'textarea_small',
//					'std' => '',
//				),
//				array(
//					'name' => __('Vimeo Embed Code', wpgrade::textdomain()),
//					'desc' => __('Enter here a Vimeo embed code. This video will be shown as one of the gallery items (first by default).<br /><i>If you have entered a YouTube video link, this will be ignored!</i>', wpgrade::textdomain()),
//					'id' => wpgrade::prefix() . 'portfolio_video_vimeo',
//					'type' => 'textarea_small',
//					'std' => '',
//				),
//			)
//		),
//		'lens_portfolio_metadata' => array(
//			'id'         => 'portfolio_metadata',
//			'title'      => __('Project Details', wpgrade::textdomain()),
//			'pages'      => array( 'lens_portfolio' ), // Post type
//			'context'    => 'normal',
//			'priority'   => 'high',
//			'show_names' => true, // Show field names on the left
//			'fields' => array(
//				array(
//					'name' => __('Template Style', wpgrade::textdomain()),
//					'desc' => __('Select the template you want for this project.', wpgrade::textdomain()),
//					'id' => wpgrade::prefix() . 'project_template',
//					'type' => 'select',
//					'options' => array(
//						array(
//							'name' => __('Full Width Slider', wpgrade::textdomain()),
//							'value' => 'fullwidth'
//						),
//						array(
//							'name' => __('Sidebar Right', wpgrade::textdomain()),
//							'value' => 'sidebar'
//						),
//						array(
//							'name' => __('Classic', wpgrade::textdomain()),
//							'value' => 'classic'
//						),
//					),
//					'std' => 'fullwidth',
//				),
//				array(
//					'name' => __('Image Scaling', wpgrade::textdomain()),
//					'desc' => __('<p class="cmb_metabox_description"><strong>Fill</strong> scales image to completely fill slider container (recommended for landscape images)</p>
//<p class="cmb_metabox_description"><strong>Fit</strong> scales image to fit the container (recommended for portrait images)</p>
//<p class="cmb_metabox_description"><strong>Fit if Smaller</strong> scales image to fit only if size of slider container is less than size of image.</p>
//<p class="cmb_metabox_description"><strong>Auto Height</strong> scales the container to fit the full size image.</p>
//<p class="cmb_metabox_description"><a target="_blank" href="http://bit.ly/slider-image-scaling">Visual explanation</a></p>', wpgrade::textdomain()),
//					'id' => wpgrade::prefix() . 'portfolio_image_scale_mode',
//					'type' => 'select',
//					'show_on'    => array( 'key' => 'select_value', 'value' => array( 'project_template' => 'fullwidth', 'project_template' => 'sidebar' ), ),
//					'options' => array(
//                        array(
//                            'name' => __('Fit', wpgrade::textdomain()),
//                            'value' => 'fit'
//                        ),
//                        array(
//                            'name' => __('Fill', wpgrade::textdomain()),
//                            'value' => 'fill'
//                        ),
//                        array(
//                            'name' => __('Fit if Smaller', wpgrade::textdomain()),
//                            'value' => 'fit-if-smaller'
//                        ),
//                        array(
//                            'name' => __('Auto Height', wpgrade::textdomain()),
//                            'value' => 'auto'
//                        ),
//					),
//					'std' => 'fill'
//				),
//				array(
//					'name' => __('Slider transition', wpgrade::textdomain()),
//					'id' => wpgrade::prefix() . 'portfolio_slider_transition',
//					'type' => 'select',
//					'options' => array(
//						array(
//							'name' => __('Slide/Move', wpgrade::textdomain()),
//							'value' => 'move'
//						),
//						array(
//							'name' => __('Fade', wpgrade::textdomain()),
//							'value' => 'fade'
//						)
//					),
//					'std' => 'move'
//				),
//				array(
//					'name' => __('Client Name', wpgrade::textdomain()),
//					'id'   => wpgrade::prefix() . 'portfolio_client_name',
//					'type' => 'text_medium',
//				),
//				array(
//					'name' => __('Client Link', wpgrade::textdomain()),
//					'id'   => wpgrade::prefix() . 'portfolio_client_link',
//					'type' => 'text_medium',
//				)
//			)
//		),
//		'lens_gallery' => array(
//			'id'         => 'lens_gallery',
//			'title'      => __('Gallery Detail', wpgrade::textdomain()),
//			'pages'      => array( 'lens_gallery' ), // Post type
//			'context'    => 'normal',
//			'priority'   => 'high',
//			'show_names' => true, // Show field names on the left
//			'fields' => array(
//				array(
//					'name' =>  __('Images', wpgrade::textdomain()),
//					'id'   =>  wpgrade::prefix() . 'main_gallery',
//					'type' => 'gallery',
//				),
//				array(
//					'name' => __('Template Style', wpgrade::textdomain()),
//					'id' => wpgrade::prefix() . 'gallery_template',
//					'type' => 'select',
//					'options' => array(
//						array(
//							'name' => __('Grid Thumbnails', wpgrade::textdomain()),
//							'value' => 'masonry'
//						),
//						array(
//							'name' => __('Full Width Slider', wpgrade::textdomain()),
//							'value' => 'fullwidth'
//						),
//						array(
//							'name' => __('Full Screen Slider', wpgrade::textdomain()),
//							'value' => 'fullscreen'
//						),
//					),
//					'std' => 'fullwidth',
//				),
//				array(
//					'name' => __( 'Image Scaling', wpgrade::textdomain() ),
//					'desc' => __('<p class="cmb_metabox_description"><strong>Fill</strong> scales image to completely fill slider container (recommended for landscape images)</p>
//<p class="cmb_metabox_description"><strong>Fit</strong> scales image to fit the container (recommended for portrait images)</p>
//<p class="cmb_metabox_description"><strong>Fit if Smaller</strong> scales image to fit only if size of slider container is less then size of image.</p>
//<p class="cmb_metabox_description"><a target="_blank" href="http://bit.ly/slider-image-scaling">Visual explanation</a></p>', wpgrade::textdomain()),
//					'id' => wpgrade::prefix() . 'gallery_image_scale_mode',
//					'type' => 'select',
//					'options' => array(
//						array(
//							'name' => __('Fill', wpgrade::textdomain()),
//							'value' => 'fill'
//						),
//						array(
//							'name' => __('Fit', wpgrade::textdomain()),
//							'value' => 'fit'
//						),
//						array(
//							'name' => __('Fit if Smaller', wpgrade::textdomain()),
//							'value' => 'fit-if-smaller'
//						),
//					),
//					'std' => 'fill',
//				),
//				array(
//					'name' => __('Slider transition', wpgrade::textdomain()),
//					'id' => wpgrade::prefix() . 'gallery_slider_transition',
//					'type' => 'select',
//					'options' => array(
//						array(
//							'name' => __('Slide/Move', wpgrade::textdomain()),
//							'value' => 'move'
//						),
//						array(
//							'name' => __('Fade', wpgrade::textdomain()),
//							'value' => 'fade'
//						)
//					),
//					'std' => 'move'
//				),
//				array(
//					'name' => __('Grid Thumbnails Orientation', wpgrade::textdomain()),
//					'id' => wpgrade::prefix() . 'thumb_orientation',
//					'type' => 'select',
//					'options' => array(
//						array(
//							'name' => __('Landscape', wpgrade::textdomain()),
//							'value' => 'landscape'
//						),
//						array(
//							'name' => __('Portrait', wpgrade::textdomain()),
//							'value' => 'portrait'
//						)
//					),
//					'std' => 'landscape'
//				),
//				array(
//					'name' => __('Gallery Title Box', wpgrade::textdomain()),
//					'desc' => __('Show the title of the gallery in a thumbnail box or not.', wpgrade::textdomain()),
//					'id' => wpgrade::prefix() . 'show_gallery_title',
//					'type' => 'select',
//					'options' => array(
//						array(
//							'name' => __('Show', wpgrade::textdomain()),
//							'value' => true
//						),
//						array(
//							'name' => __('Hide', wpgrade::textdomain()),
//							'value' => false
//						)
//					),
//					'std' => false
//				)
//			)
//		),
//        'bucket_homepage_chooser' => array(
//			'id'         => 'bucket_homepage_chooser',
//			'title'      => __('Choose Your Home Page', wpgrade::textdomain()),
//			'pages'      => array( 'page' ), // Post type
//			'context'    => 'normal',
//			'priority'   => 'high',
//			'show_names' => true, // Show field names on the left
//			'fields' => array(
//				array(
//					'name' => __('Choose:', wpgrade::textdomain()),
//					'desc' => __('Select what would you like to be your home page. If you want to have a static page as your homepage simply go the WP classic way and set it up in Settings > Reading (instead of this one).', wpgrade::textdomain()),
//					'id' => wpgrade::prefix() . 'custom_homepage',
//					'type' => 'radio_inline',
//					'options' => array(
//						array(
//							'name' => __('Portfolio Archive', wpgrade::textdomain()),
//							'value' => 'lens_portfolio'
//						),
//						array(
//							'name' => __('Gallery', wpgrade::textdomain()),
//							'value' => 'lens_gallery'
//						),
//					),
//					'std' => 'lens_portfolio',
//				),
//				array(
//					'name' => __('Select a gallery', wpgrade::textdomain()),
//					'desc' => __('Select a gallery and we will show it on your homepage.', wpgrade::textdomain()),
//					'id' => wpgrade::prefix() . 'homepage_gallery',
//					'type' => 'select_cpt_post',
//					'options' => array(
//						'args' => array (
//							'post_type' => 'lens_gallery',
//						),
//						'hidden' => true,
//					),
//				),
//				array(
//					'name' => __('Projects Number', wpgrade::textdomain()),
//					'desc' => __('Select a number of projects to show on your homepage. For unlimited projects keep it empty', wpgrade::textdomain()),
//					'id'   => wpgrade::prefix() . 'homepage_projects_number',
//					'type' => 'text_small',
//				)
//			)
//		),
	);

	update_option('pixtypes_themes_settings', $types_options);

	// flush permalinks rules on theme activation
	flush_rewrite_rules();
}

add_action('after_switch_theme', 'wpgrade_callback_geting_active');