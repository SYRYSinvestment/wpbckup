<?php
/**
 * Class System Status
 *
 * @package WordPress
 * @subpackage g5-beyot
 * @since g5-beyot 1.0.1
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
if (!class_exists('GF_Dashboard_System_Status')) {
	class GF_Dashboard_System_Status
	{
		/**
		 * The instance of this object
		 *
		 * @static
		 * @access private
		 * @var null | object
		 */
		private static $instance;

		public static function init()
		{
			if (self::$instance == NULL) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		private function __construct()
		{
			add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_styles'));
		}

		public function binder_page()
		{
			gf_get_template('core/dashboard/templates/dashboard', array('current_page' => 'system-status'));
		}

		public function admin_enqueue_styles()
		{
			if (!gfDashboard()->is_dashboard_page('system-status')) return;
			wp_enqueue_script(GF_PLUGIN_PREFIX.'dashboard',GF_PLUGIN_URL.'core/dashboard/assets/js/dashboard-system-status.js',array('jquery'),false,true);
			wp_enqueue_style('powertip', GF_PLUGIN_URL . 'assets/plugins/jquery.powertip/jquery.powertip.css', array(), '1.2.0');
			wp_enqueue_style('powertip-dark',GF_PLUGIN_URL . 'assets/plugins/jquery.powertip/jquery.powertip-dark.min.css', array(), '1.2.0');
			wp_enqueue_script('powertip', GF_PLUGIN_URL. 'assets/plugins/jquery.powertip/jquery.powertip.min.js', array('jquery'), '1.2.0', true);
		}

		private function get_changelog_url() {
			return apply_filters('gf-theme-changelog-url','http://themes.g5plus.net/beyot/changelog.html');
		}

		public function get_system_status_settings()
		{
			$current_theme = wp_get_theme();
			return array(
				array(
					'label' => sprintf(esc_html__('%s Versions', 'beyot-framework'), $current_theme['Name']),
					'fields' => array(
						array(
							'label' => esc_html__('Current Version', 'beyot-framework'),
							'help' => '',
							'content' => $current_theme['Version']
						),
						array(
							'label' => esc_html__('Update History', 'beyot-framework'),
							'help' => '',
							'content' => sprintf(wp_kses_post(__('<a target="_blank" href="%1$s">View changelog details</a>', 'beyot-framework')), $this->get_changelog_url())
						)
					)
				),
				array(
					'label' => esc_html__('WordPress Environment', 'beyot-framework'),
					'fields' => array(
						array(
							'label' => esc_html__('Home URL', 'beyot-framework'),
							'help' => esc_html__('The URL of your site\'s homepage.', 'beyot-framework'),
							'content' => home_url('/')
						),
						array(
							'label' => esc_html__('Site URL', 'beyot-framework'),
							'help' => esc_html__('The root URL of your site.', 'beyot-framework'),
							'content' => site_url('/')
						),
						array(
							'label' => esc_html__('WP Version', 'beyot-framework'),
							'help' => esc_html__('The version of WordPress installed on your site.', 'beyot-framework'),
							'content' => get_bloginfo('version')
						),
						array(
							'label' => esc_html__('WP Multisite', 'beyot-framework'),
							'help' => esc_html__('Whether or not you have WordPress Multisite enabled.', 'beyot-framework'),
							'content' => is_multisite() ? esc_html__('Enable', 'beyot-framework') : esc_html__('Disable', 'beyot-framework')
						),
						array(
							'label' => esc_html__('WP Memory Limit', 'beyot-framework'),
							'help' => esc_html__('The maximum amount of memory (RAM) that your site can use at one time.', 'beyot-framework'),
							'content' => $this->get_memory_limit_markup()
						),
						array(
							'label' => esc_html__('WP Debug Mode', 'beyot-framework'),
							'help' => esc_html__('Displays whether or not WordPress is in Debug Mode.', 'beyot-framework'),
							'content' => (defined('WP_DEBUG') && WP_DEBUG) ? esc_html__('Enable', 'beyot-framework') : esc_html__('Disable', 'beyot-framework')
						),
						array(
							'label' => esc_html__('Language', 'beyot-framework'),
							'help' => esc_html__('The current language used by WordPress. Default = English', 'beyot-framework'),
							'content' => get_locale()
						)

					)
				),
				array(
					'label' => esc_html__('Server Environment', 'beyot-framework'),
					'fields' => array(
						array(
							'label' => esc_html__('Server Info', 'beyot-framework'),
							'help' => esc_html__('Information about the web server that is currently hosting your site.', 'beyot-framework'),
							'content' => $_SERVER['SERVER_SOFTWARE']
						),
						array(
							'label' => esc_html__('PHP Version', 'beyot-framework'),
							'help' => esc_html__('The version of PHP installed on your hosting server.', 'beyot-framework'),
							'content' => $this->get_php_version_markup()
						),
						array(
							'label' => esc_html__('Post Max Size', 'beyot-framework'),
							'help' => esc_html__('The largest file size that can be contained in one post.', 'beyot-framework'),
							'content' => $this->get_php_post_max_size_markup()
						),
						array(
							'label' => esc_html__('Max Execution Time', 'beyot-framework'),
							'help' => esc_html__('The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups)', 'beyot-framework'),
							'content' => $this->get_php_max_execution_time_markup()
						),
						array(
							'label' => esc_html__('Max Input Vars', 'beyot-framework'),
							'help' => esc_html__('The maximum number of variables your server can use for a single function to avoid overloads.', 'beyot-framework'),
							'content' => $this->get_php_max_input_var_markup()
						),
						array(
							'label' => esc_html__('ZipArchive', 'beyot-framework'),
							'help' => esc_html__('ZipArchive is required for importing demos. They are used to import and export zip files specifically for sliders.', 'beyot-framework'),
							'content' => class_exists('ZipArchive') ? array('status' => true, 'html' => esc_html__('Enable', 'beyot-framework')) : array('status' => false, 'html' => esc_html__('Disable', 'beyot-framework'))
						),
						array(
							'label' => esc_html__('MySQL Version', 'beyot-framework'),
							'help' => esc_html__('The version of MySQL installed on your hosting server.', 'beyot-framework'),
							'content' => $this->get_mysql_version_markup()
						),
						array(
							'label' => esc_html__('Max Upload Size', 'beyot-framework'),
							'help' => esc_html__('The largest file size that can be uploaded to your WordPress installation.', 'beyot-framework'),
							'content' => size_format(wp_max_upload_size())
						)
					)
				),
				$this->get_plugins_active()

			);
		}

		private function get_memory_limit_markup()
		{
			$memory = $this->let_to_num(WP_MEMORY_LIMIT);
			if ($memory < 134217728) {
				$status = false;
				$memory_limit_markup = '<mark class="error">' . sprintf(wp_kses_post(__('%1$s - We recommend setting memory to at least <strong>128MB</strong>.<br /> Please define memory limit in <strong>wp-config.php</strong> file.<br /> To learn how, see: <a href="%2$s" target="_blank" rel="noopener noreferrer">Increasing memory allocated to PHP.</a>', 'beyot-framework')), size_format($memory), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP') . '</mark>';
			} else {
				$status = true;
				$memory_limit_markup = size_format($memory);
			}
			return array(
				'status' => $status,
				'html' => $memory_limit_markup
			);
		}

		public function let_to_num( $size ) {
			$l   = substr( $size, -1 );
			$ret = substr( $size, 0, -1 );
			switch ( strtoupper( $l ) ) {
				case 'P':
					$ret *= 1024;
				case 'T':
					$ret *= 1024;
				case 'G':
					$ret *= 1024;
				case 'M':
					$ret *= 1024;
				case 'K':
					$ret *= 1024;
			}
			return $ret;
		}
		private function get_php_version_markup()
		{
			if (!function_exists('phpversion')) return '';
			$php_version = phpversion();
			if ( version_compare( $php_version, '5.6', '<' ) ) {
				$status = false;
				$php_version_markup = '<mark class="error">' . sprintf( __( '%s - We recommend a minimum PHP version of 5.6. See: %s', 'beyot-framework' ), esc_html( $php_version ), '<a href="http://php.net/downloads.php" target="_blank">' . __( 'How to update your PHP version', 'beyot-framework' ) . '</a>' ) . '</mark>';
			} else {
				$status = true;
				$php_version_markup = $php_version;
			}
			return array(
				'status' => $status,
				'html' => $php_version_markup
			);
		}

		private function get_php_post_max_size_markup()
		{
			if (!function_exists('ini_get')) return '';
			$post_max_size = $this->let_to_num(ini_get('post_max_size'));
			if ($post_max_size < 67108864) {
				$status = false;
				$post_max_size_markup = '<mark class="error">' . sprintf(wp_kses_post(__('%1$s - We recommend setting post max size to at least <strong>64MB</strong>.', 'beyot-framework')), size_format($post_max_size)) . '</mark>';
			} else {
				$status = true;
				$post_max_size_markup = size_format($post_max_size);
			}
			return array(
				'status' => $status,
				'html' => $post_max_size_markup
			);

		}

		private function get_php_max_execution_time_markup()
		{
			if (!function_exists('ini_get')) return '';
			$max_execution_time = ini_get('max_execution_time');

			if ($max_execution_time < 300) {
				$status = false;
				$max_execution_time_markup = '<mark class="error">' . sprintf(wp_kses_post(__('%1$s - We recommend setting max execution time to at least 300.<br />See: <a href="%2$s" target="_blank" rel="noopener noreferrer">Increasing max execution to PHP</a>', 'beyot-framework')), $max_execution_time, 'http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded') . '</mark>';
			} else {
				$status = true;
				$max_execution_time_markup = $max_execution_time;
			}
			return array(
				'status' => $status,
				'html' => $max_execution_time_markup
			);
		}

		private function get_php_max_input_var_markup()
		{
			if (!function_exists('ini_get')) return '';
			$max_input_var = ini_get('max_input_vars');
			if ($max_input_var < 3000) {
				$status = false;
				$max_input_var_markup = '<mark class="error">' . sprintf(wp_kses_post(__('%1$s - We recommend setting max input var to at least 3000.<br /> Max input vars limitation will truncate POST data such as menus See: <a href="%2$s" target="_blank" rel="noopener noreferrer">Increasing max input vars limit.</a>', 'beyot-framework')), $max_input_var, 'http://sevenspark.com/docs/ubermenu-3/faqs/menu-item-limit') . '</mark>';
			} else {
				$status = true;
				$max_input_var_markup = $max_input_var;
			}
			return array(
				'status' => $status,
				'html' => $max_input_var_markup
			);
		}

		private function get_mysql_version_markup()
		{
			global $wpdb;
			return $wpdb->db_version();
		}

		private function get_plugins_active()
		{
			$fields = array();
			$active_plugins = get_option('active_plugins');
			$active_plugin_count = 0;
			if (is_array($active_plugins)) {
				$active_plugin_count = sizeof($active_plugins);

				foreach ($active_plugins as $plugin) {
					$plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin);
					if (!empty($plugin_data['Name'])) {

						$label = '';

						if (!empty($plugin_data['PluginURI'])) {
							$label = '<a target="_blank" title="'. esc_html__('Visit plugin homepage', 'beyot-framework') .'" href="'. esc_url($plugin_data['PluginURI']) .'">' . $plugin_data['Name'] . '</a>';
						}

						$content = '';
						$author_markup = '';
						if (!empty($plugin_data['Author'])) {
							$author_markup = $plugin_data['Author'];
						}

						if (!empty($plugin_data['AuthorURI'])) {
							$author_markup = '<a target="_blank" href="'. esc_url($plugin_data['AuthorURI']) .'" title="'. esc_attr($author_markup) .'">' . $author_markup . '</a>';
						}

						$content = esc_html__('by ', 'beyot-framework') . $author_markup;

						$field = array(
							'label' => $label,
							'content' => $content
						);
						$fields[] = $field;
					}
				}

			}
			return array(
				'label' => sprintf(__('Active Plugins (%1$s)', 'beyot-framework'), $active_plugin_count),
				'fields' => $fields
			);
		}
	}
}
