<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $is_slider
 * @var $nav
 * @var $dots
 * @var $autoplay
 * @var $hover_effect
 * @var $images
 * @var $columns
 * @var $image_size
 * @var $columns_gap
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $css
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Gallery
 */
$is_slider = $nav = $dots = $autoplay= $hover_effect = $images = $columns = $image_size
	= $columns_gap = $css_animation = $animation_duration = $animation_delay = $css = $el_class = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);

extract($atts);

$images = explode(',', $images);

$wrapper_attributes = array();
$wrapper_styles = array();

$owl_attributes = array();
$wrapper_classes = array(
	'g5plus-gallery',
	'clearfix',
	'text-center',
	$columns_gap,
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation($css_animation)
);

$gallery_item_class = array('gf-gallery-item');
$owl_attribute = array();
$owl_class = array();
if($columns_gap == 'col-gap-30') {
	$col_gap = 30;
} else {
	$col_gap = 0;
}
if($is_slider) {
	$owl_class[] = 'owl-carousel';
	$owl_attributes = array(
		'"dots": '.($dots ? 'true' : 'false'),
		'"nav": '. ($nav ? 'true' : 'false'),
		'"autoplay": ' . ($autoplay ? 'true' : 'false'),
		'"responsive": {"0" : {"items" : 1, "margin": 0}, "481" : {"items" : '. (($columns >= 2) ? '2' : $columns) .
			', "margin": '. (($columns >= 2) ? $col_gap : '0') .'}, "768" : {"items" : '. (($columns >= 3) ? '3' : $columns) .
			', "margin": '.$col_gap.'}, "1200" : {"items" : '. $columns .', "margin": '.$col_gap.'}}'
	);
	$owl_attribute[] = "data-plugin-options='{". implode(', ', $owl_attributes) ."}'";
} else {
	$wrapper_classes[] = 'row';
	$wrapper_classes[] = 'columns-'.$columns;
	$wrapper_classes[] = 'columns-md-'.$columns;
	$wrapper_classes[] = 'columns-sm-'.(($columns == 2)? '2': '3');
	$wrapper_classes[] = 'columns-xs-2';
	$gallery_item_class[] = 'gf-item-wrap';
	if($columns_gap=='col-gap-30')
		$gallery_item_class[] = 'mg-bottom-30';
}
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

$gallery_id = rand();
?>
<div class="<?php echo esc_attr($css_class); ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
	<?php if($is_slider == true): ?>
		<div class="<?php echo implode(' ', $owl_class ) ?>" <?php echo implode(' ', $owl_attribute ) ?>>
	<?php endif;?>
			<?php foreach ($images as $image_id):
				$attach_id = preg_replace( '/[^\d]/', '', $image_id );
				$image_src = g5plus_get_image_src($attach_id, $image_size);
				$image_full = wp_get_attachment_image_src( $attach_id, 'full' );
				if(sizeof( $image_full ) > 0) {
					$image_full = $image_full[0];
				}
				$image_thumb = wp_get_attachment_image_src($attach_id);
				$image_thumb_link = '';
				if (sizeof($image_thumb) > 0) {
					$image_thumb_link = $image_thumb['0'];
				} ?>
				<div class="<?php echo join(' ', $gallery_item_class); ?>">
					<div class="gf-gallery-inner <?php echo esc_attr( $hover_effect ) ?>">
						<a href="<?php echo esc_url($image_full) ?>"
						   data-thumb-src="<?php echo esc_url( $image_thumb_link ); ?>" data-rel="lightGallery" data-gallery-id="<?php echo esc_html( $gallery_id ) ?>">
							<i class="fa fa-search"></i>
						</a>
						<div class="effect-content">
							<img src="<?php echo esc_url($image_src) ?>" alt="<?php the_title(); ?>"
							     title="<?php the_title(); ?>">
						</div>
					</div>
				</div>
			<?php endforeach; ?>
	<?php if($is_slider == true): ?>
		</div>
	<?php endif; ?>
</div>
