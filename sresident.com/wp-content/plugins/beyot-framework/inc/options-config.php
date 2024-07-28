<?php
/**
 * The template for displaying options-config
 *
 * @package WordPress
 * @subpackage beyot
 * @since beyot 1.0
 */

if (!function_exists('gf_font_options')) {
    function gf_font_options($options_list) {
        $options_list[] = 'beyot_options';
        return $options_list;
    }
    add_filter('gsf_options_font', 'gf_font_options');
}
/**
 * Define Theme Options
 * *******************************************************
 */
add_filter('gsf_option_config', 'gf_define_theme_options');
if (!function_exists('gf_define_theme_options')) {
    function gf_define_theme_options($configs)
    {
        $configs[GF_OPTIONS_NAME] = array(
            'layout' => 'horizontal',
            'page_title' => esc_html__('Theme Options', 'beyot-framework'),
            'menu_title' => esc_html__('Theme Options', 'beyot-framework'),
            'option_name' => GF_OPTIONS_NAME,
            'permission' => 'edit_theme_options',
            'section' => array(

                /**
                 * General
                 */
                gf_get_config_section_general(),

                /**
                 * Layout
                 */
                gf_get_config_section_layout(),

                /**
                 * Page Title
                 */
                gf_get_config_section_page_title(),

                /**
                 * Blog
                 */
                gf_get_config_section_blog(),

                /**
                 * Logo
                 */
                gf_get_config_section_logo(),

                /**
                 * Top Drawer
                 */
                gf_get_config_section_top_drawer(),

                /**
                 * Top Bar
                 */
                gf_get_config_section_top_bar(),

                /**
                 * Header
                 */
                gf_get_config_section_header(),

                /**
                 * Header Customize
                 */
                gf_get_config_section_header_customize(),

                /**
                 * Footer
                 */
                gf_get_config_section_footer(),

                /**
                 * Theme Colors
                 */
                gf_get_config_section_theme_colors(),

                /**
                 * Font Options
                 */
                gf_get_config_section_font_options(),

                /**
                 * Social Profiles
                 */
                gf_get_config_section_social_profiles(),

                /**
                 * Resources Options
                 */
                gf_get_config_section_resources_options(),

                /**
                 * Custom CSS & Script
                 */
                gf_get_config_custom_css_script_options(),

                /**
                 * Preset Settings
                 */

                gf_get_config_preset_setting_options(),
            ),
        );
        return $configs;
    }
}

/**
 * Get Config Section General
 * *******************************************************
 */
if (!function_exists('gf_get_config_section_general')) {
    function gf_get_config_section_general() {
	    $allowed_html = array(
		    'i' => array(
			    'class' => array()
		    ),
		    'span' => array(
			    'class' => array()
		    ),
		    'a' => array(
			    'href' => array(),
			    'title' => array(),
			    'target' => array()
		    )
	    );
        $list_post_type = array();
        $post_type_preset = apply_filters('gf_post_type_preset', array());
        foreach ($post_type_preset as $key => $value) {
            $list_post_type[$key] = $value['name'];
        }
        return array(
            'id' => 'section_general',
            'title' => esc_html__('General', 'beyot-framework'),
            'icon' => 'dashicons dashicons-admin-multisite',
            'fields' => array(
                /**
                 * General
                 */
                array(
                    'id' => 'section_general_group_general',
                    'title' => esc_html__('General', 'beyot-framework'),
                    'type' => 'group',
                    'fields' => array(
	                    array(
		                    'id'       => 'custom_scroll',
		                    'type'     => 'button_set',
		                    'title'    => esc_html__('Custom Scroll', 'beyot-framework'),
		                    'subtitle' => esc_html__('Enable/Disable Custom Scroll', 'beyot-framework'),
		                    'desc'     => '',
		                    'options'  => gf_get_toggle(),
		                    'default'  => 0
	                    ),

	                    array(
		                    'id'       => 'custom_scroll_width',
		                    'type'     => 'text',
		                    'title'    => esc_html__('Custom Scroll Width', 'beyot-framework'),
		                    'subtitle' => esc_html__('This must be numeric (no px) or empty.', 'beyot-framework'),
		                    'validate' => 'numeric',
		                    'default'  => '10',
		                    'required' => array('custom_scroll', '=', 1),
	                    ),

	                    array(
		                    'id'       => 'custom_scroll_color',
		                    'type'     => 'color',
		                    'title'    => esc_html__('Custom Scroll Color', 'beyot-framework'),
		                    'subtitle' => esc_html__('Set Custom Scroll Color', 'beyot-framework'),
		                    'default'  => '#19394B',
		                    'validate' => 'color',
		                    'required' => array('custom_scroll', '=', 1),
	                    ),

	                    array(
		                    'id'       => 'custom_scroll_thumb_color',
		                    'type'     => 'color',
		                    'title'    => esc_html__('Custom Scroll Thumb Color', 'beyot-framework'),
		                    'subtitle' => esc_html__('Set Custom Scroll Thumb Color', 'beyot-framework'),
		                    'default'  => '#1086df',
		                    'validate' => 'color',
		                    'required' => array('custom_scroll', '=', 1),
	                    ),

                        array(
                            'id' => 'section_general_group_search_popup',
                            'title' => esc_html__('Search Popup', 'beyot-framework'),
                            'type' => 'group',
                            'fields' => array(
                                array(
                                    'id'       => 'search_popup_type',
                                    'type'     => 'button_set',
                                    'title'    => esc_html__('Search Popup Type', 'beyot-framework'),
                                    'options'  => array(
                                        'standard' => esc_html__('Standard', 'beyot-framework'),
                                        'ajax' => esc_html__('Ajax', 'beyot-framework')
                                    ),
                                    'default'  => 'standard'
                                ),
                                array(
                                    'id'       => 'search_popup_post_type',
                                    'type'     => 'selectize',
                                    'title'    => esc_html__('Post Type For Ajax Search', 'beyot-framework'),
                                    'options'  => array_merge(
                                        gf_get_search_ajax_popup_post_type(),
                                        $list_post_type
                                    ),
                                    'multiple' => true,
                                    'default'  => array('post'),
                                    'required' => array('search_popup_type', '=', 'ajax'),
                                ),
                                array(
                                    'id'       => 'search_popup_result_amount',
                                    'type'     => 'text',
                                    'input_type' => 'number',
                                    'title'    => esc_html__('Amount Of Search Result', 'beyot-framework'),
                                    'subtitle' => esc_html__('This must be numeric (no px) or empty (default: 8).', 'beyot-framework'),
                                    'default'  => 8,
                                    'required' => array('search_popup_type', '=', 'ajax'),
                                ),
                            )
                        ),
                        array(
                            'id' => 'section_general_other_option',
                            'title' => esc_html__('Other Options', 'beyot-framework'),
                            'type' => 'group',
                            'fields' => array(
                                array(
                                    'id'       => 'back_to_top',
                                    'type'     => 'button_set',
                                    'title'    => esc_html__('Back To Top', 'beyot-framework'),
                                    'subtitle' => esc_html__('Enable/Disable Back to top button', 'beyot-framework'),
                                    'desc'     => '',
                                    'options'  => gf_get_toggle(),
                                    'default'  => 1
                                ),

                                array(
                                    'id'       => 'enable_rtl_mode',
                                    'type'     => 'button_set',
                                    'title'    => esc_html__('Enable RTL mode', 'beyot-framework'),
                                    'subtitle' => esc_html__('Enable/Disable RTL mode', 'beyot-framework'),
                                    'desc'     => '',
                                    'options'  => gf_get_toggle(),
                                    'default'  => 0
                                ),

                                array(
                                    'id'       => 'social_meta_enable',
                                    'type'     => 'button_set',
                                    'title'    => esc_html__('Enable Social Meta Tags', 'beyot-framework'),
                                    'subtitle' => esc_html__('Enable the social meta head tag output.', 'beyot-framework'),
                                    'desc'     => '',
                                    'options'  => gf_get_toggle(),
                                    'default'  => 0
                                ),

                                array(
                                    'id'       => 'menu_transition',
                                    'type'     => 'button_set',
                                    'title'    => esc_html__('Menu transition', 'beyot-framework'),
                                    'subtitle' => esc_html__('Select menu transition', 'beyot-framework'),
                                    'desc'     => '',
                                    'options'  => array(
                                        'none'                  => esc_html__('None', 'beyot-framework'),
                                        'x-animate-slide-up'    => esc_html__('Slide Up', 'beyot-framework'),
                                        'x-animate-slide-down'  => esc_html__('Slide Down', 'beyot-framework'),
                                        'x-animate-slide-left'  => esc_html__('Slide Left', 'beyot-framework'),
                                        'x-animate-slide-right' => esc_html__('Slide Right', 'beyot-framework'),
                                        'x-animate-sign-flip'   => esc_html__('Sign Flip', 'beyot-framework'),
                                    ),
                                    'default'  => 'x-animate-sign-flip'
                                ),

                            )
                        ),

	                    array(
		                    'id' => 'section_general_google_map_option',
		                    'title' => esc_html__('Google Map Options', 'beyot-framework'),
		                    'type' => 'group',
		                    'fields' => array(
			                    array(
				                    'id' => 'google_map_ssl',
				                    'title' => esc_html__('Google Maps SSL', 'beyot-framework'),
				                    'subtitle' => esc_html__('Use google maps with ssl', 'beyot-framework'),
				                    'type' => 'button_set',
				                    'options' => array(
					                    '1' => esc_html__('Yes', 'beyot-framework'),
					                    '0' => esc_html__('No', 'beyot-framework'),
				                    ),
				                    'default' => '0',
			                    ),
			                    array(
				                    'id' => 'google_map_api_key',
				                    'type' => 'text',
				                    'title' => esc_html__('Google Maps API KEY', 'beyot-framework'),
				                    'desc' => wp_kses(__('We strongly encourage you to get an APIs Console key and post the code in Theme Options. You can get it from <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/tutorial#api_key">here</a>', 'beyot-framework'), $allowed_html),
				                    'subtitle' => esc_html__('Enter your google maps api key', 'beyot-framework'),
				                    'default' => 'AIzaSyBqmFdSPp4-iY_BG14j_eUeLwOn9Oj4a4Q'
			                    ),
		                    )
	                    )
                    )
                ),
                /**
                 * Maintenance
                 */
                array(
                    'id' => 'section_general_group_maintenance',
                    'title' => esc_html__('Maintenance', 'beyot-framework'),
                    'type' => 'group',
                    'toggle_default' => false,
                    'fields' => array(
                        array(
                            'id'       => 'maintenance_mode',
                            'type'     => 'button_set',
                            'title'    => esc_html__('Maintenance Mode', 'beyot-framework'),
                            'options'  => gf_get_maintenance_mode(),
                            'default'  => '0'
                        ),
                        array(
                            'id'       => 'maintenance_mode_page',
                            'title'    => esc_html__('Maintenance Mode Page', 'beyot-framework'),
                            'subtitle' => esc_html__('Select the page that is your maintenance page, if you would like to show a custom page instead of the standard WordPress message. You should use the Holding Page template for this page.', 'beyot-framework'),
                            'type'     => 'selectize',
                            'allow_clear' => true,
                            'placeholder' => esc_html__('Select Page', 'beyot-framework'),
                            'data'     => 'page',
                            'data_args' => array(
                                'numberposts' => -1
                            ),
                            'edit_link' => true,
                            'default' => '',
                            'required' => array('maintenance_mode', '=', '2'),

                        ),
                    )
                ),
                /**
                 * Performance
                 */
                array(
                    'id' => 'section_general_group_performance',
                    'title' => esc_html__('Performance', 'beyot-framework'),
                    'type' => 'group',
                    'toggle_default' => false,
                    'fields' => array(
                        array(
                            'id'       => 'enable_minifile_js',
                            'type'     => 'button_set',
                            'title'    => esc_html__('Enable Mini File JS', 'beyot-framework'),
                            'subtitle'     => esc_html__('Turn On this option if you want to use mini file js', 'beyot-framework'),
                            'options'  => gf_get_toggle(),
                            'default'  => 0
                        ),
                        array(
                            'id'       => 'enable_minifile_css',
                            'type'     => 'button_set',
                            'title'    => esc_html__('Enable Mini File CSS', 'beyot-framework'),
                            'subtitle'     => esc_html__('Turn On this option if you want to use mini file css', 'beyot-framework'),
                            'options'  => gf_get_toggle(),
                            'default'  => 0
                        ),

                    )
                ),
                /**
                 * Page Transition Section
                 * *******************************************************
                 */
                array(
                    'id' => 'section_general_group_page_transition',
                    'title' => esc_html__('Page Transition', 'beyot-framework'),
                    'type' => 'group',
                    'toggle_default' => false,
                    'fields' => array(
                        array(
                            'id'       => 'page_transition',
                            'type'     => 'button_set',
                            'title'    => esc_html__('Page Transition', 'beyot-framework'),
                            'subtitle'     => esc_html__('Turn On this option if you want to enable page transition', 'beyot-framework'),
                            'options'  => gf_get_toggle(),
                            'default'  => 0
                        ),
                        array(
                            'id'       => 'loading_animation',
                            'type'     => 'selectize',
                            'allow_clear' => true,
                            'title'    => esc_html__('Loading Animation', 'beyot-framework'),
                            'subtitle' => esc_html__('Select type of pre load animation', 'beyot-framework'),
                            'placeholder' => esc_html__('Select Loading', 'beyot-framework'),
                            'options'  => gf_get_loading_animation(),
                            'default'  => ''
                        ),
                        array(
                            'id'       => 'loading_logo',
                            'type'     => 'image',
                            'title'    => esc_html__('Logo Loading', 'beyot-framework'),
                            'required' => array('loading_animation', '!=', ''),
                        ),
                    )
                ),
                /**
                 * Custom Favicon
                 * *******************************************************
                 */
                array(
                    'id' => 'section_general_group_custom_favicon',
                    'title' => esc_html__('Custom Favicon', 'beyot-framework'),
                    'type' => 'group',
                    'toggle_default' => false,
                    'fields' => array(
                        array(
                            'id'       => 'custom_favicon',
                            'type'     => 'image',
                            'title'    => esc_html__('Custom favicon', 'beyot-framework'),
                            'subtitle' => esc_html__('Upload a 16px x 16px Png/Gif/ico image that will represent your website favicon', 'beyot-framework'),
                        ),
                        array(
                            'id'       => 'custom_ios_title',
                            'type'     => 'text',
                            'title'    => esc_html__('Custom iOS Bookmark Title', 'beyot-framework'),
                            'subtitle' => esc_html__('Enter a custom title for your site for when it is added as an iOS bookmark.', 'beyot-framework'),
                            'default'  => ''
                        ),
                        array(
                            'id'       => 'custom_ios_icon57',
                            'type'     => 'image',
                            'title'    => esc_html__('Custom iOS 57x57', 'beyot-framework'),
                            'subtitle' => esc_html__('Upload a 57px x 57px Png image that will be your website bookmark on non-retina iOS devices.', 'beyot-framework'),
                        ),
                        array(
                            'id'       => 'custom_ios_icon72',
                            'type'     => 'image',
                            'title'    => esc_html__('Custom iOS 72x72', 'beyot-framework'),
                            'subtitle' => esc_html__('Upload a 72px x 72px Png image that will be your website bookmark on non-retina iOS devices.', 'beyot-framework'),
                        ),
                        array(
                            'id'       => 'custom_ios_icon114',
                            'type'     => 'image',
                            'title'    => esc_html__('Custom iOS 114x114', 'beyot-framework'),
                            'subtitle' => esc_html__('Upload a 114px x 114px Png image that will be your website bookmark on retina iOS devices.', 'beyot-framework'),
                        ),
                        array(
                            'id'       => 'custom_ios_icon144',
                            'type'     => 'image',
                            'title'    => esc_html__('Custom iOS 144x144', 'beyot-framework'),
                            'subtitle' => esc_html__('Upload a 144px x 144px Png image that will be your website bookmark on retina iOS devices.', 'beyot-framework'),
                        ),
                    )
                ),
                /**
                 * 404 Setting Section
                 * *******************************************************
                 */
                array(
                    'id' => 'section_general_group_404',
                    'title' => esc_html__('404 Page', 'beyot-framework'),
                    'type' => 'group',
                    'toggle_default' => false,
                    'fields' => array(
                        array(
                            'id'       => '404_sub_title',
                            'type'     => 'text',
                            'title'    => esc_html__('Sub Title', 'beyot-framework'),
                            'default'  => "Oops, This Page Not Be Found!"
                        ),
                        array(
                            'id'       => '404_description',
                            'type'     => 'text',
                            'title'    => esc_html__('Description', 'beyot-framework'),
                            'default'  => "We are really sorry but the page you requested is missing"
                        ),
                        array(
                            'id'       => '404_bg_image',
                            'type'     => 'image',
                            'url'      => true,
                            'title'    => esc_html__('404 Background', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => get_template_directory_uri() . '/assets/images/bg-404.jpg'
                        ),
                        array(
                            'id'       => '404_return_text_link',
                            'type'     => 'text',
                            'title'    => esc_html__('Return Text Link', 'beyot-framework'),
                            'default'  => "Go to homepage"
                        ),
                        array(
                            'id'       => '404_return_link',
                            'type'     => 'text',
                            'title'    => esc_html__('Return Link', 'beyot-framework'),
                            'subtitle' => esc_html__('If link null, link default is home page', 'beyot-framework'),
                            'default'  => ""
                        ),
                    )
                ),
            )
        );
    }
}

/**
 * Get Config Section Layout
 * *******************************************************
 */
if (!function_exists('gf_get_config_section_layout')) {
    function gf_get_config_section_layout() {
        return array(
            'id' => 'section_layout',
            'title' => esc_html__('Layout', 'beyot-framework'),
            'icon' => 'dashicons dashicons-editor-table',
            'fields' => array_merge(
                array(
                    array(
                        'id' => 'section_layout_group_general',
                        'title' => esc_html__('General', 'beyot-framework'),
                        'type' => 'group',
                        'fields' =>  array(
                            array(
                                'id' => 'section_layout_option_general',
                                'title' => esc_html__('Layout Options', 'beyot-framework'),
                                'type' => 'group',
                                'fields' =>  array(
                                    array(
                                        'id'       => 'layout_style',
                                        'type'     => 'image_set',
                                        'title'    => esc_html__('Layout Style', 'beyot-framework'),
                                        'subtitle' => esc_html__('Select the layout style', 'beyot-framework'),
                                        'desc'     => '',
                                        'options'  => gf_get_layout_style(),
                                        'default'  => 'wide'
                                    ),
                                    array(
                                        'id'       => 'body_background_mode',
                                        'type'     => 'button_set',
                                        'title'    => esc_html__('Body Background Mode', 'beyot-framework'),
                                        'subtitle' => esc_html__('Chose Background Mode', 'beyot-framework'),
                                        'desc'     => '',
                                        'options'  => array(
                                            'background' => esc_html__('Background', 'beyot-framework'),
                                            'pattern'    => esc_html__('Pattern', 'beyot-framework')
                                        ),
                                        'default'  => 'background',
                                        'required' => array('layout_style', '=', 'boxed'),
                                    ),
                                    array(
                                        'id'       => 'body_background',
                                        'type'     => 'background',
                                        'output'   => array('body'),
                                        'title'    => esc_html__('Body Background', 'beyot-framework'),
                                        'subtitle' => esc_html__('Body background (Apply for Boxed layout style).', 'beyot-framework'),
                                        'required' => array(
                                            array('layout_style', '=', 'boxed'),
                                            array('body_background_mode', '=', array('background'))
                                        ),
                                    ),
                                    array(
                                        'id'       => 'body_background_pattern',
                                        'type'     => 'image_set',
                                        'title'    => esc_html__('Background Pattern', 'beyot-framework'),
                                        'subtitle' => esc_html__('Body background pattern(Apply for Boxed layout style)', 'beyot-framework'),
                                        'desc'     => '',
                                        'height'   => '40px',
                                        'options'  => array(
                                            'pattern-1.png' => GF_PLUGIN_URL . 'assets/images/theme-options/pattern-1.png',
                                            'pattern-2.png' => GF_PLUGIN_URL . 'assets/images/theme-options/pattern-2.png',
                                            'pattern-3.png' => GF_PLUGIN_URL . 'assets/images/theme-options/pattern-3.png',
                                            'pattern-4.png' => GF_PLUGIN_URL . 'assets/images/theme-options/pattern-4.png',
                                            'pattern-5.png' => GF_PLUGIN_URL . 'assets/images/theme-options/pattern-5.png',
                                            'pattern-6.png' => GF_PLUGIN_URL . 'assets/images/theme-options/pattern-6.png',
                                            'pattern-7.png' => GF_PLUGIN_URL . 'assets/images/theme-options/pattern-7.png',
                                            'pattern-8.png' => GF_PLUGIN_URL . 'assets/images/theme-options/pattern-8.png',
                                        ),
                                        'default'  => 'pattern-1.png',
                                        'required' => array(
                                            array('layout_style', '=', 'boxed'),
                                            array('body_background_mode', '=', array('pattern'))
                                        ),
                                    ),
                                    gf_get_page_layout('layout'),
                                    array(
                                        'id' => 'sidebar_width',
                                        'title' => esc_html__('Sidebar Width', 'beyot-framework'),
                                        'type' => 'button_set',
                                        'options' => gf_get_sidebar_width(),
                                        'default' => 'small',
                                    ),
                                    array(
                                        'id'       => 'sidebar_sticky_enable',
                                        'type'     => 'button_set',
                                        'title'    => esc_html__('Sidebar Sticky', 'beyot-framework'),
                                        'subtitle' => esc_html__('Turn On this option if you want to enable sidebar sticky', 'beyot-framework'),
                                        'desc'     => '',
                                        'options'  => gf_get_toggle(),
                                        'default'  => 1
                                    ),
                                )
                            ),
                            array(
                                'id' => 'section_layout_group_main_content',
                                'title' => esc_html__('Main Content', 'beyot-framework'),
                                'type' => 'group',
                                'fields' => array(
                                    gf_get_config_sidebar_layout('sidebar_layout'),
                                    gf_get_config_sidebar('sidebar',array('sidebar_layout', '!=', 'none')),
                                    gf_get_content_padding('content_padding', array(), array('top'  => 100,'bottom' => 100))
                                )
                            ),

                            array(
                                'id' => 'section_layout_group_mobile',
                                'title' => esc_html__('Mobile', 'beyot-framework'),
                                'type' => 'group',
                                'fields' => array(
                                    gf_get_sidebar_mobile_enable('sidebar_mobile_enable', array('sidebar_layout', '!=', 'none'), 1),
                                    gf_get_sidebar_mobile_canvas('sidebar_mobile_canvas', array(
                                        array('sidebar_layout', '!=', 'none'),
                                        array('sidebar_mobile_enable', '=', '1'),
                                    ), 1),
                                    gf_get_mobile_content_padding('content_padding_mobile')
                                )
                            ),
                        )
                    ),
                ),
                gf_get_config_custom_layout()
            )
        );
    }
}

/**
 * Page Title Section
 * *******************************************************
 */
if (!function_exists('gf_get_config_section_page_title')) {
    function gf_get_config_section_page_title() {
        return array(
            'id' => 'section_page_title',
            'title' => esc_html__('Page Title', 'beyot-framework'),
            'icon' => 'dashicons dashicons-star-filled',
            'fields' => array_merge(

                array(
                    array(
                        'id' => 'section_page_title_group_general',
                        'title' => esc_html__('General', 'beyot-framework'),
                        'type' => 'group',
                        'fields' => array(
                            gf_get_page_title_enable('page_title_enable'),
                            gf_get_page_sub_title('page_sub_title',array('page_title_enable', '=', 1)),
                            gf_get_page_title_padding('page_title_padding', array('page_title_enable', '=', 1)),
                            gf_get_page_title_background_image('page_title_bg_image', array('page_title_enable', '=', 1),GF_PLUGIN_URL . 'assets/images/theme-options/page-title.jpg'),
							gf_get_page_title_background_overlay('page_title_bg_overlay', array('page_title_enable', '=', 1)),
                            gf_get_page_title_parallax('page_title_parallax', array(array('page_title_enable', '=', 1), array('page_title_bg_image[id]', '!=', ''))),
                            gf_get_breadcrumb_enable('breadcrumbs_enable', array('page_title_enable', '=', 1)),
                        )
                    )
                ),
                gf_get_config_custom_page_title()
            )
        );
    }
}

/**
 * Blog Section
 * *******************************************************
 */
if (!function_exists('gf_get_config_section_blog')) {
    function gf_get_config_section_blog() {
        return array(
            'id'     => 'section_blog',
            'title'  => esc_html__( 'Blog Setting', 'beyot-framework' ),
            'icon'   => 'dashicons dashicons-media-document',
            'fields' => array_merge(
                array(
                    array(
                        'id'     => 'blog_start',
                        'type'   => 'group',
                        'title'  => esc_html__('Blog Options', 'beyot-framework'),
                        'fields' => array(
                            array(
                                'id'       => 'post_layout',
                                'type'     => 'select',
                                'title'    => esc_html__('Post Layout', 'beyot-framework'),
                                'subtitle' => '',
                                'desc'     => '',
                                'select2' => array('allowClear' => false),
                                'options'  => gf_get_post_layout(),
                                'default'  => 'large-image'
                            ),
                            array(
                                'id'       => 'post_column',
                                'type'     => 'select',
                                'title'    => esc_html__('Post Columns', 'beyot-framework'),
                                'subtitle' => '',
                                'options'  => gf_get_post_columns(),
                                'desc'     => '',
                                'default'  => 3,
                                'select2' => array('allowClear' => false),
                                'required' => array('post_layout', 'in', array('grid','masonry')),
                            ),
                            array(
                                'id'       => 'post_paging',
                                'type'     => 'button_set',
                                'title'    => esc_html__('Post Paging', 'beyot-framework'),
                                'subtitle' => '',
                                'desc'     => '',
                                'options'  => gf_get_paging_style(),
                                'default'  => 'navigation'
                            ),
                        )
                    ),

                    array(
                        'id'     => 'single_blog_start',
                        'type'   => 'group',
                        'title'  => esc_html__('Single Blog Options', 'beyot-framework'),
                        'fields' => array(
                            array(
                                'id'       => 'single_title_enable',
                                'type'     => 'button_set',
                                'title'    => esc_html__('Post Title', 'beyot-framework'),
                                'subtitle' => esc_html__('Turn Off this option if you want to hide title on single blog', 'beyot-framework'),
                                'desc'     => '',
                                'options'  => gf_get_toggle(),
                                'default'  => 0
                            ),
                            array(
                                'id'       => 'single_tag_enable',
                                'type'     => 'button_set',
                                'title'    => esc_html__('Tags', 'beyot-framework'),
                                'subtitle' => esc_html__('Turn Off this option if you want to hide tags on single blog', 'beyot-framework'),
                                'desc'     => '',
                                'options'  => gf_get_toggle(),
                                'default'  => 1
                            ),

                            array(
                                'id'       => 'single_share_enable',
                                'type'     => 'button_set',
                                'title'    => esc_html__('Share', 'beyot-framework'),
                                'subtitle' => esc_html__('Turn Off this option if you want to hide share on single blog', 'beyot-framework'),
                                'desc'     => '',
                                'options'  => gf_get_toggle(),
                                'default'  => 1
                            ),

                            array(
                                'id'       => 'single_navigation_enable',
                                'type'     => 'button_set',
                                'title'    => esc_html__('Navigation', 'beyot-framework'),
                                'subtitle' => esc_html__('Turn Off this option if you want to hide navigation on single blog', 'beyot-framework'),
                                'desc'     => '',
                                'options'  => gf_get_toggle(),
                                'default'  => 0
                            ),
                            array(
                                'id'       => 'single_author_info_enable',
                                'type'     => 'button_set',
                                'title'    => esc_html__('Author Info', 'beyot-framework'),
                                'subtitle' => esc_html__('Turn Off this option if you want to hide author info area on single blog', 'beyot-framework'),
                                'desc'     => '',
                                'options'  => gf_get_toggle(),
                                'default'  => 0
                            ),

                            array(
                                'id'       => 'single_related_post_enable',
                                'type'     => 'button_set',
                                'title'    => esc_html__('Related Post', 'beyot-framework'),
                                'subtitle' => esc_html__('Turn Off this option if you want to hide related post area on single blog', 'beyot-framework'),
                                'desc'     => '',
                                'options'  => gf_get_toggle(),
                                'default'  => 1
                            ),

                            array(
                                'id'       => 'single_related_post_total',
                                'type'     => 'text',
                                'title'    => esc_html__('Related Post Total', 'beyot-framework'),
                                'subtitle' => esc_html__('Total record of Related Post. (Input Number Only)', 'beyot-framework'),
                                'pattern' => '[0-9]*',
                                'default'  => 6,
                                'required' => array('single_related_post_enable', '=', 1),
                            ),

                            array(
                                'id'       => 'single_related_post_column',
                                'type'     => 'select',
                                'title'    => esc_html__('Related Post Columns', 'beyot-framework'),
                                'default'  => 3,
                                'options'  => array(2 => '2', 3 => '3'),
                                'select2'  => array('allowClear' => false),
                                'required' => array('single_related_post_enable', '=', 1),
                            ),

                            array(
                                'id'       => 'single_related_post_condition',
                                'type'     => 'checkbox_list',
                                'title'    => esc_html__('Related Post Condition', 'beyot-framework'),
                                'options'  => array(
                                    'category' => esc_html__('Same Category', 'beyot-framework'),
                                ),
                                'default'  => array(
                                    'category' => '1',
                                ),
                                'required' => array('single_related_post_enable', '=', 1),
                            ),
                        )
                    ),
                ),
                array()
            )
        );
    }
}

/**
 * Get Config Section logo
 * *******************************************************
 */
if (!function_exists('gf_get_config_section_logo')) {
    function gf_get_config_section_logo() {
        return array(
            'id' => 'section_logo',
            'title' => esc_html__('Logo Setting', 'beyot-framework'),
            'icon' => 'dashicons dashicons-carrot',
            'fields' => array(
                array(
                    'id'     => 'section_logo_desktop',
                    'type'   => 'group',
                    'title'  => esc_html__('Logo Desktop', 'beyot-framework'),
                    'fields' => array(
                        array(
                            'id'       => 'logo',
                            'type'     => 'image',
                            'url'      => true,
                            'title'    => esc_html__('Logo', 'beyot-framework'),
                            'subtitle' => esc_html__('Upload your logo here.', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => trailingslashit(get_template_directory_uri()) . 'assets/images/logo.png'
                        ),
                        array(
                            'id'       => 'logo_retina',
                            'type'     => 'image',
                            'url'      => true,
                            'title'    => esc_html__('Logo Retina', 'beyot-framework'),
                            'subtitle' => esc_html__('Upload your logo retina here.', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => ''
                        ),
                        array(
                            'id'       => 'sticky_logo',
                            'type'     => 'image',
                            'url'      => true,
                            'title'    => esc_html__('Sticky Logo', 'beyot-framework'),
                            'subtitle' => esc_html__('Upload a sticky version of your logo here', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => trailingslashit(get_template_directory_uri()) . 'assets/images/logo.png'
                        ),
                        array(
                            'id'       => 'sticky_logo_retina',
                            'type'     => 'image',
                            'url'      => true,
                            'title'    => esc_html__('Sticky Logo Retina', 'beyot-framework'),
                            'subtitle' => esc_html__('Upload a sticky version of your logo retina here', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => ''
                        ),
                        array(
                            'id'      => 'logo_max_height',
                            'type'    => 'dimension',
                            'title'   => esc_html__('Logo Max Height', 'beyot-framework'),
                            'desc'    => esc_html__('You can set a max height for the logo here', 'beyot-framework'),
                            'units'   => false,
                            'width'   => false,
                            'default' => array(
                                'height' => ''
                            )
                        ),
                        array(
                            'id'             => 'logo_padding',
                            'type'           => 'spacing',
                            'mode'           => 'padding',
                            'units'          => 'px',
                            'units_extended' => 'false',
                            'title'          => esc_html__('Logo Top/Bottom Padding', 'beyot-framework'),
                            'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'beyot-framework'),
                            'desc'           => esc_html__('If you would like to override the default logo top/bottom padding, then you can do so here.', 'beyot-framework'),
                            'left'           => false,
                            'right'          => false,
                            'default'        => array(
                                'padding-top'    => '',
                                'padding-bottom' => '',
                            )
                        ),
                    )
                ),

                array(
                    'id'     => 'section-logo-mobile',
                    'type'   => 'group',
                    'title'  => esc_html__('Logo Mobile', 'beyot-framework'),
                    'fields' => array(
                        array(
                            'id'       => 'mobile_logo',
                            'type'     => 'image',
                            'url'      => true,
                            'title'    => esc_html__('Mobile Logo', 'beyot-framework'),
                            'subtitle' => esc_html__('Upload your logo here.', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => trailingslashit(get_template_directory_uri()) . 'assets/images/logo.png'
                        ),
                        array(
                            'id'       => 'mobile_logo_retina',
                            'type'     => 'image',
                            'url'      => true,
                            'title'    => esc_html__('Mobile Logo Retina', 'beyot-framework'),
                            'subtitle' => esc_html__('Upload your logo retina here.', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => ''
                        ),
                        array(
                            'id'      => 'mobile_logo_max_height',
                            'type'    => 'dimension',
                            'title'   => esc_html__('Mobile Logo Max Height', 'beyot-framework'),
                            'desc'    => esc_html__('You can set a max height for the logo mobile here', 'beyot-framework'),
                            'units'   => false,
                            'width'   => false,
                            'default' => array(
                                'height' => ''
                            )
                        ),
                        array(
                            'id'             => 'mobile_logo_padding',
                            'type'           => 'spacing',
                            'mode'           => 'padding',
                            'units'          => 'px',
                            'units_extended' => 'false',
                            'title'          => esc_html__('Logo Top/Bottom Padding', 'beyot-framework'),
                            'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'beyot-framework'),
                            'desc'           => esc_html__('If you would like to override the default logo top/bottom padding, then you can do so here.', 'beyot-framework'),
                            'left'           => false,
                            'right'          => false,
                            'default'        => array(
                                'padding-top'    => '',
                                'padding-bottom' => '',
                            )
                        )
                    )
                ),
            )
        );
    }
}

/**
 * Get Config Section Top Drawer
 * *******************************************************
 */
if (!function_exists('gf_get_config_section_top_drawer')) {
    function gf_get_config_section_top_drawer() {
        return array(
            'id' => 'section_top_drawer',
            'title' => esc_html__('Top Drawer', 'beyot-framework'),
            'icon' => 'dashicons dashicons-archive',
            'fields' => array(
                array(
                    'id' => 'top_drawer_type',
                    'title' => esc_html__('Top Drawer Mode', 'beyot-framework'),
                    'type' => 'button_set',
                    'options' => gf_get_top_drawer_mode(),
                    'default' => 'hide'
                ),
                gf_get_config_sidebar('top_drawer_sidebar', array('top_drawer_type', '!=', 'hide')),

                array(
                    'id'       => 'top_drawer_wrapper_layout',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Top Drawer Wrapper Layout', 'beyot-framework'),
                    'subtitle' => esc_html__('Select top drawer wrapper layout', 'beyot-framework'),
                    'desc'     => '',
                    'options'  => array(
                        'full'            => esc_html__('Full Width', 'beyot-framework'),
                        'container'       => esc_html__('Container', 'beyot-framework'),
                        'container-fluid' => esc_html__('Container Fluid', 'beyot-framework')
                    ),
                    'default'  => 'container',
                    'required' => array('top_drawer_type', '!=', 'hide'),
                ),

                array(
                    'id'       => 'top_drawer_hide_mobile',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Show/Hide Top Drawer on mobile', 'beyot-framework'),
                    'desc'     => '',
                    'options'  => array(
                        '1' => esc_html__('On', 'beyot-framework'),
                        '0' => esc_html__('Off', 'beyot-framework')
                    ),
                    'default'  => '1',
                    'required' => array('top_drawer_type', '!=', 'hide'),
                ),
                array(
                    'id'             => 'top_drawer_padding',
                    'type'           => 'spacing',
                    'mode'           => 'padding',
                    'units'          => 'px',
                    'units_extended' => 'false',
                    'title'          => esc_html__('Top/Bottom Padding', 'beyot-framework'),
                    'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'beyot-framework'),
                    'desc'           => esc_html__('If you would like to override the default top drawer top/bottom padding, then you can do so here.', 'beyot-framework'),
                    'left'           => false,
                    'right'          => false,
                    'default'        => array(
                        'padding-top'    => '',
                        'padding-bottom' => '',
                    ),
                    'required' => array('top_drawer_type', '!=', 'hide'),
                )
            )
        );
    }
}


/**
 * Get Config Section Top Bar
 * *******************************************************
 */
if (!function_exists('gf_get_config_section_top_bar')) {
    function gf_get_config_section_top_bar() {
        return array(
            'id' => 'section_top_bar',
            'title' => esc_html__('Top Bar', 'beyot-framework'),
            'icon' => 'dashicons dashicons-welcome-widgets-menus',
            'fields' => array(
                gf_get_config_group_top_bar('section_header_group_top_bar', esc_html__('Desktop', 'beyot-framework') ,'top_bar'),
                gf_get_config_group_top_bar('section_header_group_top_bar_mobile', esc_html__('Mobile', 'beyot-framework') ,'top_bar_mobile')
            )
        );
    }
}


/**
 * Get Config Section Header
 * *******************************************************
 */
if (!function_exists('gf_get_config_section_header')) {
    function gf_get_config_section_header() {
        return array(
            'id' => 'section_header',
            'title' => esc_html__('Header', 'beyot-framework'),
            'icon' => 'dashicons dashicons-editor-kitchensink',
            'fields' => array(
	            array(
		            'id'       => 'header_show_hide',
		            'type'     => 'button_set',
		            'title'    => esc_html__('Header Enable', 'beyot-framework'),
		            'subtitle' => esc_html__('Enable/Disable Header.', 'beyot-framework'),
		            'desc'     => '',
		            'options'  => gf_get_toggle(),
		            'default'  => '1',
	            ),
                array(
                    'id'       => 'header_responsive_breakpoint',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Header responsive breakpoint', 'beyot-framework'),
                    'subtitle' => esc_html__('Set header responsive breakpoint', 'beyot-framework'),
                    'desc'     => '',
                    'options'  => array(
                        '991' => esc_html__('Medium Devices: < 992px', 'beyot-framework'),
                        '767' => esc_html__('Tablet Portrait: < 768px', 'beyot-framework'),
                    ),
                    'default'  => '991',
                    'required' => array('header_show_hide', '=', '1'),
                ),
                array(
                    'id'     => 'section-header-desktop',
                    'type'   => 'group',
                    'title'  => esc_html__('Desktop Settings', 'beyot-framework'),
                    'required' => array('header_show_hide', '=', '1'),
                    'fields' => array(
                        array(
                            'id'       => 'header_layout',
                            'type'     => 'image_set',
                            'title'    => esc_html__('Header Layout', 'beyot-framework'),
                            'desc'     => '',
                            'options'  => array(
                                'header-1'  => GF_PLUGIN_URL . 'assets/images/theme-options/header-1.jpg',
                                'header-2'  => GF_PLUGIN_URL . 'assets/images/theme-options/header-2.jpg',
                                'header-3'  => GF_PLUGIN_URL . 'assets/images/theme-options/header-3.jpg',
                                'header-4'  => GF_PLUGIN_URL . 'assets/images/theme-options/header-4.jpg',
                            ),
                            'default'  => 'header-1'
                        ),
                        array(
                            'id'      => 'header_container_layout',
                            'type'    => 'button_set',
                            'title'   => esc_html__('Header container layout', 'beyot-framework'),
                            'options' => array(
                                'container'      => esc_html__('Container', 'beyot-framework'),
                                'container-fluid' => esc_html__('Container Fluid', 'beyot-framework'),
                            ),
                            'default' => 'container'
                        ),
                        array(
                            'id'       => 'header_float',
                            'type'     => 'button_set',
                            'title'    => esc_html__('Header Float', 'beyot-framework'),
                            'subtitle' => esc_html__('Enable/Disable Header Float.', 'beyot-framework'),
                            'desc'     => '',
                            'options'  => gf_get_toggle(),
                            'default'  => '0',
                        ),
                        array(
                            'id'       => 'header_sticky',
                            'type'     => 'button_set',
                            'title'    => esc_html__('Show/Hide Header Sticky', 'beyot-framework'),
                            'subtitle' => esc_html__('Show Hide header Sticky.', 'beyot-framework'),
                            'desc'     => '',
                            'options'  => gf_get_toggle(),
                            'default'  => '1'
                        ),
                        array(
                            'id'       => 'header_border_bottom',
                            'type'     => 'button_set',
                            'title'    => esc_html__('Header border bottom', 'beyot-framework'),
                            'subtitle' => esc_html__('Set header border bottom', 'beyot-framework'),
                            'desc'     => '',
                            'options'  => array(
                                'none'             => esc_html__('None', 'beyot-framework'),
                                'full-border'      => esc_html__('Full Border', 'beyot-framework'),
                                'container-border' => esc_html__('Container Border', 'beyot-framework'),
                            ),
                            'default'  => 'none',
                        ),
                        array(
                            'id'             => 'header_padding',
                            'type'           => 'spacing',
                            'mode'           => 'padding',
                            'units'          => 'px',
                            'units_extended' => 'false',
                            'title'          => esc_html__('Header Top/Bottom Padding', 'beyot-framework'),
                            'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'beyot-framework'),
                            'desc'           => esc_html__('If you would like to override the default header top/bottom padding, then you can do so here.', 'beyot-framework'),
                            'left'           => false,
                            'right'          => false,
                            'default'        => array(
                                'padding-top'    => '0',
                                'padding-bottom' => '0',
                            ),
                        ),
                        array(
                            'id'      => 'navigation_height',
                            'type'    => 'dimension',
                            'title'   => esc_html__('Navigation height', 'beyot-framework'),
                            'desc'    => esc_html__('Set header navigation height (px). Do not include unit. Empty to default', 'beyot-framework'),
                            'units'   => false,
                            'width'   => false,
                            'default' => array(
                                'height' => ''
                            ),
                        ),
                        array(
                            'id'      => 'navigation_spacing',
                            'type'    => 'slider',
                            'title'   => esc_html__('Navigation Spacing (px)', 'beyot-framework'),
                            'default' => '45',
                            'js_options' => array(
                                'step' => 1,
                                'min'  => 0,
                                'max'  => 100
                            )
                        ),
                    )
                ),

                //---------------------------------------------------------------
                array(
                    'id'     => 'section-header-mobile',
                    'type'   => 'group',
                    'title'  => esc_html__('Mobile Settings', 'beyot-framework'),
                    'required' => array('header_show_hide', '=', '1'),
                    'fields' => array(
                        array(
                            'id'       => 'mobile_header_layout',
                            'type'     => 'image_set',
                            'title'    => esc_html__('Header Layout', 'beyot-framework'),
                            'subtitle' => esc_html__('Select header mobile layout', 'beyot-framework'),
                            'desc'     => '',
                            'options'  => array(
                                'header-mobile-1' => GF_PLUGIN_URL . 'assets/images/theme-options/header-mobile-layout-1.png',
                                'header-mobile-2' => GF_PLUGIN_URL . 'assets/images/theme-options/header-mobile-layout-2.png',
                                'header-mobile-3' => GF_PLUGIN_URL . 'assets/images/theme-options/header-mobile-layout-3.png',
                                'header-mobile-4' => GF_PLUGIN_URL . 'assets/images/theme-options/header-mobile-layout-4.png',
                            ),
                            'default'  => 'header-mobile-1'
                        ),
                        array(
                            'id'       => 'mobile_header_menu_drop',
                            'type'     => 'button_set',
                            'title'    => esc_html__('Menu Drop Type', 'beyot-framework'),
                            'subtitle' => esc_html__('Set menu drop type for mobile header', 'beyot-framework'),
                            'desc'     => '',
                            'options'  => array(
                                'menu-drop-fly'      => esc_html__('Fly Menu', 'beyot-framework'),
                                'menu-drop-dropdown' => esc_html__('Dropdown Menu', 'beyot-framework'),
                            ),
                            'default'  => 'menu-drop-fly'
                        ),
                        array(
                            'id'       => 'mobile_header_stick',
                            'type'     => 'button_set',
                            'title'    => esc_html__('Stick Mobile Header', 'beyot-framework'),
                            'subtitle' => esc_html__('Enable Stick Mobile Header.', 'beyot-framework'),
                            'desc'     => '',
                            'options'  => array('1' => esc_html__('On', 'beyot-framework'), '0' => esc_html__('Off', 'beyot-framework')),
                            'default'  => '0'
                        ),
                        array(
                            'id'       => 'mobile_header_search_box',
                            'type'     => 'button_set',
                            'title'    => esc_html__('Search Box', 'beyot-framework'),
                            'subtitle' => esc_html__('Enable Search Box.', 'beyot-framework'),
                            'desc'     => '',
                            'options'  => array('1' => esc_html__('Show', 'beyot-framework'), '0' => esc_html__('Hide', 'beyot-framework')),
                            'default'  => '1'
                        ),
                        array(
                            'id'       => 'mobile_header_login',
                            'type'     => 'button_set',
                            'title'    => esc_html__('Login & Register', 'beyot-framework'),
                            'subtitle' => esc_html__('Enable Login & Register', 'beyot-framework'),
                            'desc'     => '',
                            'options'  => array('1' => esc_html__('Show', 'beyot-framework'), '0' => esc_html__('Hide', 'beyot-framework')),
                            'default'  => '1'
                        ),
                        array(
                            'id'      => 'mobile_header_border_bottom',
                            'type'    => 'button_set',
                            'title'   => esc_html__('Mobile header border bottom', 'beyot-framework'),
                            'options' => array(
                                'none'             => esc_html__('None', 'beyot-framework'),
                                'full-border'      => esc_html__('Full Border', 'beyot-framework'),
                                'container-border' => esc_html__('Container Border', 'beyot-framework'),
                            ),
                            'default' => 'none',
                        ),
                    )
                ),
            )
        );
    }
}

/**
 * Get Config Section Header Customize
 * *******************************************************
 */
if (!function_exists('gf_get_config_section_header_customize')) {
    function gf_get_config_section_header_customize() {
        return array(
            'id' => 'section_header_customize',
            'title' => esc_html__('Header Customize', 'beyot-framework'),
            'icon' => 'dashicons dashicons-editor-kitchensink',
            'fields' => array(
                array(
                    'id'       => 'section-header-customize-left',
                    'type'     => 'group',
                    'title'    => esc_html__('Header Customize Left', 'beyot-framework'),
                    'required' => array('header_layout', '=', 'header-2'),
                    'fields' => array(
                        array(
                            'id'      => 'header_customize_left',
                            'type'    => 'sortable',
                            'title'   => 'Header customize left',
                            'desc'    => 'Organize how you want the layout to appear on the header left',
                            'options' => array(
                                'search' => esc_html__('Search', 'beyot-framework'),
                                'sidebar'     => esc_html__('Sidebar', 'beyot-framework'),
                                'custom-text' => esc_html__('Custom Text', 'beyot-framework'),
                            )
                        ),
                        array(
                            'id'      => 'header_customize_left_search',
                            'type'    => 'button_set',
                            'title'   => esc_html__('Search Type', 'beyot-framework'),
                            'default' => 'button',
                            'options' => array(
                                'button'           => esc_html__('Button', 'beyot-framework'),
                                'box'              => esc_html__('Box', 'beyot-framework'),
                            ),
                            'required' => array('header_customize_left', 'contain', 'search')
                        ),
                        array(
                            'id'       => 'header_customize_left_sidebar',
                            'type'     => 'selectize',
                            'allow_clear' => true,
                            'title'    => esc_html__('Sidebar', 'beyot-framework'),
                            'subtitle' => esc_html__('Choose the sidebar for header right customize', 'beyot-framework'),
                            'data'     => 'sidebar',
                            'placeholder' => esc_html__('Select Sidebar', 'beyot-framework'),
                            'default'  => '',
                            'required' => array('header_customize_left', 'contain', 'sidebar')
                        ),
                        array(
                            'id'       => 'header_customize_left_text',
                            'type'     => 'ace_editor',
                            'mode'     => 'html',
                            'theme'    => 'monokai',
                            'title'    => esc_html__('Custom Text Content', 'beyot-framework'),
                            'subtitle' => esc_html__('Add Content for Custom Text', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => '',
                            'options'  => array('minLines' => 5, 'maxLines' => 60),
                            'required' => array('header_customize_left', 'contain', 'custom-text')
                        ),
                        array(
                            'id'      => 'header_customize_left_spacing',
                            'type'    => 'slider',
                            'title'   => esc_html__('Navigation Item Spacing (px)', 'beyot-framework'),
                            'default' => '13',
                            'js_options' => array(
                                'step' => 1,
                                'min'  => 0,
                                'max'  => 100
                            )
                        ),
                        array(
                            'id'       => 'header_customize_left_css_class',
                            'type'     => 'text',
                            'title'    => esc_html__('Custom CSS Class', 'beyot-framework'),
                            'subtitle' => esc_html__('Add custom css class', 'beyot-framework'),
                            'default'  => '',
                        ),
                    )
                ),
                array(
                    'id'       => 'section-header-customize-right',
                    'type'     => 'group',
                    'title'    => esc_html__('Header Customize Right', 'beyot-framework'),
                    'required' => array('header_layout', 'in', array('header-2','header-3')),
                    'fields' => array(
                        array(
                            'id'      => 'header_customize_right',
                            'type'    => 'sortable',
                            'title'   => 'Header customize right',
                            'desc'    => 'Organize how you want the layout to appear on the header right',
                            'options' => array(
                                'search'        => esc_html__('Search', 'beyot-framework'),
                                'sidebar'       => esc_html__('Sidebar', 'beyot-framework'),
                                'custom-text'   => esc_html__('Custom Text', 'beyot-framework'),
                            )
                        ),
                        array(
                            'id'      => 'header_customize_right_search',
                            'type'    => 'button_set',
                            'title'   => esc_html__('Search Type', 'beyot-framework'),
                            'default' => 'button',
                            'options' => array(
                                'button'           => esc_html__('Button', 'beyot-framework'),
                                'box'              => esc_html__('Box', 'beyot-framework'),
                            ),
                            'required' => array('header_customize_right', 'contain', 'search')
                        ),
                        array(
                            'id'       => 'header_customize_right_sidebar',
                            'type'     => 'selectize',
                            'allow_clear' => true,
                            'title'    => esc_html__('Sidebar', 'beyot-framework'),
                            'subtitle' => esc_html__('Choose the sidebar for header right customize', 'beyot-framework'),
                            'data'     => 'sidebar',
                            'placeholder' => esc_html__('Select Sidebar', 'beyot-framework'),
                            'default'  => '',
                            'required' => array('header_customize_right', 'contain', 'sidebar')
                        ),
                        array(
                            'id'       => 'header_customize_right_text',
                            'type'     => 'ace_editor',
                            'mode'     => 'html',
                            'theme'    => 'monokai',
                            'title'    => esc_html__('Custom Text Content', 'beyot-framework'),
                            'subtitle' => esc_html__('Add Content for Custom Text', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => '',
                            'options'  => array('minLines' => 5, 'maxLines' => 60),
                            'required' => array('header_customize_right', 'contain', 'custom-text')
                        ),
                        array(
                            'id'      => 'header_customize_right_spacing',
                            'type'    => 'slider',
                            'title'   => esc_html__('Navigation Item Spacing (px)', 'beyot-framework'),
                            'default' => '13',
                            'js_options' => array(
                                'step' => 1,
                                'min'  => 0,
                                'max'  => 100
                            )
                        ),
                        array(
                            'id'       => 'header_customize_right_css_class',
                            'type'     => 'text',
                            'title'    => esc_html__('Custom CSS Class', 'beyot-framework'),
                            'subtitle' => esc_html__('Add custom css class', 'beyot-framework'),
                            'default'  => '',
                        ),
                    )
                ),

                array(
                    'id'     => 'section-header-customize-nav',
                    'type'   => 'group',
                    'title'  => esc_html__('Header Customize Navigation', 'beyot-framework'),
                    'fields' => array(
                        array(
                            'id'      => 'header_customize_nav',
                            'type'    => 'sortable',
                            'title'   =>  esc_html__('Header customize navigation', 'beyot-framework'),
                            'desc'    => esc_html__('Organize how you want the layout to appear on the header navigation', 'beyot-framework'),
                            'options' => array(
                                'search'        => esc_html__('Search', 'beyot-framework'),
                                'sidebar'       => esc_html__('Sidebar', 'beyot-framework'),
                                'custom-text'   => esc_html__('Custom Text', 'beyot-framework'),
                            )
                        ),
                        array(
                            'id'      => 'header_customize_nav_search',
                            'type'    => 'button_set',
                            'title'   => esc_html__('Search Type', 'beyot-framework'),
                            'default' => 'button',
                            'options' => array(
                                'button'           => esc_html__('Button', 'beyot-framework'),
                                'box'              => esc_html__('Box', 'beyot-framework'),
                            ),
                            'required' => array('header_customize_nav', 'contain', 'search')
                        ),
                        array(
                            'id'       => 'header_customize_nav_sidebar',
                            'type'     => 'selectize',
                            'allow_clear' => true,
                            'title'    => esc_html__('Sidebar', 'beyot-framework'),
                            'placeholder' => esc_html__('Select Sidebar', 'beyot-framework'),
                            'subtitle' => esc_html__('Choose the sidebar for header customize navigation', 'beyot-framework'),
                            'data'     => 'sidebar',
                            'default'  => '',
                            'required' => array('header_customize_nav', 'contain', 'sidebar')
                        ),
                        array(
                            'id'       => 'header_customize_nav_text',
                            'type'     => 'ace_editor',
                            'mode'     => 'html',
                            'theme'    => 'monokai',
                            'title'    => esc_html__('Custom Text Content', 'beyot-framework'),
                            'subtitle' => esc_html__('Add Content for Custom Text', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => '',
                            'options'  => array('minLines' => 5, 'maxLines' => 60),
                            'required' => array('header_customize_nav', 'contain', 'custom-text')
                        ),
                        array(
                            'id'      => 'header_customize_nav_spacing',
                            'type'    => 'slider',
                            'title'   => esc_html__('Navigation Item Spacing (px)', 'beyot-framework'),
                            'default' => '13',
                            'js_options' => array(
                                'step' => 1,
                                'min'  => 0,
                                'max'  => 100
                            )
                        ),
                        array(
                            'id'       => 'header_customize_nav_css_class',
                            'type'     => 'text',
                            'title'    => esc_html__('Custom CSS Class', 'beyot-framework'),
                            'subtitle' => esc_html__('Add custom css class', 'beyot-framework'),
                            'default'  => '',
                        )
                    )
                )
            )
        );
    }
}

/**
 * Get Config Section Footer
 * *******************************************************
 */
if (!function_exists('gf_get_config_section_footer')){
    function gf_get_config_section_footer() {
        return array(
            'id' => 'section_footer',
            'title' => esc_html__('Footer', 'beyot-framework'),
            'icon' => 'dashicons dashicons-networking',
            'fields' => array(
                array(
                    'id'       => 'set_footer_custom',
                    'type'     => 'selectize',
                    'allow_clear' => true,
                    'title'    => esc_html__('Custom Footer', 'beyot-framework'),
                    'placeholder' => esc_html__( 'Select Custom Footer', 'beyot-framework' ),
                    'desc'     => esc_html__('Select one to apply to the page footer', 'beyot-framework'),
                    'data'     => 'post',
                    'default' => '',
                    'data_args' => array(
                        'post_type' => 'gf_footer',
                        'posts_per_page' => -1,
                        'post_status' => 'publish'
                    ),
                ),
                array(
                    'id'       => 'footer_show_hide',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Show/Hide Footer', 'beyot-framework'),
                    'options'  => gf_get_toggle(),
                    'required' => array('set_footer_custom', '=', ''),
                    'default'  => 1
                ),
                array(
                    'id'     => 'section_footer_group_general',
                    'type'   => 'group',
                    'title'  => esc_html__('General', 'beyot-framework'),
                    'required' => array(
                        array(
                            array('set_footer_custom', '!=', ''),
                            array('footer_show_hide', '=', '1')
                        )
                    ),
                    'fields' => array(
                        array(
                            'id'       => 'footer_container_layout',
                            'type'     => 'button_set',
                            'title'    => esc_html__('Footer Container Layout', 'beyot-framework'),
                            'subtitle' => esc_html__('Select Footer Container Layout', 'beyot-framework'),
                            'desc'     => '',
                            'options'  => array(
                                'full'            => esc_html__('Full Width', 'beyot-framework'),
                                'container-fluid' => esc_html__('Container Fluid', 'beyot-framework'),
                                'container'       => esc_html__('Container', 'beyot-framework')
                            ),
                            'default'  => 'container'
                        ),
                        array(
                            'id'       => 'footer_parallax',
                            'type'     => 'button_set',
                            'title'    => esc_html__('Footer Parallax', 'beyot-framework'),
                            'subtitle' => esc_html__('Enable Footer Parallax', 'beyot-framework'),
                            'desc'     => '',
                            'options'  => array(
                                '1' => esc_html__('Enable', 'beyot-framework'),
                                '0' => esc_html__('Disable', 'beyot-framework')
                            ),
                            'default'  => '0'
                        ),
                        array(
                            'id'       => 'footer_bg_image',
                            'type'     => 'image',
                            'url'      => true,
                            'title'    => esc_html__('Background image', 'beyot-framework'),
                            'subtitle' => esc_html__('Upload footer background image here', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => '',
                        ),
                        array(
                            'id'       => 'footer_bg_image_apply_for',
                            'type'     => 'button_set',
                            'title'    => esc_html__('Footer Image apply for', 'beyot-framework'),
                            'subtitle' => esc_html__('Select region apply for footer image', 'beyot-framework'),
                            'desc'     => '',
                            'options'  => array(
                                'footer.main-footer-wrapper'            => esc_html__('Footer Wrapper', 'beyot-framework'),
                                'footer .main-footer' => esc_html__('Main Footer', 'beyot-framework'),
                            ),
                            'default'  => 'footer.main-footer-wrapper',
                            'required' => array('footer_bg_image', '!=', ''),
                        ),
                        array(
                            'id'       => 'footer_css_class',
                            'type'     => 'text',
                            'title'    => esc_html__('Css class', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => '',
                        )
                    )
                ),

                //--------------------------------------------------------------------------------
                array(
                    'id'     => 'section-footer-main-settings',
                    'type'   => 'group',
                    'title'  => esc_html__('Main Footer', 'beyot-framework'),
                    'required' => array(
                        array('set_footer_custom', '=', ''),
                        array('footer_show_hide', '=', '1')
                    ),
                    'fields' => array(
                        //--------------------------------------------------------------------------------
                        array(
                            'id'     => 'section-footer-above-settings',
                            'type'   => 'group',
                            'title'  => esc_html__('Above Footer', 'beyot-framework'),
                            'required' => array('footer_show_hide', '=', '1'),
                            'fields' => array(
                                array(
                                    'id'       => 'set_footer_above_custom',
                                    'type'     => 'selectize',
                                    'allow_clear' => true,
                                    'placeholder' => esc_html__( 'Select Above Footer', 'beyot-framework' ),
                                    'title'    => esc_html__('Set Above Footer', 'beyot-framework'),
                                    'data'     => 'post',
                                    'default' => '',
                                    'data_args' => array(
                                        'post_type' => 'gf_footer',
                                        'posts_per_page' => -1,
                                        'post_status' => 'publish'
                                    )
                                ),
                            )
                        ),
                        array(
                            'id'       => 'footer_layout',
                            'type'     => 'image_set',
                            'title'    => esc_html__('Layout', 'beyot-framework'),
                            'subtitle' => esc_html__('Select the footer column layout.', 'beyot-framework'),
                            'desc'     => '',
                            'options'  => array(
                                'footer-1' => GF_PLUGIN_URL . 'assets/images/theme-options/footer-layout-1.jpg',
                                'footer-2' => GF_PLUGIN_URL . 'assets/images/theme-options/footer-layout-2.jpg',
                                'footer-3' => GF_PLUGIN_URL . 'assets/images/theme-options/footer-layout-3.jpg',
                                'footer-4' => GF_PLUGIN_URL . 'assets/images/theme-options/footer-layout-4.jpg',
                                'footer-5' => GF_PLUGIN_URL . 'assets/images/theme-options/footer-layout-5.jpg',
                                'footer-6' => GF_PLUGIN_URL . 'assets/images/theme-options/footer-layout-6.jpg',
                                'footer-7' => GF_PLUGIN_URL . 'assets/images/theme-options/footer-layout-7.jpg',
                                'footer-8' => GF_PLUGIN_URL . 'assets/images/theme-options/footer-layout-8.jpg',
                                'footer-9' => GF_PLUGIN_URL . 'assets/images/theme-options/footer-layout-9.jpg',
                            ),
                            'default'  => 'footer-1',
                            'required' => array('footer_show_hide', '=', 1)
                        ),

                        array(
                            'id'       => 'footer_sidebar_1',
                            'type'     => 'selectize',
                            'allow_clear' => true,
                            'title'    => esc_html__('Sidebar 1', 'beyot-framework'),
                            'subtitle' => esc_html__('Choose the default footer sidebar 1', 'beyot-framework'),
                            'data'     => 'sidebar',
                            'placeholder' => esc_html__('Select Sidebar', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => 'footer-1',
                            'required' => array('footer_show_hide', '=', 1)
                        ),

                        array(
                            'id'       => 'footer_sidebar_2',
                            'type'     => 'selectize',
                            'allow_clear' => true,
                            'title'    => esc_html__('Sidebar 2', 'beyot-framework'),
                            'subtitle' => esc_html__('Choose the default footer sidebar 2', 'beyot-framework'),
                            'data'     => 'sidebar',
                            'placeholder' => esc_html__('Select Sidebar', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => 'footer-2',
                            'required' => array(
                                array('footer_layout', '!=', 'footer-9'),
                                array('footer_show_hide', '=', 1)
                            )
                        ),

                        array(
                            'id'       => 'footer_sidebar_3',
                            'type'     => 'selectize',
                            'allow_clear' => true,
                            'title'    => esc_html__('Sidebar 3', 'beyot-framework'),
                            'subtitle' => esc_html__('Choose the default footer sidebar 3', 'beyot-framework'),
                            'data'     => 'sidebar',
                            'placeholder' => esc_html__('Select Sidebar', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => 'footer-3',
                            'required' => array(
                                array('footer_layout', 'in', array('footer-1', 'footer-2', 'footer-3', 'footer-5', 'footer-8')),
                                array('footer_show_hide', '=', 1)
                            )
                        ),

                        array(
                            'id'       => 'footer_sidebar_4',
                            'type'     => 'selectize',
                            'allow_clear' => true,
                            'title'    => esc_html__('Sidebar 4', 'beyot-framework'),
                            'subtitle' => esc_html__('Choose the default footer sidebar 4', 'beyot-framework'),
                            'data'     => 'sidebar',
                            'placeholder' => esc_html__('Select Sidebar', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => 'footer-4',
                            'required' => array(
                                array('footer_layout', '=', 'footer-1'),
                                array('footer_show_hide', '=', 1)
                            )
                        ),

                        array(
                            'id'       => 'collapse_footer',
                            'type'     => 'button_set',
                            'title'    => esc_html__('Collapse footer on mobile device', 'beyot-framework'),
                            'subtitle' => esc_html__('Enable collapse footer', 'beyot-framework'),
                            'desc'     => '',
                            'options'  => array(
                                '1' => esc_html__('On', 'beyot-framework'),
                                '0' => esc_html__('Off', 'beyot-framework')
                            ),
                            'default'  => '0',
                            'required' => array('footer_show_hide', '=', 1)
                        ),
                        array(
                            'id'             => 'footer_padding',
                            'type'           => 'spacing',
                            'mode'           => 'padding',
                            'units'          => 'px',
                            'units_extended' => 'false',
                            'title'          => esc_html__('Footer Top/Bottom Padding', 'beyot-framework'),
                            'subtitle'       => esc_html__('This must be numeric (no px)', 'beyot-framework'),
                            'desc'           => esc_html__('If you would like to override the default footer top/bottom padding, then you can do so here.', 'beyot-framework'),
                            'left'           => false,
                            'right'          => false,
                            'default'        => array(
                                'padding-top'    => '60',
                                'padding-bottom' => '60',
                            ),
                            'required' => array('footer_show_hide', '=', 1)
                        ),
                        array(
                            'id'      => 'footer_border_top',
                            'type'    => 'button_set',
                            'title'   => esc_html__('Footer border top', 'beyot-framework'),
                            'options' => array(
                                'none'             => esc_html__('None', 'beyot-framework'),
                                'full-border'      => esc_html__('Full Border', 'beyot-framework'),
                                'container-border' => esc_html__('Container Border', 'beyot-framework'),
                            ),
                            'default' => 'none',
                            'required' => array('footer_show_hide', '=', 1)
                        ),
                    )
                ),

                //--------------------------------------------------------------------------------
                array(
                    'id'     => 'section-footer-bottom-settings',
                    'type'   => 'group',
                    'title'  => esc_html__('Bottom Bar Settings', 'beyot-framework'),
                    'required' => array('set_footer_custom', '=', ''),
                    'fields' => array(
                        array(
                            'id'       => 'bottom_bar_visible',
                            'type'     => 'button_set',
                            'title'    => esc_html__('Show/Hide Bottom Bar', 'beyot-framework'),
                            'options'  => gf_get_toggle(),
                            'default'  => 1
                        ),
                        array(
                            'id'       => 'bottom_bar_layout',
                            'type'     => 'image_set',
                            'title'    => esc_html__('Bottom bar Layout', 'beyot-framework'),
                            'subtitle' => esc_html__('Select the bottom bar column layout.', 'beyot-framework'),
                            'desc'     => '',
                            'options'  => array(
                                'bottom-bar-1' => GF_PLUGIN_URL . 'assets/images/theme-options/bottom-bar-layout-1.jpg',
                                'bottom-bar-2' => GF_PLUGIN_URL . 'assets/images/theme-options/bottom-bar-layout-2.jpg',
                                'bottom-bar-3' => GF_PLUGIN_URL . 'assets/images/theme-options/bottom-bar-layout-3.jpg',
                                'bottom-bar-4' => GF_PLUGIN_URL . 'assets/images/theme-options/bottom-bar-layout-4.jpg',
                            ),
                            'default'  => 'bottom-bar-1',
                            'required' => array('bottom_bar_visible', '=', 1)
                        ),

                        array(
                            'id'       => 'bottom_bar_left_sidebar',
                            'type'     => 'selectize',
                            'allow_clear' => true,
                            'title'    => esc_html__('Bottom Left Sidebar', 'beyot-framework'),
                            'subtitle' => esc_html__('Choose the default bottom left sidebar', 'beyot-framework'),
                            'data'     => 'sidebar',
                            'placeholder' => esc_html__('Select Sidebar', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => 'bottom_bar_left',
                            'required' => array('bottom_bar_visible', '=', 1)
                        ),
                        array(
                            'id'       => 'bottom_bar_right_sidebar',
                            'type'     => 'selectize',
                            'allow_clear' => true,
                            'title'    => esc_html__('Bottom Right Sidebar', 'beyot-framework'),
                            'subtitle' => esc_html__('Choose the default bottom right sidebar', 'beyot-framework'),
                            'data'     => 'sidebar',
                            'placeholder' => esc_html__('Select Sidebar', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => 'bottom_bar_right',
                            'required' => array(
                                array('bottom_bar_layout', '!=', 'bottom-bar-4'),
                                array('bottom_bar_visible', '=', 1)
                            ),
                        ),
                        array(
                            'id'             => 'bottom_bar_padding',
                            'type'           => 'spacing',
                            'mode'           => 'padding',
                            'units'          => 'px',
                            'units_extended' => 'false',
                            'title'          => esc_html__('Bottom Bar Top/Bottom Padding', 'beyot-framework'),
                            'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'beyot-framework'),
                            'desc'           => esc_html__('If you would like to override the default bottom bar top/bottom padding, then you can do so here.', 'beyot-framework'),
                            'left'           => false,
                            'right'          => false,
                            'default'        => array(
                                'padding-top'    => '25',
                                'padding-bottom' => '25',
                            ),
                            'required' => array('bottom_bar_visible', '=', 1)
                        ),
                        array(
                            'id'      => 'bottom_bar_border_top',
                            'type'    => 'button_set',
                            'title'   => esc_html__('Bottom bar border top', 'beyot-framework'),
                            'options' => array(
                                'none'             => esc_html__('None', 'beyot-framework'),
                                'full-border'      => esc_html__('Full Border', 'beyot-framework'),
                                'container-border' => esc_html__('Container Border', 'beyot-framework'),
                            ),
                            'default' => 'none',
                            'required' => array('bottom_bar_visible', '=', 1)
                        )
                    )
                ),
            )
        );
    }
}

/**
 * Get Config Section Theme Colors
 * *******************************************************
 */
if (!function_exists('gf_get_config_section_theme_colors')){
    function gf_get_config_section_theme_colors() {
        return array(
            'id' => 'section_theme_colors',
            'title' => esc_html__('Theme Colors', 'beyot-framework'),
            'subtitle'   => esc_html__('If you change value in this section, you must "Save & Generate CSS"', 'beyot-framework'),
            'icon' => 'dashicons dashicons-art',
            'fields' => array(
                array(
                    'id'     => 'section-theme-color-general',
                    'type'   => 'group',
                    'title'  => esc_html__('General', 'beyot-framework'),
                    'fields' => array(
                        array(
                            'id'       => 'accent_color',
                            'type'     => 'color',
                            'alpha'   => true,
                            'title'    => esc_html__('Accent Color', 'beyot-framework'),
                            'default'  => '#fb6a19',
                            'validate' => 'color',
                        ),
                        array(
                            'id'       => 'foreground_accent_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Foreground Accent Color', 'beyot-framework'),
                            'default'  => '#fff',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                        array(
                            'id'       => 'text_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Text Color', 'beyot-framework'),
                            'default'  => '#787878',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),

                        array(
                            'id'       => 'border_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Border Color', 'beyot-framework'),
                            'default'  => '#eeeeee',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                        array(
                            'id'       => 'heading_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Heading Color', 'beyot-framework'),
                            'default'  => '#222222',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                    )
                ),
                //--------------------------------------------------------------------
                array(
                    'id'     => 'section-theme-color-top-drawer',
                    'type'   => 'group',
                    'title'  => esc_html__('Top Drawer', 'beyot-framework'),
                    'fields' => array(
                        array(
                            'id'       => 'top_drawer_bg_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Top drawer background color', 'beyot-framework'),
                            'default'  => '#2f2f2f',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),

                        array(
                            'id'       => 'top_drawer_text_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Top drawer text color', 'beyot-framework'),
                            'default'  => '#c5c5c5',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                    )
                ),

                //--------------------------------------------------------------------
                array(
                    'id'     => 'section-theme-color-header-color',
                    'type'   => 'group',
                    'title'  => esc_html__('Header', 'beyot-framework'),
                    'fields' => array(
                        array(
                            'id'       => 'header_bg_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Header background color', 'beyot-framework'),
                            'default'  => '#fff',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                        array(
                            'id'       => 'header_text_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Header text color', 'beyot-framework'),
                            'default'  => '#aaaaaa',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                        array(
                            'id'       => 'header_border_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Header border color', 'beyot-framework'),
                            'default'  => '#eee',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                    )
                ),

                //--------------------------------------------------------------------
                array(
                    'id'     => 'section-theme-color-top-bar',
                    'type'   => 'group',
                    'title'  => esc_html__('Top Bar', 'beyot-framework'),
                    'fields' => array(
                        array(
                            'id'       => 'top_bar_bg_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Top bar background color', 'beyot-framework'),
                            'default'  => '#fff',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                        array(
                            'id'       => 'top_bar_text_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Top bar text color', 'beyot-framework'),
                            'default'  => '#222222',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                        array(
                            'id'       => 'top_bar_border_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Top bar border color', 'beyot-framework'),
                            'default'  => '#eee',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                    )
                ),

                //--------------------------------------------------------------------
                array(
                    'id'     => 'section-theme-color-navigation-color',
                    'type'   => 'group',
                    'title'  => esc_html__('Navigation', 'beyot-framework'),
                    'fields' => array(
                        array(
                            'id'       => 'navigation_bg_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Navigation background color', 'beyot-framework'),
                            'default'  => '#fff',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                        array(
                            'id'       => 'navigation_text_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Navigation text color', 'beyot-framework'),
                            'default'  => '#222222',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                        array(
                            'id'       => 'navigation_text_color_hover',
                            'type'     => 'color',
                            'title'    => esc_html__('Navigation text hover color', 'beyot-framework'),
                            'default'  => '#fb6a19',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                    )
                ),

                //--------------------------------------------------------------------
                array(
                    'id'     => 'section-theme-color-header-mobile',
                    'type'   => 'group',
                    'title'  => esc_html__('Header Mobile Color', 'beyot-framework'),
                    'fields' => array(
                        array(
                            'id'       => 'top_bar_mobile_bg_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Top bar background color', 'beyot-framework'),
                            'default'  => '#fff',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                        array(
                            'id'       => 'top_bar_mobile_text_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Top bar text color', 'beyot-framework'),
                            'default'  => '#111',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                        array(
                            'id'       => 'top_bar_mobile_border_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Top bar border bottom color', 'beyot-framework'),
                            'default'  => '#eee',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                        array(
                            'id'       => 'header_mobile_bg_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Header background color', 'beyot-framework'),
                            'default'  => '#fff',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                        array(
                            'id'       => 'header_mobile_text_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Header text color', 'beyot-framework'),
                            'default'  => '#111',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                        array(
                            'id'       => 'header_mobile_border_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Header border bottom color', 'beyot-framework'),
                            'default'  => '#eee',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                    )
                ),

                //--------------------------------------------------------------------
                array(
                    'id'     => 'section-theme-color-footer-color',
                    'type'   => 'group',
                    'title'  => esc_html__('Footer', 'beyot-framework'),
                    'fields' => array(
                        array(
                            'id'       => 'footer_bg_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Footer background color', 'beyot-framework'),
                            'default'  => '#fff',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                        array(
                            'id'       => 'footer_text_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Footer text color', 'beyot-framework'),
                            'default'  => '#4a4a4a',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                        array(
                            'id'       => 'footer_widget_title_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Footer widget title color', 'beyot-framework'),
                            'default'  => '#111',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                        array(
                            'id'       => 'footer_border_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Footer border color', 'beyot-framework'),
                            'default'  => '#eee',
                            'validate' => 'color',
                            'alpha'   => true,
                        )
                    )
                ),

                array(
                    'id'     => 'section-theme-color-bottom-bar-color',
                    'type'   => 'group',
                    'title'  => esc_html__('Bottom Bar', 'beyot-framework'),
                    'fields' => array(
                        array(
                            'id'       => 'bottom_bar_bg_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Bottom bar background color', 'beyot-framework'),
                            'default'  => '#1b2127',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                        array(
                            'id'       => 'bottom_bar_text_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Bottom bar text color', 'beyot-framework'),
                            'default'  => '#FFF',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                        array(
                            'id'       => 'bottom_bar_border_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Bottom bar border color', 'beyot-framework'),
                            'default'  => '#eee',
                            'validate' => 'color',
                            'alpha'   => true,
                        ),
                    )
                )
            )
        );
    }
}

/**
 * Get Config Section Font Options
 * *******************************************************
 */

if (!function_exists('gf_get_config_section_font_options')) {
	function gf_get_config_section_font_options() {
		if (!class_exists('GSF_SmartFramework')) {
			return gf_get_config_section_font_options_new_version();
		}
		return gf_get_config_section_font_options_old_version();
	}
}

if (!function_exists('gf_get_config_section_font_options_new_version')) {
	function gf_get_config_section_font_options_new_version()
	{
		return array(
			'id'       => 'section_custom_font',
			'title'    => esc_html__('Font Options', 'beyot-framework'),
			'subtitle' => esc_html__('If you change value in this section, you must "Save & Generate CSS"', 'beyot-framework'),
			'icon'     => 'dashicons dashicons-editor-textcolor',
			'fields'   => array(
				array(
					'id'          => 'body_font',
					'type'        => 'typography',
					'title'       => esc_html__('Body Font', 'beyot-framework'),
					'subtitle'    => esc_html__('Specify the body font properties.', 'beyot-framework'),
					'font_size'   => true,
					'font_variants' => true,
					'default'     => array(
						'font_family' => "Poppins",
						'font_weight' => '400',
						'font_size'   => '14'
					),
				),
				array(
					'id'          => 'secondary_font',
					'type'        => 'typography',
					'title'       => esc_html__('Secondary Font', 'beyot-framework'),
					'subtitle'    => esc_html__('Specify the Secondary font properties.', 'beyot-framework'),
					'font_size'   => true,
					'font_variants' => true,
					'default'     => array(
						'font_family' => "Poppins",
						'font_weight' => '400',
						'font_size'   => '14'
					),
				),

				array(
					'id'          => 'h1_font',
					'type'        => 'typography',
					'title'       => esc_html__('H1 Font', 'beyot-framework'),
					'subtitle'    => esc_html__('Specify the H1 font properties.', 'beyot-framework'),
					'font_size'   => true,
					'font_variants' => true,
					'default'     => array(
						'font_family' => "Poppins",
						'font_weight' => '700',
						'font_size'   => '64',
					),
				),
				array(
					'id'          => 'h2_font',
					'type'        => 'typography',
					'title'       => esc_html__('H2 Font', 'beyot-framework'),
					'subtitle'    => esc_html__('Specify the H2 font properties.', 'beyot-framework'),
					'font_size'   => true,
					'font_variants' => true,
					'default'     => array(
						'font_family' => "Poppins",
						'font_weight' => '700',
						'font_size'   => '48',
					),
				),
				array(
					'id'          => 'h3_font',
					'type'        => 'typography',
					'title'       => esc_html__('H3 Font', 'beyot-framework'),
					'subtitle'    => esc_html__('Specify the H3 font properties.', 'beyot-framework'),
					'font_size'   => true,
					'font_variants' => true,
					'default'     => array(
						'font_size'   => '32',
						'font_family' => "Poppins",
						'font_weight' => '700',
					),
				),
				array(
					'id'          => 'h4_font',
					'type'        => 'typography',
					'title'       => esc_html__('H4 Font', 'beyot-framework'),
					'subtitle'    => esc_html__('Specify the H4 font properties.', 'beyot-framework'),
					'font_size'   => true,
					'font_variants' => true,
					'default'     => array(
						'font_size'   => '21',
						'font_family' => "Poppins",
						'font_weight' => '700',
					),
				),
				array(
					'id'          => 'h5_font',
					'type'        => 'typography',
					'title'       => esc_html__('H5 Font', 'beyot-framework'),
					'subtitle'    => esc_html__('Specify the H5 font properties.', 'beyot-framework'),
					'font_size'   => true,
					'font_variants' => true,
					'default'     => array(
						'font_size'   => '18',
						'font_family' => "Poppins",
						'font_weight' => '700',
					),
				),
				array(
					'id'          => 'h6_font',
					'type'        => 'typography',
					'title'       => esc_html__('H6 Font', 'beyot-framework'),
					'subtitle'    => esc_html__('Specify the H6 font properties.', 'beyot-framework'),
					'font_size'   => true,
					'font_variants' => true,
					'default'     => array(
						'font_size'   => '16',
						'font_family' => "Poppins",
						'font_weight' => '400',
						'font_style' => '',
					),
				),
			)
		);
	}
}

if (!function_exists('gf_get_config_section_font_options_old_version')) {
    function gf_get_config_section_font_options_old_version() {
        return array(
            'id'       => 'section_custom_font',
            'title'    => esc_html__( 'Font Options', 'beyot-framework' ),
            'subtitle' => esc_html__( 'If you change value in this section, you must "Save & Generate CSS"', 'beyot-framework' ),
            'icon'     => 'dashicons dashicons-editor-textcolor',
            'fields'   => array(
                array(
                    'id'             => 'body_font',
                    'type'           => 'font',
                    'title'          => esc_html__( 'Body Font', 'beyot-framework' ),
                    'subtitle'       => esc_html__( 'Specify the body font properties.', 'beyot-framework' ),
                    'font_size'    => true,
                    'font_weight'  => true,
                    'default'        => array(
                        'font_family' => "'Poppins'",
                        'font_weight' => '300',
                        'font_size'   => '14'
                    ),
                ),
                array(
                    'id'          => 'secondary_font',
                    'type'        => 'font',
                    'title'       => esc_html__( 'Secondary Font', 'beyot-framework' ),
                    'subtitle'    => esc_html__( 'Specify the Secondary font properties.', 'beyot-framework' ),
                    'font_size'    => true,
                    'font_weight'  => true,
                    'default'        => array(
                        'font_family' => "'Poppins'",
                        'font_weight' => '300',
                        'font_size'   => '14'
                    ),
                ),

                array(
                    'id'             => 'h1_font',
                    'type'           => 'font',
                    'title'          => esc_html__( 'H1 Font', 'beyot-framework' ),
                    'subtitle'       => esc_html__( 'Specify the H1 font properties.', 'beyot-framework' ),
                    'font_size'    => true,
                    'font_weight'  => true,
                    'default'        => array(
                        'font_family' => "'Poppins'",
                        'font_weight' => '700',
                        'font_size'   => '76',
                    ),
                ),
                array(
                    'id'             => 'h2_font',
                    'type'           => 'font',
                    'title'          => esc_html__( 'H2 Font', 'beyot-framework' ),
                    'subtitle'       => esc_html__( 'Specify the H2 font properties.', 'beyot-framework' ),
                    'font_size'    => true,
                    'font_weight'  => true,
                    'default'  => array(
                        'font_family' => "'Poppins'",
                        'font_weight' => '700',
                        'font_size'   => '40',
                    ),
                ),
                array(
                    'id'             => 'h3_font',
                    'type'           => 'font',
                    'title'          => esc_html__( 'H3 Font', 'beyot-framework' ),
                    'subtitle'       => esc_html__( 'Specify the H3 font properties.', 'beyot-framework' ),
                    'font_size'    => true,
                    'font_weight'  => true,
                    'default'        => array(
                        'font_size'   => '24',
                        'font_family' => "'Poppins'",
                        'font_weight' => '700',
                    ),
                ),
                array(
                    'id'             => 'h4_font',
                    'type'           => 'font',
                    'title'          => esc_html__( 'H4 Font', 'beyot-framework' ),
                    'subtitle'       => esc_html__( 'Specify the H4 font properties.', 'beyot-framework' ),
                    'font_size'    => true,
                    'font_weight'  => true,
                    'default'        => array(
                        'font_size'   => '16',
                        'font_family' => "'Poppins'",
                        'font_weight' => '700',
                    ),
                ),
                array(
                    'id'             => 'h5_font',
                    'type'           => 'font',
                    'title'          => esc_html__( 'H5 Font', 'beyot-framework' ),
                    'subtitle'       => esc_html__( 'Specify the H5 font properties.', 'beyot-framework' ),
                    'font_size'    => true,
                    'font_weight'  => true,
                    'default'        => array(
                        'font_size'   => '14',
                        'font_family' => "'Poppins'",
                        'font_weight' => '700',
                    ),
                ),
                array(
                    'id'             => 'h6_font',
                    'type'           => 'font',
                    'title'          => esc_html__( 'H6 Font', 'beyot-framework' ),
                    'subtitle'       => esc_html__( 'Specify the H6 font properties.', 'beyot-framework' ),
                    'font_size'    => true,
                    'font_weight'  => true,
                    'default'        => array(
                        'font_size'   => '12',
                        'font_family' => "'Poppins'",
                        'font_weight' => '700',
                    ),
                ),
            )
        );
    }
}

/**
 * Get Config Section Social Profiles
 * *******************************************************
 */
if (!function_exists('gf_get_config_section_social_profiles')) {
    function gf_get_config_section_social_profiles() {
        return array(
            'id'       => 'section_social_profiles',
            'title'    => esc_html__( 'Social Profiles', 'beyot-framework' ),
            'icon'     => 'dashicons dashicons-rss',
            'fields'   => array_merge(
                array(
                    array(
                        'id'     => 'section_social_profiles_general',
                        'type'   => 'group',
                        'title'  => esc_html__('General', 'beyot-framework'),
                        'fields' => gf_get_social_profiles()
                    )
                ),
                array(
                    array(
                        'id'     => 'section_social_profiles_share_option',
                        'type'   => 'group',
                        'title'  => esc_html__('Blog Share Option', 'beyot-framework'),
                        'fields' => array(
                            array(
                                'title'    => esc_html__('Social Share', 'beyot-framework'),
                                'id'       => 'social_sharing',
                                'type'     => 'checkbox_list',
                                'subtitle' => esc_html__('Show the social sharing in single blog', 'beyot-framework'),
                                'options'  => array(
                                    'facebook'  => 'Facebook',
                                    'twitter'   => 'Twitter',
                                    'google'    => 'Google',
                                    'linkedin'  => 'Linkedin',
                                    'tumblr'    => 'Tumblr',
                                    'pinterest' => 'Pinterest'
                                ),
                                'default'  => array(
                                    'facebook', 'twitter', 'google'
                                ),
                                'value_inline' => false
                            )
                        )
                    )
                )
            )
        );
    }
}

/**
 * Get Config Section Resources Options
 * *******************************************************
 */
if (!function_exists('gf_get_config_section_resources_options')) {
    function gf_get_config_section_resources_options() {
        return array(
            'id'     => 'section_resources_options',
            'title'  => esc_html__( 'Resources Options', 'beyot-framework' ),
            'icon'   => 'dashicons dashicons-screenoptions',
            'fields' => array(
                array(
                    'id'     => 'section_resources_options_general',
                    'type'   => 'group',
                    'title'  => esc_html__('General', 'beyot-framework'),
                    'fields' => array(
                        array(
                            'id'       => 'cdn_bootstrap_js',
                            'type'     => 'text',
                            'title'    => esc_html__('CDN Bootstrap Script', 'beyot-framework'),
                            'subtitle' => esc_html__('Url CDN Bootstrap Script', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => '',
                        ),
                        array(
                            'id'       => 'cdn_bootstrap_css',
                            'type'     => 'text',
                            'title'    => esc_html__('CDN Bootstrap Stylesheet', 'beyot-framework'),
                            'subtitle' => esc_html__('Url CDN Bootstrap Stylesheet', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => '',
                        ),
                        array(
                            'id'       => 'cdn_font_awesome',
                            'type'     => 'text',
                            'title'    => esc_html__('CDN Font Awesome', 'beyot-framework'),
                            'subtitle' => esc_html__('Url CDN Font Awesome', 'beyot-framework'),
                            'desc'     => '',
                            'default'  => '',
                        ),
                    )
                )
            )
        );
    }
}

/**
 * Get Config Section Custom CSS & Script
 * *******************************************************
 */
if (!function_exists('gf_get_config_custom_css_script_options')) {
    function gf_get_config_custom_css_script_options() {
        return array(
            'id'     => 'section_custom_css_script',
            'title'  => esc_html__( 'Custom CSS & Script', 'beyot-framework' ),
            'icon'   => 'dashicons dashicons-welcome-write-blog',
            'fields' => array(
                array(
                    'id'       => 'custom_css',
                    'type'     => 'ace_editor',
                    'mode'     => 'css',
                    'title'    => esc_html__('Custom CSS', 'beyot-framework'),
                    'subtitle' => esc_html__('Add some CSS to your theme by adding it to this textarea. Please do not include any style tags.', 'beyot-framework'),
                    'desc'     => '',
                    'default'  => '',
                    'theme'    => 'solarized_dark',
                    'options'  => array('minLines' => 20, 'maxLines' => 60)
                ),
                array(
                    'id'       => 'custom_js',
                    'type'     => 'ace_editor',
                    'mode'     => 'javascript',
                    'theme'    => 'chrome',
                    'title'    => esc_html__('Custom JS', 'beyot-framework'),
                    'subtitle' => esc_html__('Add some custom JavaScript to your theme by adding it to this textarea. Please do not include any script tags.', 'beyot-framework'),
                    'desc'     => '',
                    'default'  => '',
                    'options'  => array('minLines' => 20, 'maxLines' => 60)
                ),
            )
        );
    }
}

/**
 * Get Config Section Preset Settings
 * *******************************************************
 */
if (!function_exists('gf_get_config_preset_setting_options')) {
    function gf_get_config_preset_setting_options() {
        $post_type_preset = apply_filters('gf_post_type_preset', array());
        $post_type_preset_list = array();
        foreach ($post_type_preset as $key => $value) {
            if($key == 'property') {
                $post_type_preset_list[] = array(
                    'id'     => 'divide_preset_setting_' . $key . '_general',
                    'title'  => $value['name'],
                    'type'   => 'group',
                    'fields' => array(
                        array(
                            'id'          => $key . '_preset',
                            'type'        => 'selectize',
                            'allow_clear' => true,
                            'data'        => 'post',
                            'title'       => esc_html__( 'List Properties Preset', 'beyot-framework' ),
                            'placeholder' => esc_html__( 'Select Preset...', 'beyot-framework' ),
                            'default'     => '',
                            'data_args'   => array(
                                'post_type'      => 'gf_preset',
                                'posts_per_page' => - 1
                            )
                        ),
                        array(
                            'id'          => $key . '_single_preset',
                            'type'        => 'selectize',
                            'allow_clear' => true,
                            'data'        => 'post',
                            'title'       => esc_html__( 'Single Property Preset', 'beyot-framework' ),
                            'placeholder' => esc_html__( 'Select Preset...', 'beyot-framework' ),
                            'default'     => '',
                            'data_args'   => array(
                                'post_type'      => 'gf_preset',
                                'posts_per_page' => - 1
                            )
                        )
                    )
                );
            }
            elseif($key=='agent')
            {
                $post_type_preset_list[] = array(
                    'id'     => 'divide_preset_setting_' . $key . '_general',
                    'title'  => $value['name'],
                    'type'   => 'group',
                    'fields' => array(
                        array(
                            'id'          => $key . '_preset',
                            'type'        => 'selectize',
                            'allow_clear' => true,
                            'data'        => 'post',
                            'title'       => esc_html__( 'List Agents Preset', 'beyot-framework' ),
                            'placeholder' => esc_html__( 'Select Preset...', 'beyot-framework' ),
                            'default'     => '',
                            'data_args'   => array(
                                'post_type'      => 'gf_preset',
                                'posts_per_page' => - 1
                            )
                        ),
                        array(
                            'id'          => $key . '_single_preset',
                            'type'        => 'selectize',
                            'allow_clear' => true,
                            'data'        => 'post',
                            'title'       => esc_html__( 'Single Agent Preset', 'beyot-framework' ),
                            'placeholder' => esc_html__( 'Select Preset...', 'beyot-framework' ),
                            'default'     => '',
                            'data_args'   => array(
                                'post_type'      => 'gf_preset',
                                'posts_per_page' => - 1
                            )
                        )
                    )
                );
            }
            elseif($key=='invoice')
            {
                $post_type_preset_list[] = array(
                    'id'     => 'divide_preset_setting_' . $key . '_general',
                    'title'  => $value['name'],
                    'type'   => 'group',
                    'fields' => array(
                        array(
                            'id'          => $key . '_single_preset',
                            'type'        => 'selectize',
                            'allow_clear' => true,
                            'data'        => 'post',
                            'title'       => esc_html__( 'Invoice Preset', 'beyot-framework' ),
                            'placeholder' => esc_html__( 'Select Preset...', 'beyot-framework' ),
                            'default'     => '',
                            'data_args'   => array(
                                'post_type'      => 'gf_preset',
                                'posts_per_page' => - 1
                            )
                        )
                    )
                );
            }
            else{
                $post_type_preset_list[] = array(
                    'id'     => 'divide_preset_setting_' . $key . '_general',
                    'title'  => $value['name'],
                    'type'   => 'group',
                    'fields' => array(
                        array(
                            'id'          => $key . '_preset',
                            'type'        => 'selectize',
                            'allow_clear' => true,
                            'data'        => 'post',
                            'title'       => esc_html__( 'List ', 'beyot-framework' ) . $value['name'] . esc_html__( ' Preset', 'beyot-framework' ),
                            'placeholder' => esc_html__( 'Select Preset...', 'beyot-framework' ),
                            'default'     => '',
                            'data_args'   => array(
                                'post_type'      => 'gf_preset',
                                'posts_per_page' => - 1
                            )
                        ),
                        array(
                            'id'          => $key . '_single_preset',
                            'type'        => 'selectize',
                            'allow_clear' => true,
                            'data'        => 'post',
                            'title'       => $value['name'] . esc_html__( ' Single Preset', 'beyot-framework' ),
                            'placeholder' => esc_html__( 'Select Preset...', 'beyot-framework' ),
                            'default'     => '',
                            'data_args'   => array(
                                'post_type'      => 'gf_preset',
                                'posts_per_page' => - 1
                            )
                        )
                    )
                );
            }
        }
        return array(
            'id'     => 'section_preset_setting',
            'title'  => esc_html__( 'Preset Settings', 'beyot-framework' ),
            'icon'   => 'dashicons dashicons-admin-generic',
            'fields' => array_merge(
                array(
                    array(
                        'id' => 'divide_preset_setting_blog',
                        'title' => esc_html__( 'Blog', 'beyot-framework' ),
                        'type' => 'group',
                        'fields' => array(
                            array(
                                'id' => 'blog_preset',
                                'type' => 'selectize',
                                'allow_clear' => true,
                                'data' => 'post',
                                'title' => esc_html__('Blog Preset', 'beyot-framework'),
                                'placeholder' => esc_html__('Select Preset...', 'beyot-framework'),
                                'default' => '',
                                'data_args' => array(
                                    'post_type' => 'gf_preset',
                                    'posts_per_page' => -1
                                )
                            ),
                            array(
                                'id' => 'blog_single_preset',
                                'type' => 'selectize',
                                'allow_clear' => true,
                                'data' => 'post',
                                'title' => esc_html__('Blog Single Preset', 'beyot-framework'),
                                'placeholder' => esc_html__('Select Preset...', 'beyot-framework'),
                                'default' => '',
                                'data_args' => array(
                                    'post_type' => 'gf_preset',
                                    'posts_per_page' => -1

                                )
                            ),
                        )
                    )
                ),
                $post_type_preset_list,
                array(
                    array(
                        'id' => 'divide_preset_setting_404',
                        'title' => esc_html__( '404', 'beyot-framework' ),
                        'type' => 'group',
                        'fields' => array(
                            array(
                                'id' => 'page_404_preset',
                                'type' => 'selectize',
                                'allow_clear' => true,
                                'data' => 'post',
                                'title' => esc_html__('404 Page Preset', 'beyot-framework'),
                                'placeholder' => esc_html__('Select Preset...', 'beyot-framework'),
                                'default' => '',
                                'data_args' => array(
                                    'post_type' => 'gf_preset',
                                    'posts_per_page' => -1
                                )
                            )
                        )
                    )
                )
            )
        );
    }
}

/**
 * Get Config Custom Layout
 * *******************************************************
 */
if (!function_exists('gf_get_config_custom_layout')) {
    function gf_get_config_custom_layout() {
        $settings = gf_get_custom_post_type_setting();
        $options = array();
        foreach ($settings as $key => $value) {
            $fields = array(
                array(
                    'id' => "custom_{$key}_layout_enable",
                    'type' => 'button_set',
                    'title' => esc_html__('Custom Layout', 'beyot-framework'),
                    'subtitle' => sprintf(esc_html__('Turn on this option if you want to enable custom layout on %s', 'beyot-framework'),$value['title']),
                    'options' => gf_get_toggle(),
                    'default' => 0
                ),
                gf_get_page_layout($key.'_layout',array('custom_'.$key.'_layout_enable', '=', 1)),
                gf_get_config_sidebar_layout("{$key}_sidebar_layout",array("custom_{$key}_layout_enable",'=',1)),
                gf_get_config_sidebar("{$key}_sidebar",array(
                    array("custom_{$key}_layout_enable",'=',1),
                    array("{$key}_sidebar_layout",'!=','none')
                )),
                gf_get_sidebar_mobile_enable("{$key}_sidebar_mobile_enable",array(
                    array("custom_{$key}_layout_enable",'=',1),
                    array("{$key}_sidebar_layout",'!=','none')
                ), 1),
                gf_get_sidebar_mobile_canvas("{$key}_sidebar_mobile_canvas", array(
                    array("custom_{$key}_layout_enable",'=',1),
                    array("{$key}_sidebar_layout",'!=','none')
                ), 1),
                gf_get_content_padding("{$key}_content_padding", array("custom_{$key}_layout_enable",'=',1)),
                gf_get_mobile_content_padding("{$key}_content_padding_mobile", array("custom_{$key}_layout_enable",'=',1))
                
            );
            $options[] = array(
                'id' => "section_layout_group_{$key}",
                'title' => $value['title'],
                'type' => 'group',
                //'toggle_default' => false,
                'fields' => $fields
            );
        }
        return $options;
    }
}

/**
 * Get Config Custom Page Title
 * *******************************************************
 */
if (!function_exists('gf_get_config_custom_page_title')) {
    function gf_get_config_custom_page_title() {
        $settings = gf_get_custom_post_type_setting();
        $options = array();
        foreach ($settings as $key => $value) {
            $fields = array(
                array(
                    'id' => "custom_{$key}_title_enable",
                    'type' => 'button_set',
                    'title' => esc_html__('Custom Page Title', 'beyot-framework'),
                    'subtitle' => sprintf(esc_html__('Turn on this option if you want to enable custom page title on %s', 'beyot-framework'),$value['title']),
                    'options' => gf_get_toggle(),
                    'default' => 0
                ),
                gf_get_page_title_enable( "{$key}_title_enable", array("custom_{$key}_title_enable",'=','1'), 1 ),
                gf_get_page_title( "{$key}_title", array("custom_{$key}_title_enable",'=','1'), '' ),
                gf_get_page_title_padding( "{$key}_title_padding", array(
                    array("custom_{$key}_title_enable",'=','1'),
                    array("{$key}_title_enable",'=','1')
                ) ),
                gf_get_page_title_background_image( "{$key}_title_bg_image", array(
                    array("custom_{$key}_title_enable",'=','1'),
                    array("{$key}_title_enable",'=','1')
                ), GF_PLUGIN_URL . 'assets/images/theme-options/page-title.jpg' ),
				gf_get_page_title_background_overlay("{$key}_page_title_bg_overlay", array(
					array("custom_{$key}_title_enable", '=', '1'),
					array("{$key}_title_enable", '=', '1')
				)),
                gf_get_page_title_parallax( "{$key}_title_parallax", array(
                    array("custom_{$key}_title_enable",'=','1'),
                    array("{$key}_title_enable",'=','1'),
                    array("{$key}_title_bg_image[id]",'!=','')
                ), 0 ),
                gf_get_breadcrumb_enable( "{$key}_breadcrumb_enable", array(
                    array("custom_{$key}_title_enable",'=','1'),
                    array("{$key}_title_enable",'=','1')
                ) )
            );

            $options[] = array(
                'id' => "section_page_title_group_{$key}",
                'title' => $value['title'],
                'type' => 'group',
                //'toggle_default' => false,
                'fields' => $fields
            );
        }
        return $options;
    }
}

/**
 * Get Config Sidebar Layout
 * *******************************************************
 */
if (!function_exists('gf_get_config_sidebar_layout')) {
    function gf_get_config_sidebar_layout($id,$required = array(),$default = 'right') {
        return array(
            'id' => $id,
            'title' => esc_html__('Sidebar Layout', 'beyot-framework'),
            'type' => 'image_set',
            'options' => gf_get_sidebar_layout(),
            'default' => $default,
            'required' => $required
        );
    }
}

/**
 * Get Config Sidebar
 * *******************************************************
 */
if (!function_exists('gf_get_config_sidebar')) {
    function gf_get_config_sidebar($id, $required = array(),$title = '',$default = 'main-sidebar') {
        if (empty($title)) {
            $title = esc_html__('Sidebar', 'beyot-framework');
        }
        return array(
            'id' => $id,
            'title' => $title,
            'type' => 'selectize',
            'allow_clear' => true,
            'placeholder' => esc_html__('Select Sidebar', 'beyot-framework'),
            'data' => 'sidebar',
            'default' => $default,
            'required' => $required
        );
    }
}

/**
 * Get Config Border Bottom
 * *******************************************************
 */
if (!function_exists('gf_get_config_border_bottom')){
    function gf_get_config_border_bottom($id,$required = array(),$default= 'none') {
        return array(
            'id'      => $id,
            'type'    => 'selectize',
            'allow_clear' => true,
            'title'   => esc_html__('Border Bottom', 'beyot-framework'),
            'options' => gf_get_border_layout(),
            'default' => $default,
            'required' => $required
        );
    }
}

// Get Page Layout
if (!function_exists('gf_get_page_layout')) {
    function gf_get_page_layout( $id, $required = array(), $default = 'container' ) {
        return array(
            'id'       => $id,
            'type'     => 'button_set',
            'title'    => esc_html__( 'Layout', 'beyot-framework' ),
            'subtitle' => esc_html__( 'Select Page Layout', 'beyot-framework' ),
            'desc'     => '',
            'options'  => gf_get_page_layout_option(),
            'default'  => $default,
            'required' => $required,
        );
    }
}

/**
 * Get Config Top Bar
 * *******************************************************
 */
if (!function_exists('gf_get_config_group_top_bar')) {
    function gf_get_config_group_top_bar($id,$title, $prefixId,$required = array()) {
        return array(
            'id' => $id,
            'title' => $title,
            'type' => 'group',
            'toggle_default' => true,
            'required' => $required,
            'fields' =>  array(
                array(
                    'id' => "{$prefixId}_enable",
                    'title' => esc_html__('Top Bar Enable', 'beyot-framework'),
                    'subtitle' => esc_html__('Turn On this option if you want to enable top bar', 'beyot-framework'),
                    'options' => gf_get_toggle(),
                    'type' => 'button_set',
                    'default' => 0
                ),
                array(
                    'id' => "{$prefixId}_layout",
                    'title' => esc_html__('Layout', 'beyot-framework'),
                    'type' => 'image_set',
                    'options' => gf_get_top_bar_layout(),
                    'default' => 'top-bar-1',
                    'required' => array("{$prefixId}_enable",'=','1')
                ),
                gf_get_config_sidebar("{$prefixId}_left_sidebar",array("{$prefixId}_enable",'=','1'),esc_html__('Top Bar Left', 'beyot-framework'),'top_bar_left'),
                gf_get_config_sidebar("{$prefixId}_right_sidebar",array(array("{$prefixId}_enable",'=','1'),array("{$prefixId}_layout",'!=','top-bar-4')) ,esc_html__('Top Bar Right', 'beyot-framework'),'top_bar_right'),
                array(
                    'id' => "{$prefixId}_padding",
                    'title' => esc_html__('Padding', 'beyot-framework'),
                    'subtitle' => esc_html__('Top/Bottom Padding', 'beyot-framework'),
                    'desc' => esc_html__('If you would like to override the default top bar top/bottom padding, then you can do so here.', 'beyot-framework'),
                    'type' => 'spacing',
                    'left'     => false,
                    'right'    => false,
                    'default'  => '',
                    'required' => array("{$prefixId}_enable",'=','1'),
                ),
                gf_get_config_border_bottom("{$prefixId}_border",array("{$prefixId}_enable",'=','1'))
            )
        );
    }
}

/**
 * Get Page title Enabel
 * *******************************************************
 */
if (!function_exists('gf_get_page_title_enable')) {
    function gf_get_page_title_enable( $id, $required = array(), $default = 1 ) {
        return array(
            'id'       => $id,
            'type'     => 'button_set',
            'title'    => esc_html__( 'Page Title Enable', 'beyot-framework' ),
            'subtitle' => esc_html__( 'Enable/Disable Page Title', 'beyot-framework' ),
            'desc'     => '',
            'options'  => gf_get_toggle(),
            'default'  => $default,
            'required' => $required,
        );
    }
}

/**
 * Get Page Title
 * *******************************************************
 */
if (!function_exists('gf_get_page_title')) {
    function gf_get_page_title( $id, $required = array(), $default=null ) {
        return array(
            'id'       => $id,
            'type'     => 'text',
            'title'    => esc_html__( 'Page Title', 'beyot-framework' ),
            'subtitle' => '',
            'desc'     => '',
            'default'  => $default,
            'required' => $required,
        );
    }
}

/**
 * Get Page subtitle
 * *******************************************************
 */
if (!function_exists('gf_get_page_sub_title')) {
    function gf_get_page_sub_title( $id, $required = array() ) {
        return array(
            'id'       => $id,
            'type'     => 'text',
            'title'    => esc_html__( 'Page Sub Title', 'beyot-framework' ),
            'subtitle' => '',
            'desc'     => '',
            'default'  => '',
            'required' => $required,
        );
    }
}

/**
 * Get Page title padding
 * *******************************************************
 */
if (!function_exists('gf_get_page_title_padding')) {
    function gf_get_page_title_padding(
        $id, $required = array(), $default = array(
            'top'    => '178',
            'bottom' => '178'
            )
        )
    {
        return array(
            'id'             => $id,
            'type'           => 'spacing',
            'mode'           => 'padding',
            'units'          => 'px',
            'units_extended' => 'false',
            'title'          => esc_html__( 'Padding', 'beyot-framework' ),
            'subtitle'       => esc_html__( 'Set page title top/bottom padding.', 'beyot-framework' ),
            'desc'           => '',
            'left'           => false,
            'right'          => false,
            'default'        => $default,
            'required'       => $required,
        );
    }
}

/**
 * Get Page title background image
 * *******************************************************
 */
if (!function_exists('gf_get_page_title_background_image')) {
    function gf_get_page_title_background_image( $id, $required = array(), $default = array() ) {
        return array(
            'id'       => $id,
            'type'     => 'image',
            'url'      => true,
            'title'    => esc_html__( 'Background Image', 'beyot-framework' ),
            'subtitle' => esc_html__( 'Upload page title background.', 'beyot-framework' ),
            'desc'     => '',
            'default'  => $default,
            'required' => $required,
        );
    }
}

/**
 * Get Page title background overlay
 * *******************************************************
 */
if (!function_exists('gf_get_page_title_background_overlay')) {
    function gf_get_page_title_background_overlay( $id, $required = array(), $default = 1 ) {
        return array(
            'id'       => $id,
            'type'     => 'button_set',
            'title'    => esc_html__( 'Page Title Background Overlay', 'beyot-framework' ),
            'subtitle' => esc_html__( 'Enable/Disable Breadcrumbs In Pages Title', 'beyot-framework' ),
            'desc'     => '',
            'options'  => gf_get_toggle(),
            'default'  => $default,
            'required' => $required
        );
    }
}

/**
 * Get Page title parallax
 * *******************************************************
 */
if (!function_exists('gf_get_page_title_parallax')) {
    function gf_get_page_title_parallax( $id, $required = array(), $default = 1 ) {
        return array(
            'id'       => $id,
            'type'     => 'button_set',
            'title'    => esc_html__( 'Page Title Parallax', 'beyot-framework' ),
            'subtitle' => esc_html__( 'Enable Page Title Parallax', 'beyot-framework' ),
            'desc'     => '',
            'options'  => gf_get_toggle(),
            'default'  => $default,
            'required' => $required,
        );
    }
}

/**
 * Get Breadcrumb Enable
 * *******************************************************
 */
if (!function_exists('gf_get_breadcrumb_enable')) {
    function gf_get_breadcrumb_enable( $id, $required = array(), $default = 1 ) {
        return array(
            'id'       => $id,
            'type'     => 'button_set',
            'title'    => esc_html__( 'Breadcrumbs Enable', 'beyot-framework' ),
            'subtitle' => esc_html__( 'Enable/Disable Breadcrumbs In Pages Title', 'beyot-framework' ),
            'desc'     => '',
            'options'  => gf_get_toggle(),
            'default'  => $default,
            'required' => $required
        );
    }
}
if (!function_exists('gf_get_header_bar')) {
    function gf_get_header_bar() {
        $current_preset = isset($_POST['gf_select_preset']) ? $_POST['gf_select_preset'] : '';

        $args = array(
            'posts_per_page' => 1000,
            'post_type' => 'gf_preset'
        );
        $presets = get_posts($args);
        ?>
        <form class="load-preset-form" action="" method="post">
            <select name="gf_select_preset" id="gf_select_preset">
                <option
                    value="" <?php echo($current_preset == '' ? 'selected' : ''); ?>><?php esc_html_e('--[Select Preset]--', 'beyot-framework'); ?></option>
                <?php foreach ($presets as $post) : ?>
                    <option
                        value="<?php echo esc_attr($post->ID) ?>" <?php echo($current_preset == $post->ID ? 'selected' : ''); ?>><?php echo esc_html($post->post_title) ?></option>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            </select>
            <button id="gf_choose_preset" type="submit" class="button"><?php esc_html_e('Load Preset', 'beyot-framework'); ?></button>
        </form>
    <?php
    }
    add_action('gsf/' . GF_OPTIONS_NAME . '-theme-option-form/before', 'gf_get_header_bar');
}