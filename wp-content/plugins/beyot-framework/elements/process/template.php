<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

/**
 * @var $element Elementor\Widget_Base
 * @var $link array
 * @var $number
 * @var $title
 * @var $item_key
 * @var $desc
 * @var  $custom_css
 */

if (!isset($item_key)) {
	$item_key = '';
}

$item_class = array(
	'ube-process-item',
	'g5plus-process',
);

if (isset($custom_css) && !empty($custom_css)) {
	$item_class[] = $custom_css;
}

if ($link['url'] !== '') {
	$element->add_link_attributes("link_attr{$item_key}", $link);
}
$element->set_render_attribute("item_class{$item_key}", array(
	'class' => $item_class,
));

?>


<div <?php $element->print_render_attribute_string("item_class{$item_key}") ?>>
	<?php
    if ($number !== '') {
		if ($link['url'] !== '') {
			$number = sprintf('<a %1$s>%2$s</a>', $element->get_render_attribute_string("link_attr{$item_key}"), wp_kses_post($number));
		}
		printf('<span>%1$s</span>', $number);
	}
	if ($title) {
		if ($link['url'] !== '') {
			$title = sprintf('<a %1$s>%2$s</a>', $element->get_render_attribute_string("link_attr{$item_key}"), wp_kses_post($title));
		}
		printf('<h2>%1$s</h2>', $title);
	}
	if ($desc !== '') {
		echo '<div class="process-desc">' . wp_kses_post($desc) . '</div>';
	}
	?>
</div>
