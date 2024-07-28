<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
if ( ! class_exists( 'GF_Dashboard_Demo' ) ) {
	class GF_Dashboard_Demo {
		private static $_instance;

		public static function getInstance() {
			if ( self::$_instance == null ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		public function init() {
			add_filter( 'gid_install_demo_page_parent', array( $this, 'change_gid_install_demo_page_parent' ) );

			add_filter( 'gf_dashboard_menu_config', array( $this, 'change_dashboard_menu' ) );

			add_action( 'gid_demo_page_before', array( $this, 'add_tabs' ) );

			add_filter( 'gid_demo_list', array( $this, 'demo_list' ) );

			add_filter( 'g5dev_option_key_for_setting_file', array( $this, 'change_option_key_for_setting_file' ) );

			add_filter( 'g5dev_option_key_for_attachment_file', array(
				$this,
				'change_option_key_for_attachment_file'
			) );

			add_filter( 'g5dev_attachment_in_post_type_for_import_setting', array(
				$this,
				'change_attachment_in_post_type_for_import_setting'
			) );

			add_filter( 'gid_post_type_allow_install', array( $this, 'change_post_type_allow_install' ) );

			add_filter( 'gid_post_meta_change_term_id', array( $this, 'change_post_meta_change_term_id' ) );

			add_filter( 'gid_options_key_change_theme_options', array(
				$this,
				'change_options_key_change_theme_options'
			) );

			add_filter( 'gid_post_meta_change_media_field', array( $this, 'change_post_meta_change_media_field' ) );

			add_filter( 'gid_term_meta_change_media_field', array( $this, 'change_term_meta_change_media_field' ) );

			add_filter( 'gid_post_meta_change_post_id', array( $this, 'change_post_meta_change_post_id' ) );

		}

		public function change_gid_install_demo_page_parent() {
			return "gf-system-status";
		}

		public function change_dashboard_menu( $menu ) {
			if ( function_exists( 'GID' ) ) {
				$menu['install_demo'] = array(
					'page_title' => esc_html__( 'Install Demo', 'beyot-framework' ),
					'menu_title' => esc_html__( 'Install Demo', 'beyot-framework' ),
					'type'       => 'link',
					'link'       => admin_url( 'admin.php?page=gid_install_demo' ),
					'priority'   => 25,
				);
			}

			return $menu;
		}

		public function add_tabs() {
			wp_enqueue_style( GF_PLUGIN_PREFIX . 'dashboard', GF_PLUGIN_URL . 'core/dashboard/assets/css/dashboard.css' );
			gf_get_template( 'core/dashboard/templates/tabs', array( 'current_page' => 'install_demo' ) );
		}

		public function demo_list() {
			return array(
				'main'      => array(
					'name'      => esc_html__( 'Main (Use With WPBakery Page Builder)', 'beyot-framework' ),
					'thumbnail' => GF_PLUGIN_URL . 'assets/demo-data/main/preview.jpg',
					'preview' => 'https://beyot.g5plus.net/main/',
					//'preview'   => 'http://dev.g5plus.net/beyot/main/',
					'dir'       => GF_PLUGIN_DIR . 'assets/demo-data/main/',
					'theme'     => 'g5-beyot',
					'builder'   => 'vc',
				),
				'elementor-main' => array(
					'name'      => esc_html__( 'Main (Use With Elementor)', 'beyot-framework' ),
					'thumbnail' => GF_PLUGIN_URL . 'assets/demo-data/elementor/main/preview.jpg',
					'preview' => 'https://beyot.g5plus.net/elementor/main/',
					//'preview'   => 'http://dev.g5plus.net/beyot/elementor/main/',
					'dir'       => GF_PLUGIN_DIR . 'assets/demo-data/elementor/main/',
					'theme'     => 'g5-beyot',
					'builder'   => 'elementor',
				),
				'single-property'      => array(
					'name'      => esc_html__( 'Single Property (Use With WPBakery Page Builder)', 'beyot-framework' ),
					'thumbnail' => GF_PLUGIN_URL . 'assets/demo-data/single-property/preview.jpg',
					'preview' => 'https://beyot.g5plus.net/single-property/',
					//'preview'   => 'http://dev.g5plus.net/beyot/single-property/',
					'dir'       => GF_PLUGIN_DIR . 'assets/demo-data/single-property/',
					'theme'     => 'g5-beyot',
					'builder'   => 'vc',
				),
				'elementor-single-property'      => array(
					'name'      => esc_html__( 'Single Property (Use With Elementor)', 'beyot-framework' ),
					'thumbnail' => GF_PLUGIN_URL . 'assets/demo-data/elementor/single-property/preview.jpg',
					'preview' => 'https://beyot.g5plus.net/elementor/single-property/',
					//'preview'   => 'http://dev.g5plus.net/beyot/elementor/single-property/',
					'dir'       => GF_PLUGIN_DIR . 'assets/demo-data/elementor/single-property/',
					'theme'     => 'g5-beyot',
					'builder'   => 'elementor',
				),
				'single-agent'      => array(
					'name'      => esc_html__( 'Single Agent (Use With WPBakery Page Builder)', 'beyot-framework' ),
					'thumbnail' => GF_PLUGIN_URL . 'assets/demo-data/single-agent/preview.jpg',
					'preview' => 'https://beyot.g5plus.net/single-agent/',
					//'preview'   => 'http://dev.g5plus.net/beyot/single-agent/',
					'dir'       => GF_PLUGIN_DIR . 'assets/demo-data/single-agent/',
					'theme'     => 'g5-beyot',
					'builder'   => 'vc',
				),
				'elementor-single-agent'      => array(
					'name'      => esc_html__( 'Single Agent (Use With Elementor)', 'beyot-framework' ),
					'thumbnail' => GF_PLUGIN_URL . 'assets/demo-data/elementor/single-agent/preview.jpg',
					'preview' => 'https://beyot.g5plus.net/elementor/single-agent/',
					//'preview'   => 'http://dev.g5plus.net/beyot/elementor/single-agent/',
					'dir'       => GF_PLUGIN_DIR . 'assets/demo-data/elementor/single-agent/',
					'theme'     => 'g5-beyot',
					'builder'   => 'elementor',
				),
			);
		}

		public function change_option_key_for_setting_file( $option_keys ) {
			return wp_parse_args( array(
				'beyot_options'              => '=',
				'ere_options'                => '=',
				'country_list'               => '=',
				'widget_null-instagram-feed' => '',
				'xmenu_setting_option%'      => 'like',
				'gf-widget-areas'            => '=',
			), $option_keys );
		}

		public function change_option_key_for_attachment_file() {
			return array(
				'beyot_options' => '=',
				'ere_options'   => '=',
			);
		}

		public function change_attachment_in_post_type_for_import_setting( $post_types_attachment ) {
			return wp_parse_args( array(
				'gf_footer',
			), $post_types_attachment );
		}

		public function change_post_type_allow_install( $post_type_allow_install ) {
			return wp_parse_args( array(
				'gf_footer'
			), $post_type_allow_install );
		}

		public function change_post_meta_change_term_id( $meta_keys ) {
			$metaPrefix = GF_METABOX_PREFIX;

			return wp_parse_args( array(
				"{$metaPrefix}page_menu"        => '=',
				"{$metaPrefix}page_menu_mobile" => '=',
			), $meta_keys );

		}

		public function change_options_key_change_theme_options( $options_keys ) {
			return wp_parse_args( array(
				'beyot_options' => '=',
				'ere_options'   => '=',
			), $options_keys );
		}

		public function change_post_meta_change_media_field( $meta_keys ) {
			return wp_parse_args( array(
				'g5plus_format_gallery_images'
			), $meta_keys );
		}


		public function change_term_meta_change_media_field( $meta_keys ) {
			return wp_parse_args( array(
				"property_type_icon"
			), $meta_keys );
		}

		public function change_post_meta_change_post_id( $meta_keys ) {
			return wp_parse_args( array(
				"g5plus_framework_page_preset",
				'g5plus_framework_set_footer_custom'
			), $meta_keys );
		}


	}
}