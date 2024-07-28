<?php
if (!class_exists('G5plus_FrameWork_Datetimepicker_Param')) {
	class G5plus_FrameWork_Datetimepicker_Param{
		public function __construct(){
			add_action( 'vc_load_default_params', array(&$this,'vc_load_datetimepicker_param'));
		}

		public function vc_load_datetimepicker_param(){
			vc_add_shortcode_param( 'datetimepicker', array(&$this,'vc_datetimepicker_form_field'),plugins_url(GF_PLUGIN_NAME . '/vc-params/datetimepicker/assets/js/datetimepicker.js'));
		}
		function vc_datetimepicker_form_field( $settings, $value ) {
			$value = htmlspecialchars( $value );
			return '<input name="' . esc_attr( $settings['param_name'] ) . '" class="datetimepicker wpb_vc_param_value wpb-textinput ' .
			esc_attr( $settings['param_name'] ) . ' ' .
			esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />';
		}
	}
	new G5plus_FrameWork_Datetimepicker_Param();
}