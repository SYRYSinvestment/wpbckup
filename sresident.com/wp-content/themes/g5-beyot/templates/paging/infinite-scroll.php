<?php
/**
 * The template for displaying paging style infinite scroll
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */
global $wp_query;
$link = get_next_posts_page_link($wp_query->max_num_pages);
if (empty($link)) return;
?>
<nav id="infinite_scroll_button">
	<a href="<?php echo esc_url($link); ?>"></a>
</nav>
<div id="infinite_scroll_loading" class="text-center infinite-scroll-loading"></div>
