<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $layout
 * @var $columns
 * @var $max_items
 * @var $post_paging
 * @var $posts_per_page
 * @var $orderby
 * @var $order
 * @var $meta_key
 * @var $category
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Blog
 */

$layout = $columns = $max_items = $post_paging = $posts_per_page = $orderby = $order = $meta_key = $category = $el_class = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

global $wp_query;
$wrapper_classes = array(
	'archive-wrap',
	'clearfix',
	$this->getExtraClass($el_class)
);


$wrapper_classes[] = 'archive-' . $layout;

if (is_front_page()) {
	$paged = get_query_var('page') ? intval(get_query_var('page')) : 1;
} else {
	$paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
}

$args = array(
	'post_type' => 'post',
	'paged' => $paged,
	'ignore_sticky_posts' => true,
	'posts_per_page' => $max_items > 0 ? $max_items : $posts_per_page,
	'orderby' => $orderby,
	'order' => $order,
	'meta_key' => $orderby == 'meta_key' ? $meta_key : '',
);

if ($post_paging == 'all' && $max_items == -1) {
	$args['nopaging'] = true;
}

if (!empty($category)) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'category',
			'terms' => explode(',', $category),
			'field' => 'slug',
			'operator' => 'IN'
		)
	);
}
query_posts($args);

$blog_wrap_classes = array('blog-wrap clearfix');
if (in_array($layout, array('grid', 'masonry'))) {
	$page_layouts = &gf_get_page_layout_settings();
	$blog_wrap_classes[] = 'row';
	$blog_wrap_classes[] = 'columns-' . $columns;
	if ($page_layouts['has_sidebar']) {
		$blog_wrap_classes[] = 'columns-md-2';
	} else {
		$blog_wrap_classes[] = 'columns-md-' . $columns;
	}
	$blog_wrap_classes[] = 'columns-sm-2';
}

$item_class = array(
	'gf-item-wrap',
	'clearfix'
);
if ($layout == 'masonry') {
	$item_class[] = "post-grid";
} else {
	$item_class[] = "post-{$layout}";
}

$class_to_filter = implode(' ', $wrapper_classes);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

?>
    <div class="<?php echo esc_attr($css_class) ?>">
        <div class="<?php echo esc_attr(join(' ', $blog_wrap_classes)); ?>">
			<?php
			if (have_posts()) :
				// Start the Loop.
				while (have_posts()) : the_post();
					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part('templates/archive/content', $layout, array('class' =>$item_class));
				endwhile;
			else :
				// If no content, include the "No posts found" template.
				get_template_part('templates/archive/content', 'none');
			endif;
			?>
        </div>
		<?php if ($wp_query->max_num_pages > 1 && $max_items == -1) {
			get_template_part('templates/paging/' . $post_paging);
		} ?>
    </div>
<?php wp_reset_query(); ?>