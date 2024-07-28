<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 6/17/2016
 * Time: 10:18 AM
 */

/**
 * Load stylesheet
 */
if (!function_exists('g5plus_enqueue_styles')) {
    function g5plus_enqueue_styles()
    {

        $min_suffix = g5plus_get_option('enable_minifile_css', 0) == 1 ? '.min' : '';

        /*font-awesome*/
        $url_font_awesome = G5PLUS_THEME_URL . 'assets/plugins/fonts-awesome/css/font-awesome.min.css';
        $cdn_font_awesome = g5plus_get_option('cdn_font_awesome', '');
        if ($cdn_font_awesome) {
            $url_font_awesome = $cdn_font_awesome;
        }

        wp_enqueue_style('font-awesome', $url_font_awesome, array(), '4.7.0', 'all');
        wp_enqueue_style('fontawesome_animation', G5PLUS_THEME_URL . 'assets/plugins/fonts-awesome/css/font-awesome-animation.min.css', array());
        // icomoon
        wp_enqueue_style('icomoon', G5PLUS_THEME_URL . 'assets/plugins/icomoon/css/icomoon'.$min_suffix.'.css', array());
        /*bootstrap*/
	    wp_enqueue_style('bootstrap');

        /*owl-carousel*/
        wp_enqueue_style('owl.carousel', G5PLUS_THEME_URL . 'assets/plugins/owl-carousel/assets/owl.carousel.min.css', array(), '2.3.4', 'all');

        /* light gallery */
        wp_enqueue_style('light-gallery', G5PLUS_THEME_URL . 'assets/plugins/light-gallery/css/lightgallery.min.css', array());

        /* perffect scrollbar */
        wp_enqueue_style('perffect-scrollbar', G5PLUS_THEME_URL . 'assets/plugins/perfect-scrollbar/css/perfect-scrollbar.min.css', array());



	    $loading_animation = g5plus_get_option('loading_animation', 'none');
	    if (in_array($loading_animation,array(
		    'chasing-dots',
		    'circle',
		    'cube',
		    'double-bounce',
		    'fading-circle',
		    'folding-cube',
		    'pulse',
		    'three-bounce',
		    'wave'
	    ))) {
		    wp_enqueue_style('loading-animation', G5PLUS_THEME_URL ."assets/css/loading/{$loading_animation}.min.css", array());
	    }

	    /**
	     * Enqueue style.css
	     */

	    wp_enqueue_style('g5plus_framework_style', G5PLUS_THEME_URL . 'style' . $min_suffix . '.css',array(),time(),'all');

	    $enable_rtl_mode = g5plus_get_option('enable_rtl_mode', 0);
	    /**
	     * Enqueue rtl.css
	     */
	    if (is_rtl() || $enable_rtl_mode || isset($_GET['RTL'])) {
		    wp_enqueue_style('g5plus_framework_rtl', G5PLUS_THEME_URL . 'assets/css/rtl.min.css');
	    }

    }

    add_action('wp_enqueue_scripts', 'g5plus_enqueue_styles', 11);
}

/**
 * Load script
 */
if(!function_exists('g5plus_enqueue_script')){
    function g5plus_enqueue_script(){
        $enable_minifile_js = g5plus_get_option('enable_minifile_js',0);
        $min_suffix = (isset($enable_minifile_js) && $enable_minifile_js == 1) ? '.min' :  '';


	    /*bootstrap*/
	    wp_enqueue_script('bootstrap');


        if (is_singular())	wp_enqueue_script('comment-reply');
        wp_enqueue_script('owl.carousel', G5PLUS_THEME_URL . 'assets/plugins//owl-carousel/owl.carousel.min.js', array('jquery'), '2.3.4', true);
        wp_register_script('hc-sticky',G5PLUS_THEME_URL. 'assets/plugins/hc-sticky/jquery.hc-sticky.min.js',array('jquery'),'1.2.43',true);
        wp_enqueue_script('light-gallery',G5PLUS_THEME_URL. 'assets/plugins/light-gallery/js/lightgallery-all.min.js',array('jquery'),'1.2.18',true);
        wp_enqueue_script('isotope',G5PLUS_THEME_URL. 'assets/plugins/isotope/isotope.pkgd.min.js',array('jquery'),'3.0.5',true);
        wp_enqueue_script('perfect-scrollbar',G5PLUS_THEME_URL. 'assets/plugins/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js',array('jquery'),'0.6.11',true);
        wp_enqueue_script('jquery.waypoints',G5PLUS_THEME_URL. 'assets/plugins/waypoints/jquery.waypoints.min.js',array('jquery'),'4.0.1',true);
        wp_enqueue_script('modernizr',G5PLUS_THEME_URL. 'assets/plugins/modernizr/modernizr.min.js',array('jquery'),'3.5.0',true);
        wp_enqueue_script('dialogfx',G5PLUS_THEME_URL. 'assets/plugins/dialogfx/dialogfx.min.js',array('jquery','modernizr'),'1.0.0',true);

        wp_enqueue_script('infinite-scroll',G5PLUS_THEME_URL. 'assets/plugins/infinite-scroll/infinite-scroll.pkgd.min.js',array('jquery'),'2.0.1',true);
        wp_enqueue_script('One-Page-Nav',G5PLUS_THEME_URL. 'assets/plugins/jquery.nav/jquery.nav.min.js',array('jquery'),'3.0.0',true);
        wp_enqueue_script('stellar',G5PLUS_THEME_URL. 'assets/plugins/stellar/jquery.stellar.js',array('jquery'),'0.6.2',true);
        wp_enqueue_script('countdown',G5PLUS_THEME_URL. 'assets/plugins/countdown/countdown.min.js',array('jquery'),'0.6.2',true);
        wp_enqueue_script('waypoints',G5PLUS_THEME_URL. 'assets/plugins/waypoints/jquery.waypoints.min.js',array('jquery'),'4.0.1',true);
        wp_enqueue_script('matchmedia',G5PLUS_THEME_URL. 'assets/plugins/matchmedia/matchmedia.min.js',array('jquery'),'4.0.1',true);

        wp_enqueue_script('g5plus_framework_app', G5PLUS_THEME_URL . 'assets/js/main' . $min_suffix . '.js', array('jquery','owl.carousel','imagesloaded','One-Page-Nav','stellar','countdown','matchmedia','perfect-scrollbar','infinite-scroll','dialogfx','modernizr','isotope','light-gallery','hc-sticky'), false, true);

        // Localize the script with new data
        $translation_array = array(
            'carousel_next' => esc_html__('Next','g5-beyot'),
            'carousel_prev' => esc_html__('Back','g5-beyot')
        );
        wp_localize_script('g5plus_framework_app', 'g5plus_framework_constant', $translation_array);
        wp_localize_script(
            'g5plus_framework_app',
            'g5plus_app_variable',
            array(
                'ajax_url' => get_site_url() . '/wp-admin/admin-ajax.php',
                'theme_url' => G5PLUS_THEME_URL,
                'site_url' => site_url()
            )
        );
    }
    add_action('wp_enqueue_scripts', 'g5plus_enqueue_script');
}


function g5plus_register_assets() {
	$cdn_bootstrap_css = g5plus_get_option('cdn_bootstrap_css', '');
	if (!empty($cdn_bootstrap_css)) {
		wp_register_style('bootstrap', $cdn_bootstrap_css);
	} else {


		$enable_rtl_mode = g5plus_get_option('enable_rtl_mode', 0);
		/**
		 * Enqueue rtl.css
		 */
		if (is_rtl() || $enable_rtl_mode || isset($_GET['RTL'])) {
			wp_register_style('bootstrap', G5PLUS_THEME_URL . 'assets/vendors/bootstrap-rtl/css/bootstrap-rtl.min.css', array(),'4.6.0');
		} else {
			wp_register_style('bootstrap', G5PLUS_THEME_URL . 'assets/vendors/bootstrap/css/bootstrap.min.css', array(),'4.6.0');
		}


	}

	$cdn_bootstrap_js = g5plus_get_option('cdn_bootstrap_js', '');
	if (!empty($cdn_bootstrap_js)) {
		wp_register_script('bootstrap', $cdn_bootstrap_js,array('jquery'),false,true);
	} else {
		wp_register_script('bootstrap', G5PLUS_THEME_URL . 'assets/vendors/bootstrap/js/bootstrap.bundle.min.js', array('jquery'),'4.6.0',true);
	}


	$google_map_ssl = g5plus_get_option('google_map_ssl', 0);
	$google_map_api_key = g5plus_get_option('google_map_api_key', 'AIzaSyBqmFdSPp4-iY_BG14j_eUeLwOn9Oj4a4Q');
	if (esc_html($google_map_ssl) == 1 || is_ssl()) {
		wp_register_script('google-map', 'https://maps-api-ssl.google.com/maps/api/js?libraries=places&language=' . get_locale() . '&key=' . $google_map_api_key, array('jquery'), false, true);
	} else {
		wp_register_script('google-map', 'http://maps.googleapis.com/maps/api/js?libraries=places&language=' . get_locale() . '&key=' . $google_map_api_key, array('jquery'), false, true);
	}



}

add_action('init','g5plus_register_assets',9);


/**
 * Header Responsive
 * *******************************************************
 */
if (!function_exists('g5plus_header_responsive_css')) {
	function g5plus_header_responsive_css() {
		$responsive_break_point = g5plus_get_option('header_responsive_breakpoint', '991');
		$responsive_break_point_2 = $responsive_break_point + 1;

		return <<<CUSTOM_CSS
@media screen and (min-width: {$responsive_break_point_2}px) {
	header.header-mobile {
		display: none;
		height: 0;
	}
}

/*--------------------------------------------------------------
## MOBILE MENU
--------------------------------------------------------------*/
@media screen and (max-width: {$responsive_break_point}px) {
	body {
		-webkit-transition: all 0.3s;
		-moz-transition: all 0.3s;
		-ms-transition: all 0.3s;
		-o-transition: all 0.3s;
		transition: all 0.3s;
		left: 0;
	}
	
	header.main-header {
		display: none;
	}	
	
	.top-drawer-mobile-invisible {
		display: none;
	}
}


CUSTOM_CSS;


	}
}

if (!function_exists('g5plus_getCustomCss')) {
	function g5plus_getCustomCss(){
		$custom_css = '';
		$custom_css .= g5plus_header_responsive_css();
		$custom_css .= strip_tags(apply_filters('g5plus_custom_css', $custom_css));
		wp_add_inline_style('g5plus_framework_style', $custom_css);
	}
	add_action('wp_enqueue_scripts', 'g5plus_getCustomCss',12);
}