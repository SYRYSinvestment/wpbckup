<?php
/**
 * @var $customize_location
 */
$customize_content =  g5plus_get_option('header_customize_' . $customize_location . '_text','');
?>
<div class="header-customize-item item-custom-text">
	<?php echo wp_kses_post($customize_content); ?>
</div>