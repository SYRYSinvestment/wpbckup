<?php
/**
 * Created by PhpStorm.
 * User: Kaga
 * Date: 20/5/2016
 * Time: 3:57 PM
 */
return array(
	'name' => esc_html__('Countdown', 'beyot-framework'),
	'base' => 'g5plus_countdown',
	'class' => '',
	'icon' => 'fa fa-clock-o',
	'category' => GF_SHORTCODE_CATEGORY,
	'params' => array_merge(
		array(
			array(
				'type' => 'datetimepicker',
				'heading' => esc_html__('Time Off', 'beyot-framework'),
				'param_name' => 'time',
			),

			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Color Scheme', 'beyot-framework'),
				'param_name' => 'color_scheme',
				'admin_label' => true,
				'value' => array(
					esc_html__('Light', 'beyot-framework') => 'color-light',
					esc_html__('Dark', 'beyot-framework') => 'color-dark',),
				'description' => esc_html__('Select Color Scheme.', 'beyot-framework')
			),

			array(
				'type' => 'textfield',
				'heading' => esc_html__('Url Redirect', 'beyot-framework'),
				'param_name' => 'url_redirect',
				'value' => '',
			),
			gf_vc_map_add_extra_class(),
			gf_vc_map_add_css_editor()
		),
		gf_vc_map_animation()
	)
);