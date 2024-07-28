<?php
/**
 * G5Plus Framework Post Format UI
 *
 * @package WordPress
 * @subpackage Beyot
 * @since Beyot 1.0
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
if (!class_exists('G5Plus_Post_Formats_UI')) {
	class G5Plus_Post_Formats_UI {

		private $version = '1.0';

		public static $format_link_text  = 'g5plus_format_link_text';
		public static $format_link_url  = 'g5plus_format_link_url';


		public static $format_quote_content = 'g5plus_format_quote_content';
		public static $format_quote_author_text = 'g5plus_format_quote_author_text';
		public static $format_quote_author_url = 'g5plus_format_quote_author_url';


		public static $format_video_embed = 'g5plus_format_video_embed';

		public static $format_audio_embed = 'g5plus_format_audio_embed';

		public static $format_gallery_images =  'g5plus_format_gallery_images';




		public function __construct(){
			$this->define_hook();
		}

		private function define_hook() {
			add_action('admin_init', array($this,'admin_init'));
			add_action('add_meta_boxes', array($this,'add_meta_boxes'));
		}

		public function add_meta_boxes($post_type) {
			if (post_type_supports($post_type, 'post-formats') && current_theme_supports('post-formats')) {

				$suffix  = defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min';
				wp_enqueue_script('g5plus-post-formats-ui', GF_PLUGIN_URL . 'core/post-format-ui/assets/js/post-formats-ui'. $suffix .'.js', array('jquery-core'), $this->version,true);
				wp_enqueue_style('g5plus-post-formats-ui', GF_PLUGIN_URL . 'core/post-format-ui/assets/css/post-formats-ui'. $suffix .'.css', array(), $this->version, 'screen');

				wp_localize_script(
					'g5plus-post-formats-ui',
					'g5plus_pfui_post_format',
					array(
						'loading'      => esc_html__('Loading...','beyot-framework'),
						'wpspin_light' => admin_url('images/wpspin_light.gif'),
						'media_title'  => esc_html__('Pick Gallery Images','beyot-framework'),
						'media_button' => esc_html__('Add Image(s)','beyot-framework')
					)
				);

				//add_action('edit_form_after_title',array($this,'post_admin_setup'));
                add_meta_box('g5plus-post-format', esc_html__( 'Post Format', 'beyot-framework' ), array($this, 'post_admin_setup'), 'post', 'advanced', 'default');
			}
		}

		/**
		 * Show post format navigation tabs
		 */
		public function post_admin_setup() {
			$post_formats = get_theme_support('post-formats');
			if (!empty($post_formats[0]) && is_array($post_formats[0])) {
				$post = get_post();
				$current_post_format = get_post_format($post->ID);
				$hacked_format       = null;

				/**
				 * support the possibility of people having hacked in custom
				 * post-formats or that this theme doesn't natively support
				 * the post-format in the current post - a tab will be added
				 * for this format but the default WP post UI will be shown ~sp
				 */
				if (!empty($current_post_format) && !in_array($current_post_format, $post_formats[0])) {
					$hacked_format = $current_post_format;
					array_push($post_formats[0], $current_post_format);
				}
				array_unshift($post_formats[0], 'standard');
				$post_formats = $post_formats[0];

				//include(GF_PLUGIN_DIR.'core/post-format-ui/views/tabs.php');

				// prevent added un-supported custom post format from view output
				if(!is_null($hacked_format) and ($key = array_search($current_post_format, $post_formats)) !== false) {
					unset($post_formats[$key]);
				}

				$format_views = array(
					'link',
					'quote',
					'video',
					'gallery',
					'audio',
				);

				foreach ($format_views as $format) {
					if (in_array($format, $post_formats)) {
						include(GF_PLUGIN_DIR.'core/post-format-ui/views/format-'.$format.'.php');
					}
				}
			}
		}

		public function  admin_init() {
			$post_formats = get_theme_support('post-formats');
			if (!empty($post_formats[0]) && is_array($post_formats[0])) {
				if (in_array('link', $post_formats[0])) {
					add_action('save_post', array($this,'format_link_save_post'));
				}

				if (in_array('quote', $post_formats[0])) {
					add_action('save_post', array($this,'format_quote_save_post'));
				}

				if (in_array('video', $post_formats[0])) {
					add_action('save_post', array($this,'format_video_save_post'));
				}

				if (in_array('audio', $post_formats[0])) {
					add_action('save_post', array($this,'format_audio_save_post'));
				}
				if (in_array('gallery', $post_formats[0])) {
					add_action('save_post', array($this,'format_gallery_save_post'));
				}
			}
		}

		/**
		 * Format Link Save
		 * @param $post_id
		 */
		public function  format_link_save_post($post_id) {
			if (!defined('XMLRPC_REQUEST')) {
				$keys = array(
					$this::$format_link_text,
					$this::$format_link_url
				);
				foreach ($keys as $key) {
					if (isset($_POST[$key])) {
						update_post_meta($post_id, $key, $_POST[$key]);
					}
				}
			}
		}

		/**
		 * Format Quote Save
		 * @param $post_id
		 */
		public function format_quote_save_post($post_id) {
			if (!defined('XMLRPC_REQUEST')) {
				$keys = array(
					$this::$format_quote_content,
					$this::$format_quote_author_text,
					$this::$format_quote_author_url,
				);
				foreach ($keys as $key) {
					if (isset($_POST[$key])) {
						update_post_meta($post_id, $key, $_POST[$key]);
					}
				}
			}
		}

		/**
		 * Format Video Save
		 * @param $post_id
		 */
		public function format_video_save_post($post_id) {
			if (!defined('XMLRPC_REQUEST') && isset($_POST[$this::$format_video_embed])) {
				update_post_meta($post_id, $this::$format_video_embed, $_POST[$this::$format_video_embed]);
			}
		}

		/**
		 * Format Audio Save
		 * @param $post_id
		 */
		public function format_audio_save_post($post_id) {
			if (!defined('XMLRPC_REQUEST') && isset($_POST[$this::$format_audio_embed])) {
				update_post_meta($post_id, $this::$format_audio_embed, $_POST[$this::$format_audio_embed]);
			}
		}

		/**
		 * Format Gallery Save
		 * @param $post_id
		 */
		public function format_gallery_save_post($post_id) {
			if (!defined('XMLRPC_REQUEST') && isset($_POST[$this::$format_gallery_images])) {
				if( $_POST[$this::$format_gallery_images] !== '' ) {
					$images = explode(',', $_POST[$this::$format_gallery_images]);
				} else {
					$images = array();
				}
				update_post_meta($post_id, $this::$format_gallery_images, $images);
			}
		}
	}
	new G5Plus_Post_Formats_UI();
}