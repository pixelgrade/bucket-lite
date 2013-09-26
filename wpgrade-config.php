<?php return array
	(
		# Commented values are optional properties. Many properties are
		# automatically deduced from others (eg. textdomain is deduced from
		# name, unless a custom value is provided)
		# ---------------------------------------------------------------------

		'name'       => 'Lens',
		'shortname'  => 'lens',
		'prefix'     => '_lens_',
//		'textdomain' => 'lens_txtd',

		// additional file includes (classes, functions, etc), files are loaded
		// via wpgrade::require_all and entries should be directories; if the
		// path does not exist it is automatically ignored
		'include-paths' => array
			(
				'theme-callbacks',
				'theme-utils'
			),

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

		// Usege: body_class(wpgrade::body_class()) in header.php
		// Syntax: class => callback or boolean; eg. 'myclass' => true,
		// 'myclass' => false, 'myclass' => 'class_check_function'. All
		// callbacks are executed once if more classes refer the same callback.
		'body-classes' => array
			(
				// empty
			),

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
						'wpgrade_callback_attachement_filters'   => 300,
						'wpgrade_callback_paragraph_filters'     => 400,
					),
			),

		'shortcodes' => array
			(
                 'Columns', 'Button', 'Icon', 'Tabs', 'Quote', 'TeamMember', 'Separator', 'ProgressBar', 'Slider'
			),

		'resources' => array
			(
				// script declarations; scripts must be enqueue'ed to appear
				'register' => array
					(
						'head-scripts' => array
							(
                                // empty
							),

						'footer-scripts' => array
							(
                                'google-maps-api' => array
                                    (
                                        'path' => 'http://maps.google.com/maps/api/js?sensor=false&amp;language=en',
                                        'require' => array
                                            (
                                                'jquery'
                                            ),
                                    ),
                                'wpgrade-main-scripts' => array
                                    (
                                        'path' => get_template_directory_uri() . '/theme-content/js/main.js',
                                        'cache_bust' => wpgrade::cachebust_string(wpgrade::themefilepath('theme-content/js/main.js')),
                                        'require' => array
                                            (
                                                'jquery',
                                            ),
                                    ),

							),

						'styles' => array
							(
                                'google-webfonts' => array
                                    (
                                        'path' => 'http://fonts.googleapis.com/css?family=Roboto:300,500,300italic,500italic|Open+Sans:300,400,700,300italic,400italic,700italic|Josefin+Slab:400,600,700|Crimson+Text:400,400italic',
                                    ),
								'wpgrade-main-style' => array
									(
										'path' => get_template_directory_uri().'/theme-content/css/style.css',
										'cache_bust' => wpgrade::cachebust_string(wpgrade::themefilepath('theme-content/css/style.css')),
									),

							)

					), # end register

				// auto invoke scripts previously registered on theme setup
				'auto-enqueue-scripts' => array
					(
                        'google-maps-api',
						'wpgrade-main-scripts'
					),

				// enques script and localizes
				'auto-localize-scripts' => array
					(
						'wpgrade-main-scripts' => array
							(
								'key' => 'ajaxurl',
								'data' => admin_url('admin-ajax.php')
							),
					),

				// calls function to perform extra enqueue's on theme setup
				// handlers should be placed in theme's functions.php
				'script-enqueue-handlers' => array
					(
						'contact-form' => 'wpgrade_callback_contact_script',
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
						'dynamic-css' => 'wpgrade_callback_enqueue_dynamic_css'
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
				'prev_text' => 'Newer posts',
				'next_text' => 'Older posts',

				// are the terms used for paging relative to the sort order?
				// ie. older/newer instead of sorting agnostic previous/next
				'sorted_paging' => true,

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

	); # end theme configuration
