<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $name
 * @var $position
 * @var $phone
 * @var $mobile
 * @var $fax
 * @var $website
 * @var $email
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Agent_Info
 */

$name=$position=$phone=$mobile=$fax=$website=$email=$css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$wrapper_attributes = array();
$wrapper_styles = array();

$wrapper_classes = array(
	'g5plus-agent-info',
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
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
	<?php if(!empty($name)):?>
	<h3><?php echo esc_html($name) ?></h3>
	<?php endif;
	if(!empty($position)):?>
	<p><?php echo esc_html($position) ?></p>
	<?php endif;?>
	<?php if(!empty($phone)):?>
	<span><i class="fa fa-phone accent-color"></i> <strong><?php esc_attr_e('Phone:','beyot-framework') ?></strong>
		<?php echo esc_html($phone) ?>
	</span>
	<?php endif;
	if(!empty($mobile)):?>
	<span><i class="fa fa-mobile accent-color"></i> <strong><?php esc_attr_e('Mobile:','beyot-framework') ?></strong>
		<?php echo esc_html($mobile) ?>
	</span>
	<?php endif;
	if(!empty($fax)):?>
	<span><i class="fa fa-fax accent-color"></i> <strong><?php esc_attr_e('Fax:','beyot-framework') ?></strong>
		<?php echo esc_html($fax) ?>
	</span>
	<?php endif;
	if(!empty($website)):?>
	<span><i class="fa fa-link accent-color"></i> <strong><?php esc_attr_e('Website:','beyot-framework') ?></strong>
		<?php echo esc_html($website) ?>
	</span>
	<?php endif;
	if(!empty($email)):?>
	<span><i class="fa fa-envelope accent-color"></i> <strong><?php esc_attr_e('Email:','beyot-framework') ?></strong>
		<?php echo esc_html($email) ?>
	</span>
	<?php endif;?>
</div>
