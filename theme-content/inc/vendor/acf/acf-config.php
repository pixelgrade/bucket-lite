<?php


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
}


add_action('acf/register_fields', 'wpgrade_register_acf_fields');

function wpgrade_register_acf_fields()
{
	include_once('add-ons/acf-flexible-content/flexible-content.php');
	include_once('add-ons/acf-repeater/repeater.php');
}