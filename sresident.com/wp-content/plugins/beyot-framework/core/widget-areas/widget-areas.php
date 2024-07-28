<?php
/**
 * G5Plus Framework Widget Areas Manager
 *
 * @package WordPress
 * @subpackage emo
 * @since emo 1.0
 */
if (!class_exists('GF_Widget_Areas')) {
	class GF_Widget_Areas {

		private static $_instance;
		public static function getInstance()
		{
			if (self::$_instance == NULL) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		protected $widget_areas = array();

		protected $version = '1.0';

		protected $widget_areas_key =  'gf-widget-areas';

		public function init() {
			add_action('widgets_init',array(&$this, 'register_custom_widget_areas'),11);
			add_filter('gf_dashboard_menu_config',array($this,'sidebars_menu'));
			add_action('admin_enqueue_scripts',array($this,'enqueue'));
			add_action('wp_loaded', array($this, 'add_sidebar'));
			add_action( 'wp_ajax_gf_delete_widget_area', array( $this, 'delete_widget_area' ) );
		}


		public function __construct() {

		}

		public function sidebars_menu($config) {
			return wp_parse_args(array(
				'sidebar_management' => array(
					'page_title' => esc_html__('Sidebars Management', 'beyot-framework'),
					'menu_title' => esc_html__('Sidebars Management', 'beyot-framework'),
					'type' => 'page',
					'function_binder' => array($this,'sidebars_page'),
					'priority' => 60,
				),
			),$config);


		}

		public function sidebars_page() {
			include_once plugin_dir_path(__FILE__) . 'views/sidebars.php';
		}

		public function enqueue() {
			$current_page = isset( $_GET['page'] ) ? $_GET['page'] : '';
			if ( $current_page == 'gf-sidebar_management' ) {
				$suffix = !(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG) ? '.min' : '';
				wp_enqueue_script(GF_PLUGIN_PREFIX.'widget-areas', plugins_url(GF_PLUGIN_NAME . '/core/widget-areas/assets/js/widget-areas'.$suffix.'.js'), array('jquery'), $this->version);
				wp_enqueue_style(GF_PLUGIN_PREFIX.'widget-areas', plugins_url(GF_PLUGIN_NAME . '/core/widget-areas/assets/css/widget-areas'.$suffix.'.css'), array(), $this->version, 'screen');
				wp_localize_script(GF_PLUGIN_PREFIX.'widget-areas',
					'gf_widget_areas_variable',
					array(
						'ajax_url' => wp_nonce_url(admin_url('admin-ajax.php?action=gf_delete_widget_area'), 'gf-delete-widget-area-action', '_wpnonce'),
						'confirm_delete' => esc_html__('Are you sure to delete this widget areas?', 'beyot-framework')
					)
				);
			}
		}


		public function get_widget_areas() {
			// If the single instance hasn't been set, set it now.
			if ( !empty($this->widget_areas) ) {
				return $this->widget_areas;
			}

			$db = get_option($this->widget_areas_key);
			if (!empty($db)) {
				$this->widget_areas = array_unique(array_merge($this->widget_areas, $db));
			}
			return $this->widget_areas;
		}

		public function register_custom_widget_areas() {
			// If the single instance hasn't been set, set it now.
			if ( empty($this->widget_areas) ) {
				$this->widget_areas = $this->get_widget_areas();
			}
			$args = array(
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title"><span>',
				'after_title'   => '</span></h4>',
			);

			$args = apply_filters('gf_custom_widget_args', $args);

			if (is_array($this->widget_areas)) {
				foreach (array_unique($this->widget_areas) as $widget_area) {
					$args['class']   = 'gf-widgets-custom';
					$args['name']    = $widget_area;
					$args['id']      = sanitize_key( $widget_area );
					register_sidebar($args);
				}
			}
		}

		function save_widget_areas() {
			update_option($this->widget_areas_key,array_unique( $this->widget_areas ));
		}

		public function add_new_widget_area_box() {
			include_once plugin_dir_path(__FILE__) . 'views/widget-area-box.php';
		}


		public function add_sidebar() {
			if (!isset($_POST['gf_add_sidebar_nonce']) || !wp_verify_nonce(sanitize_text_field($_POST['gf_add_sidebar_nonce']), 'gf_add_sidebar_action')) {
				return;
			}
			$widget_name = $_POST['gf-add-widget-input'];
			if (!empty($widget_name)) {
				$this->widget_areas = $this->get_widget_areas();

				$widget_name = $this->check_widget_area_name($widget_name);

				$widgetId = sanitize_key($widget_name);

				$this->widget_areas[$widgetId] = $widget_name;

				$this->save_widget_areas();

				wp_redirect($_POST['_wp_http_referer']);
				die();
			}
		}

		public function check_widget_area_name($name) {
			global $wp_registered_sidebars;
			if(empty($wp_registered_sidebars))
				return $name;

			$taken = array();
			foreach ( $wp_registered_sidebars as $widget_area ) {
				$taken[] = $widget_area['name'];
			}
			if(in_array($name, $taken)) {
				$counter  = substr($name, -1);
				if(!is_numeric($counter)) {
					$new_name = $name . " 1";
				} else {
					$new_name = substr($name, 0, -1) . ((int) $counter + 1);
				}

				$name = $this->check_widget_area_name($new_name);
			}
			return $name;
		}

		function delete_widget_area() {
			if (!check_ajax_referer('gf-delete-widget-area-action','_wpnonce')) return;
			if(!empty($_REQUEST['name'])) {
				$name = strip_tags( ( stripslashes( $_REQUEST['name'] ) ) );
				$this->widget_areas = $this->get_widget_areas();
				if( array_key_exists($name, $this->widget_areas )) {
					unset($this->widget_areas[$name]);
					$this->save_widget_areas();
				}
				echo "widget-area-deleted";
			}
			die();
		}
	}
	GF_Widget_Areas::getInstance()->init();
}
