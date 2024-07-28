<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

use Elementor\Controls_Manager;

if (!class_exists('GF_Elements_Listing_Property_Abstract', false)) {
	GSF()->loadFile(GF_PLUGIN_DIR . 'inc/abstracts/elementor-listing-property.class.php');
}

class UBE_Element_Beyot_Property_Search_Map extends GF_Elements_Listing_Property_Abstract
{
	public function get_name()
	{
		return 'beyot-property-search-map';
	}

	public function get_ube_icon()
	{
		return ' eicon-search';
	}

	public function get_title()
	{
		return esc_html__('Beyot Property Search Map', 'beyot-framework');
	}

	public function get_style_depends()
	{
		return array('select2_css', ERE_PLUGIN_PREFIX . 'property-search-map', ERE_PLUGIN_PREFIX . 'property');
	}

	public function get_script_depends()
	{
		return array(ERE_PLUGIN_PREFIX . 'search_map', 'google-map', 'markerclusterer', 'select2_js', GF_PLUGIN_PREFIX . 'property-search-map');
	}

	protected function register_controls()
	{
		$this->start_controls_section(
			'section_search',
			[
				'label' => esc_html__( 'Property Search Map', 'beyot-framework' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->register_property_search_show_controls();
		$this->register_search_show_button_controls();
		$this->register_post_count_control();
		$this->add_control(
			'marker_image_size',
			[
				'label' => esc_html__('Marker Property Image Size', 'beyot-framework'),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__('Enter image size ("thumbnail" or "full"). Alternatively enter size in pixels (Example : 100x100 (Not Include Unit, Space)).', 'beyot-framework'),
				'default' => '100x100',
			]
		);

		$this->end_controls_section();
	}

	protected function register_post_count_control()
	{
		parent::register_post_count_control();
		$this->update_control('posts_per_page', [
			'description' => esc_html__('Enter number of posts per page you want to display. Default 18', 'beyot-framework'),
			'default' => '18',
		]);
	}

	protected function register_property_search_show_controls()
	{
		parent::register_property_search_show_controls();
		$this->update_control('show_status_tab', [
			'condition' => '',
		]);
	}

	public function render()
	{
		gf_get_template_element('property-search-map/template.php', array(
			'element' => $this
		));
	}

}