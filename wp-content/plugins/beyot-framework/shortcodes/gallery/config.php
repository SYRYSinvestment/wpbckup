<?php
return array(
    'name' => esc_html__('Gallery', 'beyot-framework'),
    'base' => 'g5plus_gallery',
    'class' => '',
    'icon' => 'vc_general vc_element-icon icon-wpb-images-stack',
    'category' => GF_SHORTCODE_CATEGORY,
    'params' =>
        array_merge(
            array(
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Hover effect', 'beyot-framework'),
                    'param_name' => 'hover_effect',
                    'std' => 'default-effect',
                    'value' => array(
                        esc_html__('Default', 'beyot-framework') => 'default-effect',
                        esc_html__('Layla', 'beyot-framework') => 'layla-effect',
                        esc_html__('Bubba', 'beyot-framework') => 'bubba-effect',
                        esc_html__('Jazz', 'beyot-framework') => 'jazz-effect',
                    )
                ),
                array(
                    'type' => 'attach_images',
                    'heading' => esc_html__('Images', 'beyot-framework'),
                    'param_name' => 'images',
                    'value' => '',
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Columns', 'beyot-framework'),
                    'param_name' => 'columns',
                    'value' => array('2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6),
                    'std' => 4,
                    'edit_field_class' => 'vc_col-sm-6 vc_column'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Image size', 'beyot-framework'),
                    'param_name' => 'image_size',
                    'value' => array(
                        '270x160' => 'gallery-size-sm',
                        '430x430' => 'gallery-size-md',
                    ),
                    'edit_field_class' => 'vc_col-sm-6 vc_column'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Columns Gap', 'beyot-framework'),
                    'param_name' => 'columns_gap',
                    'value' => array(
                        '30px' => 'col-gap-30',
                        '0px' => 'col-gap-0'
                    ),
                    'std' => 'col-gap-30',
                    'edit_field_class' => 'vc_col-sm-6 vc_column'
                ),
            ),
            gf_vc_map_slider(),
            gf_vc_map_animation(),
            gf_vc_map_responsive(),
            array(
                gf_vc_map_add_extra_class(),
                gf_vc_map_add_css_editor()
            )
        )
);