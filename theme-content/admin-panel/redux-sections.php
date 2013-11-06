<?php

$sections = array();

// General Options
// ------------------------------------------------------------------------

$sections[] = array(
	'icon' => 'database-1',
	'icon_class' => '',
	'title' => __('General', wpgrade::textdomain()),
	'desc' => sprintf('<p class="description">'.__('General settings contains toggles for various site preferences, including page title formats, third-party tracking services, control commenting settings, and posting defaults. ', wpgrade::textdomain()).'</p>',wpgrade::themename()),
	'fields' => array(
		
		array(
			'id' => 'main_logo',
			'type' => 'media',
			'title' => __('Main Logo', wpgrade::textdomain()),
			'subtitle' => __('If there is no image uploaded, plain text will be used instead (generated from the site\'s name).', wpgrade::textdomain()),
		),
		array(
			'id' => 'use_retina_logo',
			'type' => 'switch',
			'title' => __('Retina 2x Logo', wpgrade::textdomain()),
			'subtitle' => __('To be Retina-ready you need to add a 2x logo image (double the dimensions of the 1x logo above).', wpgrade::textdomain()),
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
			'subtitle' => __('Upload a 16px x 16px image that will be used as a favicon.', wpgrade::textdomain()),
		),
		array(
			'id' => 'apple_touch_icon',
			'type' => 'media',
			'title' => __('Apple Touch Icon', wpgrade::textdomain()),
			'subtitle' => __('You can customize the icon for the Apple touch shortcut to your website. The size of this icon must be 77x77px.', wpgrade::textdomain())
		),
		array(
			'id' => 'metro_icon',
			'type' => 'media',
			'title' => __('Metro Icon', wpgrade::textdomain()),
			'subtitle' => __('The size of this icon must be 144x144px.', wpgrade::textdomain())
		),
		
	)
);


// Style Options
// ------------------------------------------------------------------------

$sections[] = array(
	'icon' => "params",
	'icon_class' => '',
	'title' => __('Style', wpgrade::textdomain()),
	'desc' => '<p class="description">'.__('Style settings contains toggles for various site preferences, including page title formats, third-party tracking services, control commenting settings, and posting defaults. Change fonts, colors and sizes.', wpgrade::textdomain()).'</p>',
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
			'id'=>'typography-21',
			'desc'=> '<h3>'.__('Typography', wpgrade::textdomain()).'</h3>',
			'type' => 'info'
		), 
		array(
			'id' => 'use_google_fonts',
			'type' => 'switch',
			'title' => __('Do you need custom web fonts?', wpgrade::textdomain()),
			'subtitle' => __('Tap into the massive <a href="http://www.google.com/fonts/">Google Fonts</a> collection (with Live preview).', wpgrade::textdomain()),
			'default' => '0',
		),
		// Headings Font
		array(
			'id' => 'google_titles_font',
			'type' => 'typography',
			'color' => false,
			'font-size'=>false,
            'line-height'=>false,
			'required' => array('use_google_fonts', '=', 1),
			'title' => __('Headings Font', wpgrade::textdomain()),
			'subtitle' => __('Font for titles and headings.', wpgrade::textdomain()),
		),
		// Navigation Font
		array(
			'id' => 'google_nav_font',
			'type' => 'typography',
//			'color' => false,
			'font-size'=>false,
            'line-height'=>false,
			'required' => array('use_google_fonts', '=', 1),
			'title' => __('Navigation Font', wpgrade::textdomain()),
			'subtitle' => __('Font for navigation menu.', wpgrade::textdomain()),
		),
		// Body Font
		array(
			'id'=>'google_body_font',
			'type' => 'typography',
			'color' => false,
			'required' => array('use_google_fonts', '=', 1),
			'title' => __('Body Font', wpgrade::textdomain()),
			'subtitle'=> __('Font for content text and widget text.', wpgrade::textdomain()),
		),
	)
);

// Article Options
// ------------------------------------------------------------------------

$sections[] = array(
	'icon' => 'pencil-1',
	'title' => __('Article', wpgrade::textdomain()),
	'desc' => sprintf('<p class="description">'.__('General settings contains toggles for various site preferences, including page title formats, third-party tracking services, control commenting settings, and posting defaults. ', wpgrade::textdomain()).'</p>',wpgrade::themename()),
	'fields' => array(
		array(
			'id' => 'blog_single_show_share_links',
			'type' => 'switch',
			'title' => __('Show Share Links', wpgrade::textdomain()),
			'subtitle' => __('Do you want to show the share links bellow the article?', wpgrade::textdomain()),
			'default' => '1',
		),
		array(
			'id' => 'blog_single_share_links_twitter',
			'type' => 'checkbox',
			'title' => __('Twitter Share Link', wpgrade::textdomain()),
			'desc' => '',
			'default' => '1',
			'required' => array('blog_single_show_share_links', '=', 1)
		),
		array(
			'id' => 'blog_single_share_links_facebook',
			'type' => 'checkbox',
			'title' => __('Facebook Share Link', wpgrade::textdomain()),
			'desc' => '',
			'default' => '1',
			'required' => array('blog_single_show_share_links', '=', 1)
		),
		array(
			'id' => 'blog_single_share_links_googleplus',
			'type' => 'checkbox',
			'title' => __('Google+ Share Link', wpgrade::textdomain()),
			'desc' => '',
			'default' => '1',
			'required' => array('blog_single_show_share_links', '=', 1)
		),
				array(
			'id'=>'article-21',
			'desc'=> __('<h3>Blog Archive</h3>', wpgrade::textdomain()),
			'type' => 'info'
		), 
		array(
			'id' => 'blog_excerpt_length',
			'type' => 'text',
			'title' => __('Excerpt Length', wpgrade::textdomain()),
			'subtitle' => __('Set the number of words for posts excerpt.', wpgrade::textdomain()),
			'default' => '20',
		),
		array(
			'id' => 'blog_excerpt_more_text',
			'type' => 'text',
			'title' => __('Excerpt "More" Text', wpgrade::textdomain()),
			'subtitle' => __('Change the default [...] with something else (leave empty if you want to remove it).', wpgrade::textdomain()),
			'default' => '..',
		),
	)
);

// Header Options
// ------------------------------------------------------------------------

$sections[] = array(
	'icon' => 'note-1',
	'title' => __('Header', wpgrade::textdomain()),
	'desc' => '<p class="description">'.__('Change footer related options from here.', wpgrade::textdomain()).'</p>',
	'fields' => array(
		array(
			'id' => 'header_type',
			'type' => 'image_select',
			'title' => __('Header Type', wpgrade::textdomain()),
			'subtitle' => __('Choose the layout for the header area.', wpgrade::textdomain()),
			'default' => 'type1',
			'options' => array(
				'type1' => array('Type 1', 'img' => wpgrade::resourceuri('images/header-type1.png')),
				'type2' => array('Type 2', 'img' => wpgrade::resourceuri('images/header-type2.png')),
				'type3' => array('Type 3', 'img' => wpgrade::resourceuri('images/header-type3.png')),
			)
		),
		array(
			'id' => 'header_728_90_ad',
			'type' => 'ace_editor',
			'title' => __('Header Ad Code', wpgrade::textdomain()),
			'subtitle' => __('Paste here the code for the header ad (optimally 720x90px). We will also parse any shortcodes present.', wpgrade::textdomain()),
//			'required' => array('header_type', '', 'type2'),
			'default' => '<a class="header-ad-link" href="#"><img src="http://placehold.it/728x90" alt="#" /></a>',
			'mode' => 'html',
			'theme' => 'chrome',
		),
		array(
			'id' => 'nav_inverse_top',
			'type' => 'switch',
			'title' => __('Header Top Nav Inverse', wpgrade::textdomain()),
			'subtitle' => __('Inverse the contrast of the header top navigation bar (black text on white background).', wpgrade::textdomain()),
			'default' => '0'
		),
		array(
			'id' => 'nav_inverse_main',
			'type' => 'switch',
			'title' => __('Header Main Nav Inverse', wpgrade::textdomain()),
			'subtitle' => __('Inverse the contrast of the main navigation bar including sub-menus and mega-menus (black text on white background).', wpgrade::textdomain()),
			'default' => '0'
		),
		array(
			'id' => 'nav_show_header_search',
			'type' => 'switch',
			'title' =>  __('Show Header Search Form', wpgrade::textdomain()),
			'subtitle' => __('Display the search form in the header (it\'s position may vary depending the Header Type).', wpgrade::textdomain()),
			'default' => '1'
		),
	)
);

// Footer Options
// ------------------------------------------------------------------------

$sections[] = array(
	'icon' => 'tag-1',
	'title' => __('Footer', wpgrade::textdomain()),
	'desc' => '<p class="description">'.__('Change footer related options from here.', wpgrade::textdomain()).'</p>',
	'fields' => array(
		array(
			'id' => 'copyright_text',
			'type' => 'editor',
			'title' => __('Copyright Text', wpgrade::textdomain()),
			'subtitle' => sprintf(__('Text that will appear in footer left area (eg. Copyright 2013 %s | All Rights Reserved).', wpgrade::textdomain()),wpgrade::themename()),
			'default' => 'Copyright &copy; 2013 '. wpgrade::themename() .' | All rights reserved.',
			'rows' => 3,
		),
	)
);

$sections[] = array(
    'type' => 'divide',
);


// Social and SEO options
// ------------------------------------------------------------------------

$sections[] = array(
	'icon' => "thumbs-up-1",
	'icon_class' => '',
	'title' => __('Social and SEO', wpgrade::textdomain()),

	'desc' => '<p class="description">'.__('Social sharing stuff.', wpgrade::textdomain()).'</p>',
	'fields' => array(
        array(
            'id' => 'social_icons',
            'type' => 'text_sortable',
            'title' => __('Social Icons', wpgrade::textdomain()),
            'subtitle' => sprintf(__('Define and reorder your social links.<br /><b>Note:</b> These will be displayed in the "%s Social Links" widget so you can put them anywhere on your site. Only those filled will appear.<br /><br /><strong> You need to imput the entire URL (ie. http://twitter.com/username)</strong>', wpgrade::textdomain()),wpgrade::themename()),
            'desc' => __('Icons provided by <strong>FontAwesome</strong> and <strong>Entypo</strong>.', wpgrade::textdomain()),
			'checkboxes' => array(
				'widget'=> __('Widget', wpgrade::textdomain()),
				'header'=> __('Header', wpgrade::textdomain())
			),
            'options' => array(
                'flickr' => __('Flickr', wpgrade::textdomain()),
                'tumblr' => __('Tumblr', wpgrade::textdomain()),
                'pinterest' => __('Pinterest', wpgrade::textdomain()),
                'instagram' => __('Instagram', wpgrade::textdomain()),
                'behance' => __('Behance', wpgrade::textdomain()),
                'fivehundredpx' => __('500px', wpgrade::textdomain()),
                'deviantart' => __('DeviantART', wpgrade::textdomain()),
                'dribbble' => __('Dribbble', wpgrade::textdomain()),
                'twitter' => __('Twitter', wpgrade::textdomain()),
                'facebook' => __('Facebook', wpgrade::textdomain()),
                'gplus' => __('Google+', wpgrade::textdomain()),
                'youtube' => __('Youtube', wpgrade::textdomain()),
                'vimeo' => __('Vimeo', wpgrade::textdomain()),
                'linkedin' => __('LinkedIn', wpgrade::textdomain()),
                'skype' => __('Skype', wpgrade::textdomain()),
                'soundcloud' => __('SoundCloud', wpgrade::textdomain()),
                'digg' => __('Digg', wpgrade::textdomain()),
                'lastfm' => __('Last.FM', wpgrade::textdomain()),
                'appnet' => __('App.net', wpgrade::textdomain()),
                'rss' => __('RSS Feed', wpgrade::textdomain()),
            )
        ),

//		array(
//			'id'=>"social_icons",
//			'type' => 'group',//doesnt need to be called for callback fields
//			'title' => __('Social Icons', wpgrade::textdomain()),
//			'subtitle' => __('Group any items together.', wpgrade::textdomain()),
//			'desc' => __('No limit as to what you can group. Just don\'t try to group a group.', wpgrade::textdomain()),
//			'groupname' => __('Social Icon', wpgrade::textdomain()), // Group name
//			'subfields' => array(
//				array(
//					'id'=>'social_icons_name',
//					'type' => 'text',
//					'title' => __('Social Icon Name', wpgrade::textdomain()),
//					'subtitle'=> __('This will apear as alt text on icon', wpgrade::textdomain()),
//				),
//				array(
//					'id'=>'social_icons_url',
//					'type' => 'text',
//					'title' => __('Link', wpgrade::textdomain()),
//					'subtitle' => __('Here you put your subtitle', wpgrade::textdomain()),
//				),
//				array(
//					'id' => 'social_icons_image_type',
//					'type' => 'image_select',
//					'title' => __('Icon Type', wpgrade::textdomain()),
//					'options' => array(
//						'image' => array( __('Image', wpgrade::textdomain() ), 'img' => 'images/align-right.png' ),
//						'font-awesome'=> array( __('Font Awesome', wpgrade::textdomain()), 'img' => 'images/align-left.png' )
//					),
//					'default' => 'image',
//				),
//				array(
//					'id'=>'social_icons_image',
//					'type' => 'media',
//					'title' => __('Image', wpgrade::textdomain()),
//					'subtitle' => __('Upload the image.', wpgrade::textdomain()),
//					'required' => array('social_icons_image_type', '=', 'image'),
//				),
//				array(
//					'id'=>'social_icons_font_awesome',
//					'type' => 'text',
//					'title' => __('Icon Name', wpgrade::textdomain()),
//					'subtitle' => __('Here you can write a font-awesome class name (e.g. fa-facebook).', wpgrade::textdomain()),
//					'required' => array('social_icons_image_type', '=', 'font-awesome'),
//				),
//			),
//		),

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
			'subtitle' => __('Enter the Facebook Application ID of the Fan Page which is associated with this website. You can create one <a href="https://developers.facebook.com/apps">here</a>.', wpgrade::textdomain()),
			'required' => array('prepare_for_social_share', '=', 1)
		),
		array(
			'id' => 'facebook_admin_id',
			'type' => 'text',
			'title' => __('Facebook Admin ID', wpgrade::textdomain()),
			'subtitle' => __('The id of the user that has administrative privileges to your Facebook App so you can access the <a href="https://www.facebook.com/insights/">Facebook Insights</a>.', wpgrade::textdomain()),
			'required' => array('prepare_for_social_share', '=', 1)
		),
		array(
			'id' => 'google_page_url',
			'type' => 'text',
			'title' => __('Google+ Publisher', wpgrade::textdomain()),
			'subtitle' => __('Enter your Google Plus page ID (example: https://plus.google.com/<b>105345678532237339285</b>) here if you have set up a "Google+ Page".', wpgrade::textdomain()),
			'required' => array('prepare_for_social_share', '=', 1)
		),
		array(
			'id' => 'twitter_card_site',
			'type' => 'text',
			'title' => __('Twitter Site Username', wpgrade::textdomain()),
			'subtitle' => __('The Twitter username of the entire site. The username for the author will be taken from the author\'s profile (skip the @)', wpgrade::textdomain()),
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
			'subtitle' => __('Just a widget to show your latest tweets (Twitter API v1.1 compatible). You can add it in your blog or footer sidebars.<div class="description">', wpgrade::textdomain()),
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

// Custom Code
// ------------------------------------------------------------------------

$sections[] = array(
	'icon' => "database-1",
	'icon_class' => '',
	'title' => __('Custom Code', wpgrade::textdomain()),
	'desc' => '<p class="description">'.__('You can change the site style and behaviour by adding custom scripts to all pages within your site using the custom code areas below.', wpgrade::textdomain()).'</p>',
	'fields' => array(
		array(
			'id' => 'custom_css',
			'type' => 'ace_editor',
			'title' => __('Custom CSS', wpgrade::textdomain()),
			'subtitle' => __('Enter your custom CSS code. It will be included in the head section of the page.', wpgrade::textdomain()),
			'desc' => __('', wpgrade::textdomain()),
			'mode' => 'css',
			'theme' => 'chrome',
			'validate' => 'html'
		),
		array(
			'id' => 'inject_custom_css',
			'type' => 'select',
			'title' => __('Apply Custom CSS', wpgrade::textdomain()),
			'subtitle' => sprintf(__('Select how to insert the custom CSS into your site.', wpgrade::textdomain()),wpgrade::themename()),
			'default' => 'inline',
			'options' => array( 'inline' => 'Inline <em>(recommended)</em>', 'file' => 'Write To File (might require file permissions)'),
			'select2' => array( // here you can provide params for the select2 jquery call
			    'minimumResultsForSearch' => -1, // this way the search box will be disabled
				'allowClear' => false // don't allow a empty select
			)
		),
		array(
			'id' => 'custom_js',
			'type' => 'ace_editor',
			'title' => __('Custom JavaScript (header)', wpgrade::textdomain()),
			'subtitle' => __('Enter your custom Javascript code. This code will be loaded in the head section', wpgrade::textdomain()),
			'mode' => 'javascript',
			'theme' => 'chrome'
		),
		array(
			'id' => 'custom_js_footer',
			'type' => 'ace_editor',
			'title' => __('Custom JavaScript (footer)', wpgrade::textdomain()),
			'subtitle' => __('This javascript code will be loaded in the footer. You can paste here your <strong>Google Analytics tracking code</strong> (or for what matters any tracking code) and we will put it on every page.', wpgrade::textdomain()),
			'mode' => 'javascript',
			'theme' => 'chrome'
		),
	)
);

// Utilities - Theme Auto Update + Import Demo Data
// ------------------------------------------------------------------------

$sections[] = array(
	'icon' => "truck",
	'icon_class' => '',
	'title' => __('Utilities', wpgrade::textdomain()),
	'desc' => '<p class="description">'.__('Let us notify you when new versions of this theme are live on ThemeForest! Update with just one button click. Forget about manual updates!', wpgrade::textdomain()).'</p>',
	'fields' => array(
		array(
			'id'=>'typography-21',
			'desc'=> __('<h3>Theme Auto Update</h3>
				<p class="description">'.__('Let us notify you when new versions of this theme are live on ThemeForest! Update with just one button click. Forget about manual updates!', wpgrade::textdomain()).'</p>', wpgrade::textdomain()),
			'type' => 'info'
		), 
		array(
			'id' => 'themeforest_upgrade',
			'type' => 'switch',
			'title' => __('Use Auto Update', wpgrade::textdomain()),
			'subtitle' => __('Activate this to enter the info needed for the theme auto update to work.', wpgrade::textdomain()),
			'default' => '1',
		),
		array(
			'id' => 'marketplace_username',
			'type' => 'text',
			'title' => __('ThemeForest Username', wpgrade::textdomain()),
			'subtitle' => __('Enter here your ThemeForest (or Envato) username account (i.e. pixelgrade).', wpgrade::textdomain()),
			'required' => array('themeforest_upgrade', '=', 1)
		),
		array(
			'id' => 'marketplace_api_key',
			'type' => 'text',
			'title' => __('ThemeForest Secret API Key', wpgrade::textdomain()),
			'subtitle' => __('Enter here the secret api key you\'ve created on ThemeForest. You can create a new one in the Settings > API Keys section of your profile.', wpgrade::textdomain()),
			'required' => array('themeforest_upgrade', '=', 1)
		),
		array(
			'id' => 'themeforest_upgrade_backup',
			'type' => 'switch',
			'title' => __('Backup Theme Before Upgrade?', wpgrade::textdomain()),
			'subtitle' => __('Check this if you want us to automatically save your theme as a ZIP archive before an upgrade. The directory those backups get saved to is <code>wp-content/envato-backups</code>. However, if you\'re experiencing problems while attempting to upgrade, it\'s likely to be a permissions issue and you may want to manually backup your theme before upgrading. Alternatively, if you don\'t want to backup your theme you can uncheck this.', wpgrade::textdomain()),
			'default' => '0',
			'required' => array('themeforest_upgrade', '=', 1)
		),
		array(
			'id'=>'typography-21',
			'desc'=> __('<h3>Import Demo Data</h3>
				<p class="description">'.__('Here you can import the demo data and get on your way of setting up the site like the theme demo.', wpgrade::textdomain()).'</p>', wpgrade::textdomain()),
			'type' => 'info'
		), 
		array(
			'id' => 'wpGrade_import_demodata_button',
			'type' => 'info',
			'desc' =>
			'
				<input type="hidden" name="wpGrade-nonce-import-posts-pages" value="'.wp_create_nonce ('wpGrade_nonce_import_demo_posts_pages').'" />
						<input type="hidden" name="wpGrade-nonce-import-theme-options" value="'.wp_create_nonce ('wpGrade_nonce_import_demo_theme_options').'" />
						<input type="hidden" name="wpGrade-nonce-import-widgets" value="'.wp_create_nonce ('wpGrade_nonce_import_demo_widgets').'" />
						<input type="hidden" name="wpGrade_import_ajax_url" value="'.admin_url("admin-ajax.php").'" />

						<a href="#" class="button button-primary" id="wpGrade_import_demodata_button">
							'.__('Import demo data', wpgrade::textdomain()).'
						</a>

						<div class="wpGrade-loading-wrap hidden">
							<span class="wpGrade-loading wpGrade-import-loading"></span>
							<div class="wpGrade-import-wait">
								'.__('Please wait a few minutes (between 2 and 5 minutes usually, but depending on your hosting it can take longer) and <strong>don\'t reload the page</strong>. You will be notified as soon as the import has finished!', wpgrade::textdomain()).'
							</div>
						</div>

						<div class="wpGrade-import-results hidden"></div>
					',
		),
	)
);


// Help and Support
// ------------------------------------------------------------------------

$sections[] = array(
	'icon' => "cd-1",
	'icon_class' => '',
	'title' => __('Help and Support', wpgrade::textdomain()),
	'desc' => '<p class="description">'.__('If you had anything less than a great experience with this theme please contact us now. You can also find answers in our community site, or official articles and tutorials in our knowledge base.', wpgrade::textdomain()).'</p>',
	'fields' => array(
		
	)
);


return $sections;
