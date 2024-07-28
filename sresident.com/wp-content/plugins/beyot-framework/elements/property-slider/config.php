<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

use Elementor\Controls_Manager;

if (!class_exists('GF_Elements_Listing_Property_Abstract', false)) {
	GSF()->loadFile(GF_PLUGIN_DIR . 'inc/abstracts/elementor-listing-property.class.php');
}

class UBE_Element_Beyot_Property_Slider extends GF_Elements_Listing_Property_Abstract
{
	public function get_name()
	{
		return 'beyot-property-slider';
	}

	public function get_ube_icon()
	{
		return 'eicon-gallery-grid';
	}

	public function get_ube_keywords()
	{
		return array('property', 'ere', 'essential real estate', 'cpt', 'slider', 'item', 'loop', 'query', 'cards', 'custom post type', 'ube', 'g5');
	}

	public function get_title()
	{
		return esc_html__('Beyot Property Slider', 'beyot-framework');
	}

	public function get_style_depends()
	{
		return array(ERE_PLUGIN_PREFIX . 'property-slider');
	}

	public function get_script_depends()
	{
		return array(GF_PLUGIN_PREFIX . 'property-slider');
	}

	protected function register_controls()
	{
		$this->register_layout_section_controls();
		$this->register_image_size_section_controls();
		$this->register_query_section_controls();
	}

	protected function register_layout_controls()
	{
		parent::register_layout_controls();
		$this->update_control('post_layout', [
			'default' => 'navigation-middle'
		]);
	}

	public function render()
	{
		gf_get_template_element('property-slider/template.php', array(
			'element' => $this
		));
	}

	protected function register_image_size_section_controls()
	{
		parent::register_image_size_section_controls();
		$this->update_control('image_size', [
			'default' => '1200x600',
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
		$this->end_controls_section();
	}

	public function get_config_post_layout()
	{
		$config = apply_filters('gf_elementor_property_slider_layout', array(
			'navigation-middle' => array(
				'label' => esc_html__('Navigation Middle', 'beyot-framework'),
			),
			'pagination-image' => array(
				'label' => esc_html__('Pagination as Image', 'beyot-framework'),
			),
		));

		$result = array();
		foreach ($config as $k => $v) {
			$result[$k] = $v['label'];
		}
		return $result;

	}

}