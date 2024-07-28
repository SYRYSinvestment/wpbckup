<?php
// Do not allow directly accessing this file.
use Elementor\Core\Files\CSS\Post;
use Elementor\Core\Settings\Page\Manager;
use Elementor\Plugin;
use Elementor\Controls_Stack;

if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}
if (!class_exists('GF_Core_Elementor')) {
	class GF_Core_Elementor
	{
		private static $_instance;

		public static function getInstance()
		{
			if (self::$_instance == NULL) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		public function init()
		{
			add_filter('ube_get_element_configs', array($this, 'change_ube_get_element_configs'));
			add_filter('ube_autoload_file_dir', array($this, 'change_ube_autoload_file_dir'), 10, 2);
			add_action('elementor/frontend/after_enqueue_styles', array($this, 'elementor_custom_css'));
			add_action('elementor/document/after_save', array($this, 'update_theme_color'), 10, 2);
			add_action('gsf_after_change_options/' . GF_OPTIONS_NAME . '', array($this, 'update_elementor_color'), 11, 2);
			add_action('init', array($this, 'register_scripts'));
			add_action('init', array($this, 'register_style'));
			add_action('elementor/element/before_section_end', array($this, 'remove_control_widget'));
			add_action('elementor/preview/enqueue_scripts', array($this, 'register_preview_scripts'));

			//GSF()->loadFile(GF_PLUGIN_DIR . 'core/elementor/templates.php');
			include_once GF_PLUGIN_DIR . '/core/elementor/templates.php';

		}

		public function update_theme_color($obj, $data)
		{
			if (is_a($obj, 'Elementor\Core\Kits\Documents\Kit')) {
				/**
				 * @var $obj Elementor\Core\Kits\Documents\Kit
				 */
				$map_colors = array(
					'accent' => 'accent_color',
					'text' => 'text_color',
					'border' => 'border_color',
				);

				$system_colors = isset($data['settings']['system_colors']) ? $data['settings']['system_colors'] : array();

				$theme_options = get_option(GF_OPTIONS_NAME, array());

				foreach ($map_colors as $k => $v) {
					$current_color = array();
					foreach ($system_colors as $cl) {
						if ($cl['_id'] === $k) {
							$current_color = $cl;
							break;
						}
					}
					if (isset($current_color['color'])) {
						if (in_array($k, array('accent', 'primary', 'text', 'border'))) {
							if (isset($theme_options[$v])) {
								$theme_options[$v] = $current_color['color'];
							}
						}
					}
				}

				update_option(GF_OPTIONS_NAME, $theme_options);

			}
		}

		public function update_elementor_color($options, $preset)
		{
			if ($preset === '') {
				$map_colors = array(
					'accent' => 'accent_color',
					'text' => 'text_color',
					'border' => 'border_color',
				);

				if (class_exists('Elementor\Plugin')) {
					$kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();

					$kit = Elementor\Plugin::$instance->documents->get($kit_id);
					$meta_key = Elementor\Core\Settings\Page\Manager::META_KEY;
					$kit_raw_settings = $kit->get_meta($meta_key);

					if (!isset($kit_raw_settings['system_colors'])) {
						return;
					}

					foreach ($map_colors as $k => $v) {
						if (isset($options[$v])) {
							foreach ($kit_raw_settings['system_colors'] as &$cl) {
								if ($cl['_id'] === $k) {
									$cl['color'] = $options[$v];
								}
							}
						}
					}

					$kit->update_meta($meta_key, $kit_raw_settings);

					$post_css = Elementor\Core\Files\CSS\Post::create($kit_id);
					$post_css->delete();
				}
			}
		}

		private function get_elements()
		{
			$element_ere = array();
			if (class_exists('Essential_Real_Estate')) {
				$element_ere = array(
					'Agents' => esc_html__('Beyot Agents', 'beyot-framework'),
					'Agency' => esc_html__('Beyot Agent Info', 'beyot-framework'),
					'Property' => esc_html__('Beyot Property', 'beyot-framework'),
					'Property_Featured' => esc_html__('Beyot Property Featured', 'beyot-framework'),
					'Property_Slider' => esc_html__('Beyot Property Slider', 'beyot-framework'),
					'Property_Gallery' => esc_html__('Beyot Property Gallery', 'beyot-framework'),
					'Property_Carousel' => esc_html__('Property Carousel With Left Navigation', 'beyot-framework'),
					'Property_Type' => esc_html__('Beyot Property Type', 'beyot-framework'),
					'Property_Info' => esc_html__('Beyot Property Info', 'beyot-framework'),
					'Property_Mini_Search' => esc_html__('Beyot Property Mini Search', 'beyot-framework'),
					'Property_Search' => esc_html__('Beyot Property Search', 'beyot-framework'),
					'Property_Advanced_Search' => esc_html__('Beyot Property Advanced Search', 'beyot-framework'),
					'Property_Search_Map' => esc_html__('Beyot Property Search Map', 'beyot-framework'),
					'Property_Advanced_Search_Page' => esc_html__('Beyot Property Advanced Search Page', 'beyot-framework'),
				);
			}

			$element = array(
				'Agent_Info' => esc_html__('Beyot Agent Info', 'beyot-framework'),
				'Posts' => esc_html__('Beyot Posts', 'beyot-framework'),
				'Process' => esc_html__('Beyot Process', 'beyot-framework'),
				'Text_Info' => esc_html__('Beyot Text Info', 'beyot-framework'),
				'Nearby_Places' => esc_html__('Beyot Nearby Places', 'beyot-framework'),
			);

			return apply_filters('beyot_elements', array_merge($element, $element_ere));
		}

		public function remove_control()
		{
			$arg = array(
				'ube-counter' => array(
					'counter_number_spacing',
					'counter_media_vertical_alignment',
				)
			);
			return $arg;
		}

		public function register_scripts()
		{
			wp_register_script(GF_PLUGIN_PREFIX . 'process', plugins_url(GF_PLUGIN_NAME . '/assets/js/elements/process.js'), array('jquery'), false);
		}

		public function register_preview_scripts()
		{
			wp_register_script(GF_PLUGIN_PREFIX . 'post', plugins_url(GF_PLUGIN_NAME . '/assets/js/elements/posts.js'), array('jquery'), false);
			wp_register_script(GF_PLUGIN_PREFIX . 'agents', plugins_url(GF_PLUGIN_NAME . '/assets/js/elements/agents.min.js'), array(), false);
			wp_register_script(GF_PLUGIN_PREFIX . 'property', plugins_url(GF_PLUGIN_NAME . '/assets/js/elements/property.min.js'), array('jquery'), true);
			wp_register_script(GF_PLUGIN_PREFIX . 'property-carousel', plugins_url(GF_PLUGIN_NAME . '/assets/js/elements/property-carousel.min.js'), array('jquery'), true);
			wp_register_script(GF_PLUGIN_PREFIX . 'property-featured', plugins_url(GF_PLUGIN_NAME . '/assets/js/elements/property-featured.js'), array('jquery'), false, true);
			wp_register_script(GF_PLUGIN_PREFIX . 'property-gallery', plugins_url(GF_PLUGIN_NAME . '/assets/js/elements/property-gallery.js'), array('jquery'), false, true);
			wp_register_script(GF_PLUGIN_PREFIX . 'property-slider', plugins_url(GF_PLUGIN_NAME . '/assets/js/elements/property-slider.js'), array('jquery'), false, true);
			wp_register_script(GF_PLUGIN_PREFIX . 'property-search', plugins_url(GF_PLUGIN_NAME . '/assets/js/elements/property-search.min.js'), array('jquery'), false, true);
			wp_register_script(GF_PLUGIN_PREFIX . 'property-search-map', plugins_url(GF_PLUGIN_NAME . '/assets/js/elements/property-search-map.min.js'), array('jquery'), false, true);
			wp_register_script(GF_PLUGIN_PREFIX . 'property-advanced-search', plugins_url(GF_PLUGIN_NAME . '/assets/js/elements/property-advanced-search.min.js'), array('jquery'), false, true);

			wp_register_script(GF_PLUGIN_PREFIX . 'nearby-places', plugins_url(GF_PLUGIN_NAME . '/assets/js/elements/nearby-places.js'), array('jquery'), false, true);
		}

		public function register_style()
		{
			wp_register_style(GF_PLUGIN_PREFIX . 'agent-info', plugins_url(GF_PLUGIN_NAME . '/shortcodes/agent-info/assets/scss/agent-info.min.css'), array(), false);
			wp_register_style(GF_PLUGIN_PREFIX . 'property-info', plugins_url(GF_PLUGIN_NAME . '/shortcodes/property-info/assets/scss/property-info.min.css'), array(), false);
			wp_register_style(GF_PLUGIN_PREFIX . 'process', plugins_url(GF_PLUGIN_NAME . '/shortcodes/process/assets/scss/process.css'), array(), false);
			wp_register_style(GF_PLUGIN_PREFIX . 'text_info', plugins_url(GF_PLUGIN_NAME . '/shortcodes/text-info/assets/scss/text-info.min.css'), array(), false);
		}

		public function change_ube_get_element_configs($configs)
		{

			$elements = $this->get_elements();

			$g5_elements = isset($configs['beyot_elements']) ? $configs['beyot_elements'] : array(
				'title' => esc_html__('Beyot Elements', 'beyot-framework'),
				'items' => array()
			);

			foreach ($elements as $k => $v) {
				$g5_elements['items']["Beyot_{$k}"] = array(
					'title' => $v
				);
			}

			$configs['beyot_elements'] = $g5_elements;
			return $configs;
		}

		public function change_ube_autoload_file_dir($path, $class)
		{
			$prefix = 'UBE_Element_Beyot_';
			if (strpos($class, $prefix) === 0) {
				$file_name = substr($class, strlen($prefix));
				$file_name = str_replace('_', '-', $file_name);
				$file_name = strtolower($file_name);
				return GF_PLUGIN_DIR . "elements/{$file_name}/config.php";
			}
			return $path;
		}

		public function remove_control_widget()
		{
			$arg = $this->remove_control();
			foreach ($arg as $k => $v) {
				Plugin::$instance->controls_manager->remove_control_from_stack($k, $v);
			}
		}


		public function elementor_custom_css()
		{
			$body_font = g5plus_process_font(gf_get_option('body_font', array('font_family' => 'Poppins', 'font_weight' => '300', 'font_size' => '14')));

			$secondary_font = g5plus_process_font(gf_get_option('secondary_font', array('font_family' => 'Poppins', 'font_weight' => '300', 'font_size' => '14')));

			$custom_css = <<<CSS
			body.elementor-page {
	--e-global-typography-primary-font-family: '{$secondary_font["font_family"]}';
	
	--e-global-typography-text-font-family : '{$body_font["font_family"]}';
	--e-global-typography-text-font-weight: {$body_font['font_weight']};
}	
			
			
		.elementor-column-gap-default > .elementor-column > .elementor-element-populated {
			padding: 15px;
		}
CSS;
			wp_add_inline_style('elementor-frontend', $custom_css);
		}

	}

	GF_Core_Elementor::getInstance()->init();
}