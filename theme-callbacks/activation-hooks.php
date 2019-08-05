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

	$types_options[$theme_key]['metaboxes'] = array(
		'page' => array(
			'id' => 'page',
			'title' => esc_html__('Settings', 'bucket-lite' ),
			'pages'      => array('page'), // Post type
			'context' => 'side',
			'priority' => 'low',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => esc_html__('Prevent Duplicate Posts', 'bucket-lite' ),
					'desc' => '<div class="tooltip" title="'. esc_attr__('Activate this if you want page composer blocks NOT to display posts displayed above them in the page.<br/>The Latest Posts block will ignore this setting.', 'bucket-lite' ).'"></div>',
					'id' => wpgrade::prefix() . 'prevent_duplicate_posts',
					'type' => 'checkbox',
					'std' => '0',
				),
			)
		),
		'post' => array(
			'id' => 'post',
			'title' => esc_html__('Settings', 'bucket-lite' ),
			'pages'      => array('post'), // Post type
			'context' => 'side',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => esc_html__('Full Width Featured Image', 'bucket-lite' ),
					'desc' => '<div class="tooltip" title="'. esc_attr__('The featured image could be full width if you check this on', 'bucket-lite' ).'"></div>',
					'id' => wpgrade::prefix() . 'full_width_featured_image',
					'type' => 'checkbox',
					'std' => '0',
				),
				array(
					'name' => esc_html__('Mark as Featured Post', 'bucket-lite' ),
					'desc' => '<div class="tooltip" title="'. esc_attr__('Is this post more important than others?', 'bucket-lite' ).'"></div>',
					'id' => wpgrade::prefix() . 'featured_post',
					'type' => 'checkbox',
					'std' => '0',
				),
				array(
					'name' => esc_html__('Add to Category Slider', 'bucket-lite' ),
					'desc' => '<div class="tooltip" title="'. esc_attr__('You can add this post to the category slider', 'bucket-lite' ).'" ></div>',
					'id' => wpgrade::prefix() . 'category_slide',
					'type' => 'checkbox',
					'std' => '0',
				),
				array(
					'name' => esc_html__('Disable Sidebar', 'bucket-lite' ),
					'desc' => '<div class="tooltip" title="'. esc_attr__('You may want this post to be full width', 'bucket-lite' ).'" ></div>',
					'id' => wpgrade::prefix() . 'disable_sidebar',
					'type' => 'checkbox',
					'std' => '0',
				)
			)
		),
		'post_video_format' => array(
			'id' => 'post_format_metabox_video',
			'title' => esc_html__('Video Settings', 'bucket-lite' ),
			'pages'      => array('post'), // Post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => esc_html__('Embed Code', 'bucket-lite' ),
					'desc' => esc_html__('Enter here a Youtube, Vimeo (or other online video services) embed code here. The width should be a minimum of 640px. We will use this if filled, not the selfhosted options bellow!', 'bucket-lite' ),
					'id' => wpgrade::prefix() . 'video_embed',
					'type' => 'textarea_small',
					'std' => '',
				),
			)
		),
		'post_gallery_format' => array(
			'id'         => 'post_format_metabox_gallery',
			'title'      => esc_html__('Gallery Settings', 'bucket-lite' ),
			'pages'      => array( 'post' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' =>  esc_html__('Images', 'bucket-lite' ),
					'id'   =>  wpgrade::prefix() . 'main_gallery',
					'type' => 'gallery',
				),
				array(
					'name' => esc_html__('Image Scaling', 'bucket-lite' ),
					'desc' => wp_kses_post( __('<p class="cmb_metabox_description"><strong>Fill</strong> scales image to completely fill slider container (recommended for landscape images)</p>
<p class="cmb_metabox_description"><strong>Fit</strong> scales image to fit the container (recommended for portrait images)</p>
<p class="cmb_metabox_description"><strong>Fit if Smaller</strong> scales image to fit only if size of slider container is less than size of image.</p>
<p class="cmb_metabox_description"><a target="_blank" href="http://bit.ly/slider-image-scaling">Visual explanation</a></p>', 'bucket-lite' ) ),
					'id' => wpgrade::prefix() . 'post_slider_image_scale',
					'type' => 'select',
					'show_on'    => array( 'key' => 'select_value', 'value' => array( 'project_template' => 'fullwidth' ), ),
					'options' => array(
                        array(
                            'name' => esc_html__('Fit', 'bucket-lite' ),
                            'value' => 'fit'
                        ),
                        array(
                            'name' => esc_html__('Fill', 'bucket-lite' ),
                            'value' => 'fill'
                        ),
                        array(
                            'name' => esc_html__('Fit if Smaller', 'bucket-lite' ),
                            'value' => 'fit-if-smaller'
                        )
					),
					'std' => 'fill'					
				),

				array(
					'name' => esc_html__('Slider height', 'bucket-lite' ),
					'desc' => esc_html__('Enter a slider height here (only digits, without \'px\'). If left blank, it will default to 525px', 'bucket-lite' ),
					'id' => wpgrade::prefix() . 'post_slider_height',
					'type' => 'text_small',
					'std' => '',
				),				
				array(
					'name' => esc_html__('Show Nearby Images', 'bucket-lite' ),
					'desc' => esc_html__('Enable this if you want to avoid having empty space on the sides of the image when using mostly portrait images.', 'bucket-lite' ),
					'id' => wpgrade::prefix() . 'post_slider_visiblenearby',
					'type' => 'select',
					'options' => array(
						array(
							'name' => esc_html__('Enabled', 'bucket-lite' ),
							'value' => true
						),
						array(
							'name' => esc_html__('Disabled', 'bucket-lite' ),
							'value' => false
						)
					),
					'std' => false
				),
				array(
					'name' => esc_html__('Slider transition', 'bucket-lite' ),
					'id' => wpgrade::prefix() . 'post_slider_transition',
					'type' => 'select',
					'options' => array(
						array(
							'name' => esc_html__('Slide/Move', 'bucket-lite' ),
							'value' => 'move'
						),
						array(
							'name' => esc_html__('Fade', 'bucket-lite' ),
							'value' => 'fade'
						)
					),
					'std' => 'move'
				),
				array(
					'name' => esc_html__('Slider autoplay', 'bucket-lite' ),
					'id' => wpgrade::prefix() . 'post_slider_autoplay',
					'type' => 'select',
					'options' => array(
						array(
							'name' => esc_html__('Enabled', 'bucket-lite' ),
							'value' => true
						),
						array(
							'name' => esc_html__('Disabled', 'bucket-lite' ),
							'value' => false
						)
					),
					'std' => false
				),
				array(
					'name' => esc_html__('Autoplay delay between slides (in milliseconds)', 'bucket-lite' ),
					'id' => wpgrade::prefix() . 'post_slider_delay',
					'type' => 'text_small',
					'std' => '1000'
				),
			)
		),
		'post_audio_format' => array(
			'id' => 'post_format_metabox_audio',
			'title' =>  esc_html__('Audio Settings', 'bucket-lite' ),
			'pages'      => array( 'post'), // Post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => esc_html__('Embed Code', 'bucket-lite' ),
					'desc' => esc_html__('Enter here a embed code here. The width should be a minimum of 640px.', 'bucket-lite' ),
					'id' => wpgrade::prefix() . 'audio_embed',
					'type' => 'textarea_small',
					'std' => '',
				),
				array(
					'name' => esc_html__('MP3 File URL', 'bucket-lite' ),
					'desc' => esc_html__('Please enter in the URL to the .mp3 file', 'bucket-lite' ),
					'id' => wpgrade::prefix() . 'audio_mp3',
					'type' => 'file',
					'std' => ''
				),
				array(
					'name' => esc_html__('M4A File URL', 'bucket-lite' ),
					'desc' => esc_html__('Please enter in the URL to the .m4a file', 'bucket-lite' ),
					'id' => wpgrade::prefix() . 'audio_m4a',
					'type' => 'file',
					'std' => ''
				),
				array(
					'name' => esc_html__('OGA File URL', 'bucket-lite' ),
					'desc' => esc_html__('Please enter in the URL to the .ogg or .oga file', 'bucket-lite' ),
					'id' => wpgrade::prefix() . 'audio_ogg',
					'type' => 'file',
					'std' => ''
				),
				array(
					'name' => esc_html__('Poster Image', 'bucket-lite' ),
					'desc' => esc_html__('This will be the image displayed above the audio controls. The image should be at least 640px wide. Click the "Upload" button to open the Media Manager, and click "Use as Poster Image" once you have uploaded or chosen an image from the media library.', 'bucket-lite' ),
					'id' => wpgrade::prefix() . 'audio_poster',
					'type' => 'file',
					'std' => ''
				),
			)
		),
	);

	update_option('pixtypes_themes_settings', $types_options);

	// flush permalinks rules on theme activation
	flush_rewrite_rules();
}

add_action('after_switch_theme', 'wpgrade_callback_geting_active');
