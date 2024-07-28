<?php
/**
 * COMMON FUNCTION FOR PLUGIN FRAMEWORK
 */

/**
 * GET Plugin template elementor
 * *******************************************************
 */
function gf_get_template_element($template_name, $args = array())
{
	if ( ! empty( $args ) && is_array( $args ) ) {
		extract( $args );
	}

	$located = gf_locate_template_element($template_name, $args);
	if ($located !== '') {
		do_action( 'gf_before_template_element_part', $template_name, $located, $args );
		include( $located );
		do_action( 'gf_after_template_element_part', $template_name, $located, $args );
	}
}

/**
 * GET Locate Template Element
 * *******************************************************
 */
function gf_locate_template_element($template_name, $args = array()) {
	$located = '';

	// Theme or child theme template
	$template = trailingslashit(get_stylesheet_directory()) . gf_template_path() . $template_name;
	if (file_exists($template)) {
		$located = $template;
	} else {
		$template = trailingslashit(get_template_directory()) . gf_template_path() . $template_name;
		if (file_exists($template)) {
			$located = $template;
		}
	}

	// Plugin template
	if (! $located) {
		$located = GF_PLUGIN_DIR . 'elements/' . $template_name;
	}

	$located = apply_filters( 'gf_locate_template_element', $located, $template_name, $args);

	if (!file_exists($located)) {
		return '';
	}

	// Return what we found.
	return $located;
}

/**
 * GET template path
 * *******************************************************
 */
function gf_template_path() {
	return apply_filters('gf_template_path', 'beyot-framework');
}


/**
 * GET Plugin template
 * *******************************************************
 */
function gf_get_template($slug, $args = array())
{
	if ($args && is_array($args)) {
		extract($args);
	}
	$located = GF_PLUGIN_DIR . $slug . '.php';
	if (!file_exists($located)) {
		_doing_it_wrong(__FUNCTION__, sprintf('<code>%s</code> does not exist.', $slug), '1.0');
		return;
	}
	include($located);
}

/**
 * GET Meta Box Value
 * *******************************************************
 */
if (!function_exists('gf_get_post_meta')) {
	function gf_get_post_meta($key, $post_id = null,$is_single=true)
	{
		return get_post_meta($post_id, GF_METABOX_PREFIX. $key, $is_single);
	}
}

/**
 * GET Meta Box Image Value
 * *******************************************************
 */
if (!function_exists('gf_get_post_meta_image')) {
	function gf_get_post_meta_image($key, $post_id = null)
	{
		$metabox_id = gf_get_post_meta($key, $post_id, true);
		$image_url = '';
		if ($metabox_id !== array() && isset($metabox_id['url'])) {
			$image_url = $metabox_id['url'];
		}
		return $image_url;
	}
}

/**
 * GET theme option value
 * *******************************************************
 */
if (!function_exists('gf_get_option')) {
	function gf_get_option($key, $default = '')
	{
		$value = isset($GLOBALS[GF_OPTIONS_NAME][$key]) ? $GLOBALS[GF_OPTIONS_NAME][$key] : $default;
		if (in_array($key, array('set_footer_custom','set_footer_above_custom'))
		&& function_exists( 'icl_object_id' )
		&& (!empty($value))) {
			$value = icl_object_id( $value, 'gf_footer', true );
		}
		return $value;
	}
}

/**
 * CONVERT hexa color to rgba color
 * *******************************************************
 */
if (!function_exists('gf_hex2rgba')) {
	function gf_hex2rgba($hex, $opacity) {
		if ($opacity > 1) {
			$opacity = $opacity / 100;
		}
		if (strtolower($hex) == 'transparent') {
			return 'transparent';
		}
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} elseif(strlen($hex) == 6) {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		else {
			$r = 0;
			$g = 0;
			$b = 0;
			$opacity = 0;
		}
		return sprintf('rgba(%s,%s,%s,%s)', $r, $g, $b, $opacity);
	}
}

/**
 * Load Preset Into Theme Options
 * *******************************************************
 */
if (!function_exists('gf_load_preset_into_theme_options')) {
	function &gf_load_preset_into_theme_options(&$options, $current_preset) {
		$meta_fields = &gf_get_meta_fields();
		foreach ($options as $key => $value) {
			if (isset($meta_fields[$key])) {
				$condition = true;
				foreach ($meta_fields[$key] as $meta_key =>  $meta_value) {
					$condition_value = gf_get_post_meta($meta_key, $current_preset);
					if ($condition_value != $meta_value) {
						$condition = false;
						break;
					}
				}
				if ($condition) {
					$meta_value = gf_get_post_meta($key, $current_preset);
					$options[$key] = $meta_value;
				}
			} else {
				$meta_value = gf_get_post_meta($key, $current_preset);
				if ($meta_value !== '') {
					$options[$key] = $meta_value;
				}
			}
		}
		return $options;
	}
}

/**
 * Get Current Preset ID
 * *******************************************************
 */
if (!function_exists('gf_get_current_preset')) {
	function gf_get_current_preset() {
		global $post;

		$post_type = get_post_type($post);
		$preset_id = 0;
		$list_post_type = apply_filters('gf_post_type_preset', array());
		foreach ($list_post_type as $post_type_name => $post_type_value) {
			if (is_post_type_archive( $post_type_name )
			    || (isset( $post_type_value['category'] ) && is_tax($post_type_value['category']))
			    || (isset( $post_type_value['tag'] ) && is_tax($post_type_value['tag']))) {
				$page_preset = gf_get_option($post_type_name . '_preset');
				if ($page_preset) {
					$preset_id = $page_preset;
				}
			}
			/**
			 * Single Post Type
			 */
			elseif (is_singular($post_type_name)) {
				$page_preset = gf_get_option($post_type_name . '_single_preset');
				if ($page_preset) {
					$preset_id = $page_preset;
				}
			}
			if ($preset_id) {
				break;
			}
		}
		if ($preset_id) {}
		/**
		 * Blog
		 */
		elseif (is_home() || is_category() || is_tag() || is_search() || (is_archive() && $post_type == 'post')) {
			$page_preset = gf_get_option('blog_preset');
			if ($page_preset) {
				$preset_id = $page_preset;
			}
		}
		/**
		 * Blog Single
		 */
		elseif (is_singular('post')) {
			$page_preset = gf_get_option('blog_single_preset');
			if ($page_preset) {
				$preset_id = $page_preset;
			}
		}
		/**
		 * 404 Page
		 */
		elseif (is_404()) {
			$page_preset = gf_get_option('page_404_preset');
			if ($page_preset) {
				$preset_id = $page_preset;
			}
		}


		/**
		 * Single Page
		 */
		if (is_singular()) {
			/**
			 * Get Preset
			 */
			$page_preset = gf_get_post_meta('page_preset', get_the_ID());
			if ($page_preset) {
				$preset_id = $page_preset;
			}

			if (is_singular('gf_preset')) {
				$preset_id = get_the_ID();
			}
		}
		return $preset_id;
	}
}

/**
 * Get Preset Dir
 * *******************************************************
 */
if (!function_exists('gf_get_preset_dir')) {
	function gf_get_preset_dir() {
		return trailingslashit(get_template_directory()) . 'assets/preset/';
	}
}

/**
 * Get Preset Url
 * *******************************************************
 */
if (!function_exists('gf_get_preset_url')) {
	function gf_get_preset_url() {
		return trailingslashit(get_template_directory_uri()) . 'assets/preset/';
	}
}

/**
 * Enqueue Preset Style
 * @preset_type: style, rtl, tta
 * *******************************************************
 */
/*if (!function_exists('gf_enqueue_preset_style')) {
	function gf_enqueue_preset_style($preset_id, $preset_type) {
		$filename = $preset_id . '.' . $preset_type . '.min.css';
		if (!file_exists(gf_get_preset_dir() . $filename)) {
			gf_generate_less($preset_id);
			if (!file_exists(gf_get_preset_dir() . $filename)) {
				return false;
			}
		}
		wp_enqueue_style('g5plus_framework_' . $preset_type, gf_get_preset_url() . $filename);
		return true;
	}
}*/

/**
 * Get Fonts Awesome Array
 * *******************************************************
 */
if (!function_exists('gf_get_font_awesome')) {
	function &gf_get_font_awesome() {
		if (function_exists('g5plus_get_font_awesome')) {
			return g5plus_get_font_awesome();
		}
		$fonts = array();
		return $fonts;
	}
}

/**
 * Get Theme Font Icon
 * *******************************************************
 */
if (!function_exists('gf_get_theme_font')) {
	function &gf_get_theme_font() {
		if (function_exists('g5plus_get_theme_font')) {
			return g5plus_get_theme_font();
		}
		$fonts = array();
		return $fonts;
	}
}

/**
 * Get Post Thumbnail
 * *******************************************************
 */
if (!function_exists('gf_get_post_thumbnail')) {
	function gf_get_post_thumbnail($size, $noImage = 0, $is_single = false) {
		if (function_exists('g5plus_get_post_thumbnail')) {
			g5plus_get_post_thumbnail($size, $noImage, $is_single);
		}
	}
}

/**
 * Get Color Fields
 * *******************************************************
 */
if (!function_exists('gf_get_meta_fields')) {
	function &gf_get_meta_fields() {
		if (isset($GLOBALS['gf_meta_field_setting'])) {
			return $GLOBALS['gf_meta_field_setting'];
		}
		$GLOBALS['gf_meta_field_setting'] = array(
			'accent_color' => array(
				'custom_color_general' => '1'
			),
			'foreground_accent_color' => array(
				'custom_color_general' => '1'
			),
			'text_color' => array(
				'custom_color_general' => '1'
			),
			'border_color' => array(
				'custom_color_general' => '1'
			),
			'heading_color' => array(
				'custom_color_general' => '1'
			),
			'top_drawer_bg_color' => array(
				'custom_color_top_drawer' => '1'
			),
			'top_drawer_text_color' => array(
				'custom_color_top_drawer' => '1'
			),

			'header_bg_color' => array(
				'custom_color_header' => '1'
			),
			'header_text_color' => array(
				'custom_color_header' => '1'
			),
			'header_border_color' => array(
				'custom_color_header' => '1'
			),

			'top_bar_bg_color' => array(
				'custom_color_top_bar' => '1'
			),
			'top_bar_text_color' => array(
				'custom_color_top_bar' => '1'
			),
			'top_bar_border_color' => array(
				'custom_color_top_bar' => '1'
			),

			'navigation_bg_color' => array(
				'custom_color_navigation' => '1'
			),
			'navigation_text_color' => array(
				'custom_color_navigation' => '1'
			),
			'navigation_text_color_hover' => array(
				'custom_color_navigation' => '1'
			),

			'footer_bg_color' => array(
				'custom_color_footer' => '1'
			),
			'footer_text_color' => array(
				'custom_color_footer' => '1'
			),
			'footer_widget_title_color' => array(
				'custom_color_footer' => '1'
			),
			'footer_border_color' => array(
				'custom_color_footer' => '1'
			),

			'bottom_bar_bg_color' => array(
				'custom_color_bottom_bar' => '1'
			),
			'bottom_bar_text_color' => array(
				'custom_color_bottom_bar' => '1'
			),
			'bottom_bar_border_color' => array(
				'custom_color_bottom_bar' => '1'
			),
			'page_title_bg_image' => array(
				'page_title_enable' =>  '1',
				'custom_page_title_bg_image_enable' => '1'
			),
			'logo' => array(
				'custom_logo_enable' => '1'
			),
			'logo_retina' => array(
				'custom_logo_enable' => '1'
			),
			'sticky_logo' => array(
				'custom_logo_enable' => '1'
			),
			'sticky_logo_retina' => array(
				'custom_logo_enable' => '1'
			),
			'mobile_logo' => array(
				'custom_logo_mobile_enable' => '1'
			),
			'mobile_logo_retina' => array(
				'custom_logo_mobile_enable' => '1'
			),
			'footer_bg_image' => array(
				'custom_footer_bg_image_enable' => '1'
			)
		);
		return $GLOBALS['gf_meta_field_setting'];
	}
}

//////////////////////////////////////////////////////////////////
// Get Page Layout Settings
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_get_page_layout_settings')) {
	function &gf_get_page_layout_settings(){
		$key_page_layout_settings = 'g5plus_page_layout_settings';
		if (isset($GLOBALS[$key_page_layout_settings]) && is_array($GLOBALS[$key_page_layout_settings])) {
			return $GLOBALS[$key_page_layout_settings];
		}
		$GLOBALS[$key_page_layout_settings] = array(
			'layout'                 => gf_get_option( 'layout','container' ),
			'sidebar_layout'         => gf_get_option( 'sidebar_layout','right' ),
			'sidebar'                => gf_get_option( 'sidebar','main-sidebar' ),
			'sidebar_width'          => gf_get_option( 'sidebar_width','small' ),
			'sidebar_mobile_enable'  => gf_get_option( 'sidebar_mobile_enable',1 ),
			'sidebar_mobile_canvas'  => gf_get_option( 'sidebar_mobile_canvas',1 ),
			'padding'                => gf_get_option( 'content_padding',array('top' => '70', 'bottom' => '70') ),
			'padding_mobile'         => gf_get_option( 'content_padding_mobile',array('top' => '30', 'bottom' => '30') ),
			'remove_content_padding' => 0,
			'has_sidebar' => 0
		);
		return $GLOBALS[$key_page_layout_settings];
	}
}

//////////////////////////////////////////////////////////////////
// Get Post Layout Settings
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_get_post_layout_settings')){
	function &gf_get_post_layout_settings(){
		$key_post_layout_settings = 'g5plus_post_layout_settings';
		if (isset($GLOBALS[$key_post_layout_settings]) && is_array($GLOBALS[$key_post_layout_settings])) {
			return $GLOBALS[$key_post_layout_settings];
		}

		$GLOBALS[$key_post_layout_settings] = array(
			'layout'      => gf_get_option('post_layout','large-image'),
			'columns' => gf_get_option('post_column',3),
			'paging'      => gf_get_option('post_paging','navigation'),
			'slider'      => false
		);

		return $GLOBALS[$key_post_layout_settings];
	}
}

/** Get custom User*/
if(!function_exists('gf_get_customer_meta_fields')){
	function gf_get_customer_meta_fields() {
		$usermetakey='real_estate_';
		if (defined('ERE_METABOX_PREFIX')) {
			$usermetakey=ERE_METABOX_PREFIX;
		}
		$show_fields = apply_filters('gf_get_customer_meta_fields',
			array(
				'social-profiles' => array(
					'title' => esc_html__('Social Profiles','beyot-framework'),
					'fields' => array(
						$usermetakey.'author_twitter_url' => array(
							'label' => esc_html__('Twitter','beyot-framework'),
							'description' => esc_html__('Your Twitter','beyot-framework'),
							'type' => 'text',
							'icon' => 'fa fa-twitter'
						),
						$usermetakey.'author_facebook_url' => array(
							'label' => esc_html__('Facebook','beyot-framework'),
							'description' => esc_html__('Your facebook page/profile url','beyot-framework'),
							'type' => 'text',
							'icon' => 'fa fa-facebook'
						),
						$usermetakey.'author_linkedin_url' => array(
							'label' => esc_html__('LinkedIn','beyot-framework'),
							'description' => esc_html__('Your LinkedIn page/profile url','beyot-framework'),
							'type' => 'text',
							'icon' => 'fa fa-linkedin'
						),
						$usermetakey.'author_pinterest_url' => array(
							'label' => esc_html__('Pinterest','beyot-framework'),
							'description' => esc_html__('Your Pinterest','beyot-framework'),
							'type' => 'text',
							'icon' => 'fa fa-pinterest'
						),
						$usermetakey.'author_instagram_url' => array(
							'label' => esc_html__('Instagram','beyot-framework'),
							'description' => esc_html__('Your Instagram','beyot-framework'),
							'type' => 'text',
							'icon' => 'fa fa-instagram'
						),
						$usermetakey.'author_youtube_url' => array(
							'label' => esc_html__('YouTube','beyot-framework'),
							'description' => esc_html__('Your YouTube URL','beyot-framework'),
							'type' => 'text',
							'icon' => 'fa fa-youtube'
						),
						$usermetakey.'author_vimeo_url' => array(
							'label' => esc_html__('Vimeo','beyot-framework'),
							'description' => esc_html__('Your Vimeo','beyot-framework'),
							'type' => 'text',
							'icon' => 'fa fa-vimeo-square'
						),
						$usermetakey.'author_googleplus_url' => array(
							'label' => esc_html__('Google+','beyot-framework'),
							'description' => esc_html__('Your Google+ page/profile URL','beyot-framework'),
							'type' => 'text',
							'icon' => 'fa fa-google-plus'
						),
					)
				),
			)
		);
		return $show_fields;
	}
}
if(!function_exists('gf_add_customer_meta_fields')){
	function gf_add_customer_meta_fields( $user ) {

		$show_fields = gf_get_customer_meta_fields();

		foreach ( $show_fields as $fieldset ) :
			?>
			<h3><?php echo wp_kses_post($fieldset['title']); ?></h3>
			<table class="form-table">
				<?php
				foreach ( $fieldset['fields'] as $key => $field ) :
					?>
					<tr>
						<th><label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['label'] ); ?></label></th>
						<td>
							<?php if ( ! empty( $field['type'] ) && 'select' == $field['type'] ) : ?>
								<select name="<?php echo esc_attr( $key ); ?>" id="<?php echo esc_attr( $key ); ?>" class="<?php echo ( ! empty( $field['class'] ) ? $field['class'] : '' ); ?>" style="width: 25em;">
									<?php
									$selected = esc_attr( get_user_meta( $user->ID, $key, true ) );
									foreach ( $field['options'] as $option_key => $option_value ) : ?>
										<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $selected, $option_key, true ); ?>><?php echo esc_attr( $option_value ); ?></option>
									<?php endforeach; ?>
								</select>
							<?php else : ?>
								<input type="text" name="<?php echo esc_attr( $key ); ?>" id="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( get_user_meta( $user->ID, $key, true ) ); ?>" class="<?php echo ( ! empty( $field['class'] ) ? $field['class'] : 'regular-text' ); ?>" />
							<?php endif; ?>
							<br/>
							<span class="description"><?php echo wp_kses_post( $field['description'] ); ?></span>
						</td>
					</tr>
					<?php
				endforeach;
				?>
			</table>
			<?php
		endforeach;
	}
}
if(!function_exists('gf_save_customer_meta_fields')){
	function gf_save_customer_meta_fields( $user_id ) {
		$save_fields = gf_get_customer_meta_fields();

		foreach ( $save_fields as $fieldset ) {
			foreach ( $fieldset['fields'] as $key => $field ) {
				if ( isset( $_POST[ $key ] )  ) {
					update_user_meta( $user_id, $key, sanitize_text_field( $_POST[ $key ] ) );
				}
			}
		}
	}
}

/*================================================
COMMENTS FORM
================================================== */
if (!function_exists('g5plus_comment_form')) {
	function g5plus_comment_form() {
		$commenter = gf_wp_get_current_commenter();
		$req = get_option('require_name_email');
		$aria_req = ($req ? " aria-required='true'" : '');
		$html5 = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';;
		$fields = array(
			'author' => '<div class="form-group input-name">' .
				'<label>'. esc_html__('Your Name','beyot-framework').'</label>'.
				'<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" placeholder="'.esc_html__('Put your full Name','beyot-framework').'" ' . $aria_req . '>' .
				'</div>',
			'email' => '<div class="form-group input-email">' .
				'<label>'. esc_html__('Email','beyot-framework').'</label>'.
				'<input id="email" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="'.esc_html__('Email Address','beyot-framework').'" ' . $aria_req . '>' .
				'</div>',
			'phone'   => '<div class="form-group input-phone">'.
				'<label>'. esc_html__('Phone','beyot-framework').'</label>'.
				'<input id="phone" name="phone" ' . ( $html5 ? 'type="text"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_phone'] ) . '" placeholder="'.esc_html__('Your Phone Number','beyot-framework').'" />'.
				'</div>'
		);
		$fields = apply_filters('g5plus_comment_fields',$fields);
		$comment_form_args = array(
			'comment_field' => '<div class="form-group">' .
				'<label>'. esc_html__('Message','beyot-framework').'</label>'.
				'<textarea rows="6" id="comment" name="comment" placeholder="'.esc_html__('Your text here ...','beyot-framework') .'" '. $aria_req .'></textarea>' .
				'</div>',
			'fields' => $fields,
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'id_submit' => 'btnComment',
			'class_submit' => 'button-comment',
			'title_reply' => esc_html__('Leave a Comment', 'beyot-framework'),
			'title_reply_to' => esc_html__('Leave a Comment to %s', 'beyot-framework'),
			'cancel_reply_link' => esc_html__('Cancel reply', 'beyot-framework'),
			'label_submit' => esc_html__('Send Message', 'beyot-framework')
		);

		comment_form($comment_form_args);
	}
}
/*=======================*/
function gf_wp_get_current_commenter(){
	$comment_author = '';
	if ( isset($_COOKIE['comment_author_'.COOKIEHASH]) )
		$comment_author = $_COOKIE['comment_author_'.COOKIEHASH];

	$comment_author_email = '';
	if ( isset($_COOKIE['comment_author_email_'.COOKIEHASH]) )
		$comment_author_email = $_COOKIE['comment_author_email_'.COOKIEHASH];

	$comment_author_phone = '';
	if ( isset($_COOKIE['comment_author_phone'.COOKIEHASH]) )
		$comment_author_phone = $_COOKIE['comment_author_phone'.COOKIEHASH];
	apply_filters( 'wp_get_current_commenter', compact('comment_author', 'comment_author_email', 'comment_author_phone') );
}
add_filter('gf_post_type_preset', 'gf_post_type_preset_apply');
function gf_post_type_preset_apply($post_types) {
	$post_types['property'] = array(
		'name' => esc_html__('Property','beyot-framework')
	);
	$post_types['agent'] = array(
		'name' => esc_html__('Agent','beyot-framework')
	);
	$post_types['invoice'] = array(
		'name' => esc_html__('Invoice','beyot-framework')
	);
	return $post_types;
}
add_filter('ere_register_option_property_page_main_single', 'gf_property_single_page_option');
function gf_property_single_page_option()
{
	return array(
			'id' => 'ere_property_single',
			'title' => esc_html__('Single Property', 'beyot-framework'),
			'type' => 'group',
			'fields' => array(
				array(
					'id' => 'custom_property_single_header_type',
					'type' => 'button_set',
					'title' => esc_html__('Header Display Type', 'beyot-framework'),
					'options' => array(
						'image' => esc_html__('Header Image', 'beyot-framework'),
						'map' => esc_html__('Header Map', 'beyot-framework')
					),
					'default' => 'map',
				),
				array(
					'id' => 'hide_contact_information_if_not_login',
					'title' => esc_html__('Hide Contact Information if user not login', 'beyot-framework'),
					'type' => 'button_set',
					'options' => array(
						'1' => esc_html__('Yes', 'beyot-framework'),
						'0' => esc_html__('No', 'beyot-framework'),
					),
					'default' => '0',
				),
				array(
					'id' => 'hide_empty_features',
					'title' => esc_html__('Hide the empty features on the single property page', 'beyot-framework'),
					'type' => 'button_set',
					'options' => array(
						'1' => esc_html__('Yes', 'beyot-framework'),
						'0' => esc_html__('No', 'beyot-framework'),
					),
					'default' => '1',
				),
				array(
					'id' => 'enable_create_date',
					'title' => esc_html__('Show Create Date', 'beyot-framework'),
					'type' => 'button_set',
					'options' => array(
						'1' => esc_html__('Yes', 'beyot-framework'),
						'0' => esc_html__('No', 'beyot-framework'),
					),
					'default' => '1',
				),
				array(
					'id' => 'enable_views_count',
					'title' => esc_html__('Show Views Count', 'beyot-framework'),
					'type' => 'button_set',
					'options' => array(
						'1' => esc_html__('Yes', 'beyot-framework'),
						'0' => esc_html__('No', 'beyot-framework'),
					),
					'default' => '1',
				),
			)
	);
}