<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_credits',
		'title' => 'Credits',
		'fields' => array (
			array (
				'key' => 'field_525e953297858',
				'label' => __('Credits'),
				'name' => 'credits',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_525e954597859',
						'label' => __('Name'),
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
						'key' => 'field_525e95699785a',
						'label' => __('Label'),
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
						'key' => 'field_525e95789785b',
						'label' => __('Full URL'),
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
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Credit',
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
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_post-review-score',
		'title' => 'Post Review Score',
		'fields' => array (
			array (
				'key' => 'field_525e861c1943b',
				'label' => __('Enable Review Score'),
				'name' => 'enable_review_score',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_525e87671943c',
				'label' => __('Score Breakdown'),
				'name' => 'score_breakdown',
				'type' => 'repeater',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_525e861c1943b',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'sub_fields' => array (
					array (
						'key' => 'field_525e92860c891',
						'label' => __('Title'),
						'name' => 'title',
						'type' => 'text',
						'column_width' => 60,
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_525e92990c892',
						'label' => __('Score'),
						'name' => 'score',
						'type' => 'number',
						'column_width' => 40,
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => 1,
						'max' => 10,
						'step' => 1,
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_525e9393c0209',
				'label' => __('Avarage Score Box'),
				'name' => '',
				'type' => 'message',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_525e861c1943b',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => '<div class="label"><h2>Avarage Score Box</h2></div>',
			),
			array (
				'key' => 'field_525e8dbff6315',
				'label' => __('Placement'),
				'name' => 'placement',
				'type' => 'select',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_525e861c1943b',
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
				'key' => 'field_525e8e26f6316',
				'label' => __('Note'),
				'name' => 'note',
				'type' => 'text',
				'instructions' => __('A short note about score (optional)'),
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_525e861c1943b',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_525e8e51f6317',
				'label' => __('Enable Pros & Cons Lists'),
				'name' => 'enable_pros_&_cons_lists',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_525e861c1943b',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_525e8e97f6318',
				'label' => __('Pros'),
				'name' => '',
				'type' => 'tab',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_525e861c1943b',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'field_525e8e51f6317',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_525e8f26fc7d0',
				'label' => __('Pros'),
				'name' => 'pros',
				'type' => 'repeater',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_525e861c1943b',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'field_525e8e51f6317',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'sub_fields' => array (
					array (
						'key' => 'field_525e91cff1e76',
						'label' => __('Pro Note'),
						'name' => 'pro_note',
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
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Pro Note',
			),
			array (
				'key' => 'field_525e8f07fc7cf',
				'label' => __('Cons'),
				'name' => '',
				'type' => 'tab',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_525e861c1943b',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'field_525e8e51f6317',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_525e90224e884',
				'label' => __('Con'),
				'name' => 'con',
				'type' => 'repeater',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_525e861c1943b',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'field_525e8e51f6317',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'sub_fields' => array (
					array (
						'key' => 'field_525e9174f1e75',
						'label' => __('Con Note'),
						'name' => 'con_note',
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
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Con Note',
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
		'menu_order' => 0,
	));
}

add_action('acf/register_fields', 'wpgrade_register_acf_fields');

function wpgrade_register_acf_fields()
{
	include_once('add-ons/acf-flexible-content/flexible-content.php');
	include_once('add-ons/acf-repeater/repeater.php');
}