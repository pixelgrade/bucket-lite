<?php

// ACF Initialisation
if ( wpgrade::option('enable_acf_ui', '0') ) {
	define( 'ACF_LITE', true );
}

if ( in_array( 'advanced-custom-fields/acf.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	add_action('admin_notices', 'wpgrade_warrning_about_acf');
	return;
}
include_once('acf.php');

/**
 *  Install Add-ons
 *
 *  The following code will include all 4 premium Add-Ons in your theme.
 *  Please do not attempt to include a file which does not exist. This will produce an error.
 *
 *  The following code assumes you have a folder 'add-ons' inside your theme.
 *
 *  IMPORTANT
 *  Add-ons may be included in a premium theme/plugin as outlined in the terms and conditions.
 *  For more information, please read:
 *  - http://www.advancedcustomfields.com/terms-conditions/
 *  - http://www.advancedcustomfields.com/resources/getting-started/including-lite-mode-in-a-plugin-theme/
 */

// Add-ons
// include_once('add-ons/acf-repeater/acf-repeater.php');
// include_once('add-ons/acf-gallery/acf-gallery.php');
// include_once('add-ons/acf-flexible-content/acf-flexible-content.php');
// include_once( 'add-ons/acf-options-page/acf-options-page.php' );

/**
 *  Register Field Groups
 *
 *  The register_field_group function accepts 1 array which holds the relevant data to register a field group
 *  You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 */
function acf_load_fields() {
if(function_exists("register_field_group")){
	register_field_group(array (
		'id' => 'acf_credits',
		'title' => 'Credits',
		'fields' => array (
			array (
				'key' => 'field_525fe9c0c3573',
				'label' => __('Credits', wpgrade::textdomain()),
				'name' => 'credits',
				'type' => 'repeater',
				'instructions' => __('Sources, credits, via or other useful links.', wpgrade::textdomain()),
				'sub_fields' => array (
					array (
						'key' => 'field_525fe9e7c3574',
						'label' => __('Name', wpgrade::textdomain()),
						'name' => 'name',
						'type' => 'text',
						'column_width' => 30,
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_525fe9fbc3575',
						'label' => __('Label', wpgrade::textdomain()),
						'name' => 'label',
						'type' => 'text',
						'column_width' => 30,
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_525fea07c3576',
						'label' => __('Full URL', wpgrade::textdomain()),
						'name' => 'full_url',
						'type' => 'text',
						'column_width' => 40,
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'row_min' => 1,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => __('Add New', wpgrade::textdomain()),
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 2,
	));
	register_field_group(array (
		'id' => 'acf_post-review-score',
		'title' => __('Post Review Score', wpgrade::textdomain()),
		'fields' => array (
			array (
				'key' => 'field_525fdc951ec8c',
				'label' => __('Enable Review Score', wpgrade::textdomain()),
				'name' => 'enable_review_score',
				'type' => 'true_false',
				'message' => __('Enable Review Score', wpgrade::textdomain()),
				'default_value' => 0,
			),
			array (
				'key' => 'field_525fdda646878',
				'label' => __('Score Breakdown', wpgrade::textdomain()),
				'name' => 'score_breakdown',
				'type' => 'repeater',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_525fdc951ec8c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'sub_fields' => array (
					array (
						'key' => 'field_525fddc846879',
						'label' => __('Label', wpgrade::textdomain()),
						'name' => 'label',
						'type' => 'text',
						'column_width' => 60,
						'default_value' => '',
						'placeholder' => __('e.g. Features', wpgrade::textdomain()),
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => -1,
					),
					array (
						'key' => 'field_525fddf64687a',
						'label' => __('Score', wpgrade::textdomain()),
						'name' => 'score',
						'type' => 'number',
						'column_width' => 40,
						'default_value' => 7,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => 1,
						'max' => 10,
						'step' => 1,
					),
				),
				'row_min' => 1,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => __('New Score Row', wpgrade::textdomain()),
			),
			array (
				'key' => 'field_525fdfc461de9',
				'label' => __('Average Score Box', wpgrade::textdomain()),
				'name' => '',
				'type' => 'message',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_525fdc951ec8c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => '<strong>'.__('Average Score Box', wpgrade::textdomain()).'</strong>',
			),
			array (
				'key' => 'field_525fdf4b10e33',
				'label' => __('Placement', wpgrade::textdomain()),
				'name' => 'placement',
				'type' => 'select',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_525fdc951ec8c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'choices' => array (
					'before' => __('Before Content', wpgrade::textdomain()),
					'after' => __('After Content', wpgrade::textdomain()),
					'shortcode' => __('Using Shortcode', wpgrade::textdomain()),
				),
				'default_value' => 'before',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_525fe0383d6ea',
				'label' => __('Note', wpgrade::textdomain()),
				'name' => 'note',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_525fdc951ec8c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => __('A short note about the score (optional)', wpgrade::textdomain()),
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_525fe095afe76',
				'label' => __('Enable Pros&Cons Lists', wpgrade::textdomain()),
				'name' => 'enable_pros_cons_lists',
				'type' => 'true_false',
				'instructions' => __('Display a comparison lists with Good and Bad things.', wpgrade::textdomain()),
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_525fdc951ec8c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => __('Enable Pros&Cons Lists', wpgrade::textdomain()),
				'default_value' => 0,
			),
			array (
				'key' => 'field_525fe1051e90c',
				'label' => __('Pros List', wpgrade::textdomain()),
				'name' => 'pros_list',
				'type' => 'repeater',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_525fe095afe76',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'field_525fdc951ec8c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'sub_fields' => array (
					array (
						'key' => 'field_525fe1201e90d',
						'label' => __('Pros Note', wpgrade::textdomain()),
						'name' => 'pros_note',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'row_min' => 1,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => __('Add New', wpgrade::textdomain()),
			),
			array (
				'key' => 'field_525fe1a2c98d6',
				'label' => __('Cons List', wpgrade::textdomain()),
				'name' => 'cons_list',
				'type' => 'repeater',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_525fe095afe76',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'field_525fdc951ec8c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'sub_fields' => array (
					array (
						'key' => 'field_525fe1a2c98d7',
						'label' => __('Cons Note', wpgrade::textdomain()),
						'name' => 'cons_note',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'row_min' => 1,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => __('Add New', wpgrade::textdomain()),
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 4,
	));
	register_field_group(array (
		'id' => 'acf_custom-page-composer',
		'title' => __('Custom Page Composer', wpgrade::textdomain()),
		'fields' => array (
			array (
				'key' => 'field_5260fe06a9724',
				'label' => __('Blocks', wpgrade::textdomain()),
				'name' => 'blocks',
				'type' => 'flexible_content',
				'layouts' => array (
					array (
						'label' => __('Billboard Slider', wpgrade::textdomain()),
						'name' => 'billboard_slider',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_5260ff377fc22',
								'label' => __('Posts Source', wpgrade::textdomain()),
								'name' => 'posts_source',
								'type' => 'select',
								'instructions' => __('Select what type of posts to be displayed.', wpgrade::textdomain()),
								'column_width' => '',
								'choices' => array (
									'featured' => __('Featured Posts', wpgrade::textdomain()),
									'latest' => __('Latest Posts', wpgrade::textdomain()),
									'latest_by_cat' => __('Latest Posts From a Category', wpgrade::textdomain()),
									'latest_by_format' => __('Latest Posts By Post Format', wpgrade::textdomain()),
									'latest_by_reviews' => __('Latest Posts With Reviews', wpgrade::textdomain()),
								),
								'default_value' => 'featured',
								'allow_null' => 0,
								'multiple' => 0,
							),
							array (
								'key' => 'field_52613eb039970',
								'label' => __('Category', wpgrade::textdomain()),
								'name' => 'posts_source_category',
								'type' => 'taxonomy',
								'instructions' => __('Hold down Command key (or CTRL on Windows) to select multiple categories.', wpgrade::textdomain()),
								'column_width' => '',
								'taxonomy' => 'category',
								'field_type' => 'multi_select',
								'allow_null' => 1,
								'load_save_terms' => 0,
								'return_format' => 'id',
								'multiple' => 1,
							),
							array (
								'key' => 'field_526138243996e',
								'label' => __('Post Formats', wpgrade::textdomain()),
								'name' => 'posts_source_post_formats',
								'type' => 'select',
								'instructions' => __('Hold down Command key (or CTRL on Windows) to select multiple post formats.', wpgrade::textdomain()),
								'column_width' => '',
								'choices' => array (
									'standard' => __('Standard', wpgrade::textdomain()),
									'gallery' => __('Gallery', wpgrade::textdomain()),
									'video' => __('Video', wpgrade::textdomain()),
									'audio' => __('Audio', wpgrade::textdomain()),
								),
								'default_value' => 'standard',
								'allow_null' => 1,
								'multiple' => 1,
							),
							array (
								'key' => 'field_5260ffd37fc23',
								'label' => __('Number of Posts', wpgrade::textdomain()),
								'name' => 'number_of_posts',
								'type' => 'number',
								'instructions' => __('Set the maximum number of posts to be displayed (for unlimited number of posts type "-1")', wpgrade::textdomain()),
								'column_width' => '',
								'default_value' => '6',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'min' => '',
								'max' => '',
								'step' => 1,
							),
							array (
								'key' => 'field_526100097fc27',
								'label' => __('Read More Label', wpgrade::textdomain()),
								'name' => 'read_more_label',
								'type' => 'text',
								'instructions' => __('Main Slider Read More Link Text', wpgrade::textdomain()),
								'column_width' => '',
								'default_value' => '',
								'placeholder' => __('Read Full Story', wpgrade::textdomain()),
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_5260ff377fc28',
								'label' => __('Only big articles', wpgrade::textdomain()),
								'name' => 'billboard_only_big_articles',
								'type' => 'true_false',
								'instructions' =>'Display only big articles in the billboard slider, one article per slide. The default is one big article and two smaller ones per slide.',
								'message' => __('', wpgrade::textdomain()),
								'default_value' => 0,
							),												
							array (
								'key' => 'field_5260ff377fc30',
								'label' => __('Slider transition', wpgrade::textdomain()),
								'name' => 'billboard_slider_transition',
								'type' => 'select',
								'instructions' => __('Select the transition between slides.', wpgrade::textdomain()),
								'column_width' => '',
								'choices' => array (
									'fade' => __('Fade', wpgrade::textdomain()),
									'slide' => __('Slide', wpgrade::textdomain())
								),
								'default_value' => 'fade',
								'allow_null' => 0,
								'multiple' => 0,
							),
							array (
								'key' => 'field_5260ff377fc31',
								'label' => __('Slider auto play', wpgrade::textdomain()),
								'name' => 'billboard_slider_autoplay',
								'type' => 'true_false',
								'message' => __('', wpgrade::textdomain()),
								'default_value' => 0,
							),
							array (
								'key' => 'field_5260ff377fc32',
								'label' => __('Delay between slides on autoplay in miliseconds', wpgrade::textdomain()),
								'name' => 'billboard_slider_autoplay_delay',
								'type' => 'number',
								'column_width' => '',
								'default_value' => '3000',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'min' => '',
								'max' => '',
								'step' => 100,
							),																					
						),
					),
					array (
						'label' => __('Posts Grid Cards', wpgrade::textdomain()),
						'name' => 'posts_grid_cards',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_526100057fc25',
								'label' => __('Posts Source', wpgrade::textdomain()),
								'name' => 'posts_source',
								'type' => 'select',
								'instructions' => __('Select what type of posts to be displayed.', wpgrade::textdomain()),
								'column_width' => '',
								'choices' => array (
									'featured' => __('Featured Posts', wpgrade::textdomain()),
									'latest' => __('Latest Posts', wpgrade::textdomain()),
									'latest_by_cat' => __('Latest Posts From a Category', wpgrade::textdomain()),
									'latest_by_format' => __('Latest Posts By Post Format', wpgrade::textdomain()),
									'latest_by_reviews' => __('Latest Posts With Reviews', wpgrade::textdomain()),
								),
								'default_value' => 'featured',
								'allow_null' => 0,
								'multiple' => 0,
							),
							array (
								'key' => 'field_52613ee739972',
								'label' => __('Category', wpgrade::textdomain()),
								'name' => 'posts_source_category',
								'type' => 'taxonomy',
								'instructions' => __('Hold down Command key (or CTRL on Windows) to select multiple categories.', wpgrade::textdomain()),
								'column_width' => '',
								'taxonomy' => 'category',
								'field_type' => 'multi_select',
								'allow_null' => 0,
								'load_save_terms' => 0,
								'return_format' => 'id',
								'multiple' => 1,
							),
							array (
								'key' => 'field_5261412a39975',
								'label' => __('Post Formats', wpgrade::textdomain()),
								'name' => 'posts_source_post_formats',
								'type' => 'select',
								'instructions' => __('Hold down Command key (or CTRL on Windows) to select multiple post formats.', wpgrade::textdomain()),
								'column_width' => '',
								'choices' => array (
									'standard' => __('Standard', wpgrade::textdomain()),
									'gallery' => __('Gallery', wpgrade::textdomain()),
									'video' => __('Video', wpgrade::textdomain()),
									'audio' => __('Audio', wpgrade::textdomain()),
								),
								'default_value' => 'standard',
								'allow_null' => 0,
								'multiple' => 1,
							),
							array (
								'key' => 'field_526100057fc26',
								'label' => __('Number of Posts', wpgrade::textdomain()),
								'name' => 'number_of_posts',
								'type' => 'number',
								'instructions' => __('Set the maximum number of posts to be displayed.', wpgrade::textdomain()),
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'min' => '',
								'max' => '',
								'step' => 1,
							),
						),
					),
					array (
						'label' => __('Hero Posts Module', wpgrade::textdomain()),
						'name' => 'hero_posts_module',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_5261154006647',
								'label' => __('Posts Source', wpgrade::textdomain()),
								'name' => 'posts_source',
								'type' => 'select',
								'instructions' => __('Set the maximum number of posts to be displayed.', wpgrade::textdomain()),
								'column_width' => '',
								'choices' => array (
									'featured' => __('Featured Posts', wpgrade::textdomain()),
									'latest' => __('Latest Posts', wpgrade::textdomain()),
									'latest_by_cat' => __('Latest Posts From a Category', wpgrade::textdomain()),
									'latest_by_format' => __('Latest Posts By Post Format', wpgrade::textdomain()),
									'latest_by_reviews' => __('Latest Posts With Reviews', wpgrade::textdomain()),
								),
								'default_value' => 'featured',
								'allow_null' => 0,
								'multiple' => 0,
							),
							array (
								'key' => 'field_526140db39973',
								'label' => __('Category', wpgrade::textdomain()),
								'name' => 'posts_source_category',
								'type' => 'taxonomy',
								'instructions' => __('Hold down Command key (or CTRL on Windows) to select multiple categories.', wpgrade::textdomain()),
								'column_width' => '',
								'taxonomy' => 'category',
								'field_type' => 'multi_select',
								'allow_null' => 0,
								'load_save_terms' => 0,
								'return_format' => 'id',
								'multiple' => 1,
							),
							array (
								'key' => 'field_5261410239974',
								'label' => __('Post Formats', wpgrade::textdomain()),
								'name' => 'posts_source_post_formats',
								'type' => 'select',
								'instructions' => __('Hold down Command key (or CTRL on Windows) to select multiple post formats.', wpgrade::textdomain()),
								'column_width' => '',
								'choices' => array (
									'standard' => __('Standard', wpgrade::textdomain()),
									'gallery' => __('Gallery', wpgrade::textdomain()),
									'video' => __('Video', wpgrade::textdomain()),
									'audio' => __('Audio', wpgrade::textdomain()),
								),
								'default_value' => 'standard',
								'allow_null' => 0,
								'multiple' => 1,
							),
							array (
								'key' => 'field_5261154006648',
								'label' => __('Number of Posts', wpgrade::textdomain()),
								'name' => 'number_of_posts',
								'type' => 'number',
								'instructions' => __('Set the maximum number of posts to be displayed.', wpgrade::textdomain()),
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'min' => '',
								'max' => '',
								'step' => 1,
							),
						),
					),
					array (
						'label' => 'Latest Posts',
						'name' => 'latest_posts',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_526115980664a',
								'label' => __('Number of Posts', wpgrade::textdomain()),
								'name' => 'number_of_posts',
								'type' => 'number',
								'instructions' => __('Set the maximum number of posts to be displayed.', wpgrade::textdomain()),
								'column_width' => '',
								'default_value' => 10,
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'min' => '',
								'max' => '',
								'step' => 1,
							),
							array (
								'key' => 'field_526115b90664b',
								'label' => __('Posts Format', wpgrade::textdomain()),
								'name' => 'posts_format',
								'type' => 'radio',
								'column_width' => '',
								'choices' => array (
									'masonry' => __('Masonry', wpgrade::textdomain()),
									'classic' => __('Classic', wpgrade::textdomain()),
								),
								'other_choice' => 0,
								'save_other_choice' => 0,
								'default_value' => 'masonry',
								'layout' => 'horizontal',
							),
							array (
								'key' => 'field_526115b90664c',
								'label' => __('Pagination', wpgrade::textdomain()),
								'name' => 'pagination',
								'type' => 'radio',
								'column_width' => '',
								'choices' => array (
									'enable' => __('Enable', wpgrade::textdomain()),
									'disable' => __('Disable', wpgrade::textdomain()),
								),
								'other_choice' => 0,
								'save_other_choice' => 0,
								'default_value' => 'enable',
								'layout' => 'horizontal',
							),
							array (
								'key' => 'field_526115fb0664d',
								'label' => __('Section Title', wpgrade::textdomain()),
								'name' => 'section_title',
								'type' => 'text',
								'column_width' => '',
								'default_value' => __('Latest Articles', wpgrade::textdomain()),
								'placeholder' => __('Latest Articles', wpgrade::textdomain()),
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_5261161a0664e',
								'label' => __('Sidebar', wpgrade::textdomain()),
								'name' => 'sidebar',
								'type' => 'radio',
								'column_width' => '',
								'choices' => array (
									'enable' => __('Enable', wpgrade::textdomain()),
									'disable' => __('Disable', wpgrade::textdomain()),
								),
								'other_choice' => 0,
								'save_other_choice' => 0,
								'default_value' => 'enable',
								'layout' => 'horizontal',
							),
						),
					),
					array (
						'label' => __('Text/Image Block', wpgrade::textdomain()),
						'name' => 'content',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_5261165c0664f',
								'label' => __('Editor', wpgrade::textdomain()),
								'name' => 'content',
								'type' => 'wysiwyg',
								'column_width' => '',
								'default_value' => '',
								'toolbar' => 'full',
								'media_upload' => 'yes',
							),
						),
					),
					array (
						'label' => __('Heading title', wpgrade::textdomain()),
						'name' => 'heading_title',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_5261169206651',
								'label' => __('Title', wpgrade::textdomain()),
								'name' => 'title',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => __('Title', wpgrade::textdomain()),
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_5261169206652',
								'label' => __('Heading link(optional)', 'bucket_txtd'),
								'name' => 'heading_link',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => __('#', 'bucket_txtd'),
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_5261169206653',
								'label' => __('Open link in new tab', 'bucket_txtd'),
								'name' => 'heading_link_new_tab',
								'type' => 'true_false',
								'default_value' => 0,
							),														
						),
					),
				),
				'button_label' => __('Add Block', wpgrade::textdomain()),
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-builder.php',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
	));
}

}
add_action('init', 'acf_load_fields');
add_action('acf/register_fields', 'wpgrade_register_acf_fields');

function wpgrade_register_acf_fields() {
	include_once('add-ons/acf-flexible-content/flexible-content.php');
	include_once('add-ons/acf-repeater/repeater.php');
}