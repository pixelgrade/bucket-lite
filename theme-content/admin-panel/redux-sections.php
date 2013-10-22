<?php

$sections = array();


$sections[] = array(
	'title' => __('Home Settings', 'redux-framework'),
	'header' => __('Welcome to the Simple Options Framework Demo', 'redux-framework'),
	'desc' => __('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'redux-framework'),
	'icon_class' => 'icon-large',
	'icon' => 'home',
	'fields' => array(

		array(
			'id'=>'media',
			'type' => 'media',
			'url'=> true,
			'title' => __('Media w/ URL', 'redux-framework'),
			'compiler' => 'true',
			'desc'=> __('Basic media uploader with disabled URL input field.', 'redux-framework'),
			'subtitle' => __('Upload any media using the Wordpress native uploader', 'redux-framework'),
		),

		array(
			'id'=>'media-nourl',
			'type' => 'media',
			'title' => __('Media w/o URL', 'redux-framework'),
			'desc'=> __('This represents the minimalistic view. It does not have the preview box or the display URL in an input box. ', 'redux-framework'),
			'subtitle' => __('Upload any media using the Wordpress native uploader', 'redux-framework'),
		),
		array(
			'id'=>'media-nopreview',
			'type' => 'media',
			'preview'=> false,
			'title' => __('Media No Preview', 'redux-framework'),
			'desc'=> __('This represents the minimalistic view. It does not have the preview box or the display URL in an input box. ', 'redux-framework'),
			'subtitle' => __('Upload any media using the Wordpress native uploader', 'redux-framework'),
		),
		array(
			'id' => 'gallery',
			'type' => 'gallery',
			'title' => __('Add/Edit Gallery', 'so-panels'),
			'subtitle' => __('Create a new Gallery by selecting existing or uploading new images using the Wordpress native uploader', 'so-panels'),
			'desc' => __('This is the description field, again good for additional info.', 'redux-framework'),
		),
		array(
			'id'=>'slider1',
			'type' => 'slider',
			'title' => __('JQuery UI Slider Example 1', 'redux-framework'),
			'desc'=> __('JQuery UI slider description. Min: 1, max: 500, step: 3, default value: 45', 'redux-framework'),
			"default" 		=> "45",
			"min" 		=> "1",
			"step"		=> "3",
			"max" 		=> "500",
		),

		array(
			'id'=>'slider2',
			'type' => 'slider',
			'title' => __('JQuery UI Slider Example 2 w/ Steps (5)', 'redux-framework'),
			'desc'=> __('JQuery UI slider description. Min: 0, max: 300, step: 5, default value: 75', 'redux-framework'),
			"default" 		=> "75",
			"min" 		=> "0",
			"step"		=> "5",
			"max" 		=> "300",
		),
		array(
			'id'=>'spinner1',
			'type' => 'spinner',
			'title' => __('JQuery UI Spinner Example 1', 'redux-framework'),
			'desc'=> __('JQuery UI spinner description. Min:20, max: 100, step:20, default value: 40', 'redux-framework'),
			"default" 	=> "40",
			"min" 		=> "20",
			"step"		=> "20",
			"max" 		=> "100",
		),
		array(
			'id'=>'switch-on',
			'type' => 'switch',
			'title' => __('Switch On', 'redux-framework'),
			'subtitle'=> __('Look, it\'s on!', 'redux-framework'),
			"default" 		=> 1,
		),

		array(
			'id'=>'switch-off',
			'type' => 'switch',
			'title' => __('Switch Off', 'redux-framework'),
			'subtitle'=> __('Look, it\'s on!', 'redux-framework'),
			"default" 		=> 0,
		),

		array(
			'id'=>'switch-custom',
			'type' => 'switch',
			'title' => __('Switch - Custom Titles', 'redux-framework'),
			'subtitle'=> __('Look, it\'s on! Also hidden child elements!', 'redux-framework'),
			"default" 		=> 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
		),

		array(
			'id'=>'switch-fold',
			'type' => 'switch',
			'required' => array('switch-custom','=','1'),
			'title' => __('Switch - With Hidden Items (NESTED!)', 'redux-framework'),
			'subtitle'=> __('Also called a "fold" parent.', 'redux-framework'),
			'desc' => __('Items set with a fold to this ID will hide unless this is set to the appropriate value.', 'redux-framework'),
			'default' => 0,
		),
		array(
			'id'=>'patterns',
			'type' => 'image_select',
			'tiles' => true,
			'required' => array('switch-fold','equals','0'),
			'title' => __('Images Option (with pattern=>true)', 'redux-framework'),
			'subtitle'=> __('Select a background pattern.', 'redux-framework'),
			'default' 		=> 0,
			'options' => $sample_patterns
		,
		),
		array(
			"id" => "homepage_blocks",
			"type" => "sorter",
			"title" => "Homepage Layout Manager",
			"desc" => "Organize how you want the layout to appear on the homepage",
			"compiler"=>'true',
			'required' => array('switch-fold','equals','0'),
			'options' => array(
				"enabled" => array(
					"placebo" => "placebo", //REQUIRED!
					"highlights" => "Highlights",
					"slider" => "Slider",
					"staticpage" => "Static Page",
					"services" => "Services"
				),
				"disabled" => array(
					"placebo" => "placebo", //REQUIRED!
				)
			),
		),
		array(
			'id'=>'slides',
			'type' => 'slides',
			'title' => __('Slides Options', 'redux-framework'),
			'subtitle'=> __('Unlimited slides with drag and drop sortings.', 'redux-framework'),
			'desc' => __('This field will store all slides values into a multidimensional array to use into a foreach loop.', 'redux-framework')
		),
		array(
			'id'=>'presets',
			'type' => 'image_select',
			'presets' => true,
			'title' => __('Preset', 'redux-framework'),
			'subtitle'=> __('This allows you to set a json string or array to override multiple preferences in your theme.', 'redux-framework'),
			'default' 		=> 0,
			'desc'=> __('This allows you to set a json string or array to override multiple preferences in your theme.', 'redux-framework'),
			'options' => array(
				'1' => array('alt' => 'Preset 1', 'img' => REDUX_URL.'../sample/presets/preset1.png', 'presets'=>array('switch-on'=>1,'switch-off'=>1, 'switch-custom'=>1)),
				'2' => array('alt' => 'Preset 2', 'img' => REDUX_URL.'../sample/presets/preset2.png', 'presets'=>'{"slider1":"1", "slider2":"0", "switch-on":"0"}'),
			),
		),
		array(
			'id'=>'typography6',
			'type' => 'typography',
			'title' => __('Typography', 'redux-framework'),
			//'compiler'=>true, // Use if you want to hook in your own CSS compiler
			'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup'=>true, // Select a backup non-google font in addition to a google font
			//'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
			//'subsets'=>false, // Only appears if google is true and subsets not set to false
			//'font-size'=>false,
			//'line-height'=>false,
			//'word-spacing'=>true, // Defaults to false
			//'letter-spacing'=>true, // Defaults to false
			//'color'=>false,
			//'preview'=>false, // Disable the previewer
			'output' => array('h2.site-description'), // An array of CSS selectors to apply this font style to dynamically
			'units'=>'px', // Defaults to px
			'subtitle'=> __('Typography option with each property can be called individually.', 'redux-framework'),
			'default'=> array(
				'color'=>"#333",
				'font-style'=>'700',
				'font-family'=>'Courier, monospace',
				'font-size'=>'33px',
				'line-height'=>'40'),
		),
	),
);



$sections[] = array(
	'type' => 'divide',
);



$sections[] = array(
	'icon' => 'cogs',
	'icon_class' => 'icon-large',
	'title' => __('General Settings', 'redux-framework'),
	'fields' => array(
		array(
			'id'=>'layout',
			'type' => 'image_select',
			'compiler'=>true,
			'title' => __('Main Layout', 'redux-framework'),
			'subtitle' => __('Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.', 'redux-framework'),
			'options' => array(
				'1' => array('alt' => '1 Column', 'img' => REDUX_URL.'assets/img/1col.png'),
				'2' => array('alt' => '2 Column Left', 'img' => REDUX_URL.'assets/img/2cl.png'),
				'3' => array('alt' => '2 Column Right', 'img' => REDUX_URL.'assets/img/2cr.png'),
				'4' => array('alt' => '3 Column Middle', 'img' => REDUX_URL.'assets/img/3cm.png'),
				'5' => array('alt' => '3 Column Left', 'img' => REDUX_URL.'assets/img/3cl.png'),
				'6' => array('alt' => '3 Column Right', 'img' => REDUX_URL.'assets/img/3cr.png')
			),
			'default' => '2'
		),

		array(
			'id'=>'tracking-code',
			'type' => 'textarea',
			'required' => array('layout','equals','1'),
			'title' => __('Tracking Code', 'redux-framework'),
			'subtitle' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'redux-framework'),
			'validate' => 'js',
			'desc' => 'Validate that it\'s javascript!',
		),

		array(
			'id'=>'footer-text',
			'type' => 'editor',
			'title' => __('Footer Text', 'redux-framework'),
			'subtitle' => __('You can use the following shortcodes in your footer text: [wp-url] [site-url] [theme-url] [login-url] [logout-url] [site-title] [site-tagline] [current-year]', 'redux-framework'),
			'default' => 'Powered by [wp-url]. Built on the [theme-url].',
		),

	)
);

return $sections;