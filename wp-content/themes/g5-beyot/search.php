<?php
/**
 * Created by PhpStorm.
 * User: WIN8.1X64
 * Date: 04/09/2016
 * Time: 09:41 AM
 */
get_header();
global $wp_query;
$total_results = $wp_query->found_posts;
?>
	<div class="archive-search-wrap">
		<div class="archive-search-result">
			<h3 class="text-uppercase"><?php printf(esc_html__('%s SEARCH RESULTS FOR: %s', 'g5-beyot'), $total_results,  get_search_query()); ?></h3>
		</div>
		<div class="archive-search-box">
			<div class="g5plus-heading mg-bottom-50 hd-dark">
				<h3><?php esc_html_e( 'NEW SEARCH','g5-beyot' )?></h3>
				<p><?php esc_html_e('If you are not happy with the results below please do another search', 'g5-beyot') ?></p>
			</div>
			<div class="search-form-lg">
				<?php get_search_form(); ?>
			</div>
		</div>
		<?php if (have_posts()) : ?>
			<div class="archive-search-wrap-inner">
				<?php
				while (have_posts()) : the_post();
					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					g5plus_get_template('archive/content-search');
				endwhile;
				?>
			</div>
		<?php endif; ?>
		<?php
		global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) :
			?>
			<div class="blog-paging-default">
				<?php g5plus_get_template('paging/navigation'); ?>
			</div>
		<?php endif;?>
	</div>
<?php get_footer();