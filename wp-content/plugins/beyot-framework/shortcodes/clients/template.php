<?php
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Clients
 */
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$atts['custom_links'] = explode(',', $atts['custom_links']);
$atts['images'] = explode(',', $atts['images']);

$wrapper_attributes = array();
$wrapper_styles = array();

$wrapper_classes = array(
	'g5plus-clients',
	$this->getExtraClass($atts['el_class']),
	$this->getCSSAnimation($atts['css_animation']),
);

$gf_item_wrap = '';
$bordered = '';

if ($atts['bordered']) {
	$bordered = 'bordered';
}

// animation
$animation_style = $this->getStyleAnimation($atts['animation_duration'], $atts['animation_delay']);
if (sizeof($animation_style) > 0) {
	$wrapper_styles = $animation_style;
}

if ($wrapper_styles) {
	$wrapper_attributes[] = ' style="' . implode('; ', $wrapper_styles) . '"';
}
if ($atts['is_slider']) {
	$wrapper_classes[] = 'owl-carousel';

	if ($atts['nav']) {
		$wrapper_classes[] = 'owl-nav-' . $atts['nav_position'];
	}

	$owl_responsive_attributes = array();
// Mobile <= 480px
	$owl_responsive_attributes[] = '"0" : {"items" : ' . $atts['items_mb'] . '}';

// Extra small devices ( < 768px)
	$owl_responsive_attributes[] = '"481" : {"items" : ' . $atts['items_xs'] . '}';

// Small devices Tablets ( < 992px)
	$owl_responsive_attributes[] = '"768" : {"items" : ' . $atts['items_sm'] . '}';

// Medium devices ( < 1199px)
	$owl_responsive_attributes[] = '"992" : {"items" : ' . $atts['items_md'] . '}';

// Medium devices ( > 1199px)
	$owl_responsive_attributes[] = '"1200" : {"items" : ' . $atts['items_lg'] . '}';

	$owl_attributes = array(
		'"autoHeight": true',
		'"dots": ' . ($atts['dots'] ? 'true' : 'false'),
		'"nav": ' . ($atts['nav'] ? 'true' : 'false'),
		'"autoplay": ' . ($atts['autoplay'] ? 'true' : 'false'),
		'"autoplayTimeout": ' . $atts['autoplaytimeout'],
		'"responsive": {' . implode(', ', $owl_responsive_attributes) . '}'
	);
	$wrapper_attributes[] = "data-plugin-options='{" . implode(', ', $owl_attributes) . "}'";
} else {

	$gf_item_wrap = 'gf-item-wrap';

	$columns_md = 'columns-md-4';
	$columns_sm = 'columns-sm-3';
	$columns_xs = 'columns-xs-2';

	if ($atts['items'] == 3) {
		$columns_md = 'columns-md-3';
	}
	if ($atts['items'] == 2) {
		$columns_md = 'columns-md-2';
		$columns_sm = 'columns-sm-2';
	}
	if ($atts['items'] == 1) {
		$columns_md = '';
		$columns_sm = '';
		$columns_xs = '';
	}
	$wrapper_classes[] = 'row partner-columns columns-' . esc_attr($atts['items']) . ' ' . $columns_md . ' ' . $columns_sm . ' ' . $columns_xs . ' col-mb-12';
}

$class_to_filter = implode(' ', array_filter($wrapper_classes));

$class_to_filter .= vc_shortcode_custom_css_class($atts['css'], ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

if ($atts['custom_links_target'] == 'true') {
	$atts['custom_links_target'] = '_blank';
} else {
	$atts['custom_links_target'] = '_self';
}

$i = 0;
?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
	<?php
	$images = $atts['images'];
	$custom_links = $atts['custom_links'];
	$custom_links_target = $atts['custom_links_target'];
	foreach ($images as $attach_id):
		$i++;
		$images_id = preg_replace('/[^\d]/', '', $attach_id);
		$images_src = wp_get_attachment_image_src($images_id, 'full');
		$images_alt = the_title_attribute(array('post' => $images_id, 'echo' => false));
		if ($images_src != '') {
			?>
			<div class='clients-item <?php echo esc_attr($gf_item_wrap) ?>'
				 style="opacity: <?php echo esc_attr($atts['opacity'] / 100) ?>;">
				<div class="clients-item-inner <?php echo esc_attr($bordered) ?>">
					<?php if (isset($custom_links[$i]) && $custom_links[$i] != ''): ?>
						<a title="<?php echo esc_attr($images_alt); ?>" href="<?php echo esc_url($custom_links[$i]) ?>"
						   target="<?php echo esc_attr($custom_links_target) ?>">
							<img alt="<?php echo esc_attr($images_alt) ?>" src="<?php echo esc_url($images_src[0]) ?>"/>
						</a>
					<?php else: ?>
						<img alt="<?php echo esc_attr($images_alt) ?>" src="<?php echo esc_url($images_src[0]) ?>"/>
					<?php endif; ?>
				</div>
			</div>
		<?php
		}
	endforeach; ?>
</div>