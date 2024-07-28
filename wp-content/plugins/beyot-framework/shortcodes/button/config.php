<?php
$dependency_add_icon = array(
    'element' => 'add_icon',
    'value' => 'true',
);
return array(
    'base' => 'g5plus_button',
    'name' => esc_html__('Button','beyot-framework'),
    'icon' => 'fa fa-bold',
    'category' =>  GF_SHORTCODE_CATEGORY,
    'description' => esc_html__('Eye catching button', 'beyot-framework' ),
    'params' =>array_merge(
        array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Text', 'beyot-framework' ),
                'param_name' => 'title',
                'value' => esc_html__('Text on the button', 'beyot-framework' ),
                'admin_label' => true,
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('URL (Link)', 'beyot-framework' ),
                'param_name' => 'link',
                'description' => esc_html__('Add link to button.', 'beyot-framework' ),
            ),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Style', 'beyot-framework' ),
				'description' => esc_html__('Select button display style.', 'beyot-framework' ),
				'param_name' => 'style',
				'value' => array(
					esc_html__('Classic', 'beyot-framework' ) => 'classic',
					esc_html__('Outline', 'beyot-framework' ) => 'outline',
				),
				'std' => '',
				'admin_label' => true,
			),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Color', 'beyot-framework' ),
                'param_name' => 'color',
                'description' => esc_html__('Select button color.', 'beyot-framework' ),
                'value' => array(
                    esc_html__('Primary', 'beyot-framework' ) => 'primary',
                    esc_html__('Gray', 'beyot-framework' ) => 'gray',
                    esc_html__('Dark', 'beyot-framework' ) => 'dark',
                    esc_html__('White', 'beyot-framework' ) => 'white',
                ),
                'std' => 'primary',
                'admin_label' => true,
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Size', 'beyot-framework' ),
                'param_name' => 'size',
                'description' => esc_html__('Select button display size.', 'beyot-framework' ),
                'std' => 'lg',
                'value' => array(
                    esc_html__('Mini','beyot-framework') => 'xs', // 34px
                    esc_html__('Small','beyot-framework') => 'sm', // 40px
                    esc_html__('Normal','beyot-framework') => 'md', // 42px
                    esc_html__('Large','beyot-framework') => 'lg', // 44px
                ),
                'admin_label' => true,
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Alignment', 'beyot-framework' ),
                'param_name' => 'align',
                'description' => esc_html__('Select button alignment.', 'beyot-framework' ),
                'value' => array(
                    esc_html__('Inline', 'beyot-framework' ) => 'inline',
                    esc_html__('Left', 'beyot-framework' ) => 'left',
                    esc_html__('Right', 'beyot-framework' ) => 'right',
                    esc_html__('Center', 'beyot-framework' ) => 'center',
                ),
                'admin_label' => true,
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Set full width button?', 'beyot-framework' ),
                'param_name' => 'button_block',
                'dependency' => array(
                    'element' => 'align',
                    'value_not_equal_to' => 'inline',
                ),
                'admin_label' => true,
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Add icon?', 'beyot-framework' ),
                'param_name' => 'add_icon',
                'admin_label' => true,
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Icon Alignment', 'beyot-framework' ),
                'description' => esc_html__('Select icon alignment.', 'beyot-framework' ),
                'param_name' => 'icon_align',
                'value' => array(
                    esc_html__('Left', 'beyot-framework' ) => 'left',
                    esc_html__('Right', 'beyot-framework' ) => 'right',
                ),
                'dependency' => $dependency_add_icon,
            ),
            gf_vc_map_add_icon_font($dependency_add_icon),
            gf_vc_map_add_extra_class(),
            gf_vc_map_add_css_editor()
        ),
        gf_vc_map_animation()
    ),
);