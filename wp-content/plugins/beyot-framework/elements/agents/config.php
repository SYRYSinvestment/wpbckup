<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

if (!class_exists('GF_Elements_Listing_Abstract', false)) {
	GSF()->loadFile(GF_PLUGIN_DIR . 'inc/abstracts/elementor-listing.class.php');
}

class UBE_Element_Beyot_Agents extends GF_Elements_Listing_Abstract
{
	public function get_name()
	{
		return 'beyot-agents';
	}

	public function get_ube_icon()
	{
		return 'eicon-person';
	}

	public function get_title()
	{
		return esc_html__('Beyot Agents', 'beyot-framework');
	}

	public function get_ube_keywords()
	{
		return array('agents', 'ere', 'essential real estate', 'cpt', 'item', 'loop', 'query', 'cards', 'custom post type', 'ube', 'g5');
	}

	public function get_style_depends()
	{
		return array(ERE_PLUGIN_PREFIX . 'agent');
	}

	public function get_script_depends()
	{
		return array(GF_PLUGIN_PREFIX . 'agents');
	}

	protected function register_controls()
	{
		$this->register_layout_section_controls();
		$this->register_image_size_section_controls();
		$this->register_query_section_controls();
		$this->register_carousel_section_controls(array('post_layout' => ['agent-slider']));
		$this->register_columns_responsive_section_controls(array('post_layout' => ['agent-grid','agent-slider']));
		$this->register_style_section_controls();
	}

	public function render()
	{
		gf_get_template_element('agents/template.php', array(
			'element' => $this
		));
	}

	protected function register_columns_responsive_section_controls($condition)
	{
		parent::register_columns_responsive_section_controls($condition);
		$this->update_control('columns', [
			'mobile_breakpoint' => '480'
		]);
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

	protected function register_style_section_controls()
	{
		$this->register_style_title_section_controls();
		$this->register_style_position_section_controls();
		$this->register_style_social_section_controls();
	}

	protected function register_layout_controls()
	{
		parent::register_layout_controls();
		$this->update_control('post_layout', [
			'default' => 'agent-grid'
		]);
	}

	protected function register_image_size_section_controls()
	{
		parent::register_image_size_section_controls();
		$this->update_control('image_size', [
			'default' => '270x340',
		]);
	}

	protected function register_query_section_controls()
	{
		$this->start_controls_section(
			'section_query',
			[
				'label' => esc_html__('Query', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->register_agency_controls();

		$this->end_controls_section();


	}

	protected function register_post_paging_controls()
	{
		$this->add_control(
			'post_paging',
			[
				'label' => esc_html__('Post Paging', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Enable', 'beyot-framework'),
				'label_off' => esc_html__('Disable', 'beyot-framework'),
				'return_value' => true,
				'default' => '',
			]
		);
	}

	protected function register_agency_controls()
	{
		$this->add_control(
			'agency',
			[
				'type' => UBE_Controls_Manager::AUTOCOMPLETE,
				'multiple' => true,
				'select_type' => 'term',
				'data_args' => array(
					'taxonomy' => 'agency'
				),
				'label' => esc_html__('Narrow Agency', 'beyot-framework'),
				'label_block' => true,
				'description' => esc_html__('Enter agency by names to narrow output (Note: only listed agency will be displayed, divide agency with linebreak (Enter)).', 'beyot-framework'),
				'default' => '',
			]
		);
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
				'selector' => '{{WRAPPER}} .ere-agent h2 a',
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
					'{{WRAPPER}} .ere-agent h2' => 'margin-top: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .ere-agent h2 a' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .ere-agent h2 a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_style_social_section_controls()
	{
		$this->start_controls_section(
			'section_design_social',
			[
				'label' => esc_html__('Social', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'social_fs',
			[
				'label' => esc_html__('Font Size', 'beyot-framework'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ere-agent .agent-social a i' => 'font-size: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'social_spacing',
			[
				'label' => esc_html__('Spacing', 'beyot-framework'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ere-agent .agent-social a i' => 'margin-top: {{SIZE}}{{UNIT}};',
				]
			]
		);


		$this->start_controls_tabs('social_color_tabs');

		$this->start_controls_tab('social_color_normal',
			[
				'label' => esc_html__('Normal', 'beyot-framework'),
			]
		);

		$this->add_control(
			'social_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ere-agent .agent-social a i' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('social_color_hover',
			[
				'label' => esc_html__('Hover', 'beyot-framework'),
			]
		);


		$this->add_control(
			'social_hover_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ere-agent .agent-social a i:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_style_position_section_controls()
	{
		$this->start_controls_section(
			'section_design_position',
			[
				'label' => esc_html__('Position', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'position_typography',
				'selector' => '{{WRAPPER}} .ere-agent span',
			]
		);

		$this->add_control(
			'position_spacing',
			[
				'label' => esc_html__('Spacing', 'beyot-framework'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ere-agent span' => 'margin-top: {{SIZE}}{{UNIT}}; display:inline-block;',
				],
			]
		);

		$this->add_control(
			'position_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ere-agent span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public function get_nav_position()
	{
		return apply_filters('gf_agents_nav_position', array(
			'center' => esc_html__('Center', 'beyot-framework'),
			'top-right' => esc_html__('Top Right', 'beyot-framework'),
		));
	}

	public function get_config_post_layout()
	{
		$config = apply_filters('gf_elementor_agents_layout', array(
			'agent-grid' => array(
				'label' => esc_html__('Grid', 'beyot-framework'),
			),
			'agent-list' => array(
				'label' => esc_html__('List', 'beyot-framework'),
			),
			'agent-slider' => array(
				'label' => esc_html__('Carousel', 'beyot-framework'),
			),
		));


		$result = array();
		foreach ($config as $k => $v) {
			$result[$k] = $v['label'];
		}
		return $result;

	}
}