<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

function gf_shortcode_assets() {
	$cache_key = 'gf_shortcode_assets';
	$shortcode_list =  wp_cache_get($cache_key);
	if ($shortcode_list) {
		return $shortcode_list;
	}
	$min_css_suffix = gf_get_option('enable_minifile_css', 0) == 1 ? '.min' : '';
	$min_js_suffix = gf_get_option('enable_minifile_js', 0) == 1 ? '.min' : '';
	$shortcode_list = apply_filters( 'gf_shortcode_assets', array(
		'nearby_places'           => array(
			'css' => plugins_url(GF_PLUGIN_NAME . '/shortcodes/nearby-places/assets/scss/nearby-places' . $min_css_suffix . '.css'),
			'js'       => plugins_url(GF_PLUGIN_NAME . '/shortcodes/nearby-places/assets/js/nearby-places' . $min_js_suffix . '.js'),
			'js_deps'  => array('google-map'),
			'css_deps' => array()
		),
		'agent_info'           => array(
			'css' => plugins_url(GF_PLUGIN_NAME . '/shortcodes/agent-info/assets/scss/agent-info' . $min_css_suffix . '.css'),
			'css_deps' => array()
		),
		'clients'           => array(
			'css' => plugins_url(GF_PLUGIN_NAME . '/shortcodes/clients/assets/scss/clients' . $min_css_suffix . '.css'),
			'css_deps' => array()
		),
		'countdown'           => array(
			'css' => plugins_url(GF_PLUGIN_NAME . '/shortcodes/countdown/assets/scss/countdown' . $min_css_suffix . '.css'),
			'css_deps' => array()
		),
		'counter'           => array(
			'css' => plugins_url(GF_PLUGIN_NAME . '/shortcodes/counter/assets/scss/counter' . $min_css_suffix . '.css'),
			'js'       => plugins_url(GF_PLUGIN_NAME . '/shortcodes/counter/assets/js/countUp' . $min_js_suffix . '.js'),
			'js_deps'  => array(),
			'css_deps' => array()
		),
		'gallery'           => array(
			'css' => plugins_url(GF_PLUGIN_NAME . '/shortcodes/gallery/assets/scss/gallery' . $min_css_suffix . '.css'),
			'css_deps' => array()
		),
		'icon_box'           => array(
			'css' => plugins_url(GF_PLUGIN_NAME . '/shortcodes/icon-box/assets/scss/icon-box' . $min_css_suffix . '.css'),
			'css_deps' => array()
		),
		'pricing'           => array(
			'css' => plugins_url(GF_PLUGIN_NAME . '/shortcodes/pricing/assets/scss/pricing' . $min_css_suffix . '.css'),
			'css_deps' => array()
		),
		'process'           => array(
			'css' => plugins_url(GF_PLUGIN_NAME . '/shortcodes/process/assets/scss/process' . $min_css_suffix . '.css'),
			'css_deps' => array()
		),
		'property_info'           => array(
			'css' => plugins_url(GF_PLUGIN_NAME . '/shortcodes/property-info/assets/scss/property-info' . $min_css_suffix . '.css'),
			'css_deps' => array()
		),
		'space'           => array(
			'js'       => plugins_url(GF_PLUGIN_NAME . '/shortcodes/space/assets/js/space' . $min_js_suffix . '.js'),
		),
		'testimonials'           => array(
			'css' => plugins_url(GF_PLUGIN_NAME . '/shortcodes/testimonials/assets/scss/testimonials' . $min_css_suffix . '.css'),
			'css_deps' => array()
		),
		'text_info'           => array(
			'css' => plugins_url(GF_PLUGIN_NAME . '/shortcodes/text-info/assets/scss/text-info' . $min_css_suffix . '.css'),
			'css_deps' => array()
		),
		'video'           => array(
			'css' => plugins_url(GF_PLUGIN_NAME . '/shortcodes/video/assets/scss/video' . $min_css_suffix . '.css'),
			'css_deps' => array()
		),
	) );
	wp_cache_set($cache_key, $shortcode_list);
	return $shortcode_list;
}

function gf_register_shortcodes_assets() {
// Shortcode assets
	foreach ( gf_shortcode_assets() as $shortcode_name => $shortcode_src ) {
		if ( ! empty( $shortcode_src ) ) {
			if ( isset( $shortcode_src['css'] ) && ! empty( $shortcode_src['css'] ) ) {
				wp_register_style( GF_PLUGIN_PREFIX . $shortcode_name, $shortcode_src['css'],
					isset( $shortcode_src['css_deps'] ) ? $shortcode_src['css_deps'] : array(),
					false );
			}
			if ( isset( $shortcode_src['js'] ) && ! empty( $shortcode_src['js'] ) ) {
				wp_register_script( GF_PLUGIN_PREFIX . $shortcode_name, $shortcode_src['js'],
					isset( $shortcode_src['js_deps'] ) ? $shortcode_src['js_deps'] : array( 'jquery' ),
					false, true );
			}
		}
	}
}
add_action( 'init', 'gf_register_shortcodes_assets' );


function gf_enqueue_shortcodes_assets(){
	if ( is_singular() ) {
		global $post;
		if ( isset( $post ) && isset( $post->post_content ) ) {
			gf_enqueue_shortcode_assets( $post->post_content );
		}
	}

	$custom_css = '';
	$content_block_ids = array();

	$set_footer_custom = gf_get_option('set_footer_custom', 0);

	if ( $set_footer_custom !== '' ) {
		$content_block_ids[] = $set_footer_custom;
	}


	$set_footer_above_custom = gf_get_option('set_footer_above_custom', 0);
	if ( $set_footer_above_custom !== '' ) {
		$content_block_ids[] = $set_footer_above_custom;
	}


	foreach ( $content_block_ids as $content_block_id ) {
		if ( $content_block_id !== '' ) {

			$post_custom_css = get_post_meta( $content_block_id, '_wpb_post_custom_css', true );
			if ( ! empty( $post_custom_css ) ) {
				$custom_css .= $post_custom_css;
			}

			$shortcodes_custom_css = get_post_meta( $content_block_id, '_wpb_shortcodes_custom_css', true );
			if ( ! empty( $shortcodes_custom_css ) ) {
				$custom_css .= $shortcodes_custom_css;
			}

			$content = get_post_field( 'post_content', $content_block_id );
			gf_enqueue_shortcode_assets( $content );
			wp_enqueue_style( 'js_composer_front' );
			wp_enqueue_script( 'wpb_composer_front_js' );
		}
	}

	if ($custom_css !== '') {
		wp_add_inline_style('js_composer_front',$custom_css);
	}


}
add_action( 'wp_enqueue_scripts', 'gf_enqueue_shortcodes_assets',12 );


function gf_enqueue_shortcode_assets($content) {
	$shortcode_assets = gf_shortcode_assets();
	$pattern          = '/(\[g5plus_' . implode( ')|(\[g5plus_', array_keys( $shortcode_assets ) ) . ')/';
	if ( preg_match_all( $pattern, $content, $matchs ) ) {
		$shortcode_exists = array_unique( $matchs[0] );
		foreach ( $shortcode_exists as $shortcode_name ) {
			$shortcode_name = substr( $shortcode_name, 8 );
			gf_enqueue_assets_for_shortcode( $shortcode_name );
		}
	}
}


function gf_enqueue_assets_for_shortcode($shortcode_name) {
	$shortcode_list = gf_shortcode_assets();
	$shortcode_src  = isset( $shortcode_list[ $shortcode_name ] ) ? $shortcode_list[ $shortcode_name ] : array();
	if ( ! empty( $shortcode_src ) ) {
		if ( isset( $shortcode_src['css'] ) && ! empty( $shortcode_src['css'] ) ) {
			wp_enqueue_style( GF_PLUGIN_PREFIX . $shortcode_name);
		}
		if ( isset( $shortcode_src['js'] ) && ! empty( $shortcode_src['js'] ) ) {
			wp_enqueue_script( GF_PLUGIN_PREFIX . $shortcode_name );
		}
	}
}