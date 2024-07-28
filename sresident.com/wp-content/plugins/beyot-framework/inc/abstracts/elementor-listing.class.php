<?php
// Do not allow directly accessing this file.
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use \Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

abstract class GF_Elements_Listing_Abstract extends UBE_Abstracts_Elements
{

	public $_config = array();

	public function prepare_display($atts = array(), $config = array())
	{

		$this->_config = wp_parse_args($config, $this->_config);


		if (!empty($atts['post_layout'])) {
			$this->_config['layout_style'] = $atts['post_layout'];
		}

		if (!empty($atts['posts_per_page'])) {
			$this->_config['item_amount'] = absint($atts['posts_per_page']) ? absint($atts['posts_per_page']) : 6;
		}

		if (!empty($atts['image_size'])) {
			$this->_config['image_size'] = $atts['image_size'];
		}

		if (!empty($atts['post_paging'])) {
			$this->_config['show_paging'] = $atts['post_paging'];
		}

		if (!empty($atts['columns'])) {
			$this->_config = wp_parse_args($this->_config, $this->get_ere_columns($atts['columns']));
		}

		if (!empty($atts['include_heading']) && $atts['include_heading'] == 'true') {
			$this->_config['include_heading'] = 'true';
			$this->_config['heading_title'] = $atts['heading_title'];
			$this->_config['heading_sub_title'] = $atts['heading_sub_title'];
			if (!empty($atts['heading_text_align'])) {
				$this->_config['heading_text_align'] = $atts['heading_text_align'];
			}
		}

		if (!empty($atts['is_slider']) && $atts['is_slider'] == true) {
			$this->_config['show_paging'] = '';
			$this->_config['nav'] = '';
			$this->_config['autoplay'] = '';
			$this->_config['dots'] = $atts['dots'];
			if ($atts['autoplay'] == 'true') {
				$this->_config['autoplaytimeout'] = $atts['autoplay_timeout'];
				$this->_config['autoplay'] = 'true';
			}
			if ($atts['nav'] == 'true') {
				$this->_config['nav'] = $atts['nav'];
				$this->_config['nav_position'] = $atts['nav_position'];
			}
			if (!empty($atts['loop']) && $atts['loop'] == 'true') {
				$this->_config['loop'] = $atts['loop'];
			}
		}
	}

	public function get_shortcode($shortcode, $config = array())
	{
		if (empty($shortcode)) {
			return;
		}

		$attribute = '';
		foreach ($config as $key => $value) {
			$attribute .= ' ' . $key . '="' . $value . '"';
		}

		return '[' . $shortcode . $attribute . ']';
	}

	protected function register_carousel_section_controls($condition)
	{
		$this->start_controls_section(
			'section_carousel',
			[
				'label' => esc_html__('Carousel Options', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => $condition,
			]
		);

		$this->register_dots_control();
		$this->register_nav_control();
		$this->register_nav_position_control();
		$this->register_autoplay_control();
		$this->register_autoplay_timeout_control();
		$this->register_loop_control();

		$this->end_controls_section();
	}

	protected function register_dots_control()
	{
		$this->add_control(
			'dots',
			[
				'label' => esc_html__('Show Pagination', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'on',
				'default' => 'on',
			]
		);
	}

	protected function register_nav_control()
	{
		$this->add_control(
			'nav',
			[
				'label' => esc_html__('Show Navigation', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);
	}

	protected function register_nav_position_control()
	{
		$this->add_control(
			'nav_position',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Navigation Position', 'beyot-framework'),
				'options' => $this->get_nav_position(),
				'default' => 'center',
				'condition' => [
					'nav' => 'true',
				],
			]
		);
	}

	protected function register_autoplay_control()
	{
		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__('Autoplay Enable', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Enable', 'beyot-framework'),
				'label_off' => esc_html__('Disable', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);
	}

	protected function register_autoplay_timeout_control()
	{
		$this->add_control(
			'autoplay_timeout',
			[
				'label' => esc_html__('Autoplay Timeout', 'beyot-framework'),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
				'condition' => [
					'autoplay' => 'true',
				],
			]);
	}

	protected function register_loop_control()
	{
		$this->add_control(
			'loop',
			[
				'label' => esc_html__('Loop', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Enable', 'beyot-framework'),
				'label_off' => esc_html__('Disable', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);
	}

	protected function register_image_size_section_controls()
	{
		$this->start_controls_section(
			'section_image_size',
			[
				'label' => esc_html__('Image Size', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image_size',
			[
				'label' => esc_html__('Image size', 'beyot-framework'),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 300x400).', 'beyot-framework'),
				'default' => 'full',
			]
		);

		$this->end_controls_section();
	}

	protected function register_max_items_control()
	{
		$this->add_control(
			'max_items',
			[
				'label' => esc_html__('Number of posts', 'beyot-framework'),
				'type' => Controls_Manager::NUMBER,
				'description' => esc_html__('Enter number of posts to display.', 'beyot-framework'),
				'default' => '-1',
			]
		);
	}

	protected function register_post_count_control()
	{
		$this->add_control(
			'posts_per_page',
			[
				'label' => esc_html__('Posts Per Page', 'beyot-framework'),
				'type' => Controls_Manager::NUMBER,
				'description' => esc_html__('Enter number of posts per page you want to display. Default 6', 'beyot-framework'),
				'default' => '',
			]
		);
	}

	protected function register_cat_controls()
	{
		$this->add_control(
			'cat',
			[
				'type' => UBE_Controls_Manager::AUTOCOMPLETE,
				'multiple' => true,
				'select_type' => 'term',
				'label' => esc_html__('Narrow Category', 'beyot-framework'),
				'label_block' => true,
				'description' => esc_html__('Enter categories by names to narrow output.', 'beyot-framework'),
				'default' => '',
			]
		);

	}

	protected function register_tag_controls()
	{
		$this->add_control(
			'tag',
			[
				'type' => UBE_Controls_Manager::AUTOCOMPLETE,
				'multiple' => true,
				'select_type' => 'term',
				'data_args' => array(
					'taxonomy' => 'post_tag'
				),
				'label' => esc_html__('Narrow Tag', 'beyot-framework'),
				'label_block' => true,
				'description' => esc_html__('Enter tags by names to narrow output.', 'beyot-framework'),
				'default' => '',
			]
		);
	}

	protected function register_post_ids_controls()
	{
		$this->add_control(
			'ids',
			[
				'type' => UBE_Controls_Manager::AUTOCOMPLETE,
				'multiple' => true,
				'label' => esc_html__('Narrow Post', 'beyot-framework'),
				'label_block' => true,
				'description' => esc_html__('Enter List of Posts', 'beyot-framework'),
				'default' => '',
			]
		);
	}

	protected function register_order_by_controls()
	{
		$this->add_control(
			'orderby',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Order by', 'beyot-framework'),
				'description' => esc_html__('Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'beyot-framework'),
				'options' => array(
					'date' => esc_html__('Date', 'beyot-framework'),
					'ID' => esc_html__('Order by post ID', 'beyot-framework'),
					'author' => esc_html__('Author', 'beyot-framework'),
					'title' => esc_html__('Title', 'beyot-framework'),
					'modified' => esc_html__('Last modified date', 'beyot-framework'),
					'parent' => esc_html__('Post/page parent ID', 'beyot-framework'),
					'comment_count' => esc_html__('Number of comments', 'beyot-framework'),
					'menu_order' => esc_html__('Menu order/Page Order', 'beyot-framework'),
					'meta_value' => esc_html__('Meta value', 'beyot-framework'),
					'meta_value_num' => esc_html__('Meta value number', 'beyot-framework'),
					'rand' => esc_html__('Random order', 'beyot-framework'),
				),
				'default' => 'date',
			]
		);
	}

	protected function register_meta_key_controls()
	{
		$this->add_control(
			'meta_key',
			[
				'label' => esc_html__('Meta key', 'beyot-framework'),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__('Input meta key for grid ordering', 'beyot-framework'),
				'default' => '',
				'condition' => [
					'orderby' => ['meta_value', 'meta_value_num'],
				],
			]
		);
	}

	protected function register_columns_responsive_section_controls($condition)
	{
		$this->start_controls_section(
			'section_responsive',
			[
				'label' => esc_html__('Responsive', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => $condition,
			]
		);
		$this->add_control(
			'columns',
			[
				'type' => UBE_Controls_Manager::BOOTSTRAP_RESPONSIVE,
				'label' => esc_html__('Columns', 'beyot-framework'),
				'data_type' => 'select',
				'options' => $this->get_post_columns(),
				'default' => '3',
				'condition' => $condition,
			]
		);

		$this->end_controls_section();
	}

	protected function register_post_paging_controls()
	{
		$this->add_control(
			'post_paging',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Post Paging', 'beyot-framework'),
				'description' => esc_html__('Specify your post paging mode.', 'beyot-framework'),
				'options' => $this->get_post_paging(),
				'default' => '',
			]
		);
	}

	public function get_post_columns($inherit = false)
	{

		$config = apply_filters('gf_options_post_columns', array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6'
		));

		if ($inherit) {
			$config = array(
					'' => esc_html__('Inherit', 'beyot-framework')
				) + $config;
		}

		return $config;
	}

	public function get_nav_position()
	{
		return apply_filters('gf_elementor_nav_position', array(
			'center' => esc_html__('Center', 'beyot-framework'),
			'bottom-center' => esc_html__('Bottom Center', 'beyot-framework'),
		));
	}

	public function get_post_paging()
	{
		$config = apply_filters('gf_elementor_post_paging', array(
			'' => array(
				'label' => esc_html__('No Pagination', 'beyot-framework'),
			),
			'navigation' => array(
				'label' => esc_html__('Navigation', 'beyot-framework'),
			),
			'load-more' => array(
				'label' => esc_html__('Load More', 'beyot-framework'),
			),
			'infinite-scroll' => array(
				'label' => esc_html__('Infinite Scroll', 'beyot-framework'),
			),
		));


		$result = array();
		foreach ($config as $k => $v) {
			$result[$k] = $v['label'];
		}
		return $result;

	}


	protected function register_layout_controls()
	{
		$this->add_control(
			'post_layout',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Layout', 'beyot-framework'),
				'description' => esc_html__('Specify your layout', 'beyot-framework'),
				'options' => $this->get_config_post_layout(),
				'default' => 'grid',
			]
		);
	}

	public function get_config_post_layout()
	{
		return array();
	}

	protected function register_columns_gutter_controls($condition = array())
	{
		$this->add_control(
			'post_columns_gutter',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Columns Gutter', 'beyot-framework'),
				'description' => esc_html__('Specify your horizontal space between item.', 'beyot-framework'),
				'options' => $this->get_post_columns_gutter(),
				'default' => 'col-gap-30',
				'condition' => $condition,
			]
		);
	}

	protected function register_order_controls()
	{
		$this->add_control(
			'order',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Sorting', 'beyot-framework'),
				'description' => esc_html__('Select sorting order.', 'beyot-framework'),
				'options' => array(
					'DESC' => esc_html__('Descending', 'beyot-framework'),
					'ASC' => esc_html__('Ascending', 'beyot-framework'),
				),
				'default' => 'DESC',
			]
		);
	}

	protected function register_show_heading_control()
	{
		$this->add_control(
			'include_heading',
			[
				'label' => esc_html__('Heading', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);
	}

	protected function register_include_heading_controls()
	{
		$this->start_controls_section(
			'section_heading',
			[
				'label' => esc_html__('Heading', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'include_heading' => 'true',
				],
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => esc_html__('Title', 'beyot-framework'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Enter your title', 'beyot-framework'),
				'default' => 'FIND A PROPERTY',
			]
		);
		$this->add_control(
			'heading_sub_title',
			[
				'label' => esc_html__('Sub Title', 'beyot-framework'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Enter your sub title', 'beyot-framework'),
				'default' => 'BROWSE OUR DREAM HOUSE',
			]
		);

		$this->add_control(
			'heading_text_align',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Text Align', 'beyot-framework'),
				'options' => array(
					'text-left' => esc_html__('Left', 'beyot-framework'),
					'text-right' => esc_html__('Right', 'beyot-framework'),
					'text-center' => esc_html__('Center', 'beyot-framework'),
				),
				'default' => 'text-left',
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_heading_section_controls()
	{
		$this->start_controls_section(
			'ere_section_design_heading',
			[
				'label' => esc_html__('Heading', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'include_heading' => 'true',
				],
			]
		);


		$this->add_control(
			'ere_heading_title',
			[
				'label' => esc_html__('Heading', 'beyot-framework'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'ere_heading_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ere-heading h2' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'selector' => '{{WRAPPER}} .ere-heading h2',
			]
		);

		$this->add_control(
			'ere_heading_desc',
			[
				'label' => esc_html__('Description', 'beyot-framework'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ere_heading_desc_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ere-heading p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_desc_typography',
				'selector' => '{{WRAPPER}} .ere-heading p',
			]
		);

		$this->add_control(
			'ere_heading_desc_spacing',
			[
				'label' => esc_html__('Spacing', 'beyot-framework'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ere-heading p' => 'margin-top: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'ere_heading_separator',
			[
				'label' => esc_html__('Separator', 'beyot-framework'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ere_heading_separator_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ere-heading:after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ere_heading_desc_separator',
			[
				'label' => esc_html__('Spacing', 'beyot-framework'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ere-heading:after' => 'margin-top: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();
	}

	public function get_post_columns_gutter()
	{
		$config = apply_filters('gsf_options_post_columns_gutter', array(
			'col-gap-0' => esc_html__('None', 'beyot-framework'),
			'col-gap-10' => '10px',
			'col-gap-20' => '20px',
			'col-gap-30' => '30px',
		));

		return $config;
	}

	public function get_name_by_id($id = array(), $taxonomy = '')
	{
		if ($taxonomy == '') {
			return '';
		}
		$name = $step = '';
		$count = 0;
		foreach ($id as $k => $v) {
			$term = get_term_by('id', $v, $taxonomy);
			if (is_a( $term, 'WP_Term' )) {
				if ($count > 0) {
					$step = ',';
				}
				$name .= $step . $term->name;
				$count++;
			}
		}
		return $name;
	}

	public function get_ere_columns($columns = array())
	{
		$config = array();
		$default = array(
			'xl' => '3',
			'lg' => '2',
			'md' => '2',
			'sm' => '1',
			'xs' => '1',
		);

		$columns = wp_parse_args($columns, $default);
		$config['items'] = absint($columns['xl']);
		$config['items_md'] = $columns['lg'] == '' ? $config['items'] : absint($columns['lg']);
		$config['items_sm'] = $columns['md'] == '' ? $config['items_md'] : absint($columns['md']);
		$config['items_xs'] = $columns['sm'] == '' ? $config['items_sm'] : absint($columns['sm']);
		$config['items_mb'] = $columns['xs'] == '' ? $config['items_xs'] : absint($columns['xs']);
		return $config;

	}

	public function get_bootstrap_columns($columns = array())
	{
		$default = array(
			'xl' => 2,
			'lg' => 2,
			'md' => 1,
			'sm' => 1,
			'' => 1,
		);
		$columns = wp_parse_args($columns, $default);
		$classes = array();
		foreach ($columns as $key => $value) {
			if ($key === 0) {
				$key = '';
			}
			if ($key !== '') {
				$key = "-{$key}";
			}
			if ($value > 0) {
				if ($value == 5) {
					$classes[$key] = "col{$key}-12-5";
				} else {
					$classes[$key] = "col{$key}-" . (12 / $value);
				}
			}
		}
		return implode(' ', array_filter($classes));
	}
}
