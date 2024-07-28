<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

/**
 * @var $element UBE_Element_Beyot_Property_Carousel
 */

$atts = $element->get_settings_for_display();

$wrapper_classes = array(
	'ube-property',
);
$element->set_render_attribute('wrapper', array(
	'class' => $wrapper_classes,
));

$config = array(
	'image_size' => $atts['image_size'],
	'color_scheme' => $atts['color_scheme'],
	'item_amount' => absint($atts['posts_per_page']) ? absint($atts['posts_per_page']) : 6,
);

if ($atts['include_heading'] == 'true') {
	$config['include_heading'] = 'true';
	$config['heading_title'] = $atts['heading_title'];
	$config['heading_sub_title'] = $atts['heading_sub_title'];
}

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

?>
<div <?php $element->print_render_attribute_string('wrapper') ?>>
    <?php ere_get_template('shortcodes/property-carousel/property-carousel.php', array('atts' => $config)); ?>
</div>
