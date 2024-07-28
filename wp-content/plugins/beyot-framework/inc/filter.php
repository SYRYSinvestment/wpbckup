<?php
/**
 * G5PLUS FRAMEWORK PLUGIN ACTION
 * *******************************************************
 */

/**
 * Add safe_style_css
 * *******************************************************
 */
if (!function_exists('gf_safe_style_css')) {
	function gf_safe_style_css($args) {
		$args [] = 'max-width';
		return $args;
	}
	add_filter( 'safe_style_css', 'gf_safe_style_css');
}
/**
 * Set Preset Setting to Theme Options
 * *******************************************************
 */
if (!function_exists('gf_set_preset_to_theme_option')) {
	function gf_set_preset_to_theme_option($options) {
		$page = isset($_GET['page']) ? $_GET['page'] : '';
		if ($page === 'beyot_options') {
			$current_preset = isset($_POST['gf_select_preset']) ? $_POST['gf_select_preset'] : '';
			if ($current_preset) {
				$options = &gf_load_preset_into_theme_options($GLOBALS['gsf_options'], $current_preset);
			}
		}
		return $options;
	}
	add_action('gsf/build_page/after_get_option', 'gf_set_preset_to_theme_option', 10, 1 );
}

/**
 * Move cat_count category into tag A
 * *******************************************************
 */
if (!function_exists('gf_cat_count_span')) {
	function gf_cat_count_span($links) {
		$links = str_replace('</a> (', ' (', $links);
		$links = str_replace(')', ')</a>', $links);
		return $links;
	}
	add_filter('wp_list_categories', 'gf_cat_count_span');
}

/**
 * This code filters the Archive widget to include the post count inside the link
 * *******************************************************
 */
if (!function_exists('gf_archive_count_span')) {
	function gf_archive_count_span($links) {
		$links = str_replace('</a>&nbsp;(', ' (', $links);
		$links = str_replace(')', ')</a>', $links);
		return $links;
	}
	add_filter('get_archives_link', 'gf_archive_count_span');
}

/**
 * Set Onepage menu
 * *******************************************************
 */
if (!function_exists('gf_main_menu_one_page_filter')) {
	function gf_main_menu_one_page_filter($args) {
		if (isset($args['theme_location']) && !in_array($args['theme_location'], apply_filters('xmenu_location_apply', array('primary', 'mobile')))) {
			return $args;
		}
		$is_one_page = gf_get_post_meta('is_one_page', get_the_ID());
		if($is_one_page!='1'){
			$is_one_page = gf_get_option('is_one_page', 0);
		}
		if ($is_one_page == '1') {
			$args['menu_class'] .= ' menu-one-page';
		}
		return $args;
	}
	add_filter('wp_nav_menu_args','gf_main_menu_one_page_filter', 20);
}

if (!function_exists('gf_replace_font_option_keys')) {
	add_filter('gsf_replace_font_option_keys','gf_replace_font_option_keys');
	function gf_replace_font_option_keys($keys) {
		return wp_parse_args(array(GF_OPTIONS_NAME),$keys);
	}
}


function gf_change_ere_property_search_css_class_field($css_class_field, $search_styles) {
	switch ($search_styles) {
		case 'style-mini-line':
			//$css_class_field = 'col-lg-3 col-md-6 col-sm-6 col-xs-12';
			$css_class_field = 'col-xl-3 col-lg-6 col-md-6 col-12';
			break;
		case 'style-default-small':
			//$css_class_field = 'col-md-4 col-sm-6 col-xs-12';
			$css_class_field = 'col-lg-4 col-md-6 col-12';
			break;
		case 'style-absolute':
			//$css_class_field = 'col-md-12 col-sm-12 col-xs-12';
			$css_class_field = 'col-lg-12 col-md-12 col-12';
			break;
		case 'style-vertical':
			//$css_class_field = 'col-md-6 col-sm-6 col-xs-12';
			$css_class_field = 'col-lg-6 col-md-6 col-12';
			break;
		default:
			//$css_class_field = 'col-md-4 col-sm-6 col-xs-12';
			$css_class_field = 'col-lg-4 col-md-6 col-12';
			break;
	}
	return $css_class_field;
}
add_filter('ere_property_search_css_class_field','gf_change_ere_property_search_css_class_field',10,2);

function gf_change_ere_property_search_css_class_half_field($css_class_half_field,$search_styles) {
	switch ($search_styles) {
		case 'style-mini-line':
			//$css_class_half_field = 'col-lg-3 col-md-3 col-sm-3 col-xs-12';
			$css_class_half_field = 'col-xl-3 col-lg-3 col-md-3 col-12';
			break;
		case 'style-default-small':
			//$css_class_half_field = 'col-md-2 col-sm-3 col-xs-12';
			$css_class_half_field = 'col-lg-2 col-md-3 col-12';
			break;
		case 'style-absolute':
			//$css_class_half_field = 'col-md-6 col-sm-6 col-xs-12';
			$css_class_half_field = 'col-lg-6 col-md-6 col-12';
			break;
		case 'style-vertical':
			//$css_class_half_field = 'col-md-3 col-sm-3 col-xs-12';
			$css_class_half_field = 'col-lg-3 col-md-3 col-12';
			break;
		default:
			//$css_class_half_field = 'col-md-2 col-sm-3 col-xs-12';
			$css_class_half_field = 'col-lg-2 col-md-3 col-12';
			break;
	}
	return $css_class_half_field;
}
add_filter('ere_property_search_css_class_half_field','gf_change_ere_property_search_css_class_half_field',10,2);

function gf_change_ere_property_search_map_css_class_field($css_class_field) {
	//return 'col-md-4 col-sm-6 col-xs-12';
	return 'col-lg-4 col-md-4 col-12';
}
add_filter('ere_property_search_map_css_class_field','gf_change_ere_property_search_map_css_class_field');

function gf_change_ere_property_search_map_css_class_half_field() {
	//return 'col-md-2 col-sm-3 col-xs-12';
	return 'col-lg-2 col-md-3 col-12';
}
add_filter('ere_property_search_map_css_class_half_field','gf_change_ere_property_search_map_css_class_half_field');

function gf_change_ere_property_advanced_search_css_class_field($css_class_field,$column) {
	//$css_class_field = 'col-md-4 col-sm-6 col-xs-12';
	$css_class_field = 'col-lg-4 col-md-6 col-12';
	if ($column == '1') {
		//$css_class_field = 'col-md-12 col-sm-12 col-xs-12';
		$css_class_field = 'col-lg-12 col-md-12 col-12';
	} elseif ($column == '2') {
		//$css_class_field = 'col-md-6 col-sm-6 col-xs-12';
		$css_class_field = 'col-lg-6 col-md-6 col-12';
	} elseif ($column == '3') {
		//$css_class_field = 'col-md-4 col-sm-6 col-xs-12';
		$css_class_field = 'col-lg-4 col-md-6 col-12';
	} elseif ($column == '4') {
		//$css_class_field = 'col-md-3 col-sm-6 col-xs-12';
		$css_class_field = 'col-lg-3 col-md-6 col-12';
	}
	return $css_class_field;
}
add_filter('ere_property_advanced_search_css_class_field','gf_change_ere_property_advanced_search_css_class_field',10,2);

function gf_change_ere_property_advanced_search_css_class_half_field($css_class_half_field,$column) {
	//$css_class_half_field = 'col-md-2 col-sm-3 col-xs-12';
	$css_class_half_field = 'col-lg-2 col-md-3 col-12';
	if ($column == '1') {
		//$css_class_half_field = 'col-md-6 col-sm-6 col-xs-12';
		$css_class_half_field = 'col-lg-6 col-md-6 col-12';
	} elseif ($column == '2') {
		//$css_class_half_field = 'col-md-3 col-sm-3 col-xs-12';
		$css_class_half_field = 'col-lg-3 col-md-3 col-12';
	} elseif ($column == '3') {
		//$css_class_half_field = 'col-md-2 col-sm-3 col-xs-12';
		$css_class_half_field = 'col-lg-2 col-md-3 col-12';
	} elseif ($column == '4') {
		//$css_class_half_field = 'col-md-3 col-sm-3 col-xs-12';
		$css_class_half_field = 'col-lg-3 col-md-3 col-12';
	}
	return $css_class_half_field;
}
add_filter('ere_property_advanced_search_css_class_half_field','gf_change_ere_property_advanced_search_css_class_half_field',10,2);
