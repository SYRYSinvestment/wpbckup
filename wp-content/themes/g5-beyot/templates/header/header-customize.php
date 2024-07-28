<?php
/**
 * @var $customize_location
 */
$header_customize_location = g5plus_get_option('header_customize_' . $customize_location,array());
$wrapper_class = array('header-customize-wrapper');
$wrapper_class[] = 'header-customize-' . $customize_location;
$css_class = g5plus_get_option('header_customize_' . $customize_location . '_css_class', '');
if ($css_class) {
	$wrapper_class[] = $css_class;
}
?>
<?php if (is_array( $header_customize_location ) && count($header_customize_location) > 0): ?>
	<div class="<?php echo join(' ', $wrapper_class); ?>">
		<?php foreach ($header_customize_location as $key): ?>
			<?php if (!in_array($key, array('sidebar', 'search', 'custom-text'))) { continue; } ?>
			<?php g5plus_get_template('header/customize-' . $key, array('customize_location' => $customize_location)); ?>
		<?php endforeach;?>
	</div>
<?php endif;?>