<?php
/**
 * REGISTER META BOX FOR PRESET
 * *******************************************************
 */
if (!function_exists('gf_register_meta_boxes')) {
	function gf_register_meta_boxes()
	{
		$prefix = GF_METABOX_PREFIX;

		$post_type_meta_box = apply_filters('gf_post_setting_apply', array('page'));

		/**
		 * Get Theme Options Value
		 */
		$options = array();
		if (isset($GLOBALS[GF_OPTIONS_NAME])) {
			$options = &$GLOBALS[GF_OPTIONS_NAME];
		}

		/**
		 * CUSTOM PRESET
		 */
		$configs['gf_preset_meta_boxes'] = array(
			'name' => esc_html__('Preset Settings', 'beyot-framework'),
			'post_type' => array('gf_preset'),
			'layout' => 'horizontal',
			'section' => array(
				/**
				 * Page Layout
				 */
				array(
					'id' => $prefix . 'layout_meta_box',
					'title' => esc_html__('Page Layout', 'beyot-framework'),
					'icon' => 'dashicons dashicons-editor-table',
					'fields'     => array(
						array(
							'title' => esc_html__('General', 'beyot-framework'),
							'id'   => $prefix . 'layout_meta_box_general',
							'type' => 'group',
							'fields' => array(
								array(
									'title'     => esc_html__('Layout Style', 'beyot-framework'),
									'id'       => $prefix . 'layout_style',
									'type'     => 'button_set',
									'options'  => array(
										'boxed' => esc_html__('Boxed', 'beyot-framework'),
										'wide'  => esc_html__('Wide', 'beyot-framework')
									),
									'default'      => isset($options['layout_style']) ? $options['layout_style'] : 'wide',
									'multiple' => false,
								),
								array(
									'title'     => esc_html__('Layout', 'beyot-framework'),
									'id'       => $prefix . 'layout',
									'type'     => 'button_set',
									'options'  => gf_get_page_layout_option(),
									'default'      => isset($options['layout']) ? $options['layout'] : 'container',
									'multiple' => false,
								),
								array(
									'title'       => esc_html__('Sidebar Layout', 'beyot-framework'),
									'id'         => $prefix . 'sidebar_layout',
									'type'       => 'image_set',
									'options'    => array(
										'none'  => GF_PLUGIN_URL . '/assets/images/theme-options/sidebar-none.png',
										'left'  => GF_PLUGIN_URL . '/assets/images/theme-options/sidebar-left.png',
										'right' => GF_PLUGIN_URL . '/assets/images/theme-options/sidebar-right.png'
									),
									'default'        => isset($options['sidebar_layout']) ? $options['sidebar_layout'] : 'none',
									'multiple'   => false,

								),
								array(
									'title'           => esc_html__('Sidebar', 'beyot-framework'),
									'id'             => $prefix . 'sidebar',
									'type'           => 'selectize',
									'allow_clear' => true,
									'data'     => 'sidebar',
									'placeholder'    => esc_html__('Select Sidebar', 'beyot-framework'),
									'default'            => isset($options['sidebar']) ? $options['sidebar'] : 'main-sidebar',
									'required' => array($prefix . 'sidebar_layout', 'in', array('', 'right', 'left')),
								),

								array(
									'title'           => esc_html__('Sidebar Width', 'beyot-framework'),
									'id'             => $prefix . 'sidebar_width',
									'type'           => 'button_set',
									'options'        => gf_get_sidebar_width(),
									'default'            => isset($options['sidebar_width']) ? $options['sidebar_width'] : 'small',
									'multiple'       => false,
									'required' => array($prefix . 'sidebar_layout', '!=', 'none'),
								),

								array(
									'title'           => esc_html__('Sidebar Mobile', 'beyot-framework'),
									'id'             => $prefix . 'sidebar_mobile_enable',
									'type'           => 'button_set',
									'options'        => gf_get_toggle(),
									'default'            => isset($options['sidebar_mobile_enable']) ? $options['sidebar_mobile_enable'] : '1',
									'multiple'       => false,
									'required' => array($prefix . 'sidebar_layout', '!=', 'none'),
								),

								array(
									'id'    => $prefix . 'content_padding',
									'title'  => esc_html__('Content Padding', 'beyot-framework'),
									'desc'  => esc_html__('Set content top/bottom padding. Do not include units (empty to set default). Allow values (0,5,10,15....100)', 'beyot-framework'),
									'type'  => 'spacing',
									'left'  => false,
									'right' => false,
									'default' => array(
										'top' => isset($options['content_padding']) && isset($options['content_padding']['top']) ? str_replace('px','',$options['content_padding']['top']) : '',
										'bottom' => isset($options['content_padding']) && isset($options['content_padding']['bottom']) ? str_replace('px','',$options['content_padding']['bottom']) : '',
									)
								),

								array(
									'id'    => $prefix . 'content_padding_mobile',
									'title'  => esc_html__('Content Padding Mobile', 'beyot-framework'),
									'desc'  => esc_html__('Set content top/bottom padding mobile. Do not include units (empty to set default). Allow values (0,5,10,15....100)', 'beyot-framework'),
									'type'  => 'spacing',
									'left'  => false,
									'right' => false,
									'default' => array(
										'top' => isset($options['content_padding_mobile']) && isset($options['content_padding_mobile']['top']) ? str_replace('px','',$options['content_padding_mobile']['top']) : '',
										'bottom' => isset($options['content_padding_mobile']) && isset($options['content_padding_mobile']['bottom']) ? str_replace('px','',$options['content_padding_mobile']['bottom']) : '',
									)
								)
							)
						)
					)
				),

				/**
				 * Page Title
				 */
				array(
					'id' => $prefix . 'title_meta_box',
					'title' => esc_html__('Page Title', 'beyot-framework'),
					'icon' => 'dashicons dashicons-star-filled',
					'fields'     => array(
						array(
							'title' => esc_html__('General', 'beyot-framework'),
							'id'   => $prefix . 'title_meta_box_general',
							'type' => 'group',
							'fields' => array(
								array(
									'title'    => esc_html__('Show/Hide Page Title?', 'beyot-framework'),
									'id'      => $prefix . 'page_title_enable',
									'type'    => 'button_set',
									'default'     => isset($options['page_title_enable']) ? $options['page_title_enable'] : '1',
									'options' => gf_get_toggle()
								),

								array(
									'title'           => esc_html__('Page Title', 'beyot-framework'),
									'id'             => $prefix . 'page_title',
									'desc'           => esc_html__("Enter a custom page title if you'd like.", 'beyot-framework'),
									'type'           => 'text',
									'default'            => '',
									'required' => array($prefix . 'page_title_enable', '=', 1),
								),

								array(
									'title'           => esc_html__('Page Subtitle', 'beyot-framework'),
									'id'             => $prefix . 'page_sub_title',
									'desc'           => esc_html__("Enter a custom page title if you'd like.", 'beyot-framework'),
									'type'           => 'text',
									'default'            => isset($options['page_sub_title']) ? $options['page_sub_title'] : '',
									'required' => array(
										array($prefix . 'page_title_enable', '=', 1),
									),
								),

								array(
									'id'             => $prefix . 'page_title_padding',
									'title'           => esc_html__('Padding', 'beyot-framework'),
									'desc'           => esc_html__('Enter a page title padding top/bottom value (not include unit)', 'beyot-framework'),
									'type'           => 'spacing',
									'left'  => false,
									'right' => false,
									'default' => array(
										'top' => isset($options['page_title_padding']) && isset($options['page_title_padding']['padding-top']) ? str_replace('px','',$options['page_title_padding']['padding-top']) : '',
										'bottom' => isset($options['page_title_padding']) && isset($options['page_title_padding']['padding-bottom']) ? str_replace('px','',$options['page_title_padding']['padding-bottom']) : '',
									),
									'required' => array(
										array($prefix . 'page_title_enable', '=', 1),
									)
								),

								array(
									'id' => $prefix . 'custom_page_title_bg_image_enable',
									'title' => esc_html__('Custom Background Image','beyot-framework'),
									'desc' => esc_html__('Turn on this option if you want to enable custom background image of page title','beyot-framework'),
									'type' => 'button_set',
									'options' => gf_get_toggle(),
									'std' => 0,
									'required'   => array(
										array($prefix . 'page_title_enable', '=', '1'),
									),
								),

								array(
									'id'               => $prefix . 'page_title_bg_image',
									'title'             => esc_html__('Background Image', 'beyot-framework'),
									'desc'             => esc_html__('Background Image for page title.', 'beyot-framework'),
									'type'             => 'image',
									'max_file_uploads' => 1,
									'required' => array(
										array($prefix . 'page_title_enable', '=', 1),
										array($prefix . 'custom_page_title_bg_image_enable', '=', 1)
									)
								),

								array(
									'title'           => esc_html__('Page Title Background Overlay', 'beyot-framework'),
									'id'             => $prefix . 'page_title_bg_overlay',
									'desc'           => esc_html__("Enable Page Title Background Overlay", 'beyot-framework'),
									'type'           => 'button_set',
									'options'        => gf_get_toggle(),
									'default'            => isset($options['page_title_bg_overlay']) ? $options['page_title_bg_overlay'] : 0,
									'required' => array(
										array($prefix . 'page_title_enable', '=', 1),
									)
								),

								array(
									'title'           => esc_html__('Page Title Parallax', 'beyot-framework'),
									'id'             => $prefix . 'page_title_parallax',
									'desc'           => esc_html__("Enable Page Title Parallax", 'beyot-framework'),
									'type'           => 'button_set',
									'options'        => gf_get_toggle(),
									'default'            => isset($options['page_title_parallax']) ? $options['page_title_parallax'] : 1,
									'required' => array(
										array($prefix . 'page_title_enable', '=', 1),
									)
								),

								// Breadcrumbs in Page Title
								array(
									'title'           => esc_html__('Breadcrumbs Enable', 'beyot-framework'),
									'id'             => $prefix . 'breadcrumbs_enable',
									'desc'           => esc_html__("Show/Hide Breadcrumbs", 'beyot-framework'),
									'type'           => 'button_set',
									'options'        => gf_get_toggle(),
									'default'            => isset($options['breadcrumbs_enable']) ? $options['breadcrumbs_enable'] : 1,
									'required' => array(
										array($prefix . 'page_title_enable', '=', 1),
									)
								),
							)
						)
					)
				),

				/**
				 * Logo Settings
				 */
				array(
					'id' => $prefix . 'logo_meta_box',
					'title' => esc_html__('Logo', 'beyot-framework'),
					'icon' => 'dashicons dashicons-carrot',
					'fields'     => array(
						array(
							'title' => esc_html__('Desktop Settings', 'beyot-framework'),
							'id'   => $prefix . 'page_logo_section_1',
							'type' => 'group',
							'fields' => array(
								array(
									'id' => $prefix . 'custom_logo_enable',
									'title' => esc_html__('Custom Logo','beyot-framework'),
									'desc' => esc_html__('Turn on this option if you want to enable custom logo','beyot-framework'),
									'type' => 'button_set',
									'options' => gf_get_toggle(),
									'std' => 0
								),
								array(
									'id'               => $prefix . 'logo',
									'title'             => esc_html__('Header Logo', 'beyot-framework'),
									'desc'             => esc_html__('Upload custom logo in header.', 'beyot-framework'),
									'type'             => 'image',
									'max_file_uploads' => 1,
									'required' => array( $prefix . 'custom_logo_enable', '=', 1)
								),
								array(
									'id'               => $prefix . 'logo_retina',
									'title'             => esc_html__('Header Logo Retina', 'beyot-framework'),
									'desc'             => esc_html__('Upload custom logo retina in header.', 'beyot-framework'),
									'type'             => 'image',
									'max_file_uploads' => 1,
									'required' => array( $prefix . 'custom_logo_enable', '=', 1)
								),
								array(
									'id'               => $prefix . 'sticky_logo',
									'title'             => esc_html__('Sticky Logo', 'beyot-framework'),
									'desc'             => esc_html__('Upload sticky logo in header (empty to default)', 'beyot-framework'),
									'type'             => 'image',
									'max_file_uploads' => 1,
									'required' => array( $prefix . 'custom_logo_enable', '=', 1)
								),
								array(
									'id'               => $prefix . 'sticky_logo_retina',
									'title'             => esc_html__('Sticky Logo Retina', 'beyot-framework'),
									'desc'             => esc_html__('Upload sticky logo retina in header (empty to default)', 'beyot-framework'),
									'type'             => 'image',
									'max_file_uploads' => 1,
									'required' => array( $prefix . 'custom_logo_enable', '=', 1)
								),
								array(
									'id'   => $prefix . 'logo_max_height',
									'title' => esc_html__('Logo max height', 'beyot-framework'),
									'desc' => esc_html__('Logo max height (px). Do not include units (empty to set default)', 'beyot-framework'),
									'type' => 'text',
									'default'  => isset($options['logo_max_height']) && isset($options['logo_max_height']['height']) ? str_replace('px','',$options['logo_max_height']['height']) : '',
								),
								array(
									'id'    => $prefix . 'logo_padding',
									'title'  => esc_html__('Logo padding', 'beyot-framework'),
									'desc'  => esc_html__('Logo padding top/bottom. Do not include units (empty to set default)', 'beyot-framework'),
									'type'  => 'spacing',
									'left'  => false,
									'right' => false,
									'default' => array(
										'top' => isset($options['logo_padding']) && isset($options['logo_padding']['top']) ? str_replace('px','',$options['logo_padding']['top']) : '',
										'bottom' => isset($options['logo_padding']) && isset($options['logo_padding']['bottom']) ? str_replace('px','',$options['logo_padding']['bottom']) : '',
									),
								)
							)
						),

						array(
							'title' => esc_html__('Mobile Settings', 'beyot-framework'),
							'id'   => $prefix . 'page_logo_section_2',
							'type' => 'group',
							'toggle' => true,
							'fields' => array(
								array(
									'id' => $prefix . 'custom_logo_mobile_enable',
									'title' => esc_html__('Custom Mobile Logo','beyot-framework'),
									'desc' => esc_html__('Turn on this option if you want to enable custom mobile logo','beyot-framework'),
									'type' => 'button_set',
									'options' => gf_get_toggle(),
									'std' => 0
								),
								array(
									'id'               => $prefix . 'mobile_logo',
									'title'             => esc_html__('Mobile Logo', 'beyot-framework'),
									'desc'             => esc_html__('Upload mobile logo in header.', 'beyot-framework'),
									'type'             => 'image',
									'max_file_uploads' => 1,
									'required' => array( $prefix . 'custom_logo_mobile_enable', '=', 1)
								),
								array(
									'id'               => $prefix . 'mobile_logo_retina',
									'title'             => esc_html__('Mobile Logo Retina', 'beyot-framework'),
									'desc'             => esc_html__('Upload mobile logo retina in header.', 'beyot-framework'),
									'type'             => 'image',
									'max_file_uploads' => 1,
									'required' => array( $prefix . 'custom_logo_mobile_enable', '=', 1)
								),
								array(
									'id'   => $prefix . 'mobile_logo_max_height',
									'title' => esc_html__('Mobile Logo Max Height', 'beyot-framework'),
									'desc' => esc_html__('Logo max height (px). Do not include units (empty to set default)', 'beyot-framework'),
									'type' => 'text',
									'default'  => isset($options['mobile_logo_max_height']) && isset($options['mobile_logo_max_height']['height']) ? str_replace('px','',$options['mobile_logo_max_height']['height']) : '',
								),
								array(
									'id'    => $prefix . 'mobile_logo_padding',
									'title'  => esc_html__('Mobile logo padding', 'beyot-framework'),
									'desc'  => esc_html__('Mobile logo padding top/bottom. Do not include units (empty to set default)', 'beyot-framework'),
									'type'  => 'spacing',
									'left'  => false,
									'right' => false,
									'default' => array(
										'top' => isset($options['mobile_logo_padding']) && isset($options['mobile_logo_padding']['top']) ? str_replace('px','',$options['mobile_logo_padding']['top']) : '',
										'bottom' => isset($options['mobile_logo_padding']) && isset($options['mobile_logo_padding']['bottom']) ? str_replace('px','',$options['mobile_logo_padding']['bottom']) : '',
									),
								)
							)
						),
					)
				),

				/**
				 * Top Drawer
				 */
				array(
					'id' => $prefix . 'top_drawer_meta_box',
					'title' => esc_html__('Top drawer', 'beyot-framework'),
					'icon' => 'dashicons dashicons-archive',
					'fields'     => array(
						array(
							'title' => esc_html__('General', 'beyot-framework'),
							'id'   => $prefix . 'top_drawer_meta_box_general',
							'type' => 'group',
							'fields' => array(
								array(
									'title'    => esc_html__('Top Drawer Type', 'beyot-framework'),
									'id'      => $prefix . 'top_drawer_type',
									'type'    => 'button_set',
									'default'     => isset($options['top_drawer_type']) ? $options['top_drawer_type'] : 'none',
									'options' => array(
										'none'   => esc_html__('Disable', 'beyot-framework'),
										'show'   => esc_html__('Always Show', 'beyot-framework'),
										'toggle' => esc_html__('Toggle', 'beyot-framework')
									),
									'desc'    => esc_html__('Top drawer type', 'beyot-framework'),
								),
								array(
									'title'           => esc_html__('Top Drawer Sidebar', 'beyot-framework'),
									'id'             => $prefix . 'top_drawer_sidebar',
									'type'           => 'selectize',
									'allow_clear' => true,
									'data' => 'sidebar',
									'placeholder'    => esc_html__('Select Sidebar', 'beyot-framework'),
									'default'            => isset($options['top_drawer_sidebar']) ? $options['top_drawer_sidebar'] : '',
									'required' => array($prefix . 'top_drawer_type', '!=', 'none'),
								),

								array(
									'title'           => esc_html__('Top Drawer Wrapper Layout', 'beyot-framework'),
									'id'             => $prefix . 'top_drawer_wrapper_layout',
									'type'           => 'button_set',
									'default'            => isset($options['top_drawer_wrapper_layout']) ? $options['top_drawer_wrapper_layout'] : 'container',
									'options'        => array(
										'full'            => esc_html__('Full Width', 'beyot-framework'),
										'container'       => esc_html__('Container', 'beyot-framework'),
										'container-fluid' => esc_html__('Container Fluid', 'beyot-framework')
									),
									'required' => array($prefix . 'top_drawer_type', '!=', 'none'),
								),

								array(
									'title'           => esc_html__('Top Drawer hide on mobile', 'beyot-framework'),
									'id'             => $prefix . 'top_drawer_hide_mobile',
									'type'           => 'button_set',
									'default'            => isset($options['top_drawer_hide_mobile']) ? $options['top_drawer_hide_mobile'] : '1',
									'options'        => array(
										'1'  => esc_html__('Show on mobile', 'beyot-framework'),
										'0'  => esc_html__('Hide on mobile', 'beyot-framework'),
									),
									'required' => array($prefix . 'top_drawer_type', '!=', 'none'),
								),
								array(
									'id'    => $prefix . 'top_drawer_padding',
									'title'  => esc_html__('Top drawer padding', 'beyot-framework'),
									'desc'  => esc_html__('Top drawer padding top/bottom. Do not include units (empty to set default)', 'beyot-framework'),
									'type'  => 'spacing',
									'left'  => false,
									'right' => false,
									'default' => array(
										'top' => isset($options['top_drawer_padding']) && isset($options['top_drawer_padding']['top']) ? str_replace('px','',$options['top_drawer_padding']['top']) : '',
										'bottom' => isset($options['top_drawer_padding']) && isset($options['top_drawer_padding']['bottom']) ? str_replace('px','',$options['top_drawer_padding']['bottom']) : '',
									),
									'required' => array($prefix . 'top_drawer_type', '!=', 'none'),
								),
							)
						)
					)
				),


				/**
				 * Header
				 */
				array(
					'id' => $prefix . 'header_meta_box',
					'title' => esc_html__('Header', 'beyot-framework'),
					'icon' => 'dashicons dashicons-editor-kitchensink',
					'fields'     => array(
						array(
							'title' => esc_html__('Header On/Off?', 'beyot-framework'),
							'id'   => $prefix . 'header_show_hide',
							'type' => 'button_set',
							'options'        => array(
								'1'  => esc_html__('On', 'beyot-framework'),
								'0'  => esc_html__('Off', 'beyot-framework')
							),
							'desc' => esc_html__('Turn ON/Off Header', 'beyot-framework'),
							'default'  => '1',
						),
						array(
							'title'           => esc_html__('Desktop Settings', 'beyot-framework'),
							'id'             => $prefix . 'page_header_customize_enable',
							'type'           => 'group',
							'required' => array($prefix . 'header_show_hide', '!=', '0'),
							'fields' => array(
								array(
									'title'           => esc_html__('Header Layout', 'beyot-framework'),
									'id'             => $prefix . 'header_layout',
									'type'           => 'image_set',
									'default'            => isset($options['header_layout']) ? $options['header_layout'] : 'header-1',
									'options'        => array(
										'header-1'  => GF_PLUGIN_URL . '/assets/images/theme-options/header-1.jpg',
										'header-2'  => GF_PLUGIN_URL . '/assets/images/theme-options/header-2.jpg',
										'header-3'  => GF_PLUGIN_URL . '/assets/images/theme-options/header-3.jpg',
										'header-4'  => GF_PLUGIN_URL . '/assets/images/theme-options/header-4.jpg',
									),
									'required' => array($prefix . 'header_show_hide', '!=', '0'),
								),
								array(
									'id'             => $prefix . 'header_container_layout',
									'title'           => esc_html__('Container Layout', 'beyot-framework'),
									'type'           => 'button_set',
									'default'            => isset($options['header_container_layout']) ? $options['header_container_layout'] : 'container',
									'options'        => array(
										'container'      => esc_html__('Container', 'beyot-framework'),
										'container-fluid' => esc_html__('Container Fluid', 'beyot-framework'),
									),
									'required' => array($prefix . 'header_show_hide', '!=', '0'),
								),
								array(
									'id'             => $prefix . 'header_float',
									'title'           => esc_html__('Header Float', 'beyot-framework'),
									'type'           => 'button_set',
									'default'            => isset($options['header_float']) ? $options['header_float'] : '0',
									'options'        => array(
										'1'  => esc_html__('On', 'beyot-framework'),
										'0'  => esc_html__('Off', 'beyot-framework'),
									),
									'required' => array($prefix . 'header_show_hide', '!=', '0'),
								),
								array(
									'id'             => $prefix . 'header_sticky',
									'title'           => esc_html__('Header Sticky', 'beyot-framework'),
									'type'           => 'button_set',
									'default'            => isset($options['header_sticky']) ? $options['header_sticky'] : '0',
									'options'        => array(
										'1'  => esc_html__('On', 'beyot-framework'),
										'0'  => esc_html__('Off', 'beyot-framework')
									),
									'required' => array($prefix . 'header_show_hide', '!=', '0'),
								),
								array(
									'id'             => $prefix . 'header_border_bottom',
									'title'           => esc_html__('Header border bottom', 'beyot-framework'),
									'type'           => 'button_set',
									'default'            => isset($options['header_border_bottom']) ? $options['header_border_bottom'] : 'none',
									'options'        => array(
										'none'              => esc_html__('None','beyot-framework'),
										'full-border'       => esc_html__('Full Border','beyot-framework'),
										'container-border'  => esc_html__('Container Border','beyot-framework'),
									),
									'required' => array($prefix . 'header_show_hide', '!=', '0'),
								),
								array(
									'id'             => $prefix . 'header_padding',
									'title'           => esc_html__('Header padding', 'beyot-framework'),
									'desc'           => esc_html__('Header padding top/bottom. Do not include units (empty to set default)', 'beyot-framework'),
									'type'           => 'spacing',
									'left'  => false,
									'right' => false,
									'default' => array(
										'top' => isset($options['header_padding']) && isset($options['header_padding']['top']) ? str_replace('px','',$options['header_padding']['top']) : '',
										'bottom' => isset($options['header_padding']) && isset($options['header_padding']['bottom']) ? str_replace('px','',$options['header_padding']['bottom']) : '',
									),
									'required' => array($prefix . 'header_show_hide', '!=', '0'),
								),
								array(
									'id'             => $prefix . 'navigation_height',
									'title'           => esc_html__('Navigation height', 'beyot-framework'),
									'type'           => 'text',
									'desc'           => esc_html__('Set header navigation height (px). Do not include unit.', 'beyot-framework'),
									'default'            => isset($options['navigation_height']) && isset($options['navigation_height']['height']) ? str_replace('px','',$options['navigation_height']['height']) : '',
									'required' => array($prefix . 'header_show_hide', '!=', '0'),
								),
								array(
									'id'             => $prefix . 'navigation_spacing',
									'title'           => esc_html__('Navigation Spacing (px)', 'beyot-framework'),
									'clone'          => false,
									'range' => false,
									'type'           => 'slider',
									'prefix'         => '',
									'default'            => isset($options['navigation_spacing']) ? str_replace('px','', $options['navigation_spacing']) : '40',
									'js_options'     => array(
										'min'  => 0,
										'max'  => 100,
										'step' => 1,
									),
								)
							)
						),

						//-----------------------------------------------------------------------
						array(
							'title'           => esc_html__('Page Header Mobile', 'beyot-framework'),
							'id'             => $prefix . 'page_header_section_2',
							'type'           => 'group',
							'required' => array($prefix . 'header_show_hide', '!=', '0'),
							'fields' => array(
								array(
									'title'           => esc_html__('Header Mobile Layout', 'beyot-framework'),
									'id'             => $prefix . 'mobile_header_layout',
									'type'           => 'image_set',
									'allow_clear'     => true,
									'default'            => isset($options['mobile_header_layout']) ? $options['mobile_header_layout'] : 'header-mobile-1',
									'options'        => array(
										'header-mobile-1' => GF_PLUGIN_URL . 'assets/images/theme-options/header-mobile-layout-1.png',
										'header-mobile-2' => GF_PLUGIN_URL . 'assets/images/theme-options/header-mobile-layout-2.png',
										'header-mobile-3' => GF_PLUGIN_URL . 'assets/images/theme-options/header-mobile-layout-3.png',
										'header-mobile-4' => GF_PLUGIN_URL . 'assets/images/theme-options/header-mobile-layout-4.png',
									),
									'required' => array($prefix . 'header_show_hide', '!=', '0'),
								),
								array(
									'id'             => $prefix . 'mobile_header_menu_drop',
									'title'           => esc_html__('Menu Drop Type', 'beyot-framework'),
									'type'           => 'button_set',
									'default'            => isset($options['mobile_header_menu_drop']) ? $options['mobile_header_menu_drop'] : 'menu-drop-fly',
									'options'        => array(
										'menu-drop-fly'      => esc_html__('Fly Menu', 'beyot-framework'),
										'menu-drop-dropdown' => esc_html__('Dropdown Menu', 'beyot-framework'),
									),
									'required' => array($prefix . 'header_show_hide', '!=', '0'),
								),
								array(
									'id'             => $prefix . 'mobile_header_stick',
									'title'           => esc_html__('Header mobile sticky', 'beyot-framework'),
									'type'           => 'button_set',
									'default'            => isset($options['mobile_header_stick']) ? $options['mobile_header_stick'] : '0',
									'options'        => array(
										'1'  => esc_html__('Enable', 'beyot-framework'),
										'0'  => esc_html__('Disable', 'beyot-framework'),
									),
									'required' => array($prefix . 'header_show_hide', '!=', '0'),
								),
								array(
									'title'           => esc_html__('Mobile Header Search Box', 'beyot-framework'),
									'id'             => $prefix . 'mobile_header_search_box',
									'type'           => 'button_set',
									'default'            => isset($options['mobile_header_search_box']) ? $options['mobile_header_search_box'] : '1',
									'options'        => array(
										'1'  => esc_html__('Show', 'beyot-framework'),
										'0'  => esc_html__('Hide', 'beyot-framework')
									),
									'required' => array($prefix . 'header_show_hide', '!=', '0'),
								),
								array(
									'title'           => esc_html__('Mobile Header Login', 'beyot-framework'),
									'id'             => $prefix . 'mobile_header_login',
									'type'           => 'button_set',
									'default'            => isset($options['mobile_header_login']) ? $options['mobile_header_login'] : '1',
									'options'        => array(
										'1'  => esc_html__('Show', 'beyot-framework'),
										'0'  => esc_html__('Hide', 'beyot-framework')
									),
									'required' => array($prefix . 'header_show_hide', '!=', '0'),
								),
								array(
									'id'             => $prefix . 'mobile_header_border_bottom',
									'title'           => esc_html__('Mobile header border bottom', 'beyot-framework'),
									'type'           => 'button_set',
									'default'            => isset($options['mobile_header_border_bottom']) ? $options['mobile_header_border_bottom'] : 'none',
									'options'        => array(
										'none'     => esc_html__('None', 'beyot-framework'),
										'bordered' => esc_html__('Bordered', 'beyot-framework'),
									),
									'required' => array($prefix . 'header_show_hide', '!=', '0'),
								)
							)
						)
					)
				),

				/**
				 * Top bar
				 */
				array(
					'id' => $prefix . 'top_bar_meta_box',
					'title' => esc_html__('Top bar', 'beyot-framework'),
					'icon' => 'dashicons dashicons-welcome-widgets-menus',
					'fields'     => array(
						array(
							'title' => esc_html__('Desktop Settings', 'beyot-framework'),
							'id'   => $prefix . 'top_bar_desktop_section',
							'type' => 'group',
							'required' => array($prefix . 'header_show_hide', '=', '1'),
							'fields' => array(
								array(
									'title'    => esc_html__('Show/Hide Top Bar', 'beyot-framework'),
									'id'      => $prefix . 'top_bar_enable',
									'type'    => 'button_set',
									'default'     => isset($options['top_bar_enable']) ? $options['top_bar_enable'] : '0',
									'options' => array(
										'1'  => esc_html__('Show', 'beyot-framework'),
										'0'  => esc_html__('Hide', 'beyot-framework')
									),
									'desc'    => esc_html__('Show/Hide Top Bar.', 'beyot-framework'),
								),
								array(
									'title'           => esc_html__('Top Bar Wrapper Layout', 'beyot-framework'),
									'id'             => $prefix . 'top_bar_wrapper_layout',
									'type'           => 'button_set',
									'default'            => isset($options['top_bar_wrapper_layout']) ? $options['top_bar_wrapper_layout'] : 'container',
									'options'        => array(
										'container'       => esc_html__('Container', 'beyot-framework'),
										'container-fluid' => esc_html__('Container Fluid', 'beyot-framework')
									),
									'required' => array(
										array($prefix . 'top_bar_enable', '!=', '0'),
									),
								),
								array(
									'title'           => esc_html__('Top Bar Layout', 'beyot-framework'),
									'id'             => $prefix . 'top_bar_layout',
									'type'           => 'image_set',
									'width'          => '80px',
									'default'            => isset($options['top_bar_layout']) ? $options['top_bar_layout'] : 'top-bar-1',
									'options'        => array(
										'top-bar-1' => GF_PLUGIN_URL . 'assets/images/theme-options/top-bar-layout-1.jpg',
										'top-bar-2' => GF_PLUGIN_URL . 'assets/images/theme-options/top-bar-layout-2.jpg',
										'top-bar-3' => GF_PLUGIN_URL . 'assets/images/theme-options/top-bar-layout-3.jpg',
										'top-bar-4' => GF_PLUGIN_URL . 'assets/images/theme-options/top-bar-layout-4.jpg'
									),
									'required' => array(
										array($prefix . 'top_bar_enable', '!=', '0'),
									),
								),

								array(
									'title'           => esc_html__('Top Left Sidebar', 'beyot-framework'),
									'id'             => $prefix . 'top_bar_left_sidebar',
									'type'           => 'selectize',
									'allow_clear' => true,
									'data' => 'sidebar',
									'default'            => isset($options['top_bar_left_sidebar']) ? $options['top_bar_left_sidebar'] : 'top_bar_left',
									'placeholder'    => esc_html__('Select Sidebar', 'beyot-framework'),
									'required' => array(
										array($prefix . 'top_bar_enable', '!=', '0'),
									),
								),

								array(
									'title'           => esc_html__('Top Right Sidebar', 'beyot-framework'),
									'id'             => $prefix . 'top_bar_right_sidebar',
									'type'           => 'selectize',
									'allow_clear' => true,
									'data' => 'sidebar',
									'default'            => isset($options['top_bar_right_sidebar']) ? $options['top_bar_right_sidebar'] : 'top_bar_right',
									'placeholder'    => esc_html__('Select Sidebar', 'beyot-framework'),
									'required' => array(
										array($prefix . 'top_bar_enable', '!=', '0'),
										array($prefix . 'top_bar_layout', '!=', 'top-bar-4'),
									),
								),

								array(
									'title'           => esc_html__('Top Bar Border', 'beyot-framework'),
									'id'             => $prefix . 'top_bar_border',
									'type'           => 'button_set',
									'default'            => isset($options['top_bar_border']) ? $options['top_bar_border'] : 'none',
									'options'        => array(
										'none'             => esc_html__('None', 'beyot-framework'),
										'full-border'      => esc_html__('Full Border', 'beyot-framework'),
										'container-border' => esc_html__('Container Border', 'beyot-framework'),
									),
									'required' => array(
										array($prefix . 'top_bar_enable', '!=', '0'),
									),
								),
								array(
									'id'             => $prefix . 'top_bar_padding',
									'title'           => esc_html__('Top bar padding', 'beyot-framework'),
									'desc'           => esc_html__('Top bar padding top/bottom. Do not include units (empty to set default)', 'beyot-framework'),
									'type'           => 'spacing',
									'left'  => false,
									'right' => false,
									'default' => array(
										'top' => isset($options['top_bar_padding']) && isset($options['top_bar_padding']['padding-top']) ? str_replace('px','',$options['top_bar_padding']['padding-top']) : '',
										'bottom' => isset($options['top_bar_padding']) && isset($options['top_bar_padding']['padding-bottom']) ? str_replace('px','',$options['top_bar_padding']['padding-bottom']) : '',
									),
									'required' => array(
										array($prefix . 'top_bar_enable', '!=', '0'),
									),
								),
							)
						),

						array(
							'title' => esc_html__('Mobile Settings', 'beyot-framework'),
							'id'   => $prefix . 'top_bar_mobile_section',
							'type' => 'group',
							'required' => array($prefix . 'header_show_hide', '=', '1'),
							'fields' => array(
								array(
									'title'    => esc_html__('Show/Hide Top Bar', 'beyot-framework'),
									'id'      => $prefix . 'top_bar_mobile_enable',
									'type'    => 'button_set',
									'options' => array(
										'1'  => esc_html__('Show', 'beyot-framework'),
										'0'  => esc_html__('Hide', 'beyot-framework')
									),
									'default'            => isset($options['top_bar_mobile_enable']) ? $options['top_bar_mobile_enable'] : '0',
									'desc'    => esc_html__('Show/Hide Top Bar.', 'beyot-framework'),
								),
								array(
									'title'           => esc_html__('Top Bar Layout', 'beyot-framework'),
									'id'             => $prefix . 'top_bar_mobile_layout',
									'type'           => 'image_set',
									'width'          => '80px',
									'default'            => isset($options['top_bar_mobile_layout']) ? $options['top_bar_mobile_layout'] : 'top-bar-1',
									'options'        => array(
										'top-bar-1' => GF_PLUGIN_URL . 'assets/images/theme-options/top-bar-layout-1.jpg',
										'top-bar-2' => GF_PLUGIN_URL . 'assets/images/theme-options/top-bar-layout-2.jpg',
										'top-bar-3' => GF_PLUGIN_URL . 'assets/images/theme-options/top-bar-layout-3.jpg',
										'top-bar-4' => GF_PLUGIN_URL . 'assets/images/theme-options/top-bar-layout-4.jpg'
									),
									'required' => array(
										array($prefix . 'top_bar_mobile_enable', '!=', '0'),
									),
								),

								array(
									'title'           => esc_html__('Top Left Sidebar', 'beyot-framework'),
									'id'             => $prefix . 'top_bar_mobile_left_sidebar',
									'type'           => 'selectize',
									'allow_clear' => true,
									'data' => 'sidebar',
									'default'            => isset($options['top_bar_mobile_left_sidebar']) ? $options['top_bar_mobile_left_sidebar'] : 'top_bar_left',
									'placeholder'    => esc_html__('Select Sidebar', 'beyot-framework'),
									'required' => array(
										array($prefix . 'top_bar_mobile_enable', '!=', '0'),
									),
								),

								array(
									'title'           => esc_html__('Top Right Sidebar', 'beyot-framework'),
									'id'             => $prefix . 'top_bar_mobile_right_sidebar',
									'type'           => 'selectize',
									'allow_clear' => true,
									'data' => 'sidebar',
									'default'            => isset($options['top_bar_mobile_right_sidebar']) ? $options['top_bar_mobile_right_sidebar'] : 'top_bar_right',
									'placeholder'    => esc_html__('Select Sidebar', 'beyot-framework'),
									'required' => array(
										array($prefix . 'top_bar_mobile_enable', '!=', '0'),
										array($prefix . 'top_bar_mobile_layout', '!=', 'top-bar-4'),
									),
								),
								array(
									'title'           => esc_html__('Top Bar Border', 'beyot-framework'),
									'id'             => $prefix . 'top_bar_mobile_border',
									'type'           => 'button_set',
									'default'            => isset($options['top_bar_mobile_border']) ? $options['top_bar_mobile_border'] : 'none',
									'options'        => array(
										'none'             => esc_html__('None', 'beyot-framework'),
										'full-border'      => esc_html__('Full Border', 'beyot-framework'),
										'container-border' => esc_html__('Container Border', 'beyot-framework'),
									),
									'desc'           => esc_html__('Show Hide Top Bar.', 'beyot-framework'),
									'required' => array(
										array($prefix . 'top_bar_mobile_enable', '!=', '0'),
									),
								),
							)
						),
					)
				),

				/**
				 * Header Customize
				 */
				array(
					'id' => $prefix . 'header_customize_meta_box',
					'title' => esc_html__('Header Customize', 'beyot-framework'),
					'icon' => 'dashicons dashicons-editor-kitchensink',
					'fields'     => array(
						array(
							'title'   => esc_html__('Header Customize Left', 'beyot-framework'),
							'id'     => $prefix . 'enable_header_customize_left',
							'type'   => 'group',
							'required' => array(
								array($prefix . 'header_show_hide', '=', '1'),
								array($prefix . 'header_layout', '=', 'header-2')
							),
							'fields' => array(
								array(
									'title'           => esc_html__('Header Customize Left', 'beyot-framework'),
									'id'             => $prefix . 'header_customize_left',
									'type'           => 'sortable',
									'desc'           => esc_html__('Select element for header customize left. Drag to change element order', 'beyot-framework'),
									'options'        => array(
										'search'        => esc_html__('Search Button', 'beyot-framework'),
										'sidebar'       => esc_html__('Sidebar', 'beyot-framework'),
										'custom-text'   => esc_html__('Custom Text', 'beyot-framework'),
									),
									'required' => array($prefix . 'header_layout', '=', 'header-2'),
								),
								array(
									'title'           => esc_html__('Search Type', 'beyot-framework'),
									'id'             => $prefix . 'header_customize_left_search',
									'type'           => 'button_set',
									'default'            => isset($options['header_customize_left_search']) ? $options['header_customize_left_search'] : 'button',
									'options'        => gf_get_search_type(),
									'required' => array(
										array($prefix . 'header_layout', '=', 'header-2'),
										array($prefix . 'header_customize_left', 'contain', 'search')
									)
								),
								array(
									'title'           => esc_html__('Sidebar', 'beyot-framework'),
									'id'             => $prefix . 'header_customize_left_sidebar',
									'type'           => 'selectize',
									'allow_clear' => true,
									'data' => 'sidebar',
									'default'            => isset($options['header_customize_left_sidebar']) ? $options['header_customize_left_sidebar'] : '',
									'placeholder'    => esc_html__('Select Sidebar', 'beyot-framework'),
									'required' => array(
										array($prefix . 'header_layout', '=', 'header-2'),
										array($prefix . 'header_customize_left', 'contain', 'sidebar')
									)
								),
								array(
									'title'           => esc_html__('Custom text content left', 'beyot-framework'),
									'id'             => $prefix . 'header_customize_left_text',
									'type'           => 'textarea',
									'default'            => isset($options['header_customize_left_text']) ? $options['header_customize_left_text'] : '',
									'required' => array(
										array($prefix . 'header_layout', '=', 'header-2'),
										array($prefix . 'header_customize_left', 'contain', 'custom-text')
									)
								),
								array(
									'id'             => $prefix . 'header_customize_left_spacing',
									'title'           => esc_html__('Navigation Item Spacing (px)', 'beyot-framework'),
									'clone'          => false,
									'type'           => 'slider',
									'prefix'         => '',
									'default'            => isset($options['header_customize_left_spacing']) ? str_replace('px','', $options['header_customize_left_spacing']) : '13',
									'js_options'     => array(
										'min'  => 0,
										'max'  => 100,
										'step' => 1,
									),
									'required' => array($prefix . 'header_layout', '=', 'header-2'),
								),
								array(
									'title'           => esc_html__('Custom CSS class', 'beyot-framework'),
									'id'             => $prefix . 'header_customize_left_css_class',
									'type'           => 'text',
									'default'            => isset($options['header_customize_left_css_class']) ? $options['header_customize_left_css_class'] : '',
									'required' => array($prefix . 'header_layout', '=', 'header-2'),
								)
							)
						),

						array(
							'title'   => esc_html__('Header Customize Right', 'beyot-framework'),
							'id'     => $prefix . 'enable_header_customize_right',
							'type'   => 'group',
							'required' => array(
								array($prefix . 'header_show_hide', '=', '1'),
								array( $prefix . 'header_layout', 'in', array('header-2', 'header-3'))
							),
							'fields' => array(
								array(
									'title'           => esc_html__('Header Customize Right', 'beyot-framework'),
									'id'             => $prefix . 'header_customize_right',
									'type'           => 'sortable',
									'desc'           => esc_html__('Select element for header customize right. Drag to change element order', 'beyot-framework'),
									'options'        => array(
										'search'        => esc_html__('Search Button', 'beyot-framework'),
										'sidebar'       => esc_html__('Sidebar', 'beyot-framework'),
										'custom-text'   => esc_html__('Custom Text', 'beyot-framework'),
									),
									'required' => array( $prefix . 'header_layout', 'in', array('header-2', 'header-3')),
								),
								array(
									'title'           => esc_html__('Search Type', 'beyot-framework'),
									'id'             => $prefix . 'header_customize_right_search',
									'type'           => 'button_set',
									'default'            => isset($options['header_customize_right_search']) ? $options['header_customize_right_search'] : 'button',
									'options'        => gf_get_search_type(),
									'required' => array(
										array( $prefix . 'header_layout', 'in', array('header-2', 'header-3')),
										array($prefix . 'header_customize_right', 'contain', 'search')
									)
								),
								array(
									'title'           => esc_html__('Sidebar', 'beyot-framework'),
									'id'             => $prefix . 'header_customize_right_sidebar',
									'type'           => 'selectize',
									'allow_clear' => true,
									'data' => 'sidebar',
									'default'            => isset($options['header_customize_right_sidebar']) ? $options['header_customize_right_sidebar'] : '',
									'placeholder'    => esc_html__('Select Sidebar', 'beyot-framework'),
									'required' => array(
										array( $prefix . 'header_layout', 'in', array('header-2', 'header-3')),
										array($prefix . 'header_customize_right', 'contain', 'sidebar')
									)
								),
								array(
									'title'           => esc_html__('Custom text content right', 'beyot-framework'),
									'id'             => $prefix . 'header_customize_right_text',
									'type'           => 'textarea',
									'default'            => isset($options['header_customize_right_text']) ? $options['header_customize_right_text'] : '',
									'required' => array(
										array( $prefix . 'header_layout', 'in', array('header-2', 'header-3')),
										array($prefix . 'header_customize_right', 'contain', 'custom-text')
									)
								),
								array(
									'id'             => $prefix . 'header_customize_right_spacing',
									'title'           => esc_html__('Navigation Item Spacing (px)', 'beyot-framework'),
									'clone'          => false,
									'type'           => 'slider',
									'prefix'         => '',
									'default'            => isset($options['header_customize_right_spacing']) ? str_replace('px','', $options['header_customize_right_spacing']) : '13',
									'js_options'     => array(
										'min'  => 0,
										'max'  => 100,
										'step' => 1,
									),
									'required' => array( $prefix . 'header_layout', 'in', array('header-2', 'header-3')),
								),
								array(
									'title'           => esc_html__('Custom CSS class', 'beyot-framework'),
									'id'             => $prefix . 'header_customize_right_css_class',
									'type'           => 'text',
									'default'            => isset($options['header_customize_right_css_class']) ? $options['header_customize_right_css_class'] : '',
									'required' => array( $prefix . 'header_layout', 'in', array('header-2', 'header-3')),
								)
							)
						),

						array(
							'title'   => esc_html__('Header Customize Navigation', 'beyot-framework'),
							'id'     => $prefix . 'enable_header_customize_nav',
							'type'   => 'group',
							'required' => array($prefix . 'header_show_hide', '=', '1'),
							'fields' => array(
								array(
									'title'           => esc_html__('Header Customize Navigation', 'beyot-framework'),
									'id'             => $prefix . 'header_customize_nav',
									'type'           => 'sortable',
									'desc'           => esc_html__('Select element for header customize navigation. Drag to change element order', 'beyot-framework'),
									'options'        => array(
										'search'        => esc_html__('Search Button', 'beyot-framework'),
										'sidebar'       => esc_html__('Sidebar', 'beyot-framework'),
										'custom-text'   => esc_html__('Custom Text', 'beyot-framework'),
									),
								),
								array(
									'title'           => esc_html__('Search Type', 'beyot-framework'),
									'id'             => $prefix . 'header_customize_nav_search',
									'type'           => 'button_set',
									'default'            => isset($options['header_customize_nav_search']) ? $options['header_customize_nav_search'] : 'button',
									'options'        => gf_get_search_type(),
									'required' => array($prefix . 'header_customize_nav', 'contain', 'search')
								),
								array(
									'title'           => esc_html__('Sidebar', 'beyot-framework'),
									'id'             => $prefix . 'header_customize_nav_sidebar',
									'type'           => 'selectize',
									'allow_clear' => true,
									'data'=> 'sidebar',
									'default'            => isset($options['header_customize_nav_sidebar']) ? $options['header_customize_nav_sidebar'] : '',
									'placeholder'    => esc_html__('Select Sidebar', 'beyot-framework'),
									'required' => array($prefix . 'header_customize_nav', 'contain', 'sidebar')
								),
								array(
									'title'           => esc_html__('Custom text content', 'beyot-framework'),
									'id'             => $prefix . 'header_customize_nav_text',
									'type'           => 'textarea',
									'default'            => isset($options['header_customize_nav_text']) ? $options['header_customize_nav_text'] : '',
									'required' => array($prefix . 'header_customize_nav', 'contain', 'custom-text')
								),
								array(
									'id'             => $prefix . 'header_customize_nav_spacing',
									'title'           => esc_html__('Navigation Item Spacing (px)', 'beyot-framework'),
									'clone'          => false,
									'type'           => 'slider',
									'prefix'         => '',
									'default'            => isset($options['header_customize_nav_spacing']) ? str_replace('px','', $options['header_customize_nav_spacing']) : '13',
									'js_options'     => array(
										'min'  => 0,
										'max'  => 100,
										'step' => 1,
									),
								),
								array(
									'title'           => esc_html__('Custom CSS class', 'beyot-framework'),
									'id'             => $prefix . 'header_customize_nav_css_class',
									'type'           => 'text',
									'default'            => isset($options['header_customize_nav_css_class']) ? $options['header_customize_nav_css_class'] : '',
								)
							)
						)
					)
				),

				/**
				 * Menu
				 */
				array(
					'id' => $prefix . 'menu_meta_box',
					'title' => esc_html__('Menu', 'beyot-framework'),
					'icon' => 'dashicons dashicons-menu',
					'fields'     => array(
						array(
							'title' => esc_html__('General', 'beyot-framework'),
							'id'   => $prefix . 'menu_meta_box_general',
							'type' => 'group',
							'fields' => array(
								array(
									'title'        => esc_html__('Page menu', 'beyot-framework'),
									'id'          => $prefix . 'page_menu',
									'type'        => 'selectize',
									'allow_clear' => true,
									'data' => 'menu',
									'placeholder' => esc_html__('Select Menu', 'beyot-framework'),
									'default'         => '',
									'multiple'    => false,
									'desc'        => esc_html__('Optionally you can choose to override the menu that is used on the page', 'beyot-framework'),
								),

								array(
									'title'        => esc_html__('Page menu mobile', 'beyot-framework'),
									'id'          => $prefix . 'page_menu_mobile',
									'type'        => 'selectize',
									'allow_clear' => true,
									'data' => 'menu',
									'placeholder' => esc_html__('Select Menu', 'beyot-framework'),
									'default'         => '',
									'multiple'    => false,
									'desc'        => esc_html__('Optionally you can choose to override the menu mobile that is used on the page', 'beyot-framework'),
								),

								array(
									'title' => esc_html__('Is One Page', 'beyot-framework'),
									'id'   => $prefix . 'is_one_page',
									'type' => 'button_set',
									'options'        => array(
										'1'  => esc_html__('On', 'beyot-framework'),
										'0'  => esc_html__('Off', 'beyot-framework')
									),
									'default'  => 0,
									'desc' => esc_html__('Set page style is One Page', 'beyot-framework'),
								)
							)
						)
					)
				),
				
				/**
				 * Footer
				 */
				array(
					'id' => $prefix . 'footer_meta_box',
					'title' => esc_html__('Footer', 'beyot-framework'),
					'icon' => 'dashicons dashicons-networking',
					'fields'     => array(
						array(
							'title' => esc_html__('Footer Custom', 'beyot-framework'),
							'id'   => $prefix . 'set_footer_custom',
							'type' => 'selectize',
							'allow_clear' => true,
							'data' => 'post',
							'data_args' => array (
								'post_type' => 'gf_footer',
								'posts_per_page' => -1,
								'post_status' => 'publish'
							),
							'placeholder' => esc_html__('Set Custom Footer', 'beyot-framework'),
							'default'   => isset($options['set_footer_custom']) ? $options['set_footer_custom'] : '',
							'desc'  => esc_html__('Select one to apply to the page footer', 'beyot-framework'),
						),
						array(
							'title' => esc_html__('Show/Hide Footer', 'beyot-framework'),
							'id'   => $prefix . 'footer_show_hide',
							'type' => 'button_set',
							'options'        => array(
								'1'  => esc_html__('On', 'beyot-framework'),
								'0'  => esc_html__('Off', 'beyot-framework')
							),
							'default'  => '1',
							'desc' => esc_html__('Show/hide footer', 'beyot-framework'),
							'required' => array(
								array($prefix . 'set_footer_custom', '=', ''),
							),
						),
						array(
							'title' => esc_html__('General Settings', 'beyot-framework'),
							'id'   => $prefix . 'page_footer_general',
							'type' => 'group',
							'required' => array(
								array(
									array($prefix . 'set_footer_custom', '!=', ''),
									array($prefix . 'footer_show_hide', '=', '1')
								)
							),
							'fields' => array(
								array(
									'title'           => esc_html__('Footer Container Layout', 'beyot-framework'),
									'id'             => $prefix . 'footer_container_layout',
									'type'           => 'button_set',
									'default'            => isset($options['footer_container_layout']) ? $options['footer_container_layout'] : 'Container',
									'options'        => array(
										'full'            => esc_html__('Full Width', 'beyot-framework'),
										'container-fluid' => esc_html__('Container Fluid', 'beyot-framework'),
										'container'       => esc_html__('Container', 'beyot-framework'),
									),
									'desc'           => esc_html__('Select Footer Wrapper Layout', 'beyot-framework'),
								),
								array(
									'title'           => esc_html__('Footer Parallax', 'beyot-framework'),
									'id'             => $prefix . 'footer_parallax',
									'type'           => 'button_set',
									'default'            => isset($options['footer_parallax']) ? $options['footer_parallax'] : '0',
									'options'        => array(
										'1'  => esc_html__('On', 'beyot-framework'),
										'0'  => esc_html__('Off', 'beyot-framework')
									),
									'desc'           => esc_html__('Enable Footer Parallax', 'beyot-framework'),
								),
								array(
									'id' => $prefix . 'custom_footer_bg_image_enable',
									'title' => esc_html__('Custom Background Image','beyot-framework'),
									'desc' => esc_html__('Turn on this option if you want to enable custom background image of footer','beyot-framework'),
									'type' => 'button_set',
									'options' => gf_get_toggle(),
									'std' => 0
								),
								array(
									'id'               => $prefix . 'footer_bg_image',
									'title'             => esc_html__('Background Image', 'beyot-framework'),
									'desc'             => esc_html__('Set footer background image', 'beyot-framework'),
									'type'             => 'image',
									'max_file_uploads' => 1,
									'default'              => '',
									'required' => array( $prefix . 'custom_footer_bg_image_enable', '=', 1)
								),
								array(
									'title'           => esc_html__('Footer Image apply for', 'beyot-framework'),
									'id'             => $prefix . 'footer_bg_image_apply_for',
									'type'           => 'button_set',
									'default'            => isset($options['footer_bg_image_apply_for']) ? $options['footer_bg_image_apply_for'] : 'footer.main-footer-wrapper',
									'options'  => array(
										'footer.main-footer-wrapper'    => esc_html__('Footer Wrapper', 'beyot-framework'),
										'footer .main-footer'           => esc_html__('Main Footer', 'beyot-framework'),
									),
									'desc'           => esc_html__('Select region apply for footer image', 'beyot-framework'),
									'required' => array(
										array($prefix . 'footer_bg_image', '!=', ''),
									),
								),
								array(
									'title'           => esc_html__('Css class', 'beyot-framework'),
									'id'             => $prefix . 'footer_css_class',
									'type'           => 'text',
									'default'  => '',
								)
							)
						),
						//--------------------------------------------------------------------
						array(
							'title' => esc_html__('Above Footer Settings', 'beyot-framework'),
							'id'   => $prefix . 'page_footer_section_1',
							'type' => 'group',
							'required' => array(
								array($prefix . 'set_footer_custom', '=', ''),
								array($prefix . 'footer_show_hide', '=', '1'),
							),
							'fields' => array(
								array(
									'title' => esc_html__('Above Footer', 'beyot-framework'),
									'id'   => $prefix . 'set_footer_above_custom',
									'type' => 'selectize',
									'allow_clear' => true,
									'data' => 'post',
									'data_args' => array (
										'post_type' => 'gf_footer',
										'posts_per_page' => -1,
										'post_status' => 'publish'
									),
									'placeholder' => esc_html__('Set Above Footer', 'beyot-framework'),
									'default'  => isset($options['set_footer_above_custom']) ? $options['set_footer_above_custom'] : '',
									'required' => array(
										array($prefix . 'set_footer_custom', '=', ''),
									),
								),
							)
						),
						array(
							'title' => esc_html__('Main Footer Settings', 'beyot-framework'),
							'id'   => $prefix . 'page_footer_section_2',
							'type' => 'group',
							'required' => array(
								array($prefix . 'set_footer_custom', '=', ''),
								array($prefix . 'footer_show_hide', '=', '1'),
							),
							'fields' => array(
								array(
									'title'           => esc_html__('Layout', 'beyot-framework'),
									'id'             => $prefix . 'footer_layout',
									'type'           => 'image_set',
									'width'          => '80px',
									'default'            => isset($options['footer_layout']) ? $options['footer_layout'] : 'footer-1',
									'options'        => array(
										'footer-1' => GF_PLUGIN_URL . '/assets/images/theme-options/footer-layout-1.jpg',
										'footer-2' => GF_PLUGIN_URL . '/assets/images/theme-options/footer-layout-2.jpg',
										'footer-3' => GF_PLUGIN_URL . '/assets/images/theme-options/footer-layout-3.jpg',
										'footer-4' => GF_PLUGIN_URL . '/assets/images/theme-options/footer-layout-4.jpg',
										'footer-5' => GF_PLUGIN_URL . '/assets/images/theme-options/footer-layout-5.jpg',
										'footer-6' => GF_PLUGIN_URL . '/assets/images/theme-options/footer-layout-6.jpg',
										'footer-7' => GF_PLUGIN_URL . '/assets/images/theme-options/footer-layout-7.jpg',
										'footer-8' => GF_PLUGIN_URL . '/assets/images/theme-options/footer-layout-8.jpg',
										'footer-9' => GF_PLUGIN_URL . '/assets/images/theme-options/footer-layout-9.jpg',
									),
									'desc'           => esc_html__('Select Footer Layout (Not set to default).', 'beyot-framework'),
									'required' => array(
										array($prefix . 'set_footer_custom', '=', ''),
										array($prefix . 'footer_show_hide', '=', '1'),
									),
								),
								array(
									'title'           => esc_html__('Sidebar 1', 'beyot-framework'),
									'id'             => $prefix . 'footer_sidebar_1',
									'type'           => 'selectize',
									'allow_clear' => true,
									'data' => 'sidebar',
									'placeholder'    => esc_html__('Select Sidebar', 'beyot-framework'),
									'default'            => isset($options['footer_sidebar_1']) ? $options['footer_sidebar_1'] : 'footer-1',
									'required' => array(
										array($prefix . 'set_footer_custom', '=', ''),
										array($prefix . 'footer_show_hide', '=', '1'),
										array($prefix . 'footer_layout', 'in', array('footer-1', 'footer-2', 'footer-3', 'footer-4', 'footer-5', 'footer-6', 'footer-7', 'footer-8', 'footer-9'))
									),
								),

								array(
									'title'           => esc_html__('Sidebar 2', 'beyot-framework'),
									'id'             => $prefix . 'footer_sidebar_2',
									'type'           => 'selectize',
									'allow_clear' => true,
									'data' => 'sidebar',
									'placeholder'    => esc_html__('Select Sidebar', 'beyot-framework'),
									'default'            => isset($options['footer_sidebar_2']) ? $options['footer_sidebar_2'] : 'footer-2',
									'required' => array(
										array($prefix . 'set_footer_custom', '=', ''),
										array($prefix . 'footer_show_hide', '=', '1'),
										array($prefix . 'footer_layout', 'in', array('footer-1', 'footer-2', 'footer-3', 'footer-4', 'footer-5', 'footer-6', 'footer-7', 'footer-8'))
									),
								),

								array(
									'title'           => esc_html__('Sidebar 3', 'beyot-framework'),
									'id'             => $prefix . 'footer_sidebar_3',
									'type'           => 'selectize',
									'allow_clear' => true,
									'data' => 'sidebar',
									'placeholder'    => esc_html__('Select Sidebar', 'beyot-framework'),
									'default'            => isset($options['footer_sidebar_3']) ? $options['footer_sidebar_3'] : 'footer-3',
									'required' => array(
										array($prefix . 'set_footer_custom', '=', ''),
										array($prefix . 'footer_show_hide', '=', '1'),
										array($prefix . 'footer_layout', 'in', array('footer-1', 'footer-2', 'footer-3', 'footer-5', 'footer-8'))
									),
								),

								array(
									'title'           => esc_html__('Sidebar 4', 'beyot-framework'),
									'id'             => $prefix . 'footer_sidebar_4',
									'type'           => 'selectize',
									'allow_clear' => true,
									'data' => 'sidebar',
									'placeholder'    => esc_html__('Select Sidebar', 'beyot-framework'),
									'default'            => isset($options['footer_sidebar_4']) ? $options['footer_sidebar_4'] : 'footer-4',
									'required' => array(
										array($prefix . 'set_footer_custom', '=', ''),
										array($prefix . 'footer_show_hide', '=', '1'),
										array($prefix . 'footer_layout', 'in', array('footer-1'))
									),
								),

								array(
									'title'           => esc_html__('Collapse footer on mobile device', 'beyot-framework'),
									'id'             => $prefix . 'collapse_footer',
									'type'           => 'button_set',
									'default'            => isset($options['collapse_footer']) ? $options['collapse_footer'] : '0',
									'options'        => array(
										'1'  => esc_html__('On', 'beyot-framework'),
										'0'  => esc_html__('Off', 'beyot-framework')
									),
									'desc'           => esc_html__('Enable collapse footer', 'beyot-framework'),
									'required' => array(
										array($prefix . 'set_footer_custom', '=', ''),
										array($prefix . 'footer_show_hide', '=', '1'),
									),
								),
								array(
									'title'           => esc_html__('Footer Border Top', 'beyot-framework'),
									'id'             => $prefix . 'footer_border_top',
									'type'           => 'button_set',
									'default'            => isset($options['footer_border_top']) ? $options['footer_border_top'] : 'none',
									'options'        => array(
										'none'             => esc_html__('None', 'beyot-framework'),
										'full-border'      => esc_html__('Full Border', 'beyot-framework'),
										'container-border' => esc_html__('Container Border', 'beyot-framework'),
									),
									'required' => array(
										array($prefix . 'set_footer_custom', '=', ''),
										array($prefix . 'footer_show_hide', '=', '1'),
									),
								),
								array(
									'id'             => $prefix . 'footer_padding',
									'title'           => esc_html__('Footer padding', 'beyot-framework'),
									'desc'           => esc_html__('Footer padding top/bottom. Do not include units (empty to set default)', 'beyot-framework'),
									'type'           => 'spacing',
									'left'  => false,
									'right' => false,
									'default' => array(
										'top' => isset($options['footer_padding']) && isset($options['footer_padding']['top']) ? str_replace('px','',$options['footer_padding']['top']) : '',
										'bottom' => isset($options['footer_padding']) && isset($options['footer_padding']['bottom']) ? str_replace('px','',$options['footer_padding']['bottom']) : '',
									),
									'required' => array(
										array($prefix . 'set_footer_custom', '=', ''),
										array($prefix . 'footer_show_hide', '=', '1'),
									),
								),
							)
						),

						//--------------------------------------------------------------------
						array(
							'title' => esc_html__('Bottom Bar Settings', 'beyot-framework'),
							'id'   => $prefix . 'page_footer_section_3',
							'type' => 'group',
							'required' => array(
								array($prefix . 'set_footer_custom', '=', ''),
							),
							'fields' => array(
								array(
									'title' => esc_html__('Show/Hide Bottom Bar', 'beyot-framework'),
									'id'   => $prefix . 'bottom_bar_visible',
									'type' => 'button_set',
									'options'        => array(
										'1'  => esc_html__('On', 'beyot-framework'),
										'0'  => esc_html__('Off', 'beyot-framework')
									),
									'default'  => '1',
									'desc' => esc_html__('Turn ON/OFF Bottom Bar.', 'beyot-framework'),
									'required' => array(
										array($prefix . 'set_footer_custom', '=', ''),
									),
								),
								array(
									'title'           => esc_html__('Bottom Bar Layout', 'beyot-framework'),
									'id'             => $prefix . 'bottom_bar_layout',
									'type'           => 'image_set',
									'width'          => '80px',
									'default'            => isset($options['bottom_bar_layout']) ? $options['bottom_bar_layout'] : 'bottom-bar-1',
									'options'        => array(
										'bottom-bar-1' => GF_PLUGIN_URL . '/assets/images/theme-options/bottom-bar-layout-1.jpg',
										'bottom-bar-2' => GF_PLUGIN_URL . '/assets/images/theme-options/bottom-bar-layout-2.jpg',
										'bottom-bar-3' => GF_PLUGIN_URL . '/assets/images/theme-options/bottom-bar-layout-3.jpg',
										'bottom-bar-4' => GF_PLUGIN_URL . '/assets/images/theme-options/bottom-bar-layout-4.jpg',
									),
									'desc'           => esc_html__('Bottom bar layout.', 'beyot-framework'),
									'required' => array(
										array($prefix . 'set_footer_custom', '=', ''),
										array($prefix . 'bottom_bar_visible', '!=', '0')
									),
								),

								array(
									'title'           => esc_html__('Bottom Bar Left Sidebar', 'beyot-framework'),
									'id'             => $prefix . 'bottom_bar_left_sidebar',
									'type'           => 'selectize',
									'allow_clear' => true,
									'data' => 'sidebar',
									'placeholder'    => esc_html__('Select Sidebar', 'beyot-framework'),
									'default'            => isset($options['bottom_bar_left_sidebar']) ? $options['bottom_bar_left_sidebar'] : 'bottom_bar_left',
									'required' => array(
										array($prefix . 'set_footer_custom', '=', ''),
										array($prefix . 'bottom_bar_visible', '!=', '0')
									),
								),

								array(
									'title'           => esc_html__('Bottom Bar Right Sidebar', 'beyot-framework'),
									'id'             => $prefix . 'bottom_bar_right_sidebar',
									'type'           => 'selectize',
									'data' => 'sidebar',
									'allow_clear' => true,
									'placeholder'    => esc_html__('Select Sidebar', 'beyot-framework'),
									'default'            => isset($options['bottom_bar_right_sidebar']) ? $options['bottom_bar_right_sidebar'] : 'bottom_bar_right',
									'required' => array(
										array($prefix . 'set_footer_custom', '=', ''),
										array($prefix . 'bottom_bar_visible', '!=', '0'),
										array($prefix . 'bottom_bar_layout', '!=', 'bottom-bar-4')
									),
								),
								array(
									'title'           => esc_html__('Bottom Bar Border Top', 'beyot-framework'),
									'id'             => $prefix . 'bottom_bar_border_top',
									'type'           => 'button_set',
									'default'            => isset($options['bottom_bar_border_top']) ? $options['bottom_bar_border_top'] : 'none',
									'options'        => array(
										'none'             => esc_html__('None', 'beyot-framework'),
										'full-border'      => esc_html__('Full Border', 'beyot-framework'),
										'container-border' => esc_html__('Container Border', 'beyot-framework'),
									),
									'required' => array(
										array($prefix . 'set_footer_custom', '=', ''),
										array($prefix . 'bottom_bar_visible', '!=', '0')
									),
								),
								array(
									'id'             => $prefix . 'bottom_bar_padding',
									'title'           => esc_html__('Bottom bar padding', 'beyot-framework'),
									'desc'           => esc_html__('Set bottom bar padding top/bottom. Do not include units (empty to set default)', 'beyot-framework'),
									'type'           => 'spacing',
									'left'  => false,
									'right' => false,
									'default' => array(
										'top' => isset($options['bottom_bar_padding']) && isset($options['bottom_bar_padding']['top']) ? str_replace('px','',$options['bottom_bar_padding']['top']) : '',
										'bottom' => isset($options['bottom_bar_padding']) && isset($options['bottom_bar_padding']['bottom']) ? str_replace('px','',$options['bottom_bar_padding']['bottom']) : '',
									),
									'required' => array(
										array($prefix . 'set_footer_custom', '=', ''),
										array($prefix . 'bottom_bar_visible', '!=', '0')
									),
								),
							)
						),

					)
				),

				/**
				 * Color
				 */
				array(
					'id' => $prefix . 'color_meta_box',
					'title' => esc_html__('Color', 'beyot-framework'),
					'icon' => 'dashicons dashicons-art',
					'fields'     => array(
						array(
							'id'     => $prefix . 'custom_color_general_section',
							'title'   => esc_html__('General', 'beyot-framework'),
							'type'   => 'group',
							'fields' => array(
								array(
									'title'           => esc_html__('Custom Color General', 'beyot-framework'),
									'id'             => $prefix . 'custom_color_general',
									'type'           => 'button_set',
									'options'        => array(
										'1'  => esc_html__('On', 'beyot-framework'),
										'0'  => esc_html__('Off', 'beyot-framework')
									),
									'default'            => 0
								),
								array(
									'title'           => esc_html__('Accent color', 'beyot-framework'),
									'id'             => $prefix . 'accent_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['accent_color']) ? $options['accent_color'] : '#fb6a19',
									'required' => array($prefix .  'custom_color_general', '=', '1'),
								),
								array(
									'title'           => esc_html__('Foreground Accent color', 'beyot-framework'),
									'id'             => $prefix . 'foreground_accent_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['foreground_accent_color']) ? $options['foreground_accent_color'] : '#fff',
									'required' => array($prefix .  'custom_color_general', '=', '1'),
								),
								array(
									'title'           => esc_html__('Text color', 'beyot-framework'),
									'id'             => $prefix . 'text_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['text_color']) ? $options['text_color'] : '#666',
									'required' => array($prefix .  'custom_color_general', '=', '1'),
								),
								array(
									'title'           => esc_html__('Border color', 'beyot-framework'),
									'id'             => $prefix . 'border_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['border_color']) ? $options['border_color'] : '#eee',
									'required' => array($prefix .  'custom_color_general', '=', '1'),
								),
								array(
									'title'           => esc_html__('Heading color', 'beyot-framework'),
									'id'             => $prefix . 'heading_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['heading_color']) ? $options['heading_color'] : '#111',
									'required' => array($prefix .  'custom_color_general', '=', '1'),
								),
							)
						),

						array(
							'id'     => $prefix . 'custom_color_top_drawer_section',
							'title'   => esc_html__('Top Drawer', 'beyot-framework'),
							'type'   => 'group',
							'required' => array($prefix.'top_drawer_type', '!=', 'none'),
							'fields'         => array(
								array(
									'title'           => esc_html__('Custom Color Top Drawer', 'beyot-framework'),
									'id'             => $prefix . 'custom_color_top_drawer',
									'type'           => 'button_set',
									'options'        => array(
										'1'  => esc_html__('On', 'beyot-framework'),
										'0'  => esc_html__('Off', 'beyot-framework')
									),
									'default'            => 0
								),
								array(
									'title'           => esc_html__('Top drawer background color', 'beyot-framework'),
									'id'             => $prefix . 'top_drawer_bg_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['top_drawer_bg_color']) ? $options['top_drawer_bg_color'] : '#2f2f2f',
									'required' => array($prefix . 'custom_color_top_drawer', '=', '1'),
								),
								array(
									'title'           => esc_html__('Top drawer text color', 'beyot-framework'),
									'id'             => $prefix . 'top_drawer_text_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['top_drawer_text_color']) ? $options['top_drawer_text_color'] : '#c5c5c5',
									'required' => array($prefix . 'custom_color_top_drawer', '=', '1'),
								),
							)
						),

						array(
							'id'     => $prefix . 'custom_color_header_section',
							'title'   => esc_html__('Header', 'beyot-framework'),
							'type'   => 'group',
							'required' => array($prefix.'header_show_hide', '!=', '0'),
							'fields'      => array(
								array(
									'title'           => esc_html__('Custom Color Header', 'beyot-framework'),
									'id'             => $prefix . 'custom_color_header',
									'type'           => 'button_set',
									'options'        => array(
										'1'  => esc_html__('On', 'beyot-framework'),
										'0'  => esc_html__('Off', 'beyot-framework')
									),
									'default'            => 0
								),
								array(
									'title'           => esc_html__('Header background color', 'beyot-framework'),
									'id'             => $prefix . 'header_bg_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['header_bg_color']) ? $options['header_bg_color'] : '#fff',
									'required' => array($prefix . 'custom_color_header', '=', '1'),
								),
								array(
									'title'           => esc_html__('Header text color', 'beyot-framework'),
									'id'             => $prefix . 'header_text_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['header_text_color']) ? $options['header_text_color'] : '#aaaaaa',
									'required' => array($prefix . 'custom_color_header', '=', '1'),
								),
								array(
									'title'           => esc_html__('Header border color', 'beyot-framework'),
									'id'             => $prefix . 'header_border_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['header_border_color']) ? $options['header_border_color'] : '#eee',
									'required' => array($prefix . 'custom_color_header', '=', '1'),
								),
							)
						),

						array(
							'id'     => $prefix . 'custom_color_top_bar_section',
							'title'   => esc_html__('Top Bar', 'beyot-framework'),
							'type'   => 'group',
							'required' => array(
								array($prefix.'header_show_hide', '!=', '0'),
								array(
									array($prefix.'top_bar_enable','=', '1'),
									array($prefix.'top_bar_mobile_enable','=', '1')
								)
							),
							'fields' => array(
								array(
									'title'           => esc_html__('Custom Color Top Bar', 'beyot-framework'),
									'id'             => $prefix . 'custom_color_top_bar',
									'type'           => 'button_set',
									'options'        => array(
										'1'  => esc_html__('On', 'beyot-framework'),
										'0'  => esc_html__('Off', 'beyot-framework')
									),
									'default'            => 0
								),
								array(
									'title'           => esc_html__('Top bar background color', 'beyot-framework'),
									'id'             => $prefix . 'top_bar_bg_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['top_bar_bg_color']) ? $options['top_bar_bg_color'] : '#fff',
									'required' => array($prefix . 'custom_color_top_bar', '=', '1'),
								),
								array(
									'title'           => esc_html__('Top bar text color', 'beyot-framework'),
									'id'             => $prefix . 'top_bar_text_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['top_bar_text_color']) ? $options['top_bar_text_color'] : '#222222',
									'required' => array($prefix . 'custom_color_top_bar', '=', '1'),
								),
								array(
									'title'           => esc_html__('Top bar border color', 'beyot-framework'),
									'id'             => $prefix . 'top_bar_border_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['top_bar_border_color']) ? $options['top_bar_border_color'] : '#eee',
									'required' => array($prefix . 'custom_color_top_bar', '=', '1'),
								),
							)
						),

						array(
							'id'     => $prefix . 'custom_color_navigation_section',
							'title'   => esc_html__('Navigation', 'beyot-framework'),
							'type'   => 'group',
							'required' => array(
								array($prefix.'header_show_hide', '!=', '0')
							),
							'fields' => array(
								array(
									'title'           => esc_html__('Custom Color Navigation', 'beyot-framework'),
									'id'             => $prefix . 'custom_color_navigation',
									'type'           => 'button_set',
									'options'        => array(
										'1'  => esc_html__('On', 'beyot-framework'),
										'0'  => esc_html__('Off', 'beyot-framework')
									),
									'default'            => 0
								),
								array(
									'title'           => esc_html__('Navigation background color', 'beyot-framework'),
									'id'             => $prefix . 'navigation_bg_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['navigation_bg_color']) ? $options['navigation_bg_color'] : '#fff',
									'required' => array($prefix . 'custom_color_navigation', '=', '1'),
								),
								array(
									'title'           => esc_html__('Navigation text color', 'beyot-framework'),
									'id'             => $prefix . 'navigation_text_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['navigation_text_color']) ? $options['navigation_text_color'] : '#212121',
									'required' => array($prefix . 'custom_color_navigation', '=', '1'),
								),
								array(
									'title'           => esc_html__('Navigation text hover color', 'beyot-framework'),
									'id'             => $prefix . 'navigation_text_color_hover',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['navigation_text_color_hover']) ? $options['navigation_text_color_hover'] : '#34A853',
									'required' => array($prefix . 'custom_color_navigation', '=', '1'),
								),
							)
						),

						array(
							'id'     => $prefix . 'custom_color_footer_section',
							'title'   => esc_html__('Footer', 'beyot-framework'),
							'type'   => 'group',
							'required' => array(
								array(
									array($prefix . 'set_footer_custom', '!=', ''),
									array($prefix . 'footer_show_hide', '=', '1')
								)
							),
							'fields' => array(
								array(
									'title'           => esc_html__('Custom Color Footer', 'beyot-framework'),
									'id'             => $prefix . 'custom_color_footer',
									'type'           => 'button_set',
									'options'        => array(
										'1'  => esc_html__('On', 'beyot-framework'),
										'0'  => esc_html__('Off', 'beyot-framework')
									),
									'default'            => 0
								),
								array(
									'title'           => esc_html__('Footer background color', 'beyot-framework'),
									'id'             => $prefix . 'footer_bg_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['footer_bg_color']) ? $options['footer_bg_color'] : '#fff',
									'required' => array($prefix . 'custom_color_footer', '=', '1'),
								),
								array(
									'title'           => esc_html__('Footer text color', 'beyot-framework'),
									'id'             => $prefix . 'footer_text_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['footer_text_color']) ? $options['footer_text_color'] : '#4a4a4a',
									'required' => array($prefix . 'custom_color_footer', '=', '1'),
								),
								array(
									'title'           => esc_html__('Footer widget title color', 'beyot-framework'),
									'id'             => $prefix . 'footer_widget_title_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['footer_widget_title_color']) ? $options['footer_widget_title_color'] : '#111',
									'required' => array($prefix . 'custom_color_footer', '=', '1'),
								),
								array(
									'title'           => esc_html__('Footer border color', 'beyot-framework'),
									'id'             => $prefix . 'footer_border_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['footer_border_color']) ? $options['footer_border_color'] : '#eee',
									'required' => array($prefix . 'custom_color_footer', '=', '1'),
								),
							)
						),

						array(
							'id'     => $prefix . 'custom_color_bottom_bar_section',
							'title'   => esc_html__('Bottom Bar', 'beyot-framework'),
							'type'   => 'group',
							'required' => array($prefix.'bottom_bar_visible', '=', '1'),
							'fields' => array(
								array(
									'title'           => esc_html__('Custom Color Bottom Bar', 'beyot-framework'),
									'id'             => $prefix . 'custom_color_bottom_bar',
									'type'           => 'button_set',
									'options'        => array(
										'1'  => esc_html__('On', 'beyot-framework'),
										'0'  => esc_html__('Off', 'beyot-framework')
									),
									'default'            => 0
								),
								array(
									'title'           => esc_html__('Bottom bar background color', 'beyot-framework'),
									'id'             => $prefix . 'bottom_bar_bg_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['bottom_bar_bg_color']) ? $options['bottom_bar_bg_color'] : '#1b2127',
									'required' => array($prefix . 'custom_color_bottom_bar', '=', '1'),
								),
								array(
									'title'           => esc_html__('Bottom bar text color', 'beyot-framework'),
									'id'             => $prefix . 'bottom_bar_text_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['bottom_bar_text_color']) ? $options['bottom_bar_text_color'] : '#FFF',
									'required' => array($prefix . 'custom_color_bottom_bar', '=', '1'),
								),
								array(
									'title'           => esc_html__('Bottom bar border color', 'beyot-framework'),
									'id'             => $prefix . 'bottom_bar_border_color',
									'type'           => 'color',
									'alpha'   => true,
									'default'            => isset($options['bottom_bar_border_color']) ? $options['bottom_bar_border_color'] : '#eee',
									'required' => array($prefix . 'custom_color_bottom_bar', '=', '1'),
								),
							)
						)
					)
				)
			),
		);

		/**
		 * CUSTOM PAGE SETTINGS
		 */
		$configs['gf_post_type_meta_boxes'] = array(
			'name' => esc_html__('Page Settings', 'beyot-framework'),
			'post_type' => $post_type_meta_box,
			'layout' => 'horizontal',
			'section' => array(
				/**
				 * General
				 */
				array(
					'id' => $prefix . 'page_custom_meta_box_general',
					'title' => esc_html__('General', 'beyot-framework'),
					'icon' => 'dashicons dashicons-editor-table',
					'fields' => array(
						array(
							'title'        => esc_html__('Preset', 'beyot-framework'),
							'id'          => $prefix . 'page_preset',
							'type'        => 'selectize',
							'allow_clear' => true,
							'data' => 'post',
							'data_args' => array(
								'post_type' => 'gf_preset',
								'posts_per_page' => -1,
								'post_status' => 'publish'
							),
							'placeholder' => esc_html__('Select Preset', 'beyot-framework'),
							'multiple'    => false,
							'desc'        => esc_html__('Optionally you can choose to override the setting that is used on the page', 'beyot-framework'),
						),
						array(
							'title'        => esc_html__('Custom Css Class', 'beyot-framework'),
							'id'          => $prefix . 'custom_page_css_class',
							'type'        => 'text',
							'default'         => '',
							'desc'        => esc_html__('Enter custom class for this page', 'beyot-framework'),
						),
					)
				),

				/**
				 * Layout
				 */
				array(
					'id' => $prefix . 'page_custom_meta_box_layout',
					'title' => esc_html__('Page Layout', 'beyot-framework'),
					'icon' => 'dashicons dashicons-editor-table',
					'fields' => array(
						array(
							'title'       => esc_html__('Sidebar Layout', 'beyot-framework'),
							'id'         => $prefix . 'custom_page_sidebar_layout',
							'type'       => 'image_set',
							'options'    => array(
								'none'  => GF_PLUGIN_URL . '/assets/images/theme-options/sidebar-none.png',
								'left'  => GF_PLUGIN_URL . '/assets/images/theme-options/sidebar-left.png',
								'right' => GF_PLUGIN_URL . '/assets/images/theme-options/sidebar-right.png'
							),
							'default'        => '',
							'multiple'   => false,
							'allow_clear'     => true,
						),
						array(
							'title' => esc_html__('Remove Content Padding', 'beyot-framework'),
							'id'   => $prefix . 'remove_content_padding',
							'type' => 'button_set',
							'options'        => array(
								'1'  => esc_html__('On', 'beyot-framework'),
								'0'  => esc_html__('Off', 'beyot-framework')
							),
							'default'  => 0,
						),
					)
				),

				/**
				 * Page title
				 */
				array(
					'id' => $prefix . 'page_custom_meta_box_title',
					'title' => esc_html__('Page title', 'beyot-framework'),
					'icon' => 'dashicons dashicons-editor-table',
					'fields' => array(
						array(
							'title'        => esc_html__('Show/Hide Page Title', 'beyot-framework'),
							'id'          => $prefix . 'custom_page_title_visible',
							'type'        => 'button_set',
							'default'         => '-1',
							'options'      => array(
								'-1'     => esc_html__('Default', 'beyot-framework'),
								'1'     => esc_html__('Show', 'beyot-framework'),
								'0'     => esc_html__('Hide', 'beyot-framework'),
							),
						),
						array(
							'title'        => esc_html__('Show/Hide Breadcrumbs', 'beyot-framework'),
							'id'          => $prefix . 'custom_breadcrumbs_visible',
							'type'        => 'button_set',
							'default'         => '-1',
							'options'      => array(
								'-1'     => esc_html__('Default', 'beyot-framework'),
								'1'     => esc_html__('Show', 'beyot-framework'),
								'0'     => esc_html__('Hide', 'beyot-framework'),
							),
							'required'    => array(
								array($prefix . 'custom_page_title_visible', '!=', '0'),
							),
						),
						array(
							'title'        => esc_html__('Custom Page Title', 'beyot-framework'),
							'id'          => $prefix . 'custom_page_title_group',
							'type'        => 'group',
							'required'    => array(
								array($prefix . 'custom_page_title_visible', '!=', '0'),
							),
							'fields' => array(
								array(
									'title' => esc_html__('Custom Page Title?', 'beyot-framework'),
									'id'   => $prefix . 'is_custom_page_title',
									'type' => 'button_set',
									'options'        => array(
										'1'  => esc_html__('On', 'beyot-framework'),
										'0'  => esc_html__('Off', 'beyot-framework')
									),
									'default'  => 0,
								),
								array(
									'title'        => esc_html__('Page Title', 'beyot-framework'),
									'id'          => $prefix . 'custom_page_title',
									'type'        => 'text',
									'default'         => '',
									'required'    => array(
										array($prefix . 'is_custom_page_title', '=', '1'),
										array($prefix . 'custom_page_title_visible', '!=', '0'),
									),
								),
								array(
									'title'        => esc_html__('Page Sub Title', 'beyot-framework'),
									'id'          => $prefix . 'custom_page_sub_title',
									'type'        => 'text',
									'default'         => '',
									'required'    => array(
										array($prefix . 'is_custom_page_title', '=', '1'),
										array($prefix . 'custom_page_title_visible', '!=', '0'),
									),
								),
							)
						),

						array(
							'title'        => esc_html__('Custom Page Title Background', 'beyot-framework'),
							'id'          => $prefix . 'custom_page_title_bg_group',
							'type'        => 'group',
							'required'    => array(
								array($prefix . 'custom_page_title_visible', '!=', '0'),
							),
							'fields' => array(
								array(
									'title' => esc_html__('Custom Page Title Background?', 'beyot-framework'),
									'id'   => $prefix . 'is_custom_page_title_bg',
									'type' => 'button_set',
									'options'        => array(
										'1'  => esc_html__('On', 'beyot-framework'),
										'0'  => esc_html__('Off', 'beyot-framework')
									),
									'default'  => 0,
								),
								array(
									'id'               => $prefix . 'custom_page_title_bg_image',
									'title'             => esc_html__('Page Title Background Image', 'beyot-framework'),
									'desc'             => esc_html__('Upload custom page title background image', 'beyot-framework'),
									'type'             => 'image',
									'max_file_uploads' => 1,
									'required'    => array(
										array($prefix . 'custom_page_title_visible', '!=', '0'),
										array($prefix . 'is_custom_page_title_bg', '=', '1'),
									),
								),
								array(
									'title'        => esc_html__('Custom Page Title Background Overlay?', 'beyot-framework'),
									'id'          => $prefix . 'is_custom_page_title_bg_overlay',
									'type'        => 'button_set',
									'options'        => array(
										'1'  => esc_html__('On', 'beyot-framework'),
										'0'  => esc_html__('Off', 'beyot-framework')
									),
									'default'         => 0,
									'required'    => array(
										array($prefix . 'custom_page_title_visible', '!=', '0'),
										array($prefix . 'is_custom_page_title_bg', '=', '1'),
									),
								),
							)
						),
					)
				),
				/**
				 * Menu
				 */
				array(
					'id' => $prefix . 'menu_meta_box',
					'title' => esc_html__('Menu', 'beyot-framework'),
					'icon' => 'dashicons dashicons-menu',
					'fields'     => array(
						array(
							'title' => esc_html__('General', 'beyot-framework'),
							'id'   => $prefix . 'menu_meta_box_general',
							'type' => 'group',
							'fields' => array(
								array(
									'title' => esc_html__('Is One Page', 'beyot-framework'),
									'id'   => $prefix . 'is_one_page',
									'type' => 'button_set',
									'options'        => array(
										'1'  => esc_html__('On', 'beyot-framework'),
										'0'  => esc_html__('Off', 'beyot-framework')
									),
									'default'  => 0,
									'desc' => esc_html__('Set page style is One Page', 'beyot-framework'),
								)
							)
						)
					)
				),
			),
		);
		return $configs;
	}
	add_filter( 'gsf_meta_box_config', 'gf_register_meta_boxes');
}
//upload image
if( is_admin() ) {
	function gf_admin_load_styles_and_scripts() {
		$mode = get_user_option( 'media_library_mode', get_current_user_id() ) ? get_user_option( 'media_library_mode', get_current_user_id() ) : 'grid';
		$modes = array( 'grid', 'list' );
		if ( isset( $_GET['mode'] ) && in_array( $_GET['mode'], $modes ) ) {
			$mode = $_GET['mode'];
			update_user_option( get_current_user_id(), 'media_library_mode', $mode );
		}
		if( ! empty ( $_SERVER['PHP_SELF'] ) && 'upload.php' === basename( $_SERVER['PHP_SELF'] ) && 'grid' !== $mode ) {
			wp_dequeue_script( 'media' );
		}
		wp_enqueue_media();
	}
	add_action( 'admin_enqueue_scripts', 'gf_admin_load_styles_and_scripts' );
}