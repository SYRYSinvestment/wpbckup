<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $values
 * @var $name_style
 * @var $name
 * @var $price
 * @var $features
 * @var $value
 * @var $title
 * @var $link
 * @var $featured
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Pricing
 */

$values = $name = $name_style = $price = $features = $title = $link = $featured = $css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
$values = (array)vc_param_group_parse_atts($values);

$wrapper_attributes = array();
$wrapper_styles = array();

$wrapper_classes = array(
	'g5plus-pricing',
	$name_style,
	$this->getExtraClass($el_class),
	$this->getCSSAnimation($css_animation),
);
// animation
$animation_style = $this->getStyleAnimation($animation_duration, $animation_delay);
if (sizeof($animation_style) > 0) {
	$wrapper_styles = $animation_style;
}
//parse link
$link = ('||' === $link) ? '' : $link;
$link = vc_build_link($link);
$use_link = false;
if (strlen($link['url']) > 0) {
	$use_link = true;
	$a_href = $link['url'];
	$a_title = $link['title'];
	$a_target = $link['target'];
}

if ('true' === $featured) {
	$wrapper_classes[] = 'featured';
	$button_class = 'btn btn-lg';
} else {
	$button_class = 'btn btn-lg  btn-outline';
}

if ($wrapper_styles) {
	$wrapper_attributes[] = 'style="' . implode(' ', $wrapper_styles) . '"';
}

$button_attributes = array();
if ($use_link) {
	$button_attributes[] = 'href="' . esc_url(trim($a_href)) . '"';
	if (empty($a_title)) {
		$a_title = $title;
	}
	$button_attributes[] = 'title="' . esc_attr(trim($a_title)) . '"';
	if (!empty($a_target)) {
		$button_attributes[] = 'target="' . esc_attr(trim($a_target)) . '"';
	}
}

$class_to_filter = implode(' ', array_filter($wrapper_classes));
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
	<div class="price-box">
		<div class="price-value">
			<span class="fs-60 fw-bold"><?php echo wp_kses_post($price) ?></span>
		</div>
		<h4 class="pricing-name fw-bold fs-24 uppercase"><?php echo wp_kses_post($name) ?></h4>
	</div>
	<div class="pricing-features">
		<ul>
			<?php foreach ($values as $data): ?>
				<?php $features = isset($data['features']) ? $data['features'] : ''; ?>
				<?php $value = isset($data['value']) ? $data['value'] : ''; ?>
				<?php if (!empty($features)): ?>
					<li class="fs-16 primary_text_color">
						<?php echo wp_kses_post($data['features']);
						if (!empty($value)): ?>
							<span><?php echo wp_kses_post($data['value']) ?></span>
						<?php endif; ?>
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php if (!empty($title)): ?>
		<div class="pricing-button">
			<a class="<?php echo esc_attr($button_class) ?>" <?php echo implode(' ', $button_attributes); ?>><?php echo esc_html($title) ?></a>
		</div>
	<?php endif; ?>
</div>