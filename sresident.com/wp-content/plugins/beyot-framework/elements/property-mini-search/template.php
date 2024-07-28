<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

/**
 * @var $element UBE_Element_Beyot_Property_Mini_Search
 */
$atts = $element->get_settings_for_display();

$wrapper_classes = array(
	'ube-mini-search-properties',
);
$element->set_render_attribute('wrapper', array(
	"class" => $wrapper_classes,
));

$config = array(
	'status_enable' => $atts['status_enable'],
);

?>
<div <?php echo $element->print_render_attribute_string('wrapper') ?>>
	<?php echo do_shortcode($element->get_shortcode('ere_property_mini_search',$config)); ?>
</div>

