<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

class UBE_Element_Beyot_Property_Info extends UBE_Abstracts_Elements
{
	public function get_name()
	{
		return 'beyot-property-info';
	}

	public function get_ube_icon()
	{
		return 'eicon-archive';
	}

	public function get_title()
	{
		return esc_html__('Beyot Property Info', 'beyot-framework');
	}

	public function get_style_depends()
	{
		return array(GF_PLUGIN_PREFIX . 'property-info');
	}

	protected function register_controls()
	{
		$this->start_controls_section('setting_section', [
			'label' => esc_html__('Setting', 'beyot-framework'),
			'tab' => Controls_Manager::TAB_CONTENT,
		]);

		$this->add_control(
			'address',
			[
				'label'       => esc_html__( 'Address', 'beyot-framework' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter address', 'beyot-framework' ),
				'default' => 'Address',
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'beyot-framework' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter title', 'beyot-framework' ),
				'default' => 'Title',
			]
		);

		$this->add_control(
			'price',
			[
				'label'       => esc_html__( 'Price', 'beyot-framework' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter price', 'beyot-framework' ),
				'default' => '100',
			]
		);

		$this->add_control(
			'after_price',
			[
				'label'       => esc_html__( 'After Price', 'beyot-framework' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter after price', 'beyot-framework' ),
				'default' => 'Sale',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'key',
			[
				'label'       => esc_html__( 'Key', 'beyot-framework' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Key', 'beyot-framework' ),
				'default' => 'key',
			]
		);


		$repeater->add_control(
			'value',
			[
				'label'       => esc_html__( 'Value', 'beyot-framework' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Value', 'beyot-framework' ),
				'default' => '30',
			]
		);

		$repeater->add_control(
			'icon_font',
			[
				'label'            => esc_html__( 'Icon', 'beyot-framework' ),
				'type'             => Controls_Manager::ICONS,
				'label_block'      => true,
				'default'          => [
					'value'   => 'fas fa-phone-alt',
					'library' => 'fa-solid',
				],
				'fa4compatibility' => 'icon',
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
						'key'         => '',
						'icon_font' => [
							'value'   => 'fas fa-phone-alt',
							'library' => 'fa-solid',
						],
					],
				],
				'title_field' => '{{{ key }}}',
			]
		);

		$this->end_controls_section();
	}

	public function render()
	{
		gf_get_template_element('property-info/template.php', array(
			'element' => $this
		));
	}
}