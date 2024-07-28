<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
if (!class_exists('GF_VC')) {
	class  GF_VC {
		private static $_instance;

		public static function getInstance()
		{
			if (self::$_instance == NULL) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		public function init() {
			add_filter('single_template',array($this,'change_g5core_vc_template'));
			add_action('wp', array($this,'change_g5core_vc_template_layout_setting'), 15);

			add_filter('vc_load_default_templates',array($this,'load_templates'));
			add_filter('vc_get_all_templates',array($this,'add_templates_tab'));
			add_filter('vc_templates_render_category', array(&$this, 'render_template_block'), 100);

			add_action('admin_enqueue_scripts', array(&$this, 'enqueue_admin_resources'));

			include_once GF_PLUGIN_DIR . '/core/vc/templates.php';

		}

		public function enqueue_admin_resources() {
			wp_enqueue_style(GF_PLUGIN_PREFIX . 'vc', plugins_url(GF_PLUGIN_NAME . '/core/vc/assets/css/vc.min.css'), array(), false, 'all');
			wp_enqueue_script(GF_PLUGIN_PREFIX . 'vc', plugins_url(GF_PLUGIN_NAME . '/core/vc/assets/js/vc.min.js'), array('jquery'), false, true);
		}

		public function change_g5core_vc_template($template) {
			if (is_singular(array('g5core_vc_template'))) {
				$template = GF_PLUGIN_DIR . '/core/vc/templates/single-template.php';
			}
			return $template;
		}

		public function change_g5core_vc_template_layout_setting() {
			if (is_singular(array('g5core_vc_template'))) {
				$page_layouts = &gf_get_page_layout_settings();
				$page_layouts['remove_content_padding'] = 1;
				$page_layouts['sidebar_layout'] = 'none';
				$page_layouts['has_sidebar'] = 0;
			}
		}

		public function load_templates(){
			return apply_filters('g5element_vc_load_templates', array());
		}

		public function load_template_categories(){
			return apply_filters('g5element_vc_template_categories', array());
		}

		public function add_templates_tab($data) {
			$current_theme = wp_get_theme();
			foreach ($data as &$cate) {
				if ($cate['category'] === 'default_templates') {
					$cate['category_weight'] = 1;
					$cate['category_name'] =  $current_theme['Name'];
				}
			}
			return $data;
		}

		public function render_template_block($category) {
			if ($category['category'] === 'default_templates') {
				$html = '<div class="vc_col-md-2 g5element-templates-cat-wrap">';
				$html .= '<div class="g5element-templates-cat-inner">';
				$html .= $this->render_template_categories();
				$html .= '</div>';
				$html .= '</div>';


				$html .= '<div class="vc_col-md-12 g5element-templates-wrap">';
				$html .= '<div class="g5element-templates-inner">';
				if (!empty($category['templates'])) {
					foreach ($category['templates'] as $template) {
						$html .= $this->render_template_item($template);
					}
				}
				$html .= '</div>';
				$html.= '</div>';


				$category['output'] = $html;
			}
			return $category;
		}

		public function render_template_categories() {

			$categories = $this->load_template_categories();
			$html = '<ul>';
			foreach ($categories as $slug => $name) {
				if ($slug === 'all') {
					$html .= '<li class="active" data-filter="*">' . $name . '</li>';
				} else {
					$html.= '<li data-filter=".'. $slug .'">' . $name . '</li>';;
				}
			}
			$html .= '</ul>';
			return $html;
		}

		public function render_template_item($template) {
			$template_image_path = apply_filters('g5element_template_image_dir', array(
				'dir' => GF_PLUGIN_DIR . '/assets/images/templates/',
				'url' => plugins_url(GF_PLUGIN_NAME . '/assets/images/templates/'),
			));

			$template_image_path_dir = $template_image_path['dir'];
			$template_image_path_url = $template_image_path['url'];

			$name = isset($template['name']) ? esc_html($template['name']) : __('No title', 'beyot-framework');
			$template_id = $template['unique_id'];
			$template_id_hash = md5($template_id);
			$template_name = esc_html($name);
			$template_image = file_exists("{$template_image_path_dir}{$template['image']}.jpg") ? "{$template_image_path_url}{$template['image']}.jpg" : plugins_url(GF_PLUGIN_NAME . '/assets/images/templates.jpg');

			$template_name_lower = vc_slugify($template_name);
			$template_type = isset($template['type']) ? $template['type'] : 'custom';
			$custom_class = isset($template['custom_class']) ? $template['custom_class'] : '';
			$add_template_title = esc_attr__('Add template', 'beyot-framework');
			$output = <<< HTML
			<div class="g5element-template-item vc_ui-template $custom_class"
						data-template_id="$template_id"
						data-template_id_hash="$template_id_hash"
						data-category="$template_type"
						data-template_unique_id="$template_id"
						data-template_name="$template_name_lower"
						data-template_type="$template_type"
						data-vc-content=".vc_ui-template-content">
			<div class="vc_ui-list-bar-item">
                <div class="g5element-template-thumbnail">
                    <img src="$template_image" alt="$template_name"/>  
                </div>
			<div class="g5element-template-item-name">
			    $template_name
            </div>
            			
            <a data-template-handler="" title="$add_template_title" href="javascript:;" class="vc_ui-panel-template-download-button">
                <i class="vc-composer-icon vc-c-icon-add"></i>
            </a>
            </div>
            </div>			
				
HTML;
			return $output;
		}


	}

	GF_VC::getInstance()->init();
}
