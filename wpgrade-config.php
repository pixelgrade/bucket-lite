<?php return array
	(
		# Commented values are optional properties. Many properties are
		# automatically deduced from others (eg. textdomain is deduced from
		# name, unless a custom value is provided)
		# ---------------------------------------------------------------------

		'name'       => 'CityHub',
//		'shortname'  => 'cityhub',
//		'prefix'     => '_cityhub_',
//		'textdomain' => 'cityhub_txtd',

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
				'header-transparent' => 'wpgrade_callback_has_featured_image_class',
			),

		// filter functions will recieve content as a parameter and must return
		// content; all functions are ordered by priority and executed from
		// lowest to highest. If a filter is assigned false as a priority it
		// will be ignored in processing
		'content-filters' => array
			(
				'wpgrade_callback_theme_general_filters' => 100,
				'wpgrade_callback_shortcode_filters'     => 200,
				'wpgrade_callback_attachement_filters'   => 300,
				'wpgrade_callback_paragraph_filters'     => 400,
			),

		'shortcodes' => array
			(
				'Columns',
				'ProgressBar',
				'TeamMemberCityHub',
				'Icon',
				'Button',
				'DividerCityHub',
				'Quote',
				'TestimonialsCityHub',
				'PortfolioCityhub',
				'TwitterFeed',
				'InfoBox'
			),

		'resources' => array
			(
				// script declarations; scripts must be enqueue'ed to appear
				'register' => array
					(
						'head-scripts' => array
							(
								'youtube-api' => wpgrade::protocol().'://www.youtube.com/iframe_api',
								'fitvids' => get_template_directory_uri() . '/library/js/plugins/jquery.fitvids.js'
							),

						'footer-scripts' => array
							(
								'magnific-popup' => get_template_directory_uri().'/wpgrade-content/js/plugins/jquery.magnific-popup.min.js',
								'froogaloop' => get_template_directory_uri().'/library/js/plugins/froogaloop.min.js',
								'autoresize' => get_template_directory_uri().'/library/js/plugins/jquery.autoresize.min.js',

								'contact-scripts' => array
									(
										'path' => get_template_directory_uri().'/library/js/contact.js',
										'require' => array('jquery', 'gmap-api', 'gmap-infobox')
									),

								'modernizr' => array
									(
										'path' => get_template_directory_uri().'/library/js/plugins/modernizr.js',
										'require' => 'jquery',
									),

								'caroufredsel' => array
									(
										'path' => get_template_directory_uri().'/library/js/jquery.caroufredsel.js',
										'require' => 'jquery',
									),

								'nice-scroll' => array
									(
										'path' => get_template_directory_uri().'/library/js/plugins/jquery.nicescroll.min.js',
										'require' => 'jquery',
									),

								'isotope' => array
									(
										'path' => get_template_directory_uri().'/library/js/plugins/jquery.isotope.min.js',
										'require' => 'jquery',
									),

								'flexslider' => array
									(
										'path' => get_template_directory_uri().'/library/js/plugins/flexslider.js',
										'cache_bust' => wpgrade::cachebust_string(wpgrade::themefilepath('wpgrade-content/js/plugins/flexslider.js')),
										'require' => 'jquery',
									),

								'mediaelement' => array
									(
										'path' => get_template_directory_uri().'/library/js/plugins/mediaelement-and-player.min.js',
										'require' => 'jquery',
									),


								// Google maps
								// -----------

								'gmap-api' => wpgrade::protocol().'://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false',
								'gmap-infobox' => get_template_directory_uri() . '/library/js/plugins/gmap/infobox.js',


								// IE8 polyfill
								// ------------

								'respond' => get_template_directory_uri().'/library/js/respond.js',

								'backgroundsize' => array
									(
										'path' => get_template_directory_uri().'/library/js/jquery.backgroundsize.js',
										'require' => 'jquery',
									),

								// Theme Unsorted Scripts
								// ----------------------

								'wpgrade-unsorted-scripts' => array
									(
										'path' => get_template_directory_uri() . '/library/js/scripts.js',
										'cache_bust' => wpgrade::cachebust_string(wpgrade::themefilepath('wpgrade-content/js/scripts.js')),
										'require' => array
											(
												'flexslider', 'nice-scroll',
												'autoresize', 'isotope',
												'jquery', 'youtube-api',
												'mediaelement', 'froogaloop',
												'fitvids', 'magnific-popup',
												'caroufredsel', 'respond',
												'backgroundsize'
											),
									),

							),

						'styles' => array
							(
								'wpgrade-google-web-fonts' => wpgrade::protocol().'://fonts.googleapis.com/css?family=Lato:400,700,800|Open+Sans:400,700',

								'wpgrade-main-style' => array
									(
										'path' => get_template_directory_uri().'/library/css/style.css',
										'cache_bust' => wpgrade::cachebust_string(wpgrade::themefilepath('wpgrade-content/css/style.css')),
									),

							)

					), # end register

				// auto invoke scripts previously registered on theme setup
				'auto-enqueue-scripts' => array
					(
						'modernizr',
						'wpgrade-unsorted-scripts'
					),

				// enques script and localizes
				'auto-localize-scripts' => array
					(
						'wpgrade-unsorted-scripts' => array
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
						'wpgrade-google-web-fonts',
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
