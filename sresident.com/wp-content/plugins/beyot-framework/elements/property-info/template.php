<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}
use Elementor\Icons_Manager;

/**
 * @var $element UBE_Element_Beyot_Property_Info
 */

$atts = $element->get_settings_for_display();
$wrapper_classes = array(
	'ube-property-info',
	'g5plus-property-info',
	'clearfix',
);
$element->set_render_attribute('wrapper', array(
	'class' => $wrapper_classes
));

?>
<div <?php $element->print_render_attribute_string('wrapper') ?>>
	<div class="property-info-top">
		<p class="property-info-address"><i class="fa fa-map-marker accent-color"></i><?php echo esc_html($atts['address']) ?></p>
		<h3 class="property-info-title"><?php echo esc_html($atts['title']) ?></h3>
		<div class="property-info-price"><?php echo esc_html($atts['price']) ?><span class="property-info-after-price"><span class="property-arrow"></span><?php echo esc_html($atts['after_price']) ?></span></div>
	</div>
	<div class="property-info-detail">
		<?php foreach ($atts['values'] as $data => $item):
			$key = isset( $item['key'] ) ? $item['key'] : '';
			$value = isset( $item['value'] ) ? $item['value'] : '';
			$icon_font = isset( $item['icon_font']['value'] ) ? $item['icon_font']['value'] : '';
			?>
			<div class="property-info-item">
				<span class="<?php echo esc_attr($icon_font) ?>"></span>
				<div class="content-property-info">
					<p class="property-info-value"><?php echo esc_html($value) ?></p>
					<p class="property-info-key"><?php echo esc_html($key) ?></p>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>

