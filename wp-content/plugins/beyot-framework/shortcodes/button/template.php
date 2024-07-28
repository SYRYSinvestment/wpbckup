<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $link
 * @var $color
 * @var $style
 * @var $size
 * @var $align
 * @var $button_block
 * @var $add_icon
 * @var $icon_align
 * @var $icon_font
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Button
 */

$title = $link = $color = $style = $size = $align = $button_block = $add_icon = $icon_align =  $icon_font =  $css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$wrapper_attributes = array();
$styles = array();

// animation
$animation_style = $this->getStyleAnimation($animation_duration,$animation_delay);
if (sizeof($animation_style) > 0) {
    $styles = $animation_style;
}

$wrapper_classes = array(
    'g5plus-btn-container',
    $this->getExtraClass( $el_class ),
    $this->getCSSAnimation( $css_animation ),
    'btn-' . $align,
);

$button_classes = array(
    'btn',
    'btn-'. $size,
    'btn-'. $color,
    'btn-'. $style
);

//parse link
$link = ( '||' === $link ) ? '' : $link;
$link = vc_build_link( $link );
$use_link = false;
if ( strlen( $link['url'] ) > 0 ) {
    $use_link = true;
    $a_href = $link['url'];
    $a_title = $link['title'];
    $a_target = $link['target'];
    $a_rel = $link['rel'];
}

$button_html = $title;

if ( 'true' === $button_block && 'inline' !== $align ) {
    $button_classes[] = 'btn-block';
}

if ( 'true' === $add_icon ) {
	vc_icon_element_fonts_enqueue('fontawesome');
    $button_classes[] = 'btn-icon';
    if ($icon_align == 'right') {
        $button_classes[] = 'btn-icon-right';
    }
    $icon_html = '<i class="'. esc_attr($icon_font) .'"></i>';

    if ( 'left' === $icon_align ) {
        $button_html = $icon_html . ' <span>' . $button_html . '</span>';
    } else {
        $button_html = '<span>' . $button_html .  '</span> ' . $icon_html;
    }
}

if ( $styles ) {
    $wrapper_attributes[] = 'style="' . implode( ' ', $styles ) . '"';
}

$class_to_filter = implode(' ', $wrapper_classes);
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

$button_attributes = array();
if ( $button_classes ) {
    $button_classes = esc_attr( apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', $button_classes), $this->settings['base'], $atts ) );
    $button_attributes[] = 'class="' . trim( $button_classes ) . '"';
}

if ( $use_link ) {
    $button_attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
    if (empty($a_title)) {
        $a_title = $title;
    }
    $button_attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
    if ( ! empty( $a_target ) ) {
        $button_attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
    }

    if ( ! empty( $a_rel ) ) {
        $button_attributes[] = 'rel="' . esc_attr( trim( $a_rel ) ) . '"';
    }
}
?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
    <?php if ($use_link) : ?>
        <a <?php echo implode( ' ', $button_attributes );?>><?php echo wp_kses_post($button_html) ; ?></a>
    <?php else: ?>
        <button <?php echo implode( ' ', $button_attributes );?>><?php echo wp_kses_post($button_html) ; ?></button>
    <?php endif; ?>
</div>