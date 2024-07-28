<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

/**
 * @var $element UBE_Element_Beyot_Property_Slider
 */

$atts = $element->get_settings_for_display();

$wrapper_classes = array(
	'ube-property-slider',
);
$element->set_render_attribute('wrapper', array(
	'class' => $wrapper_classes,
));

$config = array(
	'layout_style'=>   $atts['post_layout'],
	'image_size'=>   $atts['image_size'],
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

if ($atts['property_featured'] == 'true') {
	$config['property_featured'] = 'true';
}

?>
<div <?php $element->print_render_attribute_string('wrapper') ?>>
	<?php ere_get_template('shortcodes/property-slider/property-slider.php', array('atts' => $config)); ?>
</div>
