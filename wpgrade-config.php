<?php
/**
 * End theme configuration
 *
 * @package Bucket Lite
 * @since Bucket Lite 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

return array
(
	# Commented values are optional properties. Many properties are
	# automatically deduced from others (eg. textdomain is deduced from
	# name, unless a custom value is provided)
	# ---------------------------------------------------------------------

	'name'       => 'bucket-lite',
	'shortname'  => 'bucket-lite',
	'prefix'     => '_bucket_',
	'textdomain' => 'bucket-lite',

	'language-path' => 'languages',

	// additional file includes (classes, functions, etc), files are loaded
	// via wpgrade::require_all and entries should be directories; if the
	// path does not exist it is automatically ignored
	'include-paths' => array
	(
		'theme-callbacks',
		'theme-utilities/includes/classes',
		'theme-utilities/includes/functions',
	),

	// same as include-paths only instead of files you specify files, to be
	// used with vendor dependencies to avoid multiple include/requires
	// happening due to the files in question adding subfiles relative to
	// their directory (also avoids problems with php configuration files)
	'include-files' => array
	(
		// main theme class
		'theme-utilities/bucket'.EXT,
		'theme-utilities/includes/required-plugins/required-plugins.php',
	),

	// the path where overwrites on the core partials are stored, any files
	// placed in the partial overwrites will be loaded instead of the core
	// equivalent view files
	'core-partials-overwrite-path' => 'theme-partials/wpgrade-partials',

	// the directory where css and other media files are located; used by
	// wpgrade::resourceuri; utility allows for easy migration of files to
	// new structures
	'resource-path' => '/theme-content',

	// use theme-options to add any non-customizable options with out going
	// though any of the backend code; all options added here are available
	// though the WPGradeOptions driver manager. ie. the  wpgrade::option
	// shorthand. Support for backend customization may be added at any
	// time later with out requiring any alterations; the options you add
	// here will have the lowest priority
	'theme-options' => array
	(
		// empty
	),

	// Usage: body_class(wpgrade::body_class()) in header.php
	// Syntax: class => callback or boolean; eg. 'myclass' => true,
	// 'myclass' => false, 'myclass' => 'class_check_function'. All
	// callbacks are executed once if more classes refer the same callback.
	'body-classes' => array
	(
		// empty
	),

	// overwrites the inline css class to allow for full control; you may
	// also leave this null, which will invoke an internal handler and work
	// with the core partial inline-custom-css
	'custom-css-handler' => null,

	// filter functions will recieve content as a parameter and must return
	// content; all functions are ordered by priority and executed from
	// lowest to highest. If a filter is assigned false as a priority it
	// will be ignored in processing
	'content-filters' => array
	(
		'default' => array
		(
			'wpgrade_callback_theme_general_filters' => 100,
			'wpgrade_callback_shortcode_filters'     => 200,
			'wpgrade_callback_attachment_filters'   => 300,
			'wpgrade_callback_paragraph_filters'     => 400,
		),
	),

	'shortcodes' => array
	(
		'Columns', 'Button', 'Icon', 'Tabs', 'Quote', 'Separator', 'Slider'
	),

	// importer
	'import_homepage_name' => 'Home',
	'import_blogpage_name' => false,

	// decide which menus should be imported
	'import_nav_menu' => array
	(
		'main_menu' => 'Header Menu',
		'top_menu_left' => 'Top Menu Left',
		'top_menu_right' => 'Top Menu Right',
		'footer_menu' => 'Footer Menu'
	),
	'resources' => array
	(
		// script declarations; scripts must be enqueue'ed to appear
		'register' => array
		(
			'head-scripts' => array
			(
				'modernizr'      => array(
					'path'    => get_template_directory_uri() . '/theme-content/js/vendor/modernizr.min.js',
					'require' => array(
						'jquery',
					),
				),
			),

			'footer-scripts' => array
			(
				'bucket-vendor-scripts-1' => array(
					'path'    => 'https://pxgcdn.com/js/rs/9.5.7/index.js',
					'require' => array(
						'jquery',
					),
				),
				'wpgrade-main-scripts' => array
				(
					'path' => get_template_directory_uri() . '/theme-content/js/main.js',
					'cache_bust' => '1.0',
					'require' => array
					(
						'jquery',
						'bucket-vendor-scripts-1',
					),
				),
			),

			'styles' => array
			(
				'google-webfonts' => array
				(
					'path' => 'https://fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic|PT+Sans:400,700,400italic,700italic|Open+Sans:400,700',
				),
				'wpgrade-main-style' => array
				(
					'path' => get_template_directory_uri().'/theme-content/css/style.css',
					'cache_bust' => '1.0',
				),

			)

		), # end register

		// auto invoke scripts previously registered on theme setup
		'auto-enqueue-scripts' => array
		(
			'wpgrade-main-scripts'
		),

		// enques script and localizes
		'auto-localize-scripts' => array(),

		// calls function to perform extra enqueue's on theme setup
		// handlers should be placed in theme's functions.php
		'script-enqueue-handlers' => array
		(
			'thread-comments' => 'wpgrade_callback_thread_comments_scripts',
		),

		// auto invoke styles previously registered on theme setup
		'auto-enqueue-styles' => array
		(
			'google-webfonts',
			'wpgrade-main-style',
		),

		// calls function to perform extra enqueue's on theme setup
		// handlers should be placed in theme's functions.php
		'style-enqueue-handlers' => array
		(
			'rtl-support' => 'wpgrade_callback_enqueue_rtl_support',
		),

	), # end resource

	// defaults for pagination; you may customize the values at any time
	// when invoking a pagination formatter, the following defaults will be
	// in effect if not overwritten
	'pagination' => array
	(
		// formatter to process the links; null if none needed
		// the formatter should return a string and accept links and
		// the resulting configuration
		'formatter' => 'wpgrade_callback_pagination_formatter',

		// show prev/next links?
		'prev_next' => true,

		// pagination text
		'prev_text' => esc_html__('Prev', 'bucket-lite'),
		'next_text' => esc_html__('Next', 'bucket-lite'),

		// are the terms used for paging relative to the sort order?
		// ie. older/newer instead of sorting agnostic previous/next
		'sorted_paging' => false,

		// the order of the posts (asc or desc); if asc is passed and
		// sorted_paging is true the values of prev_text and next_text
		// will be flipped
		'order' => 'desc',

		// show all pages? (ie. no cutoffs)
		'show_all' => false,

		// how many numbers on either the start and the end list edges
		'end_size' => 1,

		// how many numbers to either side of current page
		// not including current page
		'mid_size' => 2,

		// an array of query args to add
		'add_args' => false,

		// a string to append to each link
		'add_fragment' => null,
	),

	// allows you to create special pagination instances by providing a key
	// to wpgrade::pagination; the settings defined in the key will be used
	// to overwrite the defaults defined in pagination above; if the key
	// is not available the pagination system will ignore the request so you
	// can use the template names while developing and customize at any
	// time later
	'pagination-targets' => array
	(
		// empty
	),

	/**
	 * You can choose to have separate options for each language.
	 * for example for english you can chose a background color and for french another
	 * Note: Keep in mind that this option will create a total separate set of options for each language.
	 *       This means that if you change an option on english it will not be changed for other languages.
	 */
	'wpml_separate_options' => true, // default: false

); # end theme configuration
