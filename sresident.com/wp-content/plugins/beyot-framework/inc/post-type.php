<?php
/**
 * Register gf_preset POST TYPE
 * *******************************************************
 */
if (!function_exists('gf_register_preset_post_type')) {
    function gf_register_preset_post_type($post_types)
    {
        $post_types ['gf_preset'] = array(
            'label' => esc_html__('Preset', 'beyot-framework'),
            'singular_name' => esc_html__('Preset', 'beyot-framework'),
            'supports' => array('title'),
            'public' => true,
            'show_ui' => true,
            '_builtin' => false,
            'has_archive' => false,
            'show_in_menu' => false,
            'show_in_nav_menus' => false,
            'menu_icon' => 'dashicons-screenoptions'
        );
        $post_types ['gf_footer'] = array(
            'label' => esc_html__('Custom Footer', 'beyot-framework'),
            'singular_name' => esc_html__('Custom Footer', 'beyot-framework'),
            'supports' => array('title', 'editor'),
            'public' => true,
            'show_ui' => true,
            '_builtin' => false,
            'has_archive' => false,
            'show_in_menu' => false,
            'show_in_nav_menus' => false,
            'menu_icon' => 'dashicons-screenoptions'
        );
        return $post_types;
    }
    add_filter( 'gsf_register_post_type','gf_register_preset_post_type');
}

/**
 * Preset Single
 * *******************************************************
 */
if (!function_exists('gf_preset_single_template')) {
    function gf_preset_single_template($single)
    {
        if (is_singular(array('gf_preset', 'gf_footer'))) {
            $single = GF_PLUGIN_DIR . '/inc/templates/single-preset.php';
        }
        return $single;
    }

    add_filter('single_template', 'gf_preset_single_template');
}