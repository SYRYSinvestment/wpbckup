<?php
/**
 * Created by PhpStorm.
 * User: HieuBD
 * Date: 27/01/2022
 * Time: 10:12 PM
 */

/**
 * GET CUSTOM CSS
 * *******************************************************
 */
if (!function_exists('gf_custom_css')) {
	function gf_custom_css()
	{
		$custom_css = '';
		$background_image_css = '';

		$body_background_mode = gf_get_option('body_background_mode', 'background');
		$body_background = gf_get_option('body_background', array());

		if ($body_background_mode == 'background') {

			$background_image_url = isset($body_background['background_image_url']) ? $body_background['background_image_url'] : '';
			$background_color = isset($body_background['background_color']) ? $body_background['background_color'] : '';

			if (!empty($background_color)) {
				$background_image_css .= 'background-color:' . $background_color . ';';
			}

			if (!empty($background_image_url)) {
				$background_repeat = isset($body_background['background_repeat']) ? $body_background['background_repeat'] : '';
				$background_position = isset($body_background['background_position']) ? $body_background['background_position'] : '';
				$background_size = isset($body_background['background_size']) ? $body_background['background_size'] : '';
				$background_attachment = isset($body_background['background_attachment']) ? $body_background['background_attachment'] : '';

				$background_image_css .= 'background-image: url("' . $background_image_url . '");';


				if (!empty($background_repeat)) {
					$background_image_css .= 'background-repeat: ' . $background_repeat . ';';
				}

				if (!empty($background_position)) {
					$background_image_css .= 'background-position: ' . $background_position . ';';
				}

				if (!empty($background_size)) {
					$background_image_css .= 'background-size: ' . $background_size . ';';
				}

				if (!empty($background_attachment)) {
					$background_image_css .= 'background-attachment: ' . $background_attachment . ';';
				}
			}

		}

		if ($body_background_mode == 'pattern') {
			$background_image_url = GF_PLUGIN_URL . 'assets/images/theme-options/' . gf_get_option('body_background_pattern', 'pattern-1.png');
			$background_image_css .= 'background-image: url("' . $background_image_url . '");';
			$background_image_css .= 'background-repeat: repeat;';
			$background_image_css .= 'background-position: center center;';
			$background_image_css .= 'background-size: auto;';
			$background_image_css .= 'background-attachment: scroll;';
		}

		if (!empty($background_image_css)) {
			$custom_css .= 'body{' . $background_image_css . '}';
		}


		$custom_css .= gf_get_option('custom_css', '');

		$custom_scroll = gf_get_option('custom_scroll', 0);
		if ($custom_scroll == 1) {
			$custom_scroll_width = gf_get_option('custom_scroll_width', '10');
			$custom_scroll_color = gf_get_option('custom_scroll_color', '#333');
			$custom_scroll_thumb_color = gf_get_option('custom_scroll_thumb_color', '#1086df');

			$custom_css .= 'body::-webkit-scrollbar {width: ' . $custom_scroll_width . 'px;background-color: ' . $custom_scroll_color . ';}';
			$custom_css .= 'body::-webkit-scrollbar-thumb{background-color: ' . $custom_scroll_thumb_color . ';}';
		}

		$footer_bg_image = gf_get_option('footer_bg_image', array());
		$footer_bg_image = isset($footer_bg_image['url']) ? $footer_bg_image['url'] : '';

		$footer_bg_image_apply_for = gf_get_option('footer_bg_image_apply_for', 'footer.main-footer-wrapper');
		if ($footer_bg_image_apply_for == '') {
			$footer_bg_image_apply_for = 'footer.main-footer-wrapper';
		}

		if (!empty($footer_bg_image)) {
			$footer_bg_css = 'background-image:url(' . $footer_bg_image . ');';
			//$footer_bg_css .= 'background-size: cover;';
			$footer_bg_css .= 'background-position: center center;';
			$footer_bg_css .= 'background-repeat: repeat;';
			$custom_css .= $footer_bg_image_apply_for . ' {' . $footer_bg_css . '}';
		}
		$custom_css .= gf_get_custom_css_variable();
		$custom_css = str_replace("\r\n", '', $custom_css);
		$custom_css = str_replace("\n", '', $custom_css);
		$custom_css = str_replace("\t", '', $custom_css);

		return $custom_css;
	}

	add_filter('g5plus_custom_css', 'gf_custom_css');
}


/**
 * GET Header spacing default
 * *******************************************************
 */
if (!function_exists('gf_get_header_spacing_default')) {
	function &gf_get_header_spacing_default($header_layout)
	{
		$header_default = null;
		switch ($header_layout) {
			case 'header-1':
				$header_default = array(
					'navigation_height' => '82px',
					'header_padding_top' => '0',
					'header_padding_bottom' => '0',
					'logo_max_height' => '82px',
					'logo_padding_top' => '0',
					'logo_padding_bottom' => '0',
				);
				break;
			case 'header-3':
				$header_default = array(
					'navigation_height' => '50px',
					'header_padding_top' => '0',
					'header_padding_bottom' => '0',
					'logo_max_height' => '100px',
					'logo_padding_top' => '0',
					'logo_padding_bottom' => '0',
				);
				break;
			case 'header-4':
				$header_default = array(
					'navigation_height' => '110px',
					'header_padding_top' => '0',
					'header_padding_bottom' => '0',
					'logo_max_height' => '110px',
					'logo_padding_top' => '0',
					'logo_padding_bottom' => '0',
				);
				break;
			default:
				$header_default = array(
					'navigation_height' => '50px',
					'header_padding_top' => '0',
					'header_padding_bottom' => '0',
					'logo_max_height' => '60px',
					'logo_padding_top' => '0',
					'logo_padding_bottom' => '0',
				);
		}
		return $header_default;
	}
}


/**
 * Get custome css variable
 * *******************************************************
 */
if (!function_exists('gf_get_custom_css_variable')) {
	function gf_get_custom_css_variable()
	{
		$header_layout = gf_get_option('header_layout', 'header-1');
		$header_spacing_default = &gf_get_header_spacing_default($header_layout);
		$header_responsive_breakpoint = gf_get_option('header_responsive_breakpoint', '991');
		$body_font = g5plus_process_font(gf_get_option('body_font', array('font_family' => 'Poppins', 'font_weight' => '300', 'font_size' => '14')));
		$secondary_font = g5plus_process_font(gf_get_option('secondary_font', array('font_family' => 'Poppins', 'font_weight' => '300', 'font_size' => '14')));
		$h1_font = g5plus_process_font(gf_get_option('h1_font', array('font_family' => 'Poppins', 'font_weight' => '700', 'font_size' => '64')));
		$h2_font = g5plus_process_font(gf_get_option('h2_font', array('font_family' => 'Poppins', 'font_weight' => '700', 'font_size' => '48')));
		$h3_font = g5plus_process_font(gf_get_option('h3_font', array('font_family' => 'Poppins', 'font_weight' => '700', 'font_size' => '32',)));
		$h4_font = g5plus_process_font(gf_get_option('h4_font', array('font_family' => 'Poppins', 'font_size' => '21', 'font_weight' => '700')));
		$h5_font = g5plus_process_font(gf_get_option('h5_font', array('font_family' => 'Poppins', 'font_size' => '18', 'font_weight' => '700')));
		$h6_font = g5plus_process_font(gf_get_option('h6_font', array('font_family' => 'Poppins', 'font_size' => '16', 'font_weight' => '400')));

		$logo_max_height = gf_get_option('logo_max_height', array('height' => ''));
		if (!is_array($logo_max_height)) {
			$logo_max_height = array('height' => $logo_max_height);
		}
		$logo_max_height = gf_process_unit_value(isset($logo_max_height['height']) ? $logo_max_height['height'] : '', $header_spacing_default['logo_max_height']);

		$mobile_logo_max_height = gf_get_option('mobile_logo_max_height', array('height' => ''));
		$mobile_logo_max_height = gf_process_unit_value(isset($mobile_logo_max_height['height']) ? $mobile_logo_max_height['height'] : '', '50px');

		$logo_padding = gf_get_option('logo_padding', array('top' => '0', 'bottom' => '0'));
		$logo_padding = gf_process_spacing($logo_padding, array(
			'top' => $header_spacing_default['logo_padding_top'],
			'bottom' => $header_spacing_default['logo_padding_bottom'],
		));

		$mobile_logo_padding = gf_get_option('mobile_logo_padding', array('top' => '0', 'bottom' => '0'));
		$mobile_logo_padding = gf_process_spacing($mobile_logo_padding, array(
			'top' => '0',
			'bottom' => '0',
		));

		$top_drawer_padding = gf_get_option('top_drawer_padding', array('top' => '0', 'bottom' => '0'));
		$top_drawer_padding = gf_process_spacing($top_drawer_padding, array(
			'top' => '0',
			'bottom' => '0',
		));

		$top_bar_padding = gf_get_option('top_bar_padding', array('top' => '0', 'bottom' => '0'));
		$top_bar_padding = gf_process_spacing($top_bar_padding, array(
			'top' => '0',
			'bottom' => '0',
		));

		$top_bar_mobile_padding = gf_get_option('top_bar_mobile_padding', array('top' => '0', 'bottom' => '0'));
		$top_bar_mobile_padding = gf_process_spacing($top_bar_mobile_padding, array(
			'top' => '0',
			'bottom' => '0',
		));

		$header_padding = gf_get_option('header_padding', array('top' => '', 'bottom' => ''));
		$header_padding = gf_process_spacing($header_padding, array(
			'top' => $header_spacing_default['header_padding_top'],
			'bottom' => $header_spacing_default['header_padding_bottom'],
		));
		$navigation_height = gf_get_option('navigation_height', array('height' => ''));
		$navigation_height = gf_process_unit_value(isset($navigation_height['height']) ? $navigation_height['height'] : '', $header_spacing_default['navigation_height']);

		$navigation_spacing = gf_process_unit_value(gf_get_option('navigation_spacing', '40px'), '40px');
		$header_customize_nav_spacing = gf_process_unit_value(gf_get_option('header_customize_nav_spacing', '40px'), '40px');
		$header_customize_left_spacing = gf_process_unit_value(gf_get_option('header_customize_left_spacing', '40px'), '40px');
		$header_customize_right_spacing = gf_process_unit_value(gf_get_option('header_customize_right_spacing', '40px'), '40px');

		$footer_padding = gf_get_option('footer_padding', array('top' => '60', 'bottom' => '60'));
		$footer_padding = gf_process_spacing($footer_padding, array(
			'top' => '60',
			'bottom' => '60',
		));

		$bottom_bar_padding = gf_get_option('bottom_bar_padding', array('top' => '25', 'bottom' => '25'));
		$bottom_bar_padding = gf_process_spacing($bottom_bar_padding, array(
			'top' => '25',
			'bottom' => '25',
		));

		$header_float = gf_get_option('header_float', 0);

		/**
		 * COLOR VARIABLE
		 */
		$accent_color = gf_get_option('accent_color', '#fb6a19');
		$foreground_accent_color = gf_get_option('foreground_accent_color', '#fff');
		$text_color = gf_get_option('text_color', '#787878');
		$border_color = gf_get_option('border_color', '#eeeeee');
		$heading_color = gf_get_option('heading_color', '#222222');
		$top_drawer_bg_color = gf_get_option('top_drawer_bg_color', '#2f2f2f');
		$top_drawer_text_color = gf_get_option('top_drawer_text_color', '#c5c5c5');

		$text_color_lightness = gf_color_lighten($text_color, '26%');
		$text_color_lighten = gf_color_lighten($text_color, '9%');
		$text_color_lightness_02 = gf_color_lighten($text_color, '30%');
		$accent_color_lightness = gf_color_lighten($accent_color, '10%');
		$heading_color_lightness = gf_color_lighten($heading_color, '43%');

		$border_color_dark = gf_color_darken($border_color, '6.5%');

		$hsl_accent_color=gf_color_to_hsla($accent_color);
		if ($hsl_accent_color['L'] < 0.7) {
			$x_menu_a_text_hover = $accent_color;
		} else {
			$x_menu_a_text_hover = gf_color_darken($accent_color);
		}

		$heading_color_rgba = gf_color_to_rgba($heading_color);

		$header_bg_color = gf_get_option('header_bg_color', '#fff');
		$header_text_color = gf_get_option('header_text_color', '#787878');
		$header_border_color = gf_get_option('header_border_color', '#eeeeee');

		$top_bar_bg_color = gf_get_option('top_bar_bg_color', '#fff');
		$top_bar_text_color = gf_get_option('top_bar_text_color', '#222222');
		$top_bar_border_color = gf_get_option('top_bar_border_color', '#eee');

		$navigation_bg_color = gf_get_option('navigation_bg_color', '#fff');
		$navigation_text_color = gf_get_option('navigation_text_color', '#222222');

		$navigation_text_color_hover = gf_get_option('navigation_text_color_hover', '#fb6a19');
		$top_bar_mobile_bg_color = gf_get_option('top_bar_mobile_bg_color', '#fff');
		$top_bar_mobile_text_color = gf_get_option('top_bar_mobile_text_color', '#222');
		$top_bar_mobile_border_color = gf_get_option('top_bar_mobile_border_color', '#eee');
		$header_mobile_bg_color = gf_get_option('header_mobile_bg_color', '#fff');
		$header_mobile_text_color = gf_get_option('header_mobile_text_color', '#222');
		$header_mobile_border_color = gf_get_option('header_mobile_border_color', '#eee');

		$footer_bg_color = gf_get_option('footer_bg_color', '#fff');
		$footer_text_color = gf_get_option('footer_text_color', '#4a4a4a');
		$footer_widget_title_color = gf_get_option('footer_widget_title_color', '#111');
		$footer_border_color = gf_get_option('footer_border_color', '#eee');
		$bottom_bar_bg_color = gf_get_option('bottom_bar_bg_color', '#1b2127');
		$bottom_bar_text_color = gf_get_option('bottom_bar_text_color', '#8997a5');
		$bottom_bar_border_color = gf_get_option('bottom_bar_border_color', '#eee');
		$body_font_size = $body_font["font_size"];
		$body_font_size = str_replace('px', '', $body_font_size);
		$body_font_size = $body_font_size . 'px';

		if($top_bar_bg_color == $accent_color){
			$top_bar_equal_color = $heading_color;
			} else {
			$top_bar_equal_color = $accent_color;
		}
		return <<<CSS
:root {
	--g5-body-font: {$body_font["font_family"]};
	--g5-body-font-size: {$body_font_size};
	--g5-body-font-weight: {$body_font['font_weight']};
	--g5-secondary-font: '{$secondary_font["font_family"]}';
	--g5-secondary-font-size: {$secondary_font["font_size"]};
	--g5-secondary-font-weight: {$secondary_font["font_weight"]};
	
	--g5-h1-font : {$h1_font["font_family"]};
	--g5-h1-font-size:  {$h1_font["font_size"]};
	--g5-h1-font-weight : {$h1_font['font_weight']};
	--g5-h2-font : {$h1_font["font_family"]};
	--g5-h2-font-size:  {$h2_font['font_size']};
	--g5-h2-font-weight : {$h2_font['font_weight']};
	--g5-h3-font : {$h3_font["font_family"]};
	--g5-h3-font-size:  {$h3_font['font_size']};
	--g5-h3-font-weight : {$h3_font['font_weight']};
	--g5-h4-font : {$h4_font["font_family"]};
	--g5-h4-font-size:  {$h4_font['font_size']};
	--g5-h4-font-weight : {$h4_font['font_weight']};
	--g5-h5-font : {$h5_font["font_family"]};
	--g5-h5-font-size:  {$h5_font['font_size']};
	--g5-h5-font-weight : {$h5_font['font_weight']};
	--g5-h6-font : {$h5_font["font_family"]};
	--g5-h6-font-size:  {$h6_font['font_size']};
	--g5-h6-font-weight : {$h6_font['font_weight']};	

	--g5-color-accent: {$accent_color};
	--g5-color-accent-foreground :  {$foreground_accent_color};
	--g5-color-heading: {$heading_color};
	--g5-color-heading-r :  {$heading_color_rgba[0]};
	--g5-color-heading-g :  {$heading_color_rgba[1]};
	--g5-color-heading-b :  {$heading_color_rgba[2]};
	--g5-color-text-main: {$text_color};
	--g5-color-border: {$border_color};
	--g5-color-link: {$accent_color};
	--g5-color-link-hover: {$accent_color};
	--g5-top-drawer-bg-color : {$top_drawer_bg_color};
	--g5-top-drawer-text-color : {$top_drawer_text_color};
	--g5-header-background-color : {$header_bg_color};
	--g5-header-border-color : {$header_border_color};
	--g5-header-text-color : {$header_text_color};
	--g5-top-bar-text-color : {$top_bar_text_color};
	--g5-top-bar-border-color : {$top_bar_border_color};
	--g5-top-bar-bg-color : {$top_bar_bg_color};
	
	--g5-navigation-bg-color : {$navigation_bg_color};
	--g5-navigation-text-color : {$navigation_text_color};
	--g5-navigation-text-color-hover : {$navigation_text_color_hover};
	
	--g5-top-bar-mobile-bg-color : {$top_bar_mobile_bg_color};
	--g5-top-bar-mobile-text-color : {$top_bar_mobile_text_color};
	--g5-top-bar_mobile-border-color : {$top_bar_mobile_border_color};
	--g5-header-mobile-bg-color : {$header_mobile_bg_color};
	--g5-header-mobile-text-color : {$header_mobile_text_color};
	--g5-header-mobile-border-color : {$header_mobile_border_color};
	
	--g5-footer-bg-color : {$footer_bg_color};
	--g5-footer-text-color : {$footer_text_color};
	--g5-footer-widget-title-color : {$footer_widget_title_color};
	--g5-footer-border-color : {$footer_border_color};
	--g5-bottom-bar-bg-color : {$bottom_bar_bg_color};
	--g5-bottom_bar_text_color : {$bottom_bar_text_color};
	--g5-bottom-bar-border-color : {$bottom_bar_border_color};
	
	--g5-top-drawer-padding-top : {$top_drawer_padding['top']};
	--g5-top-drawer-padding-bottom : {$top_drawer_padding['bottom']};
	--g5-top-bar-padding-top : {$top_bar_padding['top']};
	--g5-top-bar-padding-bottom : {$top_bar_padding['bottom']};
	--g5-top-bar-mobile-padding-top : {$top_bar_mobile_padding['top']};
	--g5-top-bar-mobile-padding-bottom : {$top_bar_mobile_padding['bottom']};
	--g5-header-padding-top : {$header_padding['top']};
	--g5-header-padding-bottom : {$header_padding['bottom']};
	--g5-navigation-height : {$navigation_height};
	--g5-navigation-spacing : {$navigation_spacing};
	--g5-header-customize-nav-spacing : {$header_customize_nav_spacing};
	--g5-header-customize-left-spacing : {$header_customize_left_spacing};
	--g5-header-customize-right-spacing : {$header_customize_right_spacing};
	
	--g5-footer-padding-top : {$footer_padding['top']};
	--g5-footer-padding-bottom : {$footer_padding['bottom']};
	--g5-bottom-bar-padding-top : {$bottom_bar_padding['top']};
	--g5-bottom-bar-padding-bottom : {$bottom_bar_padding['bottom']};
	
	--g5-logo-max-height : {$logo_max_height};
	--g5-mobile-logo-max-height : {$mobile_logo_max_height};
	--g5-logo-padding-top : {$logo_padding['top']};
	--g5-logo-padding-bottom : {$logo_padding['bottom']};
	--g5-mobile-logo-padding-top : {$mobile_logo_padding['top']};
	--g5-mobile-logo-padding-bottom : {$mobile_logo_padding['bottom']};
	
	--g5-text-color-lightness: {$text_color_lightness};
	--g5-text-color-lighten: {$text_color_lighten};
	--g5-text-color-lightness-02: {$text_color_lightness_02};
	--g5-color-accent-lighten: {$accent_color_lightness};
	--g5-color-heading-lighten: {$heading_color_lightness};
	--g5-border-color-dark: {$border_color_dark};
	--g5-x-menu-a-text-hover:{$x_menu_a_text_hover};
	--g5-top-bar-equal-color : {$top_bar_equal_color};
}
CSS;

	}
}

/**
 * Process spacing variable
 * *******************************************************
 */
if (!function_exists('gf_process_spacing')) {
	function gf_process_spacing($spacing, $default)
	{
		if ($spacing['top'] === '' || $spacing['top'] === 'px') {
			$spacing['top'] = $default['top'];
		}
		if ($spacing['bottom'] === '' || $spacing['bottom'] === 'px') {
			$spacing['bottom'] = $default['bottom'];
		}

		$spacing['top'] = str_replace('px', '', $spacing['top']);
		if (!is_numeric($spacing['top'])) {
			$spacing['top'] = 0;
		}
		$spacing['top'] .= 'px';

		$spacing['bottom'] = str_replace('px', '', $spacing['bottom']);
		if (!is_numeric($spacing['bottom'])) {
			$spacing['bottom'] = 0;
		}
		$spacing['bottom'] .= 'px';

		return $spacing;
	}
}

/**
 * Process unit px value variable
 * *******************************************************
 */
if (!function_exists('gf_process_unit_value')) {
	function gf_process_unit_value($value, $default)
	{
		if ($value === '' || $value === 'px') {
			$value = $default;
		}
		$value = str_replace('px', '', $value);
		if (!is_numeric($value)) {
			$value = 0;
		}
		$value .= 'px';

		return $value;
	}
}

/**
 * Color Contrast
 * *******************************************************
 */
if (!function_exists('gf_color_contrast')) {
	function gf_color_contrast($color, $lightColor = '#fff', $darkColor = '#222')
	{
		return gf_color_is_dark($color) ? $lightColor : $darkColor;
	}
}

/**
 * Color Darken
 * *******************************************************
 */
if (!function_exists('gf_color_darken')) {
	function gf_color_darken($color, $step = '10%')
	{
		if (is_numeric($step)) {
			$step = $step / 255;
		} else {
			$step = floatval($step) / 100;
		}

		$hsla = gf_color_to_hsla($color);
		$hsla['L'] = max($hsla['L'] - $step, 0);

		return gf_color_from_hsla($hsla);
	}
}

/**
 * Color is Dark
 * *******************************************************
 */
if (!function_exists('gf_color_is_dark')) {
	function gf_color_is_dark($color)
	{
		$hsl = gf_color_to_hsla($color);
		return $hsl['L'] < 0.75;
	}
}

/**
 * Color Lighten
 * *******************************************************
 */
if (!function_exists('gf_color_lighten')) {
	function gf_color_lighten($color, $step = '10%')
	{
		if (is_numeric($step)) {
			$step = $step / 255;
		} else {
			$step = floatval($step) / 100;
		}

		$hsla = gf_color_to_hsla($color);
		$hsla['L'] = min($hsla['L'] + $step, 1);
		return gf_color_from_hsla($hsla);
	}
}

/**
 * Color From Hsla
 * *******************************************************
 */
if (!function_exists('gf_color_from_hsla')) {
	function gf_color_from_hsla($hsla)
	{
		if (!is_array($hsla) && (count($hsla) != 4)) {
			return '#000'; // Fail to return black to color
		}
		list($H, $S, $L, $A) = array($hsla['H'] / 360, $hsla['S'], $hsla['L'], $hsla['A']);

		if ($S == 0) {
			$r = $L * 255;
			$g = $L * 255;
			$b = $L * 255;
		} else {

			if ($L < 0.5) {
				$hue_value_2 = $L * (1 + $S);
			} else {
				$hue_value_2 = ($L + $S) - ($S * $L);
			}

			$hue_value_1 = 2 * $L - $hue_value_2;

			$r = round(255 * gf_color_hue_to_rgb($hue_value_1, $hue_value_2, $H + (1 / 3)));
			$g = round(255 * gf_color_hue_to_rgb($hue_value_1, $hue_value_2, $H));
			$b = round(255 * gf_color_hue_to_rgb($hue_value_1, $hue_value_2, $H - (1 / 3)));

		}

		if ($A < 1) {
			return "rgba({$r},{$g},{$b},{$A})";
		}

		// Convert to hex
		$r = dechex($r);
		$g = dechex($g);
		$b = dechex($b);

		// Make sure we get 2 digits for decimals
		$r = (strlen("" . $r) === 1) ? "0" . $r : $r;
		$g = (strlen("" . $g) === 1) ? "0" . $g : $g;
		$b = (strlen("" . $b) === 1) ? "0" . $b : $b;


		return "#{$r}{$g}{$b}";
	}
}

/**
 * Color Hue To Rgb
 * *******************************************************
 */
if (!function_exists('gf_color_hue_to_rgb')) {

	function gf_color_hue_to_rgb($v1, $v2, $vH)
	{
		if ($vH < 0) {
			$vH += 1;
		}

		if ($vH > 1) {
			$vH -= 1;
		}

		if ((6 * $vH) < 1) {
			return ($v1 + ($v2 - $v1) * 6 * $vH);
		}

		if ((2 * $vH) < 1) {
			return $v2;
		}

		if ((3 * $vH) < 2) {
			return ($v1 + ($v2 - $v1) * ((2 / 3) - $vH) * 6);
		}

		return $v1;

	}
}

/**
 * Color To Hsla
 * *******************************************************
 */
if (!function_exists('gf_color_to_hsla')) {
	function gf_color_to_hsla($color)
	{
		$rgb = gf_color_to_rgba($color);
		if (empty($rgb)) {
			return array(
				'H' => 0,
				'S' => 0,
				'L' => 0,
				'A' => 0,
			); // Fail to return Black Color
		}

		$R = $rgb[0];
		$G = $rgb[1];
		$B = $rgb[2];

		$HSLA = array();

		$var_R = ($R / 255);
		$var_G = ($G / 255);
		$var_B = ($B / 255);

		$var_Min = min($var_R, $var_G, $var_B);
		$var_Max = max($var_R, $var_G, $var_B);
		$del_Max = $var_Max - $var_Min;

		$L = ($var_Max + $var_Min) / 2;

		if ($del_Max == 0) {
			$H = 0;
			$S = 0;
		} else {
			if ($L < 0.5) {
				$S = $del_Max / ($var_Max + $var_Min);
			} else {
				$S = $del_Max / (2 - $var_Max - $var_Min);
			}

			$del_R = ((($var_Max - $var_R) / 6) + ($del_Max / 2)) / $del_Max;
			$del_G = ((($var_Max - $var_G) / 6) + ($del_Max / 2)) / $del_Max;
			$del_B = ((($var_Max - $var_B) / 6) + ($del_Max / 2)) / $del_Max;

			if ($var_R == $var_Max) {
				$H = $del_B - $del_G;
			} else if ($var_G == $var_Max) {
				$H = (1 / 3) + $del_R - $del_B;
			} else if ($var_B == $var_Max) {
				$H = (2 / 3) + $del_G - $del_R;
			}

			if ($H < 0) {
				$H++;
			}
			if ($H > 1) {
				$H--;
			}
		}

		$HSLA['H'] = ($H * 360);
		$HSLA['S'] = $S;
		$HSLA['L'] = $L;
		$HSLA['A'] = $rgb[3];

		return $HSLA;
	}
}

/**
 * Color To Rgba
 * *******************************************************
 */
if (!function_exists('gf_color_to_rgba')) {
	function gf_color_to_rgba($color)
	{
		if (preg_match('/^\#([0-9a-f])([0-9a-f])([0-9a-f])$/i', $color, $matchs)) {
			return array(
				hexdec($matchs[1] . $matchs[1]),
				hexdec($matchs[2] . $matchs[2]),
				hexdec($matchs[3] . $matchs[3]),
				1
			);
		}
		if (preg_match('/^\#([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $color, $matchs)) {
			return array(
				hexdec($matchs[1]),
				hexdec($matchs[2]),
				hexdec($matchs[3]),
				1
			);
		}
		if (preg_match('/^rgba\((\d{1,3})\,(\d{1,3})\,(\d{1,3}),(.*)\)$/i', $color, $matchs)) {
			if (($matchs[1] >= 0) && ($matchs[1] < 256)
				&& ($matchs[2] >= 0) && ($matchs[2] < 256)
				&& ($matchs[3] >= 0) && ($matchs[3] < 256)
				&& is_numeric($matchs[4])) {
				return array(
					intval($matchs[1]),
					intval($matchs[2]),
					intval($matchs[3]),
					intval($matchs[4])
				);
			}
		}
		if (preg_match('/^rgb\((\d{1,3})\,(\d{1,3})\,(\d{1,3})\)$/i', $color, $matchs)) {
			if (($matchs[1] >= 0) && ($matchs[1] < 256)
				&& ($matchs[2] >= 0) && ($matchs[2] < 256)
				&& ($matchs[3] >= 0) && ($matchs[3] < 256)) {
				return array(
					intval($matchs[1]),
					intval($matchs[2]),
					intval($matchs[3]),
					1
				);
			}
		}

		return array();
	}
}

