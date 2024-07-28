<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/1/2016
 * Time: 8:34 AM
 */
if (!class_exists('G5plus_FrameWork_Widget')) {
	class G5plus_FrameWork_Widget {

		public function __construct(){
			add_action('widgets_init', array($this,'register_widget'), 1);
			$this->includes();
			spl_autoload_register(array($this,'autoload'));
		}

		public function autoload($class_name) {
			$class = preg_replace('/^G5Plus_Widget_/', '', $class_name);
			if ($class != $class_name) {
				$class = str_replace('_', '-', $class);
				$class = strtolower($class);
				include_once(GF_PLUGIN_DIR . 'widgets/includes/' . $class .'.php');
			}
		}

		private function includes(){
			include_once( GF_PLUGIN_DIR . 'widgets/g5plus-widget.php' );
		}

		public function register_widget(){
			register_widget('G5Plus_Widget_Logo');
			register_widget('G5Plus_Widget_Info');
			register_widget('G5Plus_Widget_Posts');
			register_widget('G5Plus_Widget_Social_Profile');
		}

	}
	new G5plus_FrameWork_Widget();
}