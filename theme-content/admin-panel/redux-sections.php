<?php

	$sections = array();


	// General Options
	// ------------------------------------------------------------------------

	$sections[] = array(
		'icon' => 'cogs',
		'icon_class' => '',
		'title' => __('General Options', wpgrade::textdomain()),
		'desc' => __('<p class="description">Welcome to the '. wpgrade::themename() .' options panel! You can switch between option groups by using the left-hand tabs.</p>', wpgrade::textdomain()),
		'fields' => array(
			array(
				'id' => 'wpGrade_import_demodata_button',
				'type' => 'raw_html_option',
				'title' => __('Import Demo Data', wpgrade::textdomain()),
				'sub_desc' => __('Here you can import the demo data and get on your way of setting up the site like the theme demo.', wpgrade::textdomain()),
				'html' =>
					'
						<input type="hidden" name="wpGrade-nonce-import-posts-pages" value="'.wp_create_nonce ('wpGrade_nonce_import_demo_posts_pages').'" />
						<input type="hidden" name="wpGrade-nonce-import-theme-options" value="'.wp_create_nonce ('wpGrade_nonce_import_demo_theme_options').'" />
						<input type="hidden" name="wpGrade-nonce-import-widgets" value="'.wp_create_nonce ('wpGrade_nonce_import_demo_widgets').'" />
						<input type="hidden" name="wpGrade_import_ajax_url" value="'.admin_url("admin-ajax.php").'" />

						<a href="#" class="button button-primary" id="wpGrade_import_demodata_button">
							Import demo data
						</a>

						<div class="wpGrade-loading-wrap hidden">
							<span class="wpGrade-loading wpGrade-import-loading"></span>
							<div class="wpGrade-import-wait">
								Please wait a few minutes (between 2 and 5 minutes usually, but
								depending on your hosting it can take longer) and <strong>don\'t
								reload the page</strong>. You will be notified as soon as the
								import has finished!
							</div>
						</div>

						<div class="wpGrade-import-results hidden"></div>
					',
			),
			array(
				'id' => 'use_smooth_scroll',
				'type' => 'checkbox',
				'title' => __('Smooth Scrolling', wpgrade::textdomain()),
				'sub_desc' => __('Enable / Disable smooth scrolling', wpgrade::textdomain()),
				'std' => '1',
				'switch' => true
			),
            array(
                'id' => 'use_ajax_loading',
                'type' => 'checkbox',
                'title' => __('Ajax Loading', wpgrade::textdomain()),
                'sub_desc' => __('Enable / Disable ajax loading', wpgrade::textdomain()),
                'std' => '1',
                'switch' => true
            ),
			array(
				'id' => 'portfolio_use_taxonomies_info_alert',
				'type' => 'info',
				'desc' => __('<h2>Branding Options</h2>', wpgrade::textdomain())
			),
			array(
				'id' => 'main_logo',
				'type' => 'upload',
				'title' => __('Main Logo', wpgrade::textdomain()),
				'sub_desc' => __('Upload here your logo image (we recommend a height of 80-100px).If there is no image uploaded, plain text will be used instead (generated from the site\'s name).', wpgrade::textdomain()),
			),
			array(
				'id' => 'use_retina_logo',
				'type' => 'checkbox_hide_below',
				'title' => __('Retina 2x Logo', wpgrade::textdomain()),
				'sub_desc' => __('To be Retina-ready you need to add a 2x logo image (double the dimensions of the 1x logo above).', wpgrade::textdomain()),
				'switch' => true
			),
			array(
				'id' => 'retina_main_logo',
				'type' => 'upload',
				'title' => __('Retina 2x Logo Image', wpgrade::textdomain()),
			),
			array(
				'id' => 'favicon',
				'type' => 'upload',
				'title' => __('Favicon', wpgrade::textdomain()),
				'sub_desc' => __('Upload a 16px x 16px image that will be used as a favicon.', wpgrade::textdomain()),
			),
			array(
				'id' => 'apple_touch_icon',
				'type' => 'upload',
				'title' => __('Apple Touch Icon', wpgrade::textdomain()),
				'sub_desc' => __('You can customize the icon for the Apple touch shortcut to your website. The size of this icon must be 77x77px.', wpgrade::textdomain())
			),
			array(
				'id' => 'metro_icon',
				'type' => 'upload',
				'title' => __('Metro Icon', wpgrade::textdomain()),
				'sub_desc' => __('You can customize the icon for the shortcuts of your website in the Metro interface. The size of this icon must be 144x144px.', wpgrade::textdomain())
			),
			array(
				'id' => 'google_analytics',
				'type' => 'textarea',
				'title' => __('Google Analytics', wpgrade::textdomain()),
				'sub_desc' => __('Paste here your Google Analytics tracking code (or for what matters any tracking code) and we will put it on every page.', wpgrade::textdomain()),
				'desc' => __('', wpgrade::textdomain())
			),
		)
	);


	// Style Options
	// ------------------------------------------------------------------------

	$sections[] = array(
		'icon' => "quote-right",
		'icon_class' => '',
		'title' => __('Style Options', wpgrade::textdomain()),
		'desc' => __('<p class="description">Give some style to your website!</p>', wpgrade::textdomain()),
		'fields' => array(
			array(
				'id' => 'main_color',
				'type' => 'color',
				'title' => __('Main Color', wpgrade::textdomain()),
				'sub_desc' => __('Use the color picker to change the main color of the site to match your brand color.', wpgrade::textdomain()),
				'std' => '#ee3430'
			),
			array(
				'id' => 'use_google_fonts',
				'type' => 'checkbox_hide_below',
				'title' => __('Do you need custom web fonts?', wpgrade::textdomain()),
				'sub_desc' => __('Tap into the massive <a href="http://www.google.com/fonts/">Google Fonts</a> collection (with Live preview).', wpgrade::textdomain()),
				'std' => '0',
				'switch' => true,
				'next_to_hide' => 3
			),
			array(
				'id' => 'google_main_font',
				'type' => 'google_webfonts',
				'title' => __('Main Font', wpgrade::textdomain()),
				'sub_desc' => 'Select a font for the main titles'
			),
			array(
				'id' => 'google_body_font',
				'type' => 'google_webfonts',
				'title' => __('Body Font', wpgrade::textdomain()),
				'sub_desc' => 'Select a font for content and other general areas'
			),
			array(
				'id' => 'google_menu_font',
				'type' => 'google_webfonts',
				'title' => __('Menu Font', wpgrade::textdomain()),
				'sub_desc' => 'Select a font for menu'
			),
			array(
				'id' => 'custom_css',
				'type' => 'textarea',
				'title' => __('Custom CSS Style', wpgrade::textdomain()),
				'sub_desc' => __('Use this area to make slight css changes. It will be included in the head section of the page.', wpgrade::textdomain()),
				'desc' => __('', wpgrade::textdomain()),
				'validate' => 'html'
			),
			array(
				'id' => 'custom_js',
				'type' => 'textarea',
				'title' => __('Custom Javascript', wpgrade::textdomain()),
				'sub_desc' => __('Use this area to make custom javascript calls.This code will be loaded in head section', wpgrade::textdomain()),
				'desc' => __('jQuery is available here.', wpgrade::textdomain()),
				'validate' => 'html'
			),
			array(
				'id' => 'display_custom_css_inline',
				'type' => 'checkbox',
				'title' => __('Display Custom Css Inline', wpgrade::textdomain()),
				'sub_desc' => __('By default '.wpgrade::themename().' saves all custom css settings in a file custom_css.css.php.<br />If your host doesn\'t support the .css.php mimetype you will need to display the custom css inline by turning this setting on.', wpgrade::textdomain()),
				'std' => '0',
				'switch' => true,
			),
		)
	);

	$sections[] = array ('divider' => true,'title' => '' );


	// Sidebar Options
	// ------------------------------------------------------------------------

	$sections[] = array(
		'icon' => 'bookmark',
		'icon_class' => '',
		'title' => __('Sidebar Options', wpgrade::textdomain()),
		'desc' => __('<p class="description">Change sidebar related options from here.</p>', wpgrade::textdomain()),
		'fields' => array(
            array(
                'id' => 'copyright_text',
                'type' => 'editor',
                'title' => __('Copyright Text', wpgrade::textdomain()),
                'sub_desc' => __('Text that will appear in footer left area (eg. Copyright 2013 '. wpgrade::themename() .' All Rights Reserved).', wpgrade::textdomain()),
                'std' => 'Copyright &copy; 2013 '. wpgrade::themename() .' | All rights reserved.',
                'rows' => 4,
            ),
            array(
                'id' => 'do_social_footer_menu',
                'type' => 'checkbox',
                'title' => __('Social Footer Menu', wpgrade::textdomain()),
                'sub_desc' => __('Show social icons in the footer. The links and order are taken from the Social and SEO Options tabs.', wpgrade::textdomain()),
                'std' => '1',
                'switch' => true,
            ),
        )
	);

	$sections[] = array ('divider' => true,'title' => '' );

	// prepare the contact forms  list
	$contact_forms = array();
	$contact_form_field = array();

	// Require plugin.php to use is_plugin_active() below
	include_once ABSPATH.'wp-admin/includes/plugin.php';

	if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
		global $wpdb;
		$cf7 = $wpdb->get_results
			(
				'
					SELECT ID, post_title
					  FROM '.$wpdb->posts.'
					 WHERE post_type = "wpcf7_contact_form"
				'
			);

		$contact_forms = array();
		if ($cf7) {
			foreach ($cf7 as $cform) {
				$contact_forms[$cform->ID] = $cform->post_title;
			}
		}

		$contact_form_field = array(
			'id' => 'contact_form_7',
			'type' => 'select', // create a new type with font preview
			'title' => __('Select Form', wpgrade::textdomain()),
			'sub_desc' => 'Select a contact form previously created with the Contact Form 7 plugin. You can create one <a href="'.admin_url( 'admin.php?page=wpcf7' ).'" title="Contact Form 7">here</a>',
			'options' => $contact_forms
		);
	}
	else { // contact-form-7/wp-contact-form-7.php not active
		$contact_form_field = array(
			'id' => 'contact_form_7_inactive',
			'type' => 'info', // create a new type with font preview
			'title' => __('Notice', wpgrade::textdomain()),
			'desc' => '<p class="description">Contact form 7 is not active. You can install/activate it from <a href="'.admin_url( 'themes.php?page=install-required-plugins' ).'" title="Contact Form 7">here</a></p>',
		);
	}


	// Contact Page
	// ------------------------------------------------------------------------

	$sections[] = array(
		'icon' => "envelope",
		'icon_class' => '',
		'title' => __('Contact Page', wpgrade::textdomain()),
		'desc' => __('<p class="description">General settings for the contact page template!</p>', wpgrade::textdomain()),
		'fields' => array(
            array(
                'id' => 'contact_gmap_link',
                'type' => 'text',
                'title' => __('Google Maps Link', wpgrade::textdomain()),
                'sub_desc' => __('Paste here the the URL that you\'ve got from Google Maps, after navigating to your location.<br />Here it is <a href="http://screenr.com/MjV7" target="_blank">a short movie</a> showing you how to get the URL', wpgrade::textdomain()),
            ),
            array(
                'id' => 'contact_gmap_custom_style',
                'type' => 'checkbox',
                'title' => __('Custom Styling for Map?', wpgrade::textdomain()),
                'sub_desc' => __('Allow us to change the map colors to better match your website.', wpgrade::textdomain()),
                'std' => '1',
                'switch' => true
            )
		)
	);

	$sections[] = array ('divider' => true,'title' => '' );


	// Portfolio Options
	// ------------------------------------------------------------------------

	$sections[] = array(
		'icon' => 'camera',
		'icon_class' => '',
		'title' => __('Portfolio Options', wpgrade::textdomain()),
		'desc' => __('<p class="description">General settings for portfolio items.</p>', wpgrade::textdomain()),
		'fields' => array(
			array(
				'id' => 'portfolio_technical_stuff_info_alert',
				'type' => 'info',
				'desc' => __('<h2>Technical Stuff</h2>', wpgrade::textdomain())
			),
			array(
				'id' => 'portfolio_single_show_share_links',
				'type' => 'checkbox_hide_below',
				'title' => __('Show Share Links', wpgrade::textdomain()),
				'sub_desc' => __('Do you want to show the share links bellow the projects?', wpgrade::textdomain()),
				'std' => '1',
				'switch' => true,
				"next_to_hide" => 3,
			),
			array(
				'id' => 'portfolio_single_share_links_twitter',
				'type' => 'checkbox',
				'title' => __('Twitter Share Link', wpgrade::textdomain()),
				'sub_desc' => '',
				'std' => '1',
				'switch' => true,
			),
			array(
				'id' => 'portfolio_single_share_links_facebook',
				'type' => 'checkbox',
				'title' => __('Facebook Share Link', wpgrade::textdomain()),
				'sub_desc' => '',
				'std' => '1',
				'switch' => true,
			),
			array(
				'id' => 'portfolio_single_share_links_googleplus',
				'type' => 'checkbox',
				'title' => __('Google+ Share Link', wpgrade::textdomain()),
				'sub_desc' => '',
				'std' => '1',
				'switch' => true,
			),
		)
	);


	// Blog Options
	// ------------------------------------------------------------------------

	$sections[] = array(
		'icon' => 'file-alt',
		'icon_class' => '',
		'title' => __('Blog Options', wpgrade::textdomain()),
		'desc' => __('<p class="description">Change blog archive and single post related options here.</p>', wpgrade::textdomain()),
		'fields' => array(
			array(
				'id' => 'blog_excerpt_length',
				'type' => 'text',
				'title' => __('Excerpt Length', wpgrade::textdomain()),
				'sub_desc' => __('Set here the excerpt length for the blog archive (number of words).', wpgrade::textdomain()),
				'std' => '100',
			),
			array(
				'id' => 'blog_single_show_share_links',
				'type' => 'checkbox_hide_below',
				'title' => __('Show Share Links', wpgrade::textdomain()),
				'sub_desc' => __('Do you want to show the share links bellow the article?', wpgrade::textdomain()),
				'std' => '1',
				'switch' => true,
				"next_to_hide" => 3,
			),
			array(
				'id' => 'blog_single_share_links_twitter',
				'type' => 'checkbox',
				'title' => __('Twitter Share Link', wpgrade::textdomain()),
				'sub_desc' => '',
				'std' => '1',
				'switch' => true,
			),
			array(
				'id' => 'blog_single_share_links_facebook',
				'type' => 'checkbox',
				'title' => __('Facebook Share Link', wpgrade::textdomain()),
				'sub_desc' => '',
				'std' => '1',
				'switch' => true,
			),
			array(
				'id' => 'blog_single_share_links_googleplus',
				'type' => 'checkbox',
				'title' => __('Google+ Share Link', wpgrade::textdomain()),
				'sub_desc' => '',
				'std' => '1',
				'switch' => true,
			),
		)
	);


	// Social and SEO options
	// ------------------------------------------------------------------------

	$sections[] = array(
		'icon' => "facebook-sign",
		'icon_class' => '',
		'title' => __('Social and SEO Options', wpgrade::textdomain()),

		'desc' => __('<p class="description">Social sharing stuff.</p>', wpgrade::textdomain()),
		'fields' => array(
            array(
                'id' => 'social_icons',
                'type' => 'text_sortable',
                'title' => __('Social Icons', wpgrade::textdomain()),
                'sub_desc' => __('Define and reorder your social links.<br /><b>Note: </b>These will be displayed in the "'. wpgrade::themename() .' Social Links" widget so you can put them anywhere on your site. Only those filled will appear.', wpgrade::textdomain()),
                'desc' => __('Icons provided by <strong>FontAwesome</strong> and <strong>Entypo</strong>.', wpgrade::textdomain()),
                'options' => array(
                    'twitter' => __('Twitter', wpgrade::textdomain()),
                    'facebook' => __('Facebook', wpgrade::textdomain()),
                    'gplus' => __('Google+', wpgrade::textdomain()),
                    'skype' => __('Skype', wpgrade::textdomain()),
                    'linkedin' => __('LinkedIn', wpgrade::textdomain()),
                    'youtube' => __('Youtube', wpgrade::textdomain()),
                    'vimeo' => __('Vimeo', wpgrade::textdomain()),
                    'instagram' => __('Instagram', wpgrade::textdomain()),
                    'flickr' => __('Flickr', wpgrade::textdomain()),
                    'pinterest' => __('Pinterest', wpgrade::textdomain()),
                    'tumblr' => __('Tumblr', wpgrade::textdomain()),
                    'lastfm' => __('Last.FM', wpgrade::textdomain()),
                    'appnet' => __('App.net', wpgrade::textdomain())
                )
            ),
            array(
                'id' => 'social_icons_target_blank',
                'type' => 'checkbox',
                'title' => __('Open social icons links in new a window?', wpgrade::textdomain()),
                'sub_desc' => __('Do you want to open social links in a new window ?', wpgrade::textdomain()),
                'std' => '1',
                'switch' => true
            ),
			array(
				'id' => 'prepare_for_social_share',
				'type' => 'checkbox_hide_below',
				'title' => __('Add Social Meta Tags', wpgrade::textdomain()),
				'sub_desc' => __('Let us properly prepare your theme for the social sharing and discovery by adding the needed metatags in the <head> section.', wpgrade::textdomain()),
				'std' => '1',
				'switch' => true,
				"next_to_hide" => 4,
			),
			array(
				'id' => 'facebook_id_app',
				'type' => 'text',
				'title' => __('Facebook Application ID', wpgrade::textdomain()),
				'sub_desc' => __('Enter the Facebook Application ID of the Fan Page which is associated with this website. You can create one <a href="https://developers.facebook.com/apps">here</a>.', wpgrade::textdomain()),
			),
			array(
				'id' => 'facebook_admin_id',
				'type' => 'text',
				'title' => __('Facebook Admin ID', wpgrade::textdomain()),
				'sub_desc' => __('The id of the user that has administrative privileges to your Facebook App so you can access the <a href="https://www.facebook.com/insights/">Facebook Insights</a>.', wpgrade::textdomain()),
			),
			array(
				'id' => 'google_page_url',
				'type' => 'text',
				'title' => __('Google+ Publisher', wpgrade::textdomain()),
				'sub_desc' => __('Enter your Google Plus page URL (example: https://plus.google.com/105345678532237339285) here if you have set up a "Google+ Page".', wpgrade::textdomain()),
			),
			array(
				'id' => 'twitter_card_site',
				'type' => 'text',
				'title' => __('Twitter Site Username', wpgrade::textdomain()),
				'sub_desc' => __('The Twitter username of the entire site. The username for the author will be taken from the author\'s profile (skip the @)', wpgrade::textdomain()),
			),
			array(
				'id' => 'social_share_default_image',
				'type' => 'upload',
				'title' => __('Default Social Share Image', wpgrade::textdomain()),
				'sub_desc' => __('If an image is uploaded, this will be used for content sharing if you don\'t upload a custom image with your content (at least 200px wide recommended).', wpgrade::textdomain()),
			),
			array(
				'id' => 'use_twitter_widget',
				'type' => 'checkbox_hide_below',
				'title' => __('Use Twitter Widget', wpgrade::textdomain()),
				'sub_desc' => __('Just a widget to show your latest tweets (Twitter API v1.1 compatible). You can add it in your blog or footer sidebars.<div class="description">', wpgrade::textdomain()),
				'std' => '1',
				'switch' => true,
				"next_to_hide" => 5,
			),
			array(
				'id' => 'info_about_twitter_app',
				'type' => 'info_box',
				'title' => __('Important Note : ', wpgrade::textdomain()),
				'desc' => __('In order to use the Twitter widget you will need to create a Twitter application <a href="https://dev.twitter.com/apps/new" >here</a> and get your own key, secrets and access tokens. This is due to the changes that Twitter made to it\'s API (v1.1). Please note that these defaults are used on the '. wpgrade::themename() .' demo site but they might be disabled at any time, so we <strong>strongly</strong> recommend you to input your own bellow.</div>', wpgrade::textdomain()),
			),
			array(
				'id' => 'twitter_consumer_key',
				'type' => 'text',
				'title' => __('Consumer Key', wpgrade::textdomain()),
				'std' => 'UGciUkPwjDpCRyEqcGsbg'
			),
			array(
				'id' => 'twitter_consumer_secret',
				'type' => 'text',
				'title' => __('Consumer Secret', wpgrade::textdomain()),
				'std' => 'nuHkqRLxKTEIsTHuOjr1XX5YZYetER6HF7pKxkV11E'
			),
			array(
				'id' => 'twitter_oauth_access_token',
				'type' => 'text',
				'title' => __('Oauth Access Token', wpgrade::textdomain()),
				'std' => '205813011-oLyghRwqRNHbZShOimlGKfA6BI4hk3KRBWqlDYIX'
			),
			array(
				'id' => 'twitter_oauth_access_token_secret',
				'type' => 'text',
				'title' => __('Oauth Access Token Secret', wpgrade::textdomain()),
				'std' => '4LqlZjf7jDqmxqXQjc6MyIutHCXPStIa3TvEHX9NEYw'
			),
			array(
				'id' => 'social_seo_social_widget_title',
				'type' => 'info',
				'desc' => __('<h2>Social Icons Widget Settings</h2>', wpgrade::textdomain())
			),
			array(
				'id' => 'social_icons',
				'type' => 'text_sortable',
				'title' => __('Social Icons', wpgrade::textdomain()),
				'sub_desc' => __('Define and reorder your social links.<br /><b>Note: </b>These will be displayed in the "'. wpgrade::themename() .' Social Links" widget so you can put them anywhere on your site. Only those filled will appear.', wpgrade::textdomain()),
				'desc' => __('Icons provided by <strong>FontAwesome</strong> and <strong>Entypo</strong>.', wpgrade::textdomain()),
				'options' => array(
					'twitter' => __('Twitter', wpgrade::textdomain()),
					'facebook' => __('Facebook', wpgrade::textdomain()),
					'gplus' => __('Google+', wpgrade::textdomain()),
					'skype' => __('Skype', wpgrade::textdomain()),
					'linkedin' => __('LinkedIn', wpgrade::textdomain()),
					'youtube' => __('Youtube', wpgrade::textdomain()),
					'vimeo' => __('Vimeo', wpgrade::textdomain()),
					'instagram' => __('Instagram', wpgrade::textdomain()),
					'flickr' => __('Flickr', wpgrade::textdomain()),
					'pinterest' => __('Pinterest', wpgrade::textdomain()),
					'tumblr' => __('Tumblr', wpgrade::textdomain()),
					'lastfm' => __('Last.FM', wpgrade::textdomain()),
					'appnet' => __('App.net', wpgrade::textdomain())
				)
			),
			array(
				'id' => 'social_icons_target_blank',
				'type' => 'checkbox',
				'title' => __('Open social icons links in new a window?', wpgrade::textdomain()),
				'sub_desc' => __('Do you want to open social links in a new window ?', wpgrade::textdomain()),
				'std' => '1',
				'switch' => true
			),
		)
	);


	// Theme Auto Update
	// ------------------------------------------------------------------------

	$sections[] = array(
		'icon' => "cloud-download",
		'icon_class' => '',
		'title' => __('Theme Auto Update', wpgrade::textdomain()),
		'desc' => __('<p class="description">Let us notify you when new versions of this theme are live on ThemeForest! Update with just one button click. Forget about manual updates!</p>', wpgrade::textdomain()),
		'fields' => array(
			array(
				'id' => 'themeforest_upgrade',
				'type' => 'checkbox_hide_below',
				'title' => __('Use Auto Update', wpgrade::textdomain()),
				'sub_desc' => __('Activate this to enter the info needed for the theme auto update to work.', wpgrade::textdomain()),
				'std' => '1',
				'switch' => true,
				"next_to_hide" => 2,
			),
			array(
				'id' => 'marketplace_username',
				'type' => 'text',
				'title' => __('ThemeForest Username', wpgrade::textdomain()),
				'sub_desc' => __('Enter here your ThemeForest (or Envato) username account (i.e. pixelgrade).', wpgrade::textdomain()),
			),
			array(
				'id' => 'marketplace_api_key',
				'type' => 'text',
				'title' => __('ThemeForest Secret API Key', wpgrade::textdomain()),
				'sub_desc' => __('Enter here the secret api key you\'ve created on ThemeForest. You can create a new one in the Settings > API Keys section of your profile.', wpgrade::textdomain()),
			),
		)
	);

	return $sections;
