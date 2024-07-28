<?php
// Do not allow directly accessing this file.
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

if (!class_exists('GF_Elements_Listing_Abstract', false)) {
	GSF()->loadFile(GF_PLUGIN_DIR . 'inc/abstracts/elementor-listing.class.php');
}


abstract class GF_Elements_Listing_Blog_Abstract extends GF_Elements_Listing_Abstract
{
	public $_atts = array();

	public $_query_args = array();

	public $_settings = array();

	public function prepare_display($atts = array(), $query_args = array(), $settings = array())
	{
		$this->_atts = wp_parse_args($atts, array(
			'posts_per_page' => 6,
			'max_items' => -1,
			'post_columns_gutter' => 30,
			'post_layout' => '',
			'image_size' => 'full',
			'post_paging' => 'none',
			'is_carousel' => false,
			'nav' => '',
			'dots' => '',
			'autoplay' => '',
			'loop' => '',
			'cat' => '',
			'tag' => '',
			'ids' => '',
			'columns' => array(
				'xl' => 3,
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		));

		$this->_atts['posts_per_page'] = absint($this->_atts['posts_per_page']) ? absint($this->_atts['posts_per_page']) : 6;
		$this->_atts['max_items'] = absint($this->_atts['max_items']) ? absint($this->_atts['max_items']) : -1;
		$this->_atts['post_columns_gutter'] = absint($this->_atts['post_columns_gutter']);

		if (!is_array($this->_atts['columns'])) {
			$this->_atts['columns'] = array(
				'xl' => $this->_atts['columns'],
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => ''
			);
		}

		$this->_atts['columns_xl'] = absint($this->_atts['columns']['xl']);
		$this->_atts['columns_lg'] = $this->_atts['columns']['lg'] == '' ? $this->_atts['columns_xl'] : absint($this->_atts['columns']['lg']);
		$this->_atts['columns_md'] = $this->_atts['columns']['md'] == '' ? $this->_atts['columns_lg'] : absint($this->_atts['columns']['md']);
		$this->_atts['columns_sm'] = $this->_atts['columns']['sm'] == '' ? $this->_atts['columns_md'] : absint($this->_atts['columns']['sm']);
		$this->_atts['columns'] = $this->_atts['columns']['xs'] == '' ? $this->_atts['columns_sm'] : absint($this->_atts['columns']['xs']);

		if (in_array($this->_atts['post_layout'], array('large-image'))) {
			$this->_atts['columns_xl'] = $this->_atts['columns_lg'] = $this->_atts['columns_md'] = $this->_atts['columns_sm'] = $this->_atts['columns'] = 1;
		}

		$this->prepare_settings($settings);
		$this->_query_args = $this->get_query_args($query_args, $this->_atts);
	}

	public function get_query_args($query_args, $atts)
	{
		$query_args = wp_parse_args($query_args, array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page' => $this->_atts['posts_per_page'],

			'order' => isset($atts['order']) ? $atts['order'] : 'desc',
			'orderby' => isset($atts['orderby']) ? $atts['orderby'] : 'date',
			'meta_key' => ('meta_value' == $atts['orderby'] || 'meta_value_num' == $atts['orderby']) ? $atts['meta_key'] : ''
		));

		switch ($atts['orderby']) {
			case 'menu_order':
				$query_args['orderby'] = 'menu_order title';
				break;
			case 'date':
				$query_args['orderby'] = 'date ID';
				break;
		}

		if (is_front_page()) {
			$paged = get_query_var('page') ? intval(get_query_var('page')) : 1;
		} else {
			$paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
		}

		$query_args['paged'] = $paged;

		if ($atts['post_paging'] === '') {
			$query_args['no_found_rows'] = 1;
		}

		if (!empty($atts['cat'])) {
			$query_args['category__in'] = array_map('absint', $atts['cat']);
		}

		if (!empty($atts['tag'])) {
			$query_args['tag__in'] = array_map('absint', $atts['tag']);
		}

		if (!empty($atts['ids'])) {
			$query_args['post__in'] = array_map('absint', $atts['ids']);
		}


		return apply_filters('gf_element_listing_query_args', $query_args, $atts);
	}


	public function prepare_settings($settings)
	{
		$this->_settings = wp_parse_args($settings, array(
			'post_columns_gutter' => $this->_atts['post_columns_gutter'],
			'post_layout' => $this->_atts['post_layout'],
			'post_paging' => $this->_atts['post_paging'],
			'image_size' => $this->_atts['image_size'],
			'post_columns' => array(
				'xl' => $this->_atts['columns_xl'],
				'lg' => $this->_atts['columns_lg'],
				'md' => $this->_atts['columns_md'],
				'sm' => $this->_atts['columns_sm'],
				'' => $this->_atts['columns'],
			),
		));
	}

	protected function register_layout_section_controls()
	{
		$this->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__('Layout', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->register_layout_controls();
		$this->register_post_count_control();
		$this->register_post_paging_controls();
		$this->end_controls_section();
	}

	protected function register_query_section_controls()
	{
		$this->start_controls_section(
			'section_query_section',
			[
				'label' => esc_html__('Query', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->register_cat_controls();
		$this->register_tag_controls();
		$this->register_post_ids_controls();
		$this->register_order_by_controls();
		$this->register_meta_key_controls();
		$this->register_order_controls();

		$this->end_controls_section();
	}

	protected function register_style_section_controls()
	{
		$this->register_style_title_section_controls();
		$this->register_style_meta_section_controls();
		$this->register_style_excerpt_section_controls();
	}

	protected function register_style_title_section_controls()
	{
		$this->start_controls_section(
			'section_design_title',
			[
				'label' => esc_html__('Title', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .entry-post-title',
			]
		);

		$this->add_control(
			'title_spacing',
			[
				'label' => esc_html__('Spacing', 'beyot-framework'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .entry-post-title' => 'margin-top: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->start_controls_tabs('title_color_tabs');

		$this->start_controls_tab('title_color_normal',
			[
				'label' => esc_html__('Normal', 'beyot-framework'),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .entry-post-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('title_color_hover',
			[
				'label' => esc_html__('Hover', 'beyot-framework'),
			]
		);


		$this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .entry-post-title:hover' => 'color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_style_meta_section_controls()
	{
		$this->start_controls_section(
			'section_design_meta',
			[
				'label' => esc_html__('Meta', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'selector' => '{{WRAPPER}} .entry-post-meta *,{{WRAPPER}} .entry-post-meta a',
			]
		);

		$this->add_control(
			'meta_spacing',
			[
				'label' => esc_html__('Spacing', 'beyot-framework'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .entry-post-meta' => 'margin-top: {{SIZE}}{{UNIT}};',
				]
			]
		);


		$this->start_controls_tabs('meta_color_tabs');

		$this->start_controls_tab('meta_color_normal',
			[
				'label' => esc_html__('Normal', 'beyot-framework'),
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .entry-post-meta *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('meta_color_hover',
			[
				'label' => esc_html__('Hover', 'beyot-framework'),
			]
		);


		$this->add_control(
			'meta_hover_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .entry-post-meta a:hover' => 'color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_style_excerpt_section_controls()
	{
		$this->start_controls_section(
			'section_design_excerpt',
			[
				'label' => esc_html__('Excerpt', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'selector' => '{{WRAPPER}} .entry-excerpt',
			]
		);

		$this->add_control(
			'excerpt_spacing',
			[
				'label' => esc_html__('Spacing', 'beyot-framework'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .entry-excerpt' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .entry-excerpt' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public function get_config_post_layout()
	{
		$config = apply_filters('g5p_elementor_post_layout', array(
			'large-image' => array(
				'label' => esc_html__('Large Image', 'beyot-framework'),
			),
			'grid' => array(
				'label' => esc_html__('Grid', 'beyot-framework'),
			),
			'masonry' => array(
				'label' => esc_html__('Masonry', 'beyot-framework'),
			),
		));


		$result = array();
		foreach ($config as $k => $v) {
			$result[$k] = $v['label'];
		}
		return $result;

	}

	public function archive_markup()
	{
		global $wp_query;
		$blog_inner = array('blog-wrap', 'clearfix', 'row');
		$columns = $this->get_bootstrap_columns($this->_settings['post_columns']);
		$layout = $this->_settings['post_layout'];
		$item_class = array(
			'gf-item-wrap',
			'clearfix',
			$columns
		);

		if ($layout == 'masonry') {
			$item_class[] = "post-grid";
		} else {
			$item_class[] = "post-{$layout}";
		}
		query_posts($this->_query_args);
		?>
        <div class="<?php echo esc_attr(join(' ', $blog_inner)); ?>">
			<?php
			if (have_posts()) :
				// Start the Loop.
				while (have_posts()) :
					the_post();
					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					?>
					<?php get_template_part('templates/archive/content', $layout, array('class' => $item_class)); ?>
				<?php
				endwhile;
			else :
				// If no content, include the "No posts found" template.
				get_template_part('templates/archive/content', 'none');
			endif;
			?>
        </div>
		<?php if ($wp_query->max_num_pages > 1 && $this->_settings['post_paging'] !== '') {
		get_template_part('templates/paging/' . $this->_settings['post_paging']);
	} ?>
		<?php
		wp_reset_query();
	}
}