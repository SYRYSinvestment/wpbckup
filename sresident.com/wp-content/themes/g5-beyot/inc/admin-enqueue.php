<?php
if (!function_exists('g5plus_admin_enqueue_scripts')) {

	function g5plus_admin_enqueue_scripts() {
		$min_suffix = !(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG) ? '.min' : '';
		/**
		 * font-awesome
		 */
		$url_font_awesome = G5PLUS_THEME_URL . 'assets/plugins/fonts-awesome/css/font-awesome.min.css';
		$cdn_font_awesome = g5plus_get_option('cdn_font_awesome', '');
		if ($cdn_font_awesome) {
			$url_font_awesome = $cdn_font_awesome;
		}

		wp_enqueue_style('ere-font-awesome', $url_font_awesome, array(), '4.7.0', 'all');
		wp_enqueue_style('fontawesome-animation', G5PLUS_THEME_URL . 'assets/plugins/fonts-awesome/css/font-awesome-animation.min.css', array());
		// icomoon
		wp_enqueue_style('icomoon', G5PLUS_THEME_URL . 'assets/plugins/icomoon/css/icomoon'.$min_suffix.'.css', array());
	}
	add_action( 'admin_enqueue_scripts', 'g5plus_admin_enqueue_scripts' );
}