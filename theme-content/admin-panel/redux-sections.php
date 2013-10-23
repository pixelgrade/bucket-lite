<?php

$sections = array();

// General Options
// ------------------------------------------------------------------------

$sections[] = array(
	'icon' => 'cogs',
	'icon_class' => '',
	'title' => __('General Options', wpgrade::textdomain()),
	'desc' => sprintf(__('<p class="description">Welcome to the %s options panel! You can switch between option groups by using the left-hand tabs.</p>', wpgrade::textdomain()),wpgrade::themename()),
	'fields' => array(
		array(
			'id' => 'wpGrade_import_demodata_button',
			'type' => 'info',
//			'raw_html'=>true,
//			'subtitle' => __('Import Demo Data', wpgrade::textdomain()),
			'title' => __('Here you can import the demo data and get on your way of setting up the site like the theme demo.', wpgrade::textdomain()),
			'desc' =>
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
			'id' => 'main_logo',
			'type' => 'media',
			'title' => __('Main Logo', wpgrade::textdomain()),
			'desc' => __('Upload here your logo image (we recommend a height of 80-100px).If there is no image uploaded, plain text will be used instead (generated from the site\'s name).', wpgrade::textdomain()),
		),
		array(
			'id' => 'use_retina_logo',
			'type' => 'switch',
			'title' => __('Retina 2x Logo', wpgrade::textdomain()),
			'desc' => __('To be Retina-ready you need to add a 2x logo image (double the dimensions of the 1x logo above).', wpgrade::textdomain()),
		),
		array(
			'id' => 'retina_main_logo',
			'type' => 'media',
			'title' => __('Retina 2x Logo Image', wpgrade::textdomain()),
			'required' => array('use_retina_logo', '=', 1)
		),
		array(
			'id' => 'favicon',
			'type' => 'media',
			'title' => __('Favicon', wpgrade::textdomain()),
			'desc' => __('Upload a 16px x 16px image that will be used as a favicon.', wpgrade::textdomain()),
		),
		array(
			'id' => 'apple_touch_icon',
			'type' => 'media',
			'title' => __('Apple Touch Icon', wpgrade::textdomain()),
			'desc' => __('You can customize the icon for the Apple touch shortcut to your website. The size of this icon must be 77x77px.', wpgrade::textdomain())
		),
		array(
			'id' => 'metro_icon',
			'type' => 'media',
			'title' => __('Metro Icon', wpgrade::textdomain()),
			'esc' => __('You can customize the icon for the shortcuts of your website in the Metro interface. The size of this icon must be 144x144px.', wpgrade::textdomain())
		),
		array(
			'id' => 'google_analytics',
			'type' => 'textarea',
			'title' => __('Google Analytics', wpgrade::textdomain()),
			'desc' => __('Paste here your Google Analytics tracking code (or for what matters any tracking code) and we will put it on every page.', wpgrade::textdomain()),
			'desc' => __('', wpgrade::textdomain())
		),
	)
);


// Style Options
// ------------------------------------------------------------------------

$sections[] = array(
	'icon' => "quote",
	'icon_class' => '',
	'title' => __('Style Options', wpgrade::textdomain()),
	'desc' => __('<p class="description">Give some style to your website!</p>', wpgrade::textdomain()),
	'fields' => array(
		array(
			'id' => 'main_color',
			'type' => 'color',
			'title' => __('Main Color', wpgrade::textdomain()),
			'subtitle' => __('Use the color picker to change the main color of the site to match your brand color.', wpgrade::textdomain()),
			'default' => '#fffc00',
			'validate' => 'color',
		),
		array(
			'id' => 'use_google_fonts',
			'type' => 'switch',
			'title' => __('Do you need custom web fonts?', wpgrade::textdomain()),
			'subtitle' => __('Tap into the massive <a href="http://www.google.com/fonts/">Google Fonts</a> collection (with Live preview).', wpgrade::textdomain()),
			'default' => '0',
		),
		array(
			'id'=>'google_main_font',
			'type' => 'typography',
			'required' => array('use_google_fonts', '=', 1),
			'title' => __('Main Font', wpgrade::textdomain()),
//				'compiler'=>true,
			'subtitle'=> __('Select a font for the main titles.', wpgrade::textdomain()),
//				'default'=> array(
//					'color'=>"#333",
//					'style'=>'700',
//					'family'=>'Courier, monospace',
//					'size'=> 33,
//					'height'=>'40'
//				),
		),
		array(
			'id' => 'google_body_font',
			'type' => 'typography',
			'required' => array('use_google_fonts', '=', 1),
			'title' => __('Body Font', wpgrade::textdomain()),
			'subtitle' => 'Select a font for content and other general areas',
			'default'=> array(
//					'color'=>"#333",
//					'style'=>'700',
//					'family'=>'Courier, monospace',
//					'size'=> 33,
//					'height'=>'40'
			),
		),
		array(
			'id' => 'google_menu_font',
			'type' => 'typography',
			'required' => array('use_google_fonts', '=', 1),
			'title' => __('Menu Font', wpgrade::textdomain()),
			'subtitle' => 'Select a font for menu',
			'default'=> array(
//					'color'=>"#333",
//					'style'=>'700',
//					'family'=>'Courier, monospace',
//					'size'=> 33,
//					'height'=>'40'
			),
		),
		array(
			'id' => 'custom_css',
			'type' => 'textarea',
			'title' => __('Custom CSS Style', wpgrade::textdomain()),
			'sub_desc' => __('Use this area to make slight CSS changes. It will be included in the head section of the page.', wpgrade::textdomain()),
			'desc' => __('', wpgrade::textdomain()),
			'validate' => 'html'
		),
		array(
			'id' => 'custom_js',
			'type' => 'textarea',
			'title' => __('Custom JavaScript', wpgrade::textdomain()),
			'sub_desc' => __('Use this area to make custom JavaScript calls.This code will be loaded in head section', wpgrade::textdomain()),
			'desc' => __('jQuery is available here as $', wpgrade::textdomain()),
			'validate' => 'html'
		),
		array(
			'id' => 'inject_custom_css',
			'type' => 'select',
			'title' => __('How to inject the custom CSS', wpgrade::textdomain()),
			'subtitle' => sprintf(__('By default %s saves the custom CSS in a file.<br />If for some reason you don\'t have permisions to write a file on your host you should choose the "Inline" option', wpgrade::textdomain()),wpgrade::themename()),
			'default' => 'file',
			'options' => array( 'file' => 'Write To File', 'inline' => 'Inline' ),
		),
	)
);

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
			'sub_desc' => sprintf(__('Text that will appear in footer left area (eg. Copyright 2013 %s | All Rights Reserved).', wpgrade::textdomain()),wpgrade::themename()),
			'std' => 'Copyright &copy; 2013 '. wpgrade::themename() .' | All rights reserved.',
			'rows' => 4,
		),
		array(
			'id' => 'do_social_footer_menu',
//                'type' => 'checkbox_hide_below',
			'type' => 'switch',
			'title' => __('Social Footer Menu', wpgrade::textdomain()),
			'subtitle' => __('Show social icons in the footer. The links and order are taken from the Social and SEO Options tabs.', wpgrade::textdomain()),
			'default' => '1',
			'next_to_hide' => 2,
		),
		array(
			'id' => 'social_footer_menu_title',
			'type' => 'text',
			'title' => __('Social Footer Menu Title', wpgrade::textdomain()),
			'std' => 'We Are Social',
			'subtitle' => __('', wpgrade::textdomain()),
		),
//            array(
//                'id' => 'social_icons',
//                'type' => 'text_sortable',
//                'title' => __('Social Icons', wpgrade::textdomain()),
//                'sub_desc' => sprintf(__('Define and reorder your social links.<br /><b>Note:</b> These will be displayed in the "%s Social Links" widget so you can put them anywhere on your site. Only those filled will appear.', wpgrade::textdomain()),wpgrade::themename()),
//                'desc' => __('Icons provided by <strong>FontAwesome</strong> and <strong>Entypo</strong>.', wpgrade::textdomain()),
//                'options' => array(
//                    'flickr' => __('Flickr', wpgrade::textdomain()),
//                    'tumblr' => __('Tumblr', wpgrade::textdomain()),
//                    'pinterest' => __('Pinterest', wpgrade::textdomain()),
//                    'instagram' => __('Instagram', wpgrade::textdomain()),
//                    'behance' => __('Behance', wpgrade::textdomain()),
//                    'fivehundredpx' => __('500px', wpgrade::textdomain()),
//                    'deviantart' => __('DeviantART', wpgrade::textdomain()),
//                    'dribbble' => __('Dribbble', wpgrade::textdomain()),
//                    'twitter' => __('Twitter', wpgrade::textdomain()),
//                    'facebook' => __('Facebook', wpgrade::textdomain()),
//                    'gplus' => __('Google+', wpgrade::textdomain()),
//                    'youtube' => __('Youtube', wpgrade::textdomain()),
//                    'vimeo' => __('Vimeo', wpgrade::textdomain()),
//                    'linkedin' => __('LinkedIn', wpgrade::textdomain()),
//                    'skype' => __('Skype', wpgrade::textdomain()),
//                    'soundcloud' => __('SoundCloud', wpgrade::textdomain()),
//                    'digg' => __('Digg', wpgrade::textdomain()),
//                    'lastfm' => __('Last.FM', wpgrade::textdomain()),
//                    'appnet' => __('App.net', wpgrade::textdomain())
//                )
//            ),
	)
);

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
			'type' => 'switch',
			'title' => __('Custom Styling for Map?', wpgrade::textdomain()),
			'subtitle' => __('Allow us to change the map colors to better match your website.', wpgrade::textdomain()),
			'default' => '1',
		)
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
			'default' => '100',
		),
		array(
			'id' => 'blog_single_show_share_links',
			'type' => 'switch',
			'title' => __('Show Share Links', wpgrade::textdomain()),
			'sub_desc' => __('Do you want to show the share links bellow the article?', wpgrade::textdomain()),
			'default' => '1',
		),
		array(
			'id' => 'blog_single_share_links_twitter',
			'type' => 'switch',
			'title' => __('Twitter Share Link', wpgrade::textdomain()),
			'subtitle' => '',
			'default' => '1',
			'required' => array('blog_single_show_share_links', '=', 1)
		),
		array(
			'id' => 'blog_single_share_links_facebook',
			'type' => 'switch',
			'title' => __('Facebook Share Link', wpgrade::textdomain()),
			'subtitle' => '',
			'default' => '1',
			'required' => array('blog_single_show_share_links', '=', 1)
		),
		array(
			'id' => 'blog_single_share_links_googleplus',
			'type' => 'switch',
			'title' => __('Google+ Share Link', wpgrade::textdomain()),
			'subtitle' => '',
			'default' => '1',
			'required' => array('blog_single_show_share_links', '=', 1)
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
			'id' => 'social_icons_target_blank',
			'type' => 'switch',
			'title' => __('Open social icons links in new a window?', wpgrade::textdomain()),
			'subtitle' => __('Do you want to open social links in a new window ?', wpgrade::textdomain()),
			'default' => '1',
		),
		array(
			'id' => 'prepare_for_social_share',
			'type' => 'switch',
			'title' => __('Add Social Meta Tags', wpgrade::textdomain()),
			'subtitle' => __('Let us properly prepare your theme for the social sharing and discovery by adding the needed metatags in the <head> section.', wpgrade::textdomain()),
			'default' => '1',
		),
		array(
			'id' => 'facebook_id_app',
			'type' => 'text',
			'title' => __('Facebook Application ID', wpgrade::textdomain()),
			'sub_desc' => __('Enter the Facebook Application ID of the Fan Page which is associated with this website. You can create one <a href="https://developers.facebook.com/apps">here</a>.', wpgrade::textdomain()),
			'required' => array('prepare_for_social_share', '=', 1)
		),
		array(
			'id' => 'facebook_admin_id',
			'type' => 'text',
			'title' => __('Facebook Admin ID', wpgrade::textdomain()),
			'sub_desc' => __('The id of the user that has administrative privileges to your Facebook App so you can access the <a href="https://www.facebook.com/insights/">Facebook Insights</a>.', wpgrade::textdomain()),
			'required' => array('prepare_for_social_share', '=', 1)
		),
		array(
			'id' => 'google_page_url',
			'type' => 'text',
			'title' => __('Google+ Publisher', wpgrade::textdomain()),
			'sub_desc' => __('Enter your Google Plus page ID (example: https://plus.google.com/<b>105345678532237339285</b>) here if you have set up a "Google+ Page".', wpgrade::textdomain()),
			'required' => array('prepare_for_social_share', '=', 1)
		),
		array(
			'id' => 'twitter_card_site',
			'type' => 'text',
			'title' => __('Twitter Site Username', wpgrade::textdomain()),
			'sub_desc' => __('The Twitter username of the entire site. The username for the author will be taken from the author\'s profile (skip the @)', wpgrade::textdomain()),
			'required' => array('prepare_for_social_share', '=', 1)
		),
		array(
			'id' => 'social_share_default_image',
			'type' => 'media',
			'title' => __('Default Social Share Image', wpgrade::textdomain()),
			'desc' => __('If an image is uploaded, this will be used for content sharing if you don\'t upload a custom image with your content (at least 200px wide recommended).', wpgrade::textdomain()),
		),
		array(
			'id' => 'use_twitter_widget',
			'type' => 'switch',
			'title' => __('Use Twitter Widget', wpgrade::textdomain()),
			'sub_desc' => __('Just a widget to show your latest tweets (Twitter API v1.1 compatible). You can add it in your blog or footer sidebars.<div class="description">', wpgrade::textdomain()),
			'default' => '1',
		),
		array(
			'id' => 'info_about_twitter_app',
			'type' => 'info',
			'title' => __('Important Note : ', wpgrade::textdomain()),
			'desc' => __('<div>In order to use the Twitter widget you will need to create a Twitter application <a href="https://dev.twitter.com/apps/new" >here</a> and get your own key, secrets and access tokens. This is due to the changes that Twitter made to it\'s API (v1.1). Please note that these defaults are used on the theme demo site but they might be disabled at any time, so we <strong>strongly</strong> recommend you to input your own bellow.</div>', wpgrade::textdomain()),
			'required' => array('use_twitter_widget', '=', 1)
		),
		array(
			'id' => 'twitter_consumer_key',
			'type' => 'text',
			'title' => __('Consumer Key', wpgrade::textdomain()),
			'default' => 'UGciUkPwjDpCRyEqcGsbg',
			'required' => array('use_twitter_widget', '=', 1)
		),
		array(
			'id' => 'twitter_consumer_secret',
			'type' => 'text',
			'title' => __('Consumer Secret', wpgrade::textdomain()),
			'default' => 'nuHkqRLxKTEIsTHuOjr1XX5YZYetER6HF7pKxkV11E',
			'required' => array('use_twitter_widget', '=', 1)
		),
		array(
			'id' => 'twitter_oauth_access_token',
			'type' => 'text',
			'title' => __('Oauth Access Token', wpgrade::textdomain()),
			'default' => '205813011-oLyghRwqRNHbZShOimlGKfA6BI4hk3KRBWqlDYIX',
			'required' => array('use_twitter_widget', '=', 1)
		),
		array(
			'id' => 'twitter_oauth_access_token_secret',
			'type' => 'text',
			'title' => __('Oauth Access Token Secret', wpgrade::textdomain()),
			'default' => '4LqlZjf7jDqmxqXQjc6MyIutHCXPStIa3TvEHX9NEYw',
			'required' => array('use_twitter_widget', '=', 1)
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
			'type' => 'switch',
			'title' => __('Use Auto Update', wpgrade::textdomain()),
			'sub_desc' => __('Activate this to enter the info needed for the theme auto update to work.', wpgrade::textdomain()),
			'default' => '1',
		),
		array(
			'id' => 'marketplace_username',
			'type' => 'text',
			'title' => __('ThemeForest Username', wpgrade::textdomain()),
			'sub_desc' => __('Enter here your ThemeForest (or Envato) username account (i.e. pixelgrade).', wpgrade::textdomain()),
			'required' => array('themeforest_upgrade', '=', 1)
		),
		array(
			'id' => 'marketplace_api_key',
			'type' => 'text',
			'title' => __('ThemeForest Secret API Key', wpgrade::textdomain()),
			'sub_desc' => __('Enter here the secret api key you\'ve created on ThemeForest. You can create a new one in the Settings > API Keys section of your profile.', wpgrade::textdomain()),
			'required' => array('themeforest_upgrade', '=', 1)
		),
		array(
			'id' => 'themeforest_upgrade_backup',
			'type' => 'switch',
			'title' => __('Backup Theme Before Upgrade?', wpgrade::textdomain()),
			'sub_desc' => __('Check this if you want us to automatically save your theme as a ZIP archive before an upgrade. The directory those backups get saved to is <code>wp-content/envato-backups</code>. However, if you\'re experiencing problems while attempting to upgrade, it\'s likely to be a permissions issue and you may want to manually backup your theme before upgrading. Alternatively, if you don\'t want to backup your theme you can uncheck this.', wpgrade::textdomain()),
			'default' => '0',
			'required' => array('themeforest_upgrade', '=', 1)
		),
	)
);


return $sections;
