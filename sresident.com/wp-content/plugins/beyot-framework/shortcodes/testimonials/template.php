<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $values
 * @var $dots
 * @var $nav
 * @var $autoplay
 * @var $autoplayspeed
 * @var $text_color
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Testimonials
 */

$layout_style=$values = $color_scheme = $arrows = $dots = $autoplay = $autoplayspeed = $css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$values = (array) vc_param_group_parse_atts( $values );

$wrapper_attributes = array();
$wrapper_styles = array();

$wrapper_classes = array(
	'g5plus-testimonials',
	'owl-carousel',
	$layout_style,
	$color_scheme,
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

$owl_attributes = array(
	'"dots": ' . ($dots ? 'true' : 'false'),
	'"nav": ' . ($nav ? 'true' : 'false'),
	'"items": 1',
	'"autoHeight": true',
	'"autoplay": ' . ($autoplay ? 'true' : 'false'),
	'"autoplaySpeed": '.$autoplayspeed
);

$wrapper_attributes[] = "data-plugin-options='{". implode(', ', $owl_attributes) ."}'";

$class_to_filter = implode(' ', array_filter($wrapper_classes));
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
	<?php foreach ($values as $data):
		$avatar = isset( $data['avatar'] ) ? $data['avatar'] : '';
		$quote = isset( $data['quote'] ) ? $data['quote'] : '';
		$author = isset( $data['author'] ) ? $data['author'] : '';
		?>
		<div class="testimonial-item">
			<?php if($avatar!=''):
				$img = wp_get_attachment_image_src( $avatar, '100x100' ); ?>
				<img alt="<?php echo esc_attr($author)?>" src="<?php echo esc_url($img[0])?>"/>
			<?php endif;
			if (!empty($author) && $layout_style=='layout-center'): ?>
				<h6><?php echo esc_html($author)?></h6>
			<?php endif;
			if (!empty($quote)): ?>
				<p><?php echo esc_html($quote)?></p>
			<?php endif;
			if (!empty($author) && $layout_style!='layout-center'): ?>
				<h6><?php echo esc_html($author)?></h6>
			<?php endif;?>
		</div>
	<?php endforeach; ?>
</div>