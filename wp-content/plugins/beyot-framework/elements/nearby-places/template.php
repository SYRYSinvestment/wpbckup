<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

/**
 * @var $element UBE_Element_Beyot_Nearby_Places
 */

$atts = $element->get_settings_for_display();
$wrapper_classes = array(
	'g5plus-nearby-places row',
);
$element->set_render_attribute('wrapper', array(
	'class' => $wrapper_classes
));
$fields = $atts['nearby_places_fields'];
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
		if ( isset( $data['nearby_places_field_icon']['url'] ) && $data['nearby_places_field_icon']['url'] != '' ) {
			$icon  = $data['nearby_places_field_icon']['url'];
		}
		$places_detail[ $type ] = array(
			'label' => $label,
			'icon'  => $icon
		);
	}

}

if ( empty( $atts['nearby_places_radius ']) ) {
	$atts['nearby_places_radius '] = '5000';
}
if ( empty( $atts['set_map_height'] ) ) {
	$atts['set_map_height'] = '475';
}
$options = array(
	'lat'         => $atts['lat'],
	'lng'         => $atts['lng'],
	'marker'      => $map_icons_path_marker,
	'places'      => $places,
	'places_detail'      => $places_detail,
	'distance_in' => $atts['nearby_places_distance_in'],
	'rank_by'     => $atts['nearby_places_rank_by'],
	'radius'      => $atts['nearby_places_radius ']
);


?>
<div data-options="<?php echo esc_attr( json_encode( $options ) ) ?>" <?php $element->print_render_attribute_string('wrapper') ?>>
	<div class="col-lg-7 col-12 col-12 " style="height:<?php echo $atts['set_map_height'] ?>px;">
		<div class="near-location-map" style="width:100%;height:100%;">
		</div>
	</div>
	<div class="col-lg-5 col-12 col-12 nearby-places-detail"></div>
</div>



