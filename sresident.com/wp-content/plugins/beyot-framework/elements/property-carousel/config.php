<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

use Elementor\Controls_Manager;

if (!class_exists('GF_Elements_Listing_Property_Abstract', false)) {
	GSF()->loadFile(GF_PLUGIN_DIR . 'inc/abstracts/elementor-listing-property.class.php');
}

class UBE_Element_Beyot_Property_Carousel extends GF_Elements_Listing_Property_Abstract
{
	public function get_name()
	{
		return 'beyot-property-carousel';
	}

	public function get_ube_icon()
	{
		return 'eicon-gallery-grid';
	}

	public function get_ube_keywords()
	{
		return array('property', 'ere', 'essential real estate', 'cpt', 'item', 'loop', 'query', 'cards', 'custom post type', 'ube', 'g5');
	}

	public function get_title()
	{
		return esc_html__('Property Carousel With Left Navigation', 'beyot-framework');
	}

	public function get_style_depends()
	{
		return array(ERE_PLUGIN_PREFIX . 'property', ERE_PLUGIN_PREFIX . 'property-carousel');
	}

	public function get_script_depends()
	{
		return array(GF_PLUGIN_PREFIX . 'property-carousel');
	}

	protected function register_controls()
	{
		$this->register_layout_section_controls();
		$this->register_image_size_section_controls();
		$this->register_include_heading_controls();
		$this->register_query_section_controls();
		$this->register_style_heading_section_controls();
		$this->register_style_title_section_controls();
		$this->register_style_price_section_controls();
		$this->register_style_meta_section_controls();
		$this->register_style_excerpt_section_controls();
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

		$this->register_post_count_control();
		$this->register_color_scheme_controls();
		$this->register_show_heading_control();
		$this->register_columns_gutter_controls(array());

		$this->end_controls_section();
	}

	protected function register_color_scheme_controls()
	{
		parent::register_color_scheme_controls();
		$this->update_control('color_scheme', [
			'default' => 'color-dark',
		]);
	}

	protected function register_columns_gutter_controls($condition = array())
	{
		parent::register_columns_gutter_controls($condition = array());
		$this->update_control('post_columns_gutter', [
			'default' => 'col-gap-0',
		]);
	}

	protected function register_include_heading_controls()
	{
		parent::register_include_heading_controls();
		$this->remove_control('heading_text_align');
	}

	public function render()
	{
		gf_get_template_element('property-carousel/template.php', array(
			'element' => $this
		));
	}
}