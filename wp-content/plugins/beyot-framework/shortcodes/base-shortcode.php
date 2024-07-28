<?php
if (!class_exists('G5Plus_ShortCode')) {
	abstract class G5Plus_ShortCode extends WPBakeryShortCode {
		/**
		 * Find html template for shortcode output.
		 */
		protected function findShortcodeTemplate() {
			// Check template path in shortcode's mapping settings
			if ( ! empty( $this->settings['html_template'] ) && is_file( $this->settings( 'html_template' ) ) ) {
				return $this->setTemplate( $this->settings['html_template'] );
			}
			// Check template in theme directory
			$user_template = vc_shortcodes_theme_templates_dir( $this->getFileName() . '.php' );
			if ( is_file( $user_template ) ) {
				return $this->setTemplate( $user_template );
			}
			$template_name = preg_replace('/^g5plus_/', '', $this->getFileName());
			$template = GF_PLUGIN_DIR . 'shortcodes/' . str_replace('_', '-', $template_name) . '/template.php';
			// Check default place
			if ( is_file( $template ) ) {
				return $this->setTemplate( $template );
			}

			return '';
		}

		public function getStyleAnimation( $animation_duration, $animation_delay ) {
			$styles = array();
			if ($animation_duration != '0' && !empty($animation_duration)) {
				$animation_duration = (float)trim($animation_duration, "\n\ts");
				$styles[] = "-webkit-animation-duration: {$animation_duration}s";
				$styles[] = "-moz-animation-duration: {$animation_duration}s";
				$styles[] = "-ms-animation-duration: {$animation_duration}s";
				$styles[] = "-o-animation-duration: {$animation_duration}s";
				$styles[] = "animation-duration: {$animation_duration}s";
			}
			if ($animation_delay != '0' && !empty($animation_delay)) {
				$animation_delay = (float)trim($animation_delay, "\n\ts");
				$styles[] = "opacity: 0";
				$styles[] = "-webkit-animation-delay: {$animation_delay}s";
				$styles[] = "-moz-animation-delay: {$animation_delay}s";
				$styles[] = "-ms-animation-delay: {$animation_delay}s";
				$styles[] = "-o-animation-delay: {$animation_delay}s";
				$styles[] = "animation-delay: {$animation_delay}s";
			}
			return $styles;
		}

		public function the_widget($widget, $instance = array()){
			$wrapper_classes = array();
			$widget_layout = gf_get_option('widget_layout','widget-classic');
			if (isset($instance['widget_layout']) && !empty($instance['widget_layout'])) {
				$widget_layout = $instance['widget_layout'];
			}
			$wrapper_classes[] = $widget_layout;

			if (isset($instance['css']) && !empty($instance['css'])) {
				$wrapper_classes[] = vc_shortcode_custom_css_class($instance['css'], ' ');
			}

			$args = array(
				'before_title'  => '<h4 class="widget-title"><span>',
				'after_title'   => '</span></h4>',
				'before_widget' => '<div class="' . implode(' ',$wrapper_classes) .' widget %s">',
			);
			if (isset($instance['widget_id'])) {
				$args['widget_id'] = $instance['widget_id'];
			}
			the_widget($widget,$instance,$args);
		}

		public function the_title($title, $style,$title_size, $align, $scheme) {
			echo do_shortcode('[g5plus_heading title="'. $title .'" style="'. $style .'" size="'. $title_size .'" align="'. $align .'" color_scheme="'. $scheme .'"]');
		}

	}
	abstract class G5Plus_ShortCodesContainer extends WPBakeryShortCodesContainer {
		/**
		 * Find html template for shortcode output.
		 */
		protected function findShortcodeTemplate() {
			// Check template path in shortcode's mapping settings
			if ( ! empty( $this->settings['html_template'] ) && is_file( $this->settings( 'html_template' ) ) ) {
				return $this->setTemplate( $this->settings['html_template'] );
			}
			// Check template in theme directory
			$user_template = vc_shortcodes_theme_templates_dir( $this->getFileName() . '.php' );
			if ( is_file( $user_template ) ) {
				return $this->setTemplate( $user_template );
			}
			$template_name = preg_replace('/^g5plus_/', '', $this->getFileName());
			$template = GF_PLUGIN_DIR . 'shortcodes/' . str_replace('_', '-', $template_name) . '/template.php';
			// Check default place
			if ( is_file( $template ) ) {
				return $this->setTemplate( $template );
			}

			return '';
		}

		public function getStyleAnimation( $animation_duration, $animation_delay ) {
			$styles = array();
			if ($animation_duration != '0' && !empty($animation_duration)) {
				$animation_duration = (float)trim($animation_duration, "\n\ts");
				$styles[] = "-webkit-animation-duration: {$animation_duration}s";
				$styles[] = "-moz-animation-duration: {$animation_duration}s";
				$styles[] = "-ms-animation-duration: {$animation_duration}s";
				$styles[] = "-o-animation-duration: {$animation_duration}s";
				$styles[] = "animation-duration: {$animation_duration}s";
			}
			if ($animation_delay != '0' && !empty($animation_delay)) {
				$animation_delay = (float)trim($animation_delay, "\n\ts");
				$styles[] = "opacity: 0";
				$styles[] = "-webkit-animation-delay: {$animation_delay}s";
				$styles[] = "-moz-animation-delay: {$animation_delay}s";
				$styles[] = "-ms-animation-delay: {$animation_delay}s";
				$styles[] = "-o-animation-delay: {$animation_delay}s";
				$styles[] = "animation-delay: {$animation_delay}s";
			}
			return $styles;
		}

		public function the_widget($widget, $instance = array()){
			$wrapper_classes = array();
			$widget_layout = gf_get_option('widget_layout','widget-classic');
			if (isset($instance['widget_layout']) && !empty($instance['widget_layout'])) {
				$widget_layout = $instance['widget_layout'];
			}
			$wrapper_classes[] = $widget_layout;

			if (isset($instance['css']) && !empty($instance['css'])) {
				$wrapper_classes[] = vc_shortcode_custom_css_class($instance['css'], ' ');
			}

			$args = array(
				'before_title'  => '<h4 class="widget-title"><span>',
				'after_title'   => '</span></h4>',
				'before_widget' => '<div class="' . implode(' ', $wrapper_classes) .' widget %s">',
			);
			if (isset($instance['widget_id'])) {
				$args['widget_id'] = $instance['widget_id'];
			}
			the_widget($widget,$instance,$args);
		}

		public function the_title($title, $style,$title_size, $align, $scheme) {
			echo do_shortcode('[g5plus_heading title="'. $title .'" style="'. $style .'" size="'. $title_size .'" align="'. $align .'" color_scheme="'. $scheme .'"]');
		}
	}
}