<?php
return array(
	'base' => 'g5plus_icon_box',
	'name' => esc_html__('Icon Box','beyot-framework'),
	'icon' => 'fa fa-diamond',
	'category' => GF_SHORTCODE_CATEGORY,
	'params' =>array_merge(
		array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Layout Style', 'beyot-framework'),
				'param_name' => 'layout_style',
				'admin_label' => true,
				'value' => array(
					esc_html__('Center', 'beyot-framework') => 'layout-center',
					esc_html__('Left', 'beyot-framework') => 'layout-left',
					esc_html__('Right', 'beyot-framework') => 'layout-right',
				),
				'std' => 'layout-center',
				'description' => esc_html__('Select Layout Style.', 'beyot-framework')
			),
			gf_vc_map_add_icon_type(),
			gf_vc_map_add_icon_font(),
			gf_vc_map_add_icon_image(),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Title', 'beyot-framework' ),
				'param_name' => 'title',
				'value' => '',
				'admin_label' => true,
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Description', 'beyot-framework'),
				'param_name' => 'description',
				'value' => '',
				'description' => esc_html__('Provide the description for this element.', 'beyot-framework'),
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
				'description' => esc_html__('Select Color Scheme.', 'beyot-framework')
			),
			gf_vc_map_add_extra_class(),
			gf_vc_map_add_css_editor()
		),
		gf_vc_map_animation()
	)
);