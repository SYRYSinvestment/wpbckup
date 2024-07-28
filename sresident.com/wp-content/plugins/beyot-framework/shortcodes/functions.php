<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/5/2016
 * Time: 8:06 AM
 */
if (!function_exists('gf_vc_map_add_narrow_product_category')){
	function gf_vc_map_add_narrow_product_category(){
		$category = array();
		$categories = get_categories(array('taxonomy' => 'product_cat', 'hide_empty' => false));
		if (is_array($categories)) {
			foreach ($categories as $cat) {
				$category[$cat->name] = $cat->slug;
			}
		}
		return array(
			'type' => 'select2',
			'heading' => esc_html__('Narrow Category', 'beyot-framework'),
			'param_name' => 'category',
			'options' => $category,
			'multiple' => true,
			'description' => esc_html__( 'Enter categories by names to narrow output (Note: only listed categories will be displayed, divide categories with linebreak (Enter)).', 'beyot-framework' ),
			"admin_label" => true,
			'std' => ''
		);
	}
}

//////////////////////////////////////////////////////////////////
// Custom params vc_row
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_custom_param_vc_row')){
	function gf_custom_param_vc_row(){
		$vc_row = WPBMap::getShortCode('vc_row');
		$vc_row_params = $vc_row['params'];
		$index = 100;
		$background_overlay_index = 0;
		foreach($vc_row_params as $key => $param){
			$param['weight'] = $index;
			if ($param['param_name'] == 'parallax_speed_bg') {
				$background_overlay_index = $index - 1;
				$index = $index - 1;
			}
			vc_update_shortcode_param( 'vc_row', $param );
			$index--;
		}
		$params = array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show background overlay', 'beyot-framework'),
				'param_name' => 'overlay_mode',
				'description' => esc_html__('Hide or Show overlay on background images.', 'beyot-framework'),
				'value' => array(
					esc_html__('Hide, please', 'beyot-framework') => '',
					esc_html__('Show Overlay Color', 'beyot-framework') => 'color',
					esc_html__('Show Overlay Image', 'beyot-framework') => 'image',
				),
				'weight' => $background_overlay_index
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Overlay color', 'beyot-framework'),
				'param_name' => 'overlay_color',
				'description' => esc_html__('Select color for background overlay.', 'beyot-framework'),
				'value' => '',
				'dependency' => array('element' => 'overlay_mode', 'value' => array('color')),
				'weight' => ($background_overlay_index)
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Image Overlay:', 'beyot-framework'),
				'param_name' => 'overlay_image',
				'value' => '',
				'description' => esc_html__('Upload image overlay.', 'beyot-framework'),
				'dependency' => array('element' => 'overlay_mode', 'value' => array('image')),
				'weight' => ($background_overlay_index)
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' => esc_html__('Overlay opacity', 'beyot-framework'),
				'param_name' => 'overlay_opacity',
				'value' => '50',
				'min' => '1',
				'max' => '100',
				'suffix' => '%',
				'description' => esc_html__('Select opacity for overlay.', 'beyot-framework'),
				'dependency' => array('element' => 'overlay_mode', 'value' => array('image')),
				'weight' => ($background_overlay_index)
			),
		);
		vc_add_params( 'vc_row', $params );

		$full_width = array(
			esc_html__('Default (no paddings)','beyot-framework') => 'row_content_no_spaces'
		);
		$param_full_width = WPBMap::getParam('vc_row','full_width');
		$param_full_width['value'] = array_merge($param_full_width['value'],$full_width);
		$param_full_width['std'] = '';
		vc_update_shortcode_param( 'vc_row', $param_full_width );

	}
	add_action( 'vc_after_init', 'gf_custom_param_vc_row' );
}

//////////////////////////////////////////////////////////////////
// Custom VC Columns
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_custom_param_vc_column')) {
	function gf_custom_param_vc_column(){
		vc_add_param( 'vc_column', vc_map_add_css_animation() );
		vc_add_param( 'vc_column_inner', vc_map_add_css_animation() );
	}
	add_action( 'vc_after_init', 'gf_custom_param_vc_column' );
}

if (!function_exists('gf_custom_vc_column_animation')) {
	function gf_custom_vc_column_animation($css_classes,$base,$atts){
		if ($base == 'vc_column' || $base == 'vc_column_inner') {
			$css_animation = $atts['css_animation'];
			if (!empty($css_animation)) {
				wp_enqueue_script( 'waypoints' );
				$css_classes .= ' wpb_animate_when_almost_visible wpb_' . $css_animation;
			}
		}
		return $css_classes;
	}
	add_filter(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'gf_custom_vc_column_animation',10,3);
}

//////////////////////////////////////////////////////////////////
// Custom param vc_tta_tabs
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_custom_param_vc_tta_tabs')) {
	function gf_custom_param_vc_tta_tabs() {

		$styles = array(
			esc_html__('Beyot','beyot-framework') => 'g5-beyot-tab-1',
		);
		$param_style = WPBMap::getParam('vc_tta_tabs','style');
		$param_style['value'] = array_merge($param_style['value'],$styles);
		$param_style['std'] = 'g5-beyot-tab-1';
		vc_update_shortcode_param( 'vc_tta_tabs', $param_style );


		$param_shape = WPBMap::getParam('vc_tta_tabs','shape');
		$param_shape['dependency'] = array(
			'element' => 'style',
			'value' => array('classic','modern','flat','outline')
		);
		vc_update_shortcode_param( 'vc_tta_tabs', $param_shape );

		$param_color = WPBMap::getParam('vc_tta_tabs','color');
		$param_color['dependency'] = array(
			'element' => 'style',
			'value' => array('classic','modern','flat','outline')
		);
		vc_update_shortcode_param( 'vc_tta_tabs', $param_color );

		$param_no_fill_content_area = WPBMap::getParam('vc_tta_tabs','no_fill_content_area');
		$param_no_fill_content_area['dependency'] = array(
			'element' => 'style',
			'value' => array('classic','modern','flat','outline')
		);
		vc_update_shortcode_param( 'vc_tta_tabs', $param_no_fill_content_area );
	}

	add_action( 'vc_after_init', 'gf_custom_param_vc_tta_tabs' );
}
//////////////////////////////////////////////////////////////////
// Custom param vc_tta_tour
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_custom_param_vc_tta_tour')) {
	function gf_custom_param_vc_tta_tour()
	{
		$styles = array(
			esc_html__('Beyot Dark', 'beyot-framework') => 'g5-beyot-tour-1',
			esc_html__('Beyot Gray', 'beyot-framework') => 'g5-beyot-tour-2'
		);
		$param_style = WPBMap::getParam('vc_tta_tour', 'style');
		$param_style['value'] = array_merge($param_style['value'], $styles);
		$param_style['std'] = 'g5-beyot-tour-1';
		vc_update_shortcode_param('vc_tta_tour', $param_style);

		$param_shape = WPBMap::getParam('vc_tta_tour','shape');
		$param_shape['dependency'] = array(
			'element' => 'style',
			'value' => array('classic','modern','flat','outline')
		);
		vc_update_shortcode_param( 'vc_tta_tour', $param_shape );

		$param_color = WPBMap::getParam('vc_tta_tour','color');
		$param_color['dependency'] = array(
			'element' => 'style',
			'value' => array('classic','modern','flat','outline')
		);
		vc_update_shortcode_param( 'vc_tta_tour', $param_color );
	}

	add_action( 'vc_after_init', 'gf_custom_param_vc_tta_tour' );
}
//////////////////////////////////////////////////////////////////
// Custom param vc_toggle
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_custom_param_vc_toggle')) {
	function gf_custom_param_vc_toggle()
	{
		$styles = array(
			esc_html__('beyot-framework', 'beyot-framework') => 'beyot-framework'
		);
		$param_style = WPBMap::getParam('vc_toggle', 'style');
		$param_style['value'] = array_merge($param_style['value'], $styles);
		$param_style['std'] = 'beyot-framework';
		vc_update_shortcode_param('vc_toggle', $param_style);

		$param_use_custom_heading = WPBMap::getParam('vc_toggle','use_custom_heading');
		$param_use_custom_heading['dependency'] = array(
			'element' => 'style',
			'value' => array('default','simple','round','round_outline','rounded','rounded_outline','square','square_outline','arrow','text_only')
		);
		vc_update_shortcode_param( 'vc_toggle', $param_use_custom_heading );

		$param_size = WPBMap::getParam('vc_toggle','size');
		$param_size['dependency'] = array(
			'element' => 'style',
			'value' => array('default','simple','round','round_outline','rounded','rounded_outline','square','square_outline','arrow','text_only')
		);
		vc_update_shortcode_param( 'vc_toggle', $param_size );

		$param_color = WPBMap::getParam('vc_toggle','color');
		$param_color['dependency'] = array(
			'element' => 'style',
			'value' => array('default','simple','round','round_outline','rounded','rounded_outline','square','square_outline','arrow','text_only')
		);
		vc_update_shortcode_param( 'vc_toggle', $param_color );
	}

	add_action( 'vc_after_init', 'gf_custom_param_vc_toggle' );
}
//////////////////////////////////////////////////////////////////
// Add theme icon
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_add_theme_icon')) {
	function gf_add_theme_icon($icons){
		$icons['Icomoon Icons'] = &gf_get_theme_font();
		return $icons;
	}
	add_filter('vc_iconpicker-type-fontawesome','gf_add_theme_icon');
}

//////////////////////////////////////////////////////////////////
// Extra Class Param
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_vc_map_add_extra_class')) {
	function gf_vc_map_add_extra_class(){
		return array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'beyot-framework'),
			'param_name' => 'el_class',
			'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'beyot-framework'),
		);
	}
}

//////////////////////////////////////////////////////////////////
// Css Editor Param
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_vc_map_add_css_editor')) {
	function gf_vc_map_add_css_editor(){
		return array(
			'type' => 'css_editor',
			'heading' => esc_html__('CSS box', 'beyot-framework'),
			'param_name' => 'css',
			'group' => esc_html__('Design Options', 'beyot-framework'),
		);
	}
}

//////////////////////////////////////////////////////////////////
// Icon Type Param
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_vc_map_add_icon_type')) {
	function gf_vc_map_add_icon_type($dependency = array()){
		return array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon library', 'beyot-framework'),
			'value' => array(
				esc_html__('Icon', 'beyot-framework') => 'icon',
				esc_html__('Image', 'beyot-framework') => 'image',
			),
			'param_name' => 'icon_type',
			'description' => esc_html__('Select icon library.', 'beyot-framework'),
			'dependency' => $dependency
		);
	}
}

//////////////////////////////////////////////////////////////////
// Icon Font Awesome
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_vc_map_add_icon_font')) {
	function gf_vc_map_add_icon_font($dependency = array()){
		if (count($dependency) == 0) {
			$dependency = array('element' => 'icon_type','value' => 'icon');
		}
		return  array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'beyot-framework'),
			'param_name' => 'icon_font',
			'value' => 'fa fa-adjust', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'iconsPerPage' => 100,
				'type' => 'fontawesome'
				// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
			'dependency' => $dependency,
			'description' => esc_html__('Select icon from library.', 'beyot-framework'),
		);

	}
}

//////////////////////////////////////////////////////////////////
// Icon Images
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_vc_map_add_icon_image')) {
	function gf_vc_map_add_icon_image(){
		return array(
			'type' => 'attach_image',
			'heading' => esc_html__('Upload Image Icon:', 'beyot-framework'),
			'param_name' => 'icon_image',
			'value' => '',
			'description' => esc_html__('Upload the custom image icon.', 'beyot-framework'),
			'dependency' => array('element' => 'icon_type','value' => 'image'),
		);
	}
}
//////////////////////////////////////////////////////////////////
// Narrow Category
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_vc_map_add_narrow_category')){
	function gf_vc_map_add_narrow_category(){
		$category = array();
		$categories = get_categories();
		if (is_array($categories)) {
			foreach ($categories as $cat) {
				$category[$cat->name] = $cat->slug;
			}
		}
		return array(
			'type' => 'select2',
			'heading' => esc_html__('Narrow Category', 'beyot-framework'),
			'param_name' => 'category',
			'options' => $category,
			'multiple' => true,
			'description' => esc_html__( 'Enter categories by names to narrow output (Note: only listed categories will be displayed, divide categories with linebreak (Enter)).', 'beyot-framework' ),
			"admin_label" => true,
			'std' => ''
		);
	}
}
//////////////////////////////////////////////////////////////////
// Custom icon param
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_custom_param_icon')) {
	function gf_custom_param_icon() {
		$icons = array(
			'icon_fontawesome',
			'icon_openiconic',
			'icon_entypo',
			'icon_linecons',
			'icon_monosocial'
		);
		$shortcodes = array(
			'vc_tta_section'
		);
		foreach ($shortcodes as $shortcode) {
			foreach ($icons as $icon) {
				${$icon} = WPBMap::getParam($shortcode,'i_' . $icon);
				${$icon}['settings']['iconsPerPage'] = 50;
				vc_update_shortcode_param( $shortcode, ${$icon} );
			}
		}
	}
	add_action( 'vc_after_init', 'gf_custom_param_icon' );
}


//////////////////////////////////////////////////////////////////
// Get Widget Layout
//////////////////////////////////////////////////////////////////
if (!function_exists('gf_vc_map_add_widget_layout')){
	function gf_vc_map_add_widget_layout(){
		return array(
			'type' => 'dropdown',
			'heading' => esc_html__('Widget Layout','beyot-framework'),
			'param_name' => 'widget_layout',
			'value' => array(
				esc_html__('Default','beyot-framework') => '',
				esc_html__('Classic','beyot-framework')  => 'widget-classic',
				esc_html__('Classic Without Border','beyot-framework') => 'widget-classic-no-border',
				esc_html__('Border Round','beyot-framework') => 'widget-border-round',
				esc_html__('Border Round Background','beyot-framework') => 'widget-border-round-background',
				esc_html__('Border','beyot-framework') => 'widget-border',
				esc_html__('Border Background','beyot-framework') => 'widget-border-background'
			)
		);
	}
}
//////////////////////////////////////////////////////////////////
// Custom vc_icon param
//////////////////////////////////////////////////////////////////

if (!function_exists('gf_custom_param_vc_icon')) {
	function gf_custom_param_vc_icon() {
		$align = array(
			esc_html__( 'Inline', 'beyot-framework' ) => 'inline'
		);
		$param_align = WPBMap::getParam('vc_icon','align');
		$param_align['value'] = array_merge($align,$param_align['value']);
		vc_update_shortcode_param( 'vc_icon', $param_align );

	}
	add_action( 'vc_after_init', 'gf_custom_param_vc_icon' );
}
//////////////////////////////////////////////////////////////////
// Get Excerpt
//////////////////////////////////////////////////////////////////
if(!function_exists('gf_substr')) {
	function  gf_substr($str, $txt_len, $end_txt = '...')
	{
		if (empty($str)) return '';
		if (strlen($str) <= $txt_len) return $str;
		$i = $txt_len;
		while ($str[$i] != ' ') {
			$i--;
			if ($i == -1) break;
		}
		while ($str[$i] == ' ') {
			$i--;
			if ($i == -1) break;
		}

		return substr($str, 0, $i + 1) . $end_txt;
	}
}

//////////////////////////////////////////////////////////////////
// Order By Slug
//////////////////////////////////////////////////////////////////
if(!function_exists('gf_order_by_slug')){
	function gf_order_by_slug($orderby,$query) {
		global $wpdb;
		$post_name_in = implode("','",$query->query['post_name__in']);
		$post_name_in = str_replace( ' ', '' , $post_name_in );
		$orderby = "FIELD( {$wpdb->posts}.post_name, '$post_name_in')";
		return $orderby;
	}
}

if(!function_exists('gf_vc_map_animation')) {
	function gf_vc_map_animation()
	{
		return array(
			vc_map_add_css_animation(),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Animation Duration', 'beyot-framework'),
				'param_name' => 'animation_duration',
				'value' => '',
				'description' => wp_kses_post(__('Duration in seconds. You can use decimal points in the value. Use this field to specify the amount of time the animation plays. <em>The default value depends on the animation, leave blank to use the default.</em>', 'beyot-framework')),
				'dependency' => array('element' => 'css_animation', 'value_not_equal_to' => array('')),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Animation Delay', 'beyot-framework'),
				'param_name' => 'animation_delay',
				'value' => '',
				'description' => esc_html__('Delay in seconds. You can use decimal points in the value. Use this field to delay the animation for a few seconds, this is helpful if you want to chain different effects one after another above the fold.', 'beyot-framework'),
				'dependency' => array('element' => 'css_animation', 'value_not_equal_to' => array('')),
			)
		);
	}
}
if(!function_exists('gf_vc_map_responsive')) {
	function gf_vc_map_responsive()
	{
		return array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Tablet landscape', 'beyot-framework'),
				'param_name' => 'items_md',
				'description' => esc_html__('Browser Width >= 992px and < 1200px', 'beyot-framework'),
				'value' => array(esc_html__('Default', 'beyot-framework') => -1, '1' => 1, '2' => 2, '3' => 3),
				'std' => -1,
				'group' => esc_html__('Responsive', 'beyot-framework')
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Tablet portrait', 'beyot-framework'),
				'param_name' => 'items_sm',
				'description' => esc_html__('Browser Width >= 768px and < 991px', 'beyot-framework'),
				'value' => array(esc_html__('Default', 'beyot-framework') => -1, '1' => 1, '2' => 2, '3' => 3),
				'std' => -1,
				'group' => esc_html__('Responsive', 'beyot-framework')
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Mobile landscape', 'beyot-framework'),
				'param_name' => 'items_xs',
				'description' => esc_html__('Browser Width >= 480px and < 767px', 'beyot-framework'),
				'value' => array(esc_html__('Default', 'beyot-framework') => -1, '1' => 1, '2' => 2, '3' => 3),
				'std' => -1,
				'group' => esc_html__('Responsive', 'beyot-framework')
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Mobile portrait', 'beyot-framework'),
				'param_name' => 'items_mb',
				'description' => esc_html__('Browser Width < 480px', 'beyot-framework'),
				'value' => array(esc_html__('Default', 'beyot-framework') => -1, '1' => 1, '2' => 2, '3' => 3),
				'std' => -1,
				'group' => esc_html__('Responsive', 'beyot-framework')
			)
		);
	}
}
if(!function_exists('gf_vc_map_slider')) {
	function gf_vc_map_slider()
	{
		return array(
			array(
				'type' => 'checkbox',
				'heading' => esc_html__('Display Slider?', 'beyot-framework' ),
				'param_name' => 'is_slider',
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-4 vc_column'
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__('Show pagination control', 'beyot-framework'),
				'param_name' => 'dots',
				'dependency' => array('element' => 'is_slider', 'value' => 'true'),
				'edit_field_class' => 'vc_col-sm-4 vc_column'
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__('Show navigation control', 'beyot-framework'),
				'param_name' => 'nav',
				'dependency' => array('element' => 'is_slider', 'value' => 'true'),
				'std' => 'true',
				'edit_field_class' => 'vc_col-sm-4 vc_column'
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__('Auto play', 'beyot-framework'),
				'param_name' => 'autoplay',
				'dependency' => array('element' => 'is_slider', 'value' => 'true'),
				'std' => 'true',
				'edit_field_class' => 'vc_col-sm-4 vc_column'
			),
		);
	}
}