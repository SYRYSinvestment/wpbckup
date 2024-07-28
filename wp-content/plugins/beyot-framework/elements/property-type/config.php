<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;


class UBE_Element_Beyot_Property_Type extends UBE_Abstracts_Elements
{
	public function get_name()
	{
		return 'beyot-property-type';
	}

	public function get_ube_icon()
	{
		return 'eicon-archive';
	}

	public function get_title()
	{
		return esc_html__('Beyot Property Type', 'beyot-framework');
	}

	public function get_style_depends()
	{
		return array( ERE_PLUGIN_PREFIX . 'property-type');
	}

	protected function register_controls()
	{
		$this->start_controls_section('setting_section', [
			'label' => esc_html__('Setting', 'beyot-framework'),
			'tab' => Controls_Manager::TAB_CONTENT,
		]);

		$this->add_control(
			'property_type',
			[
				'type' =>  UBE_Controls_Manager::AUTOCOMPLETE,
				'multiple' => false,
				'select_type' => 'term',
				'data_args' => array(
					'taxonomy' => 'property-type'
				),
				'label' => esc_html__('Narrow Property Type','beyot-framework'),
				'label_block' => true,
				'description' => esc_html__('Enter property type by names to narrow output.', 'beyot-framework'),
				'default' => '',
			]
		);

		$this->add_control(
			'type_image',
			[
				'label' => esc_html__('Choose Image', 'beyot-framework'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image_size',
				'default'   => 'full',
			]
		);


		$this->end_controls_section();
	}

	public function render()
	{
		gf_get_template_element('property-type/template.php', array(
			'element' => $this
		));
	}
}