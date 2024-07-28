<?php
/**
 * Class Dashboard Support
 *
 * @package WordPress
 * @subpackage g5-beyot
 * @since g5-beyot 1.0.1
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
if (!class_exists('GF_Dashboard_Support')) {
	class GF_Dashboard_Support
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
		}

		/**
		 * Binder Page
		 */
		public function binder_page()
		{
			gf_get_template('core/dashboard/templates/dashboard', array('current_page' => 'support'));
		}

		/**
		 * Get Support Forum Url
		 *
		 * @return mixed|void
		 */
		private function get_support_forum_url() {
			return apply_filters('gf-support-forum-url','http://support.g5plus.net/') ;
		}

		/**
		 * Get Documentation Url
		 *
		 * @return mixed|void
		 */
		private function get_documentation_url() {
			return apply_filters('gf-documentation-url','http://document.g5plus.net/beyot/');
		}

		/**
		 * Get Knowledgebase Url
		 *
		 * @return mixed|void
		 */
		private function get_knowledgebase_url() {
			return apply_filters('gf-knowledgebase-url','http://support.g5plus.net/knowledge-base/');
		}

		/**
		 * Get Video Tutorials Url
		 *
		 * @return mixed|void
		 */
		private function get_video_tutorials_url() {
			return apply_filters('gf-video-tutorials-url','https://www.youtube.com/playlist?list=PL_DzVbdOfv7EJSkMOf84gpYGzZqvrwv4H');
		}

		/**
		 * Get Features Support
		 *
		 * @return array
		 */
		public function get_features()
		{
			$current_theme = wp_get_theme();
			return array(
				array(
					'icon' => 'dashicons dashicons-sos',
					'label' => esc_html__('Support forum', 'beyot-framework'),
					'description' => sprintf(__('We offer outstanding support through our forum. To get support first you need to register (create an account) and open a thread in the %1$s Section.','beyot-framework'),$current_theme['Name']),
					'button_text' => esc_html__('Open Forum', 'beyot-framework'),
					'button_url' => $this->get_support_forum_url()
				),
				array(
					'icon' => 'dashicons dashicons-book',
					'label' => esc_html__('Documentation', 'beyot-framework'),
					'description' => sprintf(__('This is the place to go to reference different aspects of the theme. Our online documentation is an incredible resource for learning the ins and outs of using %1$s.', 'beyot-framework'),$current_theme['Name']),
					'button_text' => esc_html__('Documentation', 'beyot-framework'),
					'button_url' => $this->get_documentation_url()
				),
				array(
					'icon' => 'dashicons dashicons-portfolio',
					'label' => esc_html__('Knowledge Base', 'beyot-framework'),
					'description' => esc_html__('Our knowledge base contains additional content that is not inside of our documentation. This information is more specific and unique to various versions or aspects of theme.', 'beyot-framework'),
					'button_text' => esc_html__('Knowledgebase', 'beyot-framework'),
					'button_url' => $this->get_knowledgebase_url()
				),
				array(
					'icon' => 'dashicons dashicons-format-video',
					'label' => esc_html__('Video Tutorials', 'beyot-framework'),
					'description' => sprintf(__('Nothing is better than watching a video to learn. We have a growing library of high-definititon, narrated video tutorials to help teach you the different aspects of using %1$s.','beyot-framework'),$current_theme['Name']),
					'button_text' => esc_html__('Watch Videos', 'beyot-framework'),
					'button_url' => $this->get_video_tutorials_url()
				)
			);
		}
	}
}
