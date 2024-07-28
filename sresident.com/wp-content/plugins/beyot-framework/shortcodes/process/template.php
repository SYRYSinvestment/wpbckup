<?php
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Process
 */
$step=$title =$description = $color_scheme = $el_class  = $css_animation = $animation_duration = $animation_delay  =$css= '';
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
    'g5plus-process',
    $color_scheme,
    $this->getExtraClass($el_class),
    $this->getCSSAnimation($css_animation)
);
if ($styles) {
    $wrapper_attributes[] = 'style="' . implode(' ', $styles) . '"';
}
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
$class_to_filter = implode(' ', array_filter($wrapper_classes));
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
    <?php if($use_link): ?>
        <a <?php echo implode(' ', $link_attributes ); ?>>
            <span><?php echo esc_html($step); ?></span>
        </a>
    <?php else:?>
        <span><?php echo esc_html($step); ?></span>
    <?php  endif; ?>
    <?php if (!empty($title)):
        if($use_link): ?>
            <h2><a <?php echo implode(' ', $title_attributes ); ?>>
                <?php echo esc_attr( $title ) ?>
            </a></h2>
        <?php else: ?>
            <h2><?php echo esc_html( $title ) ?></h2>
        <?php endif;
    endif; ?>
    <?php if (!empty($description)): ?>
        <div class="process-desc">
            <?php echo esc_html($description); ?>
        </div>
    <?php endif; ?>
</div>