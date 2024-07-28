<?php
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Heading
 */
$layout_style=$title =$sub_title = $text_align = $color_scheme = $el_class  = $css_animation = $animation_duration = $animation_delay  =$css= '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
$wrapper_attributes = array();
$styles = array();
// animation
$animation_style = $this->getStyleAnimation($animation_duration, $animation_delay);
if (sizeof($animation_style) > 0) {
    $styles = $animation_style;
}
$wrapper_classes = array(
    'g5plus-heading',
    $layout_style,
    $text_align,
    $color_scheme,
    $this->getExtraClass($el_class),
    $this->getCSSAnimation($css_animation)
);
if ($styles) {
    $wrapper_attributes[] = 'style="' . implode(' ', $styles) . '"';
}
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
$class_to_filter = implode(' ', array_filter($wrapper_classes));
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
    <span></span>
    <?php if (!empty($sub_title)): ?>
        <p>
                <?php echo esc_html($sub_title); ?>
        </p>
    <?php endif; ?>
    <?php if (!empty($title)): ?>
        <h2><?php echo esc_html($title); ?></h2>
    <?php endif; ?>
</div>