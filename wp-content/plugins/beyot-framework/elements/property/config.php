<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

use Elementor\Controls_Manager;

if (!class_exists('GF_Elements_Listing_Property_Abstract', false)) {
	GSF()->loadFile(GF_PLUGIN_DIR . 'inc/abstracts/elementor-listing-property.class.php');
}

class UBE_Element_Beyot_Property extends GF_Elements_Listing_Property_Abstract
{
	public function get_name()
	{
		return 'beyot-property';
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
		return esc_html__('Beyot Property', 'beyot-framework');
	}

//	public function get_style_depends()
//	{
//		return array(ERE_PLUGIN_PREFIX . 'property');
//	}

	public function get_script_depends()
	{
		return array(GF_PLUGIN_PREFIX . 'property');
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
		$this->register_carousel_section_controls(array('post_layout' => ['property-carousel']));
		$this->register_columns_responsive_section_controls(array('post_layout' => ['property-grid','property-carousel']));
	}

	protected function register_layout_controls()
	{
		parent::register_layout_controls();
		$this->update_control('post_layout', [
			'default' => 'property-grid'
		]);
	}

	protected function register_include_heading_controls()
	{
		parent::register_include_heading_controls();
		$this->remove_control('heading_text_align');
	}

	protected function register_carousel_section_controls($condition)
	{
		$this->start_controls_section(
			'section_carousel',
			[
				'label' => esc_html__('Carousel Options', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => $condition,
			]
		);

		$this->register_dots_control();
		$this->register_nav_control();
		$this->register_move_nav_control($condition);
		$this->register_nav_property_position_control($condition);
		$this->register_autoplay_control();
		$this->register_autoplay_timeout_control();

		$this->end_controls_section();
	}

	public function render()
	{
		gf_get_template_element('property/template.php', array(
			'element' => $this
		));
	}
}