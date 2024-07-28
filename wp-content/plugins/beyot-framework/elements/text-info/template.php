<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

/**
 * @var $element UBE_Element_Beyot_Text_Info
 */

$atts = $element->get_settings_for_display();
$wrapper_classes = array(
	'g5plus-text-info clearfix',
	$atts['column'],
);
$element->set_render_attribute('wrapper', array(
	'class' => $wrapper_classes
));
?>

<ul <?php $element->print_render_attribute_string('wrapper') ?>>
	<?php foreach ($atts['values'] as $data):
		$key = isset( $data['key'] ) ? $data['key'] : '';
		$value = isset( $data['value'] ) ? $data['value'] : '';
		?>
		<li><span class="key-name"><?php echo esc_html($key) ?></span><span class="key-value"><?php echo esc_html($value) ?></span></li>
	<?php endforeach; ?>
</ul>

