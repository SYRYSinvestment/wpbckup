<?php
/**
 * Search ajax call back
 * *******************************************************
 */
if (!function_exists('g5plus_result_search_callback')) {
	function g5plus_result_search_callback()
	{
		$posts_per_page = g5plus_get_option('search_popup_result_amount', 8);
		if (!$posts_per_page) {
			$posts_per_page = 8;
		}

		$search_popup_post_type = g5plus_get_option('search_popup_post_type', array());
		$post_type = array();
		foreach ($search_popup_post_type as $key => $value) {
			if ($value == 1) {
				$post_type[] = $key;
			}
		}

		$keyword = $_REQUEST['keyword'];

		$search_query = array(
			's'              => $keyword,
			'order'          => 'DESC',
			'orderby'        => 'date',
			'post_status'    => 'publish',
			'posts_per_page' => $posts_per_page + 1,
		);
		if ($post_type) {
			$search_query['post_type'] = $post_type;
		}
		$search = new WP_Query($search_query);
		$count = 0;
		ob_start();
		?>
		<ul>
			<?php if ($search && count($search->posts) > 0):; ?>
				<?php foreach ($search->posts as $post): ?>
					<?php if ($count < $posts_per_page): ?>
						<li class="<?php echo esc_attr($count == 0 ? 'selected' : '')?>"><a
								href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html($post->post_title); ?></a>
							<span class="date"><i class="fa fa-calendar"></i> <?php echo get_the_date('', $post); ?></span></li>
					<?php endif; ?>
					<?php $count++; ?>
				<?php endforeach; ?>
			<?php else:; ?>
				<li class="nothing"><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'g5-beyot'); ?></li>
			<?php endif; ?>
		</ul>
		<?php if ($count == $posts_per_page + 1): ?>
		<div class="view-more">
			<a href="<?php echo esc_url(home_url('/') . '?s=' . $keyword); ?>"><?php esc_html_e('View More', 'g5-beyot'); ?></a>
		</div>
	<?php endif; ?>
		<?php
		echo ob_get_clean();
		die(); // this is required to return a proper result
	}

	add_action('wp_ajax_nopriv_result_search', 'g5plus_result_search_callback');
	add_action('wp_ajax_result_search', 'g5plus_result_search_callback');

}