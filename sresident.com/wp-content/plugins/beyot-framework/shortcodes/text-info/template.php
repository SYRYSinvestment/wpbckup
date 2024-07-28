<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $values
 * @var $column
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Key_Value
 */

$css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$values = (array) vc_param_group_parse_atts( $values );

$wrapper_attributes = array();
$wrapper_styles = array();

$wrapper_classes = array(
	'g5plus-text-info clearfix',
	$column,
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation( $css_animation ),
);
// animation
$animation_style = $this->getStyleAnimation($animation_duration, $animation_delay);
if (sizeof($animation_style) > 0) {
	$wrapper_styles = $animation_style;
}

if ($wrapper_styles) {
	$wrapper_attributes[] = 'style="' . implode('; ', $wrapper_styles) . '"';
}

$class_to_filter = implode(' ', array_filter($wrapper_classes));
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

?>
<ul class="<?php echo esc_attr($css_class) ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
	<?php foreach ($values as $data):
		$key = isset( $data['key'] ) ? $data['key'] : '';
		$value = isset( $data['value'] ) ? $data['value'] : '';
		?>
		<li><span class="key-name"><?php echo esc_html($key) ?></span><span class="key-value"><?php echo esc_html($value) ?></span></li>
	<?php endforeach; ?>
</ul>