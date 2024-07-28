<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

use Elementor\Controls_Manager;

if (!class_exists('GF_Elements_Listing_Property_Abstract', false)) {
	GSF()->loadFile(GF_PLUGIN_DIR . 'inc/abstracts/elementor-listing-property.class.php');
}

class UBE_Element_Beyot_Property_Advanced_Search extends GF_Elements_Listing_Property_Abstract
{
	public function get_name()
	{
		return 'beyot-property-advanced-search';
	}

	public function get_ube_icon()
	{
		return ' eicon-search';
	}

	public function get_title()
	{
		return esc_html__('Beyot Property Advanced Search', 'beyot-framework');
	}

	public function get_style_depends()
	{
		return array(ERE_PLUGIN_PREFIX . 'property-advanced-search','select2_css');
	}

	public function get_script_depends()
	{
		return array(GF_PLUGIN_PREFIX . 'property-advanced-search','select2_js',ERE_PLUGIN_PREFIX . 'advanced_search_js');
	}

	protected function register_controls()
	{
		$this->start_controls_section(
			'section_search',
			[
				'label' => esc_html__( 'Property Search', 'beyot-framework' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Layout Style'),
				'options' => array(
					'tab' => esc_html__('Status As Tab', 'beyot-framework'),
					'dropdown' => esc_html__('Status As Dropdown', 'beyot-framework'),
				),
				'default' => 'tab',
			]
		);
		$this->add_control(
			'column',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Column'),
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'default' => '3',
			]
		);

		$this->register_property_search_show_controls();
		$this->register_color_scheme_controls();

		$this->end_controls_section();
	}

	public function render()
	{
		gf_get_template_element('property-advanced-search/template.php', array(
			'element' => $this
		));
	}
}