<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $address
 * @var $title
 * @var $price
 * @var $after_price
 * @var $values
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Property_Info
 */

$css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$values = (array) vc_param_group_parse_atts( $values );

$wrapper_attributes = array();
$wrapper_styles = array();

$wrapper_classes = array(
	'g5plus-property-info clearfix',
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

vc_icon_element_fonts_enqueue('fontawesome');
?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
	<div class="property-info-top">
		<p class="property-info-address"><i class="fa fa-map-marker accent-color"></i><?php echo esc_html($address) ?></p>
		<h3 class="property-info-title"><?php echo esc_html($title) ?></h3>
		<div class="property-info-price"><?php echo esc_html($price) ?><span class="property-info-after-price"><span class="property-arrow"></span><?php echo esc_html($after_price) ?></span></div>
	</div>
	<div class="property-info-detail">
		<?php foreach ($values as $data):
		$key = isset( $data['key'] ) ? $data['key'] : '';
		$value = isset( $data['value'] ) ? $data['value'] : '';
		$icon_font = isset( $data['icon_font'] ) ? $data['icon_font'] : '';
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
