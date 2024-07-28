<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if (!function_exists('g5plus_process_font')) {
	function g5plus_process_font($fonts) {
		if (isset($fonts['font-weight']) && (($fonts['font-weight'] === '') || ($fonts['font-weight'] === 'regular')) ) {
			$fonts['font-weight'] = '400';
		}

		if (isset($fonts['font-style']) && ($fonts['font-style'] === '') ) {
			$fonts['font-style'] = 'normal';
		}

		if (isset($fonts['font_size']) && ( !strpos($fonts['font_size'],'px') && !strpos($fonts['font_size'],'em') && !strpos($fonts['font_size'],'rem') )) {
			$fonts['font_size'] = $fonts['font_size'] . 'px';
		}

		return $fonts;
	}
}

if (!function_exists('g5plus_get_font_family')) {
	function g5plus_get_font_family($name) {
		if ((strpos($name, ',') === false) || (strpos($name, ' ') === false)) {
			return $name;
		}
		return "'{$name}'";
	}
}

if (!function_exists('g5plus_get_default_fonts')) {
	function g5plus_get_default_fonts($is_frontEnd = true) {
		return  array(
			'body_font' => array(
				'default' => array(
					'font_family' => "'Poppins'",
					'font_weight' => '300',
					'font_size'   => '14'
				),
				'selector' => $is_frontEnd ? array('body') : array('.editor-styles-wrapper.editor-styles-wrapper')
			) ,
			'secondary_font' => array(
				'default' => array(
					'font_family' => "'Poppins'",
					'font_weight' => '300',
					'font_size'   => '14'
				)
			),

			'h1_font' => array(
				'default' =>  array(
					'font_family' => "'Poppins'",
					'font_weight' => '700',
					'font_size'   => '76',
				),
				'selector' => $is_frontEnd ? array('h1') :  array('.editor-styles-wrapper.editor-styles-wrapper h1')
			),
			'h2_font' => array(
				'default' =>  array(
					'font_family' => "'Poppins'",
					'font_weight' => '700',
					'font_size'   => '40',
				),
				'selector' => $is_frontEnd ? array('h2') : array('.editor-styles-wrapper.editor-styles-wrapper h2')
			),
			'h3_font' => array(
				'default' =>  array(
					'font_size'   => '24',
					'font_family' => "'Poppins'",
					'font_weight' => '700',
				),
				'selector' => $is_frontEnd ? array('h3') :array('.editor-styles-wrapper.editor-styles-wrapper h3','.editor-post-title__block.editor-post-title__block .editor-post-title__input')
			),
			'h4_font' => array(
				'default' =>  array(
					'font_size'   => '16',
					'font_family' => "'Poppins'",
					'font_weight' => '700',
				),
				'selector' => $is_frontEnd ? array('h4') : array('.editor-styles-wrapper.editor-styles-wrapper h4')
			),
			'h5_font' => array(
				'default' =>  array(
					'font_size'   => '14',
					'font_family' => "'Poppins'",
					'font_weight' => '700',
				),
				'selector' => $is_frontEnd ? array('h5') : array('.editor-styles-wrapper.editor-styles-wrapper h5')
			),
			'h6_font'  => array(
				'default' =>  array(
					'font_size'   => '12',
					'font_family' => "'Poppins'",
					'font_weight' => '700',
				),
				'selector' => $is_frontEnd ? array('h6') : array('.editor-styles-wrapper.editor-styles-wrapper h6')
			),
		);
	}
}

if (!function_exists('g5plus_get_fonts_css')) {
	function g5plus_get_fonts_css($is_frontEnd = true) {
		$custom_fonts_variable = g5plus_get_default_fonts($is_frontEnd);
		$custom_css = '';
		foreach ($custom_fonts_variable as $optionKey => $v) {
			$fonts = g5plus_get_option($optionKey,$v['default']);
			if ($fonts) {
				$selector = (isset($v['selector']) && is_array($v['selector'])) ? implode(',', $v['selector']) : '';
				$fonts = g5plus_process_font($fonts);
				$fonts_attributes = array();
				if (isset($fonts['font-family'])) {
					$fonts['font-family'] = g5plus_get_font_family($fonts['font-family']);
					$fonts_attributes[] = "font-family: '{$fonts['font-family']}'";
				}

				if (isset($fonts['font-size'])) {
					$fonts_attributes[] = "font-size: {$fonts['font-size']}";
				}

				if (isset($fonts['font-weight'])) {
					$fonts_attributes[] = "font-weight: {$fonts['font-weight']}";
				}

				if (isset($fonts['font-style'])) {
					$fonts_attributes[] = "font-style: {$fonts['font-style']}";
				}

				if (isset($fonts['text-transform'])) {
					$fonts_attributes[] = "text-transform: {$fonts['text-transform']}";
				}

				if (isset($fonts['color'])) {
					$fonts_attributes[] = "color: {$fonts['color']}";
				}

				if (isset($fonts['line-height'])) {
					$fonts_attributes[] = "line-height: {$fonts['line-height']}";
				}


				if ((count($fonts_attributes) > 0)  && ($selector != '')) {
					$fonts_css = implode(';', $fonts_attributes);

					$custom_css .= <<<CSS
                {$selector} {
                    {$fonts_css}
                }
CSS;
				}
			}
		}

		// Remove comments
		$custom_css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $custom_css);
		// Remove space after colons
		$custom_css = str_replace(': ', ':', $custom_css);
		// Remove whitespace
		$custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $custom_css);
		return $custom_css;
	}
}

if (!function_exists('g5plus_get_fonts_url')) {
	function g5plus_get_fonts_url() {
		$custom_fonts_variable = g5plus_get_default_fonts();
		$google_fonts = array();
		foreach ($custom_fonts_variable as $k => $v) {
			$custom_fonts = g5plus_get_option($k,$v['default']);
			if ($custom_fonts && isset($custom_fonts['font_family']) && !in_array($custom_fonts['font_family'],$google_fonts)) {
				$google_fonts[] = trim($custom_fonts['font_family'], "\' ");
			}
		}
		$fonts_url = '';
		$fonts = '';
		foreach($google_fonts as $google_font)
		{
			$fonts .= str_replace('','+',$google_font) . ':100,300,400,600,700,900,100italic,300italic,400italic,600italic,700italic,900italic|';
		}
		if ($fonts != '')
		{
			$protocol = is_ssl() ? 'https' : 'http';
			$fonts_url =  $protocol . '://fonts.googleapis.com/css?family=' . substr_replace( $fonts, "", - 1 );
		}
		return $fonts_url;
	}
}

if (!function_exists('g5plus_enqueue_fonts')) {
	function g5plus_enqueue_fonts() {
		if (!class_exists('GF_Loader')) {
			$fonts_url = g5plus_get_fonts_url();
			$fonts_css = g5plus_get_fonts_css();
			wp_enqueue_style('google-fonts',$fonts_url);
			wp_add_inline_style('google-fonts',$fonts_css);
		}
	}
	add_action('wp_enqueue_scripts', 'g5plus_enqueue_fonts',12);
}

if (!function_exists('g5plus_editor_stylesheets')) {
	function g5plus_editor_stylesheets($stylesheets) {
		$screen = get_current_screen();
		$post_id = '';
		if ( is_admin() && ($screen->id == 'post') ) {
			global $post;
			$post_id = $post->ID;
		}
		$stylesheets[] = admin_url('admin-ajax.php') . '?action=gsf_custom_css_editor&post_id=' . $post_id;
		$stylesheets[] = G5PLUS_THEME_URL . 'assets/plugins/fonts-awesome/css/font-awesome.min.css';
		$stylesheets[] = g5plus_get_fonts_url();
		return $stylesheets;
	}
	add_filter( 'editor_stylesheets', 'g5plus_editor_stylesheets', 99 );
}

if (!function_exists('g5plus_custom_css_editor_callback')) {
	function g5plus_custom_css_editor_callback() {
		$custom_css = g5plus_custom_css_editor();

		/**
		 * Make sure we set the correct MIME type
		 */
		header( 'Content-Type: text/css' );
		/**
		 * Render RTL CSS
		 */
		echo sprintf('%s',$custom_css);
		die();
	}
	add_action( 'wp_ajax_gsf_custom_css_editor', 'g5plus_custom_css_editor_callback');
	add_action( 'wp_ajax_nopriv_gsf_custom_css_editor', 'g5plus_custom_css_editor_callback');
}

if (!function_exists('g5plus_custom_css_editor')) {
	function g5plus_custom_css_editor() {
		$custom_css =<<<CSS
        body {
              margin: 9px 10px;
            }
CSS;
		$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : '';

		if (!empty($post_id)) {

			$page_layouts = &g5plus_get_page_layout_settings();


			$sidebar_layout = $page_layouts['sidebar_layout'];
			$sidebar_width = $page_layouts['sidebar_width'];
			$sidebar = $page_layouts['sidebar'];

			$preset_id = g5plus_get_option('blog_single_preset','');
			if (!empty($preset_id)) {
				$prefix = 'g5plus_framework_';
				$sidebar_layout =  g5plus_get_post_meta("{$prefix}sidebar_layout",$preset_id);
				$sidebar_width =  g5plus_get_post_meta("{$prefix}sidebar_width",$preset_id);
				$sidebar =  g5plus_get_post_meta("{$prefix}sidebar",$preset_id);
			}


			$content_width = 1170;
			$sidebar_text = esc_html__('Sidebar', 'g5-beyot');
			if ($sidebar_width === 'large') {
				$sidebar_width = ($content_width * 66.66666667) / 100;
			} else {
				$sidebar_width = ($content_width * 75) / 100;
			}

			$custom_css .= <<<CSS
            
            
            .mceContentBody.mceContentBody[data-site_layout="none"] {
                max-width: 1170px;
                
              }
            .mceContentBody.mceContentBody[data-site_layout="none"]:after {
                  content: '';
             }
CSS;
			if ($sidebar_layout !== 'none' && is_active_sidebar($sidebar)) {
				$content_width = $sidebar_width;

				$custom_css .= <<<CSS
				.mceContentBody::after {
				    content: '{$sidebar_text}';
				}
CSS;
			}


			$custom_css .= <<<CSS
            

			.mceContentBody[data-site_layout="left"],
			.mceContentBody[data-site_layout="right"]{
			    max-width: {$sidebar_width}px;
			}
			
			.mceContentBody[data-site_layout="left"]::after,
			 .mceContentBody[data-site_layout="right"]::after{
				    content: '{$sidebar_text}';
				}

			.mceContentBody {
				max-width: {$content_width}px;
			}
			
CSS;
		}

		$custom_css = apply_filters('g5plus_custom_css_editor',$custom_css);

		// Remove comments
		$custom_css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $custom_css);
		// Remove space after colons
		$custom_css = str_replace(': ', ':', $custom_css);
		// Remove whitespace
		$custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $custom_css);
		return $custom_css;
	}
}


if (!function_exists('g5plus_enqueue_block_editor_assets')) {
	function g5plus_enqueue_block_editor_assets() {
		wp_enqueue_style('fontawesome', G5PLUS_THEME_URL . 'assets/plugins/fonts-awesome/css/font-awesome.min.css', array(),'4.5.0');

		wp_enqueue_style('block-editor', G5PLUS_THEME_URL . 'assets/css/editor/blocks.min.css');

		$screen = get_current_screen();
		$post_id = '';
		if ( is_admin() && ($screen->id == 'post') ) {
			global $post;
			$post_id = $post->ID;
		}

		wp_enqueue_style('gsf_custom_css_block_editor', admin_url('admin-ajax.php') . '?action=gsf_custom_css_block_editor&post_id=' . $post_id);

		$fonts_url = g5plus_get_fonts_url();
		$fonts_css = g5plus_get_fonts_css(false);
		wp_enqueue_style('google-fonts',$fonts_url);
		wp_add_inline_style('google-fonts',$fonts_css);

	}
	add_action('enqueue_block_editor_assets','g5plus_enqueue_block_editor_assets');
}

if (!function_exists('g5plus_custom_css_block_editor_callback')) {
	function g5plus_custom_css_block_editor_callback() {
		$custom_css = g5plus_custom_css_block_editor();

		/**
		 * Make sure we set the correct MIME type
		 */
		header( 'Content-Type: text/css' );
		/**
		 * Render RTL CSS
		 */
		echo sprintf('%s',$custom_css);
		die();
	}
	add_action( 'wp_ajax_gsf_custom_css_block_editor', 'g5plus_custom_css_block_editor_callback');
	add_action( 'wp_ajax_nopriv_gsf_custom_css_block_editor', 'g5plus_custom_css_block_editor_callback');
}

if (!function_exists('g5plus_custom_css_block_editor')) {
	function g5plus_custom_css_block_editor() {

		$page_layouts = &g5plus_get_page_layout_settings();


		$sidebar_layout = $page_layouts['sidebar_layout'];
		$sidebar_width = $page_layouts['sidebar_width'];
		$sidebar = $page_layouts['sidebar'];

		$preset_id = g5plus_get_option('blog_single_preset','');
		if (!empty($preset_id)) {
			$prefix = 'g5plus_framework_';
			$sidebar_layout =  g5plus_get_post_meta("{$prefix}sidebar_layout",$preset_id);
			$sidebar_width =  g5plus_get_post_meta("{$prefix}sidebar_width",$preset_id);
			$sidebar =  g5plus_get_post_meta("{$prefix}sidebar",$preset_id);
		}


		$content_width = 1140;
		if ($sidebar_width === 'large') {
			$sidebar_width = 730;
		} else {
			$sidebar_width = 825;
		}

		$custom_css = '';
		if ($sidebar_layout !== 'none' && is_active_sidebar($sidebar)) {
			$content_width = $sidebar_width;
		}
		$custom_css .= <<<CSS
            
            .edit-post-layout__content[data-site_layout="left"] .wp-block,
			.edit-post-layout__content[data-site_layout="right"] .wp-block,
			.edit-post-layout__content[data-site_layout="left"] .wp-block[data-align="wide"],
			.edit-post-layout__content[data-site_layout="right"] .wp-block[data-align="wide"],
			.edit-post-layout__content[data-site_layout="left"] .wp-block[data-align="full"],
			.edit-post-layout__content[data-site_layout="right"] .wp-block[data-align="full"]{
			    max-width: {$sidebar_width}px;
			}
			
			.wp-block[data-align="full"] {
			    margin-left: auto;
			    margin-right: auto;
			}
			
            
            .wp-block,
            .wp-block[data-align="wide"],
             .wp-block[data-align="full"]{
                max-width: {$content_width}px;
            }
			
CSS;
		// Remove comments
		$custom_css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $custom_css);
		// Remove space after colons
		$custom_css = str_replace(': ', ':', $custom_css);
		// Remove whitespace
		$custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $custom_css);

		return $custom_css;
	}
}