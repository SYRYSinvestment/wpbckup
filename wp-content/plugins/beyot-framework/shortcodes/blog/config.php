<?php
return array(
	'base' => 'g5plus_blog',
	'name' => esc_html__('Blog','beyot-framework'),
	'icon' => 'fa fa-file-text',
	'category' => GF_SHORTCODE_CATEGORY,
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout', 'beyot-framework'),
			'param_name' => 'layout',
			'value' => array(
				esc_html__('Large Image','beyot-framework') => 'large-image',
				esc_html__('Grid','beyot-framework') => 'grid',
				esc_html__('Masonry', 'beyot-framework' ) => 'masonry',
			),
			'admin_label' => true,
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns', 'beyot-framework'),
			'param_name' => 'columns',
			'value' => array('2' => 2 , '3' => 3),
			'dependency' => array('element' => 'layout', 'value' => array('masonry','grid') ),
		),

		array(
			'type' => 'number',
			'heading' => esc_html__('Number of posts', 'beyot-framework' ),
			'description' => esc_html__('Enter number of posts to display.', 'beyot-framework' ),
			'param_name' => 'max_items',
			'value' => -1,
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Post Paging', 'beyot-framework'),
			'param_name' => 'post_paging',
			'value' => array(
				esc_html__('Show all', 'beyot-framework') => 'all',
				esc_html__('Navigation', 'beyot-framework') => 'navigation',
				esc_html__('Load More', 'beyot-framework') => 'load-more',
				esc_html__('Infinite Scroll', 'beyot-framework') => 'infinite-scroll',
			),
			'std' => 'all',
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency' => array('element' => 'max_items','value' => '-1'),
		),

		array(
			"type" => "number",
			"heading" => esc_html__("Posts per page", 'beyot-framework'),
			"param_name" => "posts_per_page",
			"value" => get_option('posts_per_page'),
			"description" => esc_html__('Number of items to show per page', 'beyot-framework'),
			'dependency' => array('element' => 'post_paging','value' => array('navigation', 'load-more', 'infinite-scroll')),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Order by', 'beyot-framework'),
			'param_name' => 'orderby',
			'value' => array(
				esc_html__('Date', 'beyot-framework') => 'date',
				esc_html__('Order by post ID', 'beyot-framework') => 'ID',
				esc_html__('Author', 'beyot-framework') => 'author',
				esc_html__('Title', 'beyot-framework') => 'title',
				esc_html__('Last modified date', 'beyot-framework') => 'modified',
				esc_html__('Post/page parent ID', 'beyot-framework') => 'parent',
				esc_html__('Number of comments', 'beyot-framework') => 'comment_count',
				esc_html__('Menu order/Page Order', 'beyot-framework') => 'menu_order',
				esc_html__('Meta value', 'beyot-framework') => 'meta_value',
				esc_html__('Meta value number', 'beyot-framework') => 'meta_value_num',
				esc_html__('Random order', 'beyot-framework') => 'rand',
			),
			'description' => esc_html__('Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'beyot-framework'),
			'group' => esc_html__('Data Settings', 'beyot-framework'),
			'param_holder_class' => 'vc_grid-data-type-not-ids',
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Sorting', 'beyot-framework'),
			'param_name' => 'order',
			'group' => esc_html__('Data Settings', 'beyot-framework'),
			'value' => array(
				esc_html__('Descending', 'beyot-framework') => 'DESC',
				esc_html__('Ascending', 'beyot-framework') => 'ASC',
			),
			'param_holder_class' => 'vc_grid-data-type-not-ids',
			'description' => esc_html__('Select sorting order.', 'beyot-framework'),
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__('Meta key', 'beyot-framework'),
			'param_name' => 'meta_key',
			'description' => esc_html__('Input meta key for grid ordering.', 'beyot-framework'),
			'group' => esc_html__('Data Settings', 'beyot-framework'),
			'param_holder_class' => 'vc_grid-data-type-not-ids',
			'dependency' => array(
				'element' => 'orderby',
				'value' => array('meta_value', 'meta_value_num'),
			),
		),
		gf_vc_map_add_narrow_category(),
		gf_vc_map_add_extra_class()
	)
);