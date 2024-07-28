<?php
return array(
	'name' => esc_html__('Google Map', 'beyot-framework'),
	'base' => 'g5plus_goole_map',
	'icon' => 'fa fa-map-marker',
	'category' => GF_SHORTCODE_CATEGORY,
	'params' =>array_merge(
		array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Maps Layout', 'beyot-framework'),
				'param_name' => 'maps_layout',
				'value' => array(
					esc_html__('Classic'),
					esc_html__('Dark Layout') => 'dark_layout'
				),
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Markers', 'beyot-framework' ),
				'param_name' => 'markers',
				'value' => urlencode( json_encode( array(
					array(
						'label' => esc_html__( 'Title', 'beyot-framework' ),
						'value' => '',
					),
				) ) ),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Latitude ', 'beyot-framework'),
						'param_name' => 'lat',
						'value' => '',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Longitude ', 'beyot-framework'),
						'param_name' => 'lng',
						'value' => '',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Title', 'beyot-framework'),
						'param_name' => 'title',
						'admin_label' => true,
						'value' => '',
					),
					array(
						'type' => 'textarea',
						'heading' => esc_html__('Description', 'beyot-framework'),
						'param_name' => 'description',
						'value' => ''
					),
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( 'Marker Icon', 'beyot-framework' ),
						'param_name' => 'icon',
						'value' => '',
						'description' => esc_html__( 'Select an image from media library.', 'beyot-framework' ),
					),
					array(
						'type' => 'textfield',
						'param_name' => 'property_id',
						'value' => ''
					),
				),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Map height (px or %)', 'beyot-framework'),
				'param_name' => 'map_height',
				'edit_field_class' => 'vc_col-sm-6',
				'std' => '500px',
			),
			gf_vc_map_add_extra_class(),
			gf_vc_map_add_css_editor()
		),
		gf_vc_map_animation()
	)
);