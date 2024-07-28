<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $layout_style
 * @var $color_scheme
 * @var $icon_bg_style
 * @var $icon_scheme_color
 * @var $icon_bg_size
 * @var $icon_align
 * @var $is_box_shadow
 * @var $is_box_shadow_other
 * @var $title
 * @var $description
 * @var $icon_type
 * @var $icon_font
 * @var $icon_image
 * @var $link
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Icon_Box
 */

$layout_style = $color_scheme = $title = $description = $icon_type = $icon_font = $icon_image = $link = $css_animation
    = $animation_duration = $animation_delay = $el_class = $css = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$wrapper_attributes = array();
$wrapper_styles = array();


$wrapper_classes = array(
    'g5plus-icon-box',
    $layout_style,
    $color_scheme,
    $this->getExtraClass($el_class),
    $this->getCSSAnimation($css_animation)
);
//parse link
$link_attributes = $title_attributes = array();
$link = ( '||' === $link ) ? '' : $link;
$link = vc_build_link( $link );
$use_link = false;
if ( strlen( $link['url'] ) > 0 ) {
    $use_link = true;
    $link_attributes[] = 'href="' . esc_url( trim($link['url']) ) . '"';
    if(strlen($link['target']) >0) {
        $link_attributes[] = 'target="' . trim($link['target']) . '"';
    }
    if(strlen($link['rel']) >0) {
        $link_attributes[] = 'rel="' . trim($link['rel']) . '"';
    }
    $title_attributes = $link_attributes;
    if(strlen($link['title']) >0) {
        $link_attributes[] = 'title="' . trim($link['title']) . '"';
    }
    $title_attributes[] = 'title="' . esc_attr( trim( $title ) ) . '"';
}

// icon html
$icon_html = '';
if ($icon_type == 'image') {
    if (!empty($icon_image)) {
        $icon_image_id = preg_replace( '/[^\d]/', '', $icon_image );
        $icon_image_src = wp_get_attachment_image_src( $icon_image_id, 'full' );
        if ( ! empty( $icon_image_src[0] ) ) {
            $icon_image_src = $icon_image_src[0];
            $icon_html = '<img alt="'. the_title_attribute(array('post' => $icon_image_id,'echo' => false )) .'" src="'. esc_url($icon_image_src) .'">';
        }

    }
} else {
	vc_icon_element_fonts_enqueue('fontawesome');
    $icon_html = '<i class="'. esc_attr($icon_font).'"></i>';
}

// animation
$animation_style = $this->getStyleAnimation($animation_duration,$animation_delay);
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
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
    <div class="icon-wrap">
    <?php if($use_link): ?>
        <a <?php echo implode(' ', $link_attributes ); ?>>
            <?php echo wp_kses_post($icon_html); ?>
        </a>
    <?php else:
        echo wp_kses_post($icon_html);
    endif; ?>
    </div>
    <?php if(!empty( $title )):
        if($use_link): ?>
            <h6><a <?php echo implode(' ', $title_attributes ); ?>>
                <?php echo esc_html( $title ) ?>
            </a></h6>
        <?php else: ?>
            <h6><?php echo esc_html( $title ) ?></h6>
        <?php endif;
    endif;
    if(!empty( $description)): ?>
        <p><?php echo wp_kses_post($description); ?></p>
    <?php endif; ?>
</div>