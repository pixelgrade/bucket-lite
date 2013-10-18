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
				'label' => 'Credits',
				'name' => 'credits',
				'type' => 'repeater',
				'instructions' => 'Sources, Credits, Via or other useful links.',
				'sub_fields' => array (
					array (
						'key' => 'field_525fe9e7c3574',
						'label' => 'Name',
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
						'label' => 'Label',
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
						'label' => 'Full URL',
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
				'button_label' => 'Add New',
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
		'title' => 'Post Review Score',
		'fields' => array (
			array (
				'key' => 'field_525fdc951ec8c',
				'label' => 'Enable Review Score',
				'name' => 'enable_review_score',
				'type' => 'true_false',
				'message' => 'Enable Review Score',
				'default_value' => 0,
			),
			array (
				'key' => 'field_525fdda646878',
				'label' => 'Score Breakdown',
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
						'label' => 'Label',
						'name' => 'label',
						'type' => 'text',
						'column_width' => 60,
						'default_value' => '',
						'placeholder' => 'eg. Features',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => -1,
					),
					array (
						'key' => 'field_525fddf64687a',
						'label' => 'Score',
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
				'button_label' => 'New Score Row',
			),
			array (
				'key' => 'field_525fdfc461de9',
				'label' => 'Average Score Box',
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
				'message' => '<strong>Average Score Box</strong>',
			),
			array (
				'key' => 'field_525fdf4b10e33',
				'label' => 'Placement',
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
					'before' => 'Before Content',
					'after' => 'After Content',
					'shortcode' => 'Using Shortcode',
				),
				'default_value' => 'before',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_525fe0383d6ea',
				'label' => 'Note',
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
				'placeholder' => 'A short note about score (optional)',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_525fe095afe76',
				'label' => 'Enable Pros & Cons Lists',
				'name' => 'enable_pros_&_cons_lists',
				'type' => 'true_false',
				'instructions' => 'Display a comparison lists with Good and Bad things.',
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
				'message' => 'Enable Pros & Cons Lists',
				'default_value' => 0,
			),
			array (
				'key' => 'field_525fe1051e90c',
				'label' => 'Pros List',
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
						'label' => 'Pros Note',
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
				'button_label' => 'Add New',
			),
			array (
				'key' => 'field_525fe1a2c98d6',
				'label' => 'Cons List',
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
						'label' => 'Cons Note',
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
				'button_label' => 'Add New',
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
		'title' => 'Custom Page Composer',
		'fields' => array (
			array (
				'key' => 'field_5260fe06a9724',
				'label' => 'Blocks',
				'name' => 'blocks',
				'type' => 'flexible_content',
				'layouts' => array (
					array (
						'label' => 'Billboard Slider',
						'name' => 'billboard_slider',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_5260ff377fc22',
								'label' => 'Posts Source',
								'name' => 'posts_source',
								'type' => 'select',
								'instructions' => 'Select which posts to be dislayed',
								'column_width' => '',
								'choices' => array (
									'featured' => 'Featured',
									'latest' => 'Latest Posts',
									'latest_by_cat' => 'Latest from a Category',
									'latest_by_format' => 'Latest by Post Format',
									'latest_by_reviews' => 'Latest Reviews',
								),
								'default_value' => 'featured',
								'allow_null' => 0,
								'multiple' => 0,
							),
							array (
								'key' => 'field_5260ffd37fc23',
								'label' => 'Number of Posts',
								'name' => 'number_of_posts',
								'type' => 'number',
								'instructions' => 'Set the maximum number of posts to be displayed',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'min' => '',
								'max' => '',
								'step' => 1,
							),
							array (
								'key' => 'field_526100097fc27',
								'label' => 'Read More Label',
								'name' => 'read_more_label',
								'type' => 'text',
								'instructions' => 'Main Slider Read More Link Text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => 'Read Full Story',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
						),
					),
					array (
						'label' => 'Posts Grid Cards',
						'name' => 'posts_grid_cards',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_526100057fc25',
								'label' => 'Posts Source',
								'name' => 'posts_source',
								'type' => 'select',
								'instructions' => 'Select which posts to be dislayed',
								'column_width' => '',
								'choices' => array (
									'featured' => 'Featured',
									'latest' => 'Latest Posts',
									'latest_by_cat' => 'Latest from a Category',
									'latest_by_format' => 'Latest by Post Format',
									'latest_by_reviews' => 'Latest Reviews',
								),
								'default_value' => 'featured',
								'allow_null' => 0,
								'multiple' => 0,
							),
							array (
								'key' => 'field_526100057fc26',
								'label' => 'Number of Posts',
								'name' => 'number_of_posts',
								'type' => 'number',
								'instructions' => 'Set the maximum number of posts to be displayed',
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
						'label' => 'Hero Posts Module',
						'name' => 'hero_posts_module',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_5261154006647',
								'label' => 'Posts Source',
								'name' => 'posts_source',
								'type' => 'select',
								'instructions' => 'Select which posts to be dislayed',
								'column_width' => '',
								'choices' => array (
								),
								'default_value' => '',
								'allow_null' => 0,
								'multiple' => 0,
							),
							array (
								'key' => 'field_5261154006648',
								'label' => 'Number of Posts',
								'name' => 'number_of_posts',
								'type' => 'number',
								'instructions' => 'Set the maximum number of posts to be displayed',
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
								'label' => 'Number of Posts',
								'name' => 'number_of_posts',
								'type' => 'number',
								'instructions' => 'Set the number of posts to be displayed on first page',
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
								'label' => 'Pagination',
								'name' => 'pagination',
								'type' => 'radio',
								'column_width' => '',
								'choices' => array (
									'enable' => 'Enable',
									'disable' => 'Disable',
								),
								'other_choice' => 0,
								'save_other_choice' => 0,
								'default_value' => 'enable',
								'layout' => 'horizontal',
							),
							array (
								'key' => 'field_526115fb0664c',
								'label' => 'Section Title',
								'name' => 'section_title',
								'type' => 'text',
								'column_width' => '',
								'default_value' => 'Latest Articles',
								'placeholder' => 'Latest Articles',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_5261161a0664d',
								'label' => 'Sidebar',
								'name' => 'sidebar',
								'type' => 'radio',
								'column_width' => '',
								'choices' => array (
									'enable' => 'Enable',
									'disable' => 'Disable',
								),
								'other_choice' => 0,
								'save_other_choice' => 0,
								'default_value' => 'enable',
								'layout' => 'horizontal',
							),
						),
					),
					array (
						'label' => 'Text/Image Block',
						'name' => 'content',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_5261165c0664f',
								'label' => 'Editor',
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
						'label' => 'Heading title',
						'name' => 'heading_title',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_5261169206651',
								'label' => 'Title',
								'name' => 'title',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => 'Title',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
						),
					),
				),
				'button_label' => 'Add Block',
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
			'position' => 'normal',
			'layout' => 'default',
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