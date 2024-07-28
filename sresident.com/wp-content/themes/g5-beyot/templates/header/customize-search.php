<?php
/**
 * @var $customize_location
 */

$customize_content =  g5plus_get_option('header_customize_' . $customize_location . '_search','button');
$classes = array(
	'header-customize-item',
	'item-search'
);
if ($customize_content == 'box-small') {
	$classes[] = 'search-form-small';
}
?>
<div class="<?php echo join(' ', $classes); ?>">
	<?php g5plus_get_template('header/customize-search-' . $customize_content); ?>
</div>