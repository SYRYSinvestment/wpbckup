<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class UBE_Element_Beyot_Agent_Info extends UBE_Abstracts_Elements
{
	public function get_name()
	{
		return 'beyot-agent-info';
	}

	public function get_ube_icon()
	{
		return 'eicon-person';
	}

	public function get_title()
	{
		return esc_html__('Beyot Agent Info', 'beyot-framework');
	}

	public function get_ube_keywords()
	{
		return array('agent info', 'ere', 'essential real estate', 'cpt', 'item', 'loop', 'query', 'cards', 'custom post type', 'ube', 'g5');
	}

	public function get_style_depends()
	{
		return array(GF_PLUGIN_PREFIX . 'agent-info');
	}

	protected function register_controls()
	{
		$this->register_info_section_controls();
		$this->register_style_name_section_controls();
		$this->register_style_position_section_controls();
		$this->register_style_info_section_controls();
	}

	public function render()
	{
		gf_get_template_element('agent-info/template.php', array(
			'element' => $this
		));
	}

	public function register_info_section_controls()
	{
		$this->start_controls_section(
			'section_info',
			[
				'label' => esc_html__('Info', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'name',
			[
				'label'       => esc_html__( 'Name', 'beyot-framework' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Name', 'beyot-framework' ),
			]
		);

		$this->add_control(
			'position',
			[
				'label'       => esc_html__( 'Position', 'beyot-framework' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Position', 'beyot-framework' ),
			]
		);

		$this->add_control(
			'phone',
			[
				'label'       => esc_html__( 'Phone', 'beyot-framework' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Phone', 'beyot-framework' ),
			]
		);

		$this->add_control(
			'mobile',
			[
				'label'       => esc_html__( 'Mobile', 'beyot-framework' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Mobile', 'beyot-framework' ),
			]
		);

		$this->add_control(
			'fax',
			[
				'label'       => esc_html__( 'Fax', 'beyot-framework' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Position', 'beyot-framework' ),
			]
		);

		$this->add_control(
			'web',
			[
				'label'       => esc_html__( 'Website', 'beyot-framework' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Website', 'beyot-framework' ),
			]
		);
		$this->add_control(
			'email',
			[
				'label'       => esc_html__( 'Email', 'beyot-framework' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Email', 'beyot-framework' ),
			]
		);


		$this->end_controls_section();
	}

	protected function register_style_info_section_controls()
	{
		$this->start_controls_section(
			'section_design_information',
			[
				'label' => esc_html__('information', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'information_typography',
				'selector' => '{{WRAPPER}} .g5plus-agent-info span',
			]
		);

		$this->add_control(
			'information_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .g5plus-agent-info span' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_control(
			'information_color_icon',
			[
				'label' => esc_html__('Color Icon', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .g5plus-agent-info span i' => 'color: {{VALUE}}!important;',
				],
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
					'{{WRAPPER}} .g5plus-agent-info span:first-child' => 'margin-top: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'information_spacing_icon',
			[
				'label' => esc_html__('Spacing Icon', 'beyot-framework'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .g5plus-agent-info span i' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);


		$this->end_controls_section();
	}

	protected function register_style_name_section_controls()
	{
		$this->start_controls_section(
			'section_design_name',
			[
				'label' => esc_html__('Name', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .g5plus-agent-info h3',
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .g5plus-agent-info h3' => 'color: {{VALUE}};',
				],
			]
		);

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
				'selector' => '{{WRAPPER}} .g5plus-agent-info p',
			]
		);

		$this->add_control(
			'position_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .g5plus-agent-info p' => 'color: {{VALUE}};',
				],
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
					'{{WRAPPER}} .g5plus-agent-info p' => 'margin-top: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();
	}


}