<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

class UBE_Element_Beyot_Text_Info extends UBE_Abstracts_Elements
{
	public function get_name()
	{
		return 'beyot-text-info';
	}

	public function get_ube_icon()
	{
		return 'eicon-text';
	}

	public function get_title()
	{
		return esc_html__('Beyot Text_Info', 'beyot-framework');
	}

	public function get_style_depends()
	{
		return array( GF_PLUGIN_PREFIX . 'text_info');
	}

	protected function register_controls()
	{
		$this->start_controls_section('setting_section', [
			'label' => esc_html__('Setting', 'beyot-framework'),
			'tab' => Controls_Manager::TAB_CONTENT,
		]);

		$repeater = new Repeater();

		$repeater->add_control(
			'key',
			[
				'label'       => esc_html__( 'Key', 'beyot-framework' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Key', 'beyot-framework' ),
				'default' => 'Sale Price',
			]
		);


		$repeater->add_control(
			'value',
			[
				'label'       => esc_html__( 'Value', 'beyot-framework' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Value', 'beyot-framework' ),
				'default' => '$925,000',
			]
		);

		$this->add_control(
			'values',
			[
				'label'   => '',
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'key'   => 'Sale Price',
						'value' => '$925,000',
					],
				],
				'title_field' => '{{{ key }}}',
			]
		);

		$this->add_control(
			'column',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Columns', 'beyot-framework'),
				'options' => array(
					'text-info-1-column' => '1',
					'text-info-2-column' => '2',
				),
				'default' => 'text-info-1-column',
			]
		);

		$this->end_controls_section();
	}

	public function render()
	{
		gf_get_template_element('text-info/template.php', array(
			'element' => $this
		));
	}
}