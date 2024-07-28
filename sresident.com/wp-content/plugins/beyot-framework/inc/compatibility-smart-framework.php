<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

add_action('gsf_init', 'gf_fix_theme_option_typography');
if (!function_exists('gf_fix_theme_option_typography')) {
	function gf_fix_theme_option_typography() {
		if (get_option('ere_fix_theme_options') === 'fixed') {
			return;
		}

		$options = get_option(GF_OPTIONS_NAME);
		update_option('_backup_' . GF_OPTIONS_NAME, $options);

		$font_keys = array(
			'body_font',
			'secondary_font',
			'h1_font',
			'h2_font',
			'h3_font',
			'h4_font',
			'h5_font',
			'h6_font',
		);

		foreach ($font_keys as $font_key) {
			if (!isset($options[$font_key]) || !isset($options[$font_key]['font_family'])) {
				continue;
			}
			$options[$font_key]['font_family'] = trim($options[$font_key]['font_family'], "'");
			$options[$font_key]['font_kind'] = ($options[$font_key]['font_kind'] === 'google') ? 'webfonts#webfont' : $options[$font_key]['font_kind'];
		}
		update_option(GF_OPTIONS_NAME, $options);
		update_option('ere_fix_theme_options', 'fixed');
	}
}

add_action('gsf_admin_menu_font_management_parent_slug', 'gf_font_management_parent_slug');
function gf_font_management_parent_slug($slug) {
	return 'gf-system-status';
}

add_filter( 'gsf_theme_font_default', 'gf_setup_font_default');
function gf_setup_font_default($fonts) {
	if (empty($fonts)) {
		$options = get_option(GF_OPTIONS_NAME);

		$font_keys = array(
			'body_font',
			'secondary_font',
			'h1_font',
			'h2_font',
			'h3_font',
			'h4_font',
			'h5_font',
			'h6_font',
		);

		$font_list = array();
		foreach ($font_keys as $font_key) {
			if (!isset($options[$font_key]) || !isset($options[$font_key]['font_family'])) {
				continue;
			}

			$font_list[$options[$font_key]['font_family']] = array(
				'family' => trim($options[$font_key]['font_family'], "\' "),
				'kind' => isset($options[$font_key]['font_kind'])
					? ($options[$font_key]['font_kind'] === 'google' ? 'webfonts#webfont' : $options[$font_key]['font_kind'] )
					: 'webfonts#webfont',
			);
		}
		$fonts = array_values($font_list);

		if (empty($fonts)) {
			$fonts = array(
				array(
					'family' => "Poppins",
					'kind'   => 'webfonts#webfont'
				)
			);
		}
	}
	return $fonts;
}