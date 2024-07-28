<?php
/**
 * The template for displaying archive
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */

global $wp_query;
$post_layouts = &g5plus_get_post_layout_settings();
$blog_wrap_classes = array('blog-wrap clearfix');
if (in_array($post_layouts['layout'], array('grid', 'masonry')) && !$post_layouts['slider']) {
	$page_layouts = &g5plus_get_page_layout_settings();
	$blog_wrap_classes[] = 'row';
	$blog_wrap_classes[] = 'columns-' . $post_layouts['columns'];
	if ($page_layouts['has_sidebar']) {
		$blog_wrap_classes[] = 'columns-md-2';
	} else {
		$blog_wrap_classes[] = 'columns-md-' . $post_layouts['columns'];
	}

	$blog_wrap_classes[] = 'columns-sm-2';
}
$item_class = array(

	'clearfix'
);
if ($post_layouts['layout'] == 'masonry') {
	$item_class[] = "post-grid";
} else {
	$item_class[] = "post-{$post_layouts['layout']}";
}
if ($post_layouts['layout'] == 'grid' || $post_layouts['layout'] == 'masonry') {
	$item_class[] = 'gf-item-wrap';
}

?>
    <div class="<?php echo esc_attr(join(' ', $blog_wrap_classes)); ?>">
		<?php if (have_posts()) : ?>
			<?php
			// Start the Loop.
			while (have_posts()) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part('templates/archive/content', $post_layouts['layout'], array('class' => $item_class));

				// End the loop.
			endwhile;

		// If no content, include the "No posts found" template.
		else :
			get_template_part('templates/archive/content', 'none');
			?>

		<?php endif;
		?>
    </div>
<?php if ($wp_query->max_num_pages > 1) {
	get_template_part('templates/paging/' . $post_layouts['paging']);
}