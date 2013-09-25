<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_action( 'admin_print_scripts-post-new.php', 'portfolio_admin_script', 11 );
add_action( 'admin_print_scripts-post.php', 'portfolio_admin_script', 11 );

function portfolio_admin_script() {

    global $post_type;

    if ( 'portfolio' == $post_type ) {
        wp_enqueue_style( 'portfolio-admin-script', wpgrade::content_url() . 'inc/metaboxes/css/portfolio.css' );
        wp_register_script( 'reveal-js', wpgrade::content_url() . 'inc/metaboxes/js/reveal.js' );
        wp_enqueue_script( 'bootstrap-dropdown', wpgrade::content_url() . 'inc/metaboxes/js/bootstrap-dropdown.js' );
        wp_enqueue_script( 'portfolio-admin-script', wpgrade::content_url() . 'inc/metaboxes/js/portfolio-patterns.js', array( 'jquery', 'reveal-js', 'bootstrap-dropdown' ) );
    }

}

add_filter( 'cmb_meta_boxes', 'cmb_wpgrade_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_wpgrade_metaboxes( array $meta_boxes ) {

	$meta_boxes[] = array(
		'id'         => 'homepage_slide_content',
		'title'      => 'Home Slider Content',
		'pages'      => array( 'homepage_slide' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
            array(
                'name' => 'Image',
                'desc' => __('Upload an image or enter an URL.', wpgrade::textdomain()),
                'id'   => wpgrade::prefix() . 'homepage_slide_image',
                'type' => 'attachment',
            ),
            array(
                'name'    => 'Caption',
                'desc'    => __('The caption of the slider', wpgrade::textdomain()),
                'id'      => wpgrade::prefix() . 'homepage_slide_caption',
                'type'    => 'wysiwyg',
                'options' => array(	'textarea_rows' => 5, ),
            ),
            array(
                'name' => 'Button Label',
                'id'   => wpgrade::prefix() . 'homepage_slide_label',
                'type' => 'text_medium',
            ),
            array(
                'name' => 'Link',
                'id'   => wpgrade::prefix() . 'homepage_slide_link',
                'type' => 'text',
            ),
		),
	);

    /*
     * The Video Post Format
     */
    $meta_boxes[] = array(
        'id' => 'post_format_metabox_video',
        'title' => __('Video Settings', wpgrade::textdomain()),
        'pages'      => array( 'homepage_slide' ), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => __('Youtube Link', wpgrade::textdomain()),
                'desc' => __('Enter here an Youtube video link. Any videos bellow will be ignored.', wpgrade::textdomain()),
                'id' => wpgrade::prefix() . 'youtube_id',
                'type' => 'text',
                'std' => '',
            ),
            array(
                'name' => __('Vimeo Link', wpgrade::textdomain()),
                'desc' => __('Enter here a Vimeo video link. Any videos bellow will be ignored.', wpgrade::textdomain()),
                'id' => wpgrade::prefix() . 'vimeo_link',
                'type' => 'text',
                'std' => '',
            ),
			array(
                'name' => __('Vimeo Video Width', wpgrade::textdomain()),
                'desc' => __('Enter here the video width (we are only interested in the aspect ratio, width/height, so you could use 16 and 9; we use this to try and get rid of the black bars)', wpgrade::textdomain()),
                'id' => wpgrade::prefix() . 'video_width',
                'type' => 'text_small',
                'std' => '500',
            ),
			array(
                'name' => __('Vimeo Video Height', wpgrade::textdomain()),
                'desc' => __('Enter here the video height', wpgrade::textdomain()),
                'id' => wpgrade::prefix() . 'video_height',
                'type' => 'text_small',
                'std' => '281',
            ),
            array(
                'name' => __('MP4 File URL', wpgrade::textdomain()),
                'desc' => __('Please enter in the URL to your .m4v video file (h.264 codec). This format is need to provide support for Safari, IE9, iPhone, iPad, Android, and Windows Phone 7', wpgrade::textdomain()),
                'id' => wpgrade::prefix() . 'video_m4v',
                'type' => 'file',
                'std' => ''
            ),
            array(
                'name' => __('WebM/VP8 File URL', wpgrade::textdomain()),
                'desc' => __('Please enter in the URL to your .webm video file. This format is need to provide support for Firefox4, Opera, and Chrome', wpgrade::textdomain()),
                'id' => wpgrade::prefix() . 'video_webm',
                'type' => 'file',
                'std' => ''
            ),
            array(
                'name' => __('Ogg/Vorbis File URL', wpgrade::textdomain()),
                'desc' => __('Please enter in the URL to your .ogv video file. This format is need to provide support for older Firefox and Opera versions', wpgrade::textdomain()),
                'id' => wpgrade::prefix() . 'video_ogv',
                'type' => 'file',
                'std' => ''
            ),
            array(
                'name' => __('Preview Image', wpgrade::textdomain()),
                'desc' => __('This will be the image displayed when the video has not been played yet. The image should be at least 640px wide. Click the "Upload" button to open the Media Manager, and click "Use as Preview Image" once you have uploaded or chosen an image from the media library.', wpgrade::textdomain()),
                'id' => wpgrade::prefix() . 'video_poster',
                'type' => 'file',
                'std' => ''
            ),
        )
    );

	/*
	 * The Quote Post Format
	 */
    $meta_boxes[] = array(
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
	);

	/*
	 * The Video Post Format
	 */
    $meta_boxes[] = array(
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
	);

    /*
     * Portfolio Post Type
     */
    $meta_boxes[] = array(
        'id' => 'portfolio_page_layout',
        'title' => __('Portfolio Template', wpgrade::textdomain()),
        'pages'      => array('portfolio'), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                    'name' => __('Template', wpgrade::textdomain()),
                    'desc' => __('Select the template you want for this project.', wpgrade::textdomain()),
                    'id' => wpgrade::prefix() . 'project_template',
                    'type' => 'select',
                    'options' => array(
                            array(
                                'name' => 'Classic',
                                'value' => 'classic'
                            ),
                            array(
                                'name' => 'Full Width',
                                'value' => 'fullwidth'
                            ),
                            array(
                                'name' => 'Sidebar Right',
                                'value' => 'sidebar'
                            ),
                        ),
                    'std' => 'classic',
                ),
        )
    );

	/*
	 * The Audio Post Format
	 */
	$meta_boxes[] = array(
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
	);

	/*
	 * The Link Post Format
	 */
//	$meta_boxes[] = array(
//		'id' => 'post_format_metabox_link',
//		'title' =>  __('Link Settings', wpgrade::textdomain()),
//		'pages'      => array( 'post', ), // Post type
//		'context' => 'normal',
//		'priority' => 'high',
//		'show_names' => true, // Show field names on the left
//		'fields' => array(
//			array(
//					'name' =>  __('Link URL', wpgrade::textdomain()),
//					'desc' => __('Please input the URL of your link(i.e. http://www.pixelgrade.com)', wpgrade::textdomain()),
//					'id' => wpgrade::prefix() .'link',
//					'type' => 'text',
//					'std' => ''
//				)
//		)
//	);

	/*
     * Testimonials meta
     */

    $meta_boxes[] = array(
        'id'         => 'testimonial_metabox',
        'title'      => __( 'Testimonial Metabox', wpgrade::textdomain() ),
        'pages'      => array( 'testimonial' ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name' => __( 'Author Name', wpgrade::textdomain() ),
                'desc' => __( 'The author of this confession', wpgrade::textdomain() ),
                'id'   => wpgrade::prefix() . 'author_name',
                'type' => 'text_medium',
            ),
            array(
                'name' => __( 'Author Function', wpgrade::textdomain() ),
                'desc' => __( 'The title of the author (eg. Client)', wpgrade::textdomain() ),
                'id'   => wpgrade::prefix() . 'author_function',
                'type' => 'text_medium',
            ),
            array(
                'name' => __( 'Author Link', wpgrade::textdomain() ),
                'desc' => __( 'A link to the author website (optional)', wpgrade::textdomain() ),
                'id'   => wpgrade::prefix() . 'author_link',
                'type' => 'text_medium',
            ),
        ),
    );

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/*
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}