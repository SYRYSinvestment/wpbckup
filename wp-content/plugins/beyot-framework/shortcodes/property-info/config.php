<?php
/**
 * Created by PhpStorm.
 * User: Kaga
 * Date: 15/9/2016
 * Time: 10:52 AM
 */
return array(
	'name' => esc_html__( 'Property Info', 'beyot-framework' ),
	'base' => 'g5plus_property_info',
	'icon' => 'fa fa-newspaper-o',
	'category' => GF_SHORTCODE_CATEGORY,
	'params' =>array_merge(
		array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Address', 'beyot-framework'),
				'param_name' => 'address',
				'value' => ''
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Title', 'beyot-framework'),
				'param_name' => 'title',
				'value' => ''
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Price', 'beyot-framework'),
				'param_name' => 'price',
				'value' => ''
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('After Price', 'beyot-framework'),
				'param_name' => 'after_price',
				'value' => ''
			),

			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Detail', 'beyot-framework' ),
				'param_name' => 'values',
				'value' => urlencode( json_encode( array(
					array(
						'label' => esc_html__( 'Key', 'beyot-framework' ),
						'value' => '',
					),
				) ) ),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Key', 'beyot-framework'),
						'param_name' => 'key',
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Value', 'beyot-framework'),
						'param_name' => 'value',
						'value' => ''
					),
					gf_vc_map_add_icon_font(),
				),
			),
			gf_vc_map_add_extra_class(),
			gf_vc_map_add_css_editor()
		),
		gf_vc_map_animation()
	)
);
