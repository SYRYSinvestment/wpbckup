<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

/**
 * @var $element UBE_Element_Beyot_Property_Featured
 */

$atts = $element->get_settings_for_display();

$wrapper_classes = array(
	'ube-property-featured',
);
$element->set_render_attribute('wrapper', array(
	'class' => $wrapper_classes,
));

$config = array(
	'color_scheme' => $atts['color_scheme'],
);

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

if (!empty($atts['image_size1'])) {
	$config['image_size1'] = $atts['image_size1'];
}
if (!empty($atts['image_size2'])) {
	$config['image_size2'] = $atts['image_size2'];
}
if (!empty($atts['image_size3'])) {
	$config['image_size3'] = $atts['image_size3'];
}
if (!empty($atts['image_size4'])) {
	$config['image_size4'] = $atts['image_size4'];
}
$element->prepare_display($atts, $config);
?>
<div <?php $element->print_render_attribute_string('wrapper') ?>>
	<?php ere_get_template('shortcodes/property-featured/property-featured.php', array('atts' => $element->_config)); ?>
</div>
