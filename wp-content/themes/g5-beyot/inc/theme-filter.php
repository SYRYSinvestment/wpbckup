<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/17/2016
 * Time: 10:32 AM
 */

/**
 * Body Class
 * *******************************************************
 */
if (!function_exists('g5plus_body_class_name')) {
    function g5plus_body_class_name($classes)
    {
        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
        $classes[]='beyot-class';
        if ($is_lynx) $classes[] = 'lynx';
        elseif ($is_gecko) $classes[] = 'gecko';
        elseif ($is_opera) $classes[] = 'opera';
        elseif ($is_NS4) $classes[] = 'ns4';
        elseif ($is_safari) $classes[] = 'safari';
        elseif ($is_chrome) $classes[] = 'chrome';
        elseif ($is_IE) $classes[] = 'ie';
        else $classes[] = 'unknown';
        if ($is_iphone) $classes[] = 'iphone';

        if (is_singular()) {
            $page_class_extra =  g5plus_get_post_meta('custom_page_css_class', get_the_ID());
            if (!empty($page_class_extra)) {
                $classes[] = $page_class_extra;
            }
        }

        $loading_animation = g5plus_get_option('loading_animation', '');
        if (!empty($loading_animation) && ($loading_animation != 'none')) {
            $classes[] = 'page-loading';
        }

        $layout_style = g5plus_get_option('layout_style', 'wide');

        if ($layout_style === 'boxed') {
            $classes[] = 'boxed';
        }

        if (g5plus_get_option('header_float', '0')) {
            $classes[] = 'header-is-float';

	        if (g5plus_get_option('header_sticky_change_style', '1')) {
		        $classes[] = 'header-sticky-fix-style';
	        }
        }

        $enable_rtl_mode  = g5plus_get_option('enable_rtl_mode', '0');
        if ($enable_rtl_mode === '1' || isset($_GET['RTL']) || is_rtl()) {
            $classes[] = 'rtl';
        }


	    $page_layouts = &g5plus_get_page_layout_settings();
	    if ($page_layouts['has_sidebar']) {
		    $classes[] = 'has-sidebar';
	    }
        return $classes;
    }

    add_filter('body_class', 'g5plus_body_class_name');
}
/**
 * Filter Layout Wrap Class
 */
if (!function_exists('g5plus_layout_wrap_class')) {
    function g5plus_layout_wrap_class($layout_wrap_class){
        global $post;
        $post_type = get_post_type($post);
        $wrap_class = array();
        // custom layout wrap class page
        if (is_page()) {
            $wrap_class[] = 'page-wrap';
        }else{
            // custom layout wrap class blog
            if ((is_home() || is_category() || is_tag() || is_search() || is_archive()) && ($post_type == 'post')) {
	            $post_layouts = &g5plus_get_post_layout_settings();
                $wrap_class[] = 'archive-wrap';
                $wrap_class[] = 'archive-' . $post_layouts['layout'];
            }


            // custom layout wrap class single blog
            if (is_singular('post')) {
                $wrap_class[] = 'single-blog-wrap';
            }

            // custom layout inner class archive property
            if (is_post_type_archive( 'property' ) || is_tax( 'property-type' ) || is_tax( 'property-status' ) || is_tax( 'property-feature' ) || is_tax( 'property-city' ) || is_tax( 'property-state' ) || is_tax( 'property-labels' )|| is_tax( 'property-neighborhood' )  || (is_search() && ($post_type === 'property'))) {
                $inner_class[] = 'archive-property-wrap';
            }
            if (is_post_type_archive( 'agent' ) || is_tax( 'agencies-type' ) || (is_search() && ($post_type === 'agent'))) {
                $inner_class[] = 'archive-agent-wrap';
            }
            // custom layout inner class single property
            if (is_singular('property')) {
                $inner_class[] = 'single-property-wrap';
            }
            if (is_singular('agent')) {
                $inner_class[] = 'single-agent-wrap';
            }
        }

        return array_merge($layout_wrap_class,$wrap_class);

    }
    add_filter('g5plus_filter_layout_wrap_class','g5plus_layout_wrap_class');
}

/**
 * Filter Layout Inner Class
 */
if (!function_exists('g5plus_layout_inner_class')){
    function g5plus_layout_inner_class($layout_inner_class){
        global $post;
        $post_type = get_post_type($post);
        $inner_class = array();

        // custom layout inner class page
        if (is_page()) {
            $inner_class[] = 'page-inner';
        }else{
            // custom layout inner class blog
            if ((is_home() || is_category() || is_tag() || is_search() || is_archive()) && ($post_type === 'post')) {
                $inner_class[] = 'archive-inner';
            }

            // custom layout inner class single blog
            if (is_singular('post')) {
                $inner_class[] = 'single-blog-inner';
            }

            // custom layout inner class archive property
            if (is_post_type_archive( 'property' ) || is_tax( 'property-type' ) || is_tax( 'property-status' ) || is_tax( 'property-feature' ) || is_tax( 'property-city' ) || is_tax( 'property-state' ) || is_tax( 'property-labels' )|| is_tax( 'property-neighborhood' )  || (is_search() && ($post_type === 'property'))) {
                $inner_class[] = 'archive-property-inner';
            }
            if (is_post_type_archive( 'agent' ) || is_tax( 'agencies-type' ) || (is_search() && ($post_type === 'agent'))) {
                $inner_class[] = 'archive-agent-inner';
            }
            // custom layout inner class single property
            if (is_singular('property')) {
                $inner_class[] = 'single-property-inner';
            }
            if (is_singular('agent')) {
                $inner_class[] = 'single-agent-inner';
            }
        }

        return array_merge($layout_inner_class,$inner_class);
    }
    add_filter('g5plus_filter_layout_inner_class','g5plus_layout_inner_class');
}

/**
 * Add search form before Mobile Menu
 * *******************************************************
 */
if (!function_exists('g5plus_search_form_before_menu_mobile')) {
	function g5plus_search_form_before_menu_mobile($params) {
		ob_start();
        $mobile_header_layout = g5plus_get_option('mobile_header_layout', 'header-mobile-1');
		if (g5plus_get_option('mobile_header_menu_drop', 'menu-drop-fly') === 'menu-drop-fly' && g5plus_get_option('mobile_header_search_box', 1) && ($mobile_header_layout !== 'header-mobile-4')) {
			get_search_form();
		}
		$params .= ob_get_clean();
		return $params;
	}
	add_filter('g5plus_before_menu_mobile_filter','g5plus_search_form_before_menu_mobile', 10);
}
/**
 * Add search form
 * *******************************************************
 */
if (!function_exists('g5plus_search_form')) {
    function g5plus_search_form($form)
    {
        $form = '<form role="search" class="search-form" method="get" id="searchform" action="' . home_url('/') . '">
                <input type="text" value="' . get_search_query() . '" name="s" id="s"  placeholder="' . esc_html__("ENTER YOUR  KEYWORD", 'g5-beyot') . '">
                <button type="submit"><i class="fa fa-search"></i></button>
       </form>';
        return $form;
    }
    //add_filter('get_search_form', 'g5plus_search_form');
}

function g5plus_register_icon_libraries_control($additional_sets) {
	$icon_config = array();
	$icon_config['icomoon'] = array(
		'name' => 'icomoon',
		'label' => esc_html__('Icomoon','g5-beyot'),
		'url' => G5PLUS_THEME_URL . 'assets/plugins/icomoon/css/icomoon.css',
		'enqueue' => array(G5PLUS_THEME_URL . 'assets/plugins/icomoon/css/icomoon.css'),
		'prefix' => 'icon-',
		'displayPrefix' => 'icon',
		'labelIcon'	=>	'fab fa-font-awesome-alt',
		'ver'	=>	'1.0.0',
		'fetchJson' => G5PLUS_THEME_URL . 'assets/plugins/icomoon/js/icomoon.js',
		'native'	=>	'true'
	);
	return wp_parse_args($icon_config,$additional_sets) ;
}
add_filter('elementor/icons_manager/additional_tabs','g5plus_register_icon_libraries_control');

