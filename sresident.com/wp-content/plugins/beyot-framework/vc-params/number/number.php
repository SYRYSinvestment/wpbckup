<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/6/2016
 * Time: 10:09 AM
 */
if (!class_exists('G5plus_FrameWork_Number_Param')) {
	class G5plus_FrameWork_Number_Param {
		public function __construct(){
			add_action( 'vc_load_default_params', array(&$this,'vc_load_number_param'));
		}

		public function vc_load_number_param(){
			vc_add_shortcode_param( 'number', array(&$this,'vc_number_form_field'));
		}

		public function vc_number_form_field($settings, $value){
			$value = htmlspecialchars( $value );
			$min = isset($settings['min']) ? $settings['min'] : '';
			$max = isset($settings['max']) ? $settings['max'] : '';
			$suffix = isset($settings['suffix']) ? $settings['suffix'] : '';
			return '<input name="' . $settings['param_name']
			. '" class="wpb_vc_param_value wpb-number-input '
			. $settings['param_name'] . ' ' . $settings['type']
			. '" type="number" value="' . $value . '" min="'. $min.'" max="'. $max.'"/>' . $suffix;

		}
	}
	new G5plus_FrameWork_Number_Param();
}