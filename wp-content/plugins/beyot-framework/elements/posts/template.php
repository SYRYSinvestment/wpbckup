<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

/**
 * @var $element UBE_Element_Beyot_Posts
 */
$atts = $element->get_settings_for_display();
$wrapper_classes = array(
	'ube__posts',
	'archive-wrap',
	'clearfix',
	"archive-{$atts['post_layout']}",
);
$query_args = array();
$settings = array();
$element->set_render_attribute('wrapper', array(
	'class' => $wrapper_classes
));
$element->prepare_display($atts, $query_args, $settings);
?>
<div <?php $element->print_render_attribute_string('wrapper') ?>>
	<?php $element->archive_markup() ?>
</div>
