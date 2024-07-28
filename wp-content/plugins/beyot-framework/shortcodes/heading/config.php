<?php
return array(
    'base' => 'g5plus_heading',
    'name' => esc_html__('Heading','beyot-framework'),
    'icon' => 'fa fa-header',
    'category' => GF_SHORTCODE_CATEGORY,
    'params' =>array_merge(
        array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Layout Style', 'beyot-framework'),
                'param_name' => 'layout_style',
                'admin_label' => true,
                'value' => array(
                    esc_html__('House top', 'beyot-framework') => 'style1',
                    esc_html__('Inline', 'beyot-framework') => 'style2',
                ),
                'std' => 'style1',
                'description' => esc_html__('Select Layout Style.', 'beyot-framework')
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Sub Title', 'beyot-framework'),
                'param_name' => 'sub_title',
                'value' => '',
                'dependency' => array('element' => 'layout_style', 'value' => 'style1' )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'beyot-framework'),
                'param_name' => 'title',
                'value' => '',
                'admin_label' => true,
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Text Align', 'beyot-framework' ),
                'param_name' => 'text_align',
                'description' => esc_html__('Select heading alignment.', 'beyot-framework' ),
                'value' => array(
                    esc_html__('Left', 'beyot-framework' ) => 'text-left',
                    esc_html__('Center', 'beyot-framework' ) => 'text-center',
                    esc_html__('Right', 'beyot-framework' ) => 'text-right',
                ),
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'dependency' => array('element' => 'layout_style', 'value' => 'style1' )
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
                'edit_field_class' => 'vc_col-sm-6 vc_column'
            ),
            gf_vc_map_add_extra_class(),
			gf_vc_map_add_css_editor()
        ),
        gf_vc_map_animation()
    )
);
