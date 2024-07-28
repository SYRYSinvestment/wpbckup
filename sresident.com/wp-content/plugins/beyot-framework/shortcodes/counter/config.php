<?php
return array(
	'name' => esc_html__('Counter', 'beyot-framework'),
	'base' => 'g5plus_counter',
	'class' => '',
	'icon' => 'fa fa-tachometer',
	'category' => GF_SHORTCODE_CATEGORY,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'beyot-framework'),
			'param_name' => 'title',
			'value' => '',
			'admin_label' => true,
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon library', 'beyot-framework'),
			'value' => array(
				esc_html__('none', 'beyot-framework') => '',
				esc_html__('Icon', 'beyot-framework') => 'icon',
				esc_html__('Image', 'beyot-framework') => 'image',
			),
			'param_name' => 'icon_type',
			'description' => esc_html__('Select icon library.', 'beyot-framework'),
		),
		gf_vc_map_add_icon_font(),
		gf_vc_map_add_icon_image(),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Start', 'beyot-framework'),
			'param_name' => 'start',
			'value' => '',
			'std'=> '0',
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('End', 'beyot-framework'),
			'param_name' => 'end',
			'value' => '',
			'std'=> '1000',
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Decimals', 'beyot-framework'),
			'param_name' => 'decimals',
			'value' => '',
			'std'=> '0',
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Duration', 'beyot-framework'),
			'param_name' => 'duration',
			'value' => '',
			'std'=> '2,5',
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Separator', 'beyot-framework'),
			'param_name' => 'separator',
			'value' => '',
			'std'=> ',',
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Decimal', 'beyot-framework'),
			'param_name' => 'decimal',
			'value' => '',
			'std'=> '.',
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Prefix', 'beyot-framework'),
			'param_name' => 'prefix',
			'value' => '',
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Suffix', 'beyot-framework'),
			'param_name' => 'suffix',
			'value' => '',
			'edit_field_class' => 'vc_col-sm-6 vc_column'
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
	)
);