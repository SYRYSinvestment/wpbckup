<?php
/**
 * The template for displaying paging style load more
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */
global $wp_query;
$link = get_next_posts_page_link($wp_query->max_num_pages);
if (empty($link)) return;
?>
<div class="paging-navigation clearfix text-center">
	<button data-href="<?php echo esc_url($link); ?>" type="button"  data-loading-text="<span class='fa fa-spinner fa-spin'></span> <?php esc_html_e('Loading...','g5-beyot'); ?>" class="blog-load-more b">
		<?php esc_html_e('Load More','g5-beyot'); ?>
	</button>
</div>

