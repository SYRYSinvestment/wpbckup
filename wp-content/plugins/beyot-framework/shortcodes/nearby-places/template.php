<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $lat
 * @var $lng
 * @var $nearby_places_radius
 * @var $nearby_places_rank_by
 * @var $set_map_height
 * @var $nearby_places_distance_in
 * @var $nearby_places_fields
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Nearby_Places
 */

$css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
$atts          = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$fields = (array) vc_param_group_parse_atts( $nearby_places_fields );

$wrapper_attributes = array();
$wrapper_styles     = array();

$wrapper_classes = array(
	'g5plus-nearby-places',
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation( $css_animation ),
);

// animation
$animation_style = $this->getStyleAnimation( $animation_duration, $animation_delay );
if ( sizeof( $animation_style ) > 0 ) {
	$wrapper_styles = $animation_style;
}

if ( $wrapper_styles ) {
	$wrapper_attributes[] = 'style="' . implode( '; ', $wrapper_styles ) . '"';
}

$class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' );

$css_class             = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
$map_icons_path_marker = GF_PLUGIN_URL . 'assets/images/map-marker-icon.png';

$places     = array();
$places_detail     = array();
foreach ( $fields as $data ) {
	$type = isset( $data['nearby_places_select_field_type'] ) ? $data['nearby_places_select_field_type'] : '';
	if ( $type !== '' ) {
		$places[] = $type;
		$place = array();
		$label = ( isset( $data['nearby_places_field_label'] ) ? $data['nearby_places_field_label'] : '' );
		$icon  = '';
		if ( isset( $data['nearby_places_field_icon'] ) && $data['nearby_places_field_icon'] != '' ) {
			$icons = wp_get_attachment_image_src( $data['nearby_places_field_icon'], 'full' );
			$icon  = $icons[0];
		}
		$places_detail[ $type ] = array(
			'label' => $label,
			'icon'  => $icon
		);
	}

}
if ( empty( $nearby_places_radius ) ) {
	$nearby_places_radius = '5000';
}
if ( empty( $set_map_height ) ) {
	$set_map_height = '475';
}
$options = array(
	'lat'         => $lat,
	'lng'         => $lng,
	'marker'      => $map_icons_path_marker,
	'places'      => $places,
	'places_detail'      => $places_detail,
	'distance_in' => $nearby_places_distance_in,
	'rank_by'     => $nearby_places_rank_by,
	'radius'      => $nearby_places_radius
);
?>
<div data-options="<?php echo esc_attr( json_encode( $options ) ) ?>"
     class="row <?php echo esc_attr( $css_class ) ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
	<div class="col-lg-7 col-12 col-12 " style="height:<?php echo $set_map_height ?>px;">
		<div class="near-location-map" style="width:100%;height:100%;">
		</div>
	</div>
	<div class="col-lg-5 col-12 col-12 nearby-places-detail"></div>
</div>