<?php
return array(
	'name' => esc_html__('Space', 'beyot-framework'),
	'base' => 'g5plus_space',
	'class' => '',
	'icon' => 'fa fa-arrows-v',
	'category' => GF_SHORTCODE_CATEGORY,
	'description' => esc_html__('Blank Space', 'beyot-framework'),
	'params' => array(
		array(
			'type' => 'number',
			'class' => '',
			'heading' => __('<i class="fa fa-desktop"></i> Desktop', 'beyot-framework'),
			'description' => esc_html__('Browser Width >= 1200px', 'beyot-framework'),
			'param_name' => 'desktop',
			'admin_label' => true,
			'value' => 90,
			'min' => 1,
			'max' => 500,
			'suffix' => 'px',
			'description' => esc_html__('Enter value in pixels', 'beyot-framework'),
		),
		array(
			'type' => 'number',
			'class' => '',
			'heading' => __('<i class="fa fa-tablet" style="transform: rotate(90deg);"></i> Tablet', 'beyot-framework'),
			'description' => esc_html__('Browser Width >= 992px and < 1200px', 'beyot-framework'),
			'param_name' => 'tablet',
			'admin_label' => true,
			'value' => 70,
			'min' => 1,
			'max' => 500,
			'suffix' => 'px',
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		),
		array(
			'type' => 'number',
			'class' => '',
			'heading' => __('<i class="fa fa-tablet"></i> Tablet Portrait', 'beyot-framework'),
			'description' => esc_html__('Browser Width >= 768px and < 991px', 'beyot-framework'),
			'param_name' => 'tablet_portrait',
			'admin_label' => true,
			'value' => 60,
			'min' => 1,
			'max' => 500,
			'suffix' => 'px',
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		),
		array(
			'type' => 'number',
			'class' => '',
			'heading' => __('<i class="fa fa-mobile" style="transform: rotate(90deg);"></i> Mobile Landscape', 'beyot-framework'),
			'description' => esc_html__('Browser Width >= 480px and < 767px', 'beyot-framework'),
			'param_name' => 'mobile_landscape',
			'admin_label' => true,
			'value' => 50,
			'min' => 1,
			'max' => 500,
			'suffix' => 'px',
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		),
		array(
			'type' => 'number',
			'class' => '',
			'heading' => __('<i class="fa fa-mobile"></i> Mobile', 'beyot-framework'),
			'description' => esc_html__('Browser Width < 480px', 'beyot-framework'),
			'param_name' => 'mobile',
			'admin_label' => true,
			'value' => 40,
			'min' => 1,
			'max' => 500,
			'suffix' => 'px',
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		)
	)
);