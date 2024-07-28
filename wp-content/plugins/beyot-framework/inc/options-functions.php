<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/18/2016
 * Time: 11:36 AM
 */

/**
 * Get Page Layout
 */
if (!function_exists('gf_get_page_layout_option')) {
    function gf_get_page_layout_option($default = false)
    {
        return apply_filters('gf_page_layout', array(
            'full'      => esc_html__('Full Width', 'beyot-framework'),
            'container' => esc_html__('Container', 'beyot-framework'),
            'container-fluid' => esc_html__('Container Fluid', 'beyot-framework')

        ));
    }
}

//////////////////////////////////////////////////////////////////
// Get Sidebar Layout
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_get_sidebar_layout')) {
    function gf_get_sidebar_layout()
    {
        return apply_filters('gf_sidebar_layout', array(
            'none'  => GF_PLUGIN_URL . 'assets/images/theme-options/sidebar-none.png',
            'left'  => GF_PLUGIN_URL . 'assets/images/theme-options/sidebar-left.png',
            'right' => GF_PLUGIN_URL . 'assets/images/theme-options/sidebar-right.png',
        ));
    }
}

//////////////////////////////////////////////////////////////////
// Get Sidebar Width
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_get_sidebar_width')) {
    function gf_get_sidebar_width($default = false)
    {
        $result = apply_filters('gf_sidebar_width', array(
            'small' => esc_html__('Small (1/4)', 'beyot-framework'),
            'large' => esc_html__('Large (1/3)', 'beyot-framework')
        ));

        if ($default) {
            $result = array(-1 => esc_html__('Default', 'beyot-framework')) + $result;
        }

        return $result;


    }
}
//////////////////////////////////////////////////////////////////
// Get Layout Styles
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_get_layout_style')) {
    function gf_get_layout_style()
    {
        return apply_filters('gf_layout_style', array(
            'wide'  => GF_PLUGIN_URL . 'assets/images/theme-options/layout-wide.png',
            'boxed' => GF_PLUGIN_URL . 'assets/images/theme-options/layout-boxed.png'
        ));
    }
}

//////////////////////////////////////////////////////////////////
// Get Post Layout
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_get_post_layout')) {
    function gf_get_post_layout()
    {
        return apply_filters('gf_post_layout', array(
            'large-image'  => esc_html__('Large Image', 'beyot-framework'),
            'grid'      => esc_html__('Grid', 'beyot-framework'),
            'masonry'      => esc_html__('Masonry', 'beyot-framework'),
        ));
    }
}

//////////////////////////////////////////////////////////////////
// Get Post Columns
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_get_post_columns')) {
    function gf_get_post_columns()
    {
        return apply_filters('gf_post_columns', array(
            2 => '2',
            3 => '3'
        ));
    }
}

//////////////////////////////////////////////////////////////////
// Get Post Paging
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_get_paging_style')) {
    function gf_get_paging_style()
    {
        return apply_filters('gf_paging_style', array(
            'navigation'      => esc_html__('Navigation', 'beyot-framework'),
            'load-more'       => esc_html__('Load More', 'beyot-framework'),
            'infinite-scroll' => esc_html__('Infinite Scroll', 'beyot-framework')
        ));
    }
}

//////////////////////////////////////////////////////////////////
// Get Toggle
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_get_toggle')) {
    function gf_get_toggle($default = false)
    {
        $result = array(
            1 => esc_html__('On', 'beyot-framework'),
            0 => esc_html__('Off', 'beyot-framework')

        );
        if ($default) {
            $result = array(-1 => esc_html__('Default', 'beyot-framework')) + $result;
        }

        return $result;
    }
}

//==============================================================================
// Get list social profiles
//==============================================================================
if (!function_exists('gf_get_social_profiles')) {
    function gf_get_social_profiles()
    {
        return apply_filters('gf_get_social_profiles', array(
            array(
                'id'        => 'twitter_url',
                'type'      => 'text',
                'title'     => esc_html__('Twitter', 'beyot-framework'),
                'subtitle'  => esc_html__('Your Twitter', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-twitter',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'facebook_url',
                'type'      => 'text',
                'title'     => esc_html__('Facebook', 'beyot-framework'),
                'subtitle'  => esc_html__('Your facebook page/profile url', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-facebook',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'dribbble_url',
                'type'      => 'text',
                'title'     => esc_html__('Dribbble', 'beyot-framework'),
                'subtitle'  => esc_html__('Your Dribbble', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-dribbble',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'vimeo_url',
                'type'      => 'text',
                'title'     => esc_html__('Vimeo', 'beyot-framework'),
                'subtitle'  => esc_html__('Your Vimeo', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-vimeo',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'tumblr_url',
                'type'      => 'text',
                'title'     => esc_html__('Tumblr', 'beyot-framework'),
                'subtitle'  => esc_html__('Your Tumblr', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-tumblr',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'skype_username',
                'type'      => 'text',
                'title'     => esc_html__('Skype', 'beyot-framework'),
                'subtitle'  => esc_html__('Your Skype username', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-skype',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'linkedin_url',
                'type'      => 'text',
                'title'     => esc_html__('LinkedIn', 'beyot-framework'),
                'subtitle'  => esc_html__('Your LinkedIn page/profile url', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-linkedin',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'googleplus_url',
                'type'      => 'text',
                'title'     => esc_html__('Google+', 'beyot-framework'),
                'subtitle'  => esc_html__('Your Google+ page/profile URL', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-google-plus',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'flickr_url',
                'type'      => 'text',
                'title'     => esc_html__('Flickr', 'beyot-framework'),
                'subtitle'  => esc_html__('Your Flickr page url', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-flickr',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'youtube_url',
                'type'      => 'text',
                'title'     => esc_html__('YouTube', 'beyot-framework'),
                'subtitle'  => esc_html__('Your YouTube URL', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-youtube',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'pinterest_url',
                'type'      => 'text',
                'title'     => esc_html__('Pinterest', 'beyot-framework'),
                'subtitle'  => esc_html__('Your Pinterest', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-pinterest',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'foursquare_url',
                'type'      => 'text',
                'title'     => esc_html__('Foursquare', 'beyot-framework'),
                'subtitle'  => esc_html__('Your Foursqaure URL', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-foursquare',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'instagram_url',
                'type'      => 'text',
                'title'     => esc_html__('Instagram', 'beyot-framework'),
                'subtitle'  => esc_html__('Your Instagram', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-instagram',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'github_url',
                'type'      => 'text',
                'title'     => esc_html__('GitHub', 'beyot-framework'),
                'subtitle'  => esc_html__('Your GitHub URL', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-github',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'xing_url',
                'type'      => 'text',
                'title'     => esc_html__('Xing', 'beyot-framework'),
                'subtitle'  => esc_html__('Your Xing URL', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-xing',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'behance_url',
                'type'      => 'text',
                'title'     => esc_html__('Behance', 'beyot-framework'),
                'subtitle'  => esc_html__('Your Behance URL', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-behance',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'deviantart_url',
                'type'      => 'text',
                'title'     => esc_html__('Deviantart', 'beyot-framework'),
                'subtitle'  => esc_html__('Your Deviantart URL', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-deviantart',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'soundcloud_url',
                'type'      => 'text',
                'title'     => esc_html__('SoundCloud', 'beyot-framework'),
                'subtitle'  => esc_html__('Your SoundCloud URL', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-soundcloud',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'yelp_url',
                'type'      => 'text',
                'title'     => esc_html__('Yelp', 'beyot-framework'),
                'subtitle'  => esc_html__('Your Yelp URL', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-yelp',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'rss_url',
                'type'      => 'text',
                'title'     => esc_html__('RSS Feed', 'beyot-framework'),
                'subtitle'  => esc_html__('Your RSS Feed URL', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-rss',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'vk_url',
                'type'      => 'text',
                'title'     => esc_html__('VK', 'beyot-framework'),
                'subtitle'  => esc_html__('Your VK URL', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-vk',
                'link-type' => 'link',
            ),
            array(
                'id'        => 'email_address',
                'type'      => 'text',
                'title'     => esc_html__('Email address', 'beyot-framework'),
                'subtitle'  => esc_html__('Your email address', 'beyot-framework'),
                'default'   => '',
                'icon'      => 'fa fa-envelope',
                'link-type' => 'email',
            ),
        ));
    }
}


//////////////////////////////////////////////////////////////////
// Get Search Type
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_get_search_type')) {
    function gf_get_search_type()
    {
        return apply_filters('gf_search_type', array(
            'button'           => esc_html__('Button', 'beyot-framework'),
            'box'              => esc_html__('Box', 'beyot-framework'),
        ));
    }
}


/**
 * Get search ajax post type
 * *******************************************************
 */
if (!function_exists('gf_get_search_ajax_popup_post_type')) {
    function gf_get_search_ajax_popup_post_type() {
        $output = array(
            'post'      => esc_html__('Post','beyot-framework'),
            'page'      => esc_html__('Page','beyot-framework'),
        );
        return apply_filters('gf_get_search_popup_ajax_post_type',$output);
    }
}


/**
 * Get maintenance mode
 * *******************************************************
 */
if (!function_exists('gf_get_maintenance_mode')) {
    function gf_get_maintenance_mode() {
        return apply_filters('gf_maintenance_mode',array(
            '2' => esc_html__('On (Custom Page)', 'beyot-framework'),
            '1' => esc_html__('On (Standard)', 'beyot-framework'),
            '0' => esc_html__('Off', 'beyot-framework')
        ));
    }
}


/**
 * Get Loading Animation
 * *******************************************************
 */
if (!function_exists('gf_get_loading_animation')) {
    function gf_get_loading_animation(){
        return apply_filters('gf_loading_animation', array(
            'chasing-dots'  => esc_html__('Chasing Dots', 'beyot-framework'),
            'circle'        => esc_html__('Circle', 'beyot-framework'),
            'cube'          => esc_html__('Cube', 'beyot-framework'),
            'double-bounce' => esc_html__('Double Bounce', 'beyot-framework'),
            'fading-circle' => esc_html__('Fading Circle', 'beyot-framework'),
            'folding-cube'  => esc_html__('Folding Cube', 'beyot-framework'),
            'pulse'         => esc_html__('Pulse', 'beyot-framework'),
            'three-bounce'  => esc_html__('Three Bounce', 'beyot-framework'),
            'wave'          => esc_html__('Wave', 'beyot-framework'),
        ));
    }
}

/**
 * Get Setting Custom Post type
 * *******************************************************
 */
if (!function_exists('gf_get_custom_post_type_setting')) {
    function gf_get_custom_post_type_setting() {
        $settings = array(
            'blog' => array(
                'title' => esc_html__('Blog','beyot-framework'),
            ),
            'single_blog' => array(
                'title' => esc_html__('Single Blog','beyot-framework'),
                'is_single' => true,
                'post_type' => 'post'
            ),
        );
        $post_type_preset = apply_filters('gf_post_type_preset', array());
        foreach ($post_type_preset as $key => $value) {
            if($key=='property')
            {
                $settings = array_merge( $settings, array(
                    $key            => array(
                        'title'      => esc_html__( 'List Properties', 'beyot-framework' ),
                        'is_archive' => true,
                        'post_type'  => $key,
                        'category' => array('property-type','property-city','property-status','property-feature','property-label','property-state','property-city','property-neighborhood')
                    ),
                    "single_{$key}" => array(
                        'title'     => esc_html__( 'Single Property', 'beyot-framework' ),
                        'is_single' => true,
                        'post_type' => $key
                    ),
                ) );
            }
            elseif($key=='agent')
            {
                $settings = array_merge( $settings, array(
                    $key            => array(
                        'title'      => esc_html__( 'List Agents', 'beyot-framework' ),
                        'is_archive' => true,
                        'post_type'  => $key
                    ),
                    "single_{$key}" => array(
                        'title'     => esc_html__( 'Single Agent', 'beyot-framework' ),
                        'is_single' => true,
                        'post_type' => $key
                    ),
                ) );
            }
            elseif($key=='invoice')
            {
                $settings = array_merge( $settings, array(
                    "single_{$key}" => array(
                        'title'     => esc_html__( 'Invoice ', 'beyot-framework' ),
                        'is_single' => true,
                        'post_type' => $key
                    ),
                ) );
            }
            else
            {
                $settings = array_merge( $settings, array(
                    $key            => array(
                        'title'      => esc_html__( 'List ', 'beyot-framework' ) . $value['name'],
                        'is_archive' => true,
                        'post_type'  => $key
                    ),
                    "single_{$key}" => array(
                        'title'     => esc_html__( 'Single ', 'beyot-framework' ) . $value['name'],
                        'is_single' => true,
                        'post_type' => $key
                    ),
                ) );
            }
        }
        return apply_filters('gf_custom_post_type_setting',$settings);
    }
}


/**
 * Get Top Drawer Mode
 * *******************************************************
 */
if (!function_exists('gf_get_top_drawer_mode')) {
    function gf_get_top_drawer_mode() {
        return apply_filters('gf_top_drawer_mode',array(
            'hide' => esc_html__('Hide', 'beyot-framework'),
            'toggle' => esc_html__('Toggle', 'beyot-framework'),
            'show' => esc_html__('Show', 'beyot-framework')
        ));
    }
}


/**
 * Get Top Bar Layout
 * *******************************************************
 */
if (!function_exists('gf_get_top_bar_layout')) {
    function gf_get_top_bar_layout() {
        return apply_filters('gf_top_bar_layout',array(
            'top-bar-1' => GF_PLUGIN_URL . 'assets/images/theme-options/top-bar-layout-1.jpg',
            'top-bar-2' => GF_PLUGIN_URL . 'assets/images/theme-options/top-bar-layout-2.jpg',
            'top-bar-3' => GF_PLUGIN_URL . 'assets/images/theme-options/top-bar-layout-3.jpg',
            'top-bar-4' => GF_PLUGIN_URL . 'assets/images/theme-options/top-bar-layout-4.jpg',
        ));
    }
}

/**
 * Get Border Layout
 * *******************************************************
 */
if (!function_exists('gf_get_border_layout')) {
    function gf_get_border_layout(){
        return apply_filters('gf_border_layout',array(
            'none' => esc_html__('None', 'beyot-framework'),
            'full' => esc_html__('Full', 'beyot-framework'),
            'container' => esc_html__('Container', 'beyot-framework')
        ));
    }
}

//////////////////////////////////////////////////////////////////
// Get Sidebar mobile Enable
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_get_sidebar_mobile_enable')) {
    function gf_get_sidebar_mobile_enable( $id, $required = array(), $default = 1 ) {
        return array(
            'id'       => $id,
            'type'     => 'button_set',
            'title'    => esc_html__( 'Sidebar Mobile', 'beyot-framework' ),
            'subtitle' => esc_html__( 'Turn Off this option if you want to disable sidebar on mobile', 'beyot-framework' ),
            'desc'     => '',
            'options'  => gf_get_toggle(),
            'default'  => $default,
            'required' => $required,
        );
    }
}

//////////////////////////////////////////////////////////////////
// Get Sidebar mobile Canvas
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_get_sidebar_mobile_canvas')) {
    function gf_get_sidebar_mobile_canvas( $id, $required = array(), $default = 1 ) {
        return array(
            'id'       => $id,
            'type'     => 'button_set',
            'title'    => esc_html__( 'Canvas Sidebar Mobile', 'beyot-framework' ),
            'subtitle' => esc_html__( 'Turn Off this option if you want to disable canvas sidebar on mobile', 'beyot-framework' ),
            'desc'     => '',
            'options'  => gf_get_toggle(),
            'default'  => $default,
            'required' => $required,
        );
    }
}

//////////////////////////////////////////////////////////////////
// Get Content Padding
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_get_content_padding')) {
    function gf_get_content_padding( $id, $required = array(), $default = 1 ) {
        return array(
            'id' => $id,
            'title' => esc_html__('Content Padding', 'beyot-framework'),
            'subtitle' => esc_html__('Top/Bottom Padding', 'beyot-framework'),
            'type' => 'spacing',
            'left'     => false,
            'right'    => false,
            'default'  => $default,
            'required' => $required
        );
    }
}

//////////////////////////////////////////////////////////////////
// Get Mobile Content Padding
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_get_mobile_content_padding')) {
    function gf_get_mobile_content_padding( $id, $required = array(), $default = 1 ) {
        return array(
            'id' => $id,
            'title' => esc_html__('Content Padding Mobile', 'beyot-framework'),
            'subtitle' => esc_html__('Top/Bottom Padding', 'beyot-framework'),
            'type' => 'spacing',
            'left'     => false,
            'right'    => false,
            'default'  => $default,
            'required' => $required
        );
    }
}