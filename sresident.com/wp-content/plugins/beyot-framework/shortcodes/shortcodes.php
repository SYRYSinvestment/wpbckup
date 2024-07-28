<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/2/2016
 * Time: 10:49 AM
 */
if (!class_exists('G5plus_FrameWork_ShortCodes')) {
	class G5plus_FrameWork_ShortCodes{
		public function __construct(){
			$this->define_constants();
			$this->includes();
			add_action( 'vc_after_init', array($this,'vc_custom_params'));
			spl_autoload_register(array($this,'autoload'));
			add_action('admin_head', array($this,'g5plus_custom_wp_admin_style'));
		}

		private function define_constants(){
			if (!defined('GF_SHORTCODE_CATEGORY')) {
				define('GF_SHORTCODE_CATEGORY', esc_html__('Beyot Shortcodes', 'beyot-framework'));
			}
		}
		public function includes() {
			include_once GF_PLUGIN_DIR . 'shortcodes/functions.php';
			include_once GF_PLUGIN_DIR . 'shortcodes/lean-map.php';
			include_once GF_PLUGIN_DIR . 'shortcodes/base-shortcode.php';
			include_once GF_PLUGIN_DIR . 'shortcodes/auto-complete.php';
		}
		public function autoload($class){
			$class = preg_replace('/^WPBakeryShortCode_g5plus_/', '', $class);
			$class = str_replace('_', '-', $class);
			$class = strtolower($class);
			set_include_path(GF_PLUGIN_DIR .'shortcodes/' . $class . '/');
			spl_autoload_extensions('.php');
			spl_autoload($class);
		}

		public function vc_custom_params(){
			require_once GF_PLUGIN_DIR . "vc-params/select2/select2.php";
			require_once GF_PLUGIN_DIR . "vc-params/number/number.php";
			require_once GF_PLUGIN_DIR . "vc-params/datetimepicker/datetimepicker.php";
		}
		function g5plus_custom_wp_admin_style()
		{
			$accent_color = gf_get_option('accent_color','#fb6a19');
			echo "<style>
			.vc_colored-dropdown .primary-color {
				background-color: {$accent_color} !important;
			}
			.vc_element-icon.fa
			{
				color: {$accent_color} !important;
			}
			</style>";
		}
	}
	new G5plus_FrameWork_ShortCodes();
}