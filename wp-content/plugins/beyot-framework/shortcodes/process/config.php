<?php
return array(
	'name' => esc_html__('Process', 'beyot-framework'),
	'base' => 'g5plus_process',
	'class' => '',
	'icon' => 'fa fa-arrow-right',
	'category' => GF_SHORTCODE_CATEGORY,
	'params' =>array_merge(
		array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Step Number', 'beyot-framework'),
				'param_name' => 'step',
				'value' => '',
				'std' => '1',
				'admin_label' => true,
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Title', 'beyot-framework'),
				'param_name' => 'title',
				'value' => '',
				'admin_label' => true,
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Description', 'beyot-framework'),
				'param_name' => 'description',
				'value' => '',
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__('Link (url)', 'beyot-framework'),
				'param_name' => 'link',
				'value' => '',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Color Scheme', 'beyot-framework'),
				'param_name' => 'color_scheme',
				'admin_label' => true,
				'value' => array(
					esc_html__('Dark', 'beyot-framework') => 'color-dark',
					esc_html__('Light', 'beyot-framework') => 'color-light'
				),
				'std' => 'color-dark',
				'description' => esc_html__('Select Color Scheme.', 'beyot-framework'),
			),
			gf_vc_map_add_extra_class(),
		),
		gf_vc_map_animation()
	)
);