<?php
return array(
	'name'     => esc_html__('Video', 'beyot-framework'),
	'base'     => 'g5plus_video',
	'class'    => '',
	'icon'     => 'fa fa-play-circle',
	'category' => GF_SHORTCODE_CATEGORY,
	'params'   =>
		array_merge(
			array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Link', 'beyot-framework' ),
					'param_name' => 'link',
					'value' => '',
					'description' => esc_html__( 'Enter link video', 'beyot-framework' ),
				),
				gf_vc_map_add_extra_class(),
				gf_vc_map_add_css_editor()
			),
			gf_vc_map_animation()
	)
);