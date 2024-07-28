<?php
/**
 * Created by PhpStorm.
 * User: Kaga
 * Date: 15/9/2016
 * Time: 10:52 AM
 */
return array(
	'name' => esc_html__( 'Testimonials', 'beyot-framework' ),
	'base' => 'g5plus_testimonials',
	'icon' => 'fa fa-user',
	'category' => GF_SHORTCODE_CATEGORY,
	'params' =>array_merge(
		array(
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Testimonials', 'beyot-framework' ),
				'param_name' => 'values',
				'value' => urlencode( json_encode( array(
					array(
						'label' => esc_html__( 'Author', 'beyot-framework' ),
						'value' => '',
					),
				) ) ),
				'params' => array(
					array(
						'type' => 'attach_image',
						'heading' => esc_html__('Avatar:', 'beyot-framework'),
						'param_name' => 'avatar',
						'value' => '',
						'description' => esc_html__('Choose the author picture.', 'beyot-framework'),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Author Name', 'beyot-framework'),
						'param_name' => 'author',
						'admin_label' => true,
						'description' => esc_html__('Enter Author information.', 'beyot-framework'),
					),
					array(
						'type' => 'textarea',
						'heading' => esc_html__('Quote from author', 'beyot-framework'),
						'param_name' => 'quote',
						'value' => ''
					),
				),
			),
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
			array(
				'type' => 'checkbox',
				'heading' => esc_html__('Show navigation control', 'beyot-framework'),
				'param_name' => 'nav',
				'edit_field_class' => 'vc_col-sm-6 vc_column'
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__('Show pagination control', 'beyot-framework'),
				'param_name' => 'dots',
				'std' => 'true',
				'edit_field_class' => 'vc_col-sm-6 vc_column'
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__('Auto play', 'beyot-framework'),
				'param_name' => 'autoplay',
				'std' => 'true',
				'edit_field_class' => 'vc_col-sm-6 vc_column'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Autoplay speed', 'beyot-framework'),
				'param_name' => 'autoplayspeed',
				'description' => esc_html__('Autoplay speed.', 'beyot-framework'),
				'value' => '',
				'std' => 5000,
				'dependency' => array('element' => 'autoplay', 'value' => 'true'),
				'edit_field_class' => 'vc_col-sm-6 vc_column'
			),
			gf_vc_map_add_extra_class(),
			gf_vc_map_add_css_editor()
		),
		gf_vc_map_animation()
	)
);
