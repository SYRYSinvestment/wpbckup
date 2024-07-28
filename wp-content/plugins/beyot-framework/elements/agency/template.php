<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

/**
 * @var $element UBE_Element_Beyot_Agency
 */
$atts = $element->get_settings_for_display();

$posts_per_page = absint($atts['posts_per_page']) ? absint($atts['posts_per_page']) : 6;

$wrapper_classes = array(
	'ube-agency',
);
$element->set_render_attribute('wrapper', array(
	'class' => $wrapper_classes,
));

$config = array(
	'item_amount' => $posts_per_page,
	'show_paging' => $atts['post_paging'],
	'include_heading' => $atts['include_heading'],
);

if ($atts['include_heading'] == true) {
	$config['heading_title'] = $atts['heading_title'];
	$config['heading_sub_title'] = $atts['heading_sub_title'];
	$config['heading_text_align'] = $atts['heading_text_align'];
}

?>

<div <?php $element->print_render_attribute_string('wrapper') ?>>
	<?php echo do_shortcode($element->get_shortcode('ere_agency', $config)); ?>
</div>
