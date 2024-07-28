<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

use Elementor\Controls_Manager;

if (!class_exists('GF_Elements_Listing_Abstract', false)) {
	GSF()->loadFile(GF_PLUGIN_DIR . 'inc/abstracts/elementor-listing.class.php');
}

class UBE_Element_Beyot_Property_Mini_Search extends GF_Elements_Listing_Abstract
{
	public function get_name()
	{
		return 'beyot-property-mini-search';
	}

	public function get_ube_icon()
	{
		return ' eicon-search';
	}

	public function get_title()
	{
		return esc_html__('Beyot Property Mini Search', 'beyot-framework');
	}

	public function get_style_depends()
	{
		return array( ERE_PLUGIN_PREFIX . 'property-mini-search');
	}

	public function get_script_depends()
	{
		return array(ERE_PLUGIN_PREFIX . 'mini_search_js');
	}

	protected function register_controls()
	{
		$this->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__( 'Layout', 'beyot-framework' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'status_enable',
			[
				'label' => esc_html__( 'Status Enable', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'beyot-framework'),
				'label_off' => esc_html__( 'Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);

		$this->end_controls_section();
	}

	public function render()
	{
		gf_get_template_element('property-mini-search/template.php', array(
			'element' => $this
		));
	}
}