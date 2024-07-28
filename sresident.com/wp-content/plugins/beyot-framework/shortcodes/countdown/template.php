<?php
/**
 * Created by PhpStorm.
 * User: Kaga
 * Date: 20/5/2016
 * Time: 3:57 PM
 */
/**
 * Shortcode attributes
 * @var $atts
 * @var $color_scheme
 * @var $time
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Countdown
 */

$color_scheme = $time = $url_redirect = $css_animation = $animation_duration = $animation_delay = $el_class = $css ='';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);


$wrapper_attributes = array();
$wrapper_styles = array();

$wrapper_classes = array(
	'g5plus-countdown',
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
	$wrapper_attributes[] = 'style="' . implode('; ', array_filter($wrapper_styles) ) . '"';
}

$class_to_filter = implode(' ', array_filter($wrapper_classes));
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
if ( !empty($time)) {
	$time =  mysql2date( 'Y/m/d H:i:s', $time );

	?>
	<div class="<?php echo esc_attr($css_class) ?>" data-url-redirect="<?php echo esc_attr($url_redirect)?>" data-date-end="<?php echo esc_attr($time); ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
		<div class="g5plus-countdown-inner">
			<div class="countdown-section">
				<span class="countdown-amount countdown-day"></span>
				<span class="countdown-period"><?php esc_html_e('DAYS','beyot-framework'); ?></span>
			</div>
			<div class="countdown-section">
				<span class="countdown-amount countdown-hours"></span>
				<span class="countdown-period"><?php esc_html_e('HOURS','beyot-framework'); ?></span>
			</div>
			<div class="countdown-section">
				<span class="countdown-amount countdown-minutes"></span>
				<span class="countdown-period"><?php esc_html_e('MINUTES','beyot-framework'); ?></span>
			</div>
			<div class="countdown-section">
				<span class="countdown-amount countdown-seconds"></span>
				<span class="countdown-period"><?php esc_html_e('SECONDS','beyot-framework'); ?></span>
			</div>
		</div>
	</div>
<?php
}