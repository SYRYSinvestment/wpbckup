<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

/**
 * @var $element UBE_Element_Beyot_Agents
 */
$atts = $element->get_settings_for_display();

$wrapper_classes = array(
	'ube-agents',
);

$config = array();

if ($atts['post_layout'] == 'agent-slider') {
	$atts['is_slider'] = true;
}

if (!empty($atts['agency'])) {
	$config['agency'] = $element->get_name_by_id($atts['agency'], 'agency');
}

$element->prepare_display($atts, $config);
$element->set_render_attribute('wrapper', array(
	'class' => $wrapper_classes,
));
?>

<div <?php $element->print_render_attribute_string('wrapper') ?>>
	<?php echo do_shortcode($element->get_shortcode('ere_agent', $element->_config)); ?>
</div>