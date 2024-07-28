<?php
if (!class_exists('G5plus_FrameWork_Select2_Param')) {
	class G5plus_FrameWork_Select2_Param{
		public function __construct(){
			add_action( 'vc_load_default_params', array(&$this,'vc_load_select2_param'));
		}

		public function vc_load_select2_param(){
			vc_add_shortcode_param( 'select2', array(&$this,'vc_select2_form_field'),plugins_url(GF_PLUGIN_NAME . '/vc-params/select2/assets/select2.js'));
		}
		function vc_select2_form_field( $settings, $value ) {
			$multiple = isset($settings['multiple']) ? $settings['multiple'] : false;
			if ($multiple) {
				$output = '';
				$value = htmlspecialchars( $value );
				$output .= '<input name="'
					. $settings['param_name']
					. '" id="'
					. $settings['param_name']
					. '" class="wpb_vc_param_value vc_hidden-field vc_param-name-'
					. $settings['param_name']
					. ' ' . $settings['type']
					. '" type="hidden"'
					. ' value="' . $value . '"/>';
				$output .= '<select multiple name="'
					. $settings['param_name'] . '_select2'
					. '" id="'
					. $settings['param_name'] . '_select2">';
				foreach ( $settings['options'] as $index => $data ) {
					if ( is_numeric( $index ) && ( is_string( $data ) || is_numeric( $data ) ) ) {
						$option_label = $data;
						$option_value = $data;
					} elseif ( is_numeric( $index ) && is_array( $data ) ) {
						$option_label = isset( $data['label'] ) ? $data['label'] : array_pop( $data );
						$option_value = isset( $data['value'] ) ? $data['value'] : array_pop( $data );
					} else {
						$option_value = $data;
						$option_label = $index;
					}
					$output .= '<option  value="' . esc_attr( $option_value ) . '">' . htmlspecialchars( $option_label ) . '</option>';
				}
				$output .= '</select>';
				return $output;
			} else {
				return vc_dropdown_form_field($settings,$value);
			}

		}

	}
	new G5plus_FrameWork_Select2_Param();
}