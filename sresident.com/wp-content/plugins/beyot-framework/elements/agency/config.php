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

class UBE_Element_Beyot_Agency extends GF_Elements_Listing_Abstract
{
	public function get_name()
	{
		return 'beyot-agency';
	}

	public function get_ube_icon()
	{
		return 'eicon-person';
	}

	public function get_title()
	{
		return esc_html__('Beyot Agency', 'beyot-framework');
	}

	public function get_ube_keywords()
	{
		return array('agency', 'ere', 'essential real estate', 'cpt', 'item', 'loop', 'query', 'cards', 'custom post type', 'ube', 'g5');
	}

	public function get_style_depends()
	{
		return array(ERE_PLUGIN_PREFIX . 'agency');
	}

	protected function register_controls()
	{
		$this->register_general_section_controls();
		$this->register_include_heading_controls();
		$this->register_style_heading_section_controls();
		$this->register_style_title_section_controls();
		$this->register_style_position_section_controls();
		$this->register_style_excerpt_section_controls();
		$this->register_style_social_section_controls();
		$this->register_style_information_section_controls();
	}

	public function render()
	{
		gf_get_template_element('agency/template.php', array(
			'element' => $this
		));
	}

	public function register_general_section_controls()
	{
		$this->start_controls_section(
			'section_general',
			[
				'label' => esc_html__('General', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->register_post_count_control();
		$this->register_show_heading_control();
		$this->register_post_paging_controls();

		$this->end_controls_section();
	}

	protected function register_post_paging_controls()
	{
		$this->add_control(
			'post_paging',
			[
				'label' => esc_html__('Paging', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
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
				'selector' => '{{WRAPPER}} .ere-agency .agency-title a',
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
					'{{WRAPPER}} .ere-agency .agency-title a' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .ere-agency .agency-title a:hover' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .agency-position',
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
					'{{WRAPPER}} .agency-position' => 'margin-top: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->start_controls_tabs('position_color_tabs');

		$this->start_controls_tab('position_color_normal',
			[
				'label' => esc_html__('Normal', 'beyot-framework'),
			]
		);

		$this->add_control(
			'position_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .agency-position' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('position_color_hover',
			[
				'label' => esc_html__('Hover', 'beyot-framework'),
			]
		);


		$this->add_control(
			'position_hover_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .agency-position:hover' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .agency-excerpt',
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .agency-excerpt' => 'color: {{VALUE}};',
				],
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
					'{{WRAPPER}} .agency-excerpt' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

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
					'{{WRAPPER}} .ere-agency .agency-social a' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .ere-agency .agency-social a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .ere-agency .agency-social a' => 'color: {{VALUE}} !important;',
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
					'{{WRAPPER}} .ere-agency .agency-social a:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_style_information_section_controls()
	{
		$this->start_controls_section(
			'section_design_information',
			[
				'label' => esc_html__('Information', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'information_typography',
				'selector' => '{{WRAPPER}} .agency-position',
			]
		);

		$this->add_control(
			'information_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .agency-info-item' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'information_fs',
			[
				'label' => esc_html__('Font Size', 'beyot-framework'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .agency-info-item' => 'font-size: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'information_spacing',
			[
				'label' => esc_html__('Spacing', 'beyot-framework'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .agency-info' => 'margin-top: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();
	}

}