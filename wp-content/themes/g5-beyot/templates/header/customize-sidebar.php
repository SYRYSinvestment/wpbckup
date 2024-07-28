<?php
/**
 * @var $customize_location
 */
$customize_content =  g5plus_get_option('header_customize_' . $customize_location . '_sidebar','');
if (!is_active_sidebar($customize_content)) {
	return;
}
?>
<div class="header-customize-item item-sidebar">
	<?php dynamic_sidebar($customize_content) ?>
</div>