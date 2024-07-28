<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

/**
 * @var $element UBE_Element_Beyot_Property
 */

$atts = $element->get_settings_for_display();

$wrapper_classes = array(
	'ube-property',
);
$element->set_render_attribute('wrapper', array(
	'class' => $wrapper_classes,
));

$config = array();

$taxonomy_narrow = array(
	'property_type' => 'property-type',
	'property_status' => 'property-status',
	'property_feature' => 'property-feature',
	'property_city' => 'property-city',
	'property_state' => 'property-state',
	'property_neighborhood' => 'property-neighborhood',
	'property_label' => 'property-label',
);

foreach ($taxonomy_narrow as $k => $v) {
	if (!empty($atts[$k])) {
		$config[$k] = $element->get_name_by_id($atts[$k], $v);
	}
}

if ($atts['property_featured'] == 'true') {
	$config['property_featured'] = 'true';
}

if (!empty($atts['post_columns_gutter'])) {
	$config['columns_gap'] = $atts['post_columns_gutter'];
}

if ($atts['view_all_link']['url'] !== '') {
	$config['view_all_link'] = $atts['view_all_link']['url'];
}

if ($atts['post_layout'] == 'property-carousel') {
	$atts['is_slider'] = true;
	$config['move_nav'] = $atts['move_nav'];
}

$element->prepare_display($atts, $config);

?>
<div <?php $element->print_render_attribute_string('wrapper') ?>>
	<?php ere_get_template('shortcodes/property/property.php', array('atts' => $element->_config)); ?>
</div>
