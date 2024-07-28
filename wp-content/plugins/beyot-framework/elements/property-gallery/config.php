<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

use Elementor\Controls_Manager;

if (!class_exists('GF_Elements_Listing_Property_Abstract', false)) {
	GSF()->loadFile(GF_PLUGIN_DIR . 'inc/abstracts/elementor-listing-property.class.php');
}

class UBE_Element_Beyot_Property_Gallery extends GF_Elements_Listing_Property_Abstract
{
	public function get_name()
	{
		return 'beyot-property-gallery';
	}

	public function get_ube_icon()
	{
		return 'eicon-gallery-grid';
	}

	public function get_ube_keywords()
	{
		return array('property', 'ere', 'essential real estate', 'cpt', 'gallery', 'item', 'loop', 'query', 'cards', 'custom post type', 'ube', 'g5');
	}

	public function get_title()
	{
		return esc_html__('Beyot Property Gallery', 'beyot-framework');
	}

	public function get_style_depends()
	{
		return array(ERE_PLUGIN_PREFIX . 'property-gallery');
	}

	public function get_script_depends()
	{
		return array(GF_PLUGIN_PREFIX . 'property-gallery', ERE_PLUGIN_PREFIX . 'property_gallery', 'isotope', 'imageLoaded');
	}

	protected function register_controls()
	{
		$this->register_layout_section_controls();
		$this->register_include_heading_controls();
		$this->register_image_size_section_controls();
		$this->register_carousel_section_controls(array('is_carousel' => ['true']));
		$this->register_columns_responsive_section_controls(array());
		$this->register_query_section_controls();
	}

	public function render()
	{
		gf_get_template_element('property-gallery/template.php', array(
			'element' => $this
		));
	}

	protected function register_image_size_section_controls()
	{
		parent::register_image_size_section_controls();
		$this->update_control('image_size', [
			'default' => '290x270',
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

		$this->add_control('is_carousel',
			[
				'label' => esc_html__('Display Carousel?', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Enable', 'beyot-framework'),
				'label_off' => esc_html__('Disable', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]);
		$this->register_show_cat_filter_control();
		$this->register_show_heading_control();
		$this->register_color_scheme();
		$this->register_columns_gutter_controls();
		$this->register_post_count_control();

		$this->end_controls_section();
	}

	protected function register_property_type_controls()
	{
		$this->add_control(
			'property_types',
			[
				'type' => UBE_Controls_Manager::AUTOCOMPLETE,
				'multiple' => true,
				'select_type' => 'term',
				'data_args' => array(
					'taxonomy' => 'property-type'
				),
				'label' => esc_html__('Narrow Property Type', 'beyot-framework'),
				'label_block' => true,
				'description' => esc_html__('Enter property type by names to narrow output.', 'beyot-framework'),
				'default' => '',
			]
		);
	}

	protected function register_carousel_section_controls($condition)
	{
		parent::register_carousel_section_controls($condition);
		$this->remove_control('nav_position');
		$this->remove_control('loop');
	}

	protected function register_columns_responsive_section_controls($condition)
	{
		$this->start_controls_section(
			'section_responsive',
			[
				'label' => esc_html__('Columns', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'columns',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Columns', 'beyot-framework'),
				'data_type' => 'select',
				'options' => $this->get_post_columns(),
				'default' => '3',
			]
		);

		$this->end_controls_section();
	}

	protected function register_show_heading_control()
	{
		parent::register_show_heading_control();
		$this->update_control('include_heading', [
			'condition' => [
				'category_filter' => 'true',
			],
		]);
	}

	protected function register_include_heading_controls()
	{
		parent::register_include_heading_controls();
		$this->remove_control('heading_text_align');
		$this->update_control('section_heading', [
			'condition' => [
				'include_heading' => 'true',
				'category_filter' => 'true',
			],
		]);
	}

	protected function register_show_cat_filter_control()
	{
		$this->add_control(
			'category_filter',
			[
				'label' => esc_html__('Category Filter', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);

		$this->add_control(
			'filter_style',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Filter Style', 'beyot-framework'),
				'options' => array(
					'filter-isotope' => esc_html__('Isotope', 'beyot-framework'),
					'filter-ajax' => esc_html__('Ajax', 'beyot-framework'),
				),
				'default' => 'filter-isotope',
				'condition' => [
					'category_filter' => 'true',
				],
			]
		);
	}

	protected function register_color_scheme()
	{
		$this->add_control(
			'color_scheme',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Color Scheme', 'beyot-framework'),
				'options' => array(
					'color-dark' => esc_html__('Dark', 'beyot-framework'),
					'color-light' => esc_html__('Light', 'beyot-framework'),
				),
				'default' => 'color-dark',
			]
		);
	}

}