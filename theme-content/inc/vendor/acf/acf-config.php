<?php

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

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_credits',
		'title' => 'Credits',
		'fields' => array (
			array (
				'key' => 'field_525fe9c0c3573',
				'label' => __('Credits', 'acf-txt'),
				'name' => 'credits',
				'type' => 'repeater',
				'instructions' => __('Sources, credits, via or other useful links.', 'acf-txt'),
				'sub_fields' => array (
					array (
						'key' => 'field_525fe9e7c3574',
						'label' => __('Name', 'acf-txt'),
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
						'label' => __('Label', 'acf-txt'),
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
						'label' => __('Full URL', 'acf-txt'),
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
				'button_label' => __('Add New', 'acf-txt'),
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
		'title' => __('Post Review Score', 'acf-txt'),
		'fields' => array (
			array (
				'key' => 'field_525fdc951ec8c',
				'label' => __('Enable Review Score', 'acf-txt'),
				'name' => 'enable_review_score',
				'type' => 'true_false',
				'message' => __('Enable Review Score', 'acf-txt'),
				'default_value' => 0,
			),
			array (
				'key' => 'field_525fdda646878',
				'label' => __('Score Breakdown', 'acf-txt'),
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
						'label' => __('Label', 'acf-txt'),
						'name' => 'label',
						'type' => 'text',
						'column_width' => 60,
						'default_value' => '',
						'placeholder' => __('e.g. Features', 'acf-txt'),
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => -1,
					),
					array (
						'key' => 'field_525fddf64687a',
						'label' => __('Score', 'acf-txt'),
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
				'button_label' => __('New Score Row', 'acf-txt'),
			),
			array (
				'key' => 'field_525fdfc461de9',
				'label' => __('Average Score Box', 'acf-txt'),
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
				'message' => '<strong>'.__('Average Score Box', 'acf-txt').'</strong>',
			),
			array (
				'key' => 'field_525fdf4b10e33',
				'label' => __('Placement', 'acf-txt'),
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
					'before' => __('Before Content', 'acf-txt'),
					'after' => __('After Content', 'acf-txt'),
					'shortcode' => __('Using Shortcode', 'acf-txt'),
				),
				'default_value' => 'before',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_525fe0383d6ea',
				'label' => __('Note', 'acf-txt'),
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
				'placeholder' => __('A short note about the score (optional)', 'acf-txt'),
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_525fe095afe76',
				'label' => __('Enable Pros&Cons Lists', 'acf-txt'),
				'name' => 'enable_pros_cons_lists',
				'type' => 'true_false',
				'instructions' => __('Display a comparison lists with Good and Bad things.', 'acf-txt'),
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
				'message' => __('Enable Pros&Cons Lists', 'acf-txt'),
				'default_value' => 0,
			),
			array (
				'key' => 'field_525fe1051e90c',
				'label' => __('Pros List', 'acf-txt'),
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
						'label' => __('Pros Note', 'acf-txt'),
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
				'button_label' => __('Add New', 'acf-txt'),
			),
			array (
				'key' => 'field_525fe1a2c98d6',
				'label' => __('Cons List', 'acf-txt'),
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
						'label' => __('Cons Note', 'acf-txt'),
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
				'button_label' => __('Add New', 'acf-txt'),
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
		'title' => __('Custom Page Composer', 'acf-txt'),
		'fields' => array (
			array (
				'key' => 'field_5260fe06a9724',
				'label' => __('Blocks', 'acf-txt'),
				'name' => 'blocks',
				'type' => 'flexible_content',
				'layouts' => array (
					array (
						'label' => __('Billboard Slider', 'acf-txt'),
						'name' => 'billboard_slider',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_5260ff377fc22',
								'label' => __('Posts Source', 'acf-txt'),
								'name' => 'posts_source',
								'type' => 'select',
								'instructions' => __('Select what type of posts to be displayed.', 'acf-txt'),
								'column_width' => '',
								'choices' => array (
									'featured' => __('Featured Posts', 'acf-txt'),
									'latest' => __('Latest Posts', 'acf-txt'),
									'latest_by_cat' => __('Latest Posts From a Category', 'acf-txt'),
									'latest_by_format' => __('Latest Posts By Post Format', 'acf-txt'),
									'latest_by_reviews' => __('Latest Posts With Reviews', 'acf-txt'),
								),
								'default_value' => 'featured',
								'allow_null' => 0,
								'multiple' => 0,
							),
							array (
								'key' => 'field_52613eb039970',
								'label' => __('Category', 'acf-txt'),
								'name' => 'posts_source_category',
								'type' => 'taxonomy',
								'instructions' => __('Hold down Command key (or CTRL on Windows) to select multiple categories.', 'acf-txt'),
								'column_width' => '',
								'taxonomy' => 'category',
								'field_type' => 'multi_select',
								'allow_null' => 1,
								'load_save_terms' => 1,
								'return_format' => 'id',
								'multiple' => 1,
							),
							array (
								'key' => 'field_526138243996e',
								'label' => __('Post Formats', 'acf-txt'),
								'name' => 'posts_source_post_formats',
								'type' => 'select',
								'instructions' => __('Hold down Command key (or CTRL on Windows) to select multiple post formats.', 'acf-txt'),
								'column_width' => '',
								'choices' => array (
									'standard' => __('Standard', 'acf-txt'),
									'gallery' => __('Gallery', 'acf-txt'),
									'video' => __('Video', 'acf-txt'),
									'audio' => __('Audio', 'acf-txt'),
								),
								'default_value' => 'standard',
								'allow_null' => 1,
								'multiple' => 1,
							),
							array (
								'key' => 'field_5260ffd37fc23',
								'label' => __('Number of Posts', 'acf-txt'),
								'name' => 'number_of_posts',
								'type' => 'number',
								'instructions' => __('Set the maximum number of posts to be displayed (for unlimited number of posts type "-1")', 'acf-txt'),
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
								'label' => __('Read More Label', 'acf-txt'),
								'name' => 'read_more_label',
								'type' => 'text',
								'instructions' => __('Main Slider Read More Link Text', 'acf-txt'),
								'column_width' => '',
								'default_value' => '',
								'placeholder' => __('Read Full Story', 'acf-txt'),
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
						),
					),
					array (
						'label' => __('Posts Grid Cards', 'acf-txt'),
						'name' => 'posts_grid_cards',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_526100057fc25',
								'label' => __('Posts Source', 'acf-txt'),
								'name' => 'posts_source',
								'type' => 'select',
								'instructions' => __('Select what type of posts to be displayed.', 'acf-txt'),
								'column_width' => '',
								'choices' => array (
									'featured' => __('Featured Posts', 'acf-txt'),
									'latest' => __('Latest Posts', 'acf-txt'),
									'latest_by_cat' => __('Latest Posts From a Category', 'acf-txt'),
									'latest_by_format' => __('Latest Posts By Post Format', 'acf-txt'),
									'latest_by_reviews' => __('Latest Posts With Reviews', 'acf-txt'),
								),
								'default_value' => 'featured',
								'allow_null' => 0,
								'multiple' => 0,
							),
							array (
								'key' => 'field_52613ee739972',
								'label' => __('Category', 'acf-txt'),
								'name' => 'posts_source_category',
								'type' => 'taxonomy',
								'instructions' => __('Hold down Command key (or CTRL on Windows) to select multiple categories.', 'acf-txt'),
								'column_width' => '',
								'taxonomy' => 'category',
								'field_type' => 'multi_select',
								'allow_null' => 0,
								'load_save_terms' => 1,
								'return_format' => 'id',
								'multiple' => 1,
							),
							array (
								'key' => 'field_5261412a39975',
								'label' => __('Post Formats', 'acf-txt'),
								'name' => 'posts_source_post_formats',
								'type' => 'select',
								'instructions' => __('Hold down Command key (or CTRL on Windows) to select multiple post formats.', 'acf-txt'),
								'column_width' => '',
								'choices' => array (
									'standard' => __('Standard', 'acf-txt'),
									'gallery' => __('Gallery', 'acf-txt'),
									'video' => __('Video', 'acf-txt'),
									'audio' => __('Audio', 'acf-txt'),
								),
								'default_value' => 'standard',
								'allow_null' => 0,
								'multiple' => 1,
							),
							array (
								'key' => 'field_526100057fc26',
								'label' => __('Number of Posts', 'acf-txt'),
								'name' => 'number_of_posts',
								'type' => 'number',
								'instructions' => __('Set the maximum number of posts to be displayed.', 'acf-txt'),
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
						'label' => __('Hero Posts Module', 'acf-txt'),
						'name' => 'hero_posts_module',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_5261154006647',
								'label' => __('Posts Source', 'acf-txt'),
								'name' => 'posts_source',
								'type' => 'select',
								'instructions' => __('Set the maximum number of posts to be displayed.', 'acf-txt'),
								'column_width' => '',
								'choices' => array (
									'featured' => __('Featured Posts', 'acf-txt'),
									'latest' => __('Latest Posts', 'acf-txt'),
									'latest_by_cat' => __('Latest Posts From a Category', 'acf-txt'),
									'latest_by_format' => __('Latest Posts By Post Format', 'acf-txt'),
									'latest_by_reviews' => __('Latest Posts With Reviews', 'acf-txt'),
								),
								'default_value' => 'featured',
								'allow_null' => 0,
								'multiple' => 0,
							),
							array (
								'key' => 'field_526140db39973',
								'label' => __('Category', 'acf-txt'),
								'name' => 'posts_source_category',
								'type' => 'taxonomy',
								'instructions' => __('Hold down Command key (or CTRL on Windows) to select multiple categories.', 'acf-txt'),
								'column_width' => '',
								'taxonomy' => 'category',
								'field_type' => 'multi_select',
								'allow_null' => 0,
								'load_save_terms' => 1,
								'return_format' => 'id',
								'multiple' => 1,
							),
							array (
								'key' => 'field_5261410239974',
								'label' => __('Post Formats', 'acf-txt'),
								'name' => 'posts_source_post_formats',
								'type' => 'select',
								'instructions' => __('Hold down Command key (or CTRL on Windows) to select multiple post formats.', 'acf-txt'),
								'column_width' => '',
								'choices' => array (
									'standard' => __('Standard', 'acf-txt'),
									'gallery' => __('Gallery', 'acf-txt'),
									'video' => __('Video', 'acf-txt'),
									'audio' => __('Audio', 'acf-txt'),
								),
								'default_value' => 'standard',
								'allow_null' => 0,
								'multiple' => 1,
							),
							array (
								'key' => 'field_5261154006648',
								'label' => __('Number of Posts', 'acf-txt'),
								'name' => 'number_of_posts',
								'type' => 'number',
								'instructions' => __('Set the maximum number of posts to be displayed.', 'acf-txt'),
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
								'label' => __('Number of Posts', 'acf-txt'),
								'name' => 'number_of_posts',
								'type' => 'number',
								'instructions' => __('Set the maximum number of posts to be displayed.', 'acf-txt'),
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
								'label' => __('Pagination', 'acf-txt'),
								'name' => 'pagination',
								'type' => 'radio',
								'column_width' => '',
								'choices' => array (
									'enable' => __('Enable', 'acf-txt'),
									'disable' => __('Disable', 'acf-txt'),
								),
								'other_choice' => 0,
								'save_other_choice' => 0,
								'default_value' => 'enable',
								'layout' => 'horizontal',
							),
							array (
								'key' => 'field_526115fb0664c',
								'label' => __('Section Title', 'acf-txt'),
								'name' => 'section_title',
								'type' => 'text',
								'column_width' => '',
								'default_value' => __('Latest Articles', 'acf-txt'),
								'placeholder' => __('Latest Articles', 'acf-txt'),
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_5261161a0664d',
								'label' => __('Sidebar', 'acf-txt'),
								'name' => 'sidebar',
								'type' => 'radio',
								'column_width' => '',
								'choices' => array (
									'enable' => __('Enable', 'acf-txt'),
									'disable' => __('Disable', 'acf-txt'),
								),
								'other_choice' => 0,
								'save_other_choice' => 0,
								'default_value' => 'enable',
								'layout' => 'horizontal',
							),
						),
					),
					array (
						'label' => __('Text/Image Block', 'acf-txt'),
						'name' => 'content',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_5261165c0664f',
								'label' => __('Editor', 'acf-txt'),
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
						'label' => __('Heading title', 'acf-txt'),
						'name' => 'heading_title',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_5261169206651',
								'label' => __('Title', 'acf-txt'),
								'name' => 'title',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => __('Title', 'acf-txt'),
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
						),
					),
				),
				'button_label' => __('Add Block', 'acf-txt'),
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

add_action('acf/register_fields', 'wpgrade_register_acf_fields');

function wpgrade_register_acf_fields()
{
	include_once('add-ons/acf-flexible-content/flexible-content.php');
	include_once('add-ons/acf-repeater/repeater.php');
}