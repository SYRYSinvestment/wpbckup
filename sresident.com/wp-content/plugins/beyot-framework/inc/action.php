<?php
/**
 * G5PLUS FRAMEWORK PLUGIN ACTION
 * *******************************************************
 */

/**
 * Allow do_shortcode content: widget_text, widget_title
 * *******************************************************
 */
if (!function_exists('gf_do_shortcode_content')) {
	function gf_do_shortcode_content()
	{
		// Apply filter do_shortcode
		if (apply_filters('gf_do_shortcode_widget_text', true)) {
			add_filter('widget_text', 'do_shortcode');
		}
		if (apply_filters('gf_do_shortcode_widget_content', true)) {
			add_filter('widget_content', 'do_shortcode');
		}
	}

	add_action('after_setup_theme', 'gf_do_shortcode_content');
}

/**
 * Add VC style: js_composer.min.js
 * *******************************************************
 */
if (!function_exists('gf_add_js_composer_front')) {
	function gf_add_js_composer_front() {
		wp_enqueue_style( 'js_composer_front' );
	}
}

/**
 * Add VC style before header: js_composer.min.js
 * *******************************************************
 */
if (!function_exists('gf_add_js_composer_front_enqueue')) {
	function gf_add_js_composer_front_enqueue() {
		$set_footer_custom = gf_get_option('set_footer_custom', 0);
		$set_footer_above_custom = gf_get_option('set_footer_above_custom', 0);

		if ($set_footer_custom || $set_footer_above_custom) {
			add_action( 'wp_enqueue_scripts', 'gf_add_js_composer_front' );
		}
	}
	//add_action('g5plus_header_before', 'gf_add_js_composer_front_enqueue');
}

/**
 * Add VC Frontend CSS
 * *******************************************************
 */
if (!function_exists('gf_addFrontCss')) {
	function gf_addFrontCss(){
		$set_footer_custom = gf_get_option('set_footer_custom', 0);
		if ($set_footer_custom) {
			gf_addPageCustomCss($set_footer_custom);
			gf_addShortcodesCustomCss($set_footer_custom);
		}

		$set_footer_above_custom = gf_get_option('set_footer_above_custom', 0);
		if ($set_footer_above_custom) {
			gf_addPageCustomCss($set_footer_above_custom);
			gf_addShortcodesCustomCss($set_footer_above_custom);
		}
		if ($set_footer_custom || $set_footer_above_custom) {
			wp_enqueue_style( 'js_composer_front' );
		}
	}
	//add_action( 'wp_head', 'gf_addFrontCss', 1000 );
}

/**
 * Add VC Frontend CSS: Page custom css
 * *******************************************************
 */
if (!function_exists('gf_addPageCustomCss')) {
	function gf_addPageCustomCss( $id = null ) {
		if ($id == get_the_ID()) {
			return;
		}
		if ( ! $id ) {
			$id = get_the_ID();
		}
		if ( $id ) {
			$post_custom_css = get_post_meta( $id, '_wpb_post_custom_css', true );
			if ( ! empty( $post_custom_css ) ) {
				$post_custom_css = strip_tags( $post_custom_css );
				echo '<style type="text/css" data-type="vc_custom-css">';
				echo $post_custom_css;
				echo '</style>';
			}
		}
	}
}

/**
 * Add VC Frontend CSS: Shortcode custom css
 * *******************************************************
 */
if (!function_exists('gf_addShortcodesCustomCss')) {
	function gf_addShortcodesCustomCss( $id = null ) {
		if ($id == get_the_ID()) {
			return;
		}
		if ( ! $id ) {
			$id = get_the_ID();
		}

		if ( $id ) {
			$shortcodes_custom_css = get_post_meta( $id, '_wpb_shortcodes_custom_css', true );
			if ( ! empty( $shortcodes_custom_css ) ) {
				$shortcodes_custom_css = strip_tags( $shortcodes_custom_css );
				echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
				echo $shortcodes_custom_css;
				echo '</style>';
			}
		}
	}
}

/**
 * Add to the allowed tags array and hook into WP comments
 * *******************************************************
 */
if (!function_exists('gf_allowed_tags')) {
	function gf_allowed_tags()
	{
		global $allowedposttags;
		$allowedposttags['a']['data-hash'] = true;
		$allowedposttags['a']['data-product_id'] = true;
		$allowedposttags['a']['data-original-title'] = true;
		$allowedposttags['a']['aria-describedby'] = true;
		$allowedposttags['a']['data-quantity'] = true;
		$allowedposttags['a']['data-product_sku'] = true;
		$allowedposttags['a']['data-rel'] = true;
		$allowedposttags['a']['data-product-type'] = true;
		$allowedposttags['a']['data-product-id'] = true;
		$allowedposttags['a']['data-toggle'] = true;

		$allowedposttags['div']['data-plugin-options'] = true;
		$allowedposttags['div']['data-player'] = true;
		$allowedposttags['div']['data-audio'] = true;
		$allowedposttags['div']['data-title'] = true;
		$allowedposttags['div']['data-animsition-in-class'] = true;
		$allowedposttags['div']['data-animsition-out-class'] = true;
		$allowedposttags['div']['data-animsition-overlay'] = true;

		$allowedposttags['textarea']['placeholder'] = true;

		$allowedposttags['iframe']['align'] = true;
		$allowedposttags['iframe']['frameborder'] = true;
		$allowedposttags['iframe']['height'] = true;
		$allowedposttags['iframe']['longdesc'] = true;
		$allowedposttags['iframe']['marginheight'] = true;
		$allowedposttags['iframe']['marginwidth'] = true;
		$allowedposttags['iframe']['name'] = true;
		$allowedposttags['iframe']['sandbox'] = true;
		$allowedposttags['iframe']['scrolling'] = true;
		$allowedposttags['iframe']['seamless'] = true;
		$allowedposttags['iframe']['src'] = true;
		$allowedposttags['iframe']['srcdoc'] = true;
		$allowedposttags['iframe']['width'] = true;
		$allowedposttags['iframe']['defer'] = true;

		$allowedposttags['input']['accept'] = true;
		$allowedposttags['input']['align'] = true;
		$allowedposttags['input']['alt'] = true;
		$allowedposttags['input']['autocomplete'] = true;
		$allowedposttags['input']['autofocus'] = true;
		$allowedposttags['input']['checked'] = true;
		$allowedposttags['input']['class'] = true;
		$allowedposttags['input']['disabled'] = true;
		$allowedposttags['input']['form'] = true;
		$allowedposttags['input']['formaction'] = true;
		$allowedposttags['input']['formenctype'] = true;
		$allowedposttags['input']['formmethod'] = true;
		$allowedposttags['input']['formnovalidate'] = true;
		$allowedposttags['input']['formtarget'] = true;
		$allowedposttags['input']['height'] = true;
		$allowedposttags['input']['list'] = true;
		$allowedposttags['input']['max'] = true;
		$allowedposttags['input']['maxlength'] = true;
		$allowedposttags['input']['min'] = true;
		$allowedposttags['input']['multiple'] = true;
		$allowedposttags['input']['name'] = true;
		$allowedposttags['input']['pattern'] = true;
		$allowedposttags['input']['placeholder'] = true;
		$allowedposttags['input']['readonly'] = true;
		$allowedposttags['input']['required'] = true;
		$allowedposttags['input']['size'] = true;
		$allowedposttags['input']['src'] = true;
		$allowedposttags['input']['step'] = true;
		$allowedposttags['input']['type'] = true;
		$allowedposttags['input']['value'] = true;
		$allowedposttags['input']['width'] = true;
		$allowedposttags['input']['accesskey'] = true;
		$allowedposttags['input']['class'] = true;
		$allowedposttags['input']['contenteditable'] = true;
		$allowedposttags['input']['contextmenu'] = true;
		$allowedposttags['input']['dir'] = true;
		$allowedposttags['input']['draggable'] = true;
		$allowedposttags['input']['dropzone'] = true;
		$allowedposttags['input']['hidden'] = true;
		$allowedposttags['input']['id'] = true;
		$allowedposttags['input']['lang'] = true;
		$allowedposttags['input']['spellcheck'] = true;
		$allowedposttags['input']['style'] = true;
		$allowedposttags['input']['tabindex'] = true;
		$allowedposttags['input']['title'] = true;
		$allowedposttags['input']['translate'] = true;

		$allowedposttags['span']['data-id'] = true;

	}

	add_action('init', 'gf_allowed_tags');
}

/**
 * Process when after options saved or reset
 * *******************************************************
 */
if (!function_exists('gf_theme_options_saved')) {
	function gf_theme_options_saved($options)
	{

		if ((defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
			return;
		}
	//	gf_generate_less();

		/**
		 * Delete gf_preset directory
		 */
		global $wp_filesystem;

		$preset_dir = gf_get_preset_dir();
		if (file_exists($preset_dir)) {
			$wp_filesystem->rmdir($preset_dir, true);
		}

		/**
		 * Create gf_preset directory
		 */
		if (!file_exists($preset_dir)) {
			wp_mkdir_p($preset_dir);
		}

		/*// Generate preset css
        global $wpdb;
        $presets = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type=%s AND post_status = %s", 'gf_preset', 'publish') );
        foreach ($presets as $preset) {
            if (isset($preset->ID) && $preset->ID) {
                gf_generate_less($preset->ID);
            }
        }*/
	}

	add_action('gsf_after_save_options', 'gf_theme_options_saved');
	add_action("gsf_after_save_options/beyot_options", 'gf_theme_options_saved'); // New version
}

/**
 * Expand Admin Menu
 * *******************************************************
 */
if (!function_exists('gf_expand_menu')) {
	function gf_expand_menu()
	{
		$screen = get_current_screen();
		$slug = '';
		$slug = isset($_GET['page']) ? $_GET['page'] : $slug;
		$slug = isset($_GET['post_type']) ? $_GET['post_type'] : $slug;
		if (isset($screen->post_type) && ($screen->post_type == 'gf_footer' || $screen->post_type == 'gf_preset')) {
			$slug = $screen->post_type;
		}

		if ($slug && in_array($slug, array('gf-system-status', 'gf_preset', 'gf_footer', 'gf_install_demo'))): ?>
			<script>
				(function ($) {
					$("li", '#adminmenu').removeClass("wp-has-current-submenu wp-menu-open");
					var $page_g5plus = $(".toplevel_page_gf-system-status");
					var $page_slug = $('a[href="admin.php?page=<?php echo wp_kses_post($slug) ?>"]');
					var $post_type_slug = $('a[href="edit.php?post_type=<?php echo wp_kses_post($slug) ?>"]');

					if ($page_g5plus.length > 0) {
						$page_g5plus.addClass("wp-has-current-submenu wp-menu-open");
					}
					if (typeof $page_slug != 'undefined' && typeof $page_slug.parent() != 'undefined') {
						$page_slug.parent().addClass("current")
					}
					if (typeof $post_type_slug != 'undefined' && typeof $post_type_slug.parent() != 'undefined') {
						$post_type_slug.parent().addClass("current")
					}
				})(jQuery);
			</script>
		<?php endif;
	}

	add_action('adminmenu', 'gf_expand_menu');
}
/**
 * Set Preset Value to OPTION VALUE
 * *******************************************************
 */
if (!function_exists('gf_set_preset_value_to_option')) {
	function gf_set_preset_value_to_option() {
		$preset_id = gf_get_current_preset();
		if ($preset_id) {

			$meta_fields = &gf_get_meta_fields();

			/**
			 * Get List Key MetaBox
			 */
			global $wpdb;
			$rows = $wpdb->get_results( $wpdb->prepare( "SELECT meta_key FROM $wpdb->postmeta WHERE post_id = %d and meta_key like %s", $preset_id, GF_METABOX_PREFIX . '%' ) );
			$meta_box_keys = array();
			foreach ($rows as &$row) {
				$meta_box_keys[] = preg_replace('/^' . GF_METABOX_PREFIX . '/', '', $row->meta_key);
			}

			/**
			 * Set meta value into option
			 */
			$options = &$GLOBALS[GF_OPTIONS_NAME];
			foreach ($meta_box_keys as &$meta_key) {
				if (isset($meta_fields[$meta_key])) {
					$condition = true;
					foreach ($meta_fields[$meta_key] as $key =>  $value) {
						$condition_value = gf_get_post_meta($key, $preset_id);
						if ($condition_value != $value) {
							$condition = false;
							break;
						}
					}
					if ($condition) {
						$meta_value = gf_get_post_meta($meta_key, $preset_id);
						$options[$meta_key] = $meta_value;
					}
				}
				else {
					$meta_value = gf_get_post_meta($meta_key, $preset_id);
					$options[$meta_key] = $meta_value;
				}
			}
		}
		/**
		 * Set Footer Custom
		 */
		if (is_singular('gf_footer')) {
			isset($options) or $options = &$GLOBALS[GF_OPTIONS_NAME];
			$options['set_footer_custom'] = get_the_ID();
		}

		/**
		 * If 404 page
		 */
		if (!$preset_id && is_404()) {
			$options = &$GLOBALS[GF_OPTIONS_NAME];

			$options['layout_style'] = 'wide';
			$options['layout'] = 'full';
			$options['sidebar_layout'] = 'none';
			$options['page_title_enable'] = 0;
			$options['footer_show_hide'] = 0;
			$options['set_footer_above_custom'] = 0;
			$options['bottom_bar_visible'] = 0;

			$page_layouts = &gf_get_page_layout_settings();
			$page_layouts['remove_content_padding'] = 1;
		}
	}
	add_action('wp', 'gf_set_preset_value_to_option', 3);
}

/**
 * Generate css when preset updated
 * *******************************************************
 */
if (!function_exists('gf_generate_css_when_preset_updated')) {
	function gf_generate_css_when_preset_updated($post_id, $post) {
		if ($post->post_type === 'gf_preset') {
			/**
			 * Delete gf_preset style
			 */
			$preset_dir = gf_get_preset_dir();
			if (file_exists($preset_dir . $post_id . '.style.min.css')) {
				unlink ($preset_dir . $post_id . '.style.min.css');
			}
			if (file_exists($preset_dir . $post_id . '.rtl.min.css')) {
				unlink ($preset_dir . $post_id . '.rtl.min.css');
			}
		}
	}
	add_action( 'save_post', 'gf_generate_css_when_preset_updated', 10, 2 );
}

/**
 * Add Mobile Nav Overlay For Drop Fly
 * *******************************************************
 */
if (!function_exists('gf_add_mobile_nav_overlay')) {
	function gf_add_mobile_nav_overlay($params) {
		if (gf_get_option('mobile_header_menu_drop', 'menu-drop-fly') === 'menu-drop-fly') {
			echo '<div class="mobile-nav-overlay"></div>';
		}
	}
	add_action('wp_footer','gf_add_mobile_nav_overlay');
}

/**
 * Set Page Layout Settings
 * *******************************************************
 */
if (!function_exists('gf_set_page_layout_setting')) {
	function gf_set_page_layout_setting(){
		$page_layouts = &gf_get_page_layout_settings();

		// set page layout
		$layout = isset($_GET['layout']) ? $_GET['layout'] : '';
		if (array_key_exists($layout,gf_get_page_layout_option())) {
			$page_layouts['layout'] = $layout;
		}


		if (is_singular()) {
			// custom sidebar layout
			if(is_page())
			{
				$sidebar_layout = gf_get_post_meta('custom_page_sidebar_layout', get_the_ID());
			}
			else
			{
				$sidebar_layout = gf_get_post_meta('custom_single_blog_sidebar_layout', get_the_ID());
			}
			if(!empty($sidebar_layout)) {
				$page_layouts['sidebar_layout'] = $sidebar_layout;
			}
			// custom remove content padding
			$page_layouts['remove_content_padding'] = gf_get_post_meta('remove_content_padding', get_the_ID());

		}

		// set sidebar_layout
		$sidebar_layout = isset($_GET['sidebar-layout']) ? $_GET['sidebar-layout'] : '';
		if(array_key_exists($sidebar_layout, gf_get_sidebar_layout())) {
			$page_layouts['sidebar_layout'] = $sidebar_layout;
		}

		// set sidebar_width
		$sidebar_width = isset($_GET['sidebar-width']) ? $_GET['sidebar-width'] : '';
		if (array_key_exists($sidebar_width,gf_get_sidebar_width())) {
			$page_layouts['sidebar_width'] = $sidebar_width;
		}

		if (is_active_sidebar($page_layouts['sidebar']) && ($page_layouts['sidebar_layout'] != 'none') && ($page_layouts['sidebar_layout'] != '')) {
			$page_layouts['has_sidebar'] = 1;
		}
	}
	add_action('wp', 'gf_set_page_layout_setting', 5);
}

/**
 * Set Post Layout Settings
 * *******************************************************
 */
if (!function_exists('gf_set_post_layout_settings')) {
	function gf_set_post_layout_settings(){
		global $post;
		$post_type = get_post_type($post);
		if ((is_home() || is_category() || is_tag() || is_search() || is_archive()) && ($post_type == 'post')) {
			$post_layouts = &gf_get_post_layout_settings();

			// set post layout
			$post_layout = isset($_GET['post-layout']) ? $_GET['post-layout'] : '';
			if (array_key_exists($post_layout,gf_get_post_layout())) {
				$post_layouts['layout'] = $post_layout;
			}

			// set post column
			$post_column = isset($_GET['column']) ? $_GET['column'] : '';
			if (array_key_exists($post_column,gf_get_post_columns())) {
				$post_layouts['columns'] = $post_column;
			}

			// set paging
			$paging = isset($_GET['paging']) ? $_GET['paging'] : '';
			if (array_key_exists($paging,gf_get_paging_style())) {
				$post_layouts['paging'] = $paging;
			}
		}

	}
	add_action('wp', 'gf_set_post_layout_settings', 10);
}

/**
 * Add Preset Edit Into Admin Bar
 * *******************************************************
 */
if (!function_exists('gf_preset_edit_on_menu_bar')) {
	function gf_preset_edit_on_menu_bar($admin_bar) {
		if (!is_admin_bar_showing() || is_admin()) {
			return;
		}
		$preset_id = gf_get_current_preset();
		if ($preset_id) {
			$admin_bar->add_node( array(
				'id'    => 'preset_edit',
				'title' => esc_html__('Edit Preset Page Option','beyot-framework'),
				'href'  => admin_url( "post.php?post=$preset_id&action=edit" ),
				'meta'  => array(
					'title' => esc_html__( 'Edit Preset Option for this page' , 'beyot-framework' ),
				),
			));
		}
	}
	add_action('admin_bar_menu', 'gf_preset_edit_on_menu_bar', 100);
}


//////////////////////////////////////////////////////////////////
// Set Post Type Custom Page Layout
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_set_custom_page_layout')){
	function gf_set_custom_page_layout(){
		global $post;
		$post_type = get_post_type($post);
		$custom_page_layout = gf_get_custom_post_type_setting();
		$options = &$GLOBALS[GF_OPTIONS_NAME];
		foreach ($custom_page_layout as $key => $value) {
			if ((($key == 'page') && is_page()) ||
			    (($key == 'blog') && (is_home() || is_category() || is_tag() || is_search() || (is_archive() && $post_type == 'post'))) ||
			    (isset($value['is_single']) && $value['is_single'] && isset($value['post_type']) && is_singular($value['post_type'])) ||
			    (isset($value['is_archive']) && $value['is_archive'] && ((isset($value['post_type']) && is_post_type_archive($value['post_type'])) || (isset($value['category']) && is_tax($value['category'])) || (isset($value['tag']) && is_tax($value['tag']))))
			) {
				$custom_enable = gf_get_option('custom_'.$key.'_layout_enable');
				if ($custom_enable) {
					$options['layout'] = gf_get_option($key.'_layout');
					$options['sidebar_layout'] = gf_get_option($key.'_sidebar_layout');
					$options['sidebar'] = gf_get_option($key.'_sidebar');
					$options['sidebar_mobile_enable'] = gf_get_option($key.'_sidebar_mobile_enable');
					$options['sidebar_mobile_canvas'] = gf_get_option($key.'_sidebar_mobile_canvas');
					$options['content_padding'] = gf_get_option($key.'_content_padding');
					$options['content_padding_mobile'] = gf_get_option($key.'_content_padding_mobile');
				}
				break;
			}
		}
	}
	add_action('wp','gf_set_custom_page_layout',1);
}

//////////////////////////////////////////////////////////////////
// Set Post Type Custom Page Title
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_set_post_type_custom_page_title')) {
	function gf_set_post_type_custom_page_title(){
		global $post;
		$post_type = get_post_type($post);
		$custom_page_title = gf_get_custom_post_type_setting();
		$options = &$GLOBALS[GF_OPTIONS_NAME];
		foreach ($custom_page_title as $key => $value) {
			if ( (($key == 'blog') && (is_home() || is_category() || is_tag() || is_search() || (is_archive() && ($post_type == 'post') ))) ||
			     (isset($value['is_single']) && $value['is_single'] && isset($value['post_type']) && is_singular($value['post_type'])) ||
			     (isset($value['is_archive']) && $value['is_archive'] && ((isset($value['post_type']) && is_post_type_archive($value['post_type'])) || (isset($value['category']) && is_tax($value['category'])) || (isset($value['tag']) && is_tax($value['tag']))))
			) {
				$custom_enable = gf_get_option('custom_'.$key.'_title_enable');
				if ($custom_enable) {
					$options['page_title_enable'] = gf_get_option($key.'_title_enable');
					$options['page_title'] = gf_get_option($key.'_title');
					$options['page_title_padding'] = gf_get_option($key.'_title_padding');
					$options['page_title_bg_image'] = gf_get_option($key.'_title_bg_image');
					$options['page_title_parallax'] = gf_get_option($key.'_title_parallax');
					$options['breadcrumb_enable'] = gf_get_option($key.'_breadcrumbs_enable');
				}
				break;
			}
		}
	}
	add_action('wp','gf_set_post_type_custom_page_title',2);
}
if (!function_exists('gf_maintenance_mode')) {
	function gf_maintenance_mode() {
		if (current_user_can( 'edit_themes' ) || is_user_logged_in()) {
			return;
		}

		$maintenance_mode = gf_get_option('maintenance_mode', 0);
		if ($maintenance_mode == 1) {
			wp_die( '<p style="text-align:center">' . esc_html__( 'We are currently in maintenance mode, please check back shortly.', 'beyot-framework' ) . '</p>', get_bloginfo( 'name' ) );
		} elseif ($maintenance_mode == 2) {
			$maintenance_mode_page = gf_get_option('maintenance_mode_page', '');
			if (empty($maintenance_mode_page)) {
				wp_die( '<p style="text-align:center">' . esc_html__( 'We are currently in maintenance mode, please check back shortly.', 'beyot-framework' ) . '</p>', get_bloginfo( 'name' ) );
			} else {
				$maintenance_mode_page_url = get_permalink($maintenance_mode_page);
				$current_page_url = gf_current_page_url();
				if ($maintenance_mode_page_url != $current_page_url) {
					wp_redirect($maintenance_mode_page_url);
				}
			}
		}
	}
	add_action('template_redirect','gf_maintenance_mode');
}

/*================================================
GET CURRENT PAGE URL
================================================== */
if (!function_exists( 'gf_current_page_url' )) {
	function gf_current_page_url() {
		$pageURL = 'http';
		if ( isset( $_SERVER["HTTPS"] ) ) {
			if ( $_SERVER["HTTPS"] == "on" ) {
				$pageURL .= "s";
			}
		}
		$pageURL .= "://";
		if ( $_SERVER["SERVER_PORT"] != "80" ) {
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}

		return $pageURL;
	}
}
